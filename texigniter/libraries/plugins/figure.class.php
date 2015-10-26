<?php
/* 
 * @package     Figure plugin
 * @author      Dr. Y. Lazarides
 * @copyright   Dr. Y. Lazarides 2015
 * @version     0.10.00
 
 * 
 * 
 */

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfFile.interface.php');

// This needs to be initialized through a get_text for i18n eventually.
// At present it is a quick hack.

define('FIGURENAME','Figure');


class Figure implements startOfFile
{

	public $margin_figure_browser_width = '37%';
		
	public $margin_figure_on = false;
	
	
    private $regex_square_bracket = '\[*([[:alnum:]\/\)\(\,\.\:\-\_\&\s\'\"\%]+)*\]';
	// needs correction for empty 
	
	// we have a lot of cases where we only interested in optional
	// [] brackets 
	// The expression bellies its complexity
	// and took a bloody long time to debug
	//
	private $regex_optional_square_bracket = '
			\[* 									# optional square brackets
	            ([^\]]*?)							# any character except a square bracket
			\]*										# end optional brackets
			\s{1} 									#1 terminate with a space ';
	/**
	 *  Opening and closing Quotes class
	 *	\p{Pi} \p{Pf} has problems had to add quite a few
	 *	items by hand.
	**/ 
	
    private $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 								# 			
	    “” ‘ ’\/\)°									#
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´	#
		\-\&\s\'\"\#\?\%\\\\]*';					# 
		
	private $regex_allowed_chars_in_code = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
	    \p{Pi} \p{Pf}  
	    “” ‘ ’\/\)
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´\{\}
		\-\&\s\'\"\#\?\%\\\\]*';

				
	
	private $figure_temp;
	private $images_base_url;
    
    /*
     The constructor fetches a CI instance and then configures paths.
     Images are stored on S3 or locally during developement. 
     These images have to also be stored locally
     since there is no way for TeX to fetch them from the web during 
     LaTeXing of the documents. This will have to be changed eventually 
     to an AWS Que in order to LaTeX documents on the web.

     The configuration is in setup_paths.php 

    */    
    public function __construct() {
		//bucket url or local url only missing filename
		$CI = & get_instance();
        // we get the setup for setting paths either for cloud or local
        // here one can add more options.
        $CI->config->load('setup_paths');
        $images_source = $CI->config->item('datasource_images');
        $this->images_base_url=$CI->config->item('images_base_url');
        //echo $this->images_base_url;break;
    }
	
	/*
	 *	gets the images bucket url. The base image url 
	 *  is set in the config file set_up_paths.php
	 */
	public function imagesURL() {
	    //echo $this->images_base_url;//break;
		return $this->images_base_url;//$images_bucket_url;
	}
	
    /**
	 *	Rendering commands for marginfigures.
	 *  Margin figures in the browser are displayed as
	 *  wrapped figures. We simply wrap them in two divs.
	 *  e.g. \begin{marginfigure}[5cm]
	 *  The optional argument is swallowed in html
	 *  A positive value pushes the image towards the
	 *  bottom, whereas a negative pushes it towards the top of 
	 *  the page.
	 */
	
	function beginMarginFigure($text) {
		$this->margin_figure_on = true;
        $pattern = "/\\\\begin\s*\{\s*marginfigure\s*\}\s*(\[.*\])*/xu";
        $z = preg_replace($pattern, '<div class="margin-figure-wrapper" style="width:'
		.$this->margin_figure_browser_width.'">
        <div  class="margin-figure">
        ', $text);
        return $z;
        //\end{figure}
    }

    function endMarginFigure($text) {
        $pattern = "/\\\\end\s*\{\s*marginfigure\s*\}/xu";
        return preg_replace($pattern, '</div></div>', $text);
	}
    
	function makeMarginFigure ($text) {
	    $z = self::beginMarginFigure($text);
		$z = self::endMarginFigure ($z);
		return $z;
	}
	
	/* 
	 *  Wraps in a a <div class="images-wrapper">
	 *  Mark \begin{figure}[htbp]
	 *  @text  text to be scanned
	 *  @return modified text 
	 */
    function beginfigure($text) {
	    $pattern = "/\\\\begin\{figure\**\}(\[.+\])*/xu";
        return preg_replace($pattern, '<div style="width:99%" class="images debug clearfix">', $text);
    }

    function endfigure($text) {
        $pattern = "/\\\\end\{figure\**\}/xu";
        return preg_replace($pattern, '</div>', $text);
    }
	
	/*
	 * This function sets up the caption commands for the figures.
	 * \caption[short caption]{Long caption}
	 * LaTeX offers a long and a short caption, the short caption
	 * is ignored in html
	 * The star version does not return a Figure Number (we scan for this as
	 * using a separate method).
	 * We use html3 <figcaption></figcaption> tags.
	 */
	
    function caption($text) {
	    $temp='';
		$allowed_chars = '\s*\{([\p{L}  # Letter
                                 \p{N}  # Number
                                 \p{Sc} # Currency Symbol
                                 \p{P}  # Punctuation
								 +
                                 \)\(\"\s _.-\]\[
								 ]*?)\}\s*';
        $pattern = "/\\\\caption" . $allowed_chars . "/uix";					 
        //if ($this->margin_figure_on==true) $temp='Test';
        $z = preg_replace($pattern, '<figcaption class="figcaption">**FIGURE** $1</figcaption>', $text);
        return $z;
    }

	function caption_star($text) {
        $pattern = "/\\\\caption\*\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
                 \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*  # curly
                 /xu";
        $z = preg_replace($pattern, '<figcaption class="figure-caption"> $2</figcaption>', $text);
        return $z;
    }
	
	function captionof_figure($text) {
        $allowed_chars = '\s*\{([\p{L}  # Letter
                                 \p{N}  # Number
                                 \p{Sc} # Currency Symbol
                                 \p{P}  # Punctuation
                                 \)\(\"\s _.-\]\[]*?)\}\s*';
        $pattern = "/\\\\captionof\{figure\}" . $allowed_chars . "/uix";
        $z = preg_replace($pattern, '<figcaption class="figcaption">**FIGURE** $1</figcaption>', $text);
        return $z;
    }
	
    
	
	// enter as \ph{../country/image file}{description}
    function includegraphics($text) {
        $pattern = "/\\\\includegraphics   			# base LaTeX command
                        \[\s*width\s*\=\s*
						(\d*\.*\d*)					#width of image
						\\\\*(textwidth|linewidth|pt|pc|px|mm|cm|in|em|ex|\%),*\]* # \2 units
                        \{(\.\.)\/ #find the dots
                        \s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\/\"]+)\}
          /xu";
        $z = preg_replace_callback($pattern, array($this,'includegraphics_callback'), $text);
        return $z;
    }
	
	
	/**
	 *	Call back for includegraphics.
	 *  Attempts to do many things.
	 *  Formats allowed:
	 *      \includegraphics[width=.80\textwidth]{../path/to/filename}
	 *      \includegraphics[width=300px,]{../path/to/filename}
	 *  I have assumed that no-one wants to distort an image
	 *  and at this stage we do not add height etc..
	 *      
	 */
	function includegraphics_callback ($match) {
	    $units = $match[2]; 
		//if ($this->margin_figure_on===true) $match[1]=.80;//wrong
		
		switch ($units) {
			case "textwidth":
				$image_width = $match[1]*(100).'%';
				break;
			case "linewidth":
				$image_width = $match[1]*(100).'%';
				break;
			case "%":
			    $image_width = $match[1].'%';
				break;	
			case "px":
			    $image_width = $match[1].'px';
				break;
			case "pt":	
				$image_width = $match[1].'pt';
				break;
			case "pc":	
				$image_width = $match[1].'pc';
				break;	
			case "in":	
				$image_width = $match[1].'in';
				break;	
			case "cm":	
				$image_width = $match[1].'cm';
				break;
			case "mm":	
				$image_width = $match[1].'mm';
				break;	
			case "em":	
				$image_width = $match[1].'em';
				break;	
			case "ex":	
				$image_width = $match[1].'ex';
				break;	
		}
						
		$temp ='<a href="' . self::imagesURL(). $match[4].'"  class="text-center group1">
              <div style="width:100%;margin-bottom:5px;border:1px solid silver" class="text-center">
              <img src="' . self::imagesURL(). $match[4].'" style="width:'
			  .$image_width
			  .';display:block;margin:0 auto;" class="group1"/>
              </div></a>';
		//echo  htmlspecialchars($temp);	 

		
		return $temp;	  
	
	}
	
	// generic item for postal history image items
    // works also well with images in general
    // enter as \ph[56%]{to/path/image}{caption description}
	// TODO endashes seem to trip it

    function ph_generic($text, $macro_name = 'ph', 
	                    $figure_class = 'text-center', 
	                    $number_figure = true, 
						$width_enclosure = '99%', 
					    $width_image = '$1') {
        
        $regex_file_path = '\.\.\/\s*                                  #filename for image and directory
                            ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]+)';
		
		
		// make the caption	
        // use <figcaption>		
        if ($number_figure) {
            $this->figure_temp = "<figcaption class=\"figcaption\">**FIGURE $4** $3 $5</figcaption>";
        } else {
            $this->figure_temp = "<figcaption>$3 $5</figcaption>";
        }

		
        $pattern = "/\\\\" . $macro_name
                . $this->regex_square_bracket
                . "
                   \s*                                          # optional spaces before brackets 
                   \{"
                . $regex_file_path
                . "\}  
                   \s*                                          #optiona space before second bracket
                  \{("                                          # $3 before any label
                . $this->regex_allowed_chars_in_text . "             #  
                    )
                      (?:\\\\label\{)?
                        (".$this->regex_allowed_chars_in_text.")    # mandatory to have text and be a valid name
                      \}?                                       # zero or more curly brackets non-capturing
                    \s*                                         # capture text after a label
                    (" . $this->regex_allowed_chars_in_text . ")# text after any possible label 
             \}/xu";
		$src="$2";	
		
		
		
		$replace = '<figure style=" width:' .$width_enclosure. 
		              //$width_enclosure . 
		              ';padding:10px" class="figures ' . $figure_class . 
					  '  " id="$4">'.
                      '<a href="' . self::imagesURL().$src.
					  '" class="' . $figure_class . ' group1 text-center">'.
                      '<img src = "' . self::imagesURL().$src.
					  '"   style="width:'.$width_image. 
					  ';display:block;float:none;margin:0 auto;padding:3px;border:1px solid silver"'. 
					  'class="text-center"  title="test" />'.
			          '</a><span class="figure-caption">' .
                      $this->figure_temp .
                      '</span>'.
			         '</figure>';
					 
        $zz = preg_replace($pattern, $replace, $text);
		
		//if ($zz) echo 'true'; else echo 'false'; //break;	
        if ( isset($zz) && (!empty($zz)) &&($zz!== NULL)) {return $zz;}
    }

	
    function ph($text, $macro_name = 'ph') {
        //return $this->ph_generic($text, $macro_name = 'ph');
		return $this->ph_generic($text, $macro_name = 'ph', $figure_class = 'ph', 
		              $number_figure = true, $width_enclosure = '90%', $width_image = '$1');
    }

	function img($text, $macro_name = 'img') {
        return $this->ph_generic($text, $macro_name = 'img');
    }
	
    function ph_star($text, $macro_name = 'ph*') {
        return $this->ph_generic($text, $macro_name = 'ph\\*', $figure_class = 'center', $number_figure = false);
    }

    function phl($text, $macro_name = 'phl') {
        return $this->ph_generic($text, $macro_name = 'phl', $figure_class = 'pull-left', 
		       $number_figure = true, $width_enclosure = '$1', $width_image = '98%');
    }

    function phl_star($text) {
        return $this->ph_generic($text, $macro_name = 'phl\\*', $figure_class = 'pull-left', 
		              $number_figure = false, $width_enclosure = '$1', $width_image = '99%');
    }

    function phr($text, $macro_name = 'phr') {
        return $this->ph_generic($text, $macro_name = 'phr', $figure_class = 'pull-right', $number_figure = true, $width_enclosure = '$1', $width_image = '95%');
    }

    function phr_star($text, $macro_name = 'phr\\*') {
        return $this->ph_generic($text, $macro_name = 'phr\\*', $figure_class = 'pull-right', $number_figure = false, $width_enclosure = '$1', $width_image = '95%');
    }

	function phc($text, $macro_name = 'phc') {
        return $this->ph_generic($text, $macro_name = 'phc', $figure_class = 'center', 
		              $number_figure = true, $width_enclosure = '$1', $width_image = '99%');
    }
	
    // enter as \ph{image file}{description}
    function wrapleft($text) {
        $pattern = "/\\\\wrapleft\[*([[:alnum:]\/\)\(\,\.\:\-\_\&\s\'\"\%]+)*\] #optional bracket $1
                   \s*  # optional spaces before brackets can place bracket below
                   \{\s*\.\.  #filename for image and directory
                     ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]+)  #manadatory to have text and be a valid name
                   \}
                   \s*  #optiona space before first bracket
                  \{(                                    # $3 before any label
                     [[:alnum:]\/\)\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\-\&\s\'\"\#\?\%\\\\]*
                    )
                      (?:\\\\label\{)?
                        ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]*)  #mandatory to have text and be a valid name
                      \}?                               #zero or more curly brackets non-capturing
                          \s*  #final write up
              ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]*) #optional label can be at the end this is six
             \}/xu";

        $z = preg_replace($pattern, '<div style="width:$1%;float:left;margin-right:1%"  id="$4"  >
              <img src="http://localhost/stamp-images/$2"
               style="width:98%;" class="center" title="$3 $5"  />
              <p class="small" style="line-height:1.4;" >**FIGURE $4** $3 $5</p>
             </div>', $text);
        return $z;
    }

    function wrapright($text) {
        $pattern = "/\\\\wrapright\[*([[:alnum:]\/\)\(\,\.\:\-\_\&\s\'\"\%]+)*\] #optional bracket $1
                   \s*  # optional spaces before brackets can place bracket below
                   \{\s*  #filename for image and directory
                     ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]+)  #manadatory to have text and be a valid name
                   \}
                   \s*  #optiona space before first bracket
                  \{(                                    # $3 before any label
                     [[:alnum:]\/\)\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\-\&\s\'\"\#\?\%\\\\]*
                    )
                      (?:\\\\label\{)?
                        ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]*)  #manadatory to have text and be a valid name
                      \}?                               #zero or more curly brackets non-capturing
                          \s*  #final write up
              ([[:alnum:]\/\)\(\.\:\_\-\&\s\'\"]*) #optional label can be at the end this is six
             \}/xu";
        $z = preg_replace($pattern, '<div style="width:$1%;float:right;margin-left:1%"  id="$4"  >
              <img src="http://localhost/stamp-images/$2"
               style="width:98%;" class="center"  title="$3 $5" />
             <p class="small" style="line-height:1.4;margin-bottom:0px" >**FIGURE $4** $3 $5</p>
             </div>', $text);
        return $z;
    }

	function removetextwidth($text) {
        $pattern = "/\[width=\.(\d\d*)\\\\(textwidth|linewidth)\]
          /xu";
        // $z=preg_replace($pattern,'[$1'.'%]',$text); //use convention to minimize parse .9
        //echo$z;break;
        return $text;
    }
	
		
	// replaces all the **FIGURE** with serial numbers.
	// **_  
    function number_figures($text) {
        $z = preg_replace_callback("[\*\*FIGURE(\s*.*)\*\*]", 
		        create_function('$figureNumber',
                    'static $id = 0;
                    $id++;
                    return "<a id=\"fig_".$id."\" class=\"black\" style=\"font-weight:bold\">
					**$figureNumber[1]_figure ".$id.
					"</a>";
    '), $text);
        return $z;
    }

	function label($text) {
        $z = preg_replace("/                                                                 # \ref[]{}
         \\\\label\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                             # square brackets
         \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*    # third curly
         /xu", '<a id="$2">$2 </a>', $text);
        return $z;
    }
	
	/* 
	 *  References \ref{anchorlink}
	 */
    function ref($text) {
        // change to a marker --anchorlink--
        $refpattern = "/\\\\ref
              \{
               ([[:alnum:]\:]+)*
              \}/xu";
        $z = preg_replace($refpattern, '--$1--', $text);
        $refpatterna = "/
               --([[:alnum:]]+)--*
              /xu";
        //crossrefs now holds all the values
        //for references
        $temp = preg_match_all($refpatterna, $z, $crossrefs);
        // echo_array($crossrefs);

        $i = 0;
        $pattern = "/([\*]+)(.*_)Figure\s*\d*/uix";
        // find all the figure numbers as they are now associated with
        // the labels
        $temp = preg_match_all($pattern, $z, $values);
        //$replace=$values[2];
        // echoPRE("VALUES a");
        // echo_array($values);
        // clear them from the figures
        $i = 0;
        // break;

        for ($i = 0; $i < count($values[1]); ++$i) {
            $values[1][$i] = trim($values[1][$i]);
            if (trim($values[1][$i]) == '') {
                $values[1][$i] == 'test';
            } else {
                //echo $values[1][$i];
                $z = str_replace($values[1][$i], '', $z);
            }
        }

        //$z=str_replace ('**','', $z);
         //$z=str_replace ('*F','F', $z);
        // changes crossrefs

        for ($i = 0; $i < count($crossrefs[1]); $i++) {
            for ($j = 0; $j < count($values[1]); $j++) {
                $aa = $values[2][$j] . '';
                $bb = trim($crossrefs[1][$i]) . '_';

                $daa = strcmp(trim($aa), trim($bb));
                //echo $daa;
                //echoPRE($aa.' '.$bb,'  '.$daa.'d ');
                if ($daa == 0) {
                    //echo 'match'.$j;
                    $cc = 'Figure ' . ($j + 1);
                    $z = str_replace('--' . $crossrefs[1][$i] . '--', '<a  href="#' . $crossrefs[1][$i] . '">' . $cc . '</a>', $z);
                    //$z=str_replace ($crossrefs[1][$i].'_','', $z);
                }
            }
        }
		
		
        
   
        return $z;
    }
	
	//removes all the markers and adds Figure or Fig.
	//set it up on top
	function cleanMarkers ($text) {
	    return preg_replace('/[[:alnum:]]*_figure/', FIGURENAME, $text); 
	}
	
	function figures_gamut ($text) {
	
		$z = self::makeMarginFigure($text);
        		
		$z = self::beginfigure ($z);
		$z = self::endfigure ($z);
		
		$z = self::includegraphics ($z);
		$z = self::captionof_figure ($z);
		$z = self::caption ($z);
		$z = self::caption_star ($z);
		
		$z = self::removetextwidth ($z);
		$z = self::ph($z);
		$z = self::img($z);
        $z = self::ph_star($z);
        $z = self::phl($z);
        $z = self::phl_star($z);
        $z = self::phr($z);
        $z = self::phr_star($z);
		$z = self::phc($z);
		
        $z = $this->wrapleft($z);
        $z = $this->wrapright($z);
		
		$z = $this->number_figures($z);
		$z = $this->label($z);
		$z = $this->ref($z);
		
		$z = self::cleanMarkers($z);
		if ($z) return $z; else return $text;
	}
	
	/*
	 * 	We adjust any commands that have (%) as a width
	 * 	\ph \phl \phr \phc \includegraphics
	 *	and their star equivalents
	 *  see preamble.tex for the \phl command structure,
	 *	actually we do not use the width = at this stage
	 *  37% is changed to .37
	 */
	
    function ph_tex($text){
        $pattern="/\[(\d*)\%\]/ux";
        $z=preg_replace($pattern,'[width = .$1\\textwidth]',$text);
        return $z;
    }

	function ph_generic_tex ($text) {
		$pattern="/\[\s*width\s*=\s*(\d*)\s*\%\]/ux";
        $z=preg_replace($pattern,'[width = .$1\\textwidth]',$text);
        return $z;
	}
	
	
	
	/*
	 * We run through all the helper functions to
	 * prepare for saving the text in a .TeX file
	 * for processing by a TeX Engine. In most cases
	 * we just leave the TeX command unprocessed.
	 * 
	 * Our major concern is that we have allowed (%) as
	 * a dimension unit, whereas this is verbotten in TeX
	 * and used as a comment symbol, so we reverse it.
	 * 
	 */
	 
	public function in_tex_gamut ($text) {
		$z = self::ph_tex ($text);
		$z = self::ph_generic_tex ($z);
		return $z;
	
	}
	
    public function startOfFile($text) 
    {
	    //filterclass::$in_tex = true;
	    if (filterclass::$in_tex) {
			  return self::in_tex_gamut($text);
			} else {
			  return self::figures_gamut($text);
		}
			
    }
    
        
}

?>

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class filters the text before display
 * and changes macros, wiki marks and markdown
 * to their textual representation.
 *
 *
 * */

class Filterclass {

    //This filters class provides two methods of transclusion
    //one it can pick variables and values
    //another it just inserts different values and mark-up where the transclusion
    //takes place
    //feature will return a value
    //image will insert new mark-up in place of the old one
    //filterALL just transclusion
    //parseFields for the latter (returns array of all the fields
    //needs thinking
    
	/**
	 *  Initialize two variables to allow for plugin
	 *  loading
	**/
	private $parser_plugins = null;
    private static $config_ini     = null;
	
    private $deploy = true;
    // properties for footnotes
    public static $footnotestyle = 'numeric';
    // easier than having a method to convert to roman and faster
    // consider removing ''
	public static $in_tex = false;
	public static $in_menu = false;
	
	// we need to know where we are easily
	public static $location = 'UNKONWN';
	public static $portal = 'UNKONWN';
	public static $title = 'UNKONWN';
		
	public static $navigationArray=false;
	public static $footnote_store = '';
	public static $bibliography_store = '';
	
	// footnote related stuff
    public static $roman = array ('','i','ii','iii','iv','v','vi','vii','viii','ix','x'); 
    public static $fnsymbols = array ('','*','**','***','†','‡','§','††','‡‡','§§');
    public $filter_value='';
    public $fields='';
    public $figurecounter='';
    public $temp='';
    public $tempa='';
    public $tempc='';
	
	public $environments = array ();
	public $texcommands = array ();
	public $wikicommands = array ();
	
	private $codeblock_type ='';
	public $codeblock_array = array ();
	public $inline_codeblock_array = array ();
	
	public static $testvalue = 5;
    //template replacement
    private $curly = "\{\s*([[:alnum:]\/
                \\\\=\,\.
                \-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\s*";

    # generalize some regular expressions
    # for optional square brackets.
    # used for \command[]{}{}
   
    private $regex_square_bracket = '\[*([[:alnum:]\/\)\(\,\.\:\-\_\&\s\'\"\%]+)*\]';
	// needs correction for empty 
	
	// we have a lot of cases where we only interested in optional
	// [] brackets 
	// The expression bellies its complexity
	// and took a bloody long time to debug
	//
	private $regex_optional_square_bracket = '
			\[* 											# optional square brackets
	            ([^\]]*?)									# any character except a square bracket
			\]*												# end optional brackets
			\s{1} 											#1 terminate with a space ';
	/**
	 *  Opening and closing Quotes class
	 *	\p{Pi} \p{Pf} has problems had to add quite a few
	 *	items by hand.
	**/ 
	
    private $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 
	    “” ‘ ’\/\)°
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´
		\-\&\s\'\"\#\?\%\\\\]*';
		
	public $regex_allowed_chars_in_code = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
	    \p{Pi} \p{Pf}  
	    “” ‘ ’\/\)
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´\{\}\|\@\*© 
		\-\&\s\'\"\#\?\%\\\\ ]*?';
		

    /**
     * Constructor - Sets paths based on 
     * development, staging or deployment
     * 
     * 
     *  @development  changes settings to AWS 
     * 
     */
    public function __construct($config = array()) {
	    		
		// We now load all the plugins 
		
		$this->parser_plugins = array();
        
        if(!is_dir(dirname(__FILE__) . '/plugins/'))
        {
            throw new Exception("Unable to Find:" . dirname(__FILE__) . '/plugins/');
        }
        
        $directory = opendir(dirname(__FILE__) . '/plugins/');
        
        if($directory === false)
        {
            throw new Exception("Unable to Read Directory:" . dirname(__FILE__) . '/plugins/');
        }
		
		// Check for configuration file
		$config = filterclass::getConfigINI();
        $isEnabled = true;
        $plugin_list = array();
		
		if(array_key_exists('MAIN',$config) && array_key_exists('DEFAULT_MODE', $config['MAIN']) && strtoupper($config['MAIN']['DEFAULT_MODE']) == 'DISABLED')
        {
            $isEnabled = false;
        }
		if($isEnabled)
        {
            //So the Default is to enable plugins.
            if(array_key_exists('MAIN',$config) && array_key_exists('DISABLED_PLUGINS',$config['MAIN']) && is_array($config['MAIN']['DISABLED_PLUGINS']))
            {
                $plugin_list = $config['MAIN']['DISABLED_PLUGINS']; //List Of Disabled Plugins
            }
        }
        else
        {
            //So the defualt is to disable
            if(array_key_exists('MAIN',$config) && array_key_exists('ENABLED_PLUGINS',$config['MAIN']) && is_array($config['MAIN']['ENABLED_PLUGINS']))
            {
                $plugin_list = $config['MAIN']['ENABLED_PLUGINS']; //List Of Enabled Plugins
            }            
        }
		while(false !== ($file=readdir($directory))) 
        {
            if($file != "." && $file != ".." && $file != ".svn")
            {
                //Now we need to work out the class name.
                $class_name = explode(".",$file);
                $class_name = $class_name[0];

                //Ok Lets Check if it's enabled or disabled in the INI                
                if($isEnabled && !in_array($class_name, $plugin_list) || !$isEnabled && in_array($class_name, $plugin_list))
                {
                    //Defult Mode is Enabled and It's Not Expressly Disabled
                    //Or It's default is disabled but it's been enabled.
                    if(!is_dir(dirname(__FILE__) . '/plugins/' . $file))
                    {
                        require_once(dirname(__FILE__) . '/plugins/' . $file);
						// create all the plugin classes.
                        $this->parser_plugins[] = new $class_name();
                    }
                }                
            }
        }
        closedir($directory);
		log_message('debug', "Filterclass initialized");
    }

	/*
      Definitions for all filters follows.
     */

    function filterAll($content) {
		$content = $this->protectCheckmark($content);	 		
		$content = $this->protect_inline_codeblocks($content);
		$content = $this->protect_codeblocks_gamut ($content);
		
		//parse LaTeX markup using the plugins
		$content = $this->parse($content);
		
		// If we are filtering during the TeX phase
        // we do not need to filter the values
		// needs some though here.
		if (!filterclass::$in_tex) {
			$content = $this->field($content);
			$content = $this->unprotect_inline_codeblocks($content);		
			$content = $this->unprotect_codeblocks_gamut($content);
		} else{
			
			$content = $this->unprotect_inline_codeblocks_tex($content);
			$content = $this->unprotect_codeblocks_gamut_tex($content);
		}
		
		//needs to have a proper gamut here
		//$content = $this->code_main($content);
		$this->filter_value = $content;
		
		return $content;
    }

	function protectCheckmark ($text) {
		$pattern = '/\\\\(?:tickmark|checkmark|check)/ux';
		$replace = 'TICKMARK';
		$z = preg_replace ($pattern, $replace, $text);
		return $z;
	}
	
	public function unprotectChekmark ($text) {
	    $pattern = '/(?:TICKMARK|CHECKMARK)/ux';
		$replace = '<span class="checkmark">&#10004;</span>';
		$z = preg_replace ($pattern, $replace, $text);
		return $z;
	}
	
	
    /* parse all fields created on the fly
     * returns the field value to be
     * placed into templates
     */

    function parseFields($content) {
        $this->fields['keywords'] = $this->parseField('keywords', $content);
        $this->fields['feature'] = $this->parseField('feature', $content);
        $this->fields['feature_image'] = $this->parseField('feature-image', $content);
        $this->fields['title'] = $this->parseField('title', $content);
        $this->fields['credit_source'] = $this->parseField('credit-source', $content);
        $this->fields['credit'] = $this->parseField('credit', $content);
        //$this->fields['next'] = $this->parseField('next', $content);
        //$this->fields['prev'] = $this->parseField('previous', $content);
    }

	
	// not used
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
	// not used
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }
	
	// we look for a .ini file under filters
	// This might have to be changed later
	public static function getConfigINI()
    {
        if(filterclass::$config_ini === null)
        {
            filterclass::$config_ini = parse_ini_file(dirname(__FILE__) ."/config.ini", true);
			//echo dirname(__FILE__) ."/config.ini";break;
        }
		//echo_array(filterclass::$config_ini);break;
        return filterclass::$config_ini;
    } 
	
	// 4wiki_text is the file contents   
    
    public function parse($text)
    {
        //Parse Section
        //For each section on the config.ini
        $parser_order_config = filterclass::getConfigINI();
        
        $file_parsing_order = $parser_order_config['FileParsingOrder'];
        //ksort($file_parsing_order);
		//echo_array($file_parsing_order);break;
		//$file_parsing_order = array(0,1,2,3,4,5);
		/*
		 * [0] => preParsing
		 * [1] => startOfFile
		 * [2] => LINE
		 * [3] => endOfFile
		 * [4] => postParsing
		*/
		ksort($file_parsing_order);
        
        foreach($file_parsing_order as $parsing_section_name)
        {
            if(strtoupper($parsing_section_name) == "LINE")
            {
                $line_parsing_order = $parser_order_config['LineParsingOrder'];
                ksort($line_parsing_order);
                
                $text_lines = explode('\n', $text);
                
                for($i = 0;$i < count($text_lines);$i++)
                {
                    foreach($line_parsing_order as $parsing_line_section_name)
                    {
					    //echo $parsing_line_section_name.'zz ';break;
                        $text_lines[$i] = $this->parseSection($parsing_line_section_name, $text_lines[$i]); 
                    }
                }
                
                $text = implode(PHP_EOL, $text_lines);
            }
            else
            {
                //Parse file
                $text = $this->parseSection($parsing_section_name, $text);
            }            
        }
        
        return $text;
    }

    // parse the whole file i.e, not for each line.
    private function parseSection($section_name, $wiki_text)
    {        
		//echo $section_name;
        $parser_order_config = filterclass::getConfigINI();
        $parser_order_int = array();
        
        foreach($parser_order_config[$section_name] as $priority => $plugin_name)
        {
            $parser_order_int[(int)$priority] = $plugin_name;
        }
        
        ksort($parser_order_int);
        
        foreach($parser_order_int as $priority => $plugin_name)
        {
            //Only Process those with a priority lower than 0
            if($priority > 0)
            {
                break;
            }
            
            foreach($this->parser_plugins as $plugin)
            {
                if($plugin instanceof $section_name && $plugin instanceof $plugin_name)
                {
				   
                    $wiki_text = $plugin->$section_name($wiki_text);
                    break;
                }
            }                
        }
     
        //Process all the plugins we don't have a priority for (Equiv to them all having zero)
        $parsers = $this->parser_plugins;
        if(is_array($parser_order_config) && array_key_exists('ParsingDirection', $parser_order_config) && array_key_exists($section_name, $parser_order_config['ParsingDirection']) && strtolower($parser_order_config['ParsingDirection'][$section_name]) == 'reverse')
        {
            $parsers = array_reverse($this->parser_plugins);
        }
        
        foreach($parsers as $plugin)
        {
            if(!in_array(get_class($plugin), $parser_order_int) && $plugin instanceof $section_name)
            {
                //echo "Plugin Name:" . get_class($plugin) . " : " . $section_name . " : <-----\"" . $wiki_text . "\"----->\n\n"; 
                $wiki_text = $plugin->$section_name($wiki_text);                
            }
        }            
        
        foreach($parser_order_int as $priority => $plugin_name)
        {
            //Only Process those with a priority higher than 0
            if($priority <= 0)
            {
                continue;
            }
            
            foreach($this->parser_plugins as $plugin)
            {
                if($plugin instanceof $section_name && $plugin instanceof $plugin_name)
                {
				   
                    $wiki_text = $plugin->$section_name($wiki_text);
                    break;
                }
            }                
        }
        return $wiki_text;
    }
				
	/** 
	 *  \verb+ ..... + 
	 *  + can be any two characters.
	**/
	function protect_inline_codeblocks ($text) {
	    $pattern = "/\\\\verb\**\s*(.)/mxu";
		if (preg_match_all($pattern, $text, $values)){
			$pattern = "/\\\\verb\s*".preg_quote($values[1][0])."(.*?)".preg_quote($values[1][0])."/mxu";
			return preg_replace_callback($pattern, array($this,'protect_inline_codeblocks_callback'), $text);
			} else {
			return $text;
		}
	}
	
	
	
		
	function protect_inline_codeblocks_callback ($values) {
	  static $izz;
	  $izz++;
	  if(!empty($values)) {$this->inline_codeblock_array [] = htmlentities($values[1]);}
		return 'INLINE'.$izz;
	}
	
	/**
	 * We need to fence all the codeblocks, so that
	 * TeX mark-up and html will not be expanded.
	 * @$text text to parse.
	 * we protect them by using CODEBLOCKS-Number
	 *
	 * We allow all TeX Commands to be of the form
	 *   \cmd \endcmd or
	 *   \startcmd \stopcmd or
	 *   \begin{cmd} ... \end{cmd}
	 *
	*/ 
	function protect_codeblocks ($text, $field = '') {
	    $this->codeblock_type =  $field;
		//echo $this->codeblock_type;break;
	    $pattern = "/\\\\(?:".$field."|start".$field."|begin\{".$field."\})(".
			$this->regex_allowed_chars_in_code.
			")\\\\(?:"
			.'end'.$field."|stop".$field."|end\{".$field."\})/mxu";
    	return preg_replace_callback($pattern, array($this,'protect_codeblocks_callback'), $text);
	}
	
	
		
	
	/**
	 *  To protect the codeblocks the 
	 *  contents are replaced by a fence word i.e., CODEBLOCK
	 *	or VERBATIM
	 *  and the contents stored in the codeblock array.
	 *  saved as codeblock4=>code...
	 *  
	 */
	function protect_codeblocks_callback ($values) {
		$fence = $this->codeblock_type;
		//echo $fence;
	    static $codeblock_number;
		$codeblock_number++;
		$this->codeblock_array[strtoupper($fence).$codeblock_number] = \htmlentities($values[1]);
		//echo_array($this->codeblock_array);
		return strtoupper($fence).$codeblock_number;
	}
	
	/**
	 *  Unprotect codeblocks and replace with
	 *  transclusion.
	 *  needs rethinking
	 *
	 */

	 
	function unprotect_codeblocks ($text, $field='VERBATIM') {
		$before = 
		          '<div  class="code-block console-wrap clearfix" style="padding:10pt;margin-bottom:15px">'.
				  '<a href="#" class="toggleClass"' .
        			'>-collapse</a>'.
				  '<div class="code-block code" style="padding:10pt;width:80%">'.
                  '<pre><code>';
        $after =  '</pre></code>'.'</div>'.
				  '<div  class="msg">'.
                  '</div>'.
                  '<div class="console"></div>'.
                  '<button class="btn btn-inverse eval">Run!</button>'.
                  '<button class="btn btn-inverse edit">Edit!</button>'.
                  '<ol class="results"></ol> '.
                  '</div>';
		if ($field == 'snippet') {
			$before = '<pre><code>';
			$after ='</code></pre>';
		}	
				  
		$pattern  = "/".strtoupper($field)."\d*/"; //CODEBLOCK12
		$patterns = array();
		$replace = array();
		
		preg_match_all($pattern, $text, $matches);
		//echo_array($matches[0]); echo ' THIS ';
		//echo_array($this->codeblock_array);
		$z = $text;
		$i=0;
		// change to while loop here and will be more efficient
		if ($matches[0]>0){
		for ($i=0;$i<sizeof($this->codeblock_array);$i++) {
		  $patterns[] ='/'.strtoupper($field).($i+1).'/mu';
		  if (array_key_exists(strtoupper(($field).($i+1)), $this->codeblock_array )){
		  $replace[] = $before.trim($this->codeblock_array[strtoupper(($field).($i+1))]).$after;}
		 }
		 $z = preg_replace($patterns, $replace, $z);
		}		
		return $z;
		
	}
    // We now unprotect all fenced code blocks
	function unprotect_codeblocks_tex ($text, $field='VERBATIM') {
		$before = '\begin{verbatim}';
        $after = '\end{verbatim}';
		$pattern  = "/".strtoupper($field)."\d*/"; //CODEBLOCK12
		$patterns = array();
		$replace = array();
		
		preg_match_all($pattern, $text, $matches);
		//echo_array($matches[0]); echo ' THIS ';
		//echo_array($this->codeblock_array);
		$z = $text;
		$i=0;
		// change to while loop here and will be more efficient
		if ($matches[0]>0){
		for ($i=0;$i<sizeof($this->codeblock_array);$i++) {
		  $patterns[] ='/'.strtoupper($field).($i+1).'/mu';
		  if (array_key_exists(strtoupper(($field).($i+1)), $this->codeblock_array )){
			$replace[] = $before.$this->codeblock_array[strtoupper(($field).($i+1))].$after;}
		 }
		 $z = preg_replace($patterns, $replace, $z);
		}		
		return $z;
		
	}
	// unprotect codeblocks for all commands that need protection
	function unprotect_codeblocks_gamut_tex ($text) {
		$z = $this->unprotect_codeblocks_tex ($text, 'verbatim');
		//$z = $this->unprotect_codeblocks ($z, 'tex');
		$z = $this->unprotect_codeblocks ($z, 'codeblock');
		return $z;
	}
	
	
	/**
	 *  We run through all blocks that need to be 
	 *  protected and leave their content unparsed.
	 *
	 */ 
	function protect_codeblocks_gamut ($text) {
		$allowed = ['codeblock', 'verbatim', 'tex', 'js', 'coffeescript', 'snippet'];
		foreach ($allowed as $key=>$val) {
			$text = $this->protect_codeblocks ($text, $val); 
		    //echo $val;
		}
		return $text;
	}
	
	/**
	 *	We run through to unblock all the codeblocks.
	 *	
	 */
	function unprotect_codeblocks_gamut ($text) {
		$z = $this->unprotect_codeblocks ($text, 'verbatim');
		$z = $this->unprotect_codeblocks ($z, 'tex');
		$z = $this->unprotect_codeblocks ($z, 'codeblock');
		$z = $this->unprotect_codeblocks ($z, 'js');
		$z = $this->unprotect_codeblocks ($z, 'coffeescript');
		$z = $this->unprotect_codeblocks ($z, 'snippet');
		return $z;
	} 
		
	
    function unprotect_inline_codeblocks ($text) {
		$pattern  = "/INLINE\d*/";
		$patterns = array();
		$replace = array();
		
		preg_match_all($pattern, $text, $matches);
		//echo_array($matches[0]);echo ' THIS ';
		//echo_array($this->inline_codeblock_array);
		$z = $text;
		$i=0;
		if ($matches[0]>0){
		for ($i=0;$i<sizeof($matches[0]);$i++) {
		  $patterns[] ='/INLINE'.($i+1).'/mu';
		  $replace[] = '<code class="inline-code">'.$this->inline_codeblock_array[$i].'</code>';
		 }
		 $z = preg_replace($patterns, $replace, $z);
		 
		}		
		return $z;
	}   

    function unprotect_inline_codeblocks_tex ($text) {
		$pattern  = "/INLINE\d*/";
		$patterns = array();
		$replace = array();
		
		preg_match_all($pattern, $text, $matches);
		//echo_array($matches[0]);echo ' THIS ';
		//echo_array($this->inline_codeblock_array);
		$z = $text;
		$i=0;
		if ($matches[0]>0){
		for ($i=0;$i<sizeof($matches[0]);$i++) {
		  $patterns[] ='/INLINE'.($i+1).'/mu';
		  $replace[] = '\verb+'.$this->inline_codeblock_array[$i].'+';
		 }
		 $z = preg_replace($patterns, $replace, $z);
		 
		}		
		return $z;
	}   
       

      
 

    function field($text) {
        $pattern = "/\{\{field:\s*([[:alnum:]\/\)\(\_\=\@\#\$\,\.\-\&\s\'\/\d\"\!\.\?\;\:\\\\\>\<]+)\}\}/iusx";
        $z = preg_replace($pattern, '<strong>$1</strong> ', $text);
        return $z;
    }

    

    function category($text) {
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern = "/\{\{category:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\:]+)\}\}/u";
        $success = preg_match_all($pattern, $text, $values);
        if ($success) {
            return $values[1][0];
        }
        return $success;
    }

    	
    //changed to include rotated banner if required
    // does not work very well
	// This is a field
    function feature($text) {
        //echo $text;
        $pattern = "/\{\{feature:(\s*.*?)\}\}/iusx";
        preg_match_all($pattern, $text, $values);
        $z = preg_replace($pattern, '<div class="rot-ex">$1</div>', $text);
        //returns the values extracted
        $feature = @$values[1][0];
        return $feature;
    }

    function parseField($field, $text) {
        //parses any specific field
        //this is a general routine for replacement macros keywordsetc.
        $pattern = "/\{\{$field\s*:\s*([^\}]+)\}\}/ux";
        // $pattern="/\{\{$field:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\}/isx";
        preg_match_all($pattern, $text, $array);
        $field = @$array[1][0];
        return $field;
    }
	
}



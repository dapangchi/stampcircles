<?php
/* 
 * @package     TeXifier
 * @author      Dr Y Lazarides
 * @copyright   Dr Y Lazarides 2013
 * @link        
 * @version     
 * 
 * @licence     MPL
 * 
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. 
 */

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfFile.interface.php');

class Miscellaneous implements startOfFile
{
    
        
    public function __construct()
    {
       return $this;
    }
   
    
   
    function acute($text) {
               
        $patterns[] = "/\\\\\\$/u";
        $replacements[] = '\\$';
        // $patterns[]="/\\\\\\&[^a]/"; $replacements[]='\\amp;';
        $patterns[] = "/\\\\\\#/u";
        $replacements[] = '#';
        $patterns[] = "/\\\\\\_/u";
        $replacements[] = '_';
        
        $patterns[] = "/\\\\RaggedRight/u";
        $replacements[] = '';
		
		$patterns[] = "/\:\<math\>([^\<]*)\<\/math\>/u";
        $replacements[] = "\\\\\\\\[$1\\\\\\\\]";
		
		$patterns[] = "/\<math\>([^\<]*)\<\/math\>/u";
        $replacements[] = "\\\\\\\\($1\\\\\\\\)";
		
        //$patterns[] = "/\\\\protect/u";
        //$replacements[] = '';
        
        $patterns[] = "/\\\\begin\{comment\}/u";
        $replacements[] = '<div class="hidden no-mathjax">';
        $patterns[] = "/\\\\end\{comment\}/u";
        $replacements[] = '</div>';
        $patterns[] = "/\\\\begin\{fullwidth\}/u";
        $replacements[] = '';
        $patterns[] = "/\\\\end\{fullwidth\}/u";
        $replacements[] = '';
        
        
        $patterns[] = "/\\\\end\{document\}/u";
        $replacements[] = '';
        $patterns[] = "/\\\\index\s*\{.*\}/u";
        $replacements[] = ''; //remove index, not provided in html
        $patterns[] = "/\\\\noalign\s*\{.*\}/u";
        $replacements[] = ''; //remove no align
        $patterns[] = "/\\\\hline/u";
        $replacements[] = ''; //remove \hline

        $patterns[] = '/\\\\begin\{example\}/';
		$replacements[] = '<p style="text-indent:0pt;background-color:yellow">';
		
		$patterns[] = '/\\\\end\{example\}/';
		$replacements[] = '</p>';
       
        //remove double backslashes at end of tables
        //$patterns[] = "/\\\\\\\\\s*/u";
        //$replacements[] = "\n";
        // Check for backtick type of quotes in mark-up


        //$patterns[] = "/('|`)+([[:alnum:]]+)''/u";
        //$replacements[] = '&quot;$2&quot;';

        // dashes place the m before the n otherwise it gets replaced
        // and there is no match. Ensure the <!-- does not get affected
        // or -->
        
        // macros for code

        $patterns[] = "/\\\\begin\{css\}/u";
        $replacements[] = '<style type="text/css">';
        $patterns[] = "/\\\\end\{css\}/u";
        $replacements[] = '</style>';


        $patterns[] = "/\\\\begin\{jscodeblock\}/u";
        $replacements[] = '<div class="code-block console-wrap"><div class="code-block code"><code>';
        $patterns[] = "/\\\\end\{jscodeblock\}/u";
        $replacements[] = '</code></div><div  id ="msg" class="msg"></div><div class="console"></div><button class="eval">Run Code!</button><ol class="results"></ol></div>';

        //$patterns[] = "/\\\\CAPTION\s*(.*)/ium";
        //$replacements[] = '<CAPTION> $1 </CAPTION>';
        // $patterns[]="/\\\\TD(.*)\s*/im"; $replacements[]= '<TD>$1</TD>';
        //  $patterns[]="/\\\\TH(.*)/im"; $replacements[]= '<TH> $1 </TH>';
        // disable skips
        $patterns[] = "/\\\\medskip/u";
        $replacements[] = '';
        $patterns[] = "/\\\\tex[^[:alnum:]]\\\\*/u";
        $replacements[] = 'TeX ';
		//amps (If typed escaped for TeX)
		//$patterns[] = "/\\\\&/u";
        //$replacements[] = '&amp;';
		
		
		//quotations
		$patterns[] = "/`(.+)'/u";
        $replacements[] = '"$1"';
		
        $patterns[] = "/\\\\latex\\\\*/u";
		$replacements[] = 'LaTeX ';
        $patterns[] = "/\\\\TM\s*(\d*)(.*)/ium";
        $replacements[] = '<TD colspan="$1"> $2 </TD>';
        $patterns[] = "/\\\\clearpage/u";
        $replacements[] = '<div style="clear:both"></div>';
        $patterns[] = "/\\\\clear\s+/u";
        $replacements[] = '<div style="clear:both"></div>';
		// removes any spacing commands
		$patterns[] = "/\\\\(vspace|hspace)\**\{.*\}/u";
        $replacements[] = '';
		$patterns[] = "/\\\\(hfill)/u";
        $replacements[] = '          ';
		$patterns[] = "/\\\\TeX/u";
		$replacements[]='<span style="font-style:normal">TeX';
        
        $tmp = '<table style="margin:auto; border-collapse:collapse; border-style:none; background-color:transparent; width:auto;" class="cquote">
               <tr>
               <td width="20" valign="top" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:left;padding:10px 10px;vertical-align:top">&ldquo;</td>
               <td valign="top" style="padding:4px 10px;font-family:georgia;font-size:16px;line-height:1.5">';
        $tmp1 = '</td>
       <td width="20" valign="bottom" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:right;padding:10px 10px;vertical-align:bottom">&rdquo;</td>
       </tr>
      </table>';

        $patterns[] = "/\\\\begin{quotation}/ui";
        $replacements[] = $tmp;
        $patterns[] = "/\\\\end{quotation}/ui";
        $replacements[] = $tmp1;
		
		$patterns[]="/\\\\noindent\{(.+)\}/";
		$replacements[]='<p style="text-indent:0pt">'."$1".'</p>';
		
        $patterns[] = "/\\\\LP\{(.+)\}\{(.+)\}\{(.+)\}{(\d+):(.+)}/ui";
        $replacements[] = '$1, <span style="font-style:italic;">$2</span>, London Philatelist, $3, <span style="font-weight:bold">$4</span>:$5';
        $patterns[] = "/\\\\goldblatt\s*\{(.*)\}/uim";
        $replacements[] = 'Goldblatt R., <span style="font-style:italic;">Postmarks of the Cape of Good Hope</span>, Reijger Publishers, Cape Town, 1984 p. $1. ';
        //<hr style="border-bottom:2px solid #6678b1;" />
        $z = preg_replace($patterns, $replacements, $text);
        return $z;
        //\end{figure}
    }

    function yellow($text) {
        // $pattern="/\{\{highlight:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/";
        $pattern = "/\{\{yellow:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/u";
        $z = preg_replace($pattern, '<strong>Author: $1</strong>', $text);
        return $z;
    }

    function author($text) {
        $pattern = "/\{\{author:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Author: $1</p><div style="clear:both"></div>', $text);
        return $z;
    }
	
	// To be removed from final version temporary //
    function corrections($text) {
        //$pattern = "/localhost\/egypt[^-]
        //         /xu";
        $pattern = "/china-stamps/xu";
        $z = preg_replace($pattern, 'china', $z);
        $pattern = "/cyprus-stamps/xu";
        $z = preg_replace($pattern, 'cyprus', $z);
        return $z;
    }

    function corrections_cape($text) {
        $pattern = "/localhost\/capepostalhistory
                 /xu";
        $z = preg_replace($pattern, 'localhost/application-latest/stamp-images/cape-of-good-hope', $text);
        //$pattern="/egypt-stamps
        //      /xu";
        //$z=preg_replace($pattern,'/egypt',$z);

        return $z;
    }
	
	/*  fetches the time from a file
     *  and echoes it
     */
    /*  @param filename filename
     *
     */

   function parseCSS($text) {
        //{{p-bold: will wrap contents with a class called wnatever you want}}
        //{{h1-bold-#head}} id=head class=bold


        $pattern = "/\{\{([[:alnum:]\-\s]+:\s*)+([^[\}]]+)\}\}/xu";
        $pattern = "/\{\{(.*)-*(.*):\s*([[:alnum:]]+)\}\}/xu";
        preg_match_all($pattern, $text, $values);
        //if (isset($values[0])&&($values[1]=NULL)&&isset($values[2])){
        //$z=preg_replace($pattern,'<$1>$3</$1>',$text); return $z;}
        if (isset($values[0]) && isset($values[1]) && isset($values[2])) {
            $z = preg_replace($pattern, '<$1 class="$2">$3</$1>', $text); //echo_array($values);
            return $z;
        }


        return $text;
    }
	
	function block($text) {

        $s = '';
        //Now let us pick up all the blocks on the page
        $pattern = "/\{\{block:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/u";
        $z = preg_match_all($pattern, $text, $values);
        if ($z == FALSE) {
            return $text;
        }
        //loops through all the blocks
        //error checking not strong
        $i = 0;
        foreach ($values[1] as $key => $value) {
            $txt = @file_get_contents($value);
            //echoPRE($txt);break;
            if (isset($txt)) {
                $s[$i] = $txt;
                //we markdown here
                $s[$i] = markdown($txt);
                //$s[$i]=$txt;
                $z = r($values[0], $s, $text);
                $i = $i + 1;
            }
        }

        return $z;
    }

    function html($text) {
        //gets a block from file and loads it into the correct
        //place
        //there can be multiple blocks on a page
        //blocks have their own directory
        //it needs to be extended to search at default directory
        //it will be much easier

        $s = '';
        //Now let us pick up all the blocks on the page
        $pattern = "/\{\{html:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/u";
        $z = preg_match_all($pattern, $text, $values);
        if ($z == FALSE) {
            return $text;
        }
        //loops through all the blocks
        //error checking not strong
        $i = 0;
        foreach ($values[1] as $key => $value) {
            $txt = @file_get_contents($value);
            //echoPRE($txt);break;
            if (isset($txt)) {
                $s[$i] = $txt;
                //we markdown here
                //$s[$i]=markdown($txt);
                $s[$i] = $txt;
                $z = r($values[0], $s, $text);
                $i = $i + 1;
            }
        }

        return $z;
    }
	
	function frac($text) {
        $pattern = "/\\\\frac(\d)(\d)/u";
        $z = preg_replace($pattern, '&frac$1$2;', $text);
        return $z;
        //\end{figure}
    }
	
	function dfn($text) {
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern = "/\{\{dfn:\s*([[:alnum:]\/\)\(\_\=\@\#\$\,\.\-\&\s\'\"\!\.\?\;\:\>\<]+)\}\}/u";
        $z = preg_replace($pattern, '<dfn>$1</dfn> ', $text);
        return $z;
    }
	
	function samp($text) {
        $pattern = "/\{\{samp:\s*([[:alnum:]\/\)\(\[\]\_\=\@\#\$\,\.\-\&\s\'\"\!\.\?\;\:\>\<]+)\}\}/u";
        $z = preg_replace($pattern, '<samp>$1</samp> ', $text);
        return $z;
    }
	// internal link
    function ilink($text) {
        $pattern = "/\\\\ilink\s*\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
                  \{\s*([[:alnum:]\/\)\(\,\.\:\_\-,\$,\&\s\'\"]+)\}/xu";
        $z = preg_replace($pattern, '<a href="../$2">$1</a>', $text);
        return $z;
    }

    // internal link
    function href($text) {
        $pattern = "/\\\\href\s*\{*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\}*
                  \{\s*([[:alnum:]\/\)\(\,\.\:\_\-,\$,\&\s\'\"]+)\}/xu";
        $z = preg_replace($pattern, '<a href="$1">$2</a>', $text);
        return $z;
    }
	
	function credit($text) {
        $pattern = "/\{\{credit\s*:\s*([^\}]*)\}\}/u";
        $success = preg_match_all($pattern, $text, $values);
        $values = explode('|', $values[1][0]);
        $replace = '<div class="credit-image"><a class="credit-image-link" href="">' . $values[0] . '<\/a><\/div>';
        //echo $replace;break;
        $z = str_replace('credit', 'CREDIT', $text);
        return $z;
    }
	
	//changed to include rotated banner if required
    // does not work very well
    function feature($text) {
        //echo $text;
        $pattern = "/\{\{feature:(\s*.*?)\}\}/iusx";
        preg_match_all($pattern, $text, $values);
        $z = preg_replace($pattern, '<div class="rot-ex">$1</div>', $text);
        //returns the values extracted
        $feature = @$values[1][0];
        return $feature;
    }
	   

    // Sublinks rural links for Cyprus villages
    function index($text) {
        $pattern = "/\\\\index\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<a href="../cyprus-postal-history/Village_names">index experiment $1</a><div style="clear:both"></div>', $text);
        return $z;
    }

    function qsingle($text) {
        $tmp = '<table style="margin:auto; border-collapse:collapse; border-style:none; background-color:transparent; width:auto;" class="cquote">
               <tr>
               <td width="20" valign="top" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:left;padding:10px 10px;vertical-align:top">&ldquo;</td>
               <td valign="top" style="padding:4px 10px;font-family:georgia;font-size:16px;line-height:1.5">';
        $tmp1 = '$1 </td>
      <td width="20" valign="bottom" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:right;padding:10px 10px;vertical-align:bottom"></td>
      </tr>
      </table>';
        $pattern = "/\{\{qsingle:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\:]+)\}\}/u";
        $z = preg_replace($pattern, $tmp . $tmp1, $text);
        return $z;
    }

    function file($text) {
        $pattern = "/\{\{file:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/u";
        $z = preg_match_all($pattern, $text, $values);
        //load files from disk
        //echo_array($values);
        foreach ($values[1] as $key => $value) {
            $txt = @file_get_contents($value);
        }
        $s = '<pre class="dotted"><code>';
        //$s=highlight_string($txt);
        $s.=@htmlentities($text);
        $s.='</code></pre>';
        $z = preg_replace($pattern, $s, $text);
        if (!$z == FALSE) {
            return $text = $z;
        } else {
            return $z;
        }
    }
	
	function and_tex($text) {
        $pattern = "/\\\\&/xu";
        $z = preg_replace($pattern, '&', $text);
        return $z;
        //\end{figure}
    }
	
	function begin_center($text) {
        $pattern = "/\\\\begin\{center\}/xu";
        $z = preg_replace($pattern, '', $text);
        return $z;
        
    }
	
	function end_center($text) {
        $pattern = "/\\\\end\{center\}/xu";
        $z = preg_replace($pattern, '', $text);
        return $z;
        
    }
	
	function miscellaneous_gamut ($text) {
	    $this->texcommands [] = 'hline';
		$this->texcommands [] = 'hr';
				
		$z = $this->acute($text);
		$z = $this->author($text);
		$z = $this->yellow($z);
		$z = $this->begin_center($z);
		$z = $this->end_center($z);
		//$z = $this->parseCSS($z); conflicts
		//$z = $this->corrections($z);
		//$z = $this->corrections_cape($z);
		$z = $this->frac($z);
		$z = $this->dfn($z);
		$z = $this->samp($z);
		$z = $this->ilink($z);
		$z = $this->href($z);
		$z = $this->and_tex($z);
		
		//$z = $this->credit($z); conflicts
		$z = $this->samp($z);
		$z = $this->acute($z);
		return $z;
	}
	
	function in_tex_gamut ($text) {
		return ($text);
	}
	
	
    public function startOfFile($text) 
    {
		//return ($text);
		if (filterclass::$in_tex) {
			  return miscellaneous::in_tex_gamut($text);
			} else {
				//echoPRE($text);break;
			  return self::miscellaneous_gamut($text);
		}
	    
        
    }
    
        
}

?>

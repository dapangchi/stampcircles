<?php
/* 
 * @package     PHP5 Wiki Parser
 * @author      Dan Goldsmith
 * @copyright   Dan Goldsmith 2012
 * @link        http://d2g.org.uk/
 * @version     {SUBVERSION_BUILD_NUMBER}
 * 
 * @licence     MPL 2.0
 * 
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. 
 */

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfFile.interface.php');

class Navigation implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
    
    
		
	/** transcribes a link to search for  
     * the entry through wikipedia
     * 
     
    function wikitize($text) {
        //replaces text between {{}} with wiki links
        $pattern = "/\{\{wi:\s*([[:alnum:]]+)\}\}/xu";
        preg_match_all($pattern, $text, $values);
        $pattern = "/[\{|\[][\{|\[]wi:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"]+)[\]|\}][\]|\}]/xu";
        $z = preg_replace($pattern, '<a href="http://localhost/'.SITE_NAME.'/blogs/go/$1">$1</a> ', $text);
        return $z;
    }
	*/
    //lists for menus
    //menu heading
    function menuheading($text) {
        $pattern = "/\\\\menuheading                # command
   \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
   /xu";
        $z = preg_replace($pattern, '<h4 style="background-color:#bbb">$1</h4>', $text);
        return $z;
        //\end{figure}
    }

    function menuitem($text) {
        $z = preg_replace("/                                                                   # puttwo[]{}{}{}
         \\\\menuitem\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                            # optional square brackets
          \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
          \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
          \n\r/xu", '<li><a href="$2" title="$1">$3</a></li>', $text);
        return $z;
    }  

    
    function next($text) {
        //puts a next article as per database
        //or next link
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern = "/\{\{next:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<div style="text-align:right"><a href="#">$1</a></div>', $text);
        return $z;
    }

    function previous($text) {
        //puts a next article as per database
        //or next link
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern = "/\{\{previous:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<div style="text-align:right"><a href="#">$1</a></div>', $text);
        return $z;
    }
	
	function navigation_gamut ($text) {
	    $this->texcommands [] = 'sandbox';
		$this->texcommands [] = 'warning';
		//$z = $this->nutshell ($z);
		//$z = $this->stickynote ($z);
		$z = $this->previous ($text);
		$z = $this->next ($z);
		return $z;
	}
	
	

	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
			  return self::navigation_gamut($text);
		}
	            
    }
    
        
}

?>

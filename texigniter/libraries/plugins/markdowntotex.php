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

class Markdowntotex implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
    
	private $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 
	    “” ‘ ’\/\)°
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´
		\-\&\s\'\"\#\?\%\\\\]*?';
    
    public function __construct()
    {
       
    }
    

    
	
	function sectioning_gamut ($text) {
	    
		return $text;
	}
	
	
	

	function links_reverse_markdown ($text){
		
		$patterns = "/\[(.*)\]\((.*?)\)/um"; 
		
		$replacements = '\href{$2}{$1}';
		$z=preg_replace($patterns,$replacements,$text);
        return $z;
	}
	
	/**
	 *
	 */
	function in_tex_gamut ($text) {
	    //echo 'in tex gamut';
		$z = self::links_reverse_markdown ($text); 
		
	    return $z;
	}
	
    public function startOfFile($text) 
    {
	   if (filterclass::$in_tex) {
			  return self::in_tex_gamut($text);
			} else {
			  return self::sectioning_gamut($text);
		}
	            
    }
    
        
}

?>

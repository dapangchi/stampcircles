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

class Rules implements startOfFile
{
    
        
    public function __construct()
    {
       
    }
   
	// cateing for removing booktabs rules from html
	// at this point we do not care for rendering in html and simply we remove them
	// Jan 2014 modification
	// cmidrule syntax is \cmidrule(lr){2-2}
	// including tables
    function horizontal_rules ($text) {
		$patterns[] = "/\\\\(?:hr|hline)[^e]\s*/ui";
        $replacements[] = '<hr style="border-bottom:2px solid #6678b1;"/>';
		$patterns[] = "/\\\\(toprule|midrule|bottomrule|cmidrule\(*.*\)*)/u";
        $replacements[] = '';
        //this might create a problem, need to parse
        //$patterns[]="/\&/"; $replacements[]='';
		return preg_replace($patterns, $replacements, $text); 
	}
	
	
	
	
	function rules_gamut ($text) {
	    $this->texcommands [] = 'hline';
		$this->texcommands [] = 'hr';
		$z = $this->horizontal_rules($text);
		return $z;
	}
	
	
	
	function in_tex_gamut ($text) {
		return $text;
	}
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return self::in_tex_gamut($text);
			} else {
			  return self::rules_gamut($text);
		}
	    //return self::rules_gamut($line);
        
    }
    
        
}

?>

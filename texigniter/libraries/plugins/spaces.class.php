<?php
/* 
 * @package     TeXifier/Spaces
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

class Spaces implements startOfFile
{
           
    public function __construct()
    {
       
    }
    
	
	public function spaces_gamut ($text) {
		$replacements = array();
		
		
		$patterns[] = "/([a-z]+)\s 				# some word
						\\$(					# followed by another (
						[a-z])		# single letter or bore in bracket 
						\\$
						/xu"; 
		$replacements[] = '<span style="color:blue">$1~\\\\\\\\($2\\\\\\\\)</span> ';
		
		$patterns[] = "/(.+) 				# some word
						(
		                \\\\\\\\           # mathjax inline brackets can also be $
						\(					# followed by another (
						[a-zA-Z0-9\(\)]+		# single letter or bore in bracket 
						\\\\\\\\			# mathjax ending bracket
						\)
						)
						\s           		# ending with a space
						/xu"; 
		$replacements[] = '<span style="color:red">$1~$2 </span> ';
		//same but $
		
		
		$patterns[] = "/([A-Za-z]+)\s([a-zA-Z0-9])([\s.!?])/xu";//and~I
		$replacements[] = '<span style="color:purple">$1~$2 </span> ';
		
		
		
		$z = preg_replace($patterns, $replacements, $text);
		//echoPRE($z);break;
        return $z;
	
	}
	
	public function spaces_gamut_tex ($text) {
				
		$patterns[] = '/\\\\\(/xu'; $replacements[] = '\[';
		$patterns[] = '/\\\\\)/xu'; 
		$replacements[] = '\]';				
		$z = preg_replace($patterns, $replacements, $text);
		//echoPRE($z);
        return $z;
	
	}
		
    public function startOfFile($text) 
    {
	    //filterclass::$in_tex = true;
		if (filterclass::$in_tex) {
		     $z = self::spaces_gamut($text);
			  $z = self::spaces_gamut_tex($text);
				echoPRE($z);//break;
			  return $z;
			} else {
			  return $text;//self::spaces_gamut($text);
		} 
	    //todo lipsum
        
    }
    
        
}

?>

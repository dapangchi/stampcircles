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

class Callout implements startOfFile
{
           
    public function __construct()
    {
       
    }
    
	
	public function callout_gamut ($text) {
		$patterns[] = "/\\\\begin\{callout\}/ux";
		$replacements[] = '<div class="callout">';
		$patterns[] = "/\\\\end\{callout\}/ux";
		$replacements[] = '</div>';
		$z = preg_replace($patterns, $replacements, $text);
        return $z;
	}
		
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
			  return self::callout_gamut($text);
		} 
	    //todo lipsum
        
    }
    
        
}

?>

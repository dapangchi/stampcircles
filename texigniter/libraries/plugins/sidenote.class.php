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

class Sidenote implements startOfFile
{
    
        
    public function __construct()
    {
       
    }
	
	// De La Rue History citions for the tufte-class
    function DLRH($text) {
        $pattern = "/\\\\sidenote\{DLRH:(\d*)\}\s/u";
        $z = preg_replace($pattern, '<span style="font-variant:small-caps;font-size:0.9em"> De La Rue History (page $1) </span>', $text);
		
        return $z;
    }

    function RLII($text) {
        $pattern = "/\\\\RLII\{(\d*)\}\s/u";
        $z = preg_replace($pattern, '<span style="font-variant:small-caps;font-size:0.9em"> Robson Lowe (page $1) </span>', $text);
		
        return $z;
    }
		
	
	
	
	function sidenote_gamut ($text) {
	    $this->texcommands [] = 'DLRH';
		$z = $this->DLRH ($text);
		$z = $this->RLII($z);
		return $z;
	}
	
	function sidenote_to_tex ($text) {
				
	    $patterns[] = "/\\\\sidenote\{DLRH:(\d*)\}\s/u";;
		$replacements [] ='\footnote{See, \textit{The De La Rue History of British and Foreign Postage Stamps, 1855 to 1901}, page $1.} ';
	    
		$patterns[] = "/\\\\ibid\{(\d*)\}\s/u";
		$replacements [] ='\footnote{\textit{Ibid.}, page $1.} ';
		
		$patterns[] = "/\\\\RLII\{(\d*)\}\s/u";
		$replacements [] ='\footnote{Robson Lowe, The Encyclopaedia of British Empire Postage Stamps: Africa, page $1.}';
		return preg_replace($patterns, $replacements, $text);
	}
	
	
	
	public function startOfFile($text) 
    {
	
		if (filterclass::$in_tex) {
			  $text = self::sidenote_to_tex($text);
			  return $text;
			} else {
			  return self::sidenote_gamut($text);
		}
	            
    }
    
        
}

?>

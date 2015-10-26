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

class Philatelic implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
    
    
	 function postmark($text) {
        $pattern = "/\\\\postmark\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"\>\<\/\\\\\;]+)\}/xu";
        $z = preg_replace($pattern, '<span style="font-weight:bold">$1 </span>', $text);
        return $z;
    }

    
    function ship($text) {
        $pattern = "/\\\\ship\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<span style="font-style:italic;">$1</span>', $text);
        return $z;
    }
   

    // Sublinks rural links for Cyprus villages
    function rural($text) {
        $pattern = "/\{\{rural\}\}/u";
        $z = preg_replace($pattern, '<a href="../cyprus-postal-history/Village_names">Rural cancellations</a><div style="clear:both"></div>', $text);
        return $z;
    }
	
	function tete($text) {
        $pattern = "/\\\\tete/xu";
        $z = preg_replace($pattern, '<span style="font-style:italic">t&#234;te-b&#234;che</span>', $text);
        return $z;
        //\end{figure}
    }
    
    function aland($text) {
        $pattern = "/\\\\aland\;/xu";
        $z = preg_replace($pattern, '&#197;land ', $text);
        return $z;
        //\end{figure}
    }

    function cote($text) {
        $pattern = "/\\\\cote/xu";
        $z = preg_replace($pattern, 'C&#244;te d\'Ivoire ', $text);
        return $z;
        //\end{figure}
    }
	 // generic item for postal history items
    // enter as \gb{image file}{description} special for great britain
    function gb($text) {
        $pattern = "/\\\\gb\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/u";
        $z = preg_replace($pattern, '<div style="width:90%;" class="center">
               <img src="/stamp-images/greatbritainstamps/$2"
               style="width: $1;" class="center"/>
               <p class="small">$3</p>
               </div>', $text);
        return $z;
    }
	
	function philatelic_gamut ($text) {
	    $this->texcommands [] = 'sandbox';
		$this->texcommands [] = 'warning';
		//$z = $this->nutshell ($z);
		//$z = $this->stickynote ($z);
		$z = $this->rural ($text);
		$z = $this->ship ($z);
		$z = $this->postmark ($z);
		$z = $this->tete ($z);
		$z = $this->aland ($z);
		$z = $this->cote ($z);
		$z = $this->gb ($z);
		
		return $z;
	}
	
	

	
    public function startOfFile($line) 
    {
	 //filterclass::$in_tex = true;
	    if (filterclass::$in_tex) {
			  return $line;
			} else {
			  return self::philatelic_gamut($line);
		}
	
	    //return self::philatelic_gamut($line);
        
    }
    
        
}

?>

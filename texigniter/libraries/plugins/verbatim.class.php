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

class Verbatim implements startOfFile
{
           
    public function __construct()
    {
       
    }
    function verbatim_begin($text) {
        $pattern = "/\\\\begin\{verbatim\}/xu";
        $z = preg_replace($pattern, '<div class="no-mathjax" style="white-space:pre;font-size:small">', $text);
        return $z;
    }

    function verbatim_end($text) {
        $pattern = "/\\\\end\{verbatim\}/xu";
        $z = preg_replace($pattern, '</div>', $text);
        return $z;
    }
	
    function verbatim_gamut($text) {
        $z = $this::verbatim_begin($text);
        $z = $this::verbatim_end($z);
       return $z;
    }
	
		
    public function startOfFile($line) 
    {
	    return self::verbatim_gamut($line);
        
    }
           
}

?>

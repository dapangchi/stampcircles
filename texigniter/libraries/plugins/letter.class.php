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
include_once('markdown.php');

class Letter implements startOfFile
{
    public static $regex_allowed_chars = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 
	    “” ‘ ’\/\)°
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´
		\-\&\s\'\"\#\?\%\\\\]*';
        
    public function __construct()
    {
       
    }
    /**
	 * Letter display methods
	 * called through the filter as letter_gamut.
	 *
	**/
	
	public function salutation ($text) {
	    $this->texcommands[] = 'salutation';
		$pattern = '/\\\\(?:salutation|opening)\s*\{('.self::$regex_allowed_chars.')\s*\}/xu';
        $z = preg_replace($pattern, "<p style=\"width:95%\" class=\"salutation\">".
								"<span class=\"salutation\">$1</span></p>", $text);
        return $z;
	}
	
	public function signature ($text) {
		$pattern = '/\\\\(?:signature|closing)\s*\{('.self::$regex_allowed_chars.')\s*\}/xu';
        $z = preg_replace($pattern, "<p></p><p class=\"closing\"><span class=\"closing\">$1</span></p><div style=\"clear:both\"></div>", $text);
        return $z;
	}
	
	public function signatureR ($text) {
		$pattern = '/\\\\(?:SignatureR)\s*\{('.self::$regex_allowed_chars.')\s*\}/xu';
        $z = preg_replace($pattern, "<p></p><p style=\"width:99%\"><span class=\"closing\">$1</span></p><div style=\"clear:both\"></div>", $text);
        return $z;
	}
	
	public function refnumber ($text) {
		$pattern = '/\\\\refnumber\s*\{('.self::$regex_allowed_chars.')\s*\}/xu';
        $z = preg_replace($pattern, "<p style=\"width:95%\" class=\"salutation\"><span class=\"salutation\">$1</span></p>", $text);
        return $z;
	}
	
	public function refdate ($text) {
		$pattern = '/\\\\refdate\s*\{('.self::$regex_allowed_chars.')\s*\}/xu';
        $z = preg_replace($pattern, "<div class=\"refdate\" style=\"margin:1em\"><span class=\"refdate\">$1</span></div><div style=\"clear:both;margin-bottom:1em\"></div>", $text);
        return $z;
	}
	
	public function beginletter ($text) {
		$pattern = '/\\\\begin\s*\{letter\}/xu';
        $z = preg_replace($pattern, "<div class=\"letter\" style=\"width:90%;margin-left:50px;padding-right:20px\">", $text);
        return $z;
	}
	
	public function endletter ($text) {
		$pattern = '/\\\\end\{letter\}/xu';
        $z = preg_replace($pattern, "</div>", $text);
        return $z;
	}
	
	// We need to call markdown otherwise the indenting of the letters results
	// in problems down the line.
	public function markdown_ini ($text) {
	    $pattern = '/\&/xu';
        $z = preg_replace($pattern, "ZZZ", $text);
		$z = markdown($z);
		
		
		$pattern = '/\\\\/xu';
        $z = preg_replace($pattern, "BACKSLASH", $text);
		
		$pattern = '/ZZZ/xu';
		$z = preg_replace($pattern, '&', $z);
		$pattern = '/BACKSLASH/xu';
		$z = preg_replace($pattern, '\\', $z);
		
       return $z;
	}
	
	
	
	function letter_gamut ($text) {
		$this->texcommands [] = 'refdate';
		$this->texcommands [] = 'refnumber';
		$this->texcommands [] = 'signature';
		$this->texcommands [] = 'salutation';
		
		$z = $this->markdown_ini ($text);
		//$z  = markdown($z);  //affects & in tables need to protect
		//echo $z;
		
		$z = $this->refdate ($z);
		$z = $this->salutation($z);
		$z = $this->refnumber ($z);
		$z = $this->refnumber ($z);
		$z = $this->signature ($z);
		$z = $this->signatureR ($z);
		$z = $this->beginletter ($z);
		$z = $this->endletter ($z);
		return $z;
	
	}
	
	 
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
				return self::letter_gamut($text);
        }
    }
    
        
}

?>

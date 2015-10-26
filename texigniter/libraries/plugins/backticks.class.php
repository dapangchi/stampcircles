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
require_once(dirname(__FILE__) . '/../interface/preParsing.interface.php');

class Backticks implements startOfFile
{
    use Regex;       
    public function __construct()
    {
       
    }
    
	
	public function backticks_tex_gamut ($text) {
		$pattern = "/`(".self::codeRegex().")`/u";
		$z = preg_replace($pattern, '\protect\verb+'."$1 +", $text);
        return $z;
	
	}
	
	public function backticks_gamut ($text) {
		$pattern = "/`(".self::codeRegex().")`/u";
		$z = preg_replace_callback($pattern, array($this, 'backticks_callback'),$text);
        return $z;
	}
	
	function backticks_callback ($values){
	    //echo_array($values);
		if(!empty($values)) return  '<code style="display:inline;padding:0pt;background:transparent;border:0pt;font-size:0.9em" class="backticks-code">'.htmlspecialchars($values[1]).'</code>';
		
	}
	
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return self::backticks_tex_gamut($text);
			} else {
			  return self::backticks_gamut($text);
		} 
	    //todo lipsum
        
    }
    
        
}

?>

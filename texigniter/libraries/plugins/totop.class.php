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

class Totop implements startOfFile
{
    use Regex;       
    public function __construct()
    {
       
    }
    
	
	public function toTop ($text) {
		$pattern = "/\\\\totop/uix";
		$z = preg_replace($pattern, '<a href="#content" class="anchor-up-link"><i class="icon-small icon-arrow-up"> Back to top</i></a>', $text);
        return $z;
	
	}
	
		
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
			  return self::toTop($text);
		} 
	    //todo lipsum
        
    }
    
        
}

?>

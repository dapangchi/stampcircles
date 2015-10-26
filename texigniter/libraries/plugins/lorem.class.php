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

class Lorem implements startOfFile
{
           
    public function __construct()
    {
       
    }
    
	
	public function lorem_gamut ($text) {
		$patterns[] = "/\\\\lorem/u";
		$replacements[] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nibh justo, dictum sed cursus ac, lobortis et lacus. Vestibulum vitae justo enim. Quisque laoreet elementum felis, ut sodales arcu viverra a. Sed molestie odio vulputate sem rutrum a sagittis est rutrum. Morbi dapibus hendrerit magna, sit amet commodo massa posuere sit amet. Duis pharetra quam scelerisque est lobortis fringilla. Maecenas venenatis feugiat lectus, vel facilisis odio pharetra quis. Etiam at nisl eros, sit amet suscipit lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed augue nunc, ornare eget congue sit amet, laoreet vel augue. Morbi vel justo quis ipsum adipiscing egestas vitae non est. Vivamus ac quam quam. Nullam pharetrainterdum mauris, rutrum pulvinar ligula condimentum id. Donec et blandit lorem. ';
		$patterns[] = "/\\\\captionlorem/u";
		$replacements[] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nibh justo,  et blandit lorem. ';
		$z = preg_replace($patterns, $replacements, $text);
        return $z;
	
	}
	
	
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
			  return self::lorem_gamut($text);
		} 
	    //todo lipsum
        
    }
    
        
}

?>

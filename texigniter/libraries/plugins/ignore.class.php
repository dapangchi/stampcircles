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

/*
 * Ignores TeX/LaTeX commands that are not used
 * in html
 *
 */

class Ignore implements startOfFile
{
    use Regex;       
    public function __construct()
    {
       
    }
    
	//Need to protect in if is in verbatim (need refactoring)
	function ignore_gamut ($text) {
	    $ignore_commands = ['centering', 'hfil','hfill',
		                     'bf','tt','indent','noindent',
							'hspace\**',
		                    'begin\{document\}',
							'end\{document\}',
							'clear',
							'protect'
				]; 
	    foreach ($ignore_commands as $command) {
		  $patterns[]="/[^>`](\\\\".$command."\s*)/ux";
		  $replacements[] = '';
		 }
        $z=preg_replace($patterns,$replacements,$text);
        return $z;
	}
	
	
		
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
			  return self::ignore_gamut($text);
		} 
	    //todo lipsum
        
    }
    
        
}

?>

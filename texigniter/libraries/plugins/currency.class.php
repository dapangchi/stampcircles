<?php
/* 
 * 	@application TeXifier
 * 	@plugin      Currency
 * 	@author      Dr Y Lazarides
 * 	@copyright   Dr Y Lazarides 2013
 * 	@link        
 * 	@version     1.01 
 * 				 17 August 2013
 * 	@licence     MPL
 * 
 * 	This Source Code Form is subject to the terms of the Mozilla Public
 * 	License, v. 2.0. If a copy of the MPL was not distributed with this
 * 	file, You can obtain one at http://mozilla.org/MPL/2.0/. 
 *	
 *	Makes TeX like commands available in the browser and transforms
 *	unicode currency symbols to their equivalent LaTeX commands before
 *	the file is processed by LaTeX.
 *  
 */

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfFile.interface.php');

/**
 *	We define some spaces for general use
 *	This is incomplete and we need to get performance as \xspace for
 *  the browser and TeX alike.
 */
define('HAIRSPACE','&#8202;');
define('THINSPACE','&#8239;');
define('SPACE',' ');

class Currency implements startOfFile
{
    
        
    public function __construct()
    {
       
    }
	/**
	 *  All currencies are changed to html entities. 
	 *	1. Thinspaces - We also capture
	 *		what follows and add a thin space between the symbol and the
	 *		value.
	 *  2. All commands are provided also with a plural form, i.e., euro|euros.
	 *
	 *
	 */ 
	
    static $punctuation_symbols = array('.',';','!',':',',','?','¡','¿');

	
    function halfd($text) {
        $pattern = "/\\\\half\s*(..)/xu";
        $z = preg_replace($pattern, '&#189;'.HAIRSPACE.'$1$2', $text); //html entity 1/2
        return $z;
    }
	/** TODO punctution similar to xspace not working fully**/
	
	function make_currency_html ($text, $command, $entity) {
		$pattern = '/(.)				#check for one digits before \1
		             (\s*)          	#capture and spaces before   \2
		             ('.$command.')	#star check for plural command \3
					 [^e](\s*)           #4 gives problem with centering!
					 ([^.\}\s]*)		#check if followed by number \5
					 (\s*)
					 ([[:punct:]]*)     #capture punctuation \7
					/xu';
		$z = preg_replace_callback($pattern, array($this,'make_currency_html_callback'), $text);
		$pattern = '/('.$command.'*)/u';
		//replaces the command less complicated callbacks.
		$z = preg_replace ($pattern, $entity, $z);
		
		if ($z) return $z; else return $text;
	}
		
	function make_currency_html_callback ($values) {
		//echo_array($values);
		//if there is no number before the sign add one space.
		(!is_numeric($values[1]))? $before = $values[1].$values[2].SPACE: //only one normal space 
																		  //after it.
								   $before = $values[1].THINSPACE;        // 52\thinspace numeric
		//if there is a number after and is not punctuation add thin space.
		// logical error somewhere here
		(!is_numeric($values[5]))? $after = '': // can be letter
								   $after = '';		//do nothing still need to check for .
								   
								   // 52\thinspace
		
		(in_array($values[7], self::$punctuation_symbols))? 	
		            $result = $before. // before
					$values[3].       // command
					$values[4].
					$values[5].$after.
					$values[7]:
							$result = $before.$values[3].$values[4].$values[5].
							   ' ';
		return $result;
	}
	
	function fix_currency_spacing ($text, $command) {
		$pattern = '/(.)				#check for one digits before \1
		             (\s*)          	#capture and spaces before   \2
		             ('.$command.'*)	#star check for plural command \3
					 (\s*)              #4
					 ([^.\} ]*)			#check if followed by number \5
					 (\s*)
					 ([[:punct:]]*)     #capture punctuation \7
					/xu';
		$z = preg_replace_callback($pattern, array($this,'add_thin_spaces_tex_callback'), $text);
		
		//break;
		return $z;
	}
	
    function add_thin_spaces_tex_callback ($values) {
		//echo_array($values);
		//if there is no number before the sign add one space.
		(!is_numeric($values[1]))? $before = $values[1].$values[2].'\space': //only one normal space 
																		  //after it.
								   $before = $values[1].'\thinspace';        // 52\thinspace numeric
		//if there is a number after and is not punctuation add thin space.
		// logical error somewhere here
		(!is_numeric($values[5]))? $after = ' ': // can be letter
								   $after = ' ';		//do nothing still need to check for .
								   
								   // 52\thinspace
		
		(in_array($values[7], self::$punctuation_symbols))? 	
		            $result = $before. // before
					$values[3].       // command
					$values[4].
					$values[5].$after.'\xspace'.
					$values[7]:
							$result = $before.$values[3].$values[4].$values[5].
							   'space';
		return $result;
	}
   
	
	function ore ($text) {
		$patterns[] = "/\\\\ore/u";
        $replacements[] = '&oslash;re';
		return preg_replace($patterns, $replacements, $text);
	}
	
	
	function currency_gamut ($text) {
	    
		$z = $this->halfd ($text);
		// as the \cent command will conflict with \centering
		// we fence it.
		$z = preg_replace ('/\\\\center[ing]*/u','zzCENTERINGzz', $z);
		$z = $this->make_currency_html ($z, '\\\\cents', '&cent;');
		$z = $this->make_currency_html ($z, '\\\\euros', '&euro;');
		$z = $this->make_currency_html ($z, '\\\\pounds', '&pound;');
		$z = $this->make_currency_html ($z, '\\\\yuans', '¥');
		$z = $this->ore ($z);
		// unfence the \centering command.
		$z = preg_replace ('/zzCENTERINGzz/u','\\\\centering', $z);
		
		return $z;
	}
	
	function make_currency_tex ($text, $symbol, $command) {
		$patterns = '/(\d*)\s*('.$symbol.')\s*(\d*)/u';
        
		$z = preg_replace_callback($patterns, array($this,'make_currency_tex_callback'), $text);
		$z = preg_replace('/zzCOMMANDzz/u',$command.'', $z);
		return $z;
	}
	
	function make_currency_tex_callback ($values) {
		//echo_array($values);break;
		// if there are digits before insert a thinspace
		($values[1] !=' ')? $before = $values[1].' ': $before=' ';
		// insert a fence to replace with command when back
		$after = ' '.'zzCOMMANDzz'.$values[3];
		return $before.''.$after;
		
	}
	// needs one more pass to handle thin spaces via TeX
	// currently it will have to be inserted by hand.
	function in_tex_gamut ($text) {
	    return ($text); //need to fix
		$patterns[] = "/\\\\ore/u";
        $replacements[] = '\o re';
		$text = preg_replace($patterns, $replacements, $text);
		
		// call with plural
		//$text = $this->make_currency_tex($text,'£','\pound');  //check for AAA
		$text = $this->make_currency_tex($text,'¥','\yuan');
		$text = $this->make_currency_tex($text,'€','\euro');
		$text = $this->make_currency_tex($text,'¢','\textcent');
		$text = $this->make_currency_tex($text,'₩','\textwon');
		
		$text = self::fix_currency_spacing ($text, '\\\\euro');
		
		
		
		
		return ($text);
	}
	
	
    public function startOfFile($text) 
    {
	    
		if (filterclass::$in_tex) {
			  return self::in_tex_gamut($text);
			} else {
			  return self::currency_gamut($text);
		}
		
        
    }
    
        
}
//TODO all commands as typed by user have a \command eats spaces in TeX
?>

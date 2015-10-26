<?php
/* 
 * @package     PHP5 TeXifier
 * @author      Y Lazarides
 * @copyright   Y Lazarides 2014
 * 
 * 
 * @licence     MPL 2.0
 * 
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. 
 *
 *  TODO socket_accept
 */
 
require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');
require_once(dirname(__FILE__) . '/../interface/preParsing.interface.php');//traits are here

class Lists implements  startOfFile
{
    use Regex;
    const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       //echo $this->sayHello();break; Learning Traits
	   //echo $this->allowedCharacters();break;
	    //
    }
    /**
	 *	draws a plate based on data inputs.
	**/
		
	
	
	function beginitemize($text) {
        $pattern = "/\\\\begin\{itemize\}/xu";
        $z = preg_replace($pattern, '<ul style="margin-left:0px;width:450px" >', $text);
        return $z;
       
    }

    function enditemize($text) {
        $pattern = "/\\\\end\{itemize\}/xu";
        $z = preg_replace($pattern, '</ul>', $text);
        return $z;
       
    }

	/*
	 *	Generic commands to make enumerated environments
	 *  @text: text to be transformed
	 *	@type: type of list (decimal, alpha, Alpha  etc.)
	 *  @class: class to be inserted in HTML
	 *
	 */
    function makeBeginEnumerate ($text, $type='' , $class='') {
		$pattern = '/\\\\begin\{'.$type.'\}/xu';
        $z = preg_replace($pattern, '<ol class="'. $class. ' ">', $text);
        return $z;
	}
	
	function makeEndEnumerate($text, $type) {
        $pattern = "/\\\\end\{".$type."\}/xu";
        $z = preg_replace($pattern, '</ol>', $text);
        return $z;
       
    }
	
	function makeEnumerate ($text, $type, $class) {
		$text = self::makeBeginEnumerate ($text, $type, $class);
		return self::makeEndEnumerate ($text, $type);		
	}
	
    

	//This should be a definition list in HTML maybe semantically more correct.	
	function begindescription($text) {
        $pattern = "/\\\\begin\{description\}/xu";
        $z = preg_replace($pattern, '<ul class="description">', $text);
        return $z;
       
    }

    function enddescription($text) {
        $pattern = "/\\\\end\{description\}/xu";
        $z = preg_replace($pattern, '</ul>', $text);
        return $z;
       
    }
	
	
	/**
	 *	Items have the form \item[] with the [] being an 
	 *  optional bracket.
	**/
    function item($text) {
	    $regex_square_bracket = '\[(.*)\]';
        $patterns []  = "/\\\\item\s*" .
                $regex_square_bracket
                ."
                 ([[:alnum:][:punct:][:blank:]\\ ]*)
                /uxm";
		$replacements [] = 	'<li><strong>$1</strong>  $2 </li> ';
		$patterns []  = "/\\\\item\s*
                 ([[:alnum:][:punct:][:blank:]\\ ]*)
                /uxm";
		$replacements [] = 	'<li>$1</li> ';	
        $z = preg_replace($patterns, $replacements, $text);
        if($z) return $z;
  		  else return $text;
        
    }
	
	/*
	 *  Main method for parsing lists
	 *
	 */
	function lists_gamut ($text) {
	   	// itemized lists
		$z = self::beginitemize($text);
		$z = self::enditemize ($z);
		// description lists
		$z = $this->begindescription ($z);
		$z = $this->enddescription ($z);
		// enumerated lists
		$z = self::makeEnumerate($z, 'enumerate', 'enumerate');
		$z = self::makeEnumerate($z, 'loweralpha', 'lower-alpha');
		$z = self::makeEnumerate($z, 'upperalpha', 'upper-alpha');
		$z = self::makeEnumerate($z, 'lowerroman', 'lower-roman');
		$z = self::makeEnumerate($z, 'upperroman', 'upper-roman');
		$z = self::makeEnumerate($z, 'leadingzero', 'decimal-leading-zero');
		$temp = 'makeEnumerate';
		$z = self::{$temp}($z, 'decimal', 'decimal');
		$z = $this->item ($z);
		return $z;
	}
	
	
   
     public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
				return self::lists_gamut($text);
        }
    }
        
}

?>










    
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
include_once('markdown.php');

class Environments implements startOfFile
{

	private $regex_optional_square_bracket = '
			\[* 											# optional square brackets
	            ([^\]]*?)									# any character except a square bracket
			\]*												# end optional brackets
			\s{1} 											#1 terminate with a space ';
    //const regular_expression = '/^(\\\\LL\s*)$/';
    public $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 
	    “” ‘ ’\/\)°
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´
		\-\&\s\'\"\#\?\%\\\\]*';
		
    public function __construct()
    {
       
    }
	
    	
	
	function blockquote ($text) {
	   $this->environments[] = 'blockquote'; // pushes into available environments
	   $z = $this->blockquote_begin ($text);
	   $z = $this->blockquote_end ($z);
	   return $z;
	}
	
	function blockquote_begin($text) {
		return $this->create_begin_environment ( 'blockquote', 'blockquote_callback', $text);
     }
	
	/**
	 *	Callback for blockquotes
	 *	The square bracket is optional, hence check
	 *	for four possibilities.
	 * 
	 *	   - user has supplied one of the default classes
	 *     - user has omitted the square bracket
	 *     - user has suplied an empty square bracket
	 *     - user supplied a custom class
	 *     - 1.1.14 changed to blockquote to accept multi-paragraphs
	**/ 
	function blockquote_callback ($values) {
		//echo_array ($values);
		$allowed_classes = array("shadow", "line", "letter", "plain", "quotes");
			if (in_array($values[1], $allowed_classes)) {
				return '<blockquote class="'.$values[1].'">';
			} else if (isset($values[1]) && ( !empty($values[1]) ) ) {
					return '<blockquote class="'.$values[1].'">';
				}
			else {
				return '<blockquote>'; //empty value or no []
			}
	}
	
	function blockquote_end ($text){
	    $z = $this->create_end_environment ('blockquote', '</blockquote>', $text); 
		return $z;
	}
	
	/*
		Verse and alltt environments
	*/
	
	function alltt ($text) {
	   $this->environments[] = 'alltt'; // pushes into available environments
	   $z = $this->alltt_begin ($text);
	   
	   $z = $this->alltt_end ($z);
	   return $z;
	}
	
	function alltt_begin($text) {
		return $this->create_begin_environment ( 'alltt', 'alltt_callback', $text);
     }
	
	/**
	 *	Callback for alltt
	 *	The square bracket is optional, hence check
	 *	for four possibilities.
	 * 
	 *	   - user has supplied one of the default classes
	 *     - user has omitted the square bracket
	 *     - user has suplied an empty square bracket
	 *     - user supplied a custom class
	 *
	**/ 
	function alltt_callback ($values) {
		//echo_array ($values);
		$allowed_classes = array("alltt");
			if (in_array($values[1], $allowed_classes)) {
				return '<blockquote class="'.$values[1].'">';
			} else if (isset($values[1]) && ( !empty($values[1]) ) ) {
					return '<blockquote class="'.$values[1].'">';
				}
			else {
				return '<blockquote>'; //empty value or no []
			}
	}
	
	function alltt_end ($text){
	    $z = $this->create_end_environment ('alltt', '</blockquote>', $text); 
		return $z;
	}
	
		
	
	/**
	 *  Generic method for creating end environment
     *  Takes @$environment_name
     *  returns 	 
	**/
	public function create_end_environment ($environment_name, $replacement, $text) {
	    $pattern = "/\\\\end\{*".$environment_name."\}*/u";
        $z = preg_replace($pattern, $replacement, $text);
        return $z;
	}
	
	public function create_begin_environment ($environment_name, $method, $text) {
	
	    $pattern = "/\\\\begin\{*".$environment_name."\}*".$this->regex_optional_square_bracket.'/xu';
        $z = preg_replace_callback($pattern, array($this,$method), $text);
        return $z;
    }
	
	function block_quote_tex ($text) {
		
	
	}
	
	// capture blocks
	public function capture_environment ($environment_name, $method, $text) {
	    $pattern = "/\\\\begin\{blockquote\}(".$this->regex_allowed_chars_in_text.")\\\\end\{blockquote\}/mxu";
		   	$z = preg_replace_callback($pattern, array($this,'environment_callback'), $text);
		 return $z;
    }	

	function environment_callback ($values) {
	    //echo_array($values);;
		//echo_array ($values);
		return '<div style="font-size:smaller;font-family:Georgia;width:90%;margin-left:1em">'.markdown($values[1]).'</div>';
		$allowed_classes = array("environment");
			if (in_array($values[1], $allowed_classes)) {
			    return "CAPTURED";
				//return '<blockquote class="'.$values[1].'">';
			} else if (isset($values[1]) && ( !empty($values[1]) ) ) {
			        return 'CAPTURED';
					//return '<blockquote class="'.$values[1].'">';
				}
			else {
			    return 'CAPTURED'; 
				//return '<blockquote>'; //empty value or no []
			}
			
	}	
		
			
    public function startOfFile($text) 
    {
	    if (filterclass::$in_tex) {
			  return $text;
			} else {
			   //$z = self::capture_environment('blockquote','environment',$text);
			   $z = self::blockquote($text);
			   $z = self::alltt($z);
			  return $z;
		} 
		//return self::blockquote($line);
        
    }
}

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

class Sectioning implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
    
	private $regex_allowed_chars_in_text = '[
			[:alnum:]
			\p{L}
			\p{N}
			\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 
	    “” ‘ ’\/\)°
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´\-‘’
		\-\&\s\'\"\#\?\%\\\\]*';
    
    public function __construct()
    {
       
    }
    function chapter($text) {
        $pattern = "/\\\\chapter\**\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]*)*\]*
		    \{\s*(".$this->regex_allowed_chars_in_text.")
			\} /xu";
        $z = preg_replace($pattern, '<h2 class = "chapter" >$2</h2>', $text);
        return $z;
    }

    function section($text) {
        $pattern = "/\\\\section\**\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]*)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\!\_\-\&\s\'\"\?‘’]+)\}/xu";
        $z = preg_replace($pattern, '<h3 class="section"  style="text-align:center;clear:both">$2</h3>', $text);
        return $z;
    }

    function subsection($text) {
        $pattern = "/\\\\subsection\**\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
            \{
               \s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"\\\\ ]+)
             \}/xi";  # Anything up to second brackets
        $z = preg_replace($pattern, '### $2', $text);
        return $z;
    }

    function subsubsection($text) {
        $pattern = "/\\\\subsubsection\**\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-,\$,\&\s\'\"]+)\}/xu";
        $z = preg_replace($pattern, '#### $2', $text);
        return $z;
    }
	
	function heading($text) {
        $pattern = "/\\\\heading\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]*)\}/u";
        $z = preg_replace($pattern, '<h4 style="text-align:center">$1</h4>', $text);
        return $z;
    }
	
	function sectioning_gamut ($text) {
	    $this->texcommands [] = 'subsubsection';
		$this->texcommands [] = 'section';
		$this->texcommands [] = 'chapter';
		$this->texcommands [] = 'subsection';
		$this->texcommands [] = 'heading';
		$z = $this->chapter ($text);
		$z = $this->section ($z);
		$z = $this->subsection ($z);
		$z = $this->subsubsection ($z);
		$z = $this->heading ($z);
		return $z;
	}
	
	function chapter_reverse_markdown ($text){
		$patterns[]="/^\#\s*(.+)\n/um"; $replacements[]= '\chapter{$1} ';
		$z=preg_replace($patterns,$replacements,$text);
        return $z;
	}

	function section_reverse_markdown ($text){
	    
		$patterns[]="/^\#\#\s*(.+)\n/um"; $replacements[]= '\section{$1} ';
		$z=preg_replace($patterns,$replacements,$text);
        return $z;
	}

	function subsection_reverse_markdown ($text){
		$patterns[]="/^\#\#\#\s*(.+)\n/um"; $replacements[]= '\subsection{$1} ';
		$z=preg_replace($patterns,$replacements,$text);
        return $z;
	}

	function subsubsection_reverse_markdown ($text){
		$patterns[]="/^\#\#\#\#\s*(.+)\n/um"; $replacements[]= '\subsubsection{$1} ';
		$z=preg_replace($patterns,$replacements,$text);
        return $z;
	}
	
	/**
	 *	All sectioning commands would work fine
	 *	in LaTeX, so we just don't call them if
	 *  we are processing the files for LaTeX.
	 *  We transclude any markdown mark-up though.
	 *
	 */
	function in_tex_gamut ($text) {
	    echo 'in tex gamut';
		$z = self::subsubsection_reverse_markdown ($text); //####
		$z = self::subsection_reverse_markdown ($z); //###
		$z = self::section_reverse_markdown ($z); //##
		$z = self::chapter_reverse_markdown ($z); //#
	    return $z;
	}
	
    public function startOfFile($text) 
    {
	   if (filterclass::$in_tex) {
			  return self::in_tex_gamut($text);
			} else {
			  return self::sectioning_gamut($text);
		}
	            
    }
    
        
}

?>

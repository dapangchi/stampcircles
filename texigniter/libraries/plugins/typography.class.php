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

class Typography implements startOfFile
{
    
        
    public function __construct()
    {
       
    }
    function smallcaps($text) {
        $pattern = "/\\\\textsc\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\?\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<span style="font-variant:small-caps;font-size:0.9em">$1</span>', $text);
        return $z;
    }

    function textit($text) {
        $pattern = "/\\\\textit\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<span style="font-style:italic;">$1</span>', $text);
        return $z;
    }
	
	function textbf($text) {
        $pattern = "/\\\\textbf\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<span style="font-weight:bold;">$1</span>', $text);
        return $z;
    }
	 
	function ldots ($text) { 
		$pattern = "/\\\\ldots/u";
        return preg_replace($pattern, '&hellip;', $text);
	}	
	
	function newthought ($text) {
		$pattern = "/\\\\newthought\{(.*)\}/u";
		$replacement = '<em class="newthought" style="font-variant:small-caps;font-style:normal;" >$1</em>';
		return preg_replace($pattern, $replacement, $text);
	}
	
	/**
	 *	Dashes are also used to denote sections in markdown and other
	 *  mark-up processors such as reStructuredText, so we need to protect them
	 *	first for later processing by the markdown processor.
	 *	4-dashes also represent an </hr> line in some mark-up systems.
	 */
	function dashes ($text) {
		$patterns[]="/(^\-\-\-\-[^-])/xu";		#Last character cannot be a dash
		$replacements[]='HRHRHRHR';
		$patterns[]="/(\-\-\-\-+)/xu";			#headings
		$replacements[]='HHEADING$1HHEADING';
		$patterns[]="/(\-\-\-)+/xu";			
		$replacements[]='&mdash;$2';
        $patterns[]="/(\-\-)/";    
		$replacements[]='&ndash;'; 
        
		$z = preg_replace($patterns, $replacements, $text);
		$z = preg_replace("/HRHRHRHR/ux", '----', $z);
		$z = preg_replace("/HHEADING(.*?)HHEADING/ux", '------', $z);
		return $z;
	  //return $text;
	}
	
	// this function returns the html for a dropcap
	function lettrine ($text) {
	    $pattern = '/\\\\lettrine\{(.*)\}\{(.*)\}/ux';
	    $replace = '<span class="dropcap">$1</span><span style="font-variant:small-caps">$2</span>';
		return preg_replace ($pattern, $replace, $text );
	}
	
	// some words need to be lower-case. This is just a productivity command
	//
	function penny ($text) {
	    $patterns[] = '/PENNY/ux';
		$replacements [] ='<span style="font-size:smaller;">PENNY</span>';
		$z = preg_replace($patterns, $replacements, $text);
		return $z;
	}
	
	
	// some words need to be bold font (stationery). This is just a productivity command
	//
	function CP_numbers ($text) {
	    $patterns[] = '/(CP)(\d\d*)/ux';
		$replacements [] ='<span style="font-weight:bold;">$1 $2</span>';
		$z = preg_replace($patterns, $replacements, $text);
		return $z;
	}
	
	function typography_gamut ($text) {
	    $this->texcommands [] = 'smallcaps';
		$this->texcommands [] = 'textit';
		$this->texcommands [] = 'textbf';
		
		$z = $this->penny ($text);
		$z = $this->CP_numbers ($z);
		$z = $this->smallcaps ($z);
		$z = $this->textit ($z);
		$z = $this->textbf ($z);
		$z = $this->ldots ($z);
		$z = $this->dashes ($z);
		$z = $this->newthought($z);
		$z = $this->lettrine($z);
		return $z;
	}
	
	function utf_to_tex ($text) {
		$patterns[]="/\<hr\/\>/ux";    
		$replacements[]='\hline'; 
		
		$patterns[]="/\x{2014}/ux";    
		$replacements[]='---';   
		
		$patterns[]="/–/x";    
		$replacements[]='--'; 
		
	    $patterns[] = '/(d)*\s*1\/2/ux';
		$replacements [] ="$1\$\\frac{1}{2}\$";
	    return preg_replace($patterns, $replacements, $text);
	   
	
	}
	
	
	public function startOfFile($text) 
    {
	
		if (filterclass::$in_tex) {
			  $text = self::utf_to_tex($text);
			  return $text;
			} else {
			  return self::typography_gamut($text);
		}
	            
    }
    
        
}

?>

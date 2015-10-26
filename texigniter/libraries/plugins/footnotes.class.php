<?php
/* 
 * @package     
 * @author      
 * @copyright   Y Lazarides 2012
 * @link        http://d2g.org.uk/
 * @version     
 
 * 
 * @licence     MPL 2.0
 * 
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. 
 */

 define ("FOOTNOTES",'Notes');
 
require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfFile.interface.php');

class Footnotes implements startOfFile
{

	private $regex_optional_square_bracket = '
			\[* 											# optional square brackets
	            ([^\]]*?)									# any character except a square bracket
			\]*												# end optional brackets
			(\s{1}|\{) 											#1 terminate with a space ';
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
	
     
	    

    /* 
     *  The function allows LaTeX style footnotes
     *  to be inserted in text, i.e., \footnote[]{}.
     *  The optional bracket is not really necessary for automating 
     *  numbering. Left it in just in case.
     *  @footnotestyle - allows different styling of footnotes
     *      'numeric', 'alpha', 'alpha', 'Alpha', 'roman', 'Roman'
     *  need to fix spacing rationally.
     */
    function footnote($text) {
        // creates footnotes
        // numeric or alphanumeric
        global $a;
		
        $a = '';
		$z1= '';
        $temp = $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
		\p{Pi} \p{Pf} 
	    “” ‘ ’\/\)°
		\(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´
		\-\&\s\'\"\#\?\%\\\\]*';
        $pattern = '/\\\\footnote\[?('.$temp.'?)\]*\{('.$temp.')\}/xui';
        $z = preg_replace_callback($pattern, array($this, 'footnote_callback'), $text);
        if (!empty($a)) {
            $z1 .= $z1."\n<h4 style=\"clear:both\">".FOOTNOTES."</h4> ";
			
        }
		// store the text in filterclass to pass it later on
		filterclass::$footnote_store = $z1.trim($a);
		//echo filterclass::$footnote_store = $z1.trim($a);break;
        return $z;
    }
    /**
     * footnote_callback - handles replacements from mark-up
     * to replacement.
     * 
     * We keep track of two counters 
     *   @footnote_id  a counter to use for id in html
     *                 and also for indexing symbol
     *                 and roman arrays
     *   @footnote_id_alpha similar to above but for alphabetic footnote
     *                 markers.
     * TODO - think of alphabets in languages other than english  
     */
    function footnote_callback($m) {
        static $footnote_id = '1'; 
        static $footnote_id_alpha = 'a';
        static $footnote_text = "";
        global $a;
        $footnotestyle = filterclass::$footnotestyle; //don't forget the $ sign on static !!!
        $fnsymbols = filterclass::$fnsymbols;
        $roman = filterclass::$roman; 
        $replacement ='';
        (isset($m[2]))? $replacement = $m[2] : $replacement ='';
        // Choose how to show superscript alpha, symbol, numeric
        if ($footnotestyle === 'symbol')
            $fnsymbol = $fnsymbols[$footnote_id];
        else if ($footnotestyle === 'alpha')
            $fnsymbol = $footnote_id_alpha;
        else if ($footnotestyle === 'Alpha')
            $fnsymbol = strtoupper($footnote_id_alpha);
        else if ($footnotestyle === 'roman')
            $fnsymbol = $roman[$footnote_id];
        else if ($footnotestyle === 'Roman')
            $fnsymbol = strtoupper($roman[$footnote_id]);
        else if ($footnotestyle === 'numeric')
            $fnsymbol = $footnote_id;
        else {
            $fnsymbol = $footnote_id;
        }
        
        // we first build the text for the notes
        $a = $a . "\n".$footnote_text
                . '<p style="text-indent:0pt"><a id="' . $footnote_id . '" href="#top-' . $footnote_id . '">'
                . '<sup> ' . $fnsymbol . '</sup>'
                . '</a> ' . $replacement . "</p>\n";
        // link for footnote marker
        $t = '<a id="top-' . $footnote_id . '" rel="tooltip" title="' . htmlentities($replacement) . '" href="#' . $footnote_id . '">'
                . '<sup id="top-"' . $footnote_id . '"> '
                . $fnsymbol . '</sup></a>';
        $footnote_id++;
        $footnote_id_alpha++;
		
        return $t;
    }

	
	
	
    public function startOfFile($text) 
    {
		if (filterclass::$in_tex) {
			  return $text;
			} else {
			    return self::footnote($text); 
		} 
	    
        
    }
    
        
}

?>

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

class Auctions implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
	
    // Auctions shortcut for auctions, some named auctions have their own
    function auction($text) {
        $pattern = "/\{\{auction:\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<p class="small">$1</p><div style="clear:both"></div>', $text);
        return $z;
    }
	
	function doAuctionCitations($text) {
        $patterns[] = "/\\\\spink4012s/u";
        $replacements[] = "(ex-E.W Ingram Spink London, July 2004).";
        $patterns[] = "/\\\\spink4012/u";
        $replacements[] = "(Spink London, E.W. Ingram Collection of E. AfricaJuly 2004).";
        $patterns[] = "/\\\\spink4007s/u";
        $replacements[] = "(ex-Frazer Spink London, May 2004).";
        $patterns[] = "/\\\\spink4007/u";
        $replacements[] = "Spink London, The William Frazer Exhibition Collection, May 20 2004.";
        $patterns[] = "/\\\\spink142s/u";
        $replacements[] = "(Spink Shreves, 2013a)";
        $patterns[] = "/\\\\spink142/u";
        $replacements[] = "Spink Shreves Galleries Sale, 142, The March 2013 Collector's Series Sale - March 22-23, 2013 ";
        $z = preg_replace($patterns, $replacements, $text);
        return $z;
    }
	// Macros for estimate/sold in lots
    //  sold in pounds
    function soldp($text) {
        $pattern = "/\\\\soldp\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/u";
        $z = preg_replace($pattern, '<span> (Estimate &pound; $1 sold for &pound;$2).
                 </span>', $text);
        return $z;
    }
	
	// Sold in euros
    function solde($text) {
        $pattern = "/\\\\solde\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/u";
        $z = preg_replace($pattern, '<span> (Estimate &euro; $1 sold for &euro;$2)
                 </span>', $text);
        return $z;
    }

    function soldpstar($text) {
        $pattern = "/\\\\soldp\*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<span> (Estimate &pound; $1 ).
                 </span>', $text);
        return $z;
    }

    function soldestar($text) {
        $pattern = "/\\\\solde\*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<span> (Estimate &euro; $1 ).
                 </span>', $text);
        return $z;
    }

    // Sold in dollars
    function soldd($text) {
        $pattern = "/\\\\soldd\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/u";
        $z = preg_replace($pattern, '<span> (Estimate $$1, Sold $$2).
                 </span>', $text);
        return $z;
    }

    // Sold in dollars
    function soldaud($text) {
        $pattern = "/\\\\soldaud\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/u";
        $z = preg_replace($pattern, '<span> (Estimate AUD$ $1 sold for AUD$ $2).
                 </span>', $text);
        return $z;
    }

    

    // John Sacher Sale - West Africa

    function sacher($text) {
        $pattern = "/\\\\sacher/u";
        $z = preg_replace($pattern, 'ex: <span style="font-style:italic">John Sacher, West Africa Collection. </span>', $text);
        return $z;
    }

    function HU($text) {
        $pattern = "/\\\\HU/u";
        $z = preg_replace($pattern, 'ex: <span style="font-style:italic">Hughes, 2011 </span>', $text);
        return $z;
    }

    function karpov($text) {
        $pattern = "/\\\\karpov/u";
        $z = preg_replace($pattern, 'ex: <span style="font-style:italic">Anatoly Karpov, 2012 </span>', $text);
        return $z;
    }

    // Arthur Gray
    function AG($text) {
        $pattern = "/\\\\AG/u";
        $z = preg_replace($pattern, 'ex: <span style="font-style:italic">Arthur W. Gray, 2007.</span>', $text);
        return $z;
    }

    // Morgan
    function MO($text) {
        $pattern = "/\\\\MO/u";
        $z = preg_replace($pattern, 'ex: <span style="font-style:italic">Morgan, 2012.</span>', $text);
        return $z;
    }

    function alan($text) {
        $pattern = "/\\\\alan\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\?\s\'\"]+)\}\{([[:alnum:]\/\)\(\,\.\:\_\#\/\&\;\=\%\-\&\s\'\"\<\>\+\[\]\?]+)\}/u";
        $z = preg_replace($pattern, '<div style="width:100%; margin:0 auto">
               <img src="'.site_url('stamp-images/queensland/$2').'"
               style="width:$1;margin:0 auto;display:block"/>
               <p class="small center" style="width:90%;margin-bottom:10px">$3</p>
               </div>', $text);
        return $z;
    }

    // Auctions shortcut for auctions, some named auctions have their own
    function gross($text) {
        $pattern = "/\\\\gross/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">W. H. Gross, Spink 2007</p><div style="clear:both"></div>', $text);
        return $z;
    }

    // Auctions shortcut for auctions, some named auctions have their own
    function feldman($text) {
        $pattern = "/\{\{feldman:\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Feldman, Geneva Autumn 2012, Lot No: $1.</p><div style="clear:both"></div>', $text);
        return $z;
    }

    // Karamitsos 420
    function K420($text) {
        $pattern = "/\{\{K420\}\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Karamitsos Sale 420, March 2012</p><div style="clear:both"></div>', $text);
        return $z;
    }

    // Spink aphrodite
    function SPINKA($text) {
        $pattern = "/\{\{SPINKA\}\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Spinks Sale 9006, March 2009</p><div style="clear:both"></div>', $text);
        return $z;
    }

    // Spink aphrodite
    function rectangulars($text) {
        $pattern = "/\{\{rectangulars\}\}/u";
        $z = preg_replace($pattern, ' Spink: Sep 2007,  "The Rectangular Issues."<div style="clear:both"></div>', $text);
        return $z;
    }
	
	function pitman($text) {
        $pattern = "/\{\{pitman:\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Ex: Milan Pitman, Silver Yuan Issues, <a>Interasia</a>, 28 Apr 2012.</p><div style="clear:both"></div>', $text);
        return $z;
    }

    // Peter Jaffe auction
    function jaffe($text) {
        $pattern = "/\\\\jaffe\s*\{([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Ex: Peter Jaff&eacute; 2007</p><div style="clear:both"></div>', $text);
        return $z;
    }
	
	//  filters for philatelic and collectibles
    //  ex: Walter Scott
    //  should be in span with class
    function ex($text) {
        $pattern = "/\{\{ex\s*:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/u";
        $z = preg_replace($pattern, '<p style="font-family:arial;font-size:12px;float:left">Provenance: $1</p><div style="clear:both"></div>', $text);
        return $z;
    }
	
	function auctions_gamut ($text) {
	    $this->texcommands [] = 'auction';
		$this->texcommands [] = 'doAuctionCitations';
		$this->texcommands [] = 'soldp';
		$this->texcommands [] = 'subsection';
		$this->texcommands [] = 'heading';
		$this->texcommands [] = 'jaffe';
		$this->texcommands [] = 'karpov';
		$z = $this->auction ($text);
		$z = $this->doAuctionCitations ($z);
		$z = $this->soldp ($z);
		$z = $this->ex ($z);
		$z = $this->jaffe($z);
		$z = $this->karpov($z);
		return $z;
	}
	
	// Main routine calling all the
	// replacement macros.
	
    public function startOfFile($line) 
    {
	    return self::auctions_gamut($line);
        
    }
    
        
}

?>

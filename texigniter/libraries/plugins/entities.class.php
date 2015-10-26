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

class Entities implements startOfFile
{
           
    public function __construct()
    {
       
    }
	
	function circumflex ($text) {
		$patterns[] = "/\\\\\^A/u";
        $replacements[] = '&Acirc;';
		$patterns[] = "/\\\\\^a/u";
        $replacements[] = '&acirc;';
		$patterns[] = "/\\\\\^o/u";
		$replacements[] = '&#244;';
		$patterns[] = "/\\\\\^O/u";
		$replacements[] = 'Ô';
			
		return  preg_replace($patterns, $replacements, $text);
	}
	
	
    // hats
    function ohat($text) {
        
        $z = preg_replace($pattern, '&#244;', $text);
        return $z;
    }

    function agrave($text) {
        $pattern = "/\\\\\`a/u";
        $z = preg_replace($pattern, '&#224;', $text);
        return $z;
    }

    function egrave_upper($text) {
        $pattern = "/\\\\`E/u";
        $z = preg_replace($pattern, '&#201;', $text);
        return $z;
        //\end{figure}
    }

    function egrave($text) {
        $pattern = "/\\\\`e/u";
        $z = preg_replace($pattern, '&#232;', $text);
        return $z;
        //\end{figure}
    }

    function bar_n($text) {
        $pattern = "/\\\\~n/u";
        $z = preg_replace($pattern, '&#241;', $text);
        return $z;
        //\end{figure}
    }
	
	
	function __A ($text) {
		$patterns[] = "/\\\\'a/u";
        $replacements[] = '&#225;';
        $patterns[] = "/\\\\\"a/u";
        $replacements[] = '&auml;';
        $patterns[] = "/\\\\aa/u";
        $replacements[] = '&aring;';
        $patterns[] = "/\\\\AA/u";
        $replacements[] = '&Aring;';
		return  preg_replace($patterns, $replacements, $text);
	}
	
	function __E ($text) {
		$patterns[] = "/\\\\'e/u";
        $replacements[] = '&#233;';
		$patterns[] = "/\\\\\'E/u"; // does not work well?
        $replacements[] = '&#201;';
		return  preg_replace($patterns, $replacements, $text);
	}
	
	function __I ($text) {
		$patterns[] = "/\\\\'i/u";
        $replacements[] = '&#237;';
        $patterns[] = "/\\\\'I/u";
        $replacements[] = '&Iacute;';
		return  preg_replace($patterns, $replacements, $text);
	}
	
	function __O ($text) {
		$patterns[] = "/\\\\\"o/xu"; //umlaut
		$replacements[] = '&#246;';
	
		$patterns[] = "/\\\\o /u";
        $replacements[] = '&oslash;';
		
		$patterns[] = "/\\\\O /u";
		$replacements[] = "&Oslash;";
		
        
		return  preg_replace($patterns, $replacements, $text);
	}
	
	function __U ($text) {
		$patterns[] = "/\\\\'u/u";
        $replacements[] = '&#250;';
        $patterns[] = '/\\\\\"u/u';
        $replacements[] = '&uuml;';
        $patterns[] = '/\\\\\"U/u';
        $replacements[] = '&Uuml;';
		return  preg_replace($patterns, $replacements, $text);
	}
	
	function __Y ($text) {
		$patterns[] = "/\\\\'y/u";
        $replacements[] = '&#253;';
        $patterns[] = "/\\\\'Y/u";
        $replacements[] = '&#221;';
		return  preg_replace($patterns, $replacements, $text);
	}
	
	/*
	 *	Cedilla diacritic marks.
	 *  need to handle all letters
	 */ 
	function cedilla ($text) {
	    $patterns[] = "/\\\\c{C}/u";
        $replacements[] = '&Ccedil;';
        $patterns[] = "/\\\\c\{c\}/u";
        $replacements[] = '&ccedil;';
		
		$patterns[] = "/\\\\c\{S\}/u";
		$replacements[] = '&#350;';
		$patterns[] = "/\\\\c\{s\}/u";
        $replacements[] = '&#351;';
		 
		return  preg_replace($patterns, $replacements, $text);
	}
	
	
	function ligatures ($text) {
		$patterns[] = '/\\\\ss/u';
        $replacements[] = '&szlig;';
        $patterns[] = '/\\\\ae/u';
        $replacements[] = '&aelig;';
        $patterns[] = '/\\\\`AE/u';
        $replacements[] = '&AElig;';
		return  preg_replace($patterns, $replacements, $text);
	}
	
	function entityfy($text) {
        ## common symbols to html
        ## needs checking on tex side.
		
		$text = self::__A ($text);
		$text = self::__E ($text);
		$text = self::__I ($text);
		$text = self::__U ($text);
		$text = self::__Y ($text);
		$text = self::__O ($text);
		$text = self::circumflex ($text);
		$text = self::cedilla ($text);
		$text = self::ligatures ($text);
		
		$patterns[] = "/\\\\Dagger/u";
        $replacements[] = '<sup>&Dagger;</sup>';
       
        $patterns[] = "/\\\\degrees*/u";
        $replacements[] = '&deg;';
        $patterns[] = "/\\\\prime/u";
        $replacements[] = '&prime;';
				
        $patterns[] = "/\\\\'b/u";
        $replacements[] = 'B';
        $patterns[] = "/\\\\'c/u";
        $replacements[] = '&#263;';
        
        $patterns[] = "/\\\\'d/u";
        $replacements[] = 'd';
        
		$patterns[] = "/\\\\ETH/xu"; //eth
		$replacements[] = '&ETH;';
		$patterns[] = "/\\\\eth/xu"; //eth
		$replacements[] = '&eth;';
		
		$patterns[] = "/\\\\th/xu"; //thorn
		$replacements[] = '&thorn;';
		$patterns[] = "/\\\\TH/xu"; //thorn
		$replacements[] = '&THORN;';
		
        $z = preg_replace($patterns, $replacements, $text);
        return $z;
    }
	
	function entityfy_tex($text) {
	
		//Ligatures
		$patterns[] = "/Æ/u"; //eth
		$replacements[] = "\AE ";
		$patterns[] = "/æ/u"; //eth
		$replacements[] = "\ae ";
		
		
		// A
		$patterns[] = "/Á/"; 
		$replacements[] = "\'A";
		
		//E
		$patterns[] = "/É/u"; //eth
		$replacements[] = "\'E";
		$patterns[] = "/é/u"; //eth
		$replacements[] = "\'e";
		
		//i-acute
		$patterns[] = "/Í/u"; //eth
		$replacements[] = "\'I ";
		$patterns[] = "/í/u"; //eth
		$replacements[] = "\'i ";
		
		//o-acute
		$patterns[] = "/Ó/u"; 
		$replacements[] = "\'O";
		$patterns[] = "/ó/u"; 
		$replacements[] = "\'o";
		
		//o-slash
		$patterns[] = "/Ø/u"; 
		$replacements[] = "\O ";
		$patterns[] = "/ø/u"; 
		$replacements[] = "\o ";
		
		
		
		
		//y-acute
		$patterns[] = "/Ý/u"; 
		$replacements[] = "\'Y";
		$patterns[] = "/ý/u"; 
		$replacements[] = "\'y";
		
		//u-acute
		$patterns[] = "/Ú/u"; 
		$replacements[] = "\'U";
		$patterns[] = "/ú/u"; 
		$replacements[] = "\'u";
	
	
		//eth
		$patterns[] = "/\\\\eth/xu"; 
		$replacements[] = '$\eth$';
		$patterns[] = "/ð/"; //eth
		$replacements[] = '$\eth$';
		$patterns[] = "/Ð/"; //eth
		$replacements[] = '\DH';
		
		
		$patterns[] = "/þ/"; //eth
		$replacements[] = '\th ';
		$patterns[] = "/Þ/"; //eth
		$replacements[] = '\TH ';
		
		
		
		$patterns[] = "/ö/"; 
		$replacements[] = '\"o';
		
		//i
		$patterns[] = "/í/u"; 
		$replacements[] = "\'i";
		
		//Funny Quotes
		$patterns[] = "/“/u"; 
		$replacements[] = "`'";
		$patterns[] = "/”/u"; 
		$replacements[] = "''";
		
		//Cedilla
		$patterns[] = "/ç/"; 
		$replacements[] = '\c{c}';
		$patterns[] = "/Ç/"; 
		$replacements[] = '\c{C}'; 
		$patterns[] = "/Ş/"; 
		$replacements[] = '\c{S}';
		$patterns[] = "/ş/"; 
		$replacements[] = '\c{s}';
		
		//Circumflex
		$patterns[] = "/Â/"; 
		$replacements[] = '\^{A}';
		$patterns[] = "/â/u"; 
		$replacements[] = '\^{a}';
		$patterns[] = "/ê/u"; 
		$replacements[] = '\^{e}';
		$patterns[] = "/Ô/u"; 
		$replacements[] = '\^{O}';
		$patterns[] = "/ô/u"; 
		$replacements[] = '\^{o}';
		
		
		//Greek Letters
		
		$patterns[] = "/α/u"; 
		$replacements[] = '$\alpha$';
		$patterns[] = "/Γ/u"; 
		$replacements[] = '$\Gamma$';
		$patterns[] = "/γ/u"; 
		$replacements[] = '$\gamma$';
			
		
		$patterns[] = "/δ/u"; 
		$replacements[] = '$\delta$';
		$patterns[] = "/Δ/u"; 
		$replacements[] = '$\Delta$';
		$patterns[] = "/(ε|έ)/u"; 
		$replacements[] = '$\varepsilon$';
		$patterns[] = "/ϵ/u"; 
		$replacements[] = '$\epsilon$';
		
		$patterns[] = "/Ζ/u"; 
		$replacements[] = 'Z';
		$patterns[] = "/ζ/u"; 
		$replacements[] = '$\zeta$';
		
		
		$patterns[] = "/Λ/u"; 
		$replacements[] = '$\Lambda$';
		$patterns[] = "/λ/u"; 
		$replacements[] = '$\lambda$';
		
		$patterns[] = "/Ι/u"; 
		$replacements[] = 'I';
		$patterns[] = "/ι/u"; 
		$replacements[] = '$\iota$';
		
		$patterns[] = "/Μ/u"; 
		$replacements[] = 'M';
		$patterns[] = "/μ/u"; 
		$replacements[] = '$\mu$';
		//nu
		$patterns[] = "/Ν/u"; 
		$replacements[] = 'N';
		$patterns[] = "/ν/u"; 
		$replacements[] = '$\nu$';
		//tau
		$patterns[] = "/Τ/u"; 
		$replacements[] = 'T'; 
		
		$patterns[] = "/τ/u"; 
		$replacements[] = '$\tau$'; 
		
		$patterns[] = "/\x{039E}/u";
		$replacements[] ='$\Xi$';
		$patterns[] = "/\x{03BE}/u";
		$replacements[] ='$\xi$';
		
		
		$patterns[] = "/Υ/u";
		$replacements[] = '$\Upsilon$';
		$patterns[] = "/υ/u"; 
		$replacements[] = '$\upsilon$'; 
		
		$patterns[] = "/Ω/u";
		$replacements[] = '$\Omega$';
		$patterns[] = "/ω/u"; 
		$replacements[] = '$\omega$';
				 
	    $z = preg_replace($patterns, $replacements, $text);	
		return $z;
	}
	
	function in_tex_gamut ($text) {
	
			
		$z = self::entityfy_tex($text);
		return ($z);
	}
	
	
    public function startOfFile($text) 
    {
	
		if (filterclass::$in_tex) {
			  return self::in_tex_gamut($text);
			} else {
			  return self::entityfy($text);
		}
	 
        
    }
    		
        
}

?>

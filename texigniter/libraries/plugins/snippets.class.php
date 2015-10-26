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

class Snippets implements startOfFile
{

	private $regex_optional_square_bracket = '
			\[* 											# optional square brackets
	            ([^\]]*?)									# any character except a square bracket
			\]*												# end optional brackets
			\s{1} 											#1 terminate with a space ';
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
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
	
	// format a snippet this is plain
    // it does not produce a sandbox
    // modified june 2011
    function snippet($text) {
        $pattern = "/\{\{snippett*\s*:\s*([^}]+)[}]\}/u";
        $before = '<div class="code-block code" style="padding-top:0px;padding-bottom:0px;margin-bottom:0px;min-height:0px;"><pre class="PHP" style="padding-top:0;padding-bottom:0;margin:0;min-height:15px">';
        $after = '</pre></div>';
        // dollar must be within replace?
        $z = preg_replace($pattern, $before . '$1' . $after, $text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        return $z;
    }

    function snippetPHP($text) {
        $pattern = "/\\\\begin{PHP}\s*([[:alnum:]\/\)\\\\\(\)\+\@\,\^\*\[\]\_\.\>\<\=\{\}\-\&\s\$\'\"\!\.\?\;\:]+)\\\\end{PHP}/u";
        $before = '<div class="code-block code"
               style="padding-top:10px;padding-bottom:10px;margin-bottom:15px">
                <pre class="PHP" style="padding-top:0;padding-bottom:0;margin:0">';
        $after = '</pre></div>';
        // dollar must be within replace?
        $z = preg_replace($pattern, $before . '$1' . $after, $text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        //preg_match_all($pattern,$text,$array);
        //echo_array($array);
        //$z=$array[1][0];
        return $z;
    }

    // added class ui-corner-all
    // creates the standard console block
    function plain_code($text) {
        $pattern = "/\{\{plain-code:\s*([^%]+)[%]\}/u";
        $before = '<div class="code-block console-wrap"><div class="code-block code"><code>';
        $after = '</code></div></div>';
        // dollar must be within replace?
        $z = preg_replace($pattern, $before . '$1' . $after, $text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        return $z;
    }

    // TODO
    function plain($text) {
        $pattern = "/\{\{plain:\s*([^\}]+)\}\}/u";
        $before = '<div class="code-block console-wrap clearfix"><div class="code-block code"><pre style="padding:0 0 0 0;margin:0 0 0 0">';
        $after = '</pre></div></div>';
        // dollar must be within replace?
        $z = preg_replace($pattern, $before . '$1' . $after, $text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        return $z;
    }
	
	function snippets_gamut ($text) {
		$z = self::plain ($text);
		$z = self::plain_code ($z);
		$z = self::snippet ($z);
		$z = self::snippetPHP ($z);
		
		if ($z) return $z; else return $text;
	}
	
	
    public function startOfFile($line) 
    {
	    return self::snippets_gamut($line);
        
    }
    
        
}

?>

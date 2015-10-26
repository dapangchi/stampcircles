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

class Fancybox implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
    /**
	 *	Filter for block related 
	 *  templets
	 *
	**/
	
	function pinnote($text) {
        $pattern = "/\\\\pinnote\s*\{([^\}]+)\}/u";
        $z = preg_replace($pattern, '<div class="pinnote ui-corner-all"><strong>Note!</strong>$1</div> ', $text);
		$pattern = "/\{\{pinnote:\s*([^\}]+)\}\}/u";
        $z = preg_replace($pattern, '<div class="pinnote ui-corner-all"><strong>Note!</strong>$1</div> ', $z);
	    return $z;
    }

    function stickynote($text) {
        $pattern = "/\{\{stickynote:\s*([^\}]+)\}\}/u";
        $z = preg_replace($pattern, '<div class="stickynote ui-corner-all"><strong>Note!</strong>$1</div> ', $text);
        $pattern = "/\\\\stickynote\s*\{([^\}]+)\}/u";
        $z = preg_replace($pattern, '<div class="stickynote ui-corner-all"><strong>Note!</strong>$1</div> ', $z);
		return $z;
    }

    function nutshell($text) {
        $pattern = "/\{\{nutshell:\s*([^\}]+)\}\}/u";
        $z = preg_replace($pattern, '<div class="nutshell ui-corner-all"><h5>In a Nutshell!</h5>$1</div> ', $text);
		$pattern = "/\\\\nutshell\s*\{([^\}]+)\}/u";
        $z = preg_replace($pattern, '<div class="nutshell ui-corner-all"><h5>In a Nutshell!</h5>$1</div> ', $z);
		
        return $z;
    }

    function bulb($text) {
        $pattern = "/\{\{bulb:\s*([^\}]+)\}\}/u";
        $z = preg_replace($pattern, '<div class="bulb ui-corner-all"><strong>Note!</strong>$1</div> ', $text);
        return $z;
    }
	
    function download($text) {
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern = "/\{\{\*download:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\]\[\:]+)\}\}/iusx";
        $z = preg_replace($pattern, '<div class="download ui-corner-all"><strong>Note! </strong>$1</div> ', $text);
        return $z;
    }

    function warning($text) {
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern = "/\{\{warning:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\}/iusx";
        //$pattern=$this->regexAll;
        $z = preg_replace($pattern, '<div class="warning ui-corner-all"><strong>Caution!</strong> $1</div> ', $text);
        return $z;
    }

    function sandbox($text) {
        $pattern = "/\{\{sandbox:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\'\"\!\.\?\;\<\>\:]+)\}\}/u";
        $z = preg_replace($pattern, '<div class="sandbox ui-corner-all"><h5>Sandbox!</h5>$1</div> ', $text);
        return $z;
    }
	
	function example($text) {
        $pattern = "/\{\{example:\s*([^\}]+)\}\}/u";
        $z = preg_replace($pattern, '<div style="font-size:13px;background-image:url(' . site_url() . '/images/code-bg.gif);border:1px solid #ececec;padding:10px;margin-bottom:8px;" class="clearfix">$1</div> ', $text);
        return $z;
    }
	
	function fbox($text) {
        $z = preg_replace("/                                                                            # puttwo[]{}{}{}
         \\\\fbox\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                            # optional square brackets
          \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
          \n\r/xu", '<div class="bordered clearfix small" style="width:40%">$2</div>', $text);
        return $z;
    }
	
	/**
	 *	Main method to register and call all
	 *  fancy box routines.
	 * 
	**/
	
	function fancybox_gamut ($text) {
	    $this->texcommands [] = 'sandbox';
		$this->texcommands [] = 'warning';
		$this->texcommands [] = 'download';
		$this->texcommands [] = 'bulb';
		$this->texcommands [] = 'nutshell';
		$this->texcommands [] = 'stickynote';
		$this->texcommands [] = 'pinnote';
		$this->texcommands [] = 'fbox';
	    $this->wikicommands [] = 'sandbox';
		$this->wikicommands [] = 'warning';
		$this->wikicommands [] = 'bulb';
		$this->wikicommands [] = 'nutshell';
		$this->wikicommands [] = 'stickynote';
		$this->wikicommands [] = 'pinnote';
	
		$z = $this->sandbox ($text);
		$z = $this->warning ($z);
		$z = $this->download ($z);
		$z = $this->bulb ($z);
		$z = $this->nutshell ($z);
		$z = $this->stickynote ($z);
		$z = $this->pinnote ($z);
		$z = $this->fbox ($z);
		$z = $this->example ($z);
		return $z;
	}
	
	
	
	
    public function startOfFile($line) 
    {
	    return self::fancybox_gamut($line);
        
    }
    
        
}

?>

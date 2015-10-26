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

class Wikitize implements startOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
    
    private $regex_allowed_chars_in_wiki = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
        \p{Pi} \p{Pf} 
        “” ‘ ’\/\)
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´
        \-\&\s\'\"\#\?\%\\\\]*?';
        
    public function __construct()
    {
       
    }
    
    /** transcribes a link to search for  
     * the entry through wikipedia, puts contents
     * into CMS template view.
     * 
     */
    function wikitize($text) {
        //replaces text between {{}} with wiki links
        $pattern = "/\{\{wi:\s*(".$this->regex_allowed_chars_in_wiki.
        "\s*)\}\}/xu";
        return preg_replace_callback($pattern,array($this,'wikitize_callback') , $text);
    }
    /**
     * Builds the local link 
     * <a href="http://localhost/application-latest/Blogs/go/$1">$1</a> '
     **/
    function wikitize_callback ($values) {
        
           $z_no_underscore = str_replace ('_' , ' ' , $values[1]);
        return '<a  href="' . site_url() . '/blogs/go/'.
                $values[1].'">'.$z_no_underscore.'</a>';
    }
    
    /** 
     *    Transcribes a wikipedia link   
     *  by changing to href{}{} for TeX processing
     *     
     *    We also change the page title to be without
     *  underscores.
     *  
     */
    function wikitize_tex($text) {
        //replaces text between {{}} with wiki links
        $pattern = "/\{\{wi:\s*(.+?)\}\}/xu";
        //echo 'in wikitize';
        $z = preg_replace_callback($pattern, array($this,'wikitize_tex_callback'), $text);
        return $z;
    }
    /**
     *    Call back for wikitize
     *    @return \href{}{}
     */
    
    function wikitize_tex_callback ($values) {
        //echo_array($values);break;
           $z_no_underscore = str_replace ('_' , ' ' , $values[1]);
        return '\href{ http://en.wikipedia.org/wiki/'.$values[1].'}'.'{'.$z_no_underscore.'}';
    }
    
        
    function wikitize_gamut ($text) {
    /**
        $string = "Figure 1: This is the title block";
        $size = 20;
        $angle = 0;
        $fontfile = 'C:/windows/fonts/Georgiaz.ttf'; //bold
        $slength = 0;
        $strlen = strlen($string);
        for ($i = 0; $i < $strlen; $i++)
        {
            $dimensions = imagettfbbox($size, $angle, $fontfile, $string[$i]);
            echo "Width of ".$string[$i]." is ".$dimensions[2]."<br>";
            $slength = $slength+$dimensions[2];

        }
        echo $string.' '.$slength.'pt ';
        //break; */
            $z = self::wikitize ($text); 
           return $z;
    }
    
    
    /**
     *
     */
    function in_tex_gamut ($text) {
        $z = self::wikitize_tex ($text); 
        return $z;
    }
    
    public function startOfFile($text) 
    {
       if (filterclass::$in_tex) {
              return self::in_tex_gamut($text);
            } else {
              return self::wikitize_gamut($text);
        }
                
    }
    
        
}

?>
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

class Accordion implements startOfFile
{
           
    public function __construct()
    {
       
    }
    
	
	
	
	/* The following functions are
     * commands for accordions.
     * The accordion menus, or can be changed via
     * css to be normal menus, are called using
     * \begin{accordion}
     * \end{accordion}
     * We automatically add numbered classes
     * to enable the javascript.
     */

    function class_adder($text) {
        $z = preg_replace_callback(
                "[\*\*CLASS\*\*]", create_function('$m', '
              static $class_id = 0;
              $class_id++;
              return "$class_id";
             '), $text);
        return $z;
    }

    function class_adder_b($text) {
        $z = preg_replace_callback(
                "[\*\*BCLASS\*\*]", create_function('$m', '
        static $class_id_b = 0;
        $class_id_b++;
        return "$class_id_b";
    '), $text);
        return $z;
    }

    function accordion_begin($text) {
        $pattern = "/\\\\begin\{accordion\}
                 /xu";
        $replace = '<div class="accordion" id="accordion2" style="width:250px;margin-left:10px">';
        return preg_replace($pattern, $replace, $text);
    }
	
	/*
	 *	Makes breadcrump links 
	 */
	function make_links ($array) {
		$lines = '';
		$i=0;
		$temp = $array;
		foreach ($array[2] as $line) {
		    $lines .= '<a href="'.$array[2][$i].'" title="'.$temp[1][$i].'" class="nav breadcrump" >['.($i+1).']</a>'."\n";
			$i++;
		}
		filterclass::$navigationArray = $lines;
		return $lines;
	}
	function get_categories ($text) {
		$pattern = "/\\\\mitem\{(.*)\}\s*\{([[:alnum:]\d\s\.\/\_\-]+)*\}
                 /xu";
		if (preg_match_all($pattern, $text, $matches)) {
				//echo_array($matches);
				 accordion::make_links($matches);
				}
			else {
				//echo 'NO MATCH';
				filterclass::$navigationArray = false;
		}
			
		
	}
	
    function accordion_end($text) {
        $pattern = "/\\\\end\{accordion\}
                 /xu";
        return preg_replace($pattern, '</div>', $text);
    }

    function accordion_begin_group($text) {
        $pattern = "/\\\\begin\{
            (?:accordiongroup|category) #allow accordiongroup, category etc..:? non-capturing 
            \}\s*\{(.*)\}
                 /xu";
        $z = preg_replace($pattern, '
    <div class="accordion-group" style="border:none;padding:0pt">
    <div class="accordion-heading country" style="padding:0pt;margin:0pt">
      <a class="accordion-toggle"  data-toggle="collapse" data-parent="#accordion2" href="#general**CLASS**">
        $1 
      </a>
    </div>
 <div id="general**BCLASS**" class="accordion-body collapse ">
 <div class="accordion-inner" style="padding:0pt">
    <ul class="nav" style="width:100%;margin-left:0px;padding:0pt;list-style-type: none;margin-bottom:0pt;">
        
', $text);
        return $z;
    }

    /*
     * We use trim(), otherwise markdown later
     * will turn it into code.
     * If we want nice html we can use tidy later on.
     * 
     */

    function accordion_end_group($text) {
        $pattern = "/\\\\end\{(?:accordiongroup|category)\}
                 /xu";
        $z = preg_replace($pattern, trim('
            </ul>
          </div>  
          </div>
         </div>'), $text);
        return $z;
    }

    function accordion_item($text) {
        $pattern = "/\\\\mitem\{(.*)\}\s*\{([[:alnum:]\d\s\.\/\_\-]+)*\}
                 /xu";
        return preg_replace($pattern, "<li style=\"padding:0pt;margin:0pt;font-size:16px;\"><a href=\"$2\">$1</a></li>", $text);
    }

    /*
     * Call all the functions to make 
     * the accordion.
     */

    function accordion_gamut($text) {
	    $z = accordion::get_categories($text);
        $z = $this::accordion_begin($text);
        $z = $this::accordion_begin_group($z);

        // add class numbers
        $z = $this::class_adder($z);
        $z = $this::class_adder_b($z);
        $z = $this::accordion_item($z);
        $z = $this::accordion_end_group($z);
        $z = $this::accordion_end($z);
		
        return $z;
    }
	
	
	
	
    public function startOfFile($line) 
    {
	    return self::accordion_gamut($line);
        
    }
    
        
}

?>

<?php
/* 
 * @package     PHP5 TeXifier
 * @author      Y Lazarides
 * @copyright   Y Lazarides 2014
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

class Textables implements startOfFile
{
    
    private $regex_allowed_chars_in_table = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
	    \p{Pi} \p{Pf}  
	    “” ‘ ’\/\) \|
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\´\{\}
		\-\&\s\'\"\#\?\%\\\\ ]*?';
	
	static $multicol_array = array ();	
	static $specifier_classes = array ();
    public function __construct()
    {
       
    }
    
	/**
	 *	We first need to capture the full body of a table in
	 *  order to check, if the user has inserted a \centering command
	 *  and adjust the relevant CSS class.
	 *  We check for \centering \begin{center} and \end{center}
	 *  
	 */
	
	function check_if_centered ($text, $field = '') {
	    
		$pattern = '/\\\\(?:begin\{'.$field.'\})\s*
		            \[*(?:h|t|b|p|\!)*\]*\s*
					('.
		            $this->regex_allowed_chars_in_table.
					')
					\\\\(?:end\{'.$field.'\})/xu';
				   
			// if centering is found return with enclosed divs	
			$z = preg_replace_callback($pattern, array($this,'check_if_centered_callback'), $text);
			// remove centering etc if it exists
			$z = preg_replace('/(\\\\centering|\\\\begin\{center\}|\\\\end\{center\})/ux', '', $z);
			return $z;
	}
	
	
	/**
	 *  Check if a string contains a search word
	 *  return false otherwise or the substring...  
	 */
	function check_for_centering ($haystack, $search='centering') {
	   	$z =strstr ($haystack, $search);
		return $z;
	}	
	
	function check_if_centered_callback ($values) {
	    /** 
		 *	first check if the table contains center or centering
		 */
		 //echo_array($values);
		if ($this->check_for_centering($values[1],'\center')){
		    return '<div class="text-centered">'.$values[1].'</div>';
		} else { 
		  }
	}
	
	/**
	 *
	 * Parse  \multicolumn{4}{ c| }{Primes} type
	 * marking
	 * for html we need to replace as
	 * //<td colspan="2">Sum: $180</td>
	 *
	 */
	 
	function multicolumn ($text) {
		$pattern = '/\\\\multicolumn\s*\{(\d*)\}
		          \{                                         #specifiers |l|r|c|p{}|@{} etc... has errors for moreon a line
		           ([|lrc]|\|\s*p\{.*\}\s*\|*)
				  \}\{(.*)\}/mux';
	   	$z = preg_replace_callback ($pattern, array($this,'multicolumn_callback'), $text);
		//echoPRE($z);
		//break;
		return $z;
		
	}
	
	function multicolumn_callback($values) {
	  echo_array($values);
	  static $multicol_counter;
	         $multicol_counter++;
			 self::$multicol_array['MULTICOLUMN'.$multicol_counter] = 
			       array($values[1],$values[2],$values[3]);
	  return 'MULTICOLUMN'.$multicol_counter;
	  //return '<td colspan="'.$values[2].'" style="text-align:left">'.$values[3].'</td>';
	
	}
	/**
	 *
	 * remove & from multicolumn
	 *
	 */ 
	function remove_and_from_multicolumn ($text) {
		$pattern = '/\&(MULTICOLUMN\d+)/mux';
		$replace = '$1';
		return preg_replace($pattern, $replace, $text);
	}
	
	
	/*  
	 *	Allowed \tabular \end{tabular}
	 *
	 */
	function get_td ($text, $field='tabular') {
		$pattern = "/\\\\(?:".$field."|start".$field."|begin\{".$field."\})	# startcommand
			\[*.*?]*\{(.*)\}  														#specifier \1
		    (".$this->regex_allowed_chars_in_table.")						#content \2
			 \\\\(?:"
			.'end'.$field."|stop".$field."|end\{".$field."\})				# endcommand\3
			/mxu";			
			
		$z = preg_replace_callback($pattern, array($this,'get_td_callback'), $text);
		
		return $z;
	}
	
	/*
	 * helper function to change tabular specifier to classes
	 * and style commands
	 * Array
	 *	(
	 *		[0] => left border-left border-right
	 *		[1] => left border-left border-right
	 *		[2] => left border-left border-right
	 *		[3] => left border-left border-right
	 *		[4] => p{3.5CM} -> width:3.5cm
	 *	)
	 */
	function tabular_specifier_to_class ($specifier) {
		// split the $specifier into characters
		// change cm to CM
		
		$pattern = '/cm/';
		$result  ='CM';
		$specifier = preg_replace($pattern, $result, $specifier);
		
		$k = 1;
		$accumulator = '';
		$reserved = array ('l','c','r');
		$classes = array ('l'=>' left ','c'=>' centered ','r'=>' right ');
		$cell = array();
		$result = str_split($specifier);
		//echo_array($result);
		$count = 0;
		$previous = '';
		for($i=0;$i<sizeof($result);$i++) {
		    // a '|' always accumulated
			$ch=$result[$i];
						
			// check if in reserved	
			if (in_array($ch, $reserved)) {
			    (($i>0) && ($result[$i-1]=='|'))? $before = ' border-left ': $before=''; 
				(($i<sizeof($result)-1) &&($result[$i+1]=='|'))? $after = ' border-right ': $after =' ';
				$cell[] = $before.$classes[$ch].$after;
			} 	
			//paragraph specifier TODO BEFORE AFTER
			if ($ch=='p') {
			  while ($ch != '}') {
			    $accumulator .= $ch;
				$i++;
				$ch=$result[$i];
				
			  }
			    $pattern = "/p\{([\d.]+.+)/u";
				$replace = ' style="width:$1" ';
				$cell [] = ' p35cm ';//preg_replace ($pattern, $replace, $accumulator);
				//$cell [] = $accumulator.'}';
				
				$accumulator = 'P';
			}
			
						
		};
		$this->specifier_classes = $cell;
				
		//return $this->specifier_classes;
	}
	
	/**
	 *	The call back needs to split the rows and add the row and cell
	 *	html markup.
	 *  $k - keeps track of cell number in order to insert classes based 
	 *  on tabular specifiers.
	 *  $values[1] - specifier e.g. |l| |l| |l| |l|
	 *  
	 */
	function get_td_callback ($values) {
		//split into lines
		
		self:: tabular_specifier_to_class ($values[1]);
		
		
		
		$lines = explode ('\\\\', $values[2]);
				
		$render_rows = '';
		
		foreach ($lines as $row) {
		   $k=1;
		    //split line between &
			$tds ='';
		    $temp = explode ('&', 'ROWSTART'.$row."ROWEND\n");
			foreach ($temp as $v) {
			  $tds .= 'TDS'.$k.trim($v).'TDE ';
			  $k++;
			}
			
		    $render_rows .= trim($tds);
			
			
		}
				
		$patterns[]='/TDS\dROWSTART/ux';
		$replacements[]='<tr><td>';
		$patterns[]='/ROWSTART/ux';
		$replacements[]='<tr>';
		$patterns[] ='/ROWEND/ux';
		$replacements[]='</tr>';
		
		$z=preg_replace($patterns, $replacements, $render_rows);
		return '<table class="table "><tbody>'.$z.'</tbody></table>';
	}
	
	
	
	
	
	/* replaces spcifier with class */
	
	function check_alignment ($specifier) {
	    $class='other';	//defaul class paragraphs don't work
		switch ($specifier) {
			case '|c': 	$class = 'centered border-left';
						break;
			case '|c|': $class = 'centered border-left border-right';
			            break;
			case 'c' : 	$class   = 'centered';
						break;
						
			case '|l': 	$class = 'left border-left';
						break;
			case '|l|': $class = 'left border-left border-right';
			            break;			
			case 'l': 	$class   = 'left';
						break;	

			case '|r': 	$class = 'right border-left';
						break;
			case '|r|': $class = 'right border-left border-right';
			            break;	
						
			case 'r': 	$class   = 'right';
						break;	
			case 'P': 	$class   = 'right';
						
			
			}	
		return $class;	
	}
	
	
	function unprotect_multicolumn ($text) {
		
		$k=1;
		foreach (self::$multicol_array as $value) {
		  $colspan = self::$multicol_array['MULTICOLUMN'.$k][0];
		  $specifier = self::$multicol_array['MULTICOLUMN'.$k][1];
		  $class = self:: check_alignment ($specifier);
		  $patterns[] = '/MULTICOLUMN'.$k.'/xu'; 
		  $replacements[] = '<td colspan="'.$colspan.'" class = "'.$class.'">'.self::$multicol_array['MULTICOLUMN'.$k][2].'</td>';
		  $k++;
		}
		
		//echo_array(self::$multicol_array);break;
		if (isset($patterns)){return preg_replace($patterns, $replacements, $text);} else { return $text;}
	}
	
	
	/**
	 *	Undo TDS TDE MULTICOLUMN
	 *	
	 *
	 */
	function undo_cells ($text) {
		
		$patterns[] = '/TDS\dMULTICOLUMN(\d*)/ux';
		$replacements[] = 'MULTICOLUMN$1';
		$patterns[] ='/TDE/ux';
		$replacements[]='</td>';
		
		$z=preg_replace($patterns, $replacements, $text);
		
		// add td classes
		$patterns ='/TDS(\d)/ux';
		
		$z = preg_replace_callback($patterns, array($this,'add_td_classes_callback'), $z);
		
		return $z;
	}
	
	function add_td_classes_callback($values) {
	$class= $this->specifier_classes[$values[1]-1];
	//echo $class;
		//$class='left border-left';
	    //print_r(self::$specifier_classes);break;
	    //$class = self::$specifier_classes[1];
		//echo $class.', ';
		$z = '<td class="'.$class.'">';
		return $z;
	}
	
	
	
	/**
	 *	Handle the \tabular replacements
	 */
	function tabular_main ($text) {
		$z = $this->remove_and_from_multicolumn($text);
		
	    $z = $this->get_td ($z);
		//echo_array($this->specifier_classes);
		$z = self::undo_cells ($z);
		//echo_array($this->specifier_classes);
		$z = $this->unprotect_multicolumn ($z);
		
		
		return $z;
	}	
	
       
	
	 
	
	function tablecaption($text) {
        $pattern = "/\\\\tablecaption\{(.+)\}/xu";
        $z = preg_replace($pattern, '<div style="width:100%;display:block;margin:0 auto;line-height:1.4;text-align:none;text-justify:newspaper;
		   word-break:hyphenate;clear:both;margin-bottom:10px" >**TABLE** $1</div>', $text);
        return $z;
    }
	
	
    function numbertables($text) {
        $z = preg_replace_callback(
                "[\*\*TABLE(\s*.*)\*]", create_function('$m', '
        static $id = 0;
        $id++;
        return "<a id=\"table_".$id."\" class=\"black\" style=\"font-weight:bold\"> Table ".$id."</a>";
    '), $text);
        return $z;
    }
	
	// In html any \dotfill commands are cleared
	function dotfill($text){
		$pattern = "/\\\\dotfill/xu";
        $z = preg_replace($pattern, '', $text);	
		return $z;
	}
	
	// protect \\&  used for escaped ampersands  
	function protectAmpersand ($text) {
		$patterns[] = "/&amp/x";
		$replacements[] = 'BS';
		$patterns[] = "/BS;/x";
		$replacements[] = 'PROTECTEDAND';
		
		//$patterns[] = "/BSAND/x";
		//$replacements[] = 'PROTECTED';
		//$patterns[] = "/BS/x";
		//$replacements[] = '\\';
		$z = preg_replace($patterns, $replacements,$text);
		//echoPRE($z);break;
		return $z;
	}
	
	function unprotectAmpersand ($text) {
		$patterns[] = "/PROTECTEDAND/x";
		$replacements[] = '&amp;';
		
		$z = preg_replace($patterns, $replacements,$text);
		//echoPRE($z);break;
		return $z;
	}
	
	function tables_gamut ($text) {
	    //protect multicolumn etc
		$z = self::protectAmpersand ($text);
		$z = self::dotfill($z); //remove first any dotfills
		$z = self::multicolumn ($z);
		//if centered add classes in divs
		//$z = self::check_if_centered ($z, 'table');
		
		$z = self::tabular_main ($z);
		// 
		$z = self::tablecaption($z);
		$z = self::numbertables ($z);
		$z = self::unprotectAmpersand ($z);
		return $z;
	}
	
	
	function tablecaptiontex($text){
		$pattern = "/\\\\(tablecaption)\s*\{(.+)\}/xu";
        $z = preg_replace($pattern, '\caption{$2}', $text);		
        return $z;
	}
	
	
	
	function in_tex_gamut ($text) {
		$z = self::tablecaptiontex ($text);
		//echo $z;break;
		return $z;
	}
	
    public function startOfFile($text) 
    {
	    
		 if (filterclass::$in_tex) {
		       $z = self::in_tex_gamut($text);
			   return $z;
			} else {
			  //echo 'out';
			  return self::tables_gamut($text);
		}
			
	    
        
    }
    
        
}

?>

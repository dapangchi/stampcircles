<?php
/* 
 * @package     
 * @author      Y Lazarides
 * @copyright   Y Lazarides 2012
 * @link        
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

class Plate implements  startOfFile
{
    const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
    /**
	 *	draws a plate based on data inputs. Command structure
	 *  \plate{5}{5}{A1,A2,A3,A4,A5,
					 ...
	                 A1,A2,A3,A4,A5}
	**/
	function __plate ($text, $callback_name) {
		$pattern = "/[^_]\\\\plate\{(\d+)\}\{(\d+)\}\{([a-zA-Z0-9,\s]+)\}/mxu";
		return preg_replace_callback($pattern, array($this, $callback_name), $text);
	}
	
	
	/**
	 * We draw the table as divs, as this I think at this stage it is simpler
	 * (just need to fix the logic on borders)
	 * \plate{6}{8}{a,b,c,d,e,f,g,h,i,j}
	 *	I feel quite chaffed about this works so well
	 *	and saved me tons of hours.
	 *  All dimensions are fixed in px (we don't want it breaking
	 *	on re-size).
	**/
	
	function plate_callback_html($values) {
		//echo $values[3];break;
		$detail = explode(',', $values[3]);
		$acounter = 0;
		$outer_div_width = (($values[1]*30)-$values[1]);
		if (isset($values[1])) {
			$ilimit=$values[2];
			$jlimit=$values[1];
			$row = '<div  class="plate-outer" style="width:'.$outer_div_width.'px;">';
			for ($i = 1; $i <= $ilimit; $i++) {
				for ($j = 1; $j <= $jlimit; $j++) {
					$row .= '<div class="plate-inner">'.
					 @$detail[$acounter].'<sub class="plate-inner-number">'.($acounter+1).'</sub>'.
					'</div>';
					$acounter++;
				}
			  $row .= '<div style="clear:both"></div>';	
			}	
			$row .= '</div>';	
		  }
		  
		else {
		  return 'Something Funny Happened';  
		  }
		return $row;  
	}
	
	function plate_callback_tex($values) {
		//echo $values[3];break;
		//explode on comma
		$ilimit=$values[2];
		$jlimit=$values[1];
		$detail = explode(',', $values[3]);
		echo_array($detail);
		$acounter = 0;
		$s3 = '';
		for ($i = 1; $i <= $ilimit; $i++) {
			$s3 .= '|l';
		}
		$s3 .= '|';
		$s1 = '\begin{center}\begin{tabular}{'.$s3.'}'."\n";
		$s1 .= '\hline'."\n";
		$s2 = '
		      \end{tabular}\end{center}';
		//echoPRE($s1);	  
		
		
		if (isset($values[1])) {
			$row = '';
			for ($i = 1; $i <= $ilimit; $i++) {
			    $temp = '';
				for ($j = 1; $j <= $jlimit; $j++) {
							   
						
					$row .= $temp.' '.$detail[$acounter].'$_{'.($acounter+1).'}$';
					 //$detail[$acounter];.'&'.($acounter+1).''.
					'';
					$temp = '&';
					$acounter++;
				}
			  $row .= '\\\\
			          \hline  
			  ';	
			}	
			$final = $s1.$row.$s2;	
		  }
		  
		else {
		  return 'Something Funny Happened';  
		  }
		//echo '<pre>'.$final.'</pre>';  break;
		return $final;
	}
	
	
    public function startOfFile($text) 
    {
	if (filterclass::$in_tex) {
			   return self::__plate($text,'plate_callback_tex');
			} else {
			   return self::__plate($text,'plate_callback_html');
		}
	    
        
    }
    
        
}

?>










    
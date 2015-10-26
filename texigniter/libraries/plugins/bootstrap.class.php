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

class Bootstrap implements endOfFile
{
    //const regular_expression = '/^(\\\\LL\s*)$/';
        
    public function __construct()
    {
       
    }
    
	/**
     * Methods for some bootsrap constructs.
     */
    public function lead_begin($text) {
        $pattern = "/\\\\begin\{lead\}
                 /xu";
        return preg_replace($pattern, '<div class="lead">', $text);
    }

    public function lead_end($text) {
        $pattern = "/\\\\end\{lead\}
                 /xu";
        return preg_replace($pattern, '</div>', $text);
    }

    public function __bootstrap($text) {
	    //echo 'boostraps';break;
        $z = $this->lead_begin($text);
        return $this->lead_end($z);
    }
	
	
    public function endOfFile($line) 
    {
	    return self::__bootstrap($line);
        
    }
    
        
}

?>

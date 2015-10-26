<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  The Biblio Class
 *  takes care of bibliographies and references in Text.
 *  Bibliographies can be written at three levels.
 *		  Hardcoded in Page using mark-up
 *	      Page - level
 *        Document - Level
 *        System - Level
 *	They more or less default in the same manner like .ini
 *	settings files.
 *  Best workflow procedure is to have them located centrally
 *  at the system level.
 *  
 * */

define ("REFERENCES", 'References');
class Biblio {
    
    private $deploy = true;
    // properties for cites
    public $citestyle = 'alpha';
    // easier than having a method to convert to roman and faster
    // consider removing ''
    public $roman = array ('','i','ii','iii','iv','v','vi','vii','viii','ix','x'); 
    public $fnsymbols = array ('','*','**','***','†','‡','§','††','‡‡','§§');
    public $filter_value;
    public $fields;
    public $figurecounter;
    public $temp;
    public $tempa;
    public $tempc;
	public $citations_list = array();
    //template replacement
    private $curly = "\{\s*([[:alnum:]\/
                \\\\=\,\.
                \-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\s*";

    # generalize some regular expressions
    # for optional square brackets.
    # used for \command[]{}{}
   
    private $regex_square_bracket = '\[*([[:alnum:]\/\)\(\,\.\:\-\_\&\s\'\"\%]+)*\]';
    private $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
	    “” ‘ ’\/\)
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*
		\-\&\s\'\"\#\?\%\\\\]*';

    /**
     * Constructor - Sets paths based on 
     * development, staging or deployment
     * 
     */
    public function __construct($config = array()) {
        $CI = & get_instance();
        // we get the setup for setting paths either for cloud or local
        // here one can add more options.
        $CI->config->load('setup_paths');
        //echo 'biblio initialized';break;
        log_message('debug', "Biblio initialized");
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }
    /*
      Definitions for all filters follows.
     */

    function filterAll($content) {
        $content = $this->cite($content);
		$dbz='';
        return array($content, $dbz);
    }

    /*
     * Bibliography related functions
     * Bibliographies and references can be accessed for individual
     * books, chapters, pages or full libraries
     * 
     */
    public function bibliography () {
        
		//returns bibliography entry based on search criteria
       
		//echo 'loaded bibtexbrowser';
        $_GET['bib'] = 'references.bib';
		//$_GET['bib'] = $bibtex_file;
		$_GET['library'] = 1;
		//include('bibtexbrowser.php');
		$CI = & get_instance();
		
		//$Path['lib'] = 'bibtex/lib/';
		//$CI->load->library($Path.'lib_bibtex.inc.php');
		//$CI->load->library('bibtex/'.'bibtexbrowser.php');
		//setDB();
		//$database = $_GET[Q_DB]; 
        // returns the database object for the full
		// library
		//$database->cite('spink60');
		//return $database;
		//break;
       
     
    }  
   
    /* 
     *  The function allows LaTeX style cites
     *  to be inserted in text, i.e., \cite[]{}.
     *  The optional bracket is not really necessary for automating 
     *  numbering. Left it in just in case.
     *  @citestyle - allows different styling of cites
     *      'numeric', 'alpha', 'alpha', 'Alpha', 'roman', 'Roman'
     *  need to fix spacing rationally.
     */
    function cite($text) {
        // creates cites
        // numeric or alphanumeric
		//echo 'In CITE'; break;
        global $a;
        $a = '';
        $temp = $this->regex_allowed_chars_in_text;
        $pattern = '/\\\\cite\[?('.$temp.'?)\]*\{('.$temp.')\}/xui';
        $z = preg_replace_callback($pattern, array($this, 'cite_callback'), $text);
        if (!empty($a)) {
            $z = $z . "\n<h4 style=\"clear:both\">".REFERENCES."</h4>\n ";
        }
		//echo_array($this->citations_list);
		
		//echo $a;break;
		//need to check if valid utf at this point
		 if (isset($z)&& isset($a)) return $z . trim($a);
			else return $text;
        
    }
    /*
     * cite_callback - handles replacements from mark-up
     * to replacement.
     * 
     * We keep track of two counters 
     *   @cite_id  a counter to use for id in html
     *                 and also for indexing symbol
     *                 and roman arrays
     *   @cite_id_alpha similar to above but for alphabetic cite
     *                 markers.
     * TODO - think of alphabets in languages other than english  
     */
    function cite_callback($m) {
        static $cite_id = '1'; 
        static $cite_id_alpha = 'a';
        static $cite_text = "";
        global $a;
        $citestyle = $this->citestyle;
        $fnsymbols = $this->fnsymbols;
        $roman = $this->roman; 
        $replacement ='';
		$this->citations_list[$m[1]] = $m[2];
        (isset($m[2]))? $replacement = $m[2] : $replacement ='';
		// Choose how to show superscript alpha, symbol, numeric
        if ($citestyle === 'symbol')
            $fnsymbol = $fnsymbols[$cite_id];
        else if ($citestyle === 'alpha')
            $fnsymbol = $cite_id_alpha;
        else if ($citestyle === 'Alpha')
            $fnsymbol = strtoupper($cite_id_alpha);
        else if ($citestyle === 'roman')
            $fnsymbol = $roman[$cite_id];
        else if ($citestyle === 'Roman')
            $fnsymbol = strtoupper($roman[$cite_id]);
        else if ($citestyle === 'numeric')
            $fnsymbol = $cite_id;
        else {
            $fnsymbol = $cite_id;
        }
        
        // we first build the text for the notes
        $a = $a . "\n".$cite_text
                . '<p style="text-indent:0pt"><a id="' . $cite_id . '" href="#top-' . $cite_id . '">'
                . '<sup> ' . $fnsymbol . '</sup>'
                . '</a> ' . $replacement . "</p>\n";
        // link for cite marker
        $t = '<a id="top-' . $cite_id . '" rel="tooltip" title="' . htmlentities($replacement) . '" href="#' . $cite_id . '">'
                . '<sup id="top-"' . $cite_id . '"> '
                . $fnsymbol . '</sup></a>';
        $cite_id++;
        $cite_id_alpha++;
        return $t;
    }

     
    
    
    
   
} //end class



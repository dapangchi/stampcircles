<?php
/* 
 * @package     PHP5 Citations Parser
 * @author      Y Lazarides
 * @copyright   Y Lazarides April 2013
 * @link        
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

class Cite implements startOfFile
{
    
    private $regex_allowed_chars_in_table = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
	    \p{Pi} \p{Pf}  
	    \/\) \|
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*\{\}
		\-\&\s\'\"\#\?\%\\\\ ]*?';
	private $regex_square_bracket = '\[*([[:alnum:]\/\)\(\,\.\:\-\_\&\s\'\"\%]+)*\]';
    private $regex_allowed_chars_in_text = '[[:alnum:]\p{L}\p{N}\p{Sc}\p{Pd}
	    “” ‘ ’\/\)
        \(\>\<\[\]\$\=\`\'\^\,\.\:\/\_\;\/\+\!\*
		\-\&\s\'\"\#\?\%\\\\]*';
		
	static $multicol_array = array ();	
	static $specifier_classes = array ();
	
	static $cite_keys = array ();
	var $reformatted_entries_array = array ();
	
	
	static $bibliography_text = '';
	public $citestyle = 'alpha';
    // easier than having a method to convert to roman and faster
    // consider removing ''
    public $roman = array ('','i','ii','iii','iv','v','vi','vii','viii','ix','x'); 
    public $fnsymbols = array ('','*','**','***','†','‡','§','††','‡‡','§§');
	
	// Entry types understood virtually by all BibTeX styles.
	static $bib_types = array ('article', 'book', 'booklet', 'conference', 'inbook',
								'inproceedings', 'manual', 'masterthesis', 'phdthesis', 'mis',
								'techreport', 'unpublished','incollection');
	
		
									
	
	static $entry_types = array ('author',
	                       'title','journal','year','volume',
						   'pages','number',
						   'month','acknowledgement','bibdate',
						   'bibsource','issn','isbn',
						   'address','edition','publisher','institution');
						   
	static  $specials = array ('string', 'comment');
	
	// We allow some entries to have a prefix						
	static $entry_types_prefix = array ('volume'=>'<span class="bibtex-volume">Vol:</span>',
											'pages'=>'pages:',
											'isbn'=>'isbn:',
											'issn'=>'issn:',
										);
	static $decorations = array ('article'=>'{{author}}, <span>{{title}}</span>');
	
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
        log_message('debug', "Cite initialized");
    }
    
    
	
	/* 
	 *	Gets a full citation as a key value using a citekey
	 *	\cite{citekey}  returns the full citation entry
	 *	as an array.
	 */
	function get_reference ($search='agabeg') {
		$arr = $this->reformatted_entries_array; 
		foreach ($arr as $array){
			foreach($array as $key=>$val) {
			//if echo_array($reformatted_entries_array[73]['hand02']);
					if ($search === $key) {
				        //echoPRE('FOUND');
						return  $val;
					} else 
					 {
						continue;
					 }
			}
		}	
		
	}
	
	/*	Helper function to parse individual entry
	 *	lines for entry fields
	 *  title = {This is a Title},
	 *  Entries might or might not have curly brackets
	 *  The last entry does not have a comma
     *  we remove it if there is one.	 
	 */
	function parse_line ($search, $row) {
		$pattern = '/'.$search."\s*\=\s*(.+|\d+)(|\r|\n|\,)/ux";
		$m = preg_match($pattern, $row, $match);
		if (isset($match[1])) {
		        // trim trailing comma
				$match[1] = rtrim($match[1], ',');
				// remove curlies or "" not necessary in html
				$patterns[] = '/\}|\{/'; 
				$replacements[] = '';
				
				//PROTECT QUOTATIONS FROM PARSING ETC
				$patterns[]='/\\\\\"/';
				$replacements[] = 'QUOTATION';
				$patterns[]='/\"/';
				$replacements[] = '';				
		        $match[1] = preg_replace($patterns, $replacements, $match[1]);
				//UNPROTECT QUOTATIONS
				$patterns[]='/QUOTATION/';
				$replacements[] = '\\"';				
		        $match[1] = preg_replace($patterns, $replacements, $match[1]);
				
				//echo $z;break;
			return $match[1];	
		} 
		return false;
	}
	
	/**
	 * 	Decorates a full entry in html the wrapper in <p>
	 *  is left to the main routinee
	 *	
	 */
	
	function decorate_entry($template_vars, $template) {
		foreach ($template_vars as $key => $value) {
			//initialize prefix 
			$prefix = '';
			if (isset(self::$entry_types_prefix [$key] )) {
				$prefix = self::$entry_types_prefix[$key];
			}
			$patterns[] = '/\{\{\$'.$key.'\}\}/'; 
			$replacements[]  = isset($template_vars [$key])?$prefix.' '.$template_vars[$key]:' ';
		}
		$z = preg_replace($patterns, $replacements, $template);	
		// not all entries will always have
		// values and hence we clean them from the template
		// clean any unknown variables in template. [check for other punct]
		$z = preg_replace('/\{\{(\$.*?)\}\}\,/xu','',$z);
		return $z;
	}		  
	
	// main decorate function //
	function decorate ($template_vars, $entry_type='article') {
	
		$template_techreport = trim("\n".'<span>{{$author}}, <span style="font-style:italic">{{$title}}</span>, {{$journal}}, {{$volume}},{{$pages}}, {{$issn}},{{$isbn}},{{$publisher}}, {{$address}}, {{$year}}.'."\n</span>");
		
		$template_article = trim("\n".'<span>{{$author}}, <span style="font-style:italic">{{$title}}</span>. {{$journal}}, {{$volume}},{{$pages}}, {{$issn}},{{$isbn}},{{$institution}}, {{$address}}, {{$year}}.'."\n</span>");
		
		$template_masterthesis = trim("\n".'<span>{{$author}}, <span style="font-style:italic">{{$title}}</span>., ,{{$pages}}, {{$issn}},{{$isbn}}, Master Thesis, {{$institution}}, {{$address}}, {{$year}}.'."\n</span>");
		
		$template_phdthesis = trim("\n".'<span>{{$author}}, <span style="font-style:italic">{{$title}}</span>.  {{$volume}},{{$pages}}, {{$issn}},{{$isbn}}, Ph. D. Thesis, {{$institution}}, {{$address}}, {{$year}}.'."\n</span>");
		
		if ($entry_type==='techreport'):
			$template = $techreport_template;
		elseif ($entry_type === 'masterthesis' ):
			$template = $template_article;	
		elseif ($entry_type === 'article' ):
			$template = $template_article;
		else:
			$template = $template_article;
		endif;
		
		
		return self::decorate_entry($template_vars, $template);	
	
	}
	
	/*	Helper function to get the type
	 *	of entry, i.e., article, book, etc
	 *	we assume that the user has formed these
	 *  right.
	 *  I am not too sure if I need to fullproof this
	 *  at this stage.
	 */
	
	function get_type ($line) {
		$pattern = '/(.*)\{/ux';
		$m = preg_match($pattern,$line,$match); 
		//echo_array($match);break;
		in_array(strtolower($match[1]),self::$bib_types)? $z = strtoupper($match[1]): $z='UNKNOWN';
		return $z;
	}
	
	// get the cite key from an entry
	function get_cite_key ($entry) {
		$pattern = '/\{(.*)\,/ux';
		$m = preg_match($pattern,$entry[0],$match);
		$cite_key = $match[1];
		return $cite_key;
	}
	
	// check if @string {}
	function check_if_preamble_type ($entry) {
	    //echo_array($entry);
		$pattern = '/preamble\s*/ux';
		$m = preg_match($pattern,$entry[0],$match);
		//echo_array($match);//break;
		if ($m) {
			//echo_array($entry);
			return true;
		} 
		  
	}
	
	// check if @string {}
	function check_if_string_type ($entry) {
	    //echo_array($entry);
		$pattern = '/string\s*\{\s*(.*)\}/ux';
		$m = preg_match($pattern,$entry[0],$match);
		//echo_array($match);//break;
		if ($m) return true;
	}
	
	/* We now parse each individual entry
	 * our aim is to return the entries in an associate array
	 * where the cite key is the key i.i,
	 * [Akwai:TB11-4-665]=> array (entry_details)
	*/
	
	function parse_entry ($entry) {
	    global $count;
		// no need to parse further if the entry is @preamble or @string
		if (self::check_if_string_type ($entry)) return false;
		if (self::check_if_preamble_type ($entry)) return false;	
		
		
		// check if is valid entry and get type e.g ARTICLE
		$entry_type = self::get_type($entry[0]);
		$temp['type'] = $entry_type; 
				
		//  extract the citekey e.g Akwai:TB11-4-665
		$cite_key = self::get_cite_key ($entry);
		$temp['citekey'] = $cite_key;
					
		// slice the first element out and remove any empty
		// elements of the array. 
		$output = array_filter(array_slice($entry, 1)); 
		//echo_array($output);
		
		// collect all types in temp array
		foreach($output as $row)
		{
			foreach (self::$entry_types as $type) {
				$check = self::parse_line ($type, $row);
				$check? $temp[$type] = $check :NULL;
			}
		}
				
		//If we have a valid ARTICLE etc combine the two
		(isset($entry_type))? $reformatted_entry[$cite_key] = $temp :'ERROR';
		
		
		
		//decorating for bibliography.
		// move to function
		$s = '';
		
		//echoPRE('REFORMATTED ENTRY');
		//echo_array($reformatted_entry);
		
		
		foreach ($reformatted_entry as $keys=>$val) {
			//if ($ref_entry['type']==='ARTICLE') {
			   //isset($template_vars[$key])? $template_vars[$key]:NULL; 
			   //$template_vars[$ref_entry_key] = 'TEST';
			   foreach ($val as $akey=>$value) {
			      //echo_array($val[$akey]);
				  $template_vars[$akey] = $val[$akey];
			   }
			   //echo_array($template_vars);
			//}
			
			// put into HTML using a template
			$s = self::decorate ($template_vars, $entry_type);
			$s = ++$count.'. '.$s;
				
		}
		
		// save the html in the array as well
		$reformatted_entry[$cite_key]['html'] = $s;
		
		// We store the full bibliography in html here for later
		self::$bibliography_text .= '<p class="bibtex-entry" style="padding-left:2.1em;text-indent:-2em">'.$s.'</p>';
		//echo($s);
		
		//break;
		// we now have everything in the array we can go back
		return $reformatted_entry;
	}
	
	/** is an extended version of the trim function, removes linebreaks, tabs, etc.
	 */
	function xtrim($text) {
		$text = trim($text);
		// we remove the unneeded line breaks
		// windows new line is **\r\n"** and not the other way around!!
		$patterns[] = '/\%.*\r\n/u';$replacements[] = '';
		$patterns[] = "/\r\n/u"; $replacements[] = "\n";
		//$patterns[] = "/\n/u"; $replacements[] = ' ';
		//$patterns[] = "/\t/u"; $replacements[] = ' ';
		//$patterns[] = "/\s\s+/ux"; $replacements[] = ' ';
		$text = preg_replace($patterns, $replacements, $text);
		$text = preg_replace("/^\n+|^[\t\s]*\n+/mu", "", $text);
		return $text;
	}
	
	// call function to clean 
	function  clean_bibtex_file ($text) {
		$text = self::xtrim ($text);
		//echo $text;break;	
		return $text;
	}
	
	
	// Entry starts from @article or similar and ends with "}" if well formed.
	//
	// @ARTICLE{Aiello:TB3-1-30,
    // author = {L. Aiello and S. Pavan},
    // title = {{{{\TeX} news from Pisa}}},
    // journal = j-TUGboat,
    // acknowledgement = {#ack-bnb# and #ack-nhfb#},
    // bibdate = {Fri Jul 13 10:24:20 MDT 2007},
    // bibsource = {ftp://ftp.math.utah.edu/pub/tex/bib/tugboat.bib; //  http://www.math.utah.edu/pub/tex/bib/index-table-t.html#tugboat},
    // issn = {0896-3207}
    // }
	
    function read_bibtex_file ($path)   {
		//$left_bracket_counter = 0;
		//$right_bracket_counter = 0;
		//$path = BIBTEX_BASE;
		$modified_text = '';
		
		// The $path has been checked by calling routine
		$filecontent = file_get_contents($path);
		// clean the file nd normalize end of lines to unix style
		$filecontent = self::clean_bibtex_file ($filecontent);	
		
		// STEP 1 - split into entries
		$entries = preg_split('/@/', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
		 
		 
		// We now sent each entry to be parsed
		// further and to return the formatted text
				
		foreach($entries as $entry)
		{
			//Needs checking here i.e. use isset rather
			$entry_array = preg_split('/\r\n|\r|\n/', $entry);
			$parsed = self::parse_entry($entry_array);
			if (isset($parsed)) {	
				$this->reformatted_entries_array[] = $parsed;
			}	
			
		}
		
		
	}
	
	function wrap_bibliography () {
		$z2 = "\n <div class=\"bibtex-bibliography\">\n <span class=\"bibtex-bibliography-heading\">".BIBLIOGRAPHY."</span> \n".self::$bibliography_text.'</div>';
		// export to filterclass for persistence and to avoid reloading?
		filterclass::$bibliography_store = $z2;
		return true;
	}
	
	function check_for_bibliography_command ($text) {
		$pattern = '/\\\\bibliography\s*\{(.+)\}/xu';
		if (preg_match($pattern, $text, $match)) return $match;
		return false;
	}
	function remove_bibliography_command ($text) {
		$pattern = '/\\\\bibliography\s*\{(.+)\}/xu';
		$text = preg_replace($pattern, '', $text);
		return $text;
	}
	
	function get_default_bib_file ($filename, $portal, $location) {
		$path = BIBTEX_BASE.$filename.'.bib';
		//echo $path;break;
		if (file_exists($path)) {
			//check if it has been moved to the TeX folder
		    //we need this to keep everything in one place
			
		    $texpath = WEBROOT.$portal.'/'.$location.'/tex/'.$filename.'.bib';
		    copy($path,$texpath);
		} else {return false;}  
		return $path;
	}
	
	/* Get Bibliography path */
	function get_bibliography_path ($filename) {
		$portal = filterclass::$portal;
		$location = filterclass::$location;
		
		$path = WEBROOT.$portal.'/'.$location.'/'.$filename.'.bib';
		//echoPRE($path);
		if (file_exists($path)) {
			//check if it has been moved to the TeX folder
		    //we need this to keep everything in one place
		    $texpath = WEBROOT.$portal.'/'.$location.'/tex/'.$filename.'.bib';
		    copy($path,$texpath);
		} else {
			//get from default
			$texpath = self::get_default_bib_file($filename,$portal,$location);
		}  
		return $texpath;	
	}
	
	/**
     *	This is the main method used 
	 *  we only print it if a \bibliography command is found
	 *  and if a \cite{*} command is also found.
	 **/
	function transform_bibtex_to_html ($text) {
		$matches = self::check_for_bibliography_command ($text);
		if ($matches) {
		    $text = self::remove_bibliography_command ($text);
			$filename = $matches[1];
			$path = self::get_bibliography_path ($filename);
			$z1 = self::read_bibtex_file ($path);
			//break;
			self::wrap_bibliography();
			return $text;
		}
		return false;
	}
	
	// main routine for reading the bibtex file (s) and 
	// re-formatting for html
	// for TeX we let TeX do the donkey work, with whatever
	// bib package we desire.
	
	function main ($text) { 
		
		$z = self::transform_bibtex_to_html ($text);
		// only parse if '\bibliography{file1,file2,file3}' found
		// no need to do further work in such a case
		if ($z) {
			$z = self::cite ($z);
			return $z;
		}	
    	return $text;
	}
	
	/* 
     *  The function allows LaTeX style cites
     *  to be inserted in text, i.e., \cite{}.
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
        $pattern = '/\\\\(?:cite|bibentry)\{('.$temp.')\}/xui';
        $z = preg_replace_callback($pattern, array($this, 'cite_callback'), $text);
        if (!empty($a)) {
            $z = $z . "\n<h4 style=\"clear:both\">".REFERENCES."</h4>\n ";
        }
		//echo_array($this->citations_list);
		
		
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
	 * TODO Compressing entries that have same reference [a,b,c,d] etc
     */
    function cite_callback($m) {
        static $cite_id = '1'; 
        static $cite_id_alpha = 'a';
        static $cite_text = "";
        global $a;
        $citestyle = $this->citestyle;
        $fnsymbols = 'alpha';
        $roman = 'roman'; 
        $replacement ='';
		//echo_array($m);
		//$this->citations_list[$m[1]] = $m[1];
		
		// We first put all the captured citation keys in an
		// array. 
		self::$cite_keys[] = $m[1];
		
		
		// Now we fetch the record from the stored array
		$reference_item = $this->get_reference ($m[1]);
		$reference_item_decorated=(isset($reference_item))?  self::decorate ($reference_item,'article'):-1;
				
        (isset($reference_item))? $replacement = $reference_item_decorated : $replacement = '<span style="color:red" class="red">Missing Reference</span>';
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
		//echoPRE($cite_text);
		
        $a = $a . "\n".$cite_text
                . '<p style="text-indent:0pt"><a id="' . $cite_id . '" href="#top-' . $cite_id . '">'
                . '<sup> ' . $fnsymbol . '</sup>'
                . '</a> ' . $replacement . "</p>\n";
        // link for cite marker
        $t = '<a id="top-' . $cite_id . '" rel="tooltip" title="'
		        . strip_tags($replacement). '" href="#' . $cite_id . '">'
                . '<sup id="top-"' . $cite_id . '"> '
                . $fnsymbol . '</sup></a>';
        $cite_id++;
        $cite_id_alpha++;
        return $t;
    }

     
	
	
	
    public function startOfFile($text) 
    {
	     //filterclass::$in_tex = true; 
		 if (filterclass::$in_tex) {
		       //$z = self::in_tex_gamut($text);
			   return $text;
			} else {
			  //echo 'out';
			  	  
			  (filterclass::$in_menu)? $z = $text: $z = self::main ($text);
			  return $z;
		}
			
	    
        
    }
    
        
}

?>


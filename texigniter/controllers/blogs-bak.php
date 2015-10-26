<?php

/* Blogs controller
 cleaned-up version
 Y. Lazarides
 */
include_once('../markdown.php');
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class Blogs extends CI_Controller {

  var $user = 'guest';
  public $info_box;
  private $edit_allowed;
  public static $splash = 'splash-01.jpg';
  public static $view = 'stamps_view';

  function Blogs() {
    parent::__construct();
    $this->edit_allowed = true;
    $this->config->load('setup_paths');
    $this->load->helper('basics');
    $this->load->helper('utilities');
    $this->load->helper('file');
    $this->load->library('filterclass');
    // $session=$this->session;
    // echo $this->user=$this->session->userdata('DX_username');
    define('CONTENT_BASE', $this->config->item('content_base'));
    putenv('db=texigniter');
 		//echo getenv('db') ;
 		$user = getenv('user');
 		$pass = '';
 		$user ='yannisl';
 		$db ='biblio';

		/* works
 		$baseUrl = "http://yannisl.couchappy.com/$db";//$user:$pass@$user
		/* $auser = json_decode(
 			file_get_contents($baseUrl.'/'.'')
 		);

		var_dump($auser);*/

/*
/*
 $client = new Client(['base_url'=>$baseUrl]);
/*
$client->setDefaultOption('exceptions', false);

//$putDbResponse = $client->send();
 $doc = array('name' => 'john', 'age' =>
//35);
 $postDocRequest = $client->post('', ["Content-Type" =>
//"application/json", 'body'=>json_encode($doc)]);
 print_r($postDocRequest);

break;
 $putDbRequest = client::put('');
 $putDbResponse = client::send();
$postDocResponse = $postDocRequest->send();
 $rev1 =
json_decode($postDocResponse->getBody())->{'rev'};
 $id =
json_decode($postDocResponse->getBody())->{'id'};
 echo "The new document's id
is $id and the first revision is $rev1.\n";

$doc['age'] = 36;
 $doc['_rev'] = $rev1;
 $putDocRequest = $client->put("$id",
array(), json_encode($doc));
 $putDocResponse = $putDocRequest->send();
 echo
$putDocRequest;
 echo $putDocResponse;
 $rev2 =
json_decode($putDocResponse->getBody())->{'rev'};
 echo "The second revision is
$rev2.\n";
 echo "Now we will delete the document. This is the response we
got:\n";
 //$deleteRequest = $client->delete("$id?rev=$rev2");
//$deleteResponse = $deleteRequest->send();
 //echo $deleteResponse->getBody();

//break;

		//$client = new GuzzleHttp\Client(['base_url' =>
		//'http://yannisl:PUREFAJO@yannisl.iriscouch.com']);
 	//	$username =
		//'yannisl';
 //$password = 'PUREFAJO';
 //$auth = base64_encode($username . ":" .
		//$password);
 //$client->setDefaultOption('auth', array($username, $password,
		//'Any'));

		//$client->put('/texigniter/', [
           //'body' =>
		//'{"_id":"123","data":"Foo"}',
         // ]);
 break;

// select a collection (analogous to a relational database's table)

/* add a record
   "compile": {
         "options": {
             // Which
/* compiler to use. Can be latex, pdflatex, xelatex or lualatex
/* "compiler": "lualatex",
             // How many seconds to wait before
/* killing the process. Default is 60.
             "timeout": 40
         },
         //
/* The main file to run LaTeX on
         "rootResourcePath": "main.tex",
         //
/* An array of files to include in the compilation. May have either the content
         //
/* passed directly, or a URL where it can be downloaded.
         "resources": [{
/* "path": "main.tex",
             "content":
/* "\\documentclass{article}\n\\begin{document}\nHello World\n\\end{document}"
         }, {
/* "path": "image.png",
             "url": "www.example.com/image.png",
/* "modified": 123456789 // Unix time since epoch
         }]
     }
 */

  }

  function index() {
    $data['title'] = "Home";
    $data['heading'] = "My Real Heading";
    $this->load->model('Articlesmodel');
    $this->Articlesmodel->article_name = "../blogs/$title" . '.dat';
    $data['content'] = $this->Articlesmodel->get_article();
    //loads the parser filters
    $this->load->library('filterclass');
    //change wiki links and place into content
    $data['content'] = $this->filterclass->phpLink($data['content']);
    $data['feature'] = $this->filterclass->feature($data['content']);
    $data['keywords'] = $this->filterclass->parseField('keywords', $data['content']);

        //let us get the list of articles in the directory
        //$this->Articlesmodel->path = '../blog/';
         //$data['list'] =
        //$this->Articlesmodel->get_articles_list();
        //let us view what we got by
        //sending data and choosing the view
        //$this->load->view('article_view', $data);
    }

	/**
 	 *  Navigates to Wikipedia and fetches
 	 *  content. Very crude
	 * at this point, just demonstrating
 	 *	the principle behind it.
 	**/

  function materials () {
    $data = '';
 	  $this->load->view('front',$data);
  }

  function go($title="CodeIgniter",$blog="cms"){
    $this->load->model('goweb');
    $data=$this->goweb->go($title);
		//echo_array($data);
    $content=$data['content'];
    //echo $content;
		//$wiki=$this->load->view('admin/middle',$data,true);
 		$this->load->model('Articlesmodel');
 		$this->Articlesmodel->path='../'.$blog.'/';
 		$data['list']=$this->Articlesmodel->get_articles_list();
    $view='stamps/wiki_view';
		$data['web_name'] = 'Data Bank';
    $data['msg'] = '';
		$data['countrymenu'] = '';
    $data['countryname'] = '';
 		$data['list'] = '';
    $data['pdftitle'] ='';
 		$data['location'] = '';
    $data['portal'] = '';
 		$data['references'] = '';
    $data['number_headings'] = 'false';
 		$data['title'] = $title;
 		            //shows the second navigation button
 		$data['nav_button2'] = 'show().';
 		$template=$this->load->view($view, $data, true);
    $this->load->library('filterclass');
            //$template=$this->filterclass->filterAll($template);

            //configure tidy
             $config=array(
            //'indent'=>true,
               'indent-spaces'=>2,
            //'output-xhtml'=>true,
                'wrap'=>68,
            //'force-output'=>true
             );

            //clean with tidy
 //$template = tidy_parse_string($template,
            //$config);
 tidy_clean_repair($template);

           $this->output->set_output($template);

  //$this->load->view($view,$data);
 }

//  main controller for fetching data from the web
//I have placed anything that
//  fetches
// data into Models
// This way they can also be called from components

function snoop($title="CodeIgniter"){

  //loads snoopy
 //let us be nice to wikipedia!
 //this is just Wikipedia content
  //re-formatted

   $content=$this->__snoop($title,'wiki');
  //$content=$this->__post_processor($content);
  //$data['menu']=$this->__wiki_toc($content);
  //$data['category']=$this->__wiki_cats($content);
  //$data['related']=$this->__wiki_main_articles($content);
  //$data['feature']=$this->__wiki_info_box($content);
  //$data['content']=$content;
   $data['title'] = $title;
  //$this->load->model('Articlesmodel');
  //$this->Articlesmodel->path='../blog/';
  //$data['list']=$this->Articlesmodel->get_articles_list();
  $data['feature']= ". . .
  //It is extremely important that the development of intelligent machines be
  //pursued, for the human mind is not only limited in its storage and
  //processing capacity but it also has known bugs: It is easily misled,
  //stubborn, and even blind to the truth, especially when pushed to its
  //limits.";
    //removes redundant items from Wikipedia
  //$this->load->library('extracttext');
  ////$test.=$this->extracttext->extract($content,'External links', 'edit');
  ////echo 'test'.$test;
  $this->output->cache(0);

  $config = array(
          'indent'         => true,
          'output-xhtml'   => true,
          'wrap'           => 200);
  //$data['content']=tidy_repair_string($content,$config,'utf8');//$tidy->parseString($html,
  //$config, 'utf8');

  $this->load->view('stamps/stamp_view',$data);
 }

	/**
 	 *	The main function to get content from the web
 	 *  using Snoopy.
 	 *
 	 *  @title - what is after the basic site url for wiki
 	 * the wikipedia article.
 	**/

	function __snoop($title,$go){
 //initializes snoopy and fetches results
	//go=wiki|cuil|powerset
 if ($go == 'wiki'){
	$uri='http://en.wikipedia.org/wiki/';

  }
 else
 {
 $uri=$go;
 }
 $url=$uri.$title;
 $this->load->library('snoopy');
  $this->snoopy->host=$url;


   $s["__utmz"]="225628120.1236878310.3.3.utmccn=(organic)|utmcsr=google|utmctr=spinks+auctions+stamps|utmcmd=organic";
   $s["__utma"]="225628120.2143952515.1236444222.1236701137.1236878310.3";//ok
   $s["utmccn"]="(organic)|utmcsr=google|utmctr=spinks+auctions+stamps|utmcmd=organic";
   $s["__utmc"]="225628120";
 $s["Spink"]="tokenID=1381939";
   $s["ASPSESSIONIDAQASTSQS"]="EKINHPDAHDCIAEPPILDAMDEO";

  //$this->snoopy->cookies=$s;
   $this->snoopy->fetch($url);
  //$content=$this->snoopy->results;
   return $content;
 }

    /*  This is the main controller for the stamps portal
      *  as a matter
    /*  of fact works with all portals
      *
    /*  countries/nameofcountry/tittle/pagenumber
      *
      */

  public function stamps($portal = "stamp-notes", $location = 'abu-dhabi',
    $title = "introduction", $page = "1") {
    $this->_common($location, $title, $portal, 'stamps_view');
  }

    /*
         /*
      * Writes to a .ini file not as elegant as some
      *
    /*
     of the pecl classes but does the job quickly
      *
      */
    /*
     function write_ini($array, $file) {
         $res = array();
    /*
     foreach ($array as $key => $val) {
             if (is_array($val)) {
    /*
     $res[] = "[$key]";
                 foreach ($val as $skey =>
    /*
     $sval)
                     $res[] = "$skey = " .
    /*
     (is_numeric($sval) ? $sval : '"' . $sval . '"');
             }
    /*
     else
                 $res[] = "$key = " . (is_numeric($val) ? $val : '"' .
    /*
     $val . '"');
         }
         file_put_contents($file,
    /*
     implode("\r\n", $res));
     }

/*
 *  Reads settings from the three levels of
 *  configuration files allowable.
 *  system wise, document wise or page wise.
 *
 */

function _readini ($portal, $location, $title = '')
 {
  $page_src = $this->config->item('content_base')
                       . $portal . '/' . $location
                       . '/' .$title.'.ini';

  $document_src = $this->config->item('content_base')  . $portal . '/' . $location . '/' . $location . ".ini";
  $src_default = $this->config->item('system_settings_path');
  echo $page_src;

  // read page ini
  if (file_exists ($page_src)) {
    $ini_array_page = parse_ini_file($page_src, true);
  }

  // check if document.ini exists
  if (file_exists ($document_src)) {
        $text = file_get_contents($document_src);
             // corrections need to
        // remove later on $pattern = "/([^\"]Notes on
        // stamps)/miu";
        //$text = preg_replace($pattern, '"Notes on stamps"', $text);
        //if ($location !== 'China') {
        // $pattern = "/(China)/miu";
                 //$text =
        // preg_replace($pattern, ucfirst($location), $text);
             //}
        // file_put_contents($src, $text);
             // to remove up to here
         $ini_array = parse_ini_file ($document_src, true);
             //$ini_array =
        // (isset($ini_array_page))? $ini_array_page + $ini_array: $ini_array;
        // if (file_exists($src_default)) {
                 //$ini_array_system =
        // parse_ini_file($src_default, true);
        // //echo_array($ini_array_system);
                 //$ini_array =
        // array_merge($ini_array, $ini_array_system); // gets missing defaults
        // //echoPRE('combined');
 				//echo_array($ini_array);break;
        // $this->write_ini($ini_array, $page_src);
        // //echo_array($ini_array);break;
             //
        //}

        } else {
           ## If the .ini file does not exist the default settings
     ## file is fetched and copied.
     ## Not defensive in terms of directory
           $ini_contents = file_get_contents ($src_default);
           $pattern = "/China/uix";
           $ini_contents = preg_replace($pattern, ucfirst($location), $ini_contents);
           file_put_contents($src, $ini_contents);
           $ini_array = parse_ini_file($src, true);
   }
   // merge with system wise .ini in case fields are missing

        return $ini_array;
}


	/*
	 	/*
 	 *	Common functions for all templates
 	 *
 	 */

  function _common($location = 'blog', $title = "introduction", $portal = "countries",
 	                             $view = "stamps_view", $page = "1")
 	{
 	  //$this->output->cache(1);
 		// start benchmark
    $this->benchmark->mark('code_start');

        // we load the main filter class
        // $this->load->library('filterclass');

        // loads model
     $this->load->model('Articlesmodel');
    // $this->load->helper('date');
     $format = 'DATE_ISO8601';
     $time = time();
     //$data['date'] = standard_date($format, $time);

        # we read the .ini file if it existsthere are normally three levels
        # the portal level and the document level ini files can contain many
        # different settings we keep all TeX and other related information
        # here.

    $ini_array = $this->_readini($portal, $location, $title);

    if (isset($ini_array['mathjax']['mathjaxon']) && ($ini_array['mathjax']['mathjaxon'])) {
        if (isset($ini_array ['mathjax']['url'])) {
          $data['mathjaxurl'] = '"' . $ini_array ['mathjax']['url'] . '"';
        }
         else {
                 $data['mathjaxurl'] = '\'\'';
             }
         }
         else {
             $data['mathjaxurl'] = '';
         }

		     //echo $data['mathjaxurl'];break;
         ## set scripts
         if (isset($ini_array ['pdf']['pdftitle'])) {
             $data['pdftitle'] = '"' .
		        $ini_array ['pdf']['pdftitle'] . '"';
         } else {
		         $data['pdftitle'] = '';
         }

         // set some styles from ini files(isset($ini_array
         // ['footnotes']['footnotestyle']))?
         // $this->filterclass->__set('footnotestyle',$ini_array
         // ['footnotes']['footnotestyle'] ): false;
         //let us view what
         // we got by sending data and choosing the view
         // $data['web_name'] = $ini_array['web']['web_name'];
         // shows
         // the second navigation button$data['nav_button2'] =
         // 'show().';
         //$data['nav_button2'] ='';

        $this->Articlesmodel->article_name = CONTENT_BASE . $portal . "/" .
        $location . "/" . $title . '.dat';
        $this->Articlesmodel->article_comments = CONTENT_BASE . $portal . "/" .
        $location . "/" . $title . '.tlk';
 // set path for menu
        $this->Articlesmodel->country_path = CONTENT_BASE . $portal . "/" .
        $location . "/" . $location . ".menu";
 // next we load any specific  country or topic menu
 // we insert into data for template
 $datasource = $this->config->item('deploy');
        // if (($datasource === 'cloud') &&
        //($data['content'] =@file_get_contents('https://s3-us-west-2.amazonaws.com/stamp-notes/'.$location.'/'.$title.'.dat'))){
        //$data['msg']='cloud data';
 // }
        // else {
        $data['msg']='local';
        $data['content'] =
        $this->Articlesmodel->get_article();
   //}

$content = $data['content'];
 $data['comments'] =
$this->Articlesmodel->get_comments();
 $data['content'] =
 $data['content'] .
$data['comments'];

$data['location'] = $location;
 $data['portal'] = $portal;

filterclass::$location = $location;
 filterclass::$portal = $portal;
filterclass::$title = $title;

        $data['content'] = $this->filterclass->filterAll($data['content']);
        $data['content'] = $data['content'].filterclass::$footnote_store;
        $data['biblio'] = filterclass::$bibliography_store;
 		$data['biblio'] =
        $this->filterclass->filterAll($data['biblio']);
 		$data['content'] =
        $this->filterclass->unprotectChekmark($data['content']);

		//can also export to template if necessary
 		$data['content'] =
		//$data['content'].$data['biblio'];

		//apply extended markdown for any left mark-up
    //$markdown = \PEAR2\Text\Markdown_Extra();

    //$data['content'] = $markdown->transform($data['content']);
        $data['content'] = markdown($this->filterclass->filter_all);
        //echoPRE($data['content']);

        //*-- get all transclusions and do own filtering
 		// check here for
        //*-- none unicode
        //*-- //$this->filterclass->parseFields($data['content']);
         //
        //*-- we send transcluded vars to template
         //foreach
        //*-- ($this->filterclass->fields as $key => $value) {
           //  if
        //*-- (isset($value)) {
             //    $data[$key] = $value;
             //}
        //*-- else {
               //  $data[$key] = '';
             //}
        //*-- //echoPRE($key.'  '.$value);
         //}

        //$data['credit_source']='TESTING SOURCE';
         $data['user'] =
        //$this->user;
         $data['title'] = $title;
        ////$this->filterclass->parseField('title',$data['content']);
        //$data['logo'] = 'China';

        //calculate some statistics
        //$data['content']=toc(markdown($data['content']));
        ////$statistics = statistics($data['content']);
 //$data['content'] =
        //$data['content']."\n\n".$statistics;
 //echo $data['content'];break;
        //$data['content']=toc(markdown($data['content']));
// echo
        //$data['content'];break;

        $data['toc'] = '';

        // $data['toc']=toc_menu(markdown($data['content']));

		// Menus related get the list of all articles in the folder
		// $data['list'] = $this->articlesList ($portal, $location); get the parsed
		// menu from file (sidemenu on mosttemplates)
      //   $data['countrymenu'] =
		// $this->articlesMenu ();
//get breadcrump navigation
		// $data['navigation'] = $this->navigationArray();
    if (!filterclass::$navigationArray)
 		{
 			$data['navigation'] = $data['list'];
 		}
 		//temporary render all as below
		// $data['navigation'] = $data['list']; numbering parameters - sets
		// javascript to number

		$data['number_headings'] = 'true';
		(isset($ini_array['headings']['number_headings']))?
		$data['number_headings'] = $ini_array['headings']['number_headings'] :
		$data['number_headings'] = 'false' ;

		// We now check to see if we have any splash imagesin the database. We use
		// the Guzzle library. First create a Client for it.
 		$client = new \GuzzleHttp\Client();

		// The fields array will hold all the json data from couchdb.

		$fields =array();
    $client = new Client();
 // first try the document settings to see if they have been specifically set
 // in the database.
    $dns = 'http://yannisl.iriscouch.com/texigniter/';
    $dns = 'http://yannisl:PUREFAJO@localhost:5984/texigniter/';//$user:$pass@$user
    try {
		  $request = $client->createRequest('GET',
		  $dns.$location.'?revs_info=false');
 		  $response = $client->send($request);
		  //echo $response->getStatusCode();
		  $fields=json_decode($response->getBody(), true);
      self::$splash=$fields['splash'];
 		  //echo_array($fields);
      } catch
		    (RequestException $e) {
 		       if ($e->hasResponse()) {
 		          echo 'error';
 	         }
    }
 // try again for the particular page. has two http calls but simpler
 try {
		$request = $client->createRequest('GET',
		'http://yannisl:PUREFAJO@localhost:5984/texigniter/'.$location.urlencode('/'.$title).'?revs_info=false');
		$response = $client->send($request);
 		//echo $response->getStatusCode();
		$fields=json_decode($response->getBody(), true);
		self::$splash=$fields['splash'];
 		self::$view=$fields['view'];
		//echo_array($fields);
         	} catch (RequestException $e) {
 		if
		($e->hasResponse()) {
 		//echo $e->getResponse() . "\n";
 	}
 }

		// if there are none in the database use the application default.
		// isset($fields['splash'])? self::$splash=$fields['splash']:
		// self::$splash='splash-default.jpg';
 		isset($fields['view'])? self::$view=$fields['view']: self::$view='stamps_view';
 		//break;
		// connect

		$data['splash']=self::$splash;
    $this->load->view('stamps/' . self::$view,
		$data);
     }

	/*
	 	/*
 	 *	Helper function to get the list of articles in a
 	 *	folder.
 	 *
	/*
	 @$portal string portal bucket
 	 *  @location string a bucket
 	 *
	/*
	 returns a list of article file names in an array.
 	 */

function articlesList ($portal, $location) {
	$src = CONTENT_BASE . $portal . '/' .$location . '/';

	$this->Articlesmodel->path = $src;
	$menulist = $this->Articlesmodel->get_articles_list();
	$temp = '';
	if ((isset($menulist)) && (!empty($menulist)) ) {
		foreach ($menulist as $key=>$value)
		{
			$value=str_replace( '.dat', '', $value );//remove file extension
			$temp.='<a style="padding-left:3px"
			href="'.$value.'">'.ucfirst(r('_',' ',$value)).'</a>, ';
		}
	}
	return $temp;
}

	/*	Helper function to get the menu from a file
 	 *	menus are located in the
	/*	same directory as
 	 *  the articles
 	 */
 	function articlesMenu () {
		filterclass::$in_menu = true;
 		$menuText =
		$this->Articlesmodel->get_countrymenu();
    return $this->filterclass->filterAll($menuText);
 	}

	/*	Helper function to get the navigation array from
 	 *  the menu.dat. This is
	/*	parsed by the filterclass
 	 *  and returned as an array (based on the file
	/*	markup).
 	 */
 	function navigationArray () {
 		return	filterclass::$navigationArray;
 	}
 }

?>

<?php

# Blogs controller
# cleaned-up version
# Y. Lazarides
#

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class Blogs extends CI_Controller
{
    
    var $user = 'guest';
    public $info_box;
    private $edit_allowed;
    
    public static $splash = 'splash-01.jpg';
    
    function Blogs()
    {
        //changed for new version
        parent::__construct();
        
        $this->edit_allowed = true;
        
        //$this->config->load('setup_paths');
        $this->load->helper('basics');
        $this->load->helper('utilities');
        $this->load->helper('file');
        $this->load->library('filterclass');
        // $session=$this->session;
        // echo $this->user=$this->session->userdata('DX_username');
        
        putenv('db=texigniter');
        //echo getenv('db') ;
        $user = getenv('user');
        
        $user = 'yannisl';
        $db   = 'texigniter';
        //$baseUrl = "https://$user:$pass@$user.cloudant.com/$db"; 
    }
    
    /**
     *  Navigates to Wikipedia and fetches
     *  content. Very crude at this point, just demonstrating
     *    the principle behind it.
     **/
    
    function go($title = "CodeIgniter", $blog = "cms")
    {
        $this->load->model('goweb');
        $data    = $this->goweb->go($title);
        //echo_array($data);
        $content = $data['content'];
        //echo $content;
        //$wiki=$this->load->view('admin/middle',$data,true);
        // $this->load->model('Articlesmodel');
        //  $this->Articlesmodel->path='../'.$blog.'/';
        //  $data['list']=$this->Articlesmodel->get_articles_list();
        
        $view                    = 'stamps/wiki_view';
        $data['web_name']        = 'Data Bank';
        $data['msg']             = '';
        $data['countrymenu']     = '';
        $data['countryname']     = '';
        $data['list']            = '';
        $data['pdftitle']        = '';
        $data['location']        = '';
        $data['portal']          = '';
        $data['references']      = '';
        $data['number_headings'] = 'false';
        $data['title']           = $title;
        // shows the second navigation button
        $data['nav_button2']     = 'show().';
        $template                = $this->load->view($view, $data, true);
        $this->load->library('filterclass');
        //$template=$this->filterclass->filterAll($template);
        
        //configure tidy
        $config = array(
            'indent' => true,
            'indent-spaces' => 2,
            'output-xhtml' => true,
            'wrap' => 68,
            'force-output' => true
        );
        
        //clean with tidy
        //$template = tidy_parse_string($template, $config);
        //tidy_clean_repair($template);
        
        $this->output->set_output($template);
        
        //$this->load->view($view,$data);
    }
    
    //  main controller for
    //  fetching data from the web
    //  I have placed anything that fetches
    //  data into Models
    //  This way they can also be called from components
    function snoop($title = "CodeIgniter")
    {
        //loads snoopy
        //let us be nice to wikipedia!
        //this is just Wikipedia content re-formatted
        //
        $content          = $this->__snoop($title, 'wiki');
        $content          = $this->__post_processor($content);
        $data['menu']     = $this->__wiki_toc($content);
        $data['category'] = $this->__wiki_cats($content);
        $data['related']  = $this->__wiki_main_articles($content);
        $data['feature']  = $this->__wiki_info_box($content);
        $data['content']  = $content;
        $data['title']    = $title;
        $this->load->model('Articlesmodel');
        $this->Articlesmodel->path = '../blog/';
        $data['list']              = $this->Articlesmodel->get_articles_list();
        //$data['feature']= ". . . It is extremely important that the development
        //of intelligent machines be pursued, for the human mind is not only limited in its storage and processing capacity but it also has known bugs: It is easily misled, stubborn, and even blind to the truth, especially when pushed to its limits.";
        //removes redundant items from Wikipedia
        $this->load->library('extracttext');
        //$test.=$this->extracttext->extract($content,'External links', 'edit');
        //echo 'test'.$test;
        //$this->output->cache(0);
        
        $config = array(
            'indent' => true,
            'output-xhtml' => true,
            'wrap' => 200
        );
        //$data['content']=tidy_repair_string($content,$config,'utf8');//$tidy->parseString($html, $config, 'utf8');
        
        $this->load->view('stamps/stamp_view', $data);
    }

    /**
     *    The main function to get content from the web
     *  using Snoopy.
     *
     *  @title - what is after the basic site url for wiki
     *  the wikipedia article.
     **/
    function __snoop($title, $go)
    {
        //initializes snoopy and fetches results
        //go=wiki|cuil|powerset
        if ($go == 'wiki') {
            $uri = 'http://en.wikipedia.org/wiki/';
            
        } else {
            $uri = $go;
        }
        $url = $uri . $title;
        $this->load->library('snoopy');
        $this->snoopy->host = $url;
        $this->snoopy->fetch($url);
        $content = $this->snoopy->results;
        return $content;
    }
    
    
    /*  This is the main controller for the stamps portal
     *  as a matter of fact works with all portals
     *  countries/nameofcountry/tittle/pagenumber
     *
     */
    
    public function stamps($portal = "stamp-notes", $location = 'abu-dhabi', $title = "introduction", $page = "1")
    {
        $this->_common($location, $title, $portal, 'stamps_view');
    }
    
    /*
     * Writes to a .ini file not as elegant as some
     * of the pecl classes but does the job quickly
     *
     */
    
    function write_ini($array, $file)
    {
        $res = array();
        
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $res[] = "[$key]";
                foreach ($val as $skey => $sval)
                    $res[] = "$skey = " . (is_numeric($sval) ? $sval : '"' . $sval . '"');
            } else
                $res[] = "$key = " . (is_numeric($val) ? $val : '"' . $val . '"');
        }
        file_put_contents($file, implode("\r\n", $res));
    }
    
    /*
     *  helper for parsing .ini files
     *
     */
    
    function parseIni($src)
    {
        if (file_exists($src)) {
            return parse_ini_file($src, true);
        } else {
            return false;
        }
        
    }
    
    /**
     * Reads an .ini file and parses it. This has a strategy
     * in case the user fail to define one properly.
     */
    function _readini($portal, $location, $title = '')
    {
        
        $page_src = $this->config->item('content_base') . $portal . '/' . $location . '/' . $title . '.ini';
        $src      = $this->config->item('content_base') . $portal . '/' . $location . '/' . $location . ".ini";
        
        $src_default = $this->config->item('system_settings_path');
        
        // check if ini exists at page level
        $ini_array_page = self::parseIni($page_src, true);
        //echo_array($ini_array_page);
        
        
        // check if ini exists at document level.
        //if (file_exists($src)) {
        $ini_array = self::parseIni($src, true);
        //echo_array($ini_array);
        
        // merge the two ini as the page level (userlevel) might have missed
        // settings
        
        $ini_array = (($ini_array_page)) ? $ini_array + $ini_array_page : $ini_array;
        
        
        // check at document level
        $ini_array_system = self::parseIni($src_default, true);
        //echo_array($ini_array_system);            
        $ini_array = (array)$ini_array + (array)$ini_array_system; // gets missing defaults
        //echo_array($ini_array);
        
        //echoPRE('combined');
        //echo_array($ini_array);break;
        $this->write_ini($ini_array, $page_src);
        
        return $ini_array;
    }
    
    /*
     *    Common functions for all templates
     *  
     */
    
    function getSplashImage($location, $title)
    {
        // We now check to see if we have any splash images
        // in the database. We use the Guzzle library.
        // First create a Client for it.
        $client = new \GuzzleHttp\Client();
        
        // The fields array will hold all the json data from
        // couchdb.
        
        $fields = array();
        $dns    = 'http://yannisl.iriscouch.com/texigniter/';
        //$dns = 'http://yannisl:PUREFAJO@localhost:5984/texigniter/';//$user:$pass@$user
        $client = new Client();
        // first try the document settings to see if they have been specifically set
        // in the database.
        try {
            $request      = $client->createRequest('GET', $dns . $location . '?revs_info=false');
            $response     = $client->send($request);
            //echo $response->getStatusCode();
            $fields       = json_decode($response->getBody(), true);
            self::$splash = $fields['splash'];
            //echo_array($fields);
        }
        catch (RequestException $e) {
            if ($e->hasResponse()) {
                // catch exceptions and do nothing;
            }
        }
        
        // try again for the particular page. has two http calls but simpler
        try {
            $request      = $client->createRequest('GET', $dns . $location . urlencode('/' . $title) . '?revs_info=false');
            $response     = $client->send($request);
            //echo $response->getStatusCode();
            $fields       = json_decode($response->getBody(), true);
            self::$splash = $fields['splash'];
            //echo_array($fields);
        }
        catch (RequestException $e) {
            if ($e->hasResponse()) {
                //echo $e->getResponse() . "\n";
            }
        }
        
        // if there are none in the database use the application default.
        isset($fields['splash']) ? self::$splash = $fields['splash'] : self::$splash = 'splash-default.jpg';
        
        $data['splash'] = self::$splash;
        
        return $data['splash'];
    }
    
    
    function _common($location = 'blog', $title = "introduction", $portal = "countries", $view = "stamps_view", $page = "1")
    {
        //$this->output->cache(2);
        // start benchmark
        
        $this->benchmark->mark('code_start');
        
        // we load the main filter class
        //$this->load->library('filterclass');
        
        // loads model
        $this->load->model('Articlesmodel');
        $this->load->helper('date');
        $format       = 'DATE_ISO8601';
        $time         = time();
        $data['date'] = standard_date($format, $time);
        
        # we read the .ini file if it exists
        # there are normally three levels
        # the portal level and the document level
        # ini files can contain many different settings
        # we keep all TeX and other related information here.
        
        $ini_array = self::_readini($portal, $location, $title);
        
        ## set scripts
        if (isset($ini_array['mathjax']['mathjaxon']) && ($ini_array['mathjax']['mathjaxon'])) {
            if (isset($ini_array['mathjax']['url'])) {
                $data['mathjaxurl'] = '"' . $ini_array['mathjax']['url'] . '"';
            } else {
                $data['mathjaxurl'] = '\'\'';
            }
        } else {
            $data['mathjaxurl'] = 'nomath';
        }
        
        //echo $data['mathjaxurl'];break;
        
        ## set scripts
        if (isset($ini_array['pdf']['pdftitle'])) {
            $data['pdftitle'] = '"' . $ini_array['pdf']['pdftitle'] . '"';
        } else {
            $data['pdftitle'] = '';
        }
        
        // set some styles from ini files
        (isset($ini_array['footnotes']['footnotestyle'])) ? $this->filterclass->__set('footnotestyle', $ini_array['footnotes']['footnotestyle']) : false;
        //let us view what we got by sending data and choosing the view
        
        $data['web_name']    = $ini_array['web']['web_name'];
        // shows the second navigation button
        $data['nav_button2'] = 'show().';
        //$data['nav_button2'] ='';
        
        
        $this->Articlesmodel->article_name     = CONTENT_BASE . $portal . "/" . $location . "/" . $title . '.dat';
        $this->Articlesmodel->article_comments = CONTENT_BASE . $portal . "/" . $location . "/" . $title . '.tlk';
        // set path for menu
        $this->Articlesmodel->country_path     = CONTENT_BASE . $portal . "/" . $location . "/" . $location . ".menu";
        // next we load any specific country or topic menu
        // we insert into data for template
        $datasource                            = $this->config->item('deploy');
        // if (($datasource === 'cloud') &&
        //  ($data['content'] = @file_get_contents('https://s3-us-west-2.amazonaws.com/stamp-notes/'.$location.'/'.$title.'.dat'))){
        //     $data['msg']='cloud data';
        // }
        // else {
        $data['msg']                           = 'local';
        $data['content']                       = $this->Articlesmodel->get_article();
        //}
        
        $content          = $data['content'];
        $data['comments'] = $this->Articlesmodel->get_comments();
        $data['content']  = $data['content'] . $data['comments'];
        $data['location'] = $location;
        $data['portal']   = $portal;
        
        
        filterclass::$location = $location;
        filterclass::$portal   = $portal;
        filterclass::$title    = $title;
        
        $data['content'] = $this->filterclass->filterAll($data['content']);
        $data['content'] = $data['content'] . filterclass::$footnote_store;
        $data['biblio']  = filterclass::$bibliography_store;
        $data['biblio']  = $this->filterclass->filterAll($data['biblio']);
        $data['content'] = $this->filterclass->unprotectChekmark($data['content']);
        
        //can also export to template if necessary
        $data['content'] = $data['content'] . $data['biblio'];
        
        //apply extended markdown for any left mark-up
        $markdown        = new \PEAR2\Text\Markdown_Extra();
        $data['content'] = $markdown->transform($data['content']); //markdown($this->filterclass->filter_value);
        //echoPRE($data['content']);
        
        //*-- get all transclusions and do own filtering
        // check here for none unicode
        //$this->filterclass->parseFields($data['content']);
        // we send transcluded vars to template
        //foreach ($this->filterclass->fields as $key => $value) {
        //  if (isset($value)) {
        //    $data[$key] = $value;
        //} else {
        //  $data[$key] = '';
        //}
        //echoPRE($key.'  '.$value);
        //}
        
        
        //$data['credit_source']='TESTING SOURCE';
        $data['user']  = $this->user;
        $data['title'] = $title; //$this->filterclass->parseField('title',$data['content']);
        $data['logo']  = '';
        
        //calculate some statistics
        //   $data['content']=toc(markdown($data['content']));
        //$statistics = statistics($data['content']);
        //$data['content'] = $data['content']."\n\n".$statistics;
        //echo $data['content'];break;
        //$data['content']=toc(markdown($data['content']));
        //echo $data['content'];break;
        
        
        $data['toc'] = '';
        
        // $data['toc']=toc_menu(markdown($data['content']));
        
        // Menus related
        // get the list of all articles in the folder
        $data['list']        = $this->articlesList($portal, $location);
        // get the parsed menu from file (sidemenu on mosttemplates)
        $data['countrymenu'] = $this->articlesMenu();
        // get breadcrump navigation
        $data['navigation']  = $this->navigationArray();
        if (!filterclass::$navigationArray) {
            $data['navigation'] = $data['list'];
        }
        //temporary render all as below
        $data['navigation'] = $data['list'];
        // numbering parameters - sets javascript to
        // number
        
        $data['number_headings'] = 'true';
        (isset($ini_array['headings']['number_headings'])) ? $data['number_headings'] = $ini_array['headings']['number_headings'] : $data['number_headings'] = 'false';
        
        
        // $data['splash'] = self::getSplashImage($location, $title); //using guzzle 
        
        // Each country or topic blog has a splash image. This is loaded by convention. The image resides
        // at the /stamp-images/country directory or on S3. 
        // http://stackoverflow.com/questions/7991425/php-how-to-check-if-image-file-exists
        
        $splash_src         = site_url('stamp-images/' . $location . '/splash-' . $location . '.jpg');
        $splash_src_default = site_url('stamp-images/beta/splash-default.jpg');
        
        if (@getimagesize($splash_src)) {
            $data['splash'] = $splash_src;
            //log($splash_src);
        } else {
            $data['splash'] = $splash_src_default; //;  
        }
        
        $this->load->view('stamps/' . $view, $data);
        
    }
    
    /*
     *    Helper function to get the list of articles in a
     *    folder.
     *    @$portal string portal bucket
     *  @location string a bucket
     *    returns a list of article file names in an array.
     */
    
    function articlesList($portal, $location)
    {
        $src = CONTENT_BASE . $portal . '/' . $location . '/';
        //echo $src;break;
        $this->Articlesmodel->path = $src;
        $menulist                  = $this->Articlesmodel->get_articles_list();
        $temp                      = '';
        if ((isset($menulist)) && (!empty($menulist))) {
            foreach ($menulist as $key => $value) {
                $value = str_replace('.dat', '', $value); //remove file extension
                $temp .= '<a style="padding-left:3px" href="' . $value . '">' . ucfirst(r('_', ' ', $value)) . '</a>, ';
            }
        }
        return $temp;
    }
    
    /*    Helper function to get the menu from a file
     *    menus are located in the same directory as
     *  the articles
     */
    function articlesMenu()
    {
        filterclass::$in_menu = true;
        $menuText             = $this->Articlesmodel->get_countrymenu();
        return $this->filterclass->filterAll($menuText);
    }
    
    /*    Helper function to get the navigation array from
     *  the menu.dat. This is parsed by the filterclass
     *  and returned as an array (based on the file markup).
     *  @return filterclass::$navigationArray
     */
    function navigationArray()
    {
        return filterclass::$navigationArray;
    }
}
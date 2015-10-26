<?php
/* Travelling into the deep
 *  web
 * mainly Wikipedia
 */

//include_once('../strings/markdown.php');

class Goweb extends CI_Model
{
    public $info_box;
    public $date;
    
    function goweb()
    {
        
        parent::__construct();
        
    }
    function go($title = "piastre", $blog = "blog")
    {
        //main routine for fetching from wikipedia
        //loads snoopy
        //let us be nice to wikipedia!
        //this is just Wikipedia content re-formatted
        //
        
        //we fetch the content based on the url
        $content = $this->__snoop($title, 'wiki');
        
        
        
        if (isset($content)) {
            
            //we configure some variables
            //for tidy
            $config = array(
                'indent' => true,
                'output-xhtml' => true,
                'wrap' => 200
            );
            
            //    parse using tidy and get only the body
            //    tidy now is built-in with standard distribution
            //    for php.
            
            $tidy = new tidy;
            $tidy->parseString($content, $config, 'utf8');
            $body    = $tidy->Body();
            $content = $body->value;
            
            
            
            //now we have the body in better shpae we do
            //some filtering and post processing
            
            $content = $this->__post_processor($content);
            
            //put some sections into a data variable
            $data['menu']     = $this->__wiki_toc($content);
            $data['category'] = $this->__wiki_cats($content);
            $data['related']  = $this->__wiki_main_articles($content);
            $data['feature']  = $this->__wiki_info_box($content);
            $data['content']  = $content;
            $data['title']    = $title;
            if ($data['content'] == '') {
                $data['content'] = 'Service Not Available';
            }
        } else {
            $data['content'] = 'IN PREPARATION';
        }
        return $data;
    }
    
    
    function preprocess($title = "Numbers_regex")
    {
        //pre-process text
        //for other directories actually it is similar
        $this->benchmark->mark('code_start');
        $this->load->model('Articlesmodel');
        $this->Articlesmodel->article_name = "../blog/" . $title . '.dat';
        $data['content']                   = $this->Articlesmodel->get_article();
        //loads the parser filters
        //This part loads all the available filters
        $this->load->library('filterclass');
        $this->filterclass->filterALL($data[$content]);
        $data['feature']           = $this->filterclass->feature($data['content']);
        $data['keywords']          = $this->filterclass->parseField('keywords', $data['content']);
        $data['title']             = $title; //$this->filterclass->parseField('title',$data['content']);
        $data['feature_image']     = $this->filterclass->parseField('feature-image', $data['content']);
        //let us get the list of articles in the directory
        $this->Articlesmodel->path = '../blog/';
        //gets the menu on the left sidebar
        $data['list']              = $this->Articlesmodel->get_articles_list();
        $time                      = 60 * 60 * 24830;
        // $this->output->cache(0);
        //let us view what we got by sending data and choosing the view
        $this->load->view('article_view', $data);
    }
    
    
    // short function
    // to fetch from anywhere using
    // snoopy
    
    function __snoop($title, $go)
    {
        //initializes snoopy and fetches results
        //go=wiki|cuil|powerset
        if ($go == 'HN') {
            $url = 'http://news.ycombinator.com/rss';
        }
        if ($go == 'wiki') {
            //https://de.wikipedia.org/wiki/Main_Page
            $uri = 'http://en.m.wikipedia.org/wiki/';
            //$uri = 'http://grosvenorauctions.com/';
            $url = $uri . $title;
            //echo $url.'<br />';
            
        }
        
        
        
        $this->load->library('snoopy');
        $this->snoopy->host = $url;
        $this->snoopy->fetch($url);
        
        $content = $this->snoopy->results;
        //$content = //file_get_contents('http://grosvenorauctions.com/dyn_pages/historic_sale_summary.php?search_term_all_sales=morocco%20agencies&page=7');
        
        return $content;
    }
    
    
    
    function __wiki_toc(&$content)
    {
        //removes table of contents
        //don't like the & must remove
        $m = preg_match('/' . '<table\s*id=\"toc\"\s*class=\"toc\"\s*summary=\"Contents\"\s*>(.*?)<\/table> ' . '/isx', $content, $values);
        //echo_array($values[0]);
        
        
        if ($m > 0) {
            $menu    = $values[0];
            $content = preg_replace('/' . '<table\s*id=\"toc\"\s*class=\"toc\"\s*summary=\"Contents\"\s*>(.*?)<\/table> ' . '/isx', '', $content);
        } else {
            $menu = '';
        }
        return $menu;
    }
    
    function ftp_download()
    {
        $this->load->library('ftp');
        
        $config['hostname'] = 'erecontracting.com';
        $config['username'] = 'yannisl';
        $config['password'] = 'PUREFAJO13';
        $config['debug']    = TRUE;
        
        if ($this->ftp->connect($config)) {
            
            
            $this->ftp->upload(FCPATH.'data/country.yaml', '/public_html/latenightengineer/');
            $list = $this->ftp->list_files('/public_html/erecontracting/wp-includes/');
            
            echo_array($list);
            //print_r($this->ftp);
            $this->ftp->close();
        }
    }
    
    
    
    function __wiki_main_articles(&$content)
    {
        //pick-up the categories and bring to top
        //remove from current position  
        
        $test = preg_match_all('/' . '<i>Main\s*article\:(.*?)<\/i>' . '/isx', $content, $values);
        
        if ($test) { //echo_array($values[0]);
            $main_articles = 'Related: ';
            foreach ($values[1] as $key => $value) {
                $main_articles .= $value . ', ';
            }
            //echo $main_articles;
            //replace in order to move them
            $content = preg_replace('/' . '<i>Main\s*article\:.*?<\/i>' . '/isx', '', $content);
            return $main_articles;
        } else {
            return $main_articles = '';
        }
    }
    
    function __wiki_cats($content)
    {
        //pick-up the categories and bring to top
        //remove from current position  
        $test    = preg_match_all('/' . '<div\s*id="mw-normal-catlinks"\s*>(.*?)<\/div> ' . '/isx', $content, $values);
        $content = preg_replace('/' . '<div\s*id="mw-normal-catlinks"\s*>(.*?)<\/div> ' . '/isx', '', $content);
        
        //$categories=preg_replace('/'.':'.'/isx','',$content);
        //echo $content;break;
        //echo $values[1][0];
        if (isset($test) && isset($values[1][0])) {
            $categories = preg_replace('/' . 'Categories' . '/isx', 'Related', $values[1][0]);
            $cats       = $categories;
        } else {
            $cats['category'] = '';
            
        }
        return $cats;
    }
    
    function __post_processor($content)
    {
        //post process wikipedia articles to remove and 
        //reformat
        //changed edit\s to avoid eating up editor needs re-chek
        
        $link = $this->config['domain_name'] . '/blogs/go/';
        
        $content = str_replace('/wiki/', $link, $content);
        
        
        $content = str_replace('<body', '<wiki-body', $content);
        
        
        $content = preg_replace('/' . 'citation\s*needed' . '/isx', '', $content);
        $content = preg_replace('/' . 'edit' . '/ix', '', ($content));
        $content = preg_replace('/' . '\[' . '/isx', '', ($content));
        $content = preg_replace('/' . '\]' . '/isx', '', ($content));
        //remove jump to navigation
        $content = preg_replace('/' . '(<div\s*id="jump-to-nav"\s*>.*?<\/div>)' . '/isx', '', $content);
        $content = preg_replace('/' . '(46ex)' . '/isx', '30ex', $content);
        $content = preg_replace('/' . '(300px)' . '/isx', '250px', $content);
        
        //dealing with some info box issues
        $content = preg_replace('/' . '(font-size:\s*95%)' . '/', 'font-size: 70%', $content);
        $content = preg_replace('/' . '(width:\s*18em)' . '/isx', 'width: 14em;margin-left:7px;', $content);
        
        //remove column1 menu
        // $content=preg_replace('/'.'<div\s*id=\"column-one\"\s*>(.*?)<\/div> '.'/isx','',$content);
        // $content=preg_replace('/'.'<h5>(Personal|Navigation)\s* (Tools)*\s*<\/h5>'.'/isx','',$content);
        // $content=preg_replace('/'.'<div\s*class=\"pBody\"\s*>.*?<\/*.*>'.'/isx','A</div>',$content);
        // $content=preg_replace('/'.'<div\s*id=\"mw-hidden-catlinks\"\s*.*>(.*?)<\/div> '.'/isx','A</div>',$content);
        //<table class="metadata plainlinks ambox ambox-notice" style="">
        //meta boxes
        // $content=preg_replace('/'.'<table\s*class=\"(metadata|plainlinks).*?"\s*>(.*?)<\/table> '.'/isx','',$content);
        // $content=preg_replace('/From Wikipedia, the free encyclopedia/','',$content);
        //echo $content;break;
        return $content;
    }
    
    function __wiki_info_box(&$content)
    {
        //checks to see if there is an info box
        $success = preg_match_all('/' . '<table\s*class=\"infobox"\s[^>]*
  [[:alnum:]\%\#\;\:\/\\\\\"\s\?\@\~\=\[\]\(\)\*\$\&\,\.\.><\-\_\'\!\?\,\|\}\{\+\n\r]+<\/table>' . '/isx', $content, $values);
        if ($success) {
            $this->info_box = $values[0];
            //remove contents from location
            $content        = preg_replace('/' . '<table\s*class=\"infobox"\s[^>]*
     [[:alnum:]\%\#\;\:\/\\\\\"\s\?\@\~\=\[\]\(\)\*\$\&\,\.\.><\-\_\'\!\?\,\|\}\{\+]+' . '/uisx', '', $content);
            
            //$content=preg_replace('/'.'<table'.'/isx','',$content);
            return $values[0];
        }
        
        
        
    }
    
    function spink($title = "CodeIgniter")
    {
        //under construction fetches an auction listing.
        //need to parse
        $content = $this->__snoop($title, 'http://stampauctionnetwork.com/zi/zi412.cfm?');
        $content = preg_replace('/41/', 'http://stampauctionnetwork.com/zi/41', $content);
        echo $content;
        break;
        
    }
    
    
    
    
    
    
    function google($title = "Makarios+III")
    {
        //loads snoopy
        //let us be nice to wikipedia!
        
        $pattern = '/\s*\_/';
        $title   = preg_replace($pattern, '+', $title);
        $url     = 'http://www.google.com/search?hl=en&q=' . $title . '&btnG=Google+Search';
        $this->load->library('snoopy');
        $this->snoopy->host = $url;
        $this->snoopy->fetch($url);
        $content = $this->snoopy->results;
        
        $data['menu']     = '';
        $data['category'] = '';
        
        $config          = array(
            'indent' => true,
            'output-xhtml' => true,
            'wrap' => 200
        );
        $tidy            = tidy_parse_string($content);
        $body            = tidy_get_body($tidy);
        $data['content'] = $body;
        /*        
        $data['content']=tidy_repair_string($content,$config,'utf8');
        $data['content']=tidy_get_body($data['content']);*/
        $data['title']   = $title;
        $this->load->model('Articlesmodel');
        $this->Articlesmodel->path = '../blog/';
        $data['list']              = $this->Articlesmodel->get_articles_list();
        $this->load->library('filterclass');
        $data['feature'] = ". . . It is extremely important that the development of intelligent machines be pursued, for the human mind is not only limited in its storage and processing capacity but it also has known bugs: It is easily misled, stubborn, and even blind to the truth, especially when pushed to its limits.";
        
        $this->output->cache(0);
        
        $this->load->view('cuil_view', $data);
    }
    
    
}
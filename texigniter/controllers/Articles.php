<?php

include_once('../strings/utilities.php');
include_once('../strings/markdown.php');

class Articles extends Controller
{
    //controller for articles rather than galleries
    //it can also send images etc
    //missing is how to get the data
    //this is for to-morrow
    
    
    function index()
    {
        $data['todo_list'] = array(
            'Clean House',
            'Call Mom',
            'Run Errands'
        );
        $data['title']     = "My Real Title";
        $data['heading']   = "My Real Heading";
        $this->load->view('template_view');
    }
    
    function article($title = "Che_Guevara", $page = "1")
    {
        //gets data from file to start with rather than database
        //this will have to be extended
        $data['content'] = markdown(file_get_contents("../articles/$title" . '.dat'));
        $data['title']   = "My Real Title";
        $data['heading'] = "My Real Heading";
        
        $this->load->model('Articlesmodel');
        
        $this->Articlesmodel->article_name = "../articles/$title" . '.dat';
        
        $data['content'] = $this->Articlesmodel->get_article();
        //let us get the list of articles in the directory
        
        $this->Articlesmodel->path = '../articles/';
        $data['list']              = $this->Articlesmodel->get_articles_list();
        //let us view what we got
        $this->load->view('article_view', $data);
    }
    
    function gallery($gallery_name = "eugenio-02", $page_num = 5, $title = 'Missing Title')
    {
        //get data based on URL
        //data must give the template we want things shown
        //this is defined by the seecond segement
        // @gallery=gallery template
        // @page   =page template
        // @sitemap=sitemap template
        $this->load->library('pagebuilder');
        
        $data['title']    = $gallery_name;
        $data['heading']  = "My Real Heading";
        $data['gallery']  = $gallery_name;
        $data['page_num'] = $page_num;
        $this->load->view('photographer_gallery', $data);
        
    }
    
    function Blog($t = 'wp_options')
    {
        parent::Controller();
        
        $this->load->scaffolding($t);
    }
    
    
    function tables()
    {
        
        $tables = $this->db->list_tables();
        
        foreach ($tables as $table) {
            echo_array($table);
        }
    }
}
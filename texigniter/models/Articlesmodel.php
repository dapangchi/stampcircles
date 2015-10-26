<?php
class Articlesmodel extends CI_Model
{
    
    var $title = '';
    var $content = '';
    var $date = '';
    var $article_name = '';
    var $article_comments = '';
    var $country_menu = '';
    var $country_path = ''; //../cape-of-good-hope/cape-of-good-hope.dat';
    var $path;
    
    function Articlesmodel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    
    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();
        
        $this->db->insert('entries', $this);
    }
    
    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();
        
        $this->db->update('entries', $this, array(
            'id' => $_POST['id']
        ));
    }
    
    function get_article()
    {
        //get article from folder article_name is the file name
        //if ($this->article_name=''){$this->article_name="home.dat";}
        //$text=$this->content= file_get_contents($this->article_name);
        $this->load->library('Encoding');
        $filename = $this->article_name;
        $handle   = fopen($this->article_name, "rb");
        $text     = fread($handle, filesize($filename));
        fclose($handle);
        //echo $text;//break;
        return $text;
    }
    
    function get_comments()
    {
        //get article comments
        $text = '';
        if (file_exists($this->article_comments)) {
            $text = $this->content = file_get_contents($this->article_comments);
        }
        return $text;
        
    }
    
    /**
     *  get a specific menu, by iterating through the data
     *  directory
     *  @return menu string
     *  
     */
    function get_countrymenu()
    {
        $texta = '';
        //if (file_exists($this->country_menu)){
        $texta = $this->country_menu = @file_get_contents($this->country_path); //}
        //echo $texta;break;
        return $texta;
    }
    
    function get_articles_list()
    {
        //get all articles from article directory
        //we use an iterator to get all files with extenion .dat
        $list = '';
        $path = $this->path;
        $dir  = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), true);
        
        foreach ($dir as $file) {
            
            if (preg_match("/\.dat$/iusx", $file)) {
                $file   = str_replace("\\", '/', $file);
                $file   = preg_replace('%\.\.%', '', $file);
                $file   = preg_replace('/.*\/(.*)\.dat/', '$1', $file);
                $list[] = $file;
                
            }
        }
        //echo_array($list);break;
        return $list;
    }
    
}
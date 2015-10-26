<?php

/* The Controller SandboxPDF primarily
 * handles the execution of commands
 * at system level.
 */

//include_once('markdown.php');

class SandboxPDF extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('utilities');
        $this->load->library('filterclass');
        $this->load->library('texfilter');
    }
    
    //main upload everything is empty
    function index()
    {
        //call some defaults not to spoil template
        $data = $this->default_data();
        $this->template($data);
    }
    /*
    |---------------------------------------------------------------
    | xcopy
    |---------------------------------------------------------------
    |
    | copies recursively all directories.
    |
    | 13.12.2012 Y Lazarides
    */
    
    private function xcopy($source, $target)
    {
        if (is_dir($source)) {
            @mkdir($target);
            $d = dir($source);
            while (FALSE !== ($entry = $d->read())) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                if (is_dir($Entry)) {
                    self::xcopy($Entry, $target . '/' . $entry);
                    continue;
                }
                copy($Entry, $target . '/' . $entry);
            }
            $d->close();
        } else {
            copy($source, $target);
        }
    }
    
    /*
     *  Adds the Postable to the LaTeX template
     *
     */
    function addPostable()
    {
        
    }
    
    
    /*
    |---------------------------------------------------------------
    | pdflatex
    |---------------------------------------------------------------
    |
    | sets up and process the pdfLaTeX file.
    |
    |
    | 13.01.2013 Y Lazarides
    */
    
    function pdflatex($portal = '', $country = '', $file_name = 'testing', $class = 'article', $copy = 0)
    {
        
        ## allow for post checking if we need to capture more stuff.
        ## temporary convenience commands
        ## copies every time and can slow down terribly processing.
        ## will be removed later
        $src  = MASTER_IMAGES_PATH . $country . '/';
        $dest = ROOT . $portal . DIRECTORY_SEPARATOR . $country . '/' . $country . '/';
        
        ## temporary solution for a screw-up
        self::xcopy($src, $dest);
        
        if (!empty($_POST)) {
            $code = $_POST['ascript'];
        }
        
        # We set all paths based on global settings
        #
        $document_root = FCPATH; // C:/wamp/www/ returns with a slash
        
        $main_data_folder = $portal; //this->config->item('main_data_folder'); // 'countries' ;
        //$main_data_folder = "tutorials"; //$this->config->item('main_tutorials_folder');
        
        # We define three main paths, one for the .dat files and another for
        # the .tex files
        # and .pdf files
        
        $data_src     = ROOT . $portal . '/' . $country . '/' . $file_name . '.dat'; //c;wamp/www/countries
        $tex_data_src = ROOT . $portal . '/' . $country . '/tex/' . $file_name . '.tex'; //c;wamp/www/countries
        $pdf_src      = ROOT . $portal . '/' . $country . '/tex/' . $file_name . '.pdf';
        
        //echo $pdf_src = ROOT.$portal.'/'.$country.'/tex/'.$file_name.'.pdf';break;
        
        # We define the tex templates path and the default preamble file.
        ## in configuration files.
        
        $tex_template_directory = MASTER_TEX_TEMPLATES;
        
        ## we fetch the default configuration preamble.tex
        $tex_header_file  = $this->config->item('tex_header_file');
        $tex_template_src = $tex_template_directory . $tex_header_file;
        
        ## First we load the preamble.text to attach to the main body
        ## we need to check if it exists or fall back.
        
        
        ## $content is the contents in the .dat file
        
        
        $content = file_get_contents($data_src); //$data_src
        
        /**
         *    Next we read the LaTeX template
         *    The template is a modified version of a standard
         *    template, that allows pre-processing. This needs to be revisited
         *    at some stage.
         *
         *  Best is to write everything in LaTeX, however it will complicate
         *  life for extending templates.
         *  Problem in general will be paths.
         **/
        
        $preamble = file_get_contents($tex_template_src);
        
        ## we filter the pre-amble for variables.
        ## enable class and class options to be set at this time
        ## will do all these from a screen eventually.
        ## global settings are kept in a configuration file
        ## called 'tex_config'.
        
        $this->config->load('tex_config');
        $document_class   = $this->config->item('class');
        $document_options = $this->config->item('options');
        $patterns[]       = '/(\[\[class\]])/x';
        $replacements[]   = $document_class; //remove \hline
        $patterns[]       = '/(\[\[\[options\]\]\])/';
        $replacements[]   = $document_options;
        $patterns[]       = '/(\[\[macrohook\]\])/';
        $replacements[]   = $this->config->item('macrohook');
        $patterns[]       = '/(\[\[coverpage\]\])/';
        $replacements[]   = $this->config->item('coverpage');
        $patterns[]       = '/(\[\[country\]\])/';
        $replacements[]   = $country;
        $patterns[]       = '/(\[\[country1\]\])/';
        $replacements[]   = $country;
        
        //echo 'macrohook'.$this->config->item('macrohook'); break;
        $GLOBALS['variable'] = something;
        
        $preamble = preg_replace($patterns, $replacements, $preamble);
        
        //echoPRE($preamble);
        //break;
        ## the filename comes from the header
        ## we first load the .dat file, texify and then save as tex
        ## we then re-load it.
        if (!is_dir($document_root . $main_data_folder . '/' . $country . '/tex')) {
            mkdir($document_root . $main_data_folder . '/' . $country . '/tex');
        }
        
        ## filter tex contents
        filterclass::$in_tex = true;
        $content             = $this->filterclass->filterall($content);
        //echo $content;break;
        $texcontent          = $this->texfilter->filterall($content);
        //echoPRE($texcontent);break;
        ##
        write_file($tex_data_src, $texcontent);
        if (!write_file($tex_data_src, $texcontent)) {
            echo 'Unable to write the TeX file';
            break;
        } else {
            echo 'TeX File written!';
        }
        
        
        $postamble    = "\n" . '\backmatter' . "\n" . '%\nocite{*}' . "\n" . '\bibliographystyle{plainnat}' . "\n" . '\bibliography{ceylon}' . "\n" . '\printbibliography' . "\n" . '\printindex' . "\n" . "\n";
        /*
         * we ensure whatever happens there is always an end command.
         */
        $end_document = '\end{document}';
        ## now we have the full TeX file build up
        ## including preamble, body and postamble
        $content      = $preamble . "\n" . $texcontent . "\n" . $postamble . "\n" . $end_document . "\n\n";
        
        //echoPRE($content);break;
        
        ## we need to save it again fully in order to process it
        $res = file_put_contents($tex_data_src, $content);
        chdir(FCPATH . $main_data_folder . '/' . $country . '/tex/');
        
        //break;
        
        /** we redirect standard error=2 to stdin=1 in case of error we can
         * then echo the string to the browser
         * We now build the pdflatex string and shell execute to create the
         * pdf file (best to have some sort of makefile
         **/
        //echo $tex_data_src;break;
        $t = 'texify.exe ' . $tex_data_src . ' --pdf  2>&1';
        $z = shell_exec($t);
        
        //echoPRE($tex_data_src);break;
        
        /**
         *    Error - Messages
         *    Ideally here we need to capture all TeX/LaTeX errors and issue them
         *    in some reasonable manner (after alpha version)
         *    We look for predefined error strings. We can also do something
         *    within LaTeX messages if we wish here.
         *  also on error we send the normal page using a break, a redirect would be better.
         *
         **/
        
        $pattern = "/! Emergency stop\.[\s[:alnum:][:punct:]\$\&]*/im";
        preg_match_all($pattern, $z, $values);
        
        //echoPRE($z);
        //break;
        
        
        if (preg_match_all($pattern, $z, $values)) {
            //echoPRE($z);
            //break;
        } else {
            // although we TeXing a document for full names
            // we don't want to save it on the disk as such
            // we resave the file in its original state.
            
            $res = file_put_contents($tex_data_src, $texcontent);
            
            
            $att  = "inline;";
            $fp   = fopen($pdf_src, "rb");
            $data = fread($fp, filesize($pdf_src));
            fclose($fp);
            
            
            
            ## we build the headers for the pdf
            ## need to revisit this to check all are ok.
            ## also to check for caching
            
            ## echo "test";
            header('Cache-control: max-age=31536000');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-Length: ' . filesize($pdf_src) . '');
            
            //echo filesize($pdf_src).' '.$file_name;
            
            header('Content-Type: application/pdf; name="' . $file_name . '.pdf "');
            
            //break;
            header('Content-Disposition:' . $att . ' filename="' . $file_name . '.pdf"');
            
            // the below gave me umpteen problems does not seem to be required,
            //   header('Content-Transfer-Encoding: binary');
            
            # added ob_clean() and flush() in case any headers were sent earlier.
            ob_clean();
            flush();
            echo $data;
        }
        
    }
    
    //end controller
}
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 *
 * Generic text filtering calls for partial transclusion
 * for translation between generic mark-up -> LaTeX
 *
 *
 *
 *
*/

class Texfilter{

    //This filters class provides two methods of transclusion
    //one it can pick variables and values
    //another it just inserts different values and mark-up where the transclusion
    //takes place
    //feature will return a value
    //image will insert new mark-up in place of the old one
    //filterALL just transclusion
    //parseFields for the latter (returns array of all the fields
    //needs thinking

    public $filter_value;
    public $fields;
    public $figurecounter;
    public $temp;
    public $tempa;
    public $tempc;
    //template replacement
    private $regexAll = "/\{\{warning:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\}/isx";

    static $one=1;

    static function change()
    {
        return self::$one++;
    }


    function filter($content){
        //parses all functions provided in an array
        //uses get_user_funct_array or creates
        //function on the fly if need be
    }


    //all available text filters are called here
    //somehow inelegant but works
    //elegant way is to register them as plugins
    //then load them as plugins
    //maybe can be done!
    //markdown belongs here actually!

    function filterAll($content){
        //$content=$this->index($content);
       
       
		//$content=$this->wikitize($content);
        //$content=$this->subsubsection($content);
        //$content=$this->subsection($content);
        //$content=$this->section($content);
        //$content=$this->chapter($content);
        //$content=$this->doHighlightandBold($content);
        //$content=$this->doAuctionCitations($content);
        //$content=$this->ph($content);
        //$content=$this->phl($content);
        $content=$this->dollars($content);
        //$content=$this->mathjax($content);
        //$content=$this->tablecaption($content);
        //$content=$this->tables($content);
		//$content=$this->wikitize($content);
         /**
         *
        $content=$this->index($content);
        $content=$this->footnote($content);
        $content=$this->ex($content);
        $content=$this->auction($content);
        $content=$this->K420($content);
        $content=$this->SPINKA($content);
        $content=$this->rectangulars($content);
        $content=$this->gross($content);
        $content=$this->feldman($content);
        $content=$this->rural($content);
        $content=$this->pitman($content);
        $content=$this->jaffe($content);
        
        $content=$this->wikisquare($content);
        $content=$this->phpLink($content);
        $content=$this->google($content);
        $content=$this->nutshell($content);
        $content=$this->warning($content);
        $content=$this->sandbox($content);
        $content=$this->flagicon($content);
        $content=$this->pinnote($content);
        $content=$this->download($content);
        $content=$this->cuil($content);
        $content=$this->bulb($content);
        $content=$this->parseCSS($content);
        $content=$this->file($content);
        $content=$this->dfn($content);
        $content=$this->next($content);
        $content=$this->field($content);
        $content=$this->samp($content);
        $content=$this->author($content);
        $content=$this->block($content);
        $content=$this->html($content);
        $content=$this->plain_code($content);
        $content=$this->plain($content);
        $content=$this->example($content);
        $content=$this->yellow($content);
        $content=$this->album_page($content);
        $content=$this->img($content);
        $content=$this->snippet($content);
        $content=$this->blockquote($content);
        $content=$this->qsingle($content);
        $content=$this->macro($content);
        $content=$this->snippetPHP($content); //uses !! !!

        // TeX like mark-up
        // references and footnotes

        // $content=$this->label($content);
        $content=$this->tete($content);
        $content=$this->sacher($content);
        $content=$this->AG($content); //Arthur Gray spinks australia auction
        $content=$this->MO($content); //Morgan collection
        $content=$this->HU($content); //Morgan collection
        $content=$this->postcard($content);
        $content=$this->smallcaps($content);
        $content=$this->textit($content);
        $content=$this->ship($content);
        $content=$this->textbf($content);
        $content=$this->postmark($content);
        //estimate/sold macros
        // convenience macro 1/2p
        $content=$this->halfp($content);
        $content=$this->halfd($content);
        $content=$this->cent($content);
        $content=$this->pound($content);
        $content=$this->euro($content);
        $content=$this->soldp($content);
        $content=$this->soldpstar($content);
        $content=$this->solde($content);
        $content=$this->soldestar($content);
        $content=$this->soldd($content);
        $content=$this->soldaud($content);
        // Postal history item
        $content=$this->beginfigure($content);
        $content=$this->endfigure($content);
        $content=$this->chapter($content);
        $content=$this->section($content);
        $content=$this->subsection($content);
        $content=$this->subsubsection($content);
        $content=$this->caption($content);
        $content=$this->caption_star($content);
        
        $content=$this->phl($content);
        $content=$this->wrapleft($content);
         $content=$this->wrapright($content);
        //menuing
        $content=$this->beginitemize($content);
        $content=$this->enditemize($content);
        $content=$this->beginenumerate($content);
        $content=$this->endenumerate($content);
         $content=$this->item($content);
        $content=$this->menuheading($content);
        $content=$this->menuitem($content);
        $content=$this->gb($content);
        $content=$this->cogh($content);
        $content=$this->coghl($content);
        $content=$this->figurecenter($content);
        $content=$this->figurecenter1($content);
        $content=$this->heading($content);
        $content=$this->puttwo($content);
        $content=$this->imgc($content); // center image for libya
        // named auctions
        $content=$this->alan($content);
        $content=$this->sacher($content);
        $content=$this->HU($content);
        $content=$this->karpov($content);


        $content=$this->aland($content);
        $content=$this->cote($content);
        
        // TeX style acute replacements
        $content=$this->acute($content);

        $content=$this->umlaut($content);
       // $content=$this->cedilla($content);
        // hats
        $content=$this->ohat($content);
        //
        // grave
        //$content=$this->egrave($content);
        //$content=$this->egrave_upper($content);
        $content=$this->agrave($content);


        $content=$this->bar_n($content);
        $content=$this->and_tex($content);

        $content=$this->frac($content);
        //$content=$this->credit($content);
        //$content=$this->feature($content);

        //put into publiv variable
        $content=$this->test($content);         //adds figure numbers
        //
        $content=$this->ref($content);          //References figures
        $content=$this->ilink($content);
        $this->filter_value=$content;
         *
         */
        return $content;

    }
    /* parse all fields created on the fly
     * returns the field value to be
     * placed into templates
     */
    function parseFields($content){
        $this->fields['keywords']=$this->parseField('keywords',$content);
        $this->fields['feature']=$this->parseField('feature',$content);
        $this->fields['feature_image']=$this->parseField('feature-image',$content);
        $this->fields['title']=$this->parseField('title',$content);
        $this->fields['credit_source']=$this->parseField('credit-source',$content);
        $this->fields['credit']=$this->parseField('credit',$content);
        $this->fields['next']=$this->parseField('next',$content);
        $this->fields['prev']=$this->parseField('previous',$content);
    }



 // reverse markdown will conflict with math
 // probably and code (we need to protect those
 // before calling it.
 //

 function doAuctionCitations($text){
       $patterns[]="/\\\\spink4012s/u"; $replacements[]="(ex-E.W Ingram Spink London, July 2004).";
       $patterns[]="/\\\\spink4012/u"; $replacements[]="(Spink London, E.W. Ingram Collection of E. AfricaJuly 2004).";
       $patterns[]="/\\\\spink142s/u"; $replacements[]="(Spink Shreves, 2013a)";
       $patterns[]="/\\\\spink142/u"; $replacements[]="Spink Shreves Galleries Sale, 142, The March 2013 Collector's Series Sale - March 22-23, 2013 ";
       $patterns[]="/£/u"; $replacements[]='£';
       
       $z=preg_replace($patterns,$replacements,$text);
        return $z;
     }


 function doHighlightandBold($text){
     $patterns[]="/\_\_([^\_]+)\_\_/sx"; $replacements[]= '\textbf{$1}';
     $patterns[]="/\_([^\_]+)\_
                     [\s\,\.\!\:\;]  # to ensure that in cases such as \input{file_name_name}
                             # we don't capture
                /usx";
     $replacements[]= '\textit{$1}';
     $z=preg_replace($patterns,$replacements,$text);
        return $z;
 }
    
	
	
    function next($text){
        //puts a next article as per database
        //or next link
        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{next:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<div style="text-align:right"><a href="#">$1</a></div>',$text);
        return $z;
    }

    function previous($text){
        //puts a next article as per database
        //or next link

        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{previous:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<div style="text-align:right"><a href="#">$1</a></div>',$text);
        return $z;
    }

    //  filters for philatelic and collectibles
    //  ex: Walter Scott
    //  should be in span with class
    function ex($text){
        $pattern="/\{\{ex\s*:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/";

        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left">Provenance: $1</p><div style="clear:both"></div>',$text);
        return $z;
    }

    function yellow($text){
        // $pattern="/\{\{highlight:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/";
        $pattern="/\{\{yellow:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_replace($pattern,'<strong>Author: $1</strong>',$text);
        return $z;
    }
    function author($text) {
        $pattern="/\{\{author:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Author: $1</p><div style="clear:both"></div>',$text);
        return $z;
    }

    // Auctions shortcut for auctions, some named auctions have their own
    function auction($text){
        $pattern="/\{\{auction:\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">$1</p><div style="clear:both"></div>',$text);
        return $z;
    }

    //posctard image float left
    function postcard($text){
        $pattern="/\\\\postcard\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<div style="width: $1; float:left">
               <img src="http://localhost/egypt/cyprus-stamps/$2"
               style="width:100%;"/>
               <p class="small">$3</p>
               </div>',$text);
        return $z;
    }

    

// enter as \ph{image file}{description}
    function wrapleft($text){
        $pattern="/\\\\wrapleft\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{
             \s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"\%\$]+)\x}
          \{
            ([[:alnum:]\/
              \)\(  #allow brackets
              \[\]
              \*    #allow star
              \#    #allow hash
              \>\<  #allow some html if need be
              \$\=\,\.\:\/\_\;\+\!\-\?
              \&
              \'\"
              \\\\
             ]
            +)
          \}/x";
        $z=preg_replace($pattern,'<div style="width:$1%;float:left;margin-left:0.5%;margin-right:1%;margin-bottom:0px">
              <img src="/stamp-images/$2"
               style="width:100%;display:block;float:left;margin-right:0px;margin-left:0px" />
               <p class="small" style="width:95%;display:block;margin:0 auto;line-height:1.4;text-align:none;text-justify:newspaper;word-break:hyphenate;" >**FIGURE** $3</p>
               </div>',$text);
        return $z;
    }

function wrapright($text){
        $pattern="/\\\\wrapright\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}
          \{
            ([[:alnum:]\/
              \)\(  #allow brackets
              \[\]
              \*    #allow star
              \#    #allow hash
              \>\<  #allow some html if need be
              \$\=\,\.\:\/\_\;\+\!\-\?
              \&
              \'\"
              \\\\
             ]
            +)
          \}/x";
        $z=preg_replace($pattern,'<div style="width:$1%;float:right;margin-left:1%;margin-right:0%;margin-bottom:0px">
              <img src="/stamp-images/$2"
               style="width:100%;display:block;float:left;margin-right:0px;margin-left:0px" />
               <p class="small" style="width:95%;display:block;margin:0 auto;line-height:1.4;text-align:none;text-justify:newspaper;word-break:hyphenate;" >**FIGURE** $3</p>
               </div>',$text);
        return $z;
    }


    

    //puts two center images
    // x modifier for comments remember
    function puttwo($text){
        $z=preg_replace("/                                                                           # puttwo[]{}{}{}
         \\\\puttwo\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                             # square brackets
         \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}\s*         # first curly
         \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}\s*         # second curly
         \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # third curly
         /x",
         '<div style="width:65%;margin-left:auto;margin-right:auto;margin-bottom:3px;border:1px solid red" class="center" >
            <img src="http://localhost/egypt/$2 " style="width:49%;display:block;float:left;margin-right:1%" />
            <img src="http://localhost/egypt/$3 " style="width:49%;display:block;float:left;" />
            <p class="small" style="width:95%;display:block;margin:0 auto;line-height:1.4;" ></p>
         </div>',$text);
        return $z;
    }

    //puts two center images
    // x modifier for comments remember
    // we half way there!!
    function ref($text){
        // protect from replacemnts
        $refpattern="/\\\\ref
              \{
               ([[:alnum:]\:]+)*
              \}/x";
        $z=preg_replace($refpattern,'--$1--',$text);
        $refpatterna="/
               --([[:alnum:]]+)--*
              /x";
        //crossrefs now holds all the values
        //for references
        $temp=preg_match_all($refpatterna,$z,$crossrefs);
       // echo_array($crossrefs);
        
        $i=0;
        $pattern="/([\*]+)(.*_)Figure\s*\d*/ix";
        // find all the figure numbers as they are now associated with
        // the labels
        $temp=preg_match_all($pattern,$z,$values);
        //$replace=$values[2];
       // echoPRE("VALUES a");
       // echo_array($values);
      
        // clear them from the figures
        $i=0;
       // break;

for ($i = 0; $i < count($values[1]); ++$i)
        {
            $values[1][$i]=trim($values[1][$i]);
            if (trim($values[1][$i])==''){
                $values[1][$i]=='test';
            }
            else
            {
                //echo $values[1][$i];
                $z=str_replace($values[1][$i],'', $z);
            }
        }

        //$z=str_replace ('**','', $z);
       
       // $z=str_replace ('*F','F', $z);
// changes crossrefs

      for ($i=0; $i<count($crossrefs[1]); $i++)
        {
            for ($j=0; $j< count($values[1]); $j++) 
            {
                $aa=$values[2][$j].'';
                $bb=trim($crossrefs[1][$i]).'_';
                  
                $daa = strcmp(trim($aa),trim($bb));
                //echo $daa;
                //echoPRE($aa.' '.$bb,'  '.$daa.'d ');
                if ($daa==0){
                   //echo 'match'.$j;
                   $cc= 'Figure '.($j+1);
                   $z=str_replace ('--'.$crossrefs[1][$i].'--','<a href="#'.$crossrefs[1][$i].'">'.$cc.'</a>', $z);
                   //$z=str_replace ($crossrefs[1][$i].'_','', $z);
                   
                }
               
            }
            
        }
         $z=preg_replace ('/[[:alnum:]]*_F/','F',$z); //removes empties

/**
 echoPRE("VALYES a");
 echo_array($valuesa);


 $search=array();
 $tempa=array();
 // something funny was going on so added this
 foreach($valuesa[0] as $key=>$value){
            $search[$i]=$valuesa[0][$i];
            $tempa[$i]=$valuesa[2][$i].'';
            $i++;
         }
 $i=0;
  foreach($valuesa[2] as $key=>$value){
            $tempa[$i]=$values[2][$i].'';
            $i++;
         }
 echoPRE("search");
 echo_array($search);

$i=0;

 foreach($valuesa[2] as $key=>$value){
            //echo $value.''.$i;
           if (isset($search[$i])&&(!empty($value)))
               {
                 $replace[$i]='<a href="#'.$valuesa[2][$i].'" >'.$tempa[$i]."</a> ";
               }
               $i++;
         }

// break;
if (isset($search[0])&&(!empty($replace[0])))
    {
 $z=str_replace($search, $replace, $z);
    }
 //echo $z;
 /**
 $z=preg_replace("/                                                                           # \ref[]{}
         \\\\ref\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                                # square brackets
         \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # third curly
         /x",
         '<a href="#$2">[$2]</a>',$text);
  *
  */
        return $z;
    }

    // replaces all the FIG with numbers.
    function test($text){
        $z = preg_replace_callback(
    "[\*\*FIGURE(\s.*)\*\*]",
            create_function('$m','
        static $id = 0;
        $id++;
        return "<a id=\"fig_".$id."\" class=\"black\" style=\"font-weight:bold\">**$m[1]_Figure ".$id."**</a>";
    '),
            $text);
        return $z;
    }



    //puts two center images
    // x modifier for comments remember
    function label($text){
        $z=preg_replace("/                                                                           # \ref[]{}
         \\\\label\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                                # square brackets
         \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # third curly
         /x",
         '<a id="$2" style="color:blue">$2 </a>',$text);
        return $z;
    }


    // enter as \ph{image file}{description}
    function caption($text){
        $pattern="/\\\\caption\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
                 \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*  # curly
                 /x";
        $z=preg_replace($pattern,'<div class="small" style="width:100%;display:block;margin:0 auto;line-height:1.4;text-align:none;text-justify:newspape;word-break:hyphenate;clear:both;margin-bottom:10px" >**FIGURE** $2</div>',$text);
        return $z;
    }

 
    function caption_star($text){
        $pattern="/\\\\caption\*\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
                 \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*  # curly
                 /x";
        $z=preg_replace($pattern,'<div class="small" style="width:100%;display:block;margin:0 auto;line-height:1.4;text-align:none;text-justify:newspape;word-break:hyphenate;clear:both;margin-bottom:10px" > $2</div>',$text);
        return $z;
    }

    //\begin{figure}[]
    function beginfigure($text){
        $pattern="/\\\\begin\{figure\}\[.*\]/";
        $z=preg_replace($pattern,'<div style="width:100%;border:1px solid green" class="clearfix">
        <div style="width:90%;clear:both;padding-left:0px;padding-right:0px;margin:0 auto;border:1px solid red" class="center clearfix">
        ',$text);
        return $z;
        //\end{figure}
    }

    function endfigure($text){
        $pattern="/\\\\end\{figure\}/";
        $z=preg_replace($pattern,'</div></div>',$text);
        return $z;
        //\end{figure}
    }

    //lists for menus
    //menu heading
    function menuheading($text){
        $pattern="/\\\\menuheading                # command
   \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
   /x";
        $z=preg_replace($pattern,'<h4 class="country">$1</h4>',$text);
        return $z;
        //\end{figure}
    }
    function menuitem($text){
        $z=preg_replace("/                                                                            # puttwo[]{}{}{}
         \\\\menuitem\[*([[:alnum:]\/\)\(\,\.\:\-\&\s*\'\"\%]+)*\]*                            # optional square brackets
          \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
          \s*\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)*\s*\}\s*     # first curly
          \n\r/x",
         '<li><a href="$2" title="$1">$3</a></li>',$text);
        return $z;
    }

    //\begin{figure}[]
    function beginitemize($text){
        $pattern="/\\\\begin\{itemize\}/";
        $z=preg_replace($pattern,'<ul style="margin-left:0px;width:450px" >',$text);
        return $z;
        //\end{figure}
    }
    function enditemize($text){
        $pattern="/\\\\end\{itemize\}/";
        $z=preg_replace($pattern,'</ul>',$text);
        return $z;
        //\end{figure}
    }

//\begin{figure}[]
    function beginenumerate($text){
        $pattern="/\\\\begin\{enumerate\}/";
        $z=preg_replace($pattern,'<ol style="margin-left:180px;width:95%;font-size:smaller" >',$text);
        return $z;
        //\end{figure}
    }
    function endenumerate($text){
        $pattern="/\\\\end\{enumerate\}/";
        $z=preg_replace($pattern,'</ol>',$text);
        return $z;
        //\end{figure}
    }

    function item($text){
        $pattern="/\\\\item\s*(.*)\r*\r*/";
        $z=preg_replace($pattern,'<li>$1</li>',$text);
        return $z;
        //\end{figure}
    }

/*
    function chapter($text){
        $pattern="/\\\\chapter\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}/x";
        $z=preg_replace($pattern,'# $2',$text);
        return $z;
    }
    function section($text){
        $pattern="/\\\\section\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'## $2',$text);
        return $z;
    }
    function subsection($text){
        $pattern="/\\\\subsection\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
            \{
               \s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)
             \}/xi";  # Anything up to second brackets
        $z=preg_replace($pattern,'### $2',$text);
        return $z;
    }
    function subsubsection($text){
        $pattern="/\\\\subsubsection\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-,\$,\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'#### $2',$text);
        return $z;
    }
*/
    // internal link
    function ilink($text){
        $pattern="/\\\\ilink\s*\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
                  \{\s*([[:alnum:]\/\)\(\,\.\:\_\-,\$,\&\s\'\"]+)\}/x";
        $z=preg_replace($pattern,'<a href="../$2">$1</a>',$text);
        return $z;
    }


    

    function footnote($text){
        // creates footnotes
        // numeric or alphanumeric
        global $a;
        $a='';
        
        $pattern="/\\\\footnote\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*
                    \{\s*([[:alnum:]\/\)\(\,
                    \]\[
                    \.\:\_\-,\$,\&\s\'\"]+)\}/xi";
        $z = preg_replace_callback(
            $pattern,
            create_function('$m','
static $footnote_id = "a";
static $footnote_text="";
global $a;
$a="";
$a = $a.$footnote_text."<p class=\"small\" style=\"margin-bottom:0px\">
<a class=\"red\" id=".$footnote_id. " href=\"#top-".$footnote_id."\" >(".$footnote_id.") </a>".$m[2]."</p>";
$t = "<sup id=\"foot_".$footnote_id."\" class=\"black\"
  style=\"font-weight:normal\"><a id=top-".$footnote_id."\"  href=\"#".$footnote_id."\" class=\"blue\">[".$footnote_id."]</a></sup>";
  $footnote_id++;
  return $t;
          '),
            $text);
     if (!empty($a)){$z = $z."\n<h4 style=\"clear:both\">NOTES</h4> ";}
     return $z.trim($a);
    }


    function tete($text){
        $pattern="/\\\\tete/";
        $z=preg_replace($pattern,'<span style="font-style:italic">t&#234;te-b&#234;che</span>',$text);
        return $z;
        //\end{figure}
    }

    function and_tex($text){
        $pattern="/\\\\&/";
        $z=preg_replace($pattern,'&',$text);
        return $z;
        //\end{figure}
    }

    function aland($text){
        $pattern="/\\\\aland\;/";
        $z=preg_replace($pattern,'&#197;land ',$text);
        return $z;
        //\end{figure}
    }



    function cote($text){
        $pattern="/\\\\cote/";
        $z=preg_replace($pattern,'C&#244;te d\'Ivoire ',$text);
        return $z;
        //\end{figure}
    }
/*
    function cedilla($text){
        $pattern="/\\\\c/";
        $z=preg_replace($pattern,'&#231;',$text);
        return $z;
    }
*/
    function umlaut($text){
        $pattern="/\\\\\"o/";
        $z=preg_replace($pattern,'&#246;',$text);
        return $z;
        //\end{figure}
    }

    function mathjax($text){
        
        $patterns[]="/\\\\\\\\\\[/"; $replacements[]='\\\\[';
        $patterns[]="/\\\\\\\\\\]/"; $replacements[]='\\\\]';

        $patterns[]="/\\\\\\\\\\(/"; $replacements[]='\\\\(';
        $patterns[]="/\\\\\\\\\\)/"; $replacements[]='\\\\)';
        // dashes place the m before the n otherwise it gets replaced
        // and there is no match. Ensure the <!-- does not get affected
        // or -->
        //$patterns[]="/\\-\\-\\-/";     $replacements[]='&mdash;';
        //$patterns[]="/\\-\\-/";   $replacements[]='&ndash;'; // expressions protects html <!-- --> from replacement
        $patterns[]="/\\\\lorem/"; $replacements[]='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nibh justo, dictum sed cursus ac, lobortis et lacus. Vestibulum vitae justo enim. Quisque laoreet elementum felis, ut sodales arcu viverra a. Sed molestie odio vulputate sem rutrum a sagittis est rutrum. Morbi dapibus hendrerit magna, sit amet commodo massa posuere sit amet. Duis pharetra quam scelerisque est lobortis fringilla. Maecenas venenatis feugiat lectus, vel facilisis odio pharetra quis. Etiam at nisl eros, sit amet suscipit lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed augue nunc, ornare eget congue sit amet, laoreet vel augue. Morbi vel justo quis ipsum adipiscing egestas vitae non est. Vivamus ac quam quam. Nullam pharetra
                                                    interdum mauris, rutrum pulvinar ligula condimentum id. Donec et blandit lorem. ';
        $z=preg_replace($patterns,$replacements,$text);
        return $z;
        //\end{figure}
    }

    
    // This filter allows for any $ signs dropped in the text
    // without escaping to be escaped.
    // more filters can be written
    function dollars($text){
         $patterns[]="/\\$(\\s*\\d)/"; $replacements[]='\\\\$$1';
		 
		 // replacements for some troublesome unicode
		 // characters in case we do not use XeLaTeX
		 //$patterns[]="/(£)/u"; $replacements[]='\pound';
		 //$patterns[]="/(€)/u"; $replacements[]='\euro';
		 
		 //$patterns[]="/(“)/u"; $replacements[]='``';
		 //$patterns[]="/(’)/u"; $replacements[]="'";
		 
		 
		 //$patterns[]="/(�?)/u"; $replacements[]="''";
         $patterns[]="/#/"; $replacements[]='\\#';
		 $patterns[]="/&amp;/"; $replacements[]='&';
         //$patterns[]="/\{\{/"; $replacements[]=''; //just remove at the moment
         //$patterns[]="/\}\}/"; $replacements[]='';
         //$patterns[]="/\\\\begin\{codeblock\}/"; $replacements[]= '';
         //$patterns[]="/\\\\end\{codeblock\}/"; $replacements[]= '';
         ## we need to add the TeX commands for the listings package for
         ## JavaScript code.
         //$patterns[]="/\\\\begin\{jscodeblock\}/"; $replacements[]= '\begin{lstlisting}[language=JavaScript]';
         //$patterns[]="/\\\\end\{jscodeblock\}/"; $replacements[]= '\end{lstlisting}';
         //$patterns[]="/\\\\begin\{css\}/"; $replacements[]= '\\\\begin{comment}';
         //$patterns[]="/\\\\end\{css\}/"; $replacements[]= '\\\\end{comment}';
         //$patterns[]="/\\\\hr[^e]/"; $replacements[]= '';
        

        // dashes place the m before the n otherwise it gets replaced
        // and there is no match. Ensure the <!-- does not get affected
        // or -->
        //$patterns[]="/\\-\\-\\-/";     $replacements[]='&mdash;';
        //$patterns[]="/\\-\\-/";   $replacements[]='&ndash;'; // expressions protects html <!-- --> from replacement
        /*$patterns[]="/\\\\lorem/"; $replacements[]='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nibh justo, dictum sed cursus ac, lobortis et lacus. Vestibulum vitae justo enim. Quisque laoreet elementum felis, ut sodales arcu viverra a. Sed molestie odio vulputate sem rutrum a sagittis est rutrum. Morbi dapibus hendrerit magna, sit amet commodo massa posuere sit amet. Duis pharetra quam scelerisque est lobortis fringilla. Maecenas venenatis feugiat lectus, vel facilisis odio pharetra quis. Etiam at nisl eros, sit amet suscipit lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed augue nunc, ornare eget congue sit amet, laoreet vel augue. Morbi vel justo quis ipsum adipiscing egestas vitae non est. Vivamus ac quam quam. Nullam pharetra
                                                    interdum mauris, rutrum pulvinar ligula condimentum id. Donec et blandit lorem. ';*/
        $z=preg_replace($patterns,$replacements,$text);
        return $z;
        //\end{figure}
    }

   

    

   
    // hats
    function ohat($text){
        $pattern="/\\\\\^o/";
        $z=preg_replace($pattern,'&#244;',$text);
        return $z;
    }
    function agrave($text){
        $pattern="/\\\\\`a/";
        $z=preg_replace($pattern,'&#224;',$text);
        return $z;
    }

    function egrave_upper($text){
        $pattern="/\\\\`E/";
        $z=preg_replace($pattern,'&#201;',$text);
        return $z;
        //\end{figure}
    }

    function egrave($text){
        $pattern="/\\\\`e/";
        $z=preg_replace($pattern,'&#232;',$text);
        return $z;
        //\end{figure}
    }

    
    function bar_n($text){
        $pattern="/\\\\~n/";
        $z=preg_replace($pattern,'&#241;',$text);
        return $z;
        //\end{figure}
    }

    /*
     * Emulates TeX's \frac command
     * in HTML will only work correctly for
     * single digits use MathJax commands for others.
     */

    function frac($text){
        $pattern="/\\\\frac\{*(\d+)\}*\{*(\d+)\}*/";
        $z=preg_replace($pattern,'&frac$1$2;',$text);
        return $z;
        //\end{figure}
    }


    // generic item for postal history items
    // enter as \gb{image file}{description} special for great britain
    function gb($text){
        $pattern="/\\\\gb\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<div style="width:90%;" class="center">
               <img src="http://localhost/greatbritainstamps/$2"
               style="width: $1;" class="center"/>
               <p class="small">$3</p>
               </div>',$text);
        return $z;
    }

    // generic item for postal history items
    // enter as \gb{image file}{description} special for great britain
    function cogh($text){
        $pattern="/\\\\cogh\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<div style="width:90%;" class="center">
               <img src="http://localhost/capepostalhistory/$2"
               style="width: $1;" class="center"/>
               <p class="small">$3</p>
               </div>',$text);
        return $z;
    }
    function coghl($text){
        $pattern="/\\\\coghl\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<div style="width:$1;float:left;" >
               <img src="http://localhost/capepostalhistory/$2"
               style="width:80%;" class="center"/>
               <p class="small">$3</p>
               </div>',$text);
        return $z;
    }

    // Macros for estimate/sold in lots
    //  sold in pounds
    function soldp($text){
        $pattern="/\\\\soldp\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<span> (Estimate &pound; $1 sold for &pound;$2).
                 </span>',$text);
        return $z;
    }
    // Sold in euros
    function solde($text){
        $pattern="/\\\\solde\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<span> (Estimate &euro; $1 sold for &euro;$2)
                 </span>',$text);
        return $z;
    }

    function soldpstar($text){
        $pattern="/\\\\soldp\*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<span> (Estimate &pound; $1 ).
                 </span>',$text);
        return $z;
    }
    function soldestar($text){
        $pattern="/\\\\solde\*\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<span> (Estimate &euro; $1 ).
                 </span>',$text);
        return $z;
    }

    // Sold in dollars
    function soldd($text){
        $pattern="/\\\\soldd\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<span> (Estimate $$1, Sold $$2).
                 </span>',$text);
        return $z;
    }

    // Sold in dollars
    function soldaud($text){
        $pattern="/\\\\soldaud\{\s*([[:alnum:]\/\)\(\,\.\:\_\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\>\<\[\]\$\=\,\.\:\/\_\;\+\!\-\&\s\'\"\#\?\\\\]+)\}/";
        $z=preg_replace($pattern,'<span> (Estimate AUD$ $1 sold for AUD$ $2).
                 </span>',$text);
        return $z;
    }

    function halfp($text){
        $pattern="/\\\\halfp/";
        $z=preg_replace($pattern,'&#189;p ',$text);//html entity 1/2
        return $z;
    }
    function halfd($text){
        $pattern="/\\\\halfd/";
        $z=preg_replace($pattern,'&#189;d',$text);//html entity 1/2
        return $z;
    }

    function pound($text){
        $pattern="/\\\\pound/";
        $z=preg_replace($pattern,'&pound;',$text);//html entity 1/2
        return $z;
    }

    function euro($text){
        $pattern="/\\\\euro/";
        $z=preg_replace($pattern,'&euro;',$text);//html entity 1/2
        return $z;
    }

    function cent($text){
        $pattern="/\\\\cent/";
        $z=preg_replace($pattern,'&#162;',$text);//html entity 1/2
        return $z;
    }


    // John Sacher Sale - West Africa

    function sacher($text){
        $pattern="/\\\\sacher/";
        $z=preg_replace($pattern,'ex: <span style="font-style:italic">John Sacher, West Africa Collection. </span>',$text);
        return $z;
    }

    function HU($text){
        $pattern="/\\\\HU/";
        $z=preg_replace($pattern,'ex: <span style="font-style:italic">Hughes, 2011 </span>',$text);
        return $z;
    }

    function karpov($text){
        $pattern="/\\\\karpov/";
        $z=preg_replace($pattern,'ex: <span style="font-style:italic">Anatoly Karpov, 2012 </span>',$text);
        return $z;
    }

    // Arthur Gray
    function AG($text){
        $pattern="/\\\\AG/";
        $z=preg_replace($pattern,'ex: <span style="font-style:italic">Arthur W. Gray, 2007.</span>',$text);
        return $z;
    }
    // Morgan
    function MO($text){
        $pattern="/\\\\MO/";
        $z=preg_replace($pattern,'ex: <span style="font-style:italic">Morgan, 2012.</span>',$text);
        return $z;
    }

    function figurecenter($text){
        $pattern="/\\\\figurecenter\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\{([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<div style="width:90% $1; margin:0 auto">
               <img src="http://localhost/egypt/cyprus-stamps/$2"
               style="width:80%;margin:0 auto;display:block"/>
               <p class="small">$3</p>
               </div>',$text);
        return $z;
    }

    function figurecenter1($text){
        $pattern="/\\\\figurecenter1\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\?\s\'\"]+)\}\{([[:alnum:]\/\)\(\,\.\:\_\#\/\&\;\=\%\-\&\s\'\"\<\>]+)\}/";
        $z=preg_replace($pattern,'<div style="width:100%; margin:0 auto">
               <img src="http://localhost/egypt/british-occupation-of-italian-colonies/$2"
               style="width:$1;margin:0 auto;display:block"/>
               <p class="small center" style="width:90%;margin-bottom:10px">$3</p>
               </div>',$text);
        return $z;
    }

    function imgc($text){
        $pattern="/\\\\imgc\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\?\s\'\"]+)\}\{([[:alnum:]\/\)\(\,\.\:\_\#\/\&\;\=\%\-\&\s\'\"\<\>]+)\}/";
        $z=preg_replace($pattern,'<div style="width:100%; margin:0 auto">
               <img src="/stamp-images/$2"
               style="width:$1;margin:0 auto;display:block"/>
               <p class="small center" style="width:90%;margin-bottom:10px">$3</p>
               </div>',$text);
        return $z;
    }

    function smallcaps($text){
        $pattern="/\\\\textsc\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\?\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<span style="font-variant:small-caps;font-size:0.9em">$1</span>',$text);
        return $z;
    }

    function textit($text){
        $pattern="/\\\\textit\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<span style="font-style:italic;">$1</span>',$text);
        return $z;
    }

    function ship($text){
        $pattern="/\\\\ship\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<span style="font-style:italic;">$1</span>',$text);
        return $z;
    }


    function heading($text){
        $pattern="/\\\\heading\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<h4 style="text-align:center">$1</h4>',$text);
        return $z;
    }

    function postmark($text){
        $pattern="/\\\\postmark\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"\>\<\/\\\\\;]+)\}/x";
        $z=preg_replace($pattern,'<span style="font-weight:bold">$1 </span>',$text);
        return $z;
    }


    function textbf($text){
        $pattern="/\\\\textbf\{\s*([[:alnum:]\/\)\(\!\,\.\:\-\&\?\s\'\"]+)\}/";
        $z=preg_replace($pattern,'
                <span style="font-weight:bold;">$1</span>',$text);
        return $z;
    }





    function alan($text){
        $pattern="/\\\\alan\[*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"\%]+)*\]*\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\?\s\'\"]+)\}\{([[:alnum:]\/\)\(\,\.\:\_\#\/\&\;\=\%\-\&\s\'\"\<\>\+\[\]\?]+)\}/";
        $z=preg_replace($pattern,'<div style="width:100%; margin:0 auto">
               <img src="http://localhost/egypt/queensland/$2"
               style="width:$1;margin:0 auto;display:block"/>
               <p class="small center" style="width:90%;margin-bottom:10px">$3</p>
               </div>',$text);
        return $z;
    }


    // Auctions shortcut for auctions, some named auctions have their own
    function gross($text){
        $pattern="/\\\\gross/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">W. H. Gross, Spink 2007</p><div style="clear:both"></div>',$text);
        return $z;
    }

    // Auctions shortcut for auctions, some named auctions have their own
    function feldman($text){
        $pattern="/\{\{feldman:\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Feldman, Geneva Autumn 2012, Lot No: $1.</p><div style="clear:both"></div>',$text);
        return $z;
    }




    // Karamitsos 420
    function K420($text){
        $pattern="/\{\{K420\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Karamitsos Sale 420, March 2012</p><div style="clear:both"></div>',$text);
        return $z;
    }

    // Spink aphrodite
    function SPINKA($text){
        $pattern="/\{\{SPINKA\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Spinks Sale 9006, March 2009</p><div style="clear:both"></div>',$text);
        return $z;
    }

    // Spink aphrodite
    function rectangulars($text){
        $pattern="/\{\{rectangulars\}\}/";
        $z=preg_replace($pattern,' Spink: Sep 2007,  "The Rectangular Issues."<div style="clear:both"></div>',$text);
        return $z;
    }

    // Sublinks rural links for Cyprus villages
    function rural($text){
        $pattern="/\{\{rural\}\}/";
        $z=preg_replace($pattern,'<a href="../cyprus-postal-history/Village_names">Rural cancellations</a><div style="clear:both"></div>',$text);
        return $z;
    }

    // Sublinks rural links for Cyprus villages
    function index($text){
        $pattern="/\\\\index\{\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}/";
        $z=preg_replace($pattern,'<a href="../cyprus-postal-history/Village_names">index experiment $1</a><div style="clear:both"></div>',$text);
        return $z;
    }


    function pitman($text){
        $pattern="/\{\{pitman:\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Ex: Milan Pitman, Silver Yuan Issues, <a>Interasia</a>, 28 Apr 2012.</p><div style="clear:both"></div>',$text);
        return $z;
    }

    // Peter Jaffe auction
    function jaffe($text){
        $pattern="/\{\{jaffe\s*([[:alnum:]\/\)\(\,\.\:\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<p style="font-family:arial;font-size:12px;float:left;font-weight:bold">Ex: Peter Jaff&eacute; 2007</p><div style="clear:both"></div>',$text);
        return $z;
    }
    //Replaces links for cuil searches and content
    //needs some work
    function cuil($text){
        $pattern="/\{\{cuil:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"]+)\}\}/";
        $z=preg_replace($pattern,'<a href="' . site_url() . '/blogs/cuil/$1">$1</a> ',$text);
        return $z;
    }


    function file($text){
        $pattern="/\{\{file:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_match_all($pattern,$text,$values);
        //load files from disk
        //echo_array($values);
        foreach($values[1] as $key=>$value){
            $txt=@file_get_contents($value);
        }
        $s='<pre class="dotted"><code>';
        //$s=highlight_string($txt);
        $s.=@htmlentities($text);
        $s.='</code></pre>';
        $z=preg_replace($pattern,$s,$text);
        if (!$z==FALSE){return $text=$z;}else{return $z;}
    }



    function block($text){

        $s='';
        //Now let us pick up all the blocks on the page
        $pattern="/\{\{block:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_match_all($pattern,$text,$values);
        if ($z==FALSE){return $text;}
        //loops through all the blocks
        //error checking not strong
        $i=0;
        foreach($values[1] as $key=>$value)
        {
            $txt=@file_get_contents($value);
            //echoPRE($txt);break;
            if (isset($txt))
            {
                $s[$i]=$txt;
                //we markdown here
                $s[$i]=markdown($txt);
                //$s[$i]=$txt;
                $z=r($values[0],$s,$text);
                $i=$i+1;
            }
        }

        return $z;
    }

    function html($text){
        //gets a block from file and loads it into the correct
        //place
        //there can be multiple blocks on a page
        //blocks have their own directory
        //it needs to be extended to search at default directory
        //it will be much easier

        $s='';
        //Now let us pick up all the blocks on the page
        $pattern="/\{\{html:\s*([[:alnum:]\/\)\(\,\.\_\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_match_all($pattern,$text,$values);
        if ($z==FALSE){return $text;}
        //loops through all the blocks
        //error checking not strong
        $i=0;
        foreach($values[1] as $key=>$value)
        {
            $txt=@file_get_contents($value);
            //echoPRE($txt);break;
            if (isset($txt))
            {
                $s[$i]=$txt;
                //we markdown here
                //$s[$i]=markdown($txt);
                $s[$i]=$txt;
                $z=r($values[0],$s,$text);
                $i=$i+1;
            }
        }

        return $z;
    }

    function macro($text)
    {
        $pattern="/\!\!nutshell:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\:]+)\!\!/";
        $z=preg_replace($pattern,'<div class="nutshell ui-corner-all"><h5>In a Nutshell!</h5>$1</div> ',$text);
        return $z;
    }


    function nutshell($text){
        $pattern="/\{\{nutshell:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_replace($pattern,'<div class="nutshell ui-corner-all"><h5>In a Nutshell!</h5>$1</div> ',$text);
        return $z;
    }

    function blockquote($text){
        $tmp= '<table style="margin:auto; border-collapse:collapse; border-style:none; background-color:transparent; width:auto;" class="cquote">
               <tr>
               <td width="20" valign="top" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:left;padding:10px 10px;vertical-align:top">&ldquo;</td>
               <td valign="top" style="padding:4px 10px;font-family:georgia;font-size:16px;line-height:1.5">';
        $tmp1='$1 </td>
      <td width="20" valign="bottom" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:right;padding:10px 10px;vertical-align:bottom">&rdquo;</td>
      </tr>
      </table>';
        $pattern="/\{\{blockquote:\s*([[:alnum:]\/\)\(\,\},\{,\\\\,\.\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_replace($pattern,$tmp.$tmp1,$text);
        return $z;
    }

    function qsingle($text){
        $tmp= '<table style="margin:auto; border-collapse:collapse; border-style:none; background-color:transparent; width:auto;" class="cquote">
               <tr>
               <td width="20" valign="top" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:left;padding:10px 10px;vertical-align:top">&ldquo;</td>
               <td valign="top" style="padding:4px 10px;font-family:georgia;font-size:16px;line-height:1.5">';
        $tmp1='$1 </td>
      <td width="20" valign="bottom" style="color:#B2B7F2;font-size:40px;font-family:\'Times New Roman\',serif;font-weight:bold;text-align:right;padding:10px 10px;vertical-align:bottom"></td>
      </tr>
      </table>';
        $pattern="/\{\{qsingle:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $z=preg_replace($pattern,$tmp.$tmp1,$text);
        return $z;
    }


/**
    function footnote($text){
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{(footnote|sup|ref):\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\^\>\<\#\_\=\\\:]+)\}\}/";
        $z=preg_replace($pattern,'<sup class="footnote">[$2] </sup>',$text);
        return $z;
    }
*/

    function dfn($text){
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php

        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{dfn:\s*([[:alnum:]\/\)\(\_\=\@\#\$\,\.\-\&\s\'\"\!\.\?\;\:\>\<]+)\}\}/";
        $z=preg_replace($pattern,'<dfn>$1</dfn> ',$text);
        return $z;
    }

    function field($text){
        $pattern="/\{\{field:\s*([[:alnum:]\/\)\(\_\=\@\#\$\,\.\-\&\s\'\/\d\"\!\.\?\;\:\\\\\>\<]+)\}\}/isx";
        $z=preg_replace($pattern,'<strong>$1</strong> ',$text);
        return $z;
    }

    function samp($text){
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php

        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{samp:\s*([[:alnum:]\/\)\(\[\]\_\=\@\#\$\,\.\-\&\s\'\"\!\.\?\;\:\>\<]+)\}\}/";
        $z=preg_replace($pattern,'<samp>$1</samp> ',$text);
        return $z;
    }


    function category($text){
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php

        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{category:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\:]+)\}\}/";
        $success=preg_match_all($pattern,$text,$values);

        if ($success){return $values[1][0];}
        return $success;
    }

    function pinnote($text){
        $pattern="/\{\{pinnote:\s*([^\}]+)\}\}/";
        $z=preg_replace($pattern,'<div class="pinnote"><strong>Note!</strong>$1</div> ',$text);
        return $z;
    }

    function img($text){
        $pattern="/\{\{img:\s*([^\}]+)\}\}/";
        $z=preg_replace($pattern,'<div style="width:32.5%;clear:both;margin-right:15px" class="default clearfix"><a href="$1"><img src="$1" style="width:98%;float:left;margin:0 auto" /></a></div> ',$text);
        return $z;
    }

/*    function credit($text){
        $pattern="/\{\{credit\s*:\s*([^\}]+)\}\}/";
        $success=preg_match_all($pattern,$text,$values);
        $values=explode('|',$values[1][0]);
        $replace='<div class="credit-image"><a class="credit-image-link" href="">'.$values[0].'<\/a><\/div>';
        //echo $replace;break;
        $z=str_replace('credit','CREDIT',$text);
             return $z;

    }
*/
    // format a snippet this is plain
    // it does not produce a sandbox
    // modified june 2011
    function snippet($text){
        $pattern="/\{\{snippett*\s*:\s*([^}]+)[}]\}/";
        $before='<div class="code-block code" style="padding-top:0px;padding-bottom:0px;margin-bottom:0px;min-height:0px;"><pre class="PHP" style="padding-top:0;padding-bottom:0;margin:0;min-height:15px">';
        $after='</pre></div>';
        // dollar must be within replace?
        $z=preg_replace($pattern,$before.'$1'.$after,$text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        return $z;
    }

    function snippetPHP($text){
        $pattern="/\\\\begin{PHP}\s*([[:alnum:]\/\)\\\\\(\)\+\@\,\^\*\[\]\_\.\>\<\=\{\}\-\&\s\$\'\"\!\.\?\;\:]+)\\\\end{PHP}/";
        $before='<div class="code-block code"
               style="padding-top:10px;padding-bottom:10px;margin-bottom:15px">
                <pre class="PHP" style="padding-top:0;padding-bottom:0;margin:0">';
        $after='</pre></div>';
        // dollar must be within replace?
        $z=preg_replace($pattern,$before.'$1'.$after,$text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        //preg_match_all($pattern,$text,$array);
        //echo_array($array);
        //$z=$array[1][0];
        return $z;
    }


    // added class ui-corner-all
    // creates the standard console block
    function plain_code($text){
        $pattern="/\{\{plain-code:\s*([^%]+)[%]\}/";
        $before='<div class="code-block console-wrap"><div class="code-block code"><code>';
        $after='</code></div></div>';
        // dollar must be within replace?
        $z=preg_replace($pattern,$before.'$1'.$after,$text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        return $z;
    }

    // TODO
    function plain($text){
        $pattern="/\{\{plain:\s*([^\}]+)\}\}/";
        $before='<div class="code-block console-wrap clearfix"><div class="code-block code"><pre style="padding:0 0 0 0;margin:0 0 0 0">';
        $after='</pre></div></div>';
        // dollar must be within replace?
        $z=preg_replace($pattern,$before.'$1'.$after,$text);
        //$z=preg_replace($pattern,$before+'$1AAAAA</code></div></div>',$text);
        return $z;
    }



    function example($text){
        $pattern="/\{\{example:\s*([^\}]+)\}\}/";
        $z=preg_replace($pattern,'<div style="font-size:13px;background-image:url(' . site_url() . '/images/code-bg.gif);border:1px solid #ececec;padding:10px;margin-bottom:8px;" class="clearfix">$1</div> ',$text);
        return $z;
    }

    function album_page($text){
        $pattern="/\{\{album-page:\s*([^\}]+)\}\}/";
        $z=preg_replace($pattern,'<div class="clearfix" style="font-size:13px;background-image:url(' . site_url() . '/images/code-bg.gif);border:1px solid #ececec;padding:10px;margin-bottom:8px;" class="clearfix">$1</div> ',$text);
        return $z;
    }

    function bulb($text){

        $pattern="/\{\{bulb\s*:\s*([^\}]+)\}\}/";
        $z=preg_replace($pattern,'<div class="bulb ui-corner-all"><strong>Note! </strong>$1</div> ',$text);
        return $z;
    }




    function download($text){
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php

        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{\*download:\s*([[:alnum:]\/\)\(\,\.\-\&\s\'\"\!\.\?\;\]\[\:]+)\}\}/isx";
        $z=preg_replace($pattern,'<div class="download ui-corner-all"><strong>Note! </strong>$1</div> ',$text);
        return $z;
    }


    function warning($text){
        //replaces text between {{}} with wiki links
        //http://www.php.net/manual/en/function.call-user-func.php

        //$pattern="/\{\{phplink:\s*([[:alnum:]\-\_\.]+)\}\}/";
        //preg_match_all($pattern,$text,$values);
        $pattern="/\{\{warning:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\}/isx";
        $pattern=$this->regexAll;
        $z=preg_replace($pattern,'<div class="warning ui-corner-all"><strong>Caution!</strong> $1</div> ',$text);
        return $z;
    }

    function sandbox($text){
        $pattern="/\{\{sandbox:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\'\"\!\.\?\;\<\>\:]+)\}\}/";
        $z=preg_replace($pattern,'<div class="sandbox ui-corner-all"><h5>Sandbox!</h5>$1</div> ',$text);
        return $z;
    }

    //changed to include rotated banner if required
    // does not work very well
    function feature($text){
        //echo $text;
        $pattern="/\{\{feature:(\s*.*?)\}\}/isx";
        preg_match_all($pattern,$text,$values);
        $z=preg_replace($pattern,'<div class="rot-ex">$1</div>',$text);
        //returns the values extracted
        $feature=@$values[1][0];
        return $feature;
    }

    function parseField($field,$text){
        //parses any specific field
        //this is a general routine for replacement macros keywordsetc.
        $pattern="/\{\{$field\s*:\s*([^\}]+)\}\}/x";
        // $pattern="/\{\{$field:\s*([[:alnum:]\/\)\(\\\=\,\.\-\&\$\}\{\s\^\)\(\%\'\"\!\.\?\;\<\>\n\r\:]+)\}\}/isx";
        preg_match_all($pattern,$text,$array);
        $field=@$array[1][0];
        return $field;
    }

    function flagIcon($text){
        //need to make a call back
        //parses any specific field
        //this is a general routine
/*
  $pattern="/\{\{flagicon\s*:*\s*\|*(.*?\s*)\}\}/isx";
  preg_match_all($pattern,$text,$array);
  echo_array($array);

  foreach ($array[0] as $key=>$value){
  $s=explode('|',$array[1][0]);
  if (count($s)>1){
   $z='';
   foreach($s as $key=>$v){
   $z='<img src="' . site_url() . '/images/'.trim($v).'.png"</img>';}
   $z=preg_replace($v,$z,$text);
   return $z;
  }
  else
  {
  $z=preg_replace($pattern,'<img src="' . site_url() . '/images/$1.png"</img> ',$text);
  return $z;
  }
  }
  */
        return $text;
    }

    /*  fetches the time from a file
     *  and echoes it
     */
    /*  @param filename filename
     *
    */

    function showTime($filename,$show=true){
        // outputs e.g.  somefile.txt was last changed: December 29 2002 22:16:23.
        //$filename = 'somefile.txt';
        if (file_exists($filename)) {
            echo "$filename was last changed: " . date("F d Y H:i:s.", filectime($filename));
        }else{echo "-1";}

    }

}
?>


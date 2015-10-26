<embed id="VideoPlayback" style="width:400px;height:326px" flashvars="" src="http://video.google.com/googleplayer.swf?docid=6980696359567898201&hl=en" type="application/x-shockwave-flash"> </embed>

<?php
include_once('utilities.php');
include_once('regex.php');
include_once('markdown.php');

//Class that takes care of corpus management
//These routines are for managing large corpora
//via the web
//once a file is uploaded it enters a que for processing


define("BROWNDIRECTORY","../corpora1/corpora/brown/");
define("GUTENBERGDIRECTORY","../corpora/");
define("POSDIR","../dict/POS/");

echo CORPUS; // outputs "Hello world."



$corpus=new corpus;

$text='child childish lazaridou lazarides lazarakis lazarou lazaridi lazar ';
  $text.=file_get_contents('caesar.txt');
  $text.=file_get_contents('alice.txt');
  $text.=file_get_contents('benjamin.txt');
  $text.=file_get_contents('italian.txt');
  $text.=$corpus->get_contents($text);
  //$text=file_get_contents('http://latenightengineer.com/play');
  //$text.=file_get_contents('dictionary.txt');
  //$text.=file_get_contents('german.txt');
  $text=preg_replace('/([\n\r]+)/',' ',$text);
  $corpus->_debug=true;
  $corpus->determinants('the',$text,2);
  
  
  $voc=vocabulary(strtolower($text));
  echo 'Vocabulary '.count($voc);
  echo_array($voc);
  echo_array($values);
  
  
  
  $corpus->prefix_search($text,19);
  $corpus->morpheme('where',$text);break;
  $wrb=$corpus->readPosDictionary(POSDIR.'rp.pos');

echo_array($wrb);break;



$files=$corpus->dirToLinks(GUTENBERGDIRECTORY);
//$corpus->display_readme(GUTENBERGDIRECTORY.'25190-8.txt');
for($i=0;$i<count($files);$i++){
  $text.=file_get_contents(GUTENBERGDIRECTORY.$files[$i]);
  $values=$corpus->bookTitle($text);
  echoPRE($values[0]);
if ($values[0]>'') echo '<hr />';}
echo_array($files);


//$corpus->display_readme('../corpora1/corpora/brown/CONTENTS');

//$text=$corpus->remove_gutenberg_notes($text);


//$text=$corpus->removeBrownTags($text);
$text=preg_replace('/[--]/',' ',$text);
$text=strtolower($text);
echo statistics($text);$voc=vocabulary($text);
echo_array($voc);echo count($voc);

break;
$text=$corpus->get_contents('caesar.txt');
echo $text;
$values=$corpus->bookTitle($text); //for Gutenberg
//echo removeBrownTags($text);
break;


/*
try{
    // create a new spl file object from a file
        $file = new SplFileObject("alice.txt");
    // check if for validity
        while($file->valid())
                {
        // echo the current line
                echo $file->current().'<br />';
        // increment the iterator
                $file->next();
                }
        }
catch (Exception $e)
        {
        echo $e->getMessage();
        }
*/


$tags=$corpus->brownTags();
echo_array($tags);


   
$text=$corpus->list_all($dirName,$fnames);
$z=$corpus->removeBrownTags($text);
echo markdown($z);break;
$corpus->dirToLinks('../strings/');
echo_array($fnames);

  //lists all names of the brown directory
                                    //and returns the tagged text
//$newtext='Where are all the people? However, it may be possible to answer why or when.
//Whenever, you near whereby a man not accept bribes. I have and was in school for twenty five years. //The preposition is something. Everyman for his own the teacher said' ;



//$newtext=$corpus->highlight_dictionary_words($values,$text,'red');
//$newtext=$corpus->dictionary_tagger($tags,$text,$color);
//echo $newtext;
//$text=$newtext;


$z=$corpus->brownGetTagByToken('halfway',$text);
echo_array(array_count_values($z[0]));
echo_array(max(array_count_values($z[0])));break;
break;
$corpus->frequencyByTag('no',$text);
break;
$corpus->getGrammar('orient',$text);
$newtext=file_get_contents('alice.txt');
$newtext=$corpus->remove_stop_words($newtext);
$corpus->dictionary_tagger($tags,$newtext,$color);

break;
$corpus->saveTags($text);
break;
statistics($text);                  //corpus statistics           
$corpus->getGrammar($tag,$text);
$corpus->brownGetTagByToken('runs',$text);



$tag=$corpus->brownTags();          //gets a list of all the tags

$sum=0;
for ($i=0;$i<count($tag);$i++){ //for all the tags
  echo $tag[$i].'<br />';
  //returns array of unique words with tags
  $result=$corpus->brownGetByTag($tag[$i],$text);
  echo count($result).'<br />';
  $sum=$sum+count($result);
  //save to file
  $file_contents=implode(' ',$result);
  file_put_contents('../dict/POS/'.$tag[$i].'.pos',$file_contents);
  
  
  
  
}
echo 'Total vocabulary'.$sum.'<br />'; //total tagged vocabulary






class corpus {

   public $_debug = false;
   
   
   
   public function determinants($suffix,$text,$nwords){
   
   $pattern='/\b('.$suffix.')[\s]+([[:alpha:]]+[s]*\s+){0,'.$nwords.'}/isx';
   preg_match_all($pattern,$text,$values);
   
   echo_array(array_unique($values[0]));
   
   
   }
   
   
   public function prefix_search($text,$n){
   $text=strtolower($text);
   $pattern='/\b([[:alpha:]]{'.$n.'})[\s]/isx';
   preg_match_all($pattern,$text,$values);
   echo_array(array_count_values($values[1]));
   echo 'number n-gram'.count(array_count_values($values[1])).'<br />';
   }

   public function count_char_in_array($array){
   $count=0;
      foreach ($array as $key=>$value){
       $no_char=strlen(trim($value));
       $count=$count+$no_char;
      }
   return $count;}

   public function morpheme_boundary($v,$a){
   $pattern=trim($v);  //for first word
   $text=implode(' ',$a);
   echo $v;
     $z=preg_match_all('/\b'.$pattern.'([[:alpha:]]*)/',$text,$results);
     if ($z>0) echo_array(array_unique($results[1]));
     $n=$this->count_char_in_array(array_unique($results[1]));
     echo 'NUMBER OF CHARACTERS ='.$n;
    }

   public function morpheme($mor,$text){
   //function receives morpheme
   //check occurences in text
    $text=strtolower($text); //needs to go to preprocessor
      
    //$pattern='/\b([[:alpha:]]{3})[[:alpha:]]{3,}\s/isx';
    $pattern="/\b".trim($mor)."([a-zA-Z])*\s/isx";
    $z=preg_match_all($pattern,$text,$values);
   
    if( $this->_debug == true ) {
      echo_array(array_count_values($values[0]));
     $v=($values[1]);
    
     $unique_terms=array_unique($values[0]);
     foreach ($unique_terms as $key=>$value) {
        $u[]=$value;
     }
     
     asort($u);
     echo_array($u);
     
     $n=$this->count_char_in_array($u);
     echo 'NUMBER OF CHARACTERS ='.$n.'<br />';
     $search=$values[0][$min_index];
     //finds minimum 
     
     $min=99;
     for ($i=0;$i<count($values[0]);$i++){
       if (strlen(trim($values[0][$i]))<$min){ 
      $min=strlen(trim($values[0][$i]));
      $min_index=$i;
      }
  
        
    
     } 
     echo 'MINIMUM ='.$min.'  '.$min_index;
     if ($min>trim(strlen($mor))){$min=trim($mor);
     $search=$min;}else {$search=$values[0][$min_index];}
     $this->morpheme_boundary($search,$values[0]);
     
     
     break;//$values[0][$min_index]
     echo_array(array_count_values($v));
     
     
     echo '<pre>';
     
     foreach ($v as $key => $val) {
       echo "$key \n";
      }
       echo '</pre>'; 
     echo count(array_unique($values[1])).'<br />';
     
     echo count($values[1]);
     }
     
     
     
     echo 'morpheme boundary \n';
     $values[0]=array_unique($values[0]);
     for ($i=0;$i<count($values[0]);$i++){
     $values[0][$i]=trim($values[0][$i]);
     $this->morpheme_boundary($values[0][$i],$values[0]);}
     
     
   return $values[1];  
  }



public function list_all($dirName,&$fnames){
//lists of all the files in a corpus directory
//uses SPL library Standard PHP Library
//The library uses iterators and in many respects is hard
//to understand
try{
  /*** class create new DirectoryIterator Object ***/
    foreach ( new DirectoryIterator('../corpora1/corpora/brown/') as $Item )
        {
        //$size=round(($Item->getSize())/1024, 2);
        //echo'<pre>';
        //print_r($Item->getType());
        $fname=$Item->getFilename();
        $fnames[]=$fname;
        //echo $fname.'<br />';
        $realpath=$Item->getRealPath();
        //echo $realpath;
        $text.=file_get_contents('../corpora1/corpora/brown/'.$fname);
        //r_dump($Item->getFileInfo());
        //echo file_get_contents('../corpora1/corpora/brown/.'.$Item->getFilename);
        //if (!$Item->isFile) {echo $Item.'  ';echo $size.'  KB<br />';}
        //echo '</pre>';
        }
 
    }
 
/*** if an exception is thrown, catch it here ***/
catch(Exception $e){
    echo 'No files Found!<br />';
}

foreach( get_class_methods(SplFileObject) as $methodName)
        {
        echo $methodName.'<br />';
        }
//echo $text;
echo constant;
return $text;
}

public function removeBrownTags($text){
//untags the Brown Corpus
 $pattern[]='/\/[[:alpha:]\$\-\*\,\.]+[\s]*/isx';$replace='';
 echo $text;
 //$pattern[]='/[\,][\/][\,]/isx';$replace='AAAAAAAAAAAAAA';
 //$pattern[]='/\/\.\s/isx';$replace='';
 $pattern[]='/\/\?/isx';$replace=' ';
 $pattern[]='/\/\'/isx';$replace=' ';
 $pattern[]='/\/\"/isx';$replace=' ';
 $pattern[]='/\/\`/isx';$replace=' ';
 $pattern[]='/\/\:/isx';$replace=' ';
 $pattern[]='/\/\)/isx';$replace=' ';
 $pattern[]='/\/\(/isx';$replace=' ';
 //$pattern[]='/\s[\,]\s/ix';$replace=', ';
 preg_match_all($pattern,$text,$values);
 $text=preg_replace($pattern,$replace,$text);
 echo 'in brown';
 $s=array_unique($values);
 $array = array_unique($values[1]);
 echo_array($array);
 echo $text;
}


public function brownGetByTag($tag,$text){
//gets tag and return unique array with words tagged
//by tag 
  $pattern='/\s([[:alpha:]]+)\/'.$tag.'[\s]/isx';
  preg_match_all($pattern,$text,$values);
  $array = array_unique($values[1]);
  echo_array($array);
  return ($array);
}


public function frequencyByTag($word,$text){
//gets tag and return unique array with words tagged
//by tag 
  $text=strtolower($text);
  $pattern='/('.$word.'\/[[:alpha:]\*]+)[\s]/isx';
  preg_match_all($pattern,$text,$values);
  echo $values;
  $array = array_unique($values);
  $wordfrequency = array_count_values( $values[1]);
  echo_array($wordfrequency);
  echo count($array[1]);
  echo_array($array);
  return ($array);
}


public function getGrammar($tag,$text){
//gets tag and return unique array with words tagged
//by tag 
  $pattern='/\s([[:alpha:]]+)\/vbd'.'\s([[:alpha:]]+)\/in[\s]([[:alpha:]]+)\/dt\s([[:alpha:]]+)\/nn[[:alpha:]]*/isx';
  $pattern='/\s([[:alpha:]]+)\/md[[:alpha:]]*'.'\s([[:alpha:]]+)\/vbd+[[:alpha:]]*[\s]([[:alpha:]]+)\/nn[[:alpha:]]*\s([[:alpha:]]+)/isx';
  //$pattern='/(\s([[:alpha:]]+)(\/md|\/vb))+/isx';
  $pattern='/(\s([[:alpha:]]+)(\/nn))+(\s([[:alpha:]]+)(\/[[:alpha:]]{0,3}))/isx';
  preg_match_all($pattern,$text,$values);
  $array = array_unique($values[6]);
  $wordfrequency = array_count_values( $values[6]);
  echo_array($wordfrequency);
  echo count($array[1]);
  echoPRE($values);
  //echo_array($array);
  //echo count($array[0]);
  //echo_array($array);
  return ($array);
}






public function brownGetTagByToken($token,$text){
//gets tag and return unique array with words tagged
//by tag 
  $pattern="/\b".$token."[\/][[:alpha:]]*[\s]/isx";
  preg_match_all($pattern,$text,$values);
  echo_array($values);
  return ($values);
}


public function toHTML(){
//ouputs to browser list of all corpus files and their statistics
//  NP            VB
//                |
//                |__
//                |  |
//                vb  nn
//              went  home
}

public function markdowntoHTML($text){
//marking down text for echo to html
//
markdown($text);
echo $text;
}



public function meta(){

}


public function sort(){
//sorts the list of files


}


public function brownTags(){
//read tags from an array so far these are the ones
//that I have found
$tag[]='abl';	$tagHelp[]='pre-qualifier	quite, rather';
$tag[]='abn';	$tagHelp[]='pre-quantifier	half, all';
$tag[]='abx';	$tagHelp[]='pre-quantifier	both';
$tag[]='ap';	$tagHelp[]='post-determiner	many, several, next';
$tag[]='at';  $tagHelp[]='article	a, the, no';
$tag[]='be';	$tagHelp[]='be';	 
$tag[]='bed';	$tagHelp[]='were';	 
$tag[]='bedz';$tagHelp[]='was';	
$tag[]='bedz*';$tagHelp[]='was';	
$tag[]='beg'; $tagHelp[]='being';	 
$tag[]='bem';  
$tag[]='bem*';
$tag[]='ben';
$tag[]='ber';
$tag[]='ber*';
$tag[]='bez';
$tag[]='bez*';
$tag[]='cc';
$tag[]='cd';
$tag[]='cd$';
$tag[]='cs';
$tag[]='do';
$tag[]='do*';
$tag[]='do+ppss';
$tag[]='dod';
$tag[]='dod*';
$tag[]='doz';
$tag[]='doz*';
$tag[]='dt';
$tag[]='dt$';
$tag[]='dt+bez';
$tag[]='dt+md';
$tag[]='dti';
$tag[]='dts';
$tag[]='dts+bez';
$tag[]='dtx';
$tag[]='ex';
$tag[]='ex+bez';
$tag[]='ex+hvd';
$tag[]='ex+hvz';
$tag[]='ex-md';
$tag[]='fw'; //foreign word (hyphenated before regular tag)
$tag[]='fw-jj'; //foreign word (hyphenated before regular tag)
$tag[]='hl';	//word occurring in headline (hyphenated after regular tag)	 
$tag[]='hv';	//have	 
$tag[]='hvd';	//had (past tense)	 
$tag[]='hvg';	//having	 
$tag[]='hvn';	//had (past participle)	 
$tag[]='hvz';	//has
$tag[]='in';	//preposition
$tag[]='jj';	//adjective	 unmeritorious, political, periodic,
$tag[]='jjr';	//comparative adjective	 
$tag[]='jjs';	//semantically superlative adjective	chief, top
$tag[]='jjt';	//morphologically superlative adjective	biggest
$tag[]='md';	//modal auxiliary	can, should, will
$tag[]='nn';	//singular or mass noun	 
$tag[]='nn$';	//possessive singular noun	 
$tag[]='nns';	//plural noun	 
$tag[]='np';	//proper noun or part of name phrase	 
$tag[]='np$';	//possessive proper noun	 
$tag[]='nps';	//plural proper noun	 
$tag[]='nps$';	//possessive plural proper noun	 
$tag[]='nr';	//adverbial noun	home, today, west
$tag[]='od';//	ordinal numeral	first, 2nd
$tag[]='pn';//	nominal pronoun	everybody, nothing
$tag[]='pn$';	//possessive nominal pronoun	 
$tag[]='pp$';	//possessive personal pronoun	my, our
$tag[]='pp$$';	//second (nominal) possessive pronoun	mine, ours
$tag[]='ppl';	//singular reflexive/intensive personal pronoun	myself
$tag[]='ppls';//	plural reflexive/intensive personal pronoun	ourselves
$tag[]='ppo';//	objective personal pronoun	me, him, it, them
$tag[]='pps';//	3rd. singular nominative pronoun	he, she, it, one
$tag[]='ppss';//	other nominative personal pronoun	I, we, they, you
$tag[]='ql';//	qualifier	very, fairly
$tag[]='qlp';//	post-qualifier	enough, indeed
$tag[]='rb';	//adverb	 
$tag[]='rbr';	//comparative adverb	 
$tag[]='rbt';	//superlative adverb	 
$tag[]='rn';	//nominal adverb	here then, indoors	 
$tag[]='rp';//	adverb/particle	about, off, up
$tag[]='tl';//	word occurring in title (hyphenated after	 
 	//regular tag)	 
$tag[]='to';//	infinitive marker to
$tag[]='uh';	//interjection, exclamation	 
$tag[]='vb';	//verb, base form	 
$tag[]='vbd';	//verb, past tense	 
$tag[]='vbg';	//verb, present participle/gerund	 
$tag[]='vbn';	//verb, past participle	 
$tag[]='vbz';	//verb, 3rd. singular present
$tag[]='wdt';	//wh- determiner	what, which
$tag[]='wp$';	//possessive wh- pronoun	whose
$tag[]='wpo';	//objective wh- pronoun	whom, which, that
$tag[]='wps';	//nominative wh- pronoun	who, which, that
$tag[]='wql';	//wh- qualifier	how
$tag[]='wrb';	//wh- adverb	how, where, when
return $tag;
}


public function readPosDictionary($fileName){
  //reads a POS dictionary to be extended to include frequencies
  //each category is in one file. This might not be very efficient
  //alphabetical with frequencies is better
  //also most frequent tag might be better or n-gram
  $terms=file_get_contents($fileName,'r');       //read file .pos
  $terms=preg_replace('/[\s\n\r]+/',' ',$terms); //bit of house-keeping before we read
  $terms=preg_split('/(\n|\r|\s)/',$terms);      //split into array
  $terms=array_unique($terms);                   //make array unique
  echo_array($terms);                       
  return $terms;                                 //return array
}


function highlight_dictionary_words($values,$newtext,$color){
//$values=array_unique($values);
$terms=self::readPosDictionary('../dict/POS/wrb.pos');
for ($i=0;$i<count($terms);$i++){                   //count($values)
  $pattern=trim($terms[$i]);
  //$newtext=preg_replace('%\b'.$pattern.'\b%',"<span style=\"color:$color \">"."$0/wrb</span>",$newtext);
   $newtext=preg_replace('%\b'.$pattern.'\b%',"$0/WRB",$newtext);
}
return $newtext;
}

function dictionary_tagger($tags,$newtext,$color){
//$values=array_unique($values);
//better vertically aligned?
$tags=self::brownTags();  //gets tag list
for ($i=0;$i<count($tags);$i++){
  $tag=$tags[$i];
  $terms=self::readPosDictionary('../dict/POS/'.$tag.'.pos');
  echo_array($terms);
  if (count($terms)>2)
  {for ($j=0;$j<count($terms);$j++){                   //count($values)
    $pattern=trim($terms[$j]);
    $tag=strtoupper($tag);
    $newtext=preg_replace('%\b'.$pattern.'\b%',"$0 <sub>$tag</sub> ",$newtext);
  }
 }
}
  
echoPRE($newtext);
return $newtext;
}

public function saveTags($text){
$tag=self::brownTags();          //gets a list of all the tags
//echo_array($tag);
$sum=0;
for ($i=0;$i<count($tag);$i++){ //for all the tags
  echo $tag[$i].'<br />';
  if (substr($tag[$i], -1) == '*') {
  $tag[$i] = substr("$tag[$i]", 0, -1);//removes star
  $tag[$i]=$tag[$i].'$';
  echo 'IN ERROR';
    }               
     
  //returns array of unique words with tags
  $result=self::brownGetByTag($tag[$i],$text);
  echo count($result).'<br />';
  $sum=$sum+count($result);
  //save to file
  $file_contents=implode(' ',$result);
  file_put_contents('../dict/POS/'.$tag[$i].'.pos',$file_contents);
  
}
}
public function remove_stop_words($newtext){
//$values=array_unique($values);
$text=file_get_contents('stop-words.txt');
$pattern='/\n/sx';
$values=preg_split($pattern,$text);
//echo_array($values);
//echo_array($values);break;
//echo 'IN HIGHLIGHT<br />';
//echo_array($values);
for ($i=0;$i<count($values);$i++){                   //
  $pattern=trim($values[$i]);
  $newtext=preg_replace('%\b'.$pattern.'\b%is','',$newtext);
}
//echo $newtext;
return $newtext;
}

public function get_contents($text){
//reads the contents from files and concats the text
//corpus files is an array with links to all files
//to be concatenated
/*$text.=file_get_contents('caesar.txt');//1
$text.=file_get_contents('alice.txt');//2
$text.=file_get_contents('War_and_Peace.txt');//3
$text.=file_get_contents('1911.txt');//4
$text.=file_get_contents('science1.txt');//5
$text.=file_get_contents('science2.txt');//6
$text.=file_get_contents('science_volI.txt');//7
$text.=file_get_contents('science_volII.txt');//8
$text.=file_get_contents('science_volIII.txt');//9
//$text.=file_get_contents('science_volIV.txt');//10
$text.=file_get_contents('chemistry.txt');//11
$text.=file_get_contents('fingerprints.txt');//12
$text.=file_get_contents('st_augustine.txt');//13
$text.=file_get_contents('bernard_shaw.txt');//14
$text.=file_get_contents('benjamin.txt');//15
$text.=file_get_contents('pick-up.txt');//16*/
$text.=file_get_contents('../corpora/blztr10.txt');//17
$text.=file_get_contents('../corpora/koran12a.txt');//18
$text.=file_get_contents('../corpora/cca0610.txt');//19
$text.=file_get_contents('../corpora/parker4.txt');//20
$text.=file_get_contents('../corpora/1lotj10.txt');//legends of the Jews//21
$text.=file_get_contents('../corpora/2lotj10.txt');//legends of the Jews//22
$text.=file_get_contents('../corpora/4lotj10.txt');//legends of the Jews//23
$text.=file_get_contents('../corpora/17921-8.txt');//Manual of surgery needs clean-up//24
$text.=file_get_contents('../corpora/christmas.txt');//Christmas traditions//25
$text.=file_get_contents('../corpora/10940-8.txt');//Middle Ages Customs//26
$text.=file_get_contents('../corpora/gaston.txt');//History of Egypt//27
$text.=file_get_contents('../corpora/25100-8.txt');//Commodore Barry 28
$text.=file_get_contents('../corpora/25104-8.txt');//Ocean Post! //29
$text.=file_get_contents('../corpora/20702-8.txt');//Ocean Post! //30
$text.=file_get_contents('../corpora/25107-8.txt');//Sarreo //31
$text.=file_get_contents('../corpora/25108.txt');//Australia/32
$text.=file_get_contents('../corpora/25109-8.txt');//Australia/33
$text.=file_get_contents('../corpora/24996-8.txt');//Tapu
$text.=file_get_contents('../corpora/22657-8.txt');// Steam
$text.=file_get_contents('../corpora/10073-8.txt');// Vocabulary Builder
$text.=file_get_contents('../corpora/15106-8.txt');// Boer war

return $text;
}

public function bookTitle($text){
//gets the title of a guthenberg book
//from header
$pattern='/Title\:[[:alpha:]\s\:\,\d\#]+
           [\n\r\s\d\,\[\][:alpha:]\s]+/isx';
$pattern='/Title\:([[:alpha:]\s\:\,\d\#\n\r\[\]\,\.\\ \=\;\(\)\-\'\"\&])+
          [\n\r]{2}/isx';        
preg_match_all($pattern,$text,$values);
return $values[0];


}

public function dirToLinks($dirName){
//lists of all the files in a corpus directory
//uses SPL library Standard PHP Library
//The library uses iterators and in many respects is hard
//to understand
try{
  /*** class create new DirectoryIterator Object ***/
    foreach ( new DirectoryIterator($dirName) as $Item )   //../corpora1/corpora/brown/
        {
        $size=round(($Item->getSize())/1024, 2);
        //echo'<pre>';
        //print_r($Item->getType());
        $fname=$Item->getFilename();
        //echo $fname.'<br />';
        $realpath=$Item->getRealPath();
        //echo $realpath;
        if(is_file($realpath)){$link.='<li><a href="'.$dirName.$fname.'"> '.$fname." $size KB</a></li>";
        $fileNames[]=$fname;
       }
        //r_dump($Item->getFileInfo());
        //echo file_get_contents('../corpora1/corpora/brown/.'.$Item->getFilename);
        if(is_file($realpath)) {//echo $Item.'  IS FILE  ';echo $size.'  KB<br />';
        }
        //echo '</pre>';
        }
 
    }
 
/*** if an exception is thrown, catch it here ***/
catch(Exception $e){
    echo 'No files Found!<br />';
}

$link='<ul>'.$link.'</ul>';
echo markdown($link);
return $fileNames;
}

public function display_readme($file){
$text=file_get_contents($file);
echo markdown($text);
}

public function remove_gutenberg_notes($text){

$p="/(End of the Project Gutenberg[[:alpha:]\d\*\n\r\s[:punct:]]+)/";
$text=preg_replace($p,'',$text);

if (strlen($text)>5) return $text; //if replacement is found
}

function _scrollDown( ){
	
			print( '<script> window.scrollBy(0,1000000); </script> ' );
		
	}		


}//end class







?>
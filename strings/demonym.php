<?php
//A class that finds demonyms such as names of people of
//various countries.

include_once('regex.php');
include_once('utilities.php');
include_once('preprocessor.php');

$text=file_get_contents('irish-sample.txt');

$text='John is Irish and Mary is Turkish. Yannis is Greek and Wei is Chinese';


$words=explode(' ',$text);
echo_array($words);

$den=new Demonym;

for ($i=0;$i<count($words);$i++){
$word=$words[$i];
echoPRE('Searching for ... '.$word.' ');
$wor=$den->denonym($word);
if ($wor>0) {echo 'Word is a demonym <br />';}
}

//A class to search for Demonyms in text
//requires the use of external files


class Demonym{

var $files=array('greek-people.txt',
                 'germanic-tribes.txt',
                 'denonyms.txt');
                 
 public function highlight_text($word){
  $word=str_replace($word, '<span style="color:red">'.$word.'</b> ',$word);
  echo $word;
    
 }


 public function denonym($word){
   $original=$word;
   if (substr($word, -1) == 'i') {
   $word=substr_replace($word, '',-1);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo 'Make '.$word;
                return true;}
  //(a)n (Korea? Korean, America ? American, India ? Indian, San Diego ? San Diegan, Rome ? Roman, Malaysia  ? Malaysian, Lithuania ? Lithuanian, Armenia ? Armenian)              
 if (substr($word, -2) == 'an') {
   $word=substr_replace($word, 'a',-2);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo 'Make '.$word; return true;              
            }
 
 if (substr($word, -2) == 'er') {
   $word=substr_replace($word, '',-2);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo 'Make '.$word; return true;              
            }
                           
 if (substr($word, -3) == 'ker') {
   $word=substr_replace($word, '',-3);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo 'Make '.$word; return true;              
            }
   //-er (Quebec ? Quebecer or Quebecker, New York ? New Yorker, New England ? New Englander, New Zealand ? New Zealander, London ? Londoner, Auckland ? Aucklander)         
  if (substr($word, -3) == 'ian') {
   $word=substr_replace($word, '',-3);
              echo '  probably somebody from ... '.$word;return true;
            }           
  # -eno (Los Angeles ? Angeleno or Los Angeleno), adapted from the standard Spanish suffix eño, as in Salvadoreño
  if ((substr($word, -3) == 'eno') || (substr($word, -3) == 'ene')){
   $word=substr_replace($word, '',-3);
         echo '  probably somebody from ... '.$word;return true;
            }  
  if (substr($word, -3) == 'ese') {
   $word=substr_replace($word, '',-3);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo '  probably somebody from ... '.$word.'a ';return true;
            }            
  if (substr($word, -3) == 'ish') {
   $word=substr_replace($word, '',-3);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo '  probably somebody from ... '.$word;
            return true;
            }    
                   
 if (substr($word, -4) == 'nian') {
   $word=substr_replace($word, '',-4);
                //OR self::replace($word, 'us',''); needs checking where to add  
                echo '  probably somebody from ... '.$word;
                return true;
            }           
 
 return false;
}


public function lexical_attack($abbr){
//checks an abbreviation against a lexicon
//if not found word is placed in a file for 
//manual check

$i=0;
for ($j=0;$j<count($files)+1;$j++)
  {
     $haystack=file_get_contents($files[$j]);
     $success=find_token($abbr,$haystack,$results);
     if ($success) {
           echo ' found '.$abbr.' in file '.$files[$j].' <br />';
           //$abbr=preg_quote($abbr);
           //$pattern="/\b$abbr\s*.*[\n\r]/";
           //preg_match_all($pattern,$haystack,$values); //find definition
           //echo_array($values);
           
           } else {echo '.';}
     $i=$i+1;
  }
     echo '.. '.$abbr.'In Lexical attack, checked through  '.($i*340).' abbreviations for '.$abbr.'<br />';

}

} //end class 



?>




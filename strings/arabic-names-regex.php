<?php
include_once('utilities.php');
include_once('regex.php');
include_once('markdown.php');
@set_time_limit ( 20*60 ) ; # Time limit 20min
 

echo 'Checking Text Against Database.....';



$text1=file_get_contents('irish-sample.txt');
echo 'Text retrieved ..... <br />';
$text=$text1; //preserve original
//$text=$text1; //decodes &#8216; and the like
/*
$limit=count($needle);
for ($i=0;$i<$limit;$i++){
find_token($needle[$i],$text, $results);
//echo_array($results);
echo count($results[0]).'   '.$needle[$i].'<br />';
}
*/

//$text1=file_get_contents('http://en.wikipedia.org/wiki/Category:Italian_writers');

  $values=parse1($text1);
  echo count($values[0]);
  $length=count($values[0]);
  
  for ($i=0;($i<$length);$i++){
    $name=explode(' ',$values[0][$i]);
    if (count($name[0]>1)){
                 is_Proper_Name(preg_quote(trim($name[0])));}
    echo '<br />';
  }
  
  is_Proper_Name($ProperName);
  

function parse1(&$text){
//
$pattern='/
(
 (\(|            #main pattern bracket
 Mr.\s|
 Mr\s|
 Mrs\s|
 Mrs.\s|
 Miss.\s|
 Miss\s|
 Prof.\s|
 Prof\s|
 Dr[.\s]|
 Sra.\s|
 Sra\s|The\sReverend| 
 h|de\s|van\s|van\sder\s|
 von\s|
 al\s|
 al-|
 Al\s|
 ibn\s|
 ibn\sal-|
 bin\s|
 bint\s|
 d\'|
 de\s|
 da\s|
 das\s|
 dos\s|
 \'t\s|      #more rare Dutch for example Maarten \'t Hart
 \úr\s|      #more rare Icelandic 
 \‘|
 \'|
 )? #optional prenoms
([[:upper:]][\.\s]?)+?
                   #starts with Capital letter O prenom catered with space
[[:alpha:]\'\-\.][[:alpha:]|’|\-\,]*        #allows for most Le Ni etc two characters
[\s|\.|\'|\)|\‘](y\s|e\s)?
(\"|\,jr[\.]?|sr[\.]?|Ph[\.\s]?D[\.\s]?|O\.?B\.?E\.?|K\.?B\.?E\.?)?   #suffixes for junior and senior Ph.D etc..
){2,}+/sx';

  preg_match_all($pattern,$text,$values);
  $text=preg_replace($pattern,'<strong> $0 </strong>',$text);
  echo_array($values);
  echo markdown($text);
  return $values;
}

 
  
//  echo markdown($text1);

  
  
  //First sieve to get names - almost there
  //echo_array(array_unique($names));
    
  echo 'text with bold names';
  
  
  

//onomastic($text);
//Version to include Arabic Names


//Proper Name Check
$ProperName[]='Juliana';
$ProperName[]='Mary';
$ProperName[]='John';
is_Proper_Name($ProperName);

//Dictioanry Check
$success=is_In_Dictionary('commonzx','Dictionary.txt');
if ($success)
    { echo 'Found in dictionary ';
     $is_in_dictionary=True;
    }
   else {
     echo 'not in dictionary';
    $is_in_dictionary=False;
   }


function is_Proper_Name($ProperName){
//Checks a file against common names
//names were obtained from US Census common names
//can add other language names here
//can do soundex also for mispelt names or slight variations
//needs to return something properly

echo "Checking for name: $ProperName  ";
 $file1='female-names';
 $file2='male-names';
 $file3='family-names';
 $needle=$ProperName;
 $text=file_get_contents('irish-surnames.txt');
 //$limit=count($needle);
   // for ($i=0;$i<$limit;$i++){
      find_token($needle,$text, $results);
      if (count($results[0])>0){
       echo '<em style="color:red"> Found token '.count($results[0]).'   '.$needle.'</em>';
        }
        else {echo " token not found $ProperName";}
     // } 
}

function is_In_Dictionary($word,$dictionary){
//Checks a word against a Dictionary
//returns a boolean dictionary can be web based!
 $text=file_get_contents($dictionary);
 $success=find_token($word,$text, $results);
 if ($success)
    { //echo 'Found in dictionary '.$needle.'<br />';
     $is_in_dictionary=1;
    }
   else {
     //echo 'not in dictionary';
    $is_in_dictionary=0;
   }
   return $is_in_dictionary;
}


function onomastic($text){
  //finds names not an easy routine if you ask me
  //Must remove all header information first
  //the following routines need cultivation
  $debug=True;
  $text1=$text;
  $pattern='/(\<h[\d][\s]?.*?\>(.*?)\<\/h[\d]\>)/isx'; //caters for style or other 
  $t=preg_match($pattern,$text,$values);//better turn it lower case
  if ($debug){ echo_array($values);}
  $text=preg_replace($pattern,'$1',$text);
   
  //Must remove menus
  $pattern='/(\<li[\s]?.*?\>(.*?)\<\/li\>)/isx'; //caters for style or other 
  $t=preg_match($pattern,$text,$values);//better turn it lower case
  if ($debug){echo_array($values);}
  $text=preg_replace($pattern,'$1',$text);
  //echo $text;
  
  //Must remove links
  $pattern='/\<a[\s]?.*?\>(.*?)\<\/a\>/isx'; //caters for style or other 
  $t=preg_match($pattern,$text,$values);//better turn it lower case
  if ($debug){echo_array($values);}
  $text=preg_replace($pattern,'$1',$text);
  //echo $text;
  
  
  
  //Must remove comments
  $pattern='/\<!--.*?[-]*?>/isx'; //caters for style or other 
  $t=preg_match($pattern,$text,$values);//better turn it lower case
  if ($debug){echo_array($values);}
  $text=preg_replace($pattern,' ',$text);
  
  
  //Must remove images
  $pattern='/(<img(.*?)>)/'; //caters for style or other 
  $t=preg_match($pattern,$text,$values);//better turn it lower case
  if (debug){echo_array($values);}
  $text=preg_replace($pattern,' ',$text);
  
  //Clean Text prepare to sparse
  
  
  //replaces dr etc to make regex easier
  $search[]='/Dr[\.]?/sx';$replace[]='Dr';
  $search[]='/Mr[\.]?/sx';$replace[]='Mr';
  $search[]='/Mrs[\.]?/sx';$replace[]='Mrs';
   $search[]='/Ms[\.]?/sx';$replace[]='Ms';
  
  $text=preg_replace($search,$replace,$text); 
  
  
  $pattern='/[\.]\s+?([A-Z]{1}[a-z\.]*[\s])/msx';
  $text=preg_replace($pattern,' ',$text);
  
  //echo_array(array_unique($values)); Gets actual names ie two names can miss a lot of others!
  
  $pattern='/ #
  (\b            #starts from a word boundary
    [\'\"\`\‘\(\-\[\]]*?          #optionally by a character such as inverted commas zero or more
                                    #times \'Yianni
    (
      [h]?[[:upper:]\‘\’,]+                #Must start with capital Y not for Arabic!!!
                                          #so put in brackets
      [[:alnum:]\'\’\-]+?                #followed by alphanumeric Yannis
      [\s\n\rc\']|(y|e|
      Ó|   #Gaelic
      du|d\'|                            #French
      dos|da|
      das|  #Portuguese
      de|de\s|von|van|der|van\sder|Mc|La|Le|ibn|Al-|al-|bin|bint|al\s|al-\‘|ar-|\'|\s)+ # All optional specials
    )?
                                     #Starts with a Capital letter or van der von Mc or 
    [h]?                             #Introduced for gaelic names such as hUiginn!!!
    [A-Z]+                           #one or more capital
    [[:alpha:]\'\’\‘\-\.]+?            #one or more lower case and hyphenation
    
    [\.\!\'\"\’\,\)\(\[\]\s\-]+?     #followed by one of special characters line stops ok asterisk
  )+
  
  
  [\s\n\r\)\-]+?                  #final delimitation either by return or one or more space
  /sx';                
  
  preg_match_all($pattern,$text,$values);
  
  echo_array($values);
  //removes all single entries, ie we do not want John we want John Doe,
  //we presume the first name cannot provide much semantic information
  
  //echo_array($needle);
  for ($i=0;$i<count($values[0]);$i++){
   $text=str_replace($values[0][$i],'<b>'.$values[0][$i].'</b>',$text);
  }
  
//  echo markdown($text1);

  
  
  //First sieve to get names - almost there
  //echo_array(array_unique($names));
    
  echo 'text with bold names';
  
  
  echo markdown($text);
}
 
  
?>
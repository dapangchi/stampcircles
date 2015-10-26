
<?php
//This program finds the frequency of key-phrases in the text
 @set_time_limit ( 20*60 ) ; # Time limit 20min
include_once('utilities.php');
include_once('Snoopy.class.php');
include_once('markdown.php');

//$url="http://latenightengineer.com/play/text-analysis-with-PHP";
//$snoopy = new Snoopy;
//$snoopy->fetchtext($url);
//echoPRE($snoopy->results);

$text=file_get_contents('metamorphosis.txt');

//read text and place into array
//start at position 0
//read two words from array
// find in text
$time_start = microtime(true); //just timing the text

//clean text a bit

$pattern='/( ){2,}/';

$text=preg_replace($pattern,' ',$text);//replace one or more spaces
$text=file_get_contents('alice.txt');

$text=Markdown($text);

//echo $text;



statistics($text);

$words=explode(' ',$text);
//echo_array($words);

echo $limit=str_word_count($text);

  
$i=0;
for ($i=0;$i<$limit-3;$i++){
   //first create search array
   $search=$words[$i].' '.$words[$i+1];
   $search_array[]=$search;
 }
 
$search_array=array_unique($search_array);
//echo_array($search_array);
$limit=count($search_array);
echo 'Number of search terms : '.count($search_array);

//echo_array($search_array);


$z=0;
for ($z=0;$z<$limit+1;$z++){  
@$result=substr_count($text,$search_array[$z]);
if ($result>2) {//echoPRE($result).'<br />';
   $dictionary[]=$search_array[$z];
 }
}
//$dictionary=array_unique($dictionary);
//echo_array($dictionary);
//remove common words

frequency($text); //gets the frequency of words




function collocations($text){
  $words=explode(' ',$text);
  //find if word exist
  //if it does echo it plus neighbours from text not array!
  $needle='wonderland';
  $exists=in_array($needle,$words);
  if ($exists=1) 
  {
     echo 'exists  '.$exists;
     $needle="/[A-Z].*?\s$needle\s.*?\s.*?\s?[\.\?\!]/isx"; //more or less sentence
     preg_match_all($needle,$text,$values);
     echo_array($values);
  }
  
  $needle='wonderland';
  $exists=in_array($needle,$words);
  if ($exists=1)
  {
     echo 'exists  '.$exists;
     $needle="/[A-Z].*?\s$needle\s.*?\s.*?\s?[\.]/isx";
     preg_match_all($needle,$text,$values2);
     echo_array($values2);
     echo 'VALUES FOR COUNT :'.count($values2[0]);//counts correct
  }
    
  $i=0;
  echo 'VALUES FOR COUNT :'.count($values2);
  //for ($i=0;$i<30;$i++)
  {
     $values=array_merge($values[0],$values2[0]); 
     echo_array($values);
  }
  
  
  
  
  
}

collocations($text);


$time_end = microtime(true);
$time = $time_end - $time_start;

echo "Time $time seconds\n";
?>


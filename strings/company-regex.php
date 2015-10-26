<?php
include_once('utilities.php');
include_once('regex.php');
include_once('preprocessor.php');
include_once('markdown.php');
@set_time_limit ( 20*60 ) ; # Time limit 20min
 

echo 'Checking Text Against Database.....';

$text1=file_get_contents('../cache/Paul_W._Beck.htm');
//$text1.=file_get_contents('../cache/Norbert_Poehlke.htm');
//$text1.=file_get_contents('../cache/Paulos_Faraj_Rahho.htm');
//$text1.=file_get_contents('../cache/living-people-bios.htm');
//$text1.=file_get_contents('../cache/Aurelian.htm');
//$text1.=file_get_contents('../cache/Ashley_Hamilton.htm');
//$text1.=file_get_contents('../cache/Austin_Powers.htm');
//$text1.=file_get_contents('../cache/Aharon_Shekherdemian.htm');
//$text1.=file_get_contents('../cache/List_of_acanthodians.htm');
//$text1.=file_get_contents('../cache/Eben_William_Robertson.htm');
//$text1.=file_get_contents('../cache/Companies.htm');
//$text1.=file_get_contents('../cache/Forbes_Global_2000.htm');
//$text1.=file_get_contents('../cache/List_of_companies_in_Houston.htm');
//$text1.=file_get_contents('../cache/List_of_franchises.htm');
//$text1.=file_get_contents('../cache/List_of_management_consulting_firms.htm');
//$text1.=file_get_contents('../cache/List_of_Saudi_Arabian_companies.htm');
//$text1.=file_get_contents('../cache/List_of_UAE_companies.htm');
//$text1.=file_get_contents('../cache/athlete.htm');
//$text1.=file_get_contents('../cache/Zdeno_Štrba.htm');
//$text1.=file_get_contents('../cache/living-people-bios.htm');
//$text1.=file_get_contents('../cache/Adolf_Hitler.htm');
//$text1.=file_get_contents('../cache/Blais.htm');

//$url='http://www.askmen.com/galleries/kim-kardashian/picture-1.html';
//$text1=file_get_contents($url);

//$text1=file_get_contents('../cache/Joseph_Goebbels.htm');

//$text1=file_get_contents('../cache/spear.html');//Castros predecessor
//$text1.=file_get_contents('../cache/nicole-scherzinger.html');//Castros predecessor
//$text1.=file_get_contents('../cache/Alba.html');//Castros predecessor
//$text1.=file_get_contents('../cache/paul_newman.html');//Castros predecessor
//$text1.=file_get_contents('../cache/paul_newman.html');//Castros predecessor
//$text1.=file_get_contents('../cache/woody_allen.html');//Castros predecessor
//$text1.=file_get_contents('../cache/Woody-allen.html');//Castros predecessor
//echo 'Text retrieved ..... <br />';

//http://en.wikipedia.org/wiki/Jack_Kevorkian
//$text1=' Apsis Arthotel and 
//         Magic La Massana
 //        another name Wei Ching ';
 
 $text1=file_get_contents('../cache/List_of_Saudi_Arabian_companies.htm');
 


$text=$text1; 

//$text1=file_get_contents('http://en.wikipedia.org/wiki/Category:Italian_writers');

//calls main parser routine 
   $text1=regex_replace_spaces($text1);//removes duplicate spaces
   //$text1=_stripli($text1); //echo $text1;
   $text1=_striptext($text1); //echo $text1;
  
   $values=parse_names($text1);
  //echo count($values[0]);
  //break;
  $i=0;$j=0;
  for ($i=0;$i<count($values[0])+1;$i++){  //for all tokens in array
   $name=explode(' ',$values[0][$i]);
   //check and clean token if necessary from commas double and single quotes etc
   
   //end preprocessing .....
   
   echo_array($name);
    $length=count($name);  //length of name string now in array check all names
    $sum=0;
    for ($j=0;$j<$length;$j++){ //repeat for all tokens in string
     if (count($name[$j]>1) && ($name[$j]!='')){
         $name[$j]=strip_inverted_commas($name[$j]);//strips punctuation if in text
         //$stem = PorterStemmer::Stem($name[$j]); //needs to be incorporated
      //$name[$i]=regex_replace_spaces($name[$i]);//removes duplicate spaces
      $code=is_Proper_Name((trim($name[$j]))); //needs to remove spaces
      
      if ($code===-31) {
        echo '<br />In main routine '.$name[$j];} //dictionary or negative
        
      $sum=$sum+$code;
        // code = 0 Not found anywhere
        // code = 1 Found
        // code = 2 honorific
        // code = 2 in first name files
        // code = 3 in second or more surname files
        // code = 5 Dictionary code EN, EN based on country codes etc
        // code = 6 Matched based on soundex() or other similar technique
        // code = 7 Matched after spell check and levenstein
        echo ' code = '.$code.'<br />';
        
       }
    }
   //next token 
    echo 'code sum = '.$sum.'<br />';
    if ($sum>0 && count($name)>1){
      //document score ok
      $probable_names[]=implode(' ',$name).' '.$sum;
    }
    else
    {$improbable_names[]=implode(' ',$name).' '.$sum;
    }
  }
  //$probable_names=array_unique($probable_names);
  echo_array(array_unique($probable_names));
  $improbable_names=array_unique($improbable_names);
  echo_array($improbable_names);
  //is_Proper_Name($ProperName);
  
  $pattern="/($probable_names)/isx";
  preg_match_all($pattern,$text1,$values);
  $text=preg_replace($pattern,'<strong> $0 </strong>',$text1);
  //echo_array($values);
  echo $text;
  
  $sentences=explode('.',$text);
  echo_array($sentences);
  $i=0;
  for ($i=0;$i<count($sentences);$i++){
    $pattern="/($probable_names)/isx";
    $pattern='/(American|Bill[\s]?|Bill |Dr. Death|His |He |born |brother |sister |son |daughter|father|mother|prison|said|I am|contact me)/isx';
$found=preg_match_all($pattern,$sentences[$i],$values);
if ($found>0){echo "<p style=\"color:blue;\"> [sentence:  $i.]".'<span style="color:red;">'.$sentences[$i]."</span></p>";$bio[]='<p>'.$sentences[$i].'.</p>';}
  }
   echo markdown(implode($bio));


function parse_names(&$text){
//
$pattern='/
(
 (\(            #main pattern bracket
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
([[:upper:]][\.\s]?)+?    #starts with upper
                   
[[:alpha:]\'\-\.\&][[:alpha:]|’|\-\,]*   #allows for most Le Ni etc two characters
[\s|\.|\'|\)|\(|\‘]?
(\"|Ltd|Ltd\.|\(Pty\)|AG)?   #suffixes for companies
){2,}+/sx';

  preg_match_all($pattern,$text,$values);
  $text=preg_replace($pattern,'<strong> $0 </strong>',$text);
  echo_array($values);
  //echo markdown($text);
  return $values;
}

 
  
  

  
  
  //First sieve to get names - almost there
  //echo_array(array_unique($names));
    

  
  
  

//onomastic($text);
//Version to include Arabic Names


//Dictionary Check
//$success=is_In_Dictionary('commonzx','Dictionary.txt');
//if ($success)
//    { echo 'Found in dictionary ';
//     $is_in_dictionary=True;
//    }
//   else {
//     echo 'not in dictionary';
//    $is_in_dictionary=False;
//   }//not needed any more is_Proper_Name seems to perform


function is_Proper_Name($ProperName){
//Checks a file against common names
//names were obtained from US Census common names
//can add other language names here
//can do soundex also for mispelt names or slight variations
//needs to return something properly
//checks through files until found or just returns 

//must remove entry if in dictionary

echo "Checking for name: $ProperName  ";
 $file[]='CAT-companies.txt';$code[]=200; //high if Company marker
                                      
 //$file[]='honorific.txt';$code[]=30;
 $file[]='prepositions.txt';$code[]=30;
 $file[]='female-names.txt';$code[]=10;
 $file[]='dictionary.txt';$code[]=-31; //dictionary is high so not to let score go up
 $file[]='countries.txt';$code[]=-30; // for common words that are uncommon names
 $file[]='irish-surnames.txt';$code[]=30;
 $file[]='germanic-names.txt';$code[]=10;
 $file[]='hispanic-names.txt';$code[]=10;
 $file[]='afrikaans-names.txt';$code[]=10;
 $file[]='names-greek-first.txt';$code[]=30;
 $file[]='greek-surnames.txt';$code[]=35;
 $file[]='family-names';$code[]=30;
 $file[]='ukranian-first.txt';$code[]=30;
 $file[]='male-names.txt';$code[]=10;
 $file[]='AD.txt';$code[]=-20;             //Geographical names
 $file[]='NYSE.txt';$code[]=100;           //Company names from NYSE
 
 $needle=$ProperName;
 
 for ($i=0;$i<count($file)+1;$i++){ 
 $text=file_get_contents($file[$i]);
   find_token($needle,$text, $results);
    if (count($results[0])>0){
      echo '<em style="color:red"> Found token '.count($results[0]).'   '.$needle."</em> in $file[$i]";
       if ($file='Dictionary.txt') {$ProperName='AAAAAAA';
                                    echo 'Entry is in dictionary <br />';}
     return $code[$i]; //code for file
    }
    else 
    {
     echo '.';
    }
  }  
  echo  " token not found $ProperName";
  return $code=30;   
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
//TODo needs routine to reject things like WireImage 
?>


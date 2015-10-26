<?php
include_once('utilities.php');
include_once('regex.php');

  $example=array(0,1,2,3,4,5,6,7,8,9,10);
  echo count($example); //This will output 11
  
  
  

//array_diff
$array1 = array("green", "red", "blue", "red");
$array2 = array("green", "yellow", "red");
$result = array_diff($array1, $array2);

echo_array($array1);
echo_array($array2);
echo_array($result);


function get_family_names($file){
  //get family names from census file 
  //parses it into an array
  //Y Lazarides February 2008
  $text=file_get_contents($file);
  //$pattern='/([\s\n\r\t]+)  #parses one or more space or new line or tab
  ///isx';
  $text=regex_replace_spaces($text);
  $text=regex_delimit($text);
  //echo $text;
  $array_text=explode(',',$text);
  echo_array($array_text);
}

get_family_names('female-names.txt');
?>

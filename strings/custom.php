<?php
//here you can include custom functions
//you will need to instantiate a class
 

class custom{

public function __constructor($forms){
  
}

public function code($s){
//justs echos text - removes the type;
$s=preg_replace('/(type:html;|type:markdown)/isx','',$s);
$s=preg_replace('/\;\}*$/isx','',$s);
//$value=$options->getAttribute('value',$text);
if ($value=='file'){
     $text1=file_get_contents($value);
     $s=preg_replace('//sx',$text1,$text);}     
if ($debug){echo $s;}
//$options->html_text[]=$s;
 
 $s="<code>$s</code>";
 $options->custom->parseHTML($s);
 echo 'IN CODE  '.$s;
 return $s;
}


public function pre($s){
 $s="<pre>$s</pre>";
return $s;
}

}
?>

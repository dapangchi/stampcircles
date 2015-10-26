<?php
function codepre($s){
//justs echos text - removes the type;
$s=preg_replace('/(type:html;|type:markdown)/isx','',$s);
$s=preg_replace('/\;\}*$/isx','',$s);
//$value=$options->getAttribute('value',$text);
if ($value=='file'){
     $text1=file_get_contents($value);
     $s=preg_replace('//sx',$text1,$text);}     
if ($debug){echo $s;}
//$options->html_text[]=$s;
 $z=$options->parseHTML($s); 
 echo $z;
 return "<code>$s</code>";
}

function precode($s){
 $obj=new Forms907; 
 $z=$obj->parseHTML($s); 
 echo 'IN PRE 2'.$z;
 $s="<pre>$s</pre>";
return $s;
}


?>

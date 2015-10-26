<?php
include_once('utilities.php');
include_once('preprocessor.php');
include_once('markdown.php');

$text=file_get_contents('../cache/numbers.html');

$pattern="<a>(edit)<\/a>";
preg_match_all('/'.'(<a[^>](.*)[>](edit\s*)<\s*\/(a)\s*>)'.'/',$text,$values);
echo_array($values);





$text=preg_replace('/'.'(<a[^>](.*)[>](edit\s*)<\s*\/(a)\s*>)'.'/isx','<span style="color:red">EDIT</span>',($text));



//$t=preg_match($pattern,$text,$values);

echo ($text);





?>
<?php 
include_once('utilities.php');
$xml = simplexml_load_file('http://feeds.feedburner.com/metacafe/TYps');
print "<ul>\n";
foreach ($xml->channel->item as $item){
  echo "<li><a href=".$item->link.">".$item->title."</a></li>\n";
  print "<li>$item->description</li>\n";
 //  print "<li>$item->link</li>\n";
}
print "</ul>";

foreach ($xml->channel as $value){
    echo_array($value);
}
?>









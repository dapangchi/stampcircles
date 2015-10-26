<?php
////


 $ch = curl_init("http://rss.news.yahoo.com/rss/oddlyenough");
 $fp = fopen("../cache/sampl_htmlpage.html", "w"); //opens file gets it ready to write to
    curl_setopt($ch, CURLOPT_FILE, $fp);  //saves to file
    curl_setopt($ch, CURLOPT_HEADER, 0);  // sets option not to output header information
    curl_exec($ch);                       //executes cURL command
    curl_close($ch);                      //closes file
 fclose($fp);
$text=file_get_contents('../cache/sampl_htmlpage.html');
echo $text;

?> 
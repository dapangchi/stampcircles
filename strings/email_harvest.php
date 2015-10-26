<?php
/*  Function to harvest emails from pages
*   Gets the contents through a file_get_contents
*   or you can use cURL 
*
*   Example

   $content=file_get_contents('http://latenightengineer.com');

   $emails=uniqueEmails($content);
    if (!empty($emails)){ 
		 echo '<pre>';
		   print_r($emails);
     echo '</pre>';}else{
     echo 'No email addresses found!';
     
     }
*/


function uniqueEmails($content)
{
	 $needle='mailto:';
   $content=preg_replace('/'.$needle.'/','',$content);//get rid of mailto!
   $pattern = "/\w+?([^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4})[\s\n\r]?/";
   preg_match_all($pattern,$content,$arrEmails);
   #change array to unique emails
   $arrEmails=array_unique($arrEmails[0]);
   return $arrEmails[0];	
}
?>

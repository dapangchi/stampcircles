// example on building an HTML document from the DOM representation using the saveHTMLFile()' method

<?php
$dom=new DOMDocument('1.0');

// format output

$dom->formatOutput=true;

// create <html> element

$root=$dom->createElement('html');

$root=$dom->appendChild($root);

// create <head> element

$head=$dom->createElement('head');

$head=$root->appendChild($head);

// create <title> element

$title=$dom->createElement('title');

$title=$head->appendChild($title);

// create text for title of HTML page

$text=$dom->createTextNode('This title was created with the DOM XML extension of PHP');

$text=$title->appendChild($text);

// save HTML to file

$body=$dom->createElement('body');

$root=$dom->addNode($body);



echo 'The file just created has a size of '. $dom->saveHTMLFile('test_file.htm'). ' bytes.';


/* displays the following

The file just created has a size of 168 bytes

*/
 $text=file_get_contents('test_file.htm');
echo $text;
?>
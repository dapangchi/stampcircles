<?php

$doc = new DomDocument;

// We need to validate our document before refering to the id
$doc->validateOnParse = true;
//$doc->Load('../egypt/cuil.html/');

DOMDocument::loadHTMLFile  ( 'http://localhost/egypt/cuil.html/');
echo "The element whose id is books is: " . $doc->getElementById('books')->tagName . "\n";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>This is a sample HTML file</title>

</head>

<body>

<h2>Starting with the DOM and PHP</h2>

<p>PHP has build in routines for handling the DOM. Before we proceed with it let us first look at a
technique for typing in long test called heterox mark-up.</p>

<?php

$z=108;
$myhtml = <<<EOF
   <h2 style="test" id="one">This is an h2 element</h2>
   <p><a href="/mypage1">Hello World!$z</a></p>
   <h2>This is an h2 element</h2>
   <p><a href="/mypage2">Another Hello World!</a></p>
   <form name="myform" id="myform" >
   <input type="text" name="input-one" />test<br />
   
   <input type="text" name="input-two" />test2<br />
   </form>
   <p>A test</p>
EOF;
echo $myhtml;
$doc2 = new DOMDocument('1.0', 'iso-8859-1');
//$doc2->loadHTML($myhtml);


$tags = $doc2->getElementsByTagName('form');
$element = $doc2->createElement('p', 'This is the root element!');
$doc2->appendChild($element);

foreach ($tags as $tag) {
  echo $tag->getAttribute('name');
  echo $tag->nodeValue."\n";
}
//$dom = new DOMDocument('1.0', 'iso-8859-1');
$doc2->validateOnParse = true;

$myfrm=$doc2->getElementById('one')->tagName;
       $doc2->getElementById('h2')->tagName . "\n";
echo 'GET ELEMENT BY ID ';
print_r($myfrm);

//$element = $doc2->$myform->appendChild(new DOMElement('p'));
//$comment = $element->appendChild(new DOMElement('span','Test '));
//$text = $comment->appendChild(new DOMText('root value'));
//echo $doc2->saveXML(); /* 

?>

</html>
</body>
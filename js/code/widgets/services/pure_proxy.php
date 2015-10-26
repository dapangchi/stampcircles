<?php
// To prevent this from being a security hazard (and because this is
// just a demo), limit the URLs that can be served

$urlToServe = $_GET["url"];
if (preg_match('/^entomology.unl.edu/',$urlToServe) ||
    preg_match('/^animals.nationalgeographic.com/',$urlToServe) ||
    preg_match('/^www.hermitcrabassociation.com/',$urlToServe)) {  

    // This proxy service doesn't do query strings, but it works 
    // for static stuff
    readfile("http://" . $_GET["url"]);
} else {
?>
  Access denied 
<? } ?>

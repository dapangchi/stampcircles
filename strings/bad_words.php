<?php

//=======================================

	Code by Kailash Nadh
	http://kailashnadh.name


	Feb 15 2005

//=======================================


	filter_bad_words()
	This function can take a string, replace all badwords (user defined)
	with * . i.e, replaces BAD with *** and FOOBAR with ******

	Usage :
		filter_bad_words(STRING, BAD_WORDS_ARRAY);

	eg:
		$str="Imagine ABC and BADWORD as two bad words";
		$bad=array("ABC","CBA","BADWORD");

		echo filter_bad_words($str, $bad);

		This will print - " Imagine *** and ******* as two bad words "


//=======================================


function filter_bad_words($str, $bad) {
	if(!$str || !$bad) return 0;	// Check whether both arguments are OK

	if(!count($bad)) { return $str; }	// Return the string as it is if no bad words

	// Go through each bad word
	for($n=0;$n<=count($bad)-1;$n++) {
		$symbol="";
			for($k=0;$k<=strlen(trim($bad[$n]))-1;$k++) {
				$symbol.="*";	// Generate the stars equal to the number of chars in the bad word
			}
		if(!empty($bad[$n])) { $str = eregi_replace(trim($bad[$n]),$symbol,$str); }	// Check whether there's a bad word
	}

	return $str;
}

?>
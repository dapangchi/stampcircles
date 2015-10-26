<?php
include_once('utilities.php');
include_once('regex.php');
include_once('markdown.php');
include_once('email_harvest.php');

$text="

<h2>ABBREVIATIONS AND ACRONYMS - THEIR IMPORTANCE IN TEXT ANALYSIS</h2>

before one can start doing task-specific text processing analysis there is an annoying phase of text clreaning and normalization.

As a minimum the documents shuld be segemented into zones, such as paragrpahs, tables, titles, etc. and then the free-running text on these zones should be segmented into sentences. 

Sentence is considered as a central processing unitin the majority of NLP task: POS tagging, parsing, Information Extraction, Machine Translation, Text Alignment, document Summarization, etc.

The task of sentence boundary detection is closely linked to disambiguation of when a period ends a sentence or is part of abbreviations.

Abbreviations normally follow one of the following patterns:

 *  They start from a capital letter and are followed by stops ( A.S.M.E. or I.S.O. ).
 *  They can be any of latin terms commonly found in English such as (et.al., etc.). These can be capitalized such as A.D. or composed of lower case letters or combinations, such as:
  * B.Sc.
  * Ph.D.
  
 *  They can also be normal English words just shortened such as:
  * Fig.2
  * eq.1
  * ex.12   
 
Acronyms are very different in that they are not normally written with stops.

 * ASME
 * ACIS
 * CD-ROM 
 * HTML
 
One of the problems of 1234 Acronyms is that they can be confused with capitalized words. For example JULIUS can refer to an Acronym or to the name Julius. Therefore for acronyms it is important to actually have a disambiguation strategy.

Sentence Boundary Disambiguation

Segmenting text into sentences in most cases is a simple matter - period, exclamation mark and a question mark ususally signal a sentenece boundary. (see Andrei Mikheev, Periods Capitalized Words, etc.).

<h3>Example 1</h3>

 * John Smith lives in New York. This is a fact.

However, there are cases when a period denotes a decimal point or is part of an abbreviation and thus it does not signal a sentence break. To make matters worse an abbreviation can be as the end-of-sentence indicator (fullstop). Consider a narrative:

<h3>Example 2</h3>

 * John Mackenzie Jr. lives in Dallas, Tex. This is a fact.
 
 In the text above there are three periods but only the last period is a full-stop, with Jr. and Tex., being abbreviations.
 
Disambiguation is not only necessary for periods, but sometimes for exclamation marks and the like.

<h3>Example 3</h3>

The 'Mighty Google!' is buying everyone! 


In this tool development we will attempt to set some rules for harvesting
abbreviations from the web. First we will examine some obvious rules.
   Abbreviations, normally consist of letters starting from a capital letter  e.g.  and 
   A.I for Artificial Intelligence, A.D. for Anno Domini etc. 

NORMAL ABBREVIATIONS 

Based  on  these  conditions,  A.I. Artificial Intelligence  Baracuda  (Boldly  Advanced  and
Refined  Aircraft  Concept  Under  Development
for  AGATE Agate defined as Agapy SgRP    (seating  reference  point),
2MASS  (Two-Micron  All  Sky  Survey), ACIS
(Advanced CCD Imaging Spectrometer W3C World Wide Web Consortium,  TCF
(Trim/Chassis/Final) are recognized as U.S. candidate
abbreviations. R&D is another common one, SN1987A and finally a version number V3.5 and Cal.Rptr.  	 California Reporter CD-ROM is the compact disk-read only memory
CAMEX-3  Third Convection and Moisture Experiment 
 S.V. — Sanctitas Vestra, Sancta Virgo.
 TT. — Testamentum.
 U.F. — Felicissimus, Fratres, Pandectae (prob. for Gr. II).
 V. — Venerabilis, Venerandus.
 V.G. - Verbi gratia
 V.R.P. Vestra Reverendissima Paternitas
 A.D. Anno Domini
 A.M. Ave Maria.
 B.P. Beatus Paulus, Beatus Petrus
The American Society of Mechanical Engineers A.S.M.E is a professional body, specifically an engineering society, focused on mechanical engineering. The ASME was founded in 1880 by Alexander Lyman Holley, Henry Rossiter Worthington, John Edison Sweet and Matthias N. Forney in response to numerous steam boiler pressure vessel failures. The organization is known for setting codes and standards for mechanical devices. The ASME conducts one of the world's largest technical publishing operations through its ASME Press, holds numerous technical conferences and hundreds of professional development courses each year, and sponsors numerous outreach and educational programs.
IBM is the official abbreviation for International Business Machines
Acronyms are often referred to with only the first letter of the abbreviation capitalised. For instance, the North Atlantic Treaty Organisation can be abbreviated as 'Nato' or NATO .The International System of Units   (SI) defines a set of base units, from which other derived units may be obtained.

TLC (The Learning Channel) is a cable TV network in the US and Canada, that carries a variety of informational and reality-based programming. TLC has been owned by Discovery Communications since 1991, the same company that operates the Discovery Channel , Animal Planet and The Science Channel, as well as other learning-themed networks. This. 
 

The final check is to search the web and use Google to return results with common abbreviations, the more results the better the vote of confidence that the numbers are there.

One problem with regex is to distinguish between a capitalized header JULIUS CAESAR and acronyms. Although the two terms are not indentical I will treat them as the same for this discussion.

The Routines.

Get_latin_abbreviations   -> finds latin abbreviations (lower case)
get_abbreviations
highlight_abbreviations   -> echoes original text
discover_abbreviations    -> tries to find the meaning


 She\'s been living with Cpl. Laurean being on the run ... and living without an expectation that he was going to be captured any time soon, so when the word came it really caught her by surprise, and she's still trying to let it all sink in, Wilberding told WDTN-TV in Dayton, Ohio.

1234 

1234.67

It is 3 a.m. is time to sleep.

";

$text.='We want to improve access to our journal, and we’re happy to have it freely available and accessible. Like all scientific journals, we realize the importance of citation rankings, and more accessible content will only improve ours (right?). Our diverse audience includes policymakers, producers, and other educated readers who might not have access to subscription-based databases and who might choose Google (Scholar) more often than not. (Although Ellen Melzer’s report on the habits of UC students suggests that university users may be just as likely to select Google, even when other services are available.) We also appreciate the historical value of our journal—historians of agriculture, nutrition, and science might troll our archives—and anticipate the value of Google Scholar as a search tool that knows no disciplinary boundaries.

JMP Genomics for High-Throughput Genomics

We’ve had several customers who have been surprised that JMP Genomics can handle high-throughput data generated on non-array platforms. These customers and others are glad to hear that JMP Genomics can also handle TaqMan data, processed NextGen sequencing data, and data generated on custom array platforms or other commercial platforms (e.g., Agilent, Phalanx Biotech). You can usually import these data sets easily into JMP Genomics for processing and analysis, using many of the same tools as for expression or genotyping analysis.

You may have noticed increasing support for Affymetrix formats (CEL and CHP for expression and SNP, CNCHP, ARRs, and download from NetAffx) and Illumina Bead Studio outputs (Expression, SNP, Copy Number) in JMP Genomics over the past few releases. The flexible text import processes we also include allow import of your text files (even very wide text files) into JMP Genomics as single files or multiple files to be compiled into one large data file. Perhaps this is a point we need to make more strongly to customers and prospects. We can handle more than just your array data! Check it out and you will be pleasantly surprised what you can do.



';
$time_start = microtime(true);
//$text.=file_get_contents('../ABR/c.txt');
//$text.=file_get_contents('../ABR/latin.txt');
//$text.=file_get_contents('../ABR/b.txt');

//Load corpus
//directory
//meta data
//categorized corpora
//fiction
//non-fiction etc
//spidering
//text statistics
//text clean-up
/*$text.=file_get_contents('caesar.txt');
$text.=file_get_contents('alice.txt');
$text.=file_get_contents('War_and_Peace.txt');*/
//$text.=file_get_contents('1911.txt');


//$text.=file_get_contents('benjamin.txt');

//$text.=file_get_contents('science2.txt');
//$text.=file_get_contents('science_volI.txt');
/*$text.=file_get_contents('science_volII.txt');
$text.=file_get_contents('science_volIII.txt');
$text.=file_get_contents('science_volIV.txt');
$text.=file_get_contents('chemistry.txt');
$text.=file_get_contents('fingerprints.txt');
$text.=file_get_contents('st_augustine.txt');
$text.=file_get_contents('bernard_shaw.txt');
$text.=file_get_contents('benjamin.txt');
$text.=file_get_contents('pick-up.txt');
$text.=file_get_contents('../corpora/blztr10.txt');
$text.=file_get_contents('../corpora/koran12a.txt');
$text.=file_get_contents('../corpora/cca0610.txt');
$text.=file_get_contents('../corpora/parker4.txt');
$text.=file_get_contents('../corpora/1lotj10.txt');//legends of the Jews
$text.=file_get_contents('../corpora/2lotj10.txt');//legends of the Jews
$text.=file_get_contents('../corpora/4lotj10.txt');/legends of the Jews
$text.=file_get_contents('../corpora/17921-8.txt');//Manual of surgery needs clean-up
$text.=file_get_contents('../corpora/christmas.txt');///Christmas traditions
$text.=file_get_contents('../corpora/10940-8.txt');//Middle Ages Customs
$text.=file_get_contents('../corpora/gaston.txt');//History of Egypt
*/
$text.=file_get_contents('science_volI.txt');



$time_end = microtime(true);
$time = $time_end - $time_start;
echo 'Time to Initialize Corpus'.$time.'<br />';
//$text.=file_get_contents('../cache/world95.txt');
//Rule one finds all capitalized letter words
//This can include . or numbers
/*An abbreviation  pattern  is  a  string  of  ‘c’  and  ‘n’
characters.   An  alphabetic  character  is  replaced
with a ‘c’ and a sequence of numeric characters
(including  ‘.’  and  ‘,’)  is  replaced  with  an  ‘n’
regardless  of  its  length.  Non-alphanumeric
characters such as hyphen, slash, and ampersand
are not reflected in abbreviation patterns.  Some
examples  of  candidate  abbreviations  and  their
patterns are in Table 1.*/


//$vocab=vocabulary($text);echo_array($vocab);
//$text=remove_stop_words($values,$text,'#cccccc');echo $text;
//$vocab=vocabulary($text);echo_array($vocab);

//get_sentence_boundary($text);
//break;

//highlight_stop_words($values,$text,$color);
$text1=$text;
$values=get_capitalized_words($text1);
echo_array($values);
$text1=highlight_abbreviations($values,$text1,'green');
$dotted=get_abbreviations($text1);
echo_array($dotted);
$text1=highlight_abbreviations($dotted[0],$text1,'blue');
echo $text1;
echo_array($values);
$values=get_latin_abbreviations($text1);
echo_array($values);
$text=highlight_abbreviations($values,$text1,'red');
echo markdown($text);break;
left_right_tokens($text,'great');
//nearest_neighbours($text,'Benjamin Franklin');

break;
$numbers=is_number($text);
echo_array($numbers);
//$text=remove_stop_words($text);
$text=regex_replace_spaces($text);
statistics($text);
//$voc=vocabulary($text);echo 'vocabulary ->'.count($voc);
//echo_array($voc);

$stop_words=stop_words_array();
$v[]='The';
$v[]='this';
$v[]='the';
$v[]='Yannis';
$v[]='Lazar';
$v[]='Johnny';
$v[]='whom';
$v[]='which';
    
echo_array($v);
$vo[]='The';
$vo[]='thisi';
$vo[]='the';
$vo[]='Yannis';
$vo[]='whom';
$vo[]='which';
$vo[]='Costa';
//echo_array($vo);
//$result=array_diff($voc,$stop_words);
//echo 'INTERSECTION<br />';
//echo_array($result);
//$values=find_token('Project',$text);echo_array($values);
//$values=find_token('Gutenberg',$text);echo_array($values);
$time_start = microtime(true);

//left_right_tokens($text,'Epiphany');
$time_end = microtime(true);
$time = $time_end - $time_start;
echo $time.'seconds';
$time_start = microtime(true);
//nearest_neighbours($text,'Orthodox Church');
$time_end = microtime(true);
$time = $time_end - $time_start;
//$text1=highlight_dictionary_words($numbers,$text,'purple');echo $text1;
//$values=get_sentence_boundary($text);
//$text1=highlight_abbreviations($values,$text,'yellow');
//echo $text;
//break;
$text1=$text;
$values=get_capitalized_words($text1);
echo_array($values);
$text1=highlight_abbreviations($values,$text1,'green');
$dotted=get_abbreviations($text1);
echo_array($dotted);
$text1=highlight_abbreviations($dotted[0],$text1,'blue');
echo $text1;
echo_array($values);
$values=get_latin_abbreviations($text1);
echo_array($values);
$text=highlight_abbreviations($values,$text1,'red');
echo markdown($text);

//next we do sentence matching. Rules here are difficult. First we need to replace the dots
//in abbreviations so that we do not end up with too many problems
//$pattern='/\s([A-Z\.\d\/\&][a-zA-Z\.\d\/\&][A-Z\.\d\/\&]+?[\s\n\r])/';
//$t = preg_replace( $pattern,' ABBR ', $text);
//echo($t);

//search around the abbreviation
$needle=$values[0][14];
echo $needle;
//$pattern="/[\s\,]?.*?".$needle."[\s?\n\r\-]*?[a-zA-Z]*?[\s\n\r]+?[a-zA-Z]*?[\s\n\r\,\.]*?[a-zA-Z]*?[\s\n\r\,\.]+?\w*?[\s\n\r\,\.]/x";  
//preg_match_all($pattern,$text,$values);
//echo_array($values);

$position=strpos($text,$needle);echo $position;
$text=str_split($text);

//gets text around abbreviation
//need some math magic here
$start=$position-50;
if ($position-50<0) {$start=0;
}

echo '<br />...';

for ($i=$start;$i<$position+50;$i++){
  $s=$text[$i];echo $s;
}

//split before and after
$z=explode(' ',$s);
echo_array($z);
//checks for capitalized words

/*

FUNCTIONS 

*/

function get_abbreviations($text){
//This function gets possible abbreviations from the text and returns
//them as an array
$pattern='/[\s\n\r\(](  #starts with boundary
[A-Z\d\/\&][\.])+                               
[\s\n\r\)\(]/sx';
preg_match_all($pattern,$text,$values);
//$values=array_unique($values);
echo_array($values[0]);
return $values;
}




function highlight_abbreviations($values,$newtext,$color){
//$values=array_unique($values);
echo 'IN HIGHLIGHT<br />';
echo_array($values);
for ($i=0;$i<count($values);$i++){
  $pattern=preg_quote($values[$i]);
  echo $values[$i].'<br />';
  $newtext=preg_replace('%'.$pattern.'%',"<b style=\"color:$color \">"."$0</b>",$newtext);
}
echo $newtext;
return $newtext;
}

function highlight_word($value,$text,$color){
// highlights a word or phrase in html mark-up

$pattern=preg_quote($value);
$newtext=preg_replace('%\b'.$pattern.'\b%',"<b style=\"color:$color \">"."$0</b>",$text);
return $newtext;
}


function stop_words_array(){
$text=file_get_contents('stop-words.txt');
$pattern='/\n/sx';
$values=preg_split($pattern,$text);
echo_array($values);
return $values;
}

function highlight_stop_words($values,$newtext,$color){
//$values=array_unique($values);
$text=file_get_contents('stop-words.txt');
$pattern='/\n/sx';
$values=preg_split($pattern,$text);
echo_array($values);
//echo_array($values);break;
//echo 'IN HIGHLIGHT<br />';
//echo_array($values);
for ($i=0;$i<count($values);$i++){                   //
  $pattern=trim($values[$i]);
  $newtext=preg_replace('%\b'.$pattern.'\b%is',"<b style=\"color:$color \">"."$0 </b>",$newtext);
}
echo $newtext;
return $newtext;
}

function highlight_dictionary_words($values,$newtext,$color){
//$values=array_unique($values);
$text=file_get_contents('dictionary.txt');
$pattern='/\n/sx';
$values=preg_split($pattern,$text);
echo_array($values);
//echo_array($values);break;
//echo 'IN HIGHLIGHT<br />';
//echo_array($values);
for ($i=0;$i<count($values);$i++){                   //count($values)
  $pattern=trim($values[$i]);
  $newtext=preg_replace('%\b'.$pattern.'\b%is',"<span style=\"color:$color \">"."$0 </span>",$newtext);
}
echo $newtext;
return $newtext;
}



function remove_stop_words($newtext){
//$values=array_unique($values);
$text=file_get_contents('stop-words.txt');
$pattern='/\n/sx';
$values=preg_split($pattern,$text);
//echo_array($values);
//echo_array($values);break;
//echo 'IN HIGHLIGHT<br />';
//echo_array($values);
for ($i=0;$i<count($values);$i++){                   //
  $pattern=trim($values[$i]);
  $newtext=preg_replace('%\b'.$pattern.'\b%is','',$newtext);
}
//echo $newtext;
return $newtext;
}





function get_latin_abbreviations($text){
 #This function gets possible abbreviations from the text and returns
 #them as an array. I deals with lower case abbreviations
 #capitalized latin abbreviations are dealt with another function
 #get all words that are 'word. Is' this
 #replace with space before stop
 #If the text contains errors such as 'word. text' it will be picked as
 #an abbreviation

$pattern='/([[:lower:]]+[\.])   #starts with lower letter
           ([\s]|[\n\r\t])*     #alice.) This
           [\[\]\"\'\_\d\*\`\-\)\(\'\`\s]*
           [[:upper:]\[\]\"\'\_\d\*\`\-\.\<\>]/sx';

//preg_match_all($pattern,$text,$values);
$text=preg_replace($pattern,'[SENTENCE\]',$text);
//pattern to match all possible lower case abbreviations. In most cases these
$pattern='/(\b([[:lower:]]+[\.])+)[\s\(\)\,]/sx';
preg_match_all($pattern,$text,$values);
//$values=array_unique($values);
echo_array($values[1]);
return $values[1];
}

function get_capitalized_words($text){
//gets all capitalized words in headers etc
//this is a preliminary step to try and reduce the load on the abbreviator
//who gets hints about abbreviations from capitalization
//The first pass considers capitalized words ending with spaces
//return and the like to avoid numerals such II I and short words such as
//A PROGRAM TO CAPTURE THEM
//I is treated as a special case
$pattern='/\b([[:upper:]-\&\d]{3,})[\s\(\)\,\.]/sx';
preg_match_all($pattern,$text,$upper);
//$values=array_unique($values);
echo_array($upper);
return $upper[1];
}



//period-space-capital-letter
function get_sentence_boundary($text){
$pattern='/([\.\!\?][\s\(\)\"\'\[\]]+[A-Z])/sx'; //period-space-capital C. Brown will be an error
preg_match_all($pattern,$text,$sentence_boundary);
//$values=array_unique($values);
echo_array($sentence_boundary);
return $sentence_boundary[1];
}

function nearest_neighbours($text,$bigram){
//similarity
$pattern="/\b[[:alpha:]]+\s*$bigram\s*[[:alpha:]]+\b/is";
preg_match_all($pattern,$text,$values);
echo_array($values);
$z=split(' ',$bigram);echo_array($z);
$w1=trim($z[0]);
$w2=trim($z[1].'\s+'.$z[2]);//strconcat($z[1]+' '+$z[2]);*/
echo 'w2'.$w2;
$pattern="/\b$w1\s+$w2/isx";
preg_match_all($pattern,$text,$values);
$ngrams=count($values[0]);
//$values=array_unique($values);
//counts the number of words from statistics
$w1_count=find_token($w1,$text);echo_array($w1_count);
$w2_count=find_token($w2,$text);echo_array($w2_count);
echo_array($values);
$w1_count=count($w1_count[0]);
$w2_count=count($w2_count[0]);

$w=count_words($text);
echo 'number pairs'.$ngrams.'<br />';
$PMI=log(($ngrams/$w)/(((abs($ngrams-$w1_count)+0.00000000001)/$w)*((abs($ngrams-$w2_count)+0.00000000001)/$w)),2);echo $PMI;
return $values;

//add left words
// add right words
//error handling
}

function left_right_tokens($text,$w){
$n1=45;$n2=35;
$pattern="/[\s\n\r\.]*(([[:alpha:]\'s\,\"\'\!\;\?]+\s){0,$n1})\b$w\s(([[:alpha:]\'s\,\"\'\!\;\?\n\r]+\s*){0,$n2})[\n\r\.]*/is";
preg_match_all($pattern,$text,$values);
$w_count=count($values[0]);
$s='<table>';
for ($i=0;$i<count($values[0]);$i++){
   $s.='<tr>';
   $s.='<td>['.($i+1).']</td>'.'<td style="text-align:right;padding:2px;vertical-align:top">'.$values[1][$i].'</td><td style="color:red;vertical-align:top">'.$w.'</td><td>'.$values[3][$i].'</td>';
   $s.='</tr>';
 }
   $s.='</table>';
   //join $s rather than individual echoes speeds up
   echo $s;
//echo_array($values);
}

?>







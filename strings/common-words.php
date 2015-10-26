<p>There is an interesting book by Geoffrey Leech et.al, in which they provide word frequencies
for the written and spoken English. These are based on the British National Corpus. They have a companion
website which they provide a number of extracts from the book. One such extract is the occurence of days in the week.
I reproduce it here for convenience. The frequency of name days is interesting in that it points out to a well \known human fact,
that the most interesting part of life happen during saturday and Sunday and maybe Friday for Moslem countries.</p>

<p>I thought I will make an experiment, download some blogs and see if the same applies to the web.</p>  




<?php
//script to add superscripts to a text where the reference is denoted as [dd]


$text='In Jewish and Christian tradition, the first day of the seven day week is Sunday. Most business and social calendars in English speaking countries mark Sunday as the first day of the week. In English the days of the week are Sunday, Monday, Tuesday, Wednesday, Thursday, Friday and Saturday.
In most of Europe, and some other countries, monday is considered to be the first day of the week and is literally named as such in languages such as Mandarin (Xingqí Yi, literally means Weekday One) and Lithuanian (pirmadienis). The ISO prescribes Monday as the first day of the week with ISO-8601 for software date formats..';

//$text=htmlentities(file_get_contents('http://blogs.guardian.co.uk/books/2007/10/memories_across_the_mersey.html'));
$text=file_get_contents('benjamin.txt');

$pattern='/(\sParis[\.\,\:\?\!]?\s)/i';//one or more digits within square brackets
preg_match_all($pattern,$text,$values);
$newStr= preg_replace($pattern, '<b style="color:#dd0000">$1</b>', $text);
$numberwords=str_word_count($text);
echo '<p style="width:80%">';
echo $newStr;
echo 'The total number of words is: '.$numberwords;
echo '</p>';
echo '<pre>';
//$values=asort($values);
print_r($values[0]);echo 'Total terms:'.count($values[0]).'<br />';
$weekdays=count($values[0]);
$frequency=($weekdays/$numberwords)*100;
echo 'Frequency of weekdays   % : '.$frequency.' %';
echo 'Frequency of weekdays  Words/million  :'.$frequency*10000;
echo '</pre>';

?>


Geoffrey Leech, Paul Rayson, Andrew Wilson, Word Frequencies in Written and Spoken English: based on the British National Corpus.
(2001) pp. 320, Longman, London. ISBN 0582-32007-0 (Paperback)

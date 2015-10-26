<?php 
/**********************************************************************
   Anti-spam Filter - Version 2.0
	 Updated: June 23, 2008
	 Author: Dr. Peter J. Meyers, User Effect (www.usereffect.com)
	 
	 Program is set up to be used as an include and assumes that
	 $comment will contain the text to be filtered. Output variables
	 include $spam_action and $spam_report.
	 
**********************************************************************/
include('utilities.php');

$comment='	Dr Pete - This is a very useful contribution to the comment spam fighting community :-) Thanks a lot.

It would be interesting to measure your scripts/techniques against askimet. Have you thought/researched about incorporating Bayesian filtering?

Cheers
I\'ve used my own home-grown anti-spam lib, which has a lot of the similar items you mentioned.

(I haven\'t looked at the code yet), but in my lib, I have a list of keywords that if found in comments set off alarms. I\'ve spaced them out in case they trigger your anti-spam filters ;-)

Adult: You\'re far too kind. I am a bit obsessive about my coding and am proud of the simplicity of it, but I\'m not going to rush out to try to commercialize this just yet. It\'s more of a personal 

Its been my experience that the spam contains 2 things. One is a link to spammers lair, the other is \"sales jive\" to lure people in viagra and viagra

That all said, I like the 24hour nofollow idea. I slapped nofollow on everything as a blanket measure, but I like your approach better! very clever cheap.viagra,viagra, viagra viagra

{some code}
';

echo $comment;
//$comment.=file_get_contents('benjamin.txt');

// Set Initial Variables
$spam_text = strtolower($comment);
$spam_score = 0;
$spam_action = 0; // 0=Accept, 1=Review, 2=Reject

// Set Thresholds & Weights
$spam_low = 5;
$spam_high = 10;
$trigger_word_list = "viagra, remove, cheap, buy";
$trigger_word_weight = 2;
$link_weight_http = 5;
$link_weight_url = 10;
$text_density_limit = 70;
$text_density_weight = 10;
$vowel_density_limit = 15;
$vowel_density_weight = 5;

// Check for Trigger Words
$word_count = 0;
$word_array = explode(",", $trigger_word_list);
$word_array_len = count($word_array)-1;
for($i=0; $i<=$word_array_len; $i++)
	$word_count += substr_count($spam_text, $word_array[$i]);
$spam_score += ($word_count * $trigger_word_weight);
		
// Check Link Count
$link_count_http = substr_count($spam_text, "http:");
$link_count_url = substr_count($spam_text, "url=");
$spam_score += ($link_count_http * $link_weight_http);
$spam_score += ($link_count_url * $link_weight_url);

// Check Text Density
$text_no_html = strip_tags($spam_text);
$text_density = round((strlen($text_no_html)/strlen($spam_text)*100), 1);
if($text_density < $text_density_limit)
	$spam_score += $text_density_weight;

// Check Vowel Density
$vowel_count = substr_count($text_no_html, "a");
$vowel_count += substr_count($text_no_html, "e");
$vowel_count += substr_count($text_no_html, "i");
$vowel_count += substr_count($text_no_html, "o");
$vowel_count += substr_count($text_no_html, "u");
$vowel_density = round(($vowel_count/strlen($text_no_html)*100), 1);
if($vowel_density < $vowel_density_limit)
	$spam_score += $vowel_density_weight;

// Create Spam Report
$spam_report = "SPAM REPORT:\n";
$spam_report .= "Trigger Words: $word_count\n";
$spam_report .= "Link Count (http): $link_count_http\n";
$spam_report .= "Link Count (url=): $link_count_url\n";
$spam_report .= "Text Density: $text_density%\n";
$spam_report .= "Vowel Density: $vowel_density%\n";
$spam_report .= "------------------------------\n";
$spam_report .= "Spam Score: $spam_score";

if($spam_score >= $spam_high)
	$spam_action = 2;
elseif($spam_score >= $spam_low)
	$spam_action = 1;
echoPRE($spam_report);
echo '<br> SPAM SCORE: '.$spam_score.'</br>';
echo '<br> SPAM ACTION: '.$spam_action.'</br>';



?>
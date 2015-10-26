<?php

include_once('utilities.php');
//script to add superscripts to a text where the reference is denoted as [dd]



$text='In traditional information retrieval techniques single words are
used as terms. This method is called \'set\' or \'bag-of-words\' and it
is widely used in document categorization research studies [6] and
applications. Some examples can be found in [ 17, 25, 14, and 5].
According to this approach, vocabulary is constructed from either
all or N most important (having the highest weight) words that
appear in training set documents. Though this simple
representation provides relatively good classification [17] results in
terms of accuracy, its limitations are obvious. This popular
method of document representation does not capture important
structural information, such as the order and proximity of term
occurrence or the location of a term within the document.[301]';

$text='People do not use the same words to describe the same concept and to make search more effective automatic word associations can be of great help [10]. There are the language dependent methods like word stemming and thesaurus, and relevance feedback which is not language dependent. 
Word stemming is based on two stages; suffix stripping and conflation. Suffix stripping can be achieved by using series of rules, which induce some errors, as there are always some exceptions from the rules. The error rate of word stemming has been measured around 5% [11]. The problem with stemming is that it is language dependent. The use of $N$-gram counts to replace stemming has also be examined [12,13]. $N$-gram count means that a fixed numbers of letters are counted instead of whole words. 
Thesaurus or a dictionary is a common way to expand queries and can be used to broaden the meaning of the term as well as narrowing it down or simply finding related terms [4,10]. The main problem of using a thesaurus is that terms have different meanings, depending on the subject. Thesaurus is therefore often used in databases within a special field like pharmacological database [14] and biomedical databases [15], where they can be constructed manually. 
Reformulating a query can be done by using relevance feedback. This method revises automatically the query by using relevant terms from previous document and weighting them to obtain document similar to the previous documents [4,10]. 
The thesaurus based and relevance feedback query expansions have been compared and it shows that relevance feedback usually performs better, 
but a thesaurus performs better 
if the result from the original query is poor [16].Citation and Reference styles: http://library.concordia.ca/help/howto/citations.html
A dagger (†, &dagger;, U+2020) is a typographical symbol or glyph.
 It is also called an obelus, cross, or obelos, from a Greek word meaning "roasting spit[*]" or "needle[**]", or obelisk[***], its diminutive (see obelisk). A double dagger (‡, &Dagger;, U+2021) is 
 a variant with two "handles", and is also called a diesis[†] or Cross of Lorraine[††].
 The pilcrow (¶; Unicode U+00B6, HTML entity &para;), 
 also called the paragraph sign[¶] or the alinea (Latin: a linea, "of the line"), is a typographical character commonly used to denote individual paragraphs. This non-alphabetic symbol varies from typeface to typeface, but the form shown here is typical.
'; 

$text="
* '''Condemn me, it does not matter: history will absolve me.'''
** Closing words of the ''[http://www.marxists.org/history/cuba/archive/castro/1953/10/16.htm]'' delivered at the end of trial against [[w:Moncada Barracks|Moncada Barracks]] attack.

* '''Ideas do not need weapons''', if they can convince the great masses.
** ( Span. Original: ''Las ideas no necesitan ni de las armas, en la medida en que sean capaces de conquistar a las grandes masas.'' )
** Speech on August 3, 1985, Source: [http://lanic.utexas.edu/la/cb/cuba/castro/1985/19850804 lanic.utexas.edu]

* '''This country is heaven, in the spiritual sense of the word. And I say, we prefer to die in heaven than survive in hell.'''
** Speech made by Castro on February 2, 2005

*'''Warfare is a means and not an end. Warfare is a tool of revolutionaries. The important thing is the revolution. The important thing is the revolutionary cause, revolutionary ideas, revolutionary objectives, revolutionary sentiments, revolutionary virtues!'''
** Speech made by Castro at [[Ernesto Guevara|Ernesto \"Che\" Guevara]]'s memorial service on October 18, 1967

* '''A revolution is not a bed of roses. A revolution is a struggle between the future and the past.''' [http://www.britishcouncil.org/learnenglish-central-trivia-revolution.htm]

* '''As I have said before, the ever more sophisticated weapons piling up in the arsenals of the wealthiest and the mightiest can kill the illiterate, the ill, the poor and the hungry, but they cannot kill ignorance, illness, poverty or hunger'''. [http://www.cuba.cu/gobierno/discursos/2002/ing/f210302i.html]

* '''I am not a communist and neither is the revolutionary movement'''.
** 1959 after the Cuban revolution, before the Communists began to gain power in the new government. [http://www.fiu.edu/~fcf/castro_year1/urrutia.dorticos.html]

* '''I am a Marxist Leninist and I will be one until the last day of my life'''.
** 1961 after the Bay of Pigs invasion. [http://www.washingtonpost.com/wp-dyn/content/article/2007/01/10/AR2007011000468.html]

*'''Armas para que? (\"Guns, for what?\")'''
** A response to Cuban citizens who said the people might need to keep their guns, after Castro announced strict gun control in Cuba [http://www.gmu.edu/departments/economics/wew/quotes/repeal.html]

*'''When I was a young boy, my father taught me that to be a good Catholic, I had to confess at church if I ever had impure thoughts about a girl. That very evening, I had to rush to confess my sin. And the next night, and the next. After a week, I decided religion wasn't for me.'''
** Source: ''The Atheist's Bible'' 1st ed., ed. Joan Konner (New York, HarperCollins, 2007), 62.

* '''They talk about the failure of socialism but where is the success of capitalism in Africa, Asia and Latin America?'''
** 1991, during the fall of USSR [http://lanic.utexas.edu/project/castro/db/1991/19910604-1.html]

Castro’s retirement raises serious questions about the future of the island over which he has held sway for so long. Cuba now faces a power vacuum, one fraught with challenges and opportunities. Although Castro’s brother Raúl is the logical heir to the throne, it is unclear whether he has the temperament to continue where his brother left off. Nor is he the only one who has waited for this moment. Many of Castro’s opponents have looked forward to the end of his regime with great anticipation, eager to see Cuba shed its former ideology and embrace the tenets of an open society. Whatever comes next for Cuba, Castro’s legacy will cast a very long shadow.[http://www.theatlantic.com/doc/200802u/fidel-castro]

";



wiki_cite($text);
echoP($text);
get_wiki_quotes($text);
echoPRE($text);



//works below

$pattern='/(\[[\s\d+)*\,(\s and\s\d+)]*\])/';//one or more digits within square brackets
preg_match_all($pattern,$text,$values);
$newStr= preg_replace($pattern, '<sup><a href="#">$1</a></sup>', $text);

echo_array($values);


echoP($newStr);

$text=$newStr;
//Find footnotes
$pattern='/\[([\*†¶]*)\]/';//one or more special characters within square brackets
preg_match_all($pattern,$text,$values);
$newStr= preg_replace($pattern, '<sup><a href="#">$1</a></sup>', $text);

echo_array($values);

echoP($newStr);

if ($values[1][0]='*') echo '<hr>'; //echoes to check if there is an asterisk


$text=htmlentities('Citation and Reference styles: http://library.concordia.ca/help/howto/citations.html
A dagger (†, &dagger;, U+2020) is a typographical symbol or glyph.
 It is also called an obelus, cross, or obelos, from a Greek word meaning "roasting spit" or "needle", or obelisk, its diminutive (see obelisk). A double dagger (‡, &Dagger;, U+2021) is 
 a variant with two "handles", and is also called a diesis or Cross of Lorraine.');

 
 echoP($text);
 


// Assuming the above tags are at www.example.com
$URI='http://www.bbc.com/';
$tags = get_meta_tags($URI);

// Notice how the keys are all lowercase now, and
// how . was replaced by _ in the key.
//echo 'METATAGS';
echo $tags['author'];       // name
echo $tags['keywords'];     // php documentation
echo $tags['description'];  // a php manual
echo $tags['geo_position']; // 49.33;-86.59

$text = file_get_contents($URI);
//$text="<title>This is a Title Maybe</title> Test";
$pattern2="/.*?<title>([a-zA-Z\s\,\:]*)<\/title>/isx";
preg_match_all($pattern2,$text,$values);
echo 'Title  '.$values[1][0];
//echo$text;


$fp = fopen($URI, 'r');

// the variable $http_response_header magically appears
echo_array($http_response_header);

// or
$meta_data = stream_get_meta_data($fp);
echo_array($meta_data);


 ?>
 
 Most pages do not have titles! Or METATAGS!
 <?php
 $url="http://www.bbc.com/";
 function getUrlData($url)
{
    $result = false;
   
    $contents = getUrlContents($url);

    if (isset($contents) && is_string($contents))
    {
        $title = null;
        $metaTags = null;
       
        preg_match('/<title>([^>]*)<\/title>/si', $contents, $match );

        if (isset($match) && is_array($match) && count($match) > 0)
        {
            $title = strip_tags($match[1]);
        }
       
        preg_match_all('/<[\s]*meta[\s]*name="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $contents, $match);
       
        if (isset($match) && is_array($match) && count($match) == 3)
        {
            $originals = $match[0];
            $names = $match[1];
            $values = $match[2];
           
            if (count($originals) == count($names) && count($names) == count($values))
            {
                $metaTags = array();
               
                for ($i=0, $limiti=count($names); $i < $limiti; $i++)
                {
                    $metaTags[$names[$i]] = array (
                        'html' => htmlentities($originals[$i]),
                        'value' => $values[$i]
                    );
                }
            }
        }
       
        $result = array (
            'title' => $title,
            'metaTags' => $metaTags
        );
    }
   
    return $result;
}

function getUrlContents($url, $maximumRedirections = null, $currentRedirection = 0)
{
    $result = false;
   
    $contents = @file_get_contents($url);
   
    // Check if we need to go somewhere else
   
    if (isset($contents) && is_string($contents))
    {
        preg_match_all('/<[\s]*meta[\s]*http-equiv="?REFRESH"?' . '[\s]*content="?[0-9]*;[\s]*URL[\s]*=[\s]*([^>"]*)"?' . '[\s]*[\/]?[\s]*>/si', $contents, $match);
       
        if (isset($match) && is_array($match) && count($match) == 2 && count($match[1]) == 1)
        {
            if (!isset($maximumRedirections) || $currentRedirection < $maximumRedirections)
            {
                return getUrlContents($match[1][0], $maximumRedirections, ++$currentRedirection);
            }
           
            $result = false;
        }
        else
        {
            $result = $contents;
        }
    }
   
    return $contents;
}
?>

Here's an example of its usage. Check that the included URL has a META REFRESH redirection:

<?php
$url='http://appft1.uspto.gov/netacgi/nph-Parser?Sect1=PTO2&Sect2=HITOFF&u=%2Fnetahtml%2FPTO%2Fsearch-adv.html&r=1&p=1&f=G&l=50&d=PG01&S1=20080040322.PGNR.&OS=dn/20080040322&RS=DN/20080040322';
$url='http://www.sierraclub.org/ansel_adams/about.asp';
$url='http://en.wikipedia.org/wiki/Zone_system';
$url='http://www.californiamuseum.org/Exhibits/Hall-of-Fame/inductees.html';
$url='http://www.britishcouncil.org/learnenglish-central-trivia-revolution.htm';
$url='http://www.cre8asiteforums.com/forums/index.php?showtopic=59556#';
$url='http://www.cre8asiteforums.com/forums/index.php?showtopic=59286';
$url='http://immigrer-au-canada.com/';
$url='http://news.bbc.co.uk/2/hi/europe/7260478.stm';
$url='http://www.nytimes.com/2008/02/23/us/23oxnard.html';
$result = getUrlData($url);

echo '<pre style="overflow:scroll">'; print_r($result); echo '</pre>';
$body = file_get_contents($url);

//echo $body;
?>

<pre>
  Where Wikipedia has some references (need a method to check). This can form the part of a walk
  Get metatags and titles to place in references for future.

</pre>

 
 
 
 
 

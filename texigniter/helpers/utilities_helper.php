<?php
// Utilities files for Y Lazarides
// February 2008
function echoPRE($text){
    echo '<pre class="pretty-pre" style="margin-top:0;
       margin-bottom:0;padding-top:0;padding-bottom:0">';echo $text;echo '</pre>';
}

function echoLine($text){
    echo $text.'<br />';
}
function echo_line($text){
    echoLine($text);
}

function log_($text,$b=''){
    if ($b=='b'){
       echo "<b> $text. </b><br/>";
    }
    else{
        echo '&nbsp;&nbsp;'.$text.'<br />';}

}

function echo_array($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}


function echoP($text){
    echo '<p>';
    echo $text;
    echo '</p>';
}

function get_php_file($file,&$text){
    //this function will display a PHP file
    $text=htmlentities(file_get_contents($file));
    echoPRE($text);
}

function display_php_file($file){
    get_php_file($file,$text);
    echoPRE($text);
}


function highlight_num($file)
//you need to include css for this
{
    echo '<code class="num">', implode(range(1, count(file($file))), '<br />'), '</code>';
    highlight_file($file);
}

//Example
//display_php_file('COUNT_RECURSIVE.php',$text);

function get_wiki_quotes($text){
    //changes wiki type quotes to semantically correct q
    $needle="'''";
    $text=str_replace($needle,'"',$text);


    $pattern='/\"((^http).*?)\"/isx';//replaces all except in links
    preg_match_all($pattern,$text,$values);
    echoPRE($values);
    $text=preg_replace($pattern,'<q>$1</q>',$text);
}


function wiki_cite($text){
    //changes [http://] to superscripts
    $pattern='/\[(http:\/\/.*?)\]/';
    preg_match_all($pattern,$text,$values);
    echo_array($values);
    $limit=count($values[1]); //paranoid just in case none to make
    if ($limit>0){
        for ($i=0;$i<count($values[1]);$i++)
        {
            $needle=$values[1][$i];
            $text=str_replace($needle,'<sup><a href="'.$needle.'">'.($i+1).'</a></sup>',$text);
        }
    }
    $pattern='/\[<sup>/';
    $text=preg_replace($pattern,'<sup>[',$text);
    $pattern='/<\/sup>\]/';
    $text=preg_replace($pattern,']</sup>',$text);
}
function count_sentences($text){
    $sec = preg_match_all( '/[.!?\,\]\}[\r\n]]/', $text, $tmp );
    //echo 'number of sentences '.$sec.'<br />';
}

function count_words($text){
    $wc = preg_match_all( '/[ \r]/', preg_replace( '/ +/', ' ', $text ), $tmp );
    return $wc;
}


function statistics($text){
    // Number of words: number of space series or linebreaks + 1
    $wc = preg_match_all( '/[ \r]/', preg_replace( '/ +/', ' ', $text ), $tmp );
    //echo 'number words'.$wc.'<br />';
    // Number of syllables: vowels not followed by another vowel. Quite accurate approximation.
    $syc = preg_match_all( '/[aeiouy][^aeiouy]/', $text, $tmp );
    //echo 'number of syllables'.$syc.'<br />';
    // Number of polysyllabic words (>=3 syllables): Vowel, non-spaces, vowel, non-spaces, vowel (or more non-spaces-vowel)
    $psyc = preg_match_all( '/[aeiouy]([^ ]*[aeiouy]){2,}/', $text, $tmp );
    //$s = 'number of polyssylabic words '.$psyc.'<br />';
    // Number of sentences: Number of periods, exclamation marks, question marks and linebreaks
    $sec = preg_match_all( '/[.!?\r]/', $text, $tmp );
    //Words per sentence
    // Flesch Reading Ease Score
    @$fres = 206.835 - 1.015 * ( $wc / $sec ) - 84.6 * ( $syc / $wc );
    //echo 'flesch reading easy score '.$fres.'<br />';
    // Simple Measure of Gobbledygook
    @$smog = 1.043 * sqrt( $psyc * ( 30 / $sec ) ) + 3.1291;
    @$fog_index = 0.4*(($wc/$sec)+100*($psyc/$wc));
    $s  = '<table>';
    $s .= '<tr>';
    $s .= '<td>Number of Words</td><td>'.$wc.'</td/>';
    $s .= '</tr>';
    $s .= '<tr>';
    $s .= '<td>Number of Polysyllabic words</td><td>'.$psyc.'</td/>';
    $s .= '</tr>';
    $s .= '<tr>';
    $s .= '<td>Number of Syllables</td><td>'.$syc.'</td/>';
    $s .= '</tr>';
    $s .= '<tr>';
    $s .= '<td>Number of Sentences </td><td>'.$sec.'</td/>';
    $s .= '</tr>';
    $s .= '<tr>';
    if ($sec>0) $words_per_sentence = $wc/$sec; else {
        $words_per_sentence = 0;
    }
    $s .= '<td>Words per Sentence </td><td>'.$words_per_sentence.'</td>';
    $s .= '</tr>';
    $s .= '<tr>';
    $s .= '<td>Fog Index  </td><td>'.$fog_index.'</td>';
    $s .= '</tr>';

    $s .= '<tr>';
    $s .= '<td>Smog Index </td><td>'.$smog.'</td>';
    $s .= '</tr>';

    $s .= '<tr>';
    $s .= '<td>Flesch Reading Easy Score </td><td>'.$fres.'</td>';
    $s .= '</tr>';
    $s .= '</table>';
    return $s;

}

function frequency($text){
    //gets the frequency of words and does some calculations
    $wordfrequency = array_count_values( str_word_count($text, 1) );
    $numberwords=str_word_count($text);
    arsort($wordfrequency); //array reverse sort
    foreach ($wordfrequency as $key => $val) {
        $valuepercent=(($val)*100)/$numberwords;
        echo "$key = $val ".number_format($valuepercent,4).' %<br />';
    }
    $vocabulary=count($wordfrequency);
    echo ' Total number of words : '.$numberwords;
    echo ' SIZE OF VOCABULARY     : '.$vocabulary;
}

function vocabulary($text){
    //gets the frequency of words and does some calculations
    $wordfrequency = array_count_values( str_word_count($text, 1) );
    $numberwords=str_word_count($text);
    arsort($wordfrequency); //array reverse sort
    foreach ($wordfrequency as $key => $val) {
        $valuepercent=(($val)*100)/$numberwords;
        //echo "$key = $val ".number_format($valuepercent,4).' %<br />';
    }

    $vocabulary=count($wordfrequency);
    return $wordfrequency;
}



//functions to parse the head
//modified from php.net
//Y Lazarides 2008 

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

function wikitext( $content ) {
    $searches = array(
            "/'''([^']+)'''/", // bold
            "/''([^']+)''/", // italics
            '/<br>/i', // bad line breaks
    );

    $replaces = array(
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<br />',
    );

    $content = preg_replace( $searches , $replaces, $content );

    return $content;
}

function timer_start() {
    global $timestart;
    $mtime = explode(' ', microtime() );
    $mtime = $mtime[1] + $mtime[0];
    $timestart = $mtime;
    return true;
}

/**
 * timer_stop() - Return and/or display the time from the page start to when function is called.
 *
 * You can get the results and print them by doing:
 * <code>
 * $nTimePageTookToExecute = timer_stop();
 * echo $nTimePageTookToExecute;
 * </code>
 *
 * Or instead, you can do:
 * <code>
 * timer_stop(1);
 * </code>
 * which will do what the above does. If you need the result, you can assign it to a variable, but
 * most cases, you only need to echo it.
 *
 * @since 0.71
 * @global int $timestart Seconds and Microseconds added together from when timer_start() is called
 * @global int $timeend  Seconds and Microseconds added together from when function is called
 *
 * @param int $display Use '0' or null to not echo anything and 1 to echo the total time
 * @param int $precision The amount of digits from the right of the decimal to display. Default is 3.
 * @return float The "second.microsecond" finished time calculation
 */
function timer_end($display = 0, $precision = 3) { //if called like timer_stop(1), will echo $timetotal
    global $timestart, $timeend;
    $mtime = microtime();
    $mtime = explode(' ',$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timeend = $mtime;
    $timetotal = $timeend-$timestart;
    $r = ( function_exists('number_format_i18n') ) ? number_format_i18n($timetotal, $precision) : number_format($timetotal, $precision);
    if ( $display )
    echo $r;
    return $r;
}

 function error_($output,$msg=''){
        // Manually parse output for errors and
        // generate usable information for the user
        // especially content of error-lines.

        // error messages syntax
        $pattern = '/^\s*.+error\s*:(.+) in (.+) on line (\d+)\s*$/m';
        // we strip tags from
        // PHP send the error msg with <b> etc
        $z=preg_match_all($pattern,strip_tags($output),$values);
        $s='<div class="error" >Error: ';
        $s.=$values[1][0].' '.$msg.'on line '.$values[3][0].'</div>';
        return $s;
    }


function shutdown($text,$check)
{
    // if ($check) is TRUE
    // eval found no syntax errors
    if ($check==TRUE){
        //echo_line('start shutodown');
        $pattern="/Error/";
        $z= preg_match_all($pattern,$text,$values);
         
        if($z){$output='Error';
            //echo_array($values);
            echo '<div class="error">'.$text.'</div>';
        }
        else{
           //need to do something here
            echo_line($text, PHP_EOL); // script executed succesfully
        }
        //echo_line('end shutdown ');
    }
    else{
        // here we output eval syntax error
        echo error_($text);
    }
}

function customError($errno, $errstr)
  {
  switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline";// in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...THIS <br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
       // echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
  }
  }

function listArrayRecursive($array_name, $ident = 0, $mark="-"){
    if (is_array($array_name)){
        foreach ($array_name as $k => $v){
            if (is_array($v)){
                for ($i=0; $i < $ident; $i++){ echo $mark; }
                echo $k . " : " . "<br>";
                listArrayRecursive($v, $ident + 1, $mark);
            }else{
                for ($i=0; $i < $ident; $i++){ echo $mark; }
                echo $k . " : " . $v . "<br>";
            }
        }
    }else{
        echo "Variable = " . $array_name;
    }
}




?>


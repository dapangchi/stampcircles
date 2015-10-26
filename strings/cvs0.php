<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Subtraction Form 0.1</title>
	<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>" style="width:70%;margin:0 auto;border:1px solid #bebebe;background:#EEEEEE;padding:8px">


<?php
/* This routine creates the html for a select group
 by reading a CVS file from a text file with mark-up 
 Dr Y Lazarides
 Some rights reserved
 
*/

include_once('utilities.php');

//Generates a select menu from a cvs marked file

$text6="
  form.nice-form{
  control:form;
  action:form.php;
  method:post;
  controls:text2,radio1,radio2,languageselect,text1, work;
}

languageselect{
 type:select;
 name:language;         
 file:options.txt ;
 class:cssTest;
 id:LanguageSelect;
 enabled;
 caption:Jurisdiction of your license;}

illness{
  names:illness;
  name:illness;
  type:checkbox;
  label-top:ILLNESSES;
  values:sick,HIV,TB,ABE,ZAR;
  tabindex:auto;
  labels:sick,HIV,TB,ABE,ZAR;
  checked:sick,HIV,TB;
  class:fancy-checkbox;
  columns:3;
  rows:equal;
}

text2{
type:html;
<h3>Choose a license type</h3>

<p>With a Creative Commons license, you keep your copyright but allow people to copy and distribute your work provided they give you credit - and only on the conditions you specify here For those new to Creative Commons licensing, we've have prepared a list of things to think about. If you want to offer your work with no conditions choose the public domain.</p>
}

text1{
type:html;
<p>Additional Information
The additional fields are optional, but will be embedded in the HTML generated for your license. This allows users of your work to determine how to attribute it or where to go for more information about the work</p>
}



  
radio1{
  type:radio;
  name:radio1;
  label-top:Allow commercial uses of your work?;
  values:Y1,N1;
  tabindex:auto;
  labels:Yes,No;
  checked:Y1;
  class:fancy-radio;
  }

radio2{
  type:radio;
  name:radio2;
  label-top:Allow modifications of your work?;
  values:Yes,Maybe,No;
  tabindex:auto;
  labels:Yes, Yes as long as others share alike,No;
  checked:No;
  class:fancy-radio;
  }
  
work{
  type:text; 
  names:title,attribute1,attribute2,attribute3,attribute4,attribute5;
  values:enabled;
  labels:Tell us the format of your work, Title of work, Attribute work to name,attribute work to URL, More permissions URL, Tell us about the nature of the work;
  status:enabled;
  image:information.png;
  image-location:right;
  
}
  
number2{
  type:text; 
  names:f1,f2,f3;
  values:f1,f2;
  labels:mother\'s name,mother\'s surname, maiden name;
  label-top:Enter Your Name;
  status:enabled;
}
  
comments{
  type:textarea; 
  names:current_medication,future_medication, impossible;
  values:This is a very long text, I do not know how to delmit commas, execllent;
  labels:A Test;
  label-top:Enter Your Name;
  rows:3,5,7;
  cols:20,20,20;
  tabindex:40,42,44;
}
";


//$text6=file_get_contents('form1.frm');



$options=new Select;
//$options->textInCurlyBrackets('dropdown1',$text7);
 $options->parseForm($text6);
  
/*$select=$options->parseSelect($text5);
$options->selectToHTML($select5);
$select1=$options->parseSelect($text1);
$options->selectToHTML($select1);
$options->parseCheckbox($text1);
$options->parseTextInput($text4);*/


//Specify form



class select{


public   $properties=array('name','value','checked','disabled','readonly','size','maxlength','src','alt','usemap','ismap','tabindex','accesskey','onfocus','onblur','onselect','onchange','accept', 'text','password','checkbox','radio','submit','reset','file','hidden','image,button','values','labels');
/*
type        %InputType;    TEXT      -- what kind of widget is needed --
  name        CDATA          #IMPLIED  -- submit as part of form --
  value    CDATA          #IMPLIED  -- Specify for radio buttons and checkboxes --
  checked     (checked)      #IMPLIED  -- for radio buttons and check boxes --
  disabled    (disabled)     #IMPLIED  -- unavailable in this context --
  readonly    (readonly)     #IMPLIED  -- for text and passwd --
  size        CDATA          #IMPLIED  -- specific to each type of field --
  maxlength   NUMBER         #IMPLIED  -- max chars for text fields --
  src         %URI;          #IMPLIED  -- for fields with images --
  alt         CDATA          #IMPLIED  -- short description --
  usemap      %URI;          #IMPLIED  -- use client-side image map --
  ismap       (ismap)        #IMPLIED  -- use server-side image map --
  tabindex    NUMBER         #IMPLIED  -- position in tabbing order --
  accesskey   %Character;    #IMPLIED  -- accessibility key character --
  onfocus     %Script;       #IMPLIED  -- the element got the focus --
  onblur      %Script;       #IMPLIED  -- the element lost the focus --
  onselect    %Script;       #IMPLIED  -- some text was selected --
  onchange    %Script;       #IMPLIED  -- the element value was changed --
  accept      %ContentTypes; #IMPLIED  -- list of MIME types for file upload --
  text|password|checkbox|radio|submit|reset|file|hidden|image|button
  >
*/

public function textInCurlyBrackets($str,$text){
//finds the text in between curly brackets
//allows for almost any character to allow
//for caption strings etc.

 $pattern='/\s*'.$str.'\s*\{([[:alnum:]\s\:\;\n\r\.\-_\,\d\=\'\!\?\>\<\/]+\s*\n*\r*)\}/isx';
  preg_match_all($pattern,$text,$val); //full text of form
  $curly=$val[1][0];
 return $curly;
}

private function getForms($text){
//returns an array with all the forms
//in the text string
$pattern='/form[\.]([[:alnum:]\-]+)\s*\{/';
  preg_match_all($pattern,$text,$values);
  $number_forms=count($values[1]);
   for ($i=0;$i<$number_forms;$i++){
   $forms['name'][$i]=$values[1][$i]; //form name
  }
return $forms['name'];
}


public function parseForm($text){
//parses the full string and finds how many forms are in the input
//produces a blank form
//at a later stage the input will be inserted in the blank
//form
/*$pattern='/form[\.]([[:alnum:]\-]+)\s*\{/';
  preg_match_all($pattern,$text,$values);
 
   for ($i=0;$i<$number_forms;$i++){
   $forms['name'][$i]=$values[1][$i]; //form name
  }*/
  

$forms['name']=self::getForms($text);
$number_forms=count($forms['name']);
  //print_r($forms['name']);  
//echo($forms[0][1]);  
//we now know the names of the forms
//this will enable us to extract all the text input 
//between the forms for further processing

for ($i=0;$i<$number_forms;$i++){
  $s=$forms['name'][$i];
  $pattern='/form.'.$s.'\{([[:alpha:]\s\:\;\n\r\.\-_\,\d]+\s*\n*\r*)\}/isx';
  preg_match_all($pattern,$text,$val); //full text of form
  $forms['text'][$i]=$val[1][0];
  //echo_array($forms[1]);
  $forms['method'][$i]=self::getAttribute('method',$forms['text'][$i]);
  $forms['action'][$i]=self::getAttribute('action',$forms['text'][$i]);
  $forms['enctype'][$i]=self::getAttribute('enctype',$forms['text'][$i]);
  //get a list of all the control
  $forms['controls'][$i]=self::getValues('controls',$forms['text'][$i]);
  //for all controls now get the text between curly brackets
  //echo_array($forms['controls']);
 
}
$i=0;
 for ($i=0;$i<$number_forms;$i++){
  for ($j=0;$j<count($forms['controls'][$i]);$j++){
    //echo 'checking for control text ....'.$forms['controls'][$i][$j].'<br />';
    $t[$j]=self::textInCurlyBrackets($forms['controls'][$i][$j],$text);//$forms['controls'][$i][0]
    //echo 'returned ... '.$t[$j].'<br />';
    }
  $forms['controlstext'][$i]=$t;
  }
//now we have all the controls and the control
//text in the array
//this now needs to be parsed
//html then echo   
   //echo 'FORMS ARRAY <br />';
   //echo_array($forms);
 for ($i=0;$i<$number_forms;$i++){  
   self::parseControls($forms['controlstext'][$i]); 
   //echo_array($forms['controlstext'][$i]);
   } 
 
}

private function checkControlType($text){
 //checks to find out the type of control
 $s=self::getAttribute('type',$text);
 //echo 'IN CHECK TYPE <br />'.$s;
 return $s;

}

public function parseControls($t){
//this function parses all the controls from
//an input array $t - holds all the text for the controls
//of a form
//echo 'IN PARSE CONTROLS <br />';
//echo_array($t);

 for ($i=0;$i<count($t);$i++){
   $type=self::checkControlType($t[$i]);
   if ($type=='checkbox') {self::parseCheckBox($t[$i]);}
   if ($type=='select')   {$select=self::parseSelect($t[$i]);
         self::selectToHTML($select);
   }
   if ($type=='text')    {$select=self::parseTextInput($t[$i]);}
   if ($type=='textarea'){$select=self::parseTextArea($t[$i]);}
   if ($type=='radio')   {$select=self::parseRadio($t[$i]);}
   if ($type=='submit')  {$select=self::parseSubmit($t[$i]);}
   if ($type=='html')    {$select=self::parseHtml($t[$i]);}
 }
 //echo $type; 
}

public function parseHtml($text){
//justs echos text;
$s=preg_replace('/type:html;/isx','',$text);
echo $s;

}

public function parseSubmit($text){
//echo 'IN SUBMIT';
//echo $text;
echo '<input name="submit" type="submit" value="Process"> <br />';

}

public function parseTextInput($text){
 //parse a text input string
  $names=self::getValues('names',$text);
  $values=self::getValues('values',$text);
  $number=count($names);
  $labels=self::getValues('labels',$text);
  $status=self::getAttribute('status',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  $image=self::getAttribute('image',$text);
  echo '<label>'.$labelsTop.'</label>';
  echo '<div style="width:100%;background:#FAFAFA">';
  for ($i=0;$i<$number;$i++){
    $default=self::getDefaults($names[$i],$values[$i]);
    $s="";
    echo'<div style="padding:2px;margin:1px;border:1px solid #ff0000">';
    $s.='<label style="float:left;width:50%;font-size:12px;font-weight:bold;font-family:georgia,arial;border:1px solid #bebebe;margin:3px">'.$labels[$i]. ' </label>';
    $s.='<INPUT name="'.$names[$i].'" ';
    $s.=' type="text" ';
    $s.=' value="'.$default.'"'.$status.' ';
    $s.= '  style="float:left;width:30%;margin:3px;" > ';
    
  echo $s;
  if (isset($image)){echo '<img src="'.$image.'" />';}
  echo '<div style="clear:both"></div>';
    echo '</div>';
  } 
    echo '</div>';
    
    
return $input; 

}

public function getDefaults($name,$default){
//gets default values for post
$s=$name;
if (isset($_POST[$s]))
    {$w=$_POST[$s];}else {$w=$default ;}
    $default=$w;
    //echo 'default';echo $name.' ';echo 'POST '. $_POST[$s].'<br />';
return $default;
}


//$Geek_World_Online_Magazine = !isset($_POST["Geek_World_Online_Magazine"]? NULL: $_POST["Geek_World_Online_Magazine"]);


public function parseTextArea($text){
 
  $names=self::getValues('names',$text);
  $values=self::getValues('values',$text);
  $rows=self::getValues('rows',$text);
  $cols=self::getValues('cols',$text);
  $number=count($names);
  $labels=self::getValues('labels',$text);
  $default_text=self::getvalues('values',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  echo '<label>'.$labelsTop.'</label>';
  //inser default values while showing form
  for ($i=0;$i<$number;$i++){
    
    $default_text[$i]=self::getDefaults($names[$i],$default_text[$i]);
    
    $s="";
    $s.='<p><label>'.$labels[$i]. ' </label></p>';
    $s.='<textarea rows="'.$rows[$i].'" '.' cols="'.$cols[$i].'" name="'.$names[$i].'" >';
    //$s.='<INPUT name="'.$input[$i].'" ';
    //$s.=' type="text" ';
    //$s.=' value="'.$values[$i].'" checked ';
    //$s.= '> ';
    $s.=' '.$default_text[$i].' ';
    $s.='</textarea><br>';
  echo $s;} 
return $input; 

}

public function parseCheckbox($text){
  //parse a checkbox string
  //to make life easy
  //checked:$name[1],$name[2] etc...
  $checkbox=self::getAttribute('name',$text);
  $checkbox='illness';
  $values=self::getValues('values',$text);
  $number=count($values);
  $labels_checkbox=self::getValues('labels',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  $checked=self::getValues('checked',$text);
  echo '<p>'.$labelsTop.'</p>';
  
  for ($i=0;$i<$number;$i++){
  if ($checked[$i]==$values[$i]){$check[$i]='checked ';} else {$check[$i]=' ';}
    if (isset($_POST[$checkbox])){
    $check[$i]='';
    for ($j=0;$j<count($_POST[$checkbox]);$j++){
       if ($_POST[$checkbox][$j]==$values[$i]){$check[$i]='checked';}
       ;}
    ;}
   
    $var=$values[$i];
    $s="";
    $s='<INPUT name="'.$checkbox.'[]'.'" ';
    $s.=' type="checkbox" ';
    $s.=' value="'.$values[$i].'" '.$check[$i].' ';
    $s.= '> '.$labels_checkbox[$i];
  echo $s;} 
  
return $checkbox;
}


public function parseRadio($text){
  //parse a checkbox string
  $radio_name=self::getAttribute('name',$text);
  $values_checkbox=self::getValues('values',$text);
  $number=count($values_checkbox);
  $labels_checkbox=self::getValues('labels',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  $checked=self::getAttribute('checked',$text);
print "<p>$labelsTop</p>\n";
  for ($i=0;$i<$number;$i++){
    $chkstr=''; 
    if (($_POST[$radio_name]==$values_checkbox[$i])) {$chkstr='checked';}else{

     if (($checked==$values_checkbox[$i])&&(!isset($_POST[$radio_name]))){$chkstr='checked';} else{$chkstr='';}
    }
    
    $s="";
    $s='<INPUT style="color:#ff0000;background:#ff0000" name="'.$radio_name.'" ';
    $s.=' type="radio" ';
    $s.=' value="'.$values_checkbox[$i].'"'.$chkstr.' ';
    $s.= '> '.$labels_checkbox[$i]."\n";
    echo $s;} 
    echo '
    
    
    
    ';
return $checkbox;
}


private function getValues($str,$text){
$pattern='/'.$str.':(.+)[\;]/i';
  preg_match_all($pattern,$text,$values);
  $labelsString=$values[1][0];
  //echo_array($values);
  //echo $labelsString;
  $labels_checkbox=split(',',$labelsString);
  //echo 'controls found<br />';
  //echo_array($labels_checkbox);
  
  return $labels_checkbox;
}


public function parseSelect($text){
  $pattern='/select[\.]([[:alpha:]]+)/';
  preg_match_all($pattern,$text,$values);
  $select['name']=self::getAttribute('name',$text);
  $select['size']=self::getAttribute('size',$text);
  if ($select['size']==='auto'){$select['size']=10;}  //needs to get values first
  $select['file']=self::getAttribute('file',$text);
  $z=preg_match_all('/multiple/',$text,$values);
  $select['multiple']=$values[0][0];
  $z=preg_match_all('/disabled/',$text,$values);
  $select['disabled']=$values[0][0];
  $select['caption']=self::getAttribute('caption',$text);
  //echo_array($_POST);
return $select;}



//
private function getAttribute($attribute,$text){
//gets an attribute from a pair such as name:test;
 $pattern='/'.$attribute.':([\d\.\s\_\-\?\![:alpha:]]+)\s*[\;}]/';
 preg_match_all($pattern,$text,$values);
 return $values[1][0];
}


public function selectToHTML($select){
//creates the HTML for a selct key
echo '<p>'.$select['caption'].'</p>';
$row = 1;
$s='<select '.$select['multiple'].' name="'.$select['name'].'[] "size="'.$select['size'].'" >"';
echo $s; //echoes the select
$handle = fopen($select['file'], "r");
$flag=0;
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $selected='';
    $num = count($data);
   // echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    //for ($c=0; $c < $num; $c++) {
       if ($num>2){$selected='selected';$data[0]=$data[1];$data[1]=$data[2];}else{$selected='';}
       if (strtolower($data[0])==='optgroup') {
         if( $flag=1 ){echo '</optgroup>';}
         echo '<optgroup label="'.$data[1].'">';$flag=1;
         }
       else{
       echo '<option '. $selected .' value="'.$data[0].'" >'.$data[1].'</option>';}
        //echo $data[0] . "<br />\n";
    //}
}
fclose($handle);
echo '</select>';
}

}
?>
<div style="border:1px solid #ff9999;margin:1px">
<div style="width:53%;float:left;height:10px"></div>
<input name="submit" type="submit" value="Select a License" style="float:left">
<div style="clear:both"></div>
</div>
</form>

</body>
</html>





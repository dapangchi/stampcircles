<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>jVision</title>
	
	<style type="text/css" media="all">@import "thickbox.css";</style>
	<link href="http://latenightengineer.com/play/themes/aberdeen-5.x-1.7/aberdeen/aberdeen-liquid/style.css" rel="stylesheet" type="text/css" />
	<link href="styles.css" rel="stylesheet" type="text/css" />
	
	
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="corner.js"></script>
<script type="text/javascript" src="thickbox.js"></script>
<script type="text/javascript" src="jquery.forms.js"></script>
<script type="text/javascript" src="passwordStrengthMeter.js"></script>

<script type="text/javascript">

//password strength plugin
//initializes the code
//echos back if the strength is not ok.
jQuery(document).ready(function() {
$('#username').keyup(function(){$('#msg').html(passwordStrength($('#pswd').val(),$('#username').val()))})
$('#pswd').keyup(function(){$('#msg').html(passwordStrength($('#pswd').val(),$('#username').val())).fadeIn(500)})
	})
	
	function showMore()
	{
		$('#more').slideDown()
	}
//endpassword strength plugin




$(document).ready(function() { 
    // bind form using ajaxForm 
    
    $('#exampleform').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#htmlExampleTarget,#test',
        beforeSubmit:validate1, 
        
       // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('#htmlExampleTarget').fadeIn('slow'); 
            showResponse;
         } 
        
    }); 
});

function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    alert('About to submit: \n\n' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 

function showResponse(responseText, statusText)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
        '\n\nThe output div should have already been updated with the responseText.'); 
} 

function validate1(formData, jqForm, options) {
//validation routines here
    for (var i=0; i < formData.length; i++) {
        if (!formData[i].value) {
            alert('Please enter a value for both Username and Password');
            return false;
        }
    }
    alert('Both fields contain values.');
}

function isValidEmail(val){
alert('in function');
    var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!val.match(re)) {
        return false;
    } else {
        return true;
    }
}

function emailClick(z) {
  var v=z.value;
  alert(z.value);
  alert(isValidEmail(v));
}

function isNumberInput(field,event)
{
  var key, keyChar;
  if (window.event)
   key =window.event.keyCode;
   else if (event)
     key=event.which;
   else
     return true;
   //check for special characters like backspace
   if (key==null || key==0 || key ==8 || key==13 || key==27)     
     return true;
   //check to see it is a number
   keyChar = String.fromCharCode(key);
   if (/\d|\./.test(keyChar))
      {
       window.status= '';
       //alert('is number');
       return true;
       
       }
     else
     {
      alert("Field accepts number only"+key);
     return false;
     }
}

function isAlphaNum(field,event)
{
  var key, keyChar;
  if (window.event)
   key =window.event.keyCode;
   else if (event)
     key=event.which;
   else
     return true;
   //check for special characters like backspace
   if (key==null || key==0 || key ==8 || key==13 || key==27)     
     return true;
   //check to see it is a number
   keyChar = String.fromCharCode(key);
   if (/\w/.test(keyChar))
      {
       window.status= '';
       //alert('is number');
       return true;
       alert(key);
       }
     else
     {
      //window.status= "Field accepts number only";
     return false;
     }
}



function displaymessage()
{
displaykey('Hello World');
}

function displaykey(){
  //alert('Hello World');
  var a;
  a="another test"
  innerHTML(a);
}

function displaydoubleclick(){

alert('help');
}

function square(a){
  alert("4");
}
function innerHTML(a){
 var a;
 a=$("h2").text();
 document.exampleform.pswd.defaultValue="";
 a=document.exampleform.pswd.value+' \<b style\=\"color:#f60000\"\>valid name\<\/b\>';
 $("#third").html(a);
 if (document.exampleform.pswd.value.length<3) a=document.exampleform.pswd.value+' \<b style\=\"color:#f60000\"\>less than three characters\<\/b\>';
 if (document.exampleform.pswd.value.length>3) a=document.exampleform.pswd.value+' \<b style\=\"color:#f60000\"\>more than three characters\<\/b\>';
 $("#third").html(a);
 
 
}


function displaychange(){
 var a;
 document.exampleform.pswd.defaultValue="";
 a=document.exampleform.pswd.value+' \<b style\=\"color:#f60000\"\>ON CHANGE EVENT\<\/b\>';
 $("#third").html(a);
}



function afterpHTML(){
$("#test2>p").after('Hello World');
}

function prependHTML(){
$("#test3 p").prepend('<p>Hello World</p>');
}

function hidePanel(){
$("#third").hide();}

function showPanel(){
$("p").show();
}

function togglePanel(){
$("#third").toggle();}

function centerPanel(){
$("img").center();}

function css(a,colour,back){
//colour='red';
//back='blue';
z="color:'blue'";
$(a).css({ color:colour, background:back });}

function autogrowTextArea(){
 /* Autogrows the area */
 $('textarea.expanding').autogrow();
}


$(document).ready(function(){
  focusFirst;
  });

function focusFirst(){
 document.forms[0].elements[1].focus();
}

function onwrap(o){

 $("#t1").click(function () { 
      $(this).wrap(document.createElement("div")); 
    }).toggle().slidedown();
    
}



</script>	
	
<script type="text/javascript">
$(document).ready (function(){
	$('.adorn').corner();})
</script>

<style type="text/css">

textarea.expanding {
	line-height: 18px;
}
table {background:#fafafa;padding:0;margin:0}
table td{padding:0;margin:0;
        background:#ffffff;vertical-align:middle}
table td textarea {margin:0;padding:0}
table caption{font-size:18px;font-weight:bold;text-align:center}

table td.label{background:#fafafa;font-family:arial,sans-serif;font-size:12px;font-weight:bold;padding-left:6px}
table td input{padding:0;margin:0;width:100%;border:none;margin-top:0}
table td.auto{background:#fafafa;color:#cccccc;font-family:arial,sans-serif;font-size:12px;font-weight:bold;
             padding-left:6px;width:15px;}

h2{clear:both;}

ul{list-type-style:none;margin-left:20px;}
ul li{background-image:none}

.wrap{width:90%;margin:0 auto;background:#ffffff}

#wrap1{width:90%;margin:0 auto;border:1px solid #bebebe;background:#ffffff;
      background:#ffffff url(legend_personal_bg.gif) top right no-repeat;padding:10px}
#wrap2{width:90%;margin:0 auto;border:1px solid #bebebe;background:#ffffff;
      background:#ffffff url(legend_ok_bg.gif) top right no-repeat;padding;10px}
      
    
label{font-family:arial;font-weight:normal;float:left;margin-left:3px}
input{display:block;float:left}
input#v1{width:45%;border:1px solid blue}
.after{clear:right;}
textarea {float:left;width:98%}
hr.spacer{height:7px;width:90%;border:0}
p#footer-control{font-size:12px;font-family:arial;text-indent:0;margin-left:3px;}

body {background:#000000}
</style>

<body onload="window.document.forms[0].elements[0].focus();">


<form method="POST"  action="html-echo.php" style="width:70%;margin:0 auto;border:1px solid #bebebe;background:#fafafa;padding:8px;min-width:615px" name="exampleform" id="exampleform"  class="adorn" enctype="multipart/form-data" >


<?php
/* This routine creates 
  <?php $_SERVER['PHP_SELF'];echo ?>
*/
include_once('object.class.php');
include_once('utilities.php');
include_once('markdown.php');
include ('custom.php');
include('custom2.php');
include('html.php');
include_once('basics.class.php');
include_once('inflector.class.php');
 //printf(('Manage Tags (<a href="%s" rel="%s">add new</a>)'), '#addtag','#test');break
 

 
$text=file_get_contents('forms913.frm');




class Parser extends Object{

//these are the types of controls defined internally. Plugins have a method to add overide or delete controls from
//the forms and pages.

public $controls=array('');


public $properties=array('accesskey'=>'accesskey="%s" ',
                           'name'=>'name="%s" ',
                           'names'=>'name="%s" ',
                           'id'=>'id="%s" ',  
                           'value'=>'value="%s" ',
                           'checked','disabled','readonly','maxlength','src','alt','usemap','ismap','tabindex','accesskey','onselect','accept', 'text','password','checkbox','radio','submit','reset','file','hidden','image','button','value','label',
                           'size'=>'size="%s" ',
                           'style'=>'style="%s" ',
                           'title'=>'title="%s" ',
                           'onclick'=>'onclick="%s;" ',
                           'onfocus'=>'onfocus="%s;" ',
                           'onblur'=>'onblur="%s;" ',
                           'onkeypress'=>'onkeypress="%s;" ',
                           'onkeyup'=>'onkeyup="%s;" ',
                           'onchange'=>'onchange="%s;" ',
                           'ondblclick'=>'ondblclick="%s;" ',
                           'ondblclick'=>'ondblclick="%s;" ',
                           'src'=>'src="%s" ',
                           'tabindex'=>'tabindex="%s" ',
                           'button'=>'<button %s>%s </button>',
                           'rows'=>'rows="%s" ',
                           'cols'=>'cols="%s" ',
                           'textarea'=>'<%s  %s>%s </%s>',
                       );


  public $forms;
  public $number_forms;
  public $action;
  public $elements;
  public $encoding;
  public $enctype;
  public $length;
  public $method;
  public $name;
  public $id;
  public $target;
  public $text;   //the text defining the form
  public $show_form = true;
  public $error_msg = NULL;
  public $html_text;
  public $custom;

     //textblock values


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
function __construct(){
  $this->custom=new Custom($this);
  $this->html=new HtmlHelper($this);
  
}

public function textInCurlyBrackets($str,$text){
//finds the text in between curly brackets
//allows for almost any character to allow
//for caption strings etc.

 $pattern='/\s*'.$str.'\s*\{([[:alnum:]\s\*\:\$\"\(\)\[\]\|\#\%\&\;\n\r\.\-_\,\d\=\'\!\?\>\<\/]+\s*\n*\r*)\}/isx';
  preg_match_all($pattern,$text,$val); //full text of form
  $curly=$val[1][0];
  //$this->html_text[]=$curly;
  return $curly;
 
}

public function getForms($text){
//returns an array with all the forms
//in the text string
$pattern='/form[\.]([[:alnum:]\-]+)\s*\{/';
  preg_match_all($pattern,$text,$values);
  $number_forms=count($values[1]);
   for ($i=0;$i<$number_forms;$i++){
   $forms['name'][$i]=$values[1][$i]; //form name
  }
  $this->number_forms=$number_forms;
return $forms['name'];
}


public function parseForm($text){
 
//parse the text and get the forms
  $forms['name']=self::getForms($text);
  //place in object
  $this->$forms=$forms;
  $number_forms=count($forms['name']);

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
  $m=$this->method=$forms['method'];
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
 //echo_array($this->elements);
}

private function checkControlType($text){
 //checks to find out the type of control
 $s=self::getAttribute('type',$text);
 $this->elements[]=$s;
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
   if ($type=='checkbox') {self::parseCheckBox($t[$i]);
   }
   //if ($type=='select')     {$select=self::parseSelect($t[$i]);
     //    self::selectToHTML($select);
   //}
   //if ($type=='text')       {$select=self::parseTextInput($t[$i]);}
   if ($type=='select')     {$s=self::parseTextArea($t[$i],'select','select');$this->out($s);}
   
   if ($type=='password')   {$s=self::parseTextArea($t[$i],'input','password');$this->out($s);}
   if ($type=='text')       {$s=self::parseTextArea($t[$i],'input','text');$this->out($s);}
   if ($type=='file')       {$s=self::parseTextArea($t[$i],'input','file');$this->out($s);}
   if ($type=='textarea')   {$s=self::parseTextArea($t[$i],'textarea','textarea');$this->out($s);}
   if ($type=='radio')      {$select=self::parseRadio($t[$i]);}
   if (($type=='submit')||($type=='button') || ($type=='reset') ) {$s=self::parseControl($t[$i],'input',$type);$this->out($s);}
   if ($type=='img') {$s=self::parseControl($t[$i],'input','image');$this->out($s);}
   //if ($type=='submit')     {$select=self::parseSubmit($t[$i]);}
   if ($type=='html')       {$select=self::parseHTML($t[$i]);}
   if ($type=='markdown')   {$select=self::parseMarkdown($t[$i]);}
   if ($type=='multi-image'){$select=self::parseMultipleImage($t[$i]);}
   if ($type=='table')      {$select=self::parseTable($t[$i]);}
   //testing plugin architecture
   if ($type=='month')      {$select=self::parseCustom('month',$t[$i]);
   //$test='code';
   //else {
   //     $z=code($t[$i]);
   //      echo 'function exists '.$type;
    }
 }
}

public function parseMultipleImage($text){;
//parses a multuple image container
$images=self::getValues('images',$text);
$columns=self::getAttribute('columns',$text);
$width=self::getWidth($columns);
$num=count($images);
echo $width;
echo <<<EOT
<div style="clear:both"></div>
<div class="imageContainer" style="width:80%;margin:0 auto;border:1px solid #bebebe;padding:0;text-align:center">
<h4>Image Container</h4>
EOT;
for ($i=0;$i<$num;$i++){
echo <<<EOT
  <img src="$images[$i]" style="width:$width%;margin:0;padding:0;background:#000000;" />
EOT;
;}
echo <<<EOT
   <div style="clear:both"></div>
   <p>This is some paragraph text</p>
</div>
<div style="clear:both"></div>
EOT;
//echo_array($images);
}


public function parseHtml($text){
//justs echos text - removes the type;
//
$s=preg_replace('/(type:html;|type:markdown;)/isx','',$text);
$s=preg_replace('/\;\}*$/isx','',$s);
$value=self::getAttribute('value',$text);

if ($value=='file'){
     $text1=file_get_contents($value);
     $s=preg_replace('//sx',$text1,$text);}     
if ($debug){echo $s;}
//$z='<textarea style="width:78%">'.$s.'</textarea>';
$this->html_text[]=$s;
 return $s;
}

public function parseMarkdown($text){
//justs echos text - removes the type;
//
$s=preg_replace('/(type:markdown;)/isx','',$text);
$s=preg_replace('/\;\}*$/isx','',$s);
$value=self::getAttribute('value',$text);
if ($value=='file'){
     $text1=file_get_contents($value);
     $s=preg_replace('//sx',$text1,$text);}     
if ($debug){echo $s;}
$this->html_text[]=markdown($s);
 
}

public function submitToHTML($name,$value,$class,$style){

  echo '<input name="'.$name.'" type="submit" value="'.$value.'" style="display:block;border:1px solid 
  
  #ff0000;clear:both"> ';
;}

public function parseSubmit($text){
//echo 'IN SUBMIT';
//echo $text;
$value=self::getAttribute('value',$text);
$name=self::getAttribute('name',$text);
self::submitToHTML($name,$value,$class,$style);
$this->html_text[]=$this->html->submit($caption = 'Submit', $htmlAttributes = array(), $return = false);
}


public function parseTextInput($text){
 //parse a text input string
 //
 // change to parse all attributes - attribute and action to return 
 // back 
 // name->insertintohtml
 // 
  $names=self::getValues('names',$text);
  $values=self::getValues('values',$text);
  $number=count($names);
  $labels=self::getValues('labels',$text);
  $status=self::getAttribute('status',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  $image=self::getValues('image',$text);
  
  $rules=self::getRules($text);
  $s1='<label>'.$labelsTop.'</label>';
  $s1.='<div style="width:100%;background:#FAFAFA">';
  $this->html_text[]=$s1;
  //echo $s1;
  for ($i=0;$i<$number;$i++){
    $this->elements[]='text';
    $default=self::getDefaults($names[$i],$values[$i]);
    $s="";
    $s.='<div style="padding:2px;margin:1px;">'."\n";
    $s.='<label style="float:left;width:50%;font-size:12px;font-weight:bold;font-family:georgia,arial;margin:3px">'.$labels[$i]. " </label>\n";
    $s.='<INPUT name="'.$names[$i].'" id="'.$names[$i].'" ';
    $s.=' type="text" ';
    $s.=' value="'.$default.'"'.$status.' ';
    $s.= '  style="float:left;width:30%;margin:3px;"'." > \n";
  //echo $s;
  $this->html_text[]=$s;
  if (isset($image[$i])){
    $s4='<a href=""><img src="'.$image[$i].'" /></a>';
    $this->html_text[]=$s4;
  }
  $s2='<div style="clear:both"></div>';
  $s2.='</div>';
  $this->html_text[]=$s2;
    //echo $s2;
  } 
  $s3='</div>';
  $this->html_text[]=$s3;
  //echo $s3; 
    
return $input; 

}

function parseCustom($text){
//Plugin architecture for calling any user parse function
//this will call the user function
  $names=self::getValues('name',$text);
  $value=self::getValues('value',$text);
  $selected_value=self::getValues('default',$text);
  //this calls the user array
  $z=$this->html->monthOptionTag('select', $value = null, $selected = 3, $selectAttr = null, $optionAttr = null, $showEmpty = false); 
  //echo $z;
}


public function getDefaults($name,$default){
//gets default values for post
//needs to be completed for all controls
//
$s=$name;
if (isset($_POST[$s]))
    {$w=$_POST[$s];}else {$w=$default ;}
    $default=$w;
return $default;
}

public function DBgetDefaults($name,$default){
;}





public function getWidth($columns){
//calculates widths for multicolumn layouts
//width is set to 98 not to break the layout
if ($columns>1){$width=98/$columns;}else{$width=98;}
return $width;
}


public function parseCheckbox($text){
  //parse a checkbox string
  //to make life easy
  //checked:$name[1],$name[2] etc...
  $checkbox=self::getAttribute('name',$text);
  $class=self::getAttribute('class',$text);
  //$checkbox='illness';
  $values=self::getValues('values',$text);
  $number=count($values);
  $labels_checkbox=self::getValues('labels',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  $checked=self::getValues('checked',$text);
  $columns=self::getAttribute('columns',$text);
  $width=self::getWidth($columns);
  echo '<p>'.$labelsTop.'</p>';
  $this->html_text[]=self::closedEntity('p',$labelsTop,'');
  $s1='<ul class="checkboxlist" style="width:'.$width.'%;border:1px solid #bebebe;float:left;display:block">'; 
  $this->html_text[]='<ul>';//$s1;
  echo $s1;
  for ($i=0;$i<$number;$i++){
  if ($checked[$i]==$values[$i]){$check[$i]='checked ';} else {$check[$i]=' ';}
    if (isset($_POST[$checkbox])){
    $check[$i]='';
    for ($j=0;$j<count($_POST[$checkbox]);$j++){
       if ($_POST[$checkbox][$j]==$values[$i]){$check[$i]='checked';}
       ;}
    ;}
    $var=$values[$i];
    $s=' ';
    $s.='<li><INPUT name="'.$checkbox.'[]'.'" ';
    $s.=' type="checkbox" ';
    $s.=' value="'.$values[$i].'" '.$check[$i].' ';
    $s.=' class="'.$class.'" ';
    $s.= ' style="display:block;width:5%;border:1px solid red;float:left;margin:1px" ><span style="display:block;border:1px solid #bebebe;float:left;width:90%;margin:1px" />'.$labels_checkbox[$i].'</span></li> ';
    $s.='<div style="clear:both"></div>';
  echo $s;
   $this->html_text[]=$s; 
   } 
    echo '</ul>';
   $this->html_text[]='</ul>';
return $checkbox;
}

private function clearer(){
//returns clearing div
//you can other addToHTML array
//or echo clearer();
  $s='<div class="clearer"></div>';
  
 return $s;
}


public function entity($entity,$s,$attribute){
if ($s==0){
  $s1="<".$entity.">\n";
 } 
 else{
  $s1="</".$entity.">\n";
  }
 
 return $s1; 
}  

public function closedEntity($entity,$text,$attribute){
//Adds an enclosed entity to the HTML lines
//When file is completed a link is produced, filed zipped and downloaded
   $s="<$entity"." $attribute >\n";
   $s.=$text."\n";
   $s.="</$entity>\n";
 return $s;
;}


public function parseRadio($text){
  //parse a checkbox string
  $radio_name=self::getAttribute('name',$text);
  $values_checkbox=self::getValues('values',$text);
  $labels_checkbox=self::getValues('labels',$text);
  $labelsTop=self::getAttribute('label-top',$text);
  $checked=self::getAttribute('checked',$text);
  $class=self::getAttribute('class',$text);
  $onClick=self::getValues('onClick',$text);
  //echo_array($onClick);
  //$s1="\n".'<ul style="width:20%;border:1px solid #bebebe;float:left">'."\n"; 
  $s1.='<div class="fancy-radio bGrey fleft percent33 p5" >';
  $s1.="$labelsTop\n";
  $this->html_text[]=$s1;
  if ($debug){ echo $s1;}
  
  $number=count($values_checkbox);
  for ($i=0;$i<$number;$i++){
    $chkstr=''; 
    if (($_POST[$radio_name]==$values_checkbox[$i])) {$chkstr='checked';}else{
     if (($checked==$values_checkbox[$i])&&(!isset($_POST[$radio_name]))){$chkstr='checked';} else{$chkstr='';}
    }
    $s2="";
    $s2.='<div style="display:block;width:17px;border:1px solid red;float:left">';
    $s2.='<INPUT style="display:block;float:left;" name="'.$radio_name.'" ';
    $s2.=' type="radio" ';
    $s2.=' value="'.$values_checkbox[$i].'"'.$chkstr.' ';
    $z='onclick="'.$onClick[$i].'();'.'"';
    $s2.= ' id="test2" '.$z.' /></div><p class="'.$class.'" >'.$labels_checkbox[$i]."</p>\n";
    $s2.='<div style="clearer"></div>';
    //$s2.=$s1.$s;
    if ($debug) {echo $s2;}
    $this->html_text[]=$s2;
    }
    $s3='</div>';
    //$s3="</ul>\n";
    if ($debug) {echo $s3;}
    $this->html_text[]=$s3;
return $checkbox;
}

private function wikiLink($query){
//creates link for wiki
 $query=strtolower(trim($query));
 $query=ucwords($query);
 $query=str_replace(' ','_',$query);
 $s='http://en.wikipedia.org/wiki/'.$query;
 return $s;
}

private function getCSVData($file,$z){
//opens a file
//reads line by line
//places all values in a two dimensional array
//returns a serialized comma list to
//keep format for forms
$handle = fopen($file,"r");
 //set flag for groups 
 $flag=0;$i=0;$row=0;
 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $selected='';
    $num = count($data);
    $row++;
      for ($j=0;$j<$num;$j++){
       $d[$row][$j]=$data[$j];$s1.=$data[$j].', ';} 
    $i=$i+1;}   
fclose($handle);
//echo_array($d);

if ($z==0) {return($s1);}else {return $d;}
}


public function parseTable($text){
# parses tabular data
# for structure see .frm example-table.frm
# developed by Y Lazarides
# date: June 2008

 $head=self::getValues('thead',$text);
 $values=self::getValues('values',$text);
 $types=self::getValues('types',$text);
 $cells=self::getValues('cells',$text);
 $caption=self::getAttribute('caption',$text);
 $tfoot=self::getValues('tfoot',$text);
 $number_rows=self::getAttribute('rows',$text);
 
 $file=self::getAttribute('file',$text);
 if (!isset($number_rows)){$number_rows=count($values);}
 //$data=self::getValues('data',$text);
 $number_cells=count($values);

  #get CSV data if it exists
  if (isset($file)){
    $data=$this->getCSVData($file,0);
    //echo($data);
    $data=split(',',$data);}
  else {
   $data=self::getValues('data',$text);
  }


#table
$s1='<div class="adorn" style="background:#ffffff";>';
$s1.='<table>';
$s1.="<caption>$caption</caption>";
$s1.="<thead>";
# Head
$s1.="<tr>";
  for ($i=0;$i<$number_cells;$i++){
  $s1.="<th>$head[$i]</th>";}
$s1.="</tr>";
$s1.="</thead>";
#tfoot
$s1.='<tfoot style="color:#333333">';
$s1.='<tr>';
for ($i=0;$i<count($tfoot);$i++){
 $s1.="<th>$tfoot[$i]</th>";}    
$s1.='</tr>';
$s1.='</tfoot>';
$s1.='<tbody>';
#the rows
$count=0;$count2=0; //counter for data
for ($j=0;$j<$number_rows;$j++){
$s1.="<tr>";
  for ($i=0;$i<$number_cells;$i++){
   #action based on type
   if ($types[$i]=='text'){
     $s1.='<td><input type="text" value="'.trim($data[$count2]).'" /></td>';
     $count2=$count2+1;
     $count=$count+1;
     ;}
     elseif($types[$i]=="label"){$s1.='<td class="label">'.trim($data[$count2]).'</td>';$count=$count+1;
     $count2=$count2+1;
     }
     elseif($types[$i]=="auto"){$s1.='<td class="auto">'.$j.'</td>';$count=$count+1;}
     elseif($types[$i]=="img"){
       $wiki_link=$this->wikiLink($data[$count2-3]); 
       $s1.='<td class="img"><a href ="'.$wiki_link.'"><img src="information.png"></a></td>';$count=$count+1;
     }
      else{
  $s1.="<td>$types[$i]</td>";$count=$count+1;}
  ;
  }
$s1.="</tr>";
}



#table end
$s1.="</tbody>";
$s1.="</table>";
$s1.='<div class="clearer"></div>';
$s1.="</div>";
#put into array
$this->html_text[]=$s1;  


;}


private function getValues($str,$text){

 $pattern='/'.$str.':(.+)[\;]/';
 $pattern='/'.$str.':([[:alnum:]\%\#\/\,\!\?\)\(\.\s\[\]\n\r\d\-\_\*\>\<\:]+)[\;]/isx';
 preg_match_all($pattern,$text,$values);
 $labelsString=$values[1][0];
 $labels_checkbox=split(',',$labelsString);
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
 $pattern='/'.$attribute.':([\d\.\s\_\-\?\![:alpha:]]+)\s*[\;}]/isx';
 preg_match_all($pattern,$text,$values);
 return $values[1][0];
}

private function getRules($text){
//if rules exist gets the rules for validation
//rules are of the form rules[] all in an array
//they can exist both at the fieldset level 
//or the component level
//or the form level
//echo $text;
$pattern='/rules\[*\d*\]*:([\d\.\s\_\-\?\!\|\,\'[:alpha:]]+)\s*[\;}]/';
 preg_match_all($pattern,$text,$values);
 //echo_array($values);

}



public function selectToHTML($select){
//creates the HTML for a selct key
 $row = 1;
 $s1='<div style="width:45%;border:1px solid #ff0000;float:left">';
 $s1.='<p>'.$select['caption'].'</p>';
 $s1.='<select '.$select['multiple'].' name="'.$select['name'].'[] "size="'.$select['size'].'" >"';
 
 echo $s1; //echoes the select
 //read data from file
 $handle = fopen($select['file'], "r");
 //set flag for option group
 $flag=0;
 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $selected='';
    $num = count($data);
    $row++;
       if ($num>2){$selected='selected';$data[0]=$data[1];$data[1]=$data[2];}else{$selected='';}
       if (strtolower($data[0])==='optgroup') {
         if( $flag=1 ){echo '</optgroup>';}
         $s1.='<optgroup label="'.$data[1].'">';$flag=1;
         }
       else{
         $s1.='<option '. $selected .' value="'.$data[0].'" >'.$data[1].'</option>';}
 }
fclose($handle);

$s1.='</select>';
$s1.='</div>';
$this->html_text[]=$s1; //adds to text varaiable
 echo $s1;
}

public function parseAll($text){
 preg_match_all('/([[:alnum:]]+)\:\s*([[:alnum:]\<\>\/\d\#\s\:\(\)\,\.\'\"\&\=\"\-\_]+)\s*\r*\n*[\;]/',$text,$prop);
   for($i=0;$i<count($prop[1]);$i++){
    $values[$prop[1][$i]]=$prop[2][$i];
   }

return $values;
}

public function attributesText($values){
 foreach ($values as $key=>$value){
    if (isset($this->properties[$key])){
        $s1.= sprintf($this->properties[$key],$value,$src);
    }
   }
 return $s1;
}

private function out($s){
$this->html_text[]=$s;

}

public function parseControl($text,$entity='input',$type='text',$content='') {
//parses the text for a control
//$text : the text to be parse
//$entity : the entity type radio, etc
//$type   : the type of control 
   $attributes=self::parseAll($text);
   //echo_array($attributes);
   $s1=self::attributesText($attributes);
   $s=sprintf('<%s type="%s"  %s  />',$entity,$type,$s1);
   return ($s);
}

public function renderControl($s1,$entity='',$type='',$content='test',$return=true){
//renders a control
//works ok for text areas so far

 $pattern=$this->properties[$entity];
 //echo 'pattern'.$pattern;
 if ($entity=='textarea'){$s=sprintf($pattern,$entity,$s1,$content,$entity);}else
    {$s=sprintf('<%s type="%s"  %s  />',$entity,$type,$s1);}
    //echo htmlentities($s);
  if (!$return) echo $s;
return $s;
}


	
public function parseTextArea($text,$entity='input',$type='text',$content=''){
//parses the most common controls
//input, passsword,textarea
  
  $attributes=self::parseAll($text);
  //gets all attributes
  //echo 'ATTRIBUTES ARRAY';
  //echo_array($attributes);
  foreach ($attributes as $key=>$val){
     $keys[$key]=split(',',$val);
  }
 
  //echo_array($keys);
  $number=count($keys['name']);
  
  //put in the form control[property,property,property]
  //ie normalize as if single control
  //must cater for errors if "" use first 
  //this is easier to display and add to form
  //also to cater for auto variables
  foreach($keys as $key=>$value){
   for ($i=0;$i<$number;$i++){
     $controls[$i][$key]=$value[$i];
     if ($controls[$i][$key]==''){$controls[$i][$key]=$controls[0][$key];}
  }   
  } 
  //echo 'CONTROLS';
  //echo_array($controls);
  //$entity="textarea";
  //if ($entity=='') $type='text';
  
  if ($keys[$key]){$this->html_text[]='<div id="'.$attributes['wrapid'].'" class="wrap adorn">'."\n";}
  //add header if it exists
  $this->html_text[]=$attributes['header'];
  for ($i=0;$i<$number;$i++){
     $s1=self::attributesText($controls[$i]);
     $s0='<div id="inner2">'."\n";
     $s=self::renderControl($s1,$entity,$type);
     if (!empty($keys['label'])){$s3='<label style="float:left;width:13em;clear:both">'."\n".$controls[$i]['label'].'</label>'."\n";}
     if (!empty($keys['after'])){$s4='<label  style="float:left;width:auto;">'.$controls[$i]['after'].'</label>';}
     $s5='<div class="clearer"></div></div>';
     $this->html_text[]=$s0.$s3.$s.$s4.$s5;
  }
  //add footer if it exists
 $this->html_text[]=$attributes['footer'];
 if ($keys[$key]){$this->html_text[]='</div><!--wrap-->'."\n";}
 
}


function render(){
foreach  ($this->html_text as $key=>$value){
//This is the main routine that echoes everything back on the screen;
//should also write it in a file with .php extension as
//well as put everything nicely in a zip file
   echo $value;
}
}
}
//echo_array($options->html_text); 

 $options=new Parser;
 $html=new HtmlHelper;
 $options->parseForm($text);
 $options->render(); 
  
?>

   
  
  </form>


<div class="clearer"></div>


 <div class="clearer"></div>

 
 







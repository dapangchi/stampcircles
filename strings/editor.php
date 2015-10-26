<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!-- Skin CSS file -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">
<!-- Utility Dependencies -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/element/element-beta-min.js"></script> 
<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
<script src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script>
<script src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script>
<script src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script>
<!-- Source file for Rich Text Editor-->
<script src="http://yui.yahooapis.com/2.5.2/build/editor/editor-beta-min.js"></script>

<script>
var myEditor = new YAHOO.widget.Editor('msgpost', {
    height: '300px',
    width: '522px',
    dompath: true, //Turns on the bar at the bottom
    animate: true //Animates the opening, closing and moving of Editor windows
    
});
myEditor.render();
</script>
<script>
var myEditor2 = new YAHOO.widget.Editor('msg2', {
    height: '300px',
    width: '522px',
    dompath: true, //Turns on the bar at the bottom
    animate: true //Animates the opening, closing and moving of Editor windows
    
});
myEditor2.render();
// each item requiring special files
// add_action('add_js','filename.js','inline');
// 
</script>


</head>
<body class="yui-skin-sam"> 
	<textarea name="msgpost" id="msgpost" cols="50" rows="10"> 
  <strong>Your</strong> HTML <em>code</em> goes here.<br> 
  This text will be pre-loaded in the editor when it is rendered. 
</textarea> 

<h2>Test</h2>
<textarea name="msgpost" id="msg2" cols="50" rows="10"> 
  <strong>Your</strong> HTML <em>code</em> goes here.<br> 
  This text will be pre-loaded in the editor when it is rendered. 
</textarea> 
</body> 
</html>


<!--
Parser needs to finish. Should also look at using it as templating
as templates //definitions must be in separate file
in template

website{name:
        type:wordpress;
        link:
        copyright:
        license:
        } 
head{
  meta:robots,all;
  title:test;
  charset:
  styles:
}

layout{{type:layout;
       style:three; //from pre-determined layouts
       theme:blue;}}
form{a,b,c,d,e,f,g}
This is some more text
widget{}
page-elements{
 blocks:yes;
 footer:yes;
 search:yes;
 rss:yes;
 login:yes;
}


->
















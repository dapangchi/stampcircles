<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="imagetoolbar" content="no" />
<title>HoverAccordion jQuery Plugin</title>
<meta name="Keywords" content="Bernd Matzner, jQuery, Plugin, Hover, Accordion" />
<style media="screen" type="text/css">
/* General Styles */
*{
margin:0;
padding:0;
border:0px none #FFFFFF;
}
* html ul ul li{
margin-bottom:-1px;
}
* html ul ul li a,* html ul li a{
height:100%;
}
a{
color:#FFFFFF;
text-decoration:underline;
}
body{
margin:20px;
padding:0 0 0 0;
background:#808080 repeat-y center;
color:#F0F0F0;
font-family:'Lucida Grande','Segoe UI',Arial,Helvetica,sans-serif;
font-size:85%;
line-height:140%;
}
code{
padding:0.5em;
border-top:1px solid #666666;
border-right:1px solid #999999;
border-bottom:1px solid #999999;
border-left:1px solid #666666;
margin:0.5em 0 0.5em 0;
display:block;
}
h1{
margin:1em 0 0.5em 0;
display:block;
font-weight:normal;
}
h2{
border-top:1px solid #F0F0F0;
padding-top:0.5em;
margin:1em 0 1em 0;
display:block;
font-weight:normal;
}
#content{
margin:30px;
width:400px;
border-top:1px solid #999999;
border-right:1px solid #666666;
border-bottom:1px solid #666666;
border-left:1px solid #999999;
padding:20px;
}

/* Styles for Example #1 */
#example1{
margin:0;
padding:0;
width:200px;
list-style-type:none;
line-height:120%;
}
#example1 .closed{
background-image:url(ha-down.gif);
}
#example1 .closed,#example1 .opened{
padding-right:10px;
background-position:98% 50%;
background-repeat:no-repeat;
}
#example1 .header{
background-color:#7B7B7B;
}
#example1 .opened{
background-image:url(ha-up.gif);
}
#example1 a{
display:block;
font-weight:bold;
text-decoration:none;
}
#example1 a.hover{
border-top:1px solid #5F5F5F;
border-bottom:1px solid #7B7B7B;
background-color:#7B7B7B;
color:#FFFFFF;
}
#example1 ul{
overflow: hidden;
margin:0;
padding:0;
}
#example1 li{
margin:0;
padding:0;
list-style-type:none;
background-color:#848484;
color:#FFFFFF;
}
#example1 li a{
padding:2px 10px 2px 4px;
border-top:1px solid #9A9A9A;
border-left:1px solid #9A9A9A;
border-right:1px solid #696969;
border-bottom:1px solid #757575;
background-color:#848484;
color:#FFFFFF;
}
#example1 li.active a,#example1 li li.active a{
border-top:1px solid #5F5F5F;
border-bottom:1px solid #7B7B7B;
border-left:1px solid #757575;
border-right:1px solid #9A9A9A;
background-color:#404040;
color:#FFFFFF;
}
#example1 li.active li a,#example1 li li a{
padding:2px 4px 2px 8px;
border-top:1px solid #696969;
border-left:1px solid #696969;
border-right:1px solid #8A8A8A;
border-bottom:1px solid #7B7B7B;
background-color:#757575;
color:#FFFFFF;
}

/* Styles for Example #2 */
#example2{
margin:0;
padding:0;
width:300px;
list-style-type:none;
background-color:#FFFFFF;
color:#000000;
line-height:120%;
height:300px;
}
#example2 a{
display:block;
font-weight:normal;
text-decoration:none;
}
#example2 ul{
overflow: hidden;
margin:0;
padding:0;
}
#example2 li{
margin:0;
padding:0;
list-style-type:none;
}
#example2 li a{
width:285px;
padding:5px 0 0 15px;
display:block;
color:#000000;
background-image:url(ha-header.jpg);
height:25px;
}
#example2 li a.closed{
color:#000000 !important;
background-image:url(ha-header.jpg) !important;
}
#example2 li.firstitem a.closed{
color:#000000 !important;
background-image:url(ha-header-first.jpg) !important;
}
#example2 li.lastitem a.closed{
color:#000000 !important;
background-image:url(ha-header-last.jpg) !important;
}
#example2 li li{
border-left:1px solid #E5E5E5;
border-right:1px solid #E5E5E5;
padding:0 15px 0 15px;
height:175px;
}
#example2 li a.opened{
background-image:url(ha-header-active.jpg);
color:#FFFFFF;
}
#example2 li.firstitem a.opened{
background-image:url(ha-header-first-active.jpg);
color:#FFFFFF;
}
#example2 li.lastitem li{
margin-bottom:-4px;
}
#example2 li.lastitem ul{
background-image:url(ha-footer.jpg);
background-repeat:no-repeat;
background-position:bottom;
padding-bottom:4px;
}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.hoveraccordion.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	// Setup HoverAccordion for Example 1
	$('#example1').hoverAccordion();

	// Setup HoverAccordion for Example 2 with some custom options
	$('#example2').hoverAccordion({
		activateitem: '3',
		speed: 'slow'
	});
	$('#example2').children('li:first').addClass('firstitem');
	$('#example2').children('li:last').addClass('lastitem');
});

</script>
</head>
<body>
<div id="content">
  <h1>HoverAccordion</h1>
  <p>A jQuery Plugin for no-click two-level menus<br />
    (or whatever else you want to do with it)</p>
  <h2>Introduction</h2>
  <p>This is yet another accordion script, except you don't have to click to open
    one item, you just move your mouse over it.</p>

  <p>&nbsp;</p>
  <p>I actually made the plugin to serve as a menu, but it could also work as
    a regular accordion for displaying different types of content within a page.</p>
  <p>&nbsp;</p>
  <p>It was important to me to require as little customization of the list code
    in order for the plugin to work, i.e. I didn't want to have to manually add
    classes etc. to header or active elements, as the structure of the list already
  contains all the information needed.</p>
  <p>&nbsp;</p>
  <p>This plugin was inspired by the Accordion menus on the <a href="http://www.apple.com/mac/">Apple Mac
      website</a> as well as <a href="http://bassistance.de/jquery-plugins/jquery-plugin-accordion/">J&ouml;rn
      Zaefferer's Accordion plugin</a>.</p>

  <p>Thanks to Eugene R for pointing out on how to most easily implement a hover detection.</p>
  <h2>Download</h2>
  <p><a href="jquery.hoveraccordion.min.js">HoverAccordion V 0.5.0 minified (3 kB)</a></p>
  <p><a href="jquery.hoveraccordion.js">HoverAccordion V 0.5.0 full source (7 kB)</a></p>
  <p>&nbsp;</p>
  <p>This plugin should be considered beta, to say the least.</p>

  <h2>Usage:</h2>
  <p>This plugin requires an unordered list with two levels.</p>
  <p><code>&lt;ul id=&quot;identifier&quot;&gt;<br />
    &nbsp;&nbsp;&nbsp;&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Item 1&lt;/a&gt;<br />

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&gt;<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li&gt;Subitem 1a&lt;/li&gt;<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/ul&gt;<br />
&nbsp;    &nbsp;&lt;/li&gt;<br />
&nbsp;&nbsp;&nbsp;&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Item 2&lt;/a&gt;<br />

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li&gt;Subitem
2a&lt;/li&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/ul&gt;<br />
&nbsp;    &nbsp;&lt;/li&gt;<br />
    &lt;/ul&gt;</code></p>
  <p>To use the plugin with the list, call it by referencing the id of the &lt;ul&gt;

    tag (or a class, for that matter).</p>
  <p><code>$(document).ready(function(){<br />
&nbsp;&nbsp;&nbsp;$('#identifier).hoverAccordion();<br />
});</code></p>
  <p>&nbsp;</p>
  <p>The CSS for the list should leave all subitem open so its contents remain
    accessible if JavaScript is disabled in the browser.</p>
  <h2><span> Example #1</span> - Menu</h2>

  <p>Just a plain unordered list with the id 'example1' in the &lt;ul&gt; tag.
    Each item contains a link to the same page, illustrating the autoactivate
    feature, where the item and according subitems are opened and highlighted
    automatically, if the link is identical with the current page. This is a
    default setting. See Example #2 for a regular accordion without links on the main items.</p>
  <p><code>$(document).ready(function(){<br />
    &nbsp;&nbsp;&nbsp;$('#example1').hoverAccordion();<br />
    });</code></p>
  <p>&nbsp;</p>

  <a name="ex1" id="ex1"></a>
  <ul id="example1">
    <li><a href="#">Item 1</a></li>
    <li><a href="#">Item 2</a>
      <ul>
        <li><a href="index.php?id=2a#ex1">Subitem 2a</a></li>
        <li><a href="index.php?id=2b#ex1">Subitem 2b</a></li>

        <li><a href="index.php?id=2c#ex1">Subitem 2c</a></li>
        <li><a href="index.php?id=2d#ex1">Subitem 2d</a></li>
        <li><a href="index.php?id=2e#ex1">Subitem 2e</a></li>
      </ul>
    </li>
    <li><a href="#">Item 3</a></li>
    <li><a href="#">Item 4</a></li>

    <li><a href="#">Item 5</a>
      <ul>
        <li><a href="index.php?id=5a#ex1">Subitem 5a</a></li>
        <li><a href="index.php?id=5b#ex1">Subitem 5b</a></li>
        <li><a href="index.php?id=5c#ex1">Subitem 5c</a></li>
      </ul>
    </li>

    <li><a href="#">Item 6</a></li>
    <li><a href="#">Item 7</a>
      <ul>
        <li><a href="index.php?id=7a#ex1">Subitem 7a</a></li>
        <li><a href="index.php?id=7b#ex1">Subitem 7b</a></li>
        <li><a href="index.php?id=7c#ex1">Subitem 7c</a></li>

        <li><a href="index.php?id=7d#ex1">Subitem 7d</a></li>
      </ul>
    </li>
    <li><a href="#">Item 8</a>
      <ul>
        <li><a href="index.php?id=8a#ex1">Subitem 8a</a></li>
        <li><a href="index.php?id=8b#ex1">Subitem 8b</a></li>

        <li><a href="index.php?id=8c#ex1">Subitem 8c</a></li>
        <li><a href="index.php?id=8d#ex1">Subitem 8d</a></li>
        <li><a href="index.php?id=8e#ex1">Subitem 8e</a></li>
        <li><a href="index.php?id=8f#ex1">Subitem 8f</a></li>
      </ul>
    </li>
    <li><a href="#">Item 9</a>

      <ul>
        <li><a href="index.php?id=9a#ex1">Subitem 9a</a></li>
        <li><a href="index.php?id=9b#ex1">Subitem 9b</a></li>
        <li><a href="index.php?id=9c#ex1">Subitem 9c</a></li>
        <li><a href="index.php?id=9d#ex1">Subitem 9d</a></li>
        <li><a href="index.php?id=9e#ex1">Subitem 9e</a></li>

      </ul>
    </li>
  </ul>

    <p>For the purpose of this example, I added different numbers of subitems, in order to visualize how the height of the largest submenu determines how far each submenu opens up, so that there is little movement below. This can be turned off by setting the &quot;keepheight&quot; option to &quot;false&quot;.</p>
  <h2><span> Example #2</span> - Regular Accordion</h2>

  <p>This
    time, we'll set custom options to emulate the accordion from the <a href="http://www.apple.com/mac/">Apple
    website</a>.</p>
  <p><code>
    $(document).ready(function(){<br />
    &nbsp;&nbsp;&nbsp;$('#example2').hoverAccordion({<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;activateitem: '1',<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;speed: 'fast'<br />

    &nbsp;&nbsp;&nbsp;});<br />
    });</code></p>
   <div style="width:300px;height:300px;background-color:#FFFFFF;padding:50px;">
  <a name="ex2" id="ex2"></a>
  <ul id="example2">
    <li><a href="#">Item 1</a>
      <ul>

        <li>Content #1 - Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
          sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
          erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing
          elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
          aliquyam erat, sed diam voluptua.</li>
      </ul>
    </li>
    <li><a href="#">Item 2</a>
      <ul>
        <li>Content #2 - At vero eos et accusam et justo duo dolores et ea rebum.
          Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
          dolor sit amet. At vero eos et accusam et justo duo dolores et ea rebum.
          Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
          dolor sit amet.</li>
      </ul>

    </li>
    <li><a href="http://latenightengineer.com/play/">Item 3</a>
      <ul>
        <li>Content #3 - Sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</li>
      </ul>
    </li>
    <li><a href="#">Item 4</a>

      <ul>
        <li>
<pre>
accordion1{
  type:accordion;
  items:one,two,three;
  content:one content,two content,three content;
  wrapid:accordion1;
  class:accordion;
  css:accordion1;
  hover:yes; //hover style accordion
}
        
<pre>
        </li>
      </ul>
    </li>
  </ul>
  </div>
  <p>For this example, a few extra classes are attached to the first and last items, so that the background images change according
    to their position (note the rounded corners).</p>
  <p>&nbsp;</p>

  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p style="text-align:right;font-size:x-small"><a href="http://berndmatzner.de">&copy; 2008
  - Bernd Matzner</a></p>
</div>
</body>
</html>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>--> 
<html class="no-js"> 
<head>
    <meta http-equiv="Content-Language" content="mul">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Y Lazarides" />
    <meta name="copyright" content="Dr Y Lazarides" />
    <meta name="robots" content="all" />
    <meta name="imagetoolbar" content="no" />
    <meta name="keywords" content="<?php //echo $keywords;    ?>" />
    <meta name="description" content="Stamps and Postal History" />
    
    <link rel="stylesheet" href="<?php echo site_url(); ?>css/userguide.css">  
    <link rel="Stylesheet" href="<?php echo site_url(); ?>css/bootstrap.css?">
    <link rel="Stylesheet" href="<?php echo site_url(); ?>css/application.css?">
    <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.form.js"></script>
    <script  type="text/javascript" src="<?php echo site_url(); ?>js/formatter.js" ></script>
          
    <script type="text/javascript" src="<?php echo site_url(); ?>js/goog/base.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>js/goog/deps.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>js/goog/dom/annotate.js"></script>
      
    <script type="application/javascript" src="<?php echo site_url(); ?>js/stamps.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>js/flowtype.js"></script>
	<!--<script src="//cdn.jsdelivr.net/handlebarsjs/1.3.0/handlebars.js"></script>-->
	<!--<script src="//cdn.jsdelivr.net/handlebarsjs/1.3.0/handlebars.runtime.js"></script>-->
	<!--<script src="//cdn.jsdelivr.net/handlebarsjs/1.3.0/handlebars.runtime.min.js"></script>-->
		    
    <script type="text/javascript" src="<?php echo site_url(); ?>js/colorbox/colorbox-master/jquery.colorbox.js"></script>

    <link rel="Stylesheet" href="<?php echo site_url(); ?>js/colorbox/colorbox-master/example1/colorbox.css">
    <!-- <link rel="Stylesheet" href="<?php echo site_url(); ?>css/pouchdb/base.css"> -->
    <!--<script src="//cdn.jsdelivr.net/pouchdb/2.2.3/pouchdb.min.js"></script>--> 
 </head>

<body style="background-color:black;width:100%;margin:0 auto;padding:0pt;">

<!-- all countries menu -->
<div class="container clearfix" style="background-color:#ccc;border-top:0px solid #000000;width:100%;margin:0 auto">
    <!-- START NAVIGATION TOP HIDDEN -->
    <div id="nav" style="margin-top:0px">
		<div id="nav_inner" class="nav_inner clearfix hidden" style="display: none;">
        <!-- hidden menu goes here -->
		</div>
        
		<div id="nav_inner2" class="nav_inner clearfix hidden" style="display: none;">
        <!-- hidden menu2  goes here -->
		</div>
	</div> 
    <!-- end hidden menu -->

	<div style="width:100%;background-color:#fff;">
		<!-- Has black bar on top -->
		<div id="nav21" style="height:0px;width:100%;margin-left:0px;padding-right:0;background-color:#ccc;" ></div>
    
        <div class="row-fluid" style="padding:8pt 0pt 8pt 0pt;width:100%;background-color:#ccc;">
	        <span class="icon-home">&nbsp; </span>
            <a class="nav-img" data-toggle="tooltip"><span  class="icon-globe" title="All Countries Menu"> </span></a>
	        <a href="#menu" class="menu-link" style="color:#000;position:relative;top:0px;left:0px;z-index:10000;font-weight:bold">&nbsp; &#9776;  <?php echo $web_name ?>&nbsp;</a>
            <!-- <a href="<?php echo site_url(); ?>/blogs/stamps/stamp-notes/egypt/introduction" style="color:#000;position:relative;top:0px;left:0px;z-index:10000;font-weight:bold">&nbsp; &#9776;  <?php echo ucfirst($location) ?>&nbsp; </a> -->
            
            <input type="text" class="form-control" placeholder="search"/>  
            <div class="btn-group" style="text-align:left">
            <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">All Countries<span class="caret"></span></button>
            <ul class="dropdown-menu hidden">
                <li><a class="nav-img" href="#"> All Countries  </a></li>
                <li><a id="nav-img2" href="#">System </a></li>
                <li><a>Test </a></li>
            </ul>
        </div><!-- /btn-group -->
        
        <div class="btn-group pull-right"  >
            <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">Portals <span class="caret"></span></button>
            <ul class="dropdown-menu hidden">
                <li><?php echo '<a data-toggle="modal" href="#newdocModal" class="" title="Think of a Portal as a book"><i class="icon-file-alt"></i> New Portal</a>';?> </li>
                <li><?php echo '<a data-toggle="modal" href="#clonedocModal" class=""><i class="icon-copy"></i> Clone Portal</a>';?> </li>
                <li><?php echo '<a data-toggle="modal" href="#renameportalModal" class=""><i class="icon-edit"></i> Rename Portal</a>'; ?></li>
                <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/deletedocument/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-trash" style="color:red"></i> Delete Portal </a>'; ?> </li>
                <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/deletedocument/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-gear"></i> Portal Settings </a>'; ?> </li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('adminSTAMPS/post/zip/'.$location.'/'.$title); ?>"><i class="icon-long-arrow-down"></i> Export as .zip</a></li>
                    
            </ul>
        </div><!-- /btn-group -->   
              
		<!-- second button group -->
        <div class="btn-group pull-right">
            <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">Document <span class="caret"></span></button>
            <ul class="dropdown-menu hidden">
                <li><?php echo '<a data-toggle="modal" href="#newdocModal" class=""><i class="icon-file-alt"></i> New Document</a>';?> </li>
                <li><?php echo '<a data-toggle="modal" href="#clonedocModal" class=""><i class="icon-copy"></i> Clone Document</a>';?> </li>
                <li><?php echo '<a data-toggle="modal" href="#renameportalModal" class=""><i class="icon-copy"></i> Rename Document </a>'; ?></li>
                <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/deletedocument/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-trash" style="color:red"></i> Delete Document </a>'; ?> </li>
                <li class="divider"></li>
				<li><?php echo '<a href="'.site_url().'adminSTAMPS/post/edit/'.$portal.'/'.$location.'/main"><i class="icon-edit"></i> Edit Main TeX File </a> ';?></li>
				<li><?php echo '<a target="_blank" href="'.site_url().'/sandboxPDF/pdflatex/'.$portal.'/'.$location.'/main?='.time().'"><i class="icon-book"></i> Texify Document</a>';
                    ?> </li>
                <li class="divider"></li> 
  				<li><?php echo '<a href="'.site_url().'adminSTAMPS/menu/edit/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-edit"></i> Edit side menu </a>'; ?> </li>
                  
                <li class="divider"></li>                            
				<li><?php echo '<a href="'.site_url().'adminSTAMPS/post/zip/'.$location.'/'.$title.'"><i class="icon-bolt"></i> Export as .zip</a>'; ?> </li>
                 
            </ul>
        </div><!-- /btn-group -->

        <div class="btn-group pull-right">
            <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">Page <span class="caret"></span></button>
            <ul class="dropdown-menu hidden">
                <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/edit/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-pencil"></i> Edit Page </a> ';?></li>
                <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/new/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-plus"></i> New Page </a>'; ?></li>
                <li><?php echo '<a data-toggle="modal" href="#renamedocModal"><i class = "icon-edit"></i> Rename Page</a>'; ?></li>
                <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/delete/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-trash" style="color:red"></i> Delete Page </a>'; ?></li>
                    
                <li><?php echo '<a target="_blank" href="'.site_url().'sandboxPDF/pdflatex/'.$portal.'/'.$location.'/'.$title.'?='.time().'"><i class="icon-book"></i> Texify</a>';?></li>
                <li class="divider"></li>
                <li><?php echo '<a href="site_url()adminSTAMPS/post/edit/'.$location.'/'.$title.'"><i class="icon-cog"></i> Settings </a> ';?></li>
            </ul>
        </div><!-- /btn-group -->
		
        <div class="btn-toolbar pull-right" style="background-color:black;z-index:9999;position:absolute;top:-50px;right:0px;margin-right:0px">
        </div><!-- /btn-toolbar -->
        <!-- end button group -->
    </div>
	</div>
    <!-- END NAVIGATION -->
    
    <!-- splash -->	
    <div style="height:450px;text-align:center;background: url(<?php echo $splash ?>) no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
    </div>
           
	<!-- CONTENT ROW -->		
    <!-- Some modal forms -->

    <div class="row-fluid" style="width:100%;display:block;float:none;margin-left:auto;margin-right:auto;background-color:white;padding:0pt;margin:0pt">

        <div class="span26 clearfix"   style="width:100%;padding-bottom:30px;margin:0 auto;background-color:#ecece;">
		    <div id="content" style="width:60%;margin-top:0px;margin-left:15%;margin-right:auto;padding:20pt 10pt 0pt 0pt;display:block;float:left">
                <?php echo $content; ?>
                <div style="clear:both;padding:30px 0px 30px 0px"><p><?php echo $navigation; ?></p></div>
            </div> 

            <div id="men" class="p" role="navigation" style="padding:70px 10px 200px 10px;display:block;float:right;width:22%;" >
	            <!-- <a href="#menu" class="menu-link" style="color:#000;position:relative;top:0px;left:0px;z-index:10000;font-weight:bold;padding:5px;margin:-20px">&nbsp; &#9776;  <?php echo $web_name ?>&nbsp; </a> -->
                <?php
			        echo $countrymenu; 
			        //create menu automatically needs to come from model/controller			
		        ?>
		        <?php
			    //echo $list;
		        ?>
            </div>
			
            <div class="center" style="margin-top:50px">
				<div class="btn-toolbar pull-right" style="margin-right:25px">
					<div class="btn-group">
                         <?php echo '<a class="btn btn-inverse btn-small" href="'.site_url().'adminSTAMPS/post/edit/'.$portal.'/'.$location.'/'.$title.'">edit </a>';?>
					</div>		
				</div>	
            </div>
		</div>
		
		<!-- Start: Left Menu need to add icons-->
		<!--<div class="pull-left" style="width:23%;margin-right:0%;margin-top:30px;margin-left:0px;padding:0px">
		    <div style="border:1px solid gold">
		        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs" style="margin-left:0px;padding:0">
				    <li class="active"><a href="#green" data-toggle="tab" style="font-size:10px"><i class="icon-fire pull-right"></i>Stamps</a></li>
				    <li><a href="#red" data-toggle="tab" style="font-size:11px">Postal Hist.</a></li>
				    <li><a href="#postal" data-toggle="tab" style="font-size:11px">Station.</a></li>
		        </ul>
		
		        <div id="my-tab-content" class="tab-content">
		            <div class="tab-pane active" id="green" style="padding-left:0px">
		                <?php //echo $countrymenu; ?>
		            </div>	
		
		            <div class="tab-pane" id="red">
        	            <ul style="list-style-type: none;margin-left:0px;">
			                <?php 
                            /*if ((isset($list)) && (!empty($list)) ) {
			                    foreach ($list as $key=>$value)
                                {
				                    $value=str_replace( '.dat', '', $value );
				                    $value=str_replace( FCPATH, '', $value );//check this.
				                    $value=str_replace('/'.$portal.'/'.$location.'/', '', $value );
				                    $this->load->helper('inflector');
				                    echo '<li><a style="padding-left:3px" href="'.$value.'">'.ucfirst(r('_',' ',$value)).'</a></li>';
				                }
			                }*/
			                ?>
                        </ul>
                    </div>
                </div>
           </div><!-- side menu container for toggle -->
		</div>-->
</div> <!-- Content -->
            
<!-- Start: footer -->
<div class="row-fluid" style="margin-top:0px;background:#fff"> 
	<div>
		<img src="<?php echo site_url(); ?>/img/spacer-bottom.jpg" />
	</div>	 
    <p style="font-size:0.7em;line-height:1.3;text-align:center" >
            Footer and copyright information.
    </p>
    <p style="float:none;margin:0 auto;font-size:11px;text-align:center">Data Policy |
            Accessibility | Contact Info | Privacy Policy |
        Copyright
	</p>
</div>
<footer>Testing a fixed footer with flexbox</footer>

<!-- Hidden menu modals -->
<!----- NEW DOCUMENT MODAL FORM --->
<div id="newdocModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="newDocForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/newdoc/<?php echo $portal.'/'.$location.'/'.$title;?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h3 id="myModalLabel">New Document</h3>
            New document name
            <input class="newdoc" id="newdoc" name="newdoc" type="text">
        </div>
        <div class="modal-body">
            <p>Enter the new document (folder) name. The system will create all the necessary directories and you will be re-directed to the new document.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-submit" type="submit"> <i class="icon-chevron-sign-right"></i> Submit</button>
	        <button class="btn cancel" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i> Cancel</button>
        </div>
    </form>
</div>
<!-- New document -->

<!-- Clone Doc Modal -->
<div id="clonedocModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="cloneDocForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/clonedoc/<?php echo$portal.'/'.$location.'/'.$title;?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h3 id="myModalLabel">Clone Document</h3>
            Name of cloned document
            <input class="clonedoc" id="clonedoc" name="clonedoc" type="text">
        </div>
        <div class="modal-body">
            <p>One fine body</p>
        </div>
        <div class="modal-footer">
            <button class="btn-submit" type="submit" width="13px">Submit</button>
        </div>
    </form>
</div>

<!-- This is the modal for renaming a document -->
<div id="renamedocModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="renameDocForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/renamedoc/<?php echo $portal.'/'.$location.'/'.$title;?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h3 id="myModalLabel">Rename this Page</h3>
            <p>New page name</p>
            <input  id="newdocname" name="newdocname" type="text">
        </div>
        <div class="modal-body">
            <p>Renaming of the page (old page name will not be available any longer)</p>
        </div>
        <div class="modal-footer">
            <button class="btn-submit" type="submit" width="13px">Submit</button>
        </div>
    </form>
</div>

<!-- This is the modal for renaming a portal -->
<div id="renameportalModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="renameportalForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/renameportal/<?php echo $portal.'/'.$location.'/'.$title;?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h3 id="myModalLabel">Rename this Page</h3>
            <p>New page name</p>
            <input id="renameportalname" name="renameportalname" type="text">
        </div>
        <div class="modal-body">
            <p>Renaming of the portal (old p name will not be available any longer)</p>
        </div>
        <div class="modal-footer">
            <button class="btn-submit" type="submit" width="13px">Submit</button>
        </div>
    </form>
</div>

<!-- New document -->

<!--  Top navigation Menus -->
<script type="text/javascript">
$(document).ready(function(){
    //$('#nav_inner').toggle();
    // loads the menu using Ajax
    // simple loading no tests
     $('.nav-img').click(function() {
        $('#nav_inner').toggle(); 
        $('#nav_inner2').hide(); 
        //var h= $('.menu-column').eq(0);
        //h1=h.css('height');
        // change to capture highest
        // to refactor later
        //$('.menu-column').css('height',h1);
        //return false;
    });
    
    // on click closes hidden menu
    $('#nav_inner').click(function(){
        $(this).toggle();  
    });
    $('#nav_inner2').load('<?php echo site_url(); ?>/js/portals_menu.html');
    $('#nav_inner').load('<?php echo site_url(); ?>/js/countries_menu.html');//.hide(); //<!-- change to jquery menu-->
    // load the content for the second menu
   
    // load the countries sidemenu and hide
    $('#sidemenu').load('<?php echo site_url(); ?>/js/countries_sidemenu.html');
    // opens the new document panel

    // we hide the menus by manipulating their heights
    // less problems with css
    $('#nav-img2').<?php echo $nav_button2;?>click(function() {
        $('#nav_inner2').toggle();
        $('#nav_inner').hide();
        //var h= $('.menu-column').eq(0);
        //h1=h.css('height');
        // change to capture highest
        // to refactor later
        //$('.menu-column').css('height',h1);
        //return false;
    });
    // on click closes hidden menu
    $('#nav_inner2').click(function(){
        $(this).toggle();
    });

    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });
    
    //misc
    $("a").tooltip({
        'selector': '',
    });
});

$(document).ready(function(){
	//Examples of how to assign the ColorBox event to elements
	$(".group1").colorbox({rel:'group1',maxWidth:"98%",current:false});
	$(".group2").colorbox({rel:'group2', transition:"fade"});
	$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
	$(".group4").colorbox({rel:'group4', slideshow:true});
	$(".ajax").colorbox();
	$(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
	$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	$(".inline").colorbox({inline:true, width:"50%"});
	$(".callbacks").colorbox({
		onOpen:function(){ alert('onOpen: colorbox is about to open'); },
		onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
		onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
		onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
		onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
	});
	
	//Example of preserving a JavaScript event for inline calls.
	$("#click").click(function(){ 
		$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
		return false;
	});
});

 // closes the colorbox onclicking onto it. There is no build-in functionality for this                       
$('.group1').colorbox({onComplete:function(){
    $('.cboxPhoto').unbind().click($.colorbox.close);
}})
</script>
  
<script>
 (function($){
	$.fn.numberHeadings = function(){
		this.each(function(){
			var values = new Array(0, 0, 0, 0, 0, 0);
			var context = $(this);
			context.find('h1,h2,h3').each(function(){ //h4,h5,h6
				var level = parseInt(this.nodeName.replace(/h/i, ''));
				values[level - 1]++;

				//Create prefix
				var prefix = '';

				for(var l = 0; l < level; l++){
					prefix += values[l] + '.';
				}

				//Set prefix
				this.innerHTML = prefix + ' ' + this.innerHTML;
				for(var l = level; l < 6; l++){
					values[l] = 0;
				}
			});
		});
	}
})(jQuery); 

$(document).ready(function(){
    var numbering = <?php echo $number_headings?>;
	if (numbering) $('#main-content').numberHeadings();
	
	$('body').flowtype();
	$('body').flowtype({
		minimum   : 300,
		maximum   : 900,
		minFont   : 10,
		maxFont   : 16,
		fontRatio : 30,
		lineRatio : 1.3
    });
});
</script> 


<script>
//Save accordion state on side menus
$(document).ready(function() {
    var last=$.cookie('activeAccordionGroup');
    if (last!=null) {
        //remove default collapse settings
        $("#accordion2 .collapse").removeClass('in');
        //show the last visible group
        $("#"+last).collapse("show");
    }
});

//when a group is shown, save it as the active accordion group
$("#accordion2").bind('shown', function() {
    var active = $("#accordion2 .in").attr('id');
	
    $.cookie('activeAccordionGroup', active);
	$.cookie('test','page3');
	//alert($.cookie('test'));
});

</script>
       
<script type="text/javascript" src=<?php echo $mathjaxurl?> >
MathJax.Hub.Config({
extensions: ["tex2jax.js","TeX/AMSmath.js","TeX/AMSsymbols.js"],
jax: ["input/TeX", "output/HTML-CSS"],
tex2jax: {
    inlineMath: [  ["\\(","\\)"] ],
    displayMath: [ ["\\[","\\]"] ],
    processEnvironments: true,
	preview: "TeX",
	ignoreClass: "tex2jax_ignore|no-mathjax",
	autoNumber: "all",
	
},
TeX: { equationNumbers: { autoNumber: "all" } },
"HTML-CSS": { availableFonts: ["TeX"] }
});

MathJax.Hub.Queue(function(){
MathJax.Menu.menu.getItemByName("Settings").menu.addItemFirst(
        MathJax.Menu.ITEM.COMMAND("test",function(){alert("Hello World!");}));
MathJax.Menu.menu.disableItemByName("MathJax Help");
});

</script>
<!--script type="text/javaScript" src="<?php echo site_url(); ?>js/highlighter.js"></script>-->
<link rel="stylesheet" href="http://yandex.st/highlightjs/8.0/styles/default.min.css">
<script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/jslint.js"></script>
<script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/tokens.js"></script>
<script defer="true" type="text/jacascript"   src="<?php echo site_url(); ?>js/parse.js"></script>
<script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/json2.js"></script>
<script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/cookies.js"></script>
<script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/bigSlide.js"></script>
<script>
$(document).ready(function() {
    $('.menu-link').bigSlide();
});
	
</script>	

</body>
</html>
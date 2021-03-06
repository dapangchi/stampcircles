<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
  <meta http-equiv="Content-Language" content="mul">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory
       Chrome only shows it in tab (by design) only for htpps shows 
  -->
  
  
  <!--
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/typography.css">
  -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/userguide.css">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/smoothness/jquery-ui-1.7.1.custom.css">
  
  
  <!--<link rel="Stylesheet" href="<?php echo site_url(); ?>css/forms.css?">-->
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/navigation.css?">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/bootstrap.css">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/application.css?">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/codeblocks.css?">
  <!--<link rel="stylesheet" href= "<?php echo site_url(); ?>css/screen.css" type="text/css">-->
	<link rel="Stylesheet" href="<?php echo site_url(); ?>css/bibtex.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
   
  
  
  <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.js">
           
       
  </script>
  <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.form.js" />
  <script  type="text/javascript" src="<?php echo site_url(); ?>js/formatter.js" ></script>
 
 

        <!-- best way -->
        
       <!--<script src="http://code.jquery.com/jquery-1.4a2.js"></script>-->
       <script type="text/javascript" src="<?php echo site_url(); ?>js/jquery-ui-1.7.1.custom.min.js"></script> 
      
        <script type="text/javascript" src="<?php echo site_url(); ?>js/goog/base.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>js/goog/deps.js"></script>
       <script type="text/javascript" src="<?php echo site_url(); ?>js/goog/dom/annotate.js"></script>
       

        <script  type="text/javascript" src="<?php echo site_url(); ?>js/U.js"></script>
        <script type="text/javaScript" src="<?php echo site_url(); ?>js/stamps.js"></script>
        <script type="text/javaScript" src="<?php echo site_url(); ?>js/highlighter.js"></script>

      
       <script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/tokens.js"></script>
       <script defer="true" type="text/jacascript"   src="<?php echo site_url(); ?>js/parse.js"></script>
       <script defer="true" type="text/javascript" src="<?php echo site_url(); ?>js/json2.js"></script>
      
       
        
       <script type="text/javascript" src="<?php echo site_url(); ?>js/bootstrap.js"></script>
      
<script type="text/javascript" src="<?php echo site_url(); ?>js/colorbox/colorbox-master/jquery.colorbox.js"></script>
<link rel="Stylesheet" href="<?php echo site_url(); ?>js/colorbox/colorbox-master/example1/colorbox.css">
<!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
       


        <meta name="author" content="Y Lazarides" />
        <meta name="copyright" content="Dr Y Lazarides" />
        <meta name="robots" content="all" />
        <meta name="imagetoolbar" content="no" />
        <meta name="keywords" content="<?php //echo $keywords;  ?>" />
        <meta name="description" content="Stamps and Postal History" />
        
 </head>


<body style="background:url('<?php echo site_url(); ?>/images/body_bg.gif');width:95%;margin:0 auto">
<!-- Some modal forms -->

<!-- css in userguide -->
	<div class="container clearfix" style="border-top:0px solid #000000;width:100%;margin:0 auto">
<!-- START NAVIGATION TOP HIDDEN -->
	<div id="nav">
		<div  class="nav_inner  clearfix hidden" >
        <!-- hidden menu goes here -->
		</div>
		<div id="nav_inner2" class="clearfix hidden" >
        <!-- hidden menu2  goes here -->
		</div>
	</div> <!-- end hidden menu -->

	<!-- Has black bar on top -->
	<div id="nav2" class="clearfix" style="margin-right:0;padding-right:25px;" >
    
    <!-- button group  -->
		<div   class="btn-toolbar pull-right" style="margin-top:-0px;padding-right:0px;">
        <div class="btn-group" style="text-align:left">
            <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">Table of Contents <span class="caret"></span></button>
            <ul class="dropdown-menu hidden">
                <li><a id="nav-img" href="#"> All Countries  </a></li>
                <li><a id="nav-img2" href="#">System </a></li>
                <li><a>Test </a></li>
            </ul>
        </div><!-- /btn-group -->
		</div><!-- /btn-toolbar -->
	</div>
           
	<!-- end TOC Button row  -->
	<!-- top head site name  -->
	<div class="row-fluid" style="background:#fff;width:100%;">
        <div  style="margin-bottom:0;margin-top:0px;padding-top:25px">
            <div  style="margin-top:0;">
                        <span style="display:block;font-family:arial;color:rgb(188,29,29);color:#8C8273;font-size:36px;line-height:1.3;padding-left:25px" class="sitename">
                    <?php echo $web_name ?>
			</div>
					<!-- Insert other button if required
                    <ul id="menu">
                        <li class="active">
                        <a  href="<?php echo site_url(); ?>/index.php/blogs/stamps/blog/home">Home</a></li>
                        <li class="active" style="background-color:rgb(188,29,29);">
                        <a style="color:#fff" href="<?php echo site_url(); ?>/index.php/blogs/tutorials/jQuery/Introduction">Notes</a></li>
                        <li class="active" ><a  href="site_url()blogs/stamps/<?php echo$portal?>/general/introduction">Blog</a></li>
                        <li class="active"><a href="<?php echo site_url(); ?>/auth/login/">Login</a></li>
                    </ul>
					-->
        </div>
	</div>
    	
    <div class="row-fluid" style="background:#fff;">
                <!-- button group  -->
		<img src="<?php echo site_url(); ?>/img/spacer.jpg" />
        <div><!--<?php echo $msg;?>--></div>
        <div class="btn-toolbar pull-right" style="margin-right:25px">
            <div class="btn-group" >
                <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">Portals <span class="caret"></span></button>
                <ul class="dropdown-menu hidden">
                    <li><?php echo '<a data-toggle="modal" href="#newdocModal" class="" title="Think of a Portal as a book"><i class="icon-file-alt"></i> New Portal</a>';?> </li>
                    <li><?php echo '<a data-toggle="modal" href="#clonedocModal" class=""><i class="icon-copy"></i> Clone Portal</a>';?> </li>
                    <li><?php echo '<a data-toggle="modal" href="#renameportalModal" class=""><i class="icon-edit"></i> Rename Portal</a>'; ?></li>
                    <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/deletedocument/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-trash" style="color:red"></i> Delete Portal </a>'; ?> </li>
                    <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/deletedocument/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-gear"></i> Portal Settings </a>'; ?> </li>
                    <li class="divider"></li>
                    <li><?php echo '<a href="site_url()'.'adminSTAMPS/post/zip/'.$location.'/'.$title.'"><i class="icon-long-arrow-down"></i> Export as .zip</a>'; ?> </li>
                        
                </ul>
            </div><!-- /btn-group --> 
			<!-- second button group -->
            <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown">Document <span class="caret"></span></button>
                    <ul class="dropdown-menu hidden">
                        <li><?php echo '<a data-toggle="modal" href="#newdocModal" class=""><i class="icon-file-alt"></i> New Document</a>';?> </li>
                        <li><?php echo '<a data-toggle="modal" href="#clonedocModal" class=""><i class="icon-copy"></i> Clone Document</a>';?> </li>
                        <li><?php echo '<a data-toggle="modal" href="#renameportalModal" class=""><i class="icon-copy"></i> Rename Document </a>'; ?></li>
                        <li><?php echo '<a href="'.site_url().'adminSTAMPS/post/deletedocument/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-trash" style="color:red"></i> Delete Document </a>'; ?> </li>
                        <li class="divider"></li>
						<li><?php echo '<a href="'.site_url().'adminSTAMPS/post/edit/'.$portal.'/'.$location.'/main"><i class="icon-edit"></i> Edit Main TeX File </a> ';?></li>
						<li><?php echo '<a target="_blank" href="'.site_url().'/sandboxPDF/pdflatex/'.$portal.'/'.$location.'/main?='.time().'"><i class="icon-book"></i> Texify Document</a>';?> </li>
                        <li class="divider"></li> 
  						<li><?php echo '<a href="'.site_url().'adminSTAMPS/menu/edit/'.$portal.'/'.$location.'/'.$title.'"><i class="icon-edit"></i> Edit side menu </a>'; ?> </li>
                          
                        <li class="divider"></li>                            
						<li><?php echo '<a href="'.site_url().'adminSTAMPS/post/zip/'.$location.'/'.$title.'"><i class="icon-bolt"></i> Export as .zip</a>'; ?> </li>
                         
                    </ul>
            </div><!-- /btn-group -->

            <div class="btn-group">
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
        </div><!-- /btn-toolbar -->
                    <!-- end button group -->
    </div>
    <!-- END NAVIGATION -->

           
	<!-- CONTENT ROW -->		
    
    <div class="row-fluid" style="display:block;float:none;margin:0 auto;background-color:white">
        <!-- Start: Left Menu -->
		<!--
        <div class="span1" style="width:0px;">
        	<?php/*
			echo $countrymenu; //country specific menu TO FIX STYLE
			//create menu automatically needs to come from model/controller
			echo '<ul  style="list-style-type: none;margin-left:0px;">';
			if ((isset($list)) && (!empty($list)) ) {
			foreach ($list as $key=>$value){
				$value=str_replace( '.dat', '', $value );
				$value=str_replace( FCPATH, '', $value );//check this.
				$value=str_replace('/'.$portal.'/'.$location.'/', '', $value );
				$this->load->helper('inflector');
				echo '<li><a style="padding-left:3px" href="'.$value.'">'.ucfirst(r('_',' ',$value)).'</a></li>';
				}
			}
			echo '</ul>';
			**/?>
		</div>
		-->
 

        <div  class="span12 center" style="padding-bottom:30px;padding:15px">
            <?php echo $content; ?>
                                               
			                     
            <div class="pull-right" style="margin-top:50px">
				<div class="btn-toolbar pull-right" style="margin-right:25px">
					<div class="btn-group">
                         <?php echo '<a class="btn btn-inverse btn-small" href="'.site_url().'adminSTAMPS/post/edit/'.$portal.'/'.$location.'/'.$title.'">edit </a>';
                            
                            
                            ?>
					</div>		
				</div>	
            </div>
		</div>
	</div> <!-- Content -->
            <!-- Start: footer -->
    
    <div class="row-fluid" style="margin-top:0px;background:#fff">
				 
			<div>
				<img src="<?php echo site_url(); ?>/img/spacer-bottom.jpg" />
			</div>	 
            <p style="line-height:1.3;text-align:center" >
                    This site does not claim ownership of any of the pictures displayed unless otherwise stated.
                    The tag is there only to show that the picture was originally posted here or scanned or
                    capped exclusively for this site. All pictures are copyright to their respective owner.
                    No infringement intended. We believe we are using these images for educational purposes only,
                    within the laws of the Fair Use Copyright Law 107. However, if you are unhappy with our usage
                    of pictures that belong to you, please contact us and we will remove the image(s)
                    immediately. We will always co-operate, there is no need to threaten us. Please,
                    credit the site when reposting the images you found here and or original owners.
                    And download pictures for private usage only!
                    Rest of Content &copy; Dr Y.Lazarides +46 (0) 738 -19 15 03 egypt (a) latenightengineer.com
            </p>
            <p style="float:none;margin:0 auto;font-size:11px;text-align:center">Data Policy |
                    Accessibility | Contact Info | Privacy Policy |
                Copyright
			</p>
    </div>


    
		
     

<!-- Hidden menu modals -->
<!----- NEW DOCUMENT MODAL FORM --->
<div id="newdocModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<form id="newDocForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/newdoc/<?php echo $portal.'/'.$location.'/'.$title;?>">
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal"></button>
 <h3 id="myModalLabel">New Document</h3>
New document name
<?php echo '<input class="newdoc" id="newdoc" name="newdoc" type="text">'?>
</div>
<div class="modal-body">
    <p>Enter the new document (folder) name. The system will create all
       the necessary directories and you will be re-directed to the new document.</p>
</div>
<div class="modal-footer">
	<?php echo '<button class="btn btn-primary btn-submit" type="submit"> <i class="icon-chevron-sign-right"></i> Submit</button>';?>
	<button class="btn cancel" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i> Cancel</button>
	
  </div>
</form>
</div>
<!-- New document -->

<!-- Clone Doc Modal -->
<div id="clonedocModal" class="modal hide" tabindex="-1"
          role="dialog" aria-labelledby="myModalLabel">
  <form id="cloneDocForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/clonedoc/<?php echo$portal.'/'.$location.'/'.$title;?>">
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal"></button>
<h3 id="myModalLabel">Clone Document</h3>
Name of cloned document
<?php echo '<input class="clonedoc" id="clonedoc" name="clonedoc" type="text">'?>
</div>
<div class="modal-body">
    <p>One fine body</p>
</div>
<div class="modal-footer">
   <?php echo '<button class="btn-submit" type="submit" width="13px">Submit</button>';?>
 <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  <button class="btn btn-primary">Save changes</button> -->
  </div>
  </form>
</div>

<!-- This is the modal for renaming a document -->
<div id="renamedocModal" class="modal hide" tabindex="-1"
          role="dialog" aria-labelledby="myModalLabel">
  <form id="renameDocForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/renamedoc/<?php echo $portal.'/'.$location.'/'.$title;?>">
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal"></button>
<h3 id="myModalLabel">Rename this Page</h3>
<p>New page name</p>
<?php echo '<input  id="newdocname" name="newdocname" type="text">'?>
</div>
<div class="modal-body">
    <p>Renaming of the page (old page name will not be available any longer)</p>
</div>
<div class="modal-footer">
   <?php echo '<button class="btn-submit" type="submit" width="13px">Submit</button>';?>
 <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  <button class="btn btn-primary">Save changes</button> -->
  </div>
  </form>
</div>

<!-- This is the modal for renaming a portal -->
<div id="renameportalModal" class="modal hide" tabindex="-1"
          role="dialog" aria-labelledby="myModalLabel">
  <form id="renameportalForm" method="post" action="<?php echo site_url(); ?>/adminSTAMPS/post/renameportal/<?php echo $portal.'/'.$location.'/'.$title;?>">
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal"></button>
<h3 id="myModalLabel">Rename this Page</h3>
<p>New page name</p>
<?php echo '<input  id="renameportalname" name="renameportalname" type="text">'?>
</div>
<div class="modal-body">
    <p>Renaming of the portal (old p name will not be available any longer)</p>
</div>
<div class="modal-footer">
   <?php echo '<button class="btn-submit" type="submit" width="13px">Submit</button>';?>
 <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  <button class="btn btn-primary">Save changes</button> -->
  </div>
  </form>
</div>

<!-- New document -->

</body>


<script type="text/javascript" src=<?php echo $mathjaxurl?> >
MathJax.Hub.Config({
extensions: ["tex2jax.js","TeX/AMSmath.js","TeX/AMSsymbols.js"],
jax: ["input/TeX", "output/HTML-CSS"],
tex2jax: {
inlineMath: [  ["\\(","\\)"] ],
displayMath: [ ["\\[","\\]"] ]
},
"HTML-CSS": { availableFonts: ["TeX"] }
});
</script>

<!--  Top navigation Menus         -->
<script type="text/javascript">
$(document).ready(function(){
    //$('#nav_inner').toggle();
    // loads the menu using Ajax
    // simple loading no tests
     $('#nav-img').click(function() {
        $('.nav_inner').toggle();
        var h= $('.menu-column').eq(0);
        h1=h.css('height');
        // change to capture highest
        // to refactor later
        $('.menu-column').css('height',h1);
        return false;
    });
    // on click closes hidden menu
    $('.nav_inner').click(function(){
        $(this).toggle();
    });
    $('#nav_inner2').load('<?php echo site_url(); ?>/js/portals_menu.html');
    $('.nav_inner').load('<?php echo site_url(); ?>/js/<?php echo "countries_menu.html"?>'); //<!-- change to jquery menu-->
    // load the content for the second menu
   
    // load the countries sidemenu and hide
    $('#sidemenu').load('<?php echo site_url(); ?>/js/countries_sidemenu.html');
    // opens the new document panel


   
  // we hide the menus by manipulating their heights
  // less problems with css
   $('#nav-img2').<?php echo$nav_button2;?>click(function() {
        $('#nav_inner2').toggle();
        var h= $('.menu-column').eq(0);
        h1=h.css('height');
        // change to capture highest
        // to refactor later
        $('.menu-column').css('height',h1);
        return false;
    });
   // on click closes hidden menu
    $('#nav_inner2').click(function(){
        $(this).toggle();
    });
   

});

        $(document).ready(function(){
            //Examples of how to assign the ColorBox event to elements
            //$("a[rel='example1']").colorbox();
           

    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
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
    // tooltips for citations and notes
    $(document).ready(function () {
        $("a").tooltip({
            'selector': '',
            
        });
    });
    
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
});

</script> 
</html>

























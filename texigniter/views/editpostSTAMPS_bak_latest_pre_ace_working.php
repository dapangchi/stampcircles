<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Language" content="mul">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $title;  ?></title>
  <!--<link rel="stylesheet" href= "<?php echo site_url(); ?>css/screen.css" type="text/css">-->
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/userguide.css">
	<!-- <link rel="stylesheet" href="<?php echo site_url(); ?>css/typography.css"> -->
    <link rel="Stylesheet" href="<?php echo site_url(); ?>css/smoothness/jquery-ui-1.7.1.custom.css">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/bootstrap.css?">
  
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/boxes.css?">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/codeblocks.css?">
<!--  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/forms.css?"> -->
<!--  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/navigation.css?"> -->
<!--   <link rel="Stylesheet" href="<?php echo site_url(); ?>css/application.css?"> -->

    <meta name="author" content="Y Lazarides" />
    <meta name="copyright" content="Dr Y Lazarides" />
    <meta name="robots" content="all" />
    <meta name="imagetoolbar" content="no" />
    <meta name="keywords" content="keyword1,keyword2,keyword3" />
    <meta name="description" content="An automatic website builder" />

    <!-- Styles -->

    


    <!-- best way
    <link rel="stylesheet" href="<?php echo site_url(); ?>/js/codemirror/codemirror/lib/codemirror.css">
    <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/lib/codemirror.js?"></script>
    <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/stex/stex.js?"></script>
    <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/xml/xml.js?"></script>
    <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/javascript/javascript.js?"></script>
    <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/htmlmixed/htmlmixed.js?"></script>
    <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/css/css.js?"></script>
<!--   
   <link rel="stylesheet" href="<?php echo site_url(); ?>/js/CodeMirror/codemirror/theme/default.css?">
    <link rel="stylesheet" href="<?php echo site_url(); ?>/js/codemirror/codemirror/css/docs.css?">
-->    
    <!-- We load jquery, jquery-Ui and bootstrap from CDNs Must default to local -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
   
 
 <!-- Latest compiled and minified JavaScript -->
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
 
 
 
 
 <style>
 .CodeMirror {
  overflow-y: auto;
  overflow-x: scroll;
  width: 900px;
  height: 800px;
  line-height: 1em;
  font-family: monospace;
  
}
 </style>
 <style type="text/css" media="screen">
    #editor { 
        position: relative;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
</head> 


<body  style="background-color:#ffffff;margin:0 auto;padding-top:0px;width:98%">

	<div class="container clearfix" style="width:100%">
    <!-- Start: Navigation Top Hidden -->
		<div id="nav">
			<div id="nav_inner" class="clearfix nopad hidden bordered">
                   <!-- hidden menu goes here -->
			</div>
		</div>
		<!-- end hidden menu -->
		<div id="nav2" class="clearfix" style="margin-right:0;padding-right:70px;">
			<!-- button group  -->
			<div  class="btn-toolbar pull-right" style="margin-top:-0px;">
				<div class="btn-group" style="padding-right:0px;text-align:left">
					<button class="btn btn-inverse dropdown-toggle btn-small hidden" data-toggle="dropdown">Table of Contents <span class="caret"></span></button>
					<ul class="dropdown-menu hidden">
						<li><a id="nav-img" href="#"> All Countries  </a></li>
						<li><a id="nav-img2" href="#">System </a></li>
						<li><a>Test </a></li>
					</ul>
				</div><!-- /btn-group -->

			</div><!-- /btn-toolbar -->          
		</div>
    
    
    
		<div class="row-fluid span12">    
			<h4 class="span12">
			<span  style="font-family:arial;color:rgb(188,29,29);">
						<?php echo 'StampNotes' ?>
			</span>
			</h4>
                           
		

			<div>
				<img src="<?php echo site_url(); ?>/images/spacer.jpg" />
			</div>
		</div>
	</div>	
 <!-- END NAVIGATION -->



	
        

<!-- Start: Page Content -->
	<div id"page-contents" class="row-fluid">
         
		

		 
		<!-- beginning of form -->
		<form id="mainForm" method="post" 
		          action="<?php echo site_url(); ?>/adminSTAMPS/post/save/<?php echo
						$portal.'/'?><?php echo $location.'/'.$title  ?>" >
			<div class="row-fluid span12">
			
			<!--<label class="span1 pull-left">Title</label>-->
				<input class="pull-left" type="text"  value="<?php echo $title ?>" name="title" style="width:70%;" />
				<input type="submit" name="mysubmit" value="Save" class="btn  btn-primary pull-left" style="margin-left:30pt"/>
			</div>
		   
			<div id="editor" style="width:500px;height:500px"><?php echo $content; ?></div>
    
		<script src="<?php echo site_url(); ?>/js/ace/ace-builds-master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
		<script>
			var editor = ace.edit("editor");
			editor.setTheme("<?php echo site_url(); ?>/js//ace/theme/monokai");
			editor.getSession().setMode("<?php echo site_url(); ?>/js//ace/mode/javascript");
			//alert('ok');
		</script>
			
			
			
			
			<!-- TABS CONTAINER-->
			<div class="row-fluid span12" style="margin:0;padding:0;">
				<div id="maintabs">
					<ul>
					<li><a href="#tabs-1">Post</a></li>
					<li><a href="#tabs-2">Local CSS</a></li>
					<li><a href="#tabs-3">Code</a></li>
					<li><a href="#tabs-4">Screen CSS</a></li>
					<li><a href="#tabs-5">TeX Preamble</a></li>
					<li><a href="#tabs-6" >Doc Settings</a></li>
					<!--<li><a href="#tabs-5">Comments</a></li>-->
					</ul>
		
				<!-- Here we add the tabs for the editor  -->
				<!-- Post -->
				<div id="tabs-1" class="tabp">
 				<textarea id="main-edit1" style="width:800px;height:800px" class="row-fluid span12" name="content"><?php echo $content; ?>
				</textarea>
		
				</div> <!-- tabs-1 Post Edit -->

			<script>
				//var editor = CodeMirror.fromTextArea(document.getElementById("main-edit"),
					//{ lineNumbers: true,
					//	mode: "text/x-stex",
					//	lineWrapping:true
					//}).refresh();
					// disable in post
			</script>


			<div id="tabs-2">
			<!-- save button -->
				<button id="saveAsLocalCSS" type="submit" class="btn btn-inverse btn-small pull-right">
					Save as Local CSS
				</button>

				<textarea id="localCSSCode" name="localCSSCode" >
					.CodeMirror-scrolls {
					height: auto;
					overflow-y: hidden;
					overflow-x: auto;
					}
				</textarea>
			</div>

			<div id="tabs-3">
				<div id="JSContainer" style="color:red;text-decoration:underline;width:100px;float:right">
				<span id="saveAsJS" class="bordered" style="cursor:pointer;">Save as Local CSS</span>
				</div>
			
				<textarea id="code1" name="code1" style="font-size:12px;height:1500px">
				.CodeMirror-scroll {
				height: 800px;
				overflow-y: hidden;
				overflow-x: auto;

				}</textarea>
		
				<script>
				var editor2 = CodeMirror.fromTextArea(document.getElementById("code1"), {
				lineNumbers: true,
				mode: "text/html"
				}).refresh();

				</script>
			</div> <!-- end tab-3-->
			<!-- tabs 4 -->
			<div id="tabs-4" style="font-size:12px">
   
				<div id="cssSubmitContainer" style="color:red;text-decoration:underline;width:100px;float:right">
				<span id="saveAsCSS" class="bordered" style="cursor:pointer;">Save CSS</span></div>
				<hr/>
				<textarea id="code2" name="code2" style="font-size:12px;">

				</textarea>
			</div>


			<!-- tabs 5 -->

			<div id="tabs-5" style="font-size:12px">

				<div id="texSubmitContainer" style="color:red;text-decoration:underline;width:100px;float:right">
				<span id="savePreamble" class="bordered" style="cursor:pointer;">Save preamble</span></div>
				<hr/>
				<textarea id="code3" name="code3" style="font-size:12px;height:900px!important;"><?php echo$texcontent;?>
				</textarea>
				<!--
				<script>
				var editor = CodeMirror.fromTextArea(document.getElementById("code3"),
				{lineNumbers: true,
				mode: "text/x-stex",
				lineWrapping:true
			}).refresh();

			</script>
			-->
			</div>

			<!-- These tabs save the Document .ini file -->
			<div id="tabs-6" style="font-size:12px;">
				<input type="text"  value="<?php echo $title ?>" name="title" style="width:98%;margin-bottom:18px;font-family:georgia;font-size:16px" />
				<div style="width:98%"></div>
				<button id="saveDocumentSettings" type="submit" class="btn btn-small btn-primary pull-right"> 
					Save Settings.
				</button>
   
				<textarea id="code4" name="code4" style="font-size:12px;height:900px!important;width:800px}"><?php echo$documentsettings;?>
				</textarea>

				<script>
					var editor4 = CodeMirror.fromTextArea(document.getElementById("code4"),
				{lineNumbers: true,
				mode: "text/javascript",
					lineWrapping:true
				}).refresh();

				</script>

			</div>


				</div><!-- end tabs-->
			</div><!-- tabs container -->


			<div class="row-fluid span12">

			<div class="span-5 clearfix" style="margin:0 0 0 15px;float:left">
                     

                        <label>categories</label>
                        <textarea name="category" rows="100" cols="100" style="width:90%;height:200px;font-family:georgia;font-size:12px;text-indent:0" >
							<?php echo trim($category) ?>
                        </textarea>


                        <label>Save As </label>
                        <input class="small_button" type="text" value="<?php echo $title ?>" name="save_as"
                              style="width:98%;font-family:georgia;font-size:12px" />
                        
                        <input style="color:red" type="submit" name="mysubmit" value="Save" />
			</div>
		
			</div><!--span12 -->
		</form>
    

			<div class="row-fluid span12" style="margin-top:0;padding-left:70px;padding-right:100px;padding-top:30px;padding-bottom:30px;background:#fff url(<?php echo site_url(); ?>/img/spacer-bottom.jpg) no-repeat;">
                <p style="width:98%;line-height:1.3;text-align:center" class="footer">
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
                Copyright</p>
            </div>
        
    </div>
</div>





<script type="text/javascript">
    $(document).ready(function(){
        //templates
        //make working panel everything is inserted
        //here
       

        
// tabs for jQuery


        $(function() {
		$( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
	    });
       // $(function() {
	//	$( "#tabs" ).draggable({ opacity: 0.35 });
	  //  });

$(function() {
		$( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
	});
$(function() {
		$( "#tabs" ).draggable({ opacity: 0.35 });
	});

$(function() {
		$( "#maintabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
	});
// sets tabs to same height
$("#maintabs div.ui-tabs-panel").css('height', $("#tabs-1").height());

// this works fine
$('#maintabs').bind('tabsshow', function(event, ui) {
    if (ui.panel.id == "tabs-1"){
        openPanel();
     }
     else{
      alert(ui.panel.id)
      closePanel();
      return false;
   }
});

});

  $("#code2").load('<?php echo site_url(); ?>/css/screen.css',callback).show();
    function callback(){
        var x=CodeMirror.fromTextArea(document.getElementById("code2"), {
            lineNumbers: true,
            autofocus:true
        });
        //CodeMirror.refresh();
    };
    
    $("#profile-css").load('<?php echo site_url(); ?>/css/screen.css',callback).show();
    function callback(){
        var x=CodeMirror.fromTextArea(document.getElementById("code2"), {
            lineNumbers: true,
            autofocus:true
        });
        //CodeMirror.refresh();
    };
</script>

<script>
     var x=CodeMirror.fromTextArea(document.getElementById("code3"), {
           lineNumbers: true,
           autofocus:true
        });


    //$("#code3").load('/tex-templates/preamble.tex', callback).show();
    //function callback(){
      //  var x=CodeMirror.fromTextArea(document.getElementById("code3"), {
        //    lineNumbers: true,
          //  autofocus:true
       // });
        //CodeMirror.refresh();
    //};
       //CodeMirror.refresh() call-back to be added;
</script>

<script type="text/javascript">

    // Main routine for saving files
   $('form#mainForm').submit(function(){
       var s=$(this).attr();
    });
       //return false;
 
   $('#saveAsCSS').click(function(){
       $(this).css({'color':'blue'});
       alert('button pressed');
       var url="<?php echo site_url(); ?>/adminSTAMPS/post/saveCSS/jQuery/screen_bak";
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });

   $('#saveAsLocalCSS').click(function(){
       $(this).css({'color':'blue'});
       //alert('button pressed');
       var url="<?php echo site_url(); ?>/adminSTAMPS/post/saveAsLocalCSS/jQuery/localCSS_bak";
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });

    $('#saveAsJS').click(function(){
       $(this).css({'color':'blue'});
       //alert('button pressed');
       var url="<?php echo site_url(); ?>/adminSTAMPS/post/saveAsJS/jQuery/js_bak";
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });

   // Saves the preamble in the tex-template directory.
   $('#savePreamble').click(function(){
       $(this).css({'color':'blue'});
       //alert('.. saving the preamble');
       var url="<?php echo site_url(); ?>/adminSTAMPS/post/savePreamble/<?php echo $location.'/'.$title  ?>";
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });

   $('#saveDocumentSettings').click(function(){
       //$(this).css({'color':'blue'});
       
       var url="<?php echo site_url(); ?>/adminSTAMPS/post/saveDocumentSettings/<?php echo $portal.'/'.$location.'/'.$title  ?>";
	   //alert('zzzz');
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });


//});

</script>




 <script>
    $(function() {
        $( ".draggable" ).draggable();
    });
    $(function() {
        $( ".droppable" ).droppable({
            drop: function( event, ui ) {
                $( this )
                    .addClass( "ui-state-highlight" )
                    .find( "p" )
                        .html( "Dropped!" );
            }
        });
    });
 </script>



 

</body>







</html>

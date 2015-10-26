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
 
 
 

 <style type="text/css" media="screen">
    body {
        padding-top: 50px; /* When using the navbar-top-fixed */
		background:#fafafa;
    }
    #editor { 
        position: relative;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
</head> 


<body>
<!-- The whole body is a form for convenience -->
<form id="mainForm" method="post" action="<?php echo site_url("adminSTAMPS/post/save/$portal/$location/$title"); ?>">
<!-- Fixed navigation on top -->						
<div class="navbar navbar-fixed-top" style="background-color:#000">
    <div class="navbar-inner">
    <div class="container">
				
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"> </span>
        <span class="icon-bar"> </span>
        <span class="icon-bar"> </span>
      </a>
      <a class="brand" href="#">TeXIgniter</a>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="active"><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
          <li><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
            </ul>
          </li>
	    </ul>
	  </div><!-- /.nav-collapse -->
		
	  <button class="btn btn-primary btn-large active" id="save-top">Save</button>
	  
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
<!-- End top fixed navigation  -->
    

<!-- Start: Page Content -->
	<div id"page-contents" class="row-fluid span12">
    	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
			<li class="active"><a href="#green" data-toggle="tab"><?php echo $title ?></a></li>
			<li><a href="#documentsettings" data-toggle="tab">Page Settings</a></li>
			<li><a href="#texsettings" data-toggle="tab">Tex Settings</a></li>
			<li><a href="#css" data-toggle="tab">Page CSS</a></li>
			<li><a href="#blue" data-toggle="tab">Page JS</a></li>
		</ul>
		<div id="my-tab-content" class="tab-content">
			<div class="tab-pane active" id="green">
		    <div id="editor" style="width:1000px;height:800px;margin-top:20px"><?php echo ($content);?></div>
			<textarea id="content" name="content" class="hidden"></textarea>
			</div>
		
		<div class="tab-pane" id="documentsettings">
            <div id="editor-settings" name="editor-settings" style="font-size:12px;height:900px!important;width:800px;"><?php echo$documentsettings;?></div>
			<textarea id="content-settings" name="content-settings" class="hidden"></textarea>
			
		</div>
		
		<div class="tab-pane" id="texsettings">
            <div id="tex-settings" name="tex-settings" style="font-size:12px;height:900px!important;width:800px;"><?php echo $texcontent;?></div>
			<textarea id="content-tex" name="content-tex" class="hidden"></textarea>
        </div>
		
        <div class="tab-pane" id="css">
            <textarea id="content-css" name="content-css" class="hidden">test stttt</textarea>
        </div>
		
        
		
		
		
		
    </div>

		
	<script src="<?php echo site_url('js/ace/ace-builds-master/src-noconflict/ace.js'); ?>" type="text/javascript" charset="utf-8"></script>
			
			<script>
			// activate tabs
			jQuery(document).ready(function ($) {
				$('#tabs').tab();
			
			// set up the editor themes
			var editor = ace.edit("editor");
				editor.setTheme("ace/theme/github");
				editor.getSession().setMode("ace/mode/latex");
				editor.session.setUseWrapMode(true);
				editor.session.setWrapLimitRange(90, 90);
				editor.renderer.setPrintMarginColumn(90);
				//editor.resize();
				
			var editor_settings = ace.edit("editor-settings");
				editor_settings.setTheme("ace/theme/github");
				editor_settings.getSession().setMode("ace/mode/ini");
				editor_settings.session.setUseWrapMode(true);
				editor_settings.session.setWrapLimitRange(90, 90);
				editor_settings.renderer.setPrintMarginColumn(90);
				//editor_settings.resize();
			
			
			var editor_tex = ace.edit("tex-settings");
				editor_tex.setTheme("ace/theme/monokai");
				editor_tex.getSession().setMode("ace/mode/latex");
				editor_tex.session.setUseWrapMode(true);
				editor_tex.session.setWrapLimitRange(90, 90);
				editor_tex.renderer.setPrintMarginColumn(90);
				editor_tex.resize();
				
			var editor_css = ace.edit("css");
				editor_css.setTheme("ace/theme/github");
				editor_css.getSession().setMode("ace/mode/ini");
				editor_css.session.setUseWrapMode(true);
				editor_css.session.setWrapLimitRange(90, 90);
				editor_css.renderer.setPrintMarginColumn(90);
				editor_css.resize();	
			//if activate show the target
			$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
			    //we capture the url target #document settings
				var pattern=/(#)(.*)/i //set a regex pattern (all the things after "#").
				var myString = e.target.toString();
				var arr = myString.match(pattern); //find pattern
					
				var contentID = arr[2]; //find pattern
								
				editorsave = arr[2]; 
				avalue = editor_tex.getValue();
								
				if (contentID === 'documentsettings') {
				   
					//alert(editorsave);
				}
				mainForm.action = '<?php echo site_url(); ?>/adminSTAMPS/post/'+contentID+'/<?php echo $portal.'/'?><?php echo $location.'/'.$title?>';
				
				});	
			
			
				
			
			$(function(){
			$('#save, #save-top, #save-bottom').click(function () {
			    var mysave = editor.getValue();
				    $('#content').val(mysave);
					//mysave = editor_settings = ace.edit("code4");
					//test=$('#code4').val(mysave);
					//alert(test);
				var avalue = editor_css.getValue();
				var settings_value = editor_settings.getValue();
					$('#content-css').val('TESTING');
				    $('textarea#content-settings').val(settings_value);
						var textarea = $('textarea[name="content-settings"]').hide();
						//editor_settings.getSession().setValue(textarea.val());
						editor_settings.getSession().on('change', function(){
							textarea.val(editor_settings.getSession().getValue());
						});
				// get tex settings from text area
				// get the value	
				var settings_tex = editor_tex.getValue();
					$('textarea#content-tex').val(settings_tex);
					var textarea = $('textarea[name="content-tex"]').hide();
						//editor_settings.getSession().setValue(textarea.val());
						editor_settings.getSession().on('change', function(){
							textarea.val(editor_tex.getSession().getValue());
						});	
					
					$('#mainForm').submit();
				});
				
				
			});	
			});//document ready
			</script>	
			

			<div class="row-fluid span12">

			<div class="span-5 clearfix" style="margin:0 0 0 15px;float:left">
                     
<!--
                        <label>categories</label>
                        <textarea name="category" rows="100" cols="100" style="width:90%;height:200px;font-family:georgia;font-size:12px;text-indent:0" >
						<?php echo trim($category) ?>
                        </textarea>
-->

                        <label>Save As </label>
                        <input class="small_button" type="text" value="<?php echo $title ?>" name="save_as"
                              style="width:98%;font-family:georgia;font-size:12px" />
                        
                        <input style="color:red" type="submit" id="save-bottom" name="mysubmit" value="Save" />
			</div>
		
			</div><!--span12 -->
			
		
    

			<div class="row-fluid span12" style="margin-top:0;padding-left:70px;padding-right:100px;padding-top:30px;padding-bottom:30px;background:url(<?php echo site_url('img/spacer-bottom.jpg'); ?>) no-repeat;">
                <p style="width:98%;line-height:1.3;text-align:center" class="footer">
                    
                </p>
                <p style="float:none;margin:0 auto;font-size:11px;text-align:center">Data Policy |
                    Accessibility | Contact Info | Privacy Policy |
                Copyright</p>
            </div>
        
    </div>
</div>
</form>


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
       alert();
       //$('#mainForm').attr({'action':url})
       //$('#mainForm').submit();
    });


//});
$(document).ready(function(){
    $('#saveDocumentSettings').click(function(){
        alert("JQuery Running!");
    });
});
</script>
</body>
</html>
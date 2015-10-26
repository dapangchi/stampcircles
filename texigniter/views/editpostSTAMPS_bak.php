<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Language" content="mul">
        <meta charset="utf-8">

        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href= "<?php echo site_url() ?>css/screen.css" type="text/css">
        <link rel="stylesheet" href="<?php echo site_url() ?>css/userguide.css">
        <link rel="stylesheet" href="<?php echo site_url() ?>css/typography.css">
        <link rel="Stylesheet" href="<?php echo site_url() ?>css/smoothness/jquery-ui-1.7.1.custom.css">
      <!--  <link rel="Stylesheet" href="<?php echo site_url() ?>css/bootstrap.css?"> -->

        <link rel="Stylesheet" href="<?php echo site_url() ?>css/boxes.css?">
        <link rel="Stylesheet" href="<?php echo site_url() ?>css/codeblocks.css?">
       <!-- <link rel="Stylesheet" href="<?php echo site_url() ?>css/forms.css?">-->
        <link rel="Stylesheet" href="<?php echo site_url() ?>css/navigation.css?">

        <meta name="author" content="Y Lazarides" />
        <meta name="copyright" content="Dr Y Lazarides" />
        <meta name="robots" content="all" />
        <meta name="imagetoolbar" content="no" />
        <meta name="keywords" content="keyword1,keyword2,keyword3" />
        <meta name="description" content="An automatic website builder" />



        <!-- We load jquery, jquery-Ui and bootstrap from CDNs Must default to local -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        

        <!-- best way -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>/js/codemirror/codemirror/lib/codemirror.css">
        <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/lib/codemirrorjs?"></script>
        <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/stex/stex.js?"></script>
        <!--
        <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/xml/xml.js?"></script>
        <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/javascript/javascript.js?"></script>
        <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/htmlmixed/htmlmixed.js?"></script>
        <script src="<?php echo site_url(); ?>/js/codemirror/codemirror/mode/css/css.js?"></script>
        -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>/js/CodeMirror/codemirror/theme/xq-dark.css">
<link rel="stylesheet" href="<?php echo site_url(); ?>/js/CodeMirror/codemirror/theme/neat.css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <style  type="text/css">         
#maintabs { 
    padding: 0px; 
    background: none; 
    border-width: 0px; 
} 
#maintabs .ui-tabs-nav { 
    padding-left: 0px; 
    background: transparent; 
    border-width: 0px 0px 1px 0px; 
    -moz-border-radius: 0px; 
    -webkit-border-radius: 0px; 
    border-radius: 0px; 
} 
#maintabs .ui-tabs-panel { 
    background: white; 
    border-width: 0px 1px 1px 1px; 
}

#maintabs { 
    background: transparent; 
    border: none; 
} 
#maintabs .ui-widget-header { 
    background: transparent; 
    border: none; 
    border-bottom: 1px solid #c0c0c0; 
    -moz-border-radius: 0px; 
    -webkit-border-radius: 0px; 
    border-radius: 0px; 
} 
#maintabs .ui-tabs-nav .ui-state-default { 
    background: transparent; 
    border: none; 
} 
#maintabs .ui-tabs-nav .ui-state-active { 
    background: transparent url(<?php echo site_url(); ?>/img/uiTabsArrow.png) no-repeat bottom center; 
    border: none; 
} 
#maintabs .ui-tabs-nav .ui-state-default a { 
    color: #c0c0c0; 
} 
#maintabs .ui-tabs-nav .ui-state-active a { 
    color: rgb(188,29,29); 
    font-weight: bold;
}
</style>

    </head> 
    <body style="background:url('<?php echo site_url(); ?>/images/body_bg.gif');margin-top:0px;padding-top:0px;height:auto">
        <div class="container clearfix" style="border-top:15px solid #000000;width:1000px">
            <div class="masthead" style="background:#fff;width:100%;padding-left:0;margin-left:0;border-bottom:0">    

                <div id="pagehead" style="width:98%;margin-top:0">
                    <h1 style="width:56%;margin-top:0;padding:0;padding-left:0;background-image:none">
                        <!-- Page name -->
                        <span  style="background-color:rgb(255,255,255);border-right:0px;font-family:arial;color:rgb(188,29,29);font-size:36px;line-height:1.3;padding-right:10px">
                            <?php echo 'StampNotes' ?><sup style="font-size:12px">&copy;</sup>&nbsp;&nbsp;&nbsp;
                        </span>
                    </h1>
                </div>
            </div>
            <!-- END NAVIGATION -->

            <div id="pagehead-spacer" style="width:98%;margin-top:0px;height:30px;margin-bottom:0px;background:#fff url(<?php echo site_url() ?>images/spacer.jpg) no-repeat;background-size:contain;background-position:center;">
            </div>
            <!-- TOP MENU NAVIGATION -->
            <!-- Start: Sidinneh�ll -->
            <div id="pagecontent" class="clearfix" style="width:100%;margin:0px;padding:0px;">
                <!-- form -->    


                <div id="maintabs" style="border:none" class="bg-grey-line-left">
                    
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
 <form id="mainForm"   width="1000px;border:1px solid red" class="clearfix bordered" method="post" action="<?php echo site_url(); ?>adminSTAMPS/post/save/<?php echo$portal . '/' ?><?php echo $location . '/' . $title ?>" >
                       
                        <div id="tabs-1" class="tabp">
                            <div id="postSubmitContainer" style="width:100%" class="clearfix">
                                <button id="mysubmit" name="mysubmit" class="btn btn-primary" style="width:250px;float:right;cursor:pointer;">Save Post</button>
                            </div>

                            <label>Title</label>
                            <input type="text"  value="<?php echo $title ?>" name="title" style="width:98%;margin-bottom:18px;font-family:georgia;font-size:16px" />

                            <textarea id="main-edit-bak" name="content" style="width:1000px;height:800px;float:none;margin:0 auto"><?php echo $content; ?></textarea>
                            <input class="btn btn-primary" style="float:right" type="submit" name="mysubmit" value="Save Post" />

                            
                            

                        </div>

                        


                        <div id="tabs-2" style="font-size:12px" >

                            <div id="localCSSContainer" style="color:red;text-decoration:underline;width:100px;float:right">
                                <button id="saveAsLocalCSS" class="bordered" style="cursor:pointer;">Save as Local CSS</button></div>
                            <hr/>
                            <textarea id="localCSSCode" name="localCSSCode" style="font-size:12px">
.CodeMirror-scrolls {
height: auto;
overflow-y: hidden;
overflow-x: auto;
 }</textarea>

                        </div>

                        <div id="tabs-3" style="font-size:12px;">
                            <div id="JSContainer" style="color:red;text-decoration:underline;width:100px;float:right">
                                <span id="saveAsJS" class="bordered" style="cursor:pointer;">Save as Local CSS</span></div>
                            <hr/>
                            <textarea id="code1" name="code1" style="font-size:12px;height:1500px">
.CodeMirror-scroll {
height: 800px;
overflow-y: hidden;
overflow-x: auto;

 }</textarea>
                            <!-- </form>-->
                            <script>
                                var editor2 = CodeMirror.fromTextArea(document.getElementById("code1"), {
                                    lineNumbers: true,
                                    mode: "text/html"
                                }).refresh();

                            </script>

                        </div>
                        <!-- tabs 4 -->
                        <div id="tabs-4" style="font-size:12px">

                            <div id="cssSubmitContainer" style="color:red;text-decoration:underline;width:100px;float:right">
                                <span id="saveAsCSS" class="bordered" style="cursor:pointer;">Save CSS</span></div>
                            <hr/>
                            <textarea id="code2" name="code2" style="font-size:12px;height:900px!important;width:100%">

                            </textarea>
                        </div>


                        <!-- tabs 5 -->

                        <div id="tabs-5" style="font-size:12px">

                            <div id="texSubmitContainer" style="color:red;text-decoration:underline;width:200px;float:right">
                                <button id="savePreamble" class="btn btn-primary" style="cursor:pointer;">Save preamble</button></div>
                            <hr/>
                            <textarea id="code3" name="code3" ><?php echo$texcontent; ?>
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
                        <div id="tabs-6" style="font-size:12px">
                            <div id="texSubmitContainer" style="width:200px;float:right">
                                <button id="saveDocumentSettings" class="btn btn-primary bordered" style="cursor:pointer;">Save Document Settings</button>
                            </div>
                            <hr/>
                            <textarea id="code4" name="code4" style="font-size:12px;height:900px!important;width:100%"><?php echo$documentsettings; ?>
                            </textarea>

                            <script>
                                var editor4 = CodeMirror.fromTextArea(document.getElementById("code4"),
                                {lineNumbers: true,
                                    mode: "text/javascript",
                                    lineWrapping:true
                                }).refresh();

                            </script>

                        </div>
                        <!-- end tabs-->
                        <div class="span-7" style="float:left;width:30%">
                            <label>categories</label>
                            <textarea name="category" rows="20" cols="100" style="width:90%;height:200px;font-family:georgia;font-size:12px;text-indent:0" >
                                <?php echo trim($category) ?>
                            </textarea>
                            <label>Save As </label>
                            <input class="small_button" type="text" value="<?php echo $title ?>" name="save_as"
                                   style="width:98%;font-family:georgia;font-size:12px" />

                            <input style="color:red" type="submit" name="mysubmit" value="Save" />
                        </div> 
                    </form>

                </div>

            </div><!-- tabs container -->



            <div style="margin-top:0;padding-left:70px;padding-right:100px;padding-top:30px;padding-bottom:30px;background:#fff url(<?php echo site_url(); ?>/img/spacer-bottom.jpg) no-repeat;">
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
                    Copyright
                </p>
            </div>
        </div>
    </div>
</div>








<script type="text/javascript">
    $(document).ready(function(){
        //templates
        //make working panel everything is inserted
        
        $(function() {
            $( "#tabs" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x" });
        });
        
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
            if (ui.panel.id == "tabs-6"){
                 alert(ui.panel.id);
                 openPanel();
            }
            else{
                alert(ui.panel.id)
                return false;
            }
        });
        
        var editor = CodeMirror.fromTextArea(document.getElementById("main-edit"),
        {lineNumbers: true,
            mode: "text/x-stex",
            lineWrapping: true,
            theme:"neat"
        });
        editor.setSize("100%",1000);
        editor.refresh();
        
        $("#code2").load('<?php echo site_url(); ?>/css/screen.css',callback).show();
        function callback(){
            var x=CodeMirror.fromTextArea(document.getElementById("code2"), {
                lineNumbers: true,
                autofocus:true,
                theme:"xq-dark"
            }
           )
            x.setSize("100%",1000);
            x.refresh();
        };
        
        var y=CodeMirror.fromTextArea(document.getElementById("code3"), {
            lineNumbers: true,
            autofocus:true,
            theme:"xq-dark"
        });
         y.setSize("100%",1000);
         y.refresh();
    });
      
    
</script>



<script type="text/javascript">
    
    $(document).ready(function(){
       
        // Main routine for saving files
        $('form#mainForm').submit(function(){
            var s=$(this).attr();
        });
        //return false;
 
        $('#saveAsCSS').click(function(){
            $(this).css({'color':'blue'});
            //alert('button pressed');
            var url="<?php echo site_url(); ?>/admin/post/saveCSS/jQuery/screen_bak";
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
            alert('.. saving the preamble');
            var url="<?php echo site_url(); ?>/adminSTAMPS/post/savePreamble/<?php echo $location . '/' . $title ?>";
            $('#mainForm').attr({'action':url})
            $('#mainForm').submit();
        });

        $('#saveDocumentSettings').click(function(){
            var url="<?php echo site_url(); ?>/adminSTAMPS/post/saveDocumentSettings/<?php echo $portal . '/' . $location . '/' . $title ?>";
            $('#mainForm').attr({'action':url})
            $('#mainForm').submit();
        });


    });

</script>
</body>
</html>

<!-- see http://keith-wood.name/uiTabs.html#tabs-nobg for tab styling -->

<!DOCTYPE html>
<html style="height:auto">
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
  <link rel="stylesheet" href= "<?php echo site_url(); ?>css/screen.css" type="text/css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/userguide.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/typography.css">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/smoothness/jquery-ui-1.7.1.custom.css">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/bootstrap.css?">
  
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/boxes.css?">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/codeblocks.css?">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/forms.css?">
  <link rel="Stylesheet" href="<?php echo site_url(); ?>css/navigation.css?">


  
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
  
        


    <style type="text/css">
        table {width:50%;margin-right:10px;float:right;margin-bottom:10px}
        table td{border:1px solid #bebebe;}
        table th{border:1px solid #bebebe;}
        .set-title{text-align:center;}
        pre.dotted{border:1px dotted #bebebe;font-size:11px;line-height:1.0}
        #main-edit{font-family:verdana; font-size:13px }


        .toolbar_image{
            width:32px;
        }
        .hidden{display:none}
        .CodeMirror {
            border: 1px solid #eee;
        }
        .CodeMirror-scroll {
            height: 800px;
            overflow-y: hidden;
            overflow-x: auto;
        }

        .ui-tabs .ui-tabs-hide {
           position: absolute;
           left: -10000px;
         }
    </style>
<style type="text/css">
            
            .country {color:#fff;background:green;padding:1px}
            .country a:link,.country a:hover,.country a:visited{color:#fff}
            .closure {color:#fff;background:rgb(188,29,29);padding:1px}
            .closure a:link,.closure a:hover,.closure a:visited{color:#fff}
            .arial11 {
                color:#303000;
                font-family:Arial,Helvetica,Verdana;
                font-size:11px;
                font-style:normal;
                font-weight:bold;
                line-height:13px;}

            table td{font-size:11px;}

            tr.shaded, .shaded{background:#fafafa}
            hr {background:#fff}
            p {font-size:14px;font-family:arial;}
            div#pagehead ul#menu li.active{
                background-color:#fafafa;}
            div#pagehead ul#menu li.active a:link{color:#666}

            div#pagehead ul#menu li.active a:visited{color:#666}
            div#pagehead ul#menu li.active a:hover{color:#fff}

            
                        
            

            pre{min-height:0px}
            
        </style>
   
    
    



</head> 


<body style="background:url('/codeigniter/images/body_bg.gif');margin-top:0px;padding-top:0px;height:auto">
<!-- Start: Sidcontainer -->
<div class="container clearfix" style="border-top:3px solid #000000;width:1000px">
    <!-- Start: Navigation Top Hidden -->
    <div id="nav">
         <div id="nav_inner" class="clearfix nopad hidden bordered">
                   <!-- hidden menu goes here -->


         </div>

    </div>
<!-- end hidden menu -->
<div id="nav2" class="clearfix" style="margin-right:0;padding-right:70px;">
                <a id="nav-img" href="#"><img  src= "<?php echo site_url(); ?>/strings/code_files/nav_toggle.jpg"
                                                   style="display:block;float:right;border:none" title="Toggle Table of Contents" alt="Toggle Table of Contents" />
                </a>


</div>
    
    
    
 <div class="masthead" style="background:#fff;width:100%;padding-left:0;margin-left:0;border-bottom:0">    
    
<div id="pagehead" style="width:980px;margin-top:0 ">
<h1 style="width:56%;margin-top:0;padding:0;padding-left:0;background-image:none">
                        <span id="authorImage" style="border-right:0px;padding:0px"><img src="<?php echo site_url(); ?>/images/users/robert_DeNiro_2006.jpg"
                         style="height:50px;line-height:1.3;" /></span>
                        <span  style="background-color:rgb(255,255,248);border-right:0px;font-family:arial;color:rgb(188,29,29);font-size:36px;line-height:1.3;padding-right:10px">
                   <?php echo 'BACKEND - edit menu' ?><sup style="font-size:12px">&copy;</sup>&nbsp;&nbsp;&nbsp;</span>
</h1>
                    <ul class="hidden" id="menu" style="background-image:url(<?php echo site_url(); ?>/images/icons/assets/nav_bg.gif);">
                        <li class="active">
                        <a  href="<?php echo site_url(); ?>/blogs/tutorials/blog/home">Home</a></li>
                        <li  style="background-color:rgb(188,29,29);">
                        <a style="color:#fff" href="<?php echo site_url(); ?>/LearnHaskell/tutorials/haskell/Introduction">haskell Notes</a></li>

                        <li class="active">
                        <a href="<?php echo site_url(); ?>/blogs/tutorials/jQuery/Introduction">Notes</a></li>
                   
                        <li class="active"><a href="<?php echo site_url(); ?>/blogs/gallery/eugenio-018/6">Galleries</a></li>
                        <li class="active" ><a  href="<?php echo site_url(); ?>/blogs/stamps/general/introduction/">Blog</a></li>
                        <li id="login" class="active"><a  href="">Login/Register</a></li>

                    </ul>
              
                </div>


            </div>
            <!-- END NAVIGATION -->


 <div id="pagehead-spacer" style="width:980px;margin-top:0;height:30px;background:#fff url(<?php echo site_url(); ?>/images/spacer.jpg) no-repeat;">

 </div>
 <!-- TOP MENU NAVIGATION -->
        




<!-- Start: Sidinneh�ll -->
<div id="pagecontent" class="clearfix" style="margin:0px;padding:0px">
            <!-- Start: Contentrad -->
<div id="largePanel" style="width:95%;height:auto" class="bordered"></div>
<div class="content-row" style="float:left" style="margin:0px;padding:0px" >
                <!-- Start: Inneh�llsklumn 1 -->
<div class="span-17 bg-grey-line-left" style="margin-left:20px;float:left;margin-bottom:0px;padding:0px">


<!-- beginning of form -->

<div id="#maindraggable" style="width:98%;float:left">
<div id="maintabs" style="border:none" class="bg-grey-line-left ">
<ul>
		<li><a href="#tabs-1">Post</a></li>
		<li><a href="#tabs-2">Local CSS</a></li>
        <li><a href="#tabs-3">Code</a></li>
        <li><a href="#tabs-4">Screen CSS</a></li>
        <!--<li><a href="#tabs-5">Comments</a></li>-->
</ul>
<div id="tabs-1" class="tabp">
 
<form id="mainForm" method="post" action="<?php echo site_url()?>adminSTAMPS/menu/save/<?php echo $portal.'/'.$location.'/'.' '  ?>" >

   <label>Title</label>
   <input type="text"  value="<?php echo $title ?>" name="title" style="width:98%;margin-bottom:18px;font-family:georgia;font-size:16px" />
   <textarea id="main-edit" name="content"  style="width:98%;height:1500px;border:none"><?php echo $content; ?>
  </textarea>
  <input type="submit" name="mysubmit" value="Submit" />


</div>

<div id="tabs-2" style="font-size:12px" >

<div id="localCSSContainer" style="color:red;text-decoration:underline;width:100px;float:right">
   <span id="saveAsLocalCSS" class="bordered" style="cursor:pointer;">Save as Local CSS</span></div>
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
height: auto;
overflow-y: hidden;
overflow-x: auto;
 }</textarea>
<!-- </form>-->
<script>
    CodeMirror.fromTextArea(document.getElementById("code1"), {
              lineNumbers: true
    }).refresh();
 
</script>
</div>
<!-- tabs 4 -->
<div id="tabs-4" style="font-size:12px">
   
   <div id="cssSubmitContainer" style="color:red;text-decoration:underline;width:100px;float:right">
   <span id="saveAsCSS" class="bordered" style="cursor:pointer;">Save CSS</span></div>
   <hr/>
   <textarea id="code2" name="code2" style="font-size:12px;height:900px;width:100%">

   </textarea>

   
<!-- </form>-->

 

</div>

</div><!-- end tabs-->
</div><!-- tabs container -->
</div><!--span-17 -->



                    

         





                   
</div>




<div class="span-7" style="float:left;width:30%">
  <h2 style="color:#dd0000"><?php echo $message.'test' ?></h2>


 

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

<!-- OBJECT MENU -->
<style type="text/css">
#toolbar-container{
        border:1px solid red;width:335px;
        background:#ececec;position:fixed;top:0px;right:3px;
        min-height:500px;
}
#toolbar-head{width:98%;
          background:#000000;
          font-size:12px;margin:0 auto;
          color:#ffffff;text-align:center;border:1px solid green}
#panelContainer{
    background:#ededed;
    border:1px solid yellow;
    float:left;
    height:495px;
    width:240px;
    margin-left:5px;
    color:#606060;
    font-size:11px;
}
#panelContent{
   width:95%;float:left;border:1px solid purple;
 }
</style>
<toolbar id="toolbar-container" class="curvy draggable">
       <div id="toolbar-head">
           preview | readability | statistics | SEO | scripts |template
       </div>
  <!-- left moving panel -->
  <div id="panelContainer">
     <div id="panelContentTitle" style="color:white;background:#000000;text-align:center;width:100%;font-size:12px">
         EDIT POST
     </div>
     <div id='panelContent' class="ON">
         <div id="postControlPanel" class="clearfix">
            <label style="color:#606060;clear:both"><span style="min-width:16px;min-height:16px"><img src="<?php echo site_url('images/right_arrow.png'); ?>" /></span> CATEGORIES</label>
            <textarea name="category" rows="100" cols="100" style="width:99%;height:200px;font-family:georgia;font-size:12px;text-indent:0" >
              <?php echo trim($category) ?>
           </textarea>
           <label style="color:#606060;clear:both;padding:5px">
           <span><img src="<?php echo site_url('images/right_arrow.png'); ?>" /></span>
                        SAVE AS
            </label>
  
                    <input type="text" value="<?php echo $title ?>" name="save_as" style="width:98%;font-family:georgia;font-size:12px" />
                <input type="submit" value="Save" name="secondary_submit" class="button" id="secondary_submit"/>

                      <div class="curvy" style="border:1px solid #E1E1E1;width:99%">
                     

                     <div class="curvy" style="margin:0 auto;width:200px;height:15px;font-size:12px;font-weight:bold;color:#606060;text-align:center;border:1px solid #ffffff;-moz-linear-gradient(50% 100%, #77A423, #93C436 60%, #AAD15D 96%, #D4ED99 98%)">
                              Save as Draft
                   </div>


                    <div class="curvy" style="margin:0 auto;width:200px;height:15px;font-size:12px;font-weight:bold;color:#606060;text-align:center;border:1px solid #ffffff;-moz-linear-gradient(50% 100%, #77A423, #93C436 60%, #AAD15D 96%, #D4ED99 98%)">
                              Publish on Front Page
                   </div>

                   <div class="curvy" style="margin:0 auto;width:200px;height:15px;font-size:12px;font-weight:bold;color:#606060;text-align:center;border:1px solid #ffffff;-moz-linear-gradient(50% 100%, #77A423, #93C436 60%, #AAD15D 96%, #D4ED99 98%)">
                              Save and Publish
                   </div>
                   <div class="curvy" style="margin:0 auto;width:200px;height:15px;font-size:12px;font-weight:bold;color:#606060;text-align:center;color:rgb(188,29,29);border:1px solid #ffffff;-moz-linear-gradient(50% 100%, #77A423, #93C436 60%, #AAD15D 96%, #D4ED99 98%)">
                              Save
                   </div>
             </div><!-- Post Panel -->
            </div><!-- Panel Container-->
            
          </div>
      </div>
      <!-- end left moving panel -->
      <!-- beginning tools box -->
   <div id="imageToolBox" style="width:80px;background-color:#333;color:white;height:500px;float:right">
                     
     <p  style="font-size:9px;text-align:center;padding:0px;margin:3px;margin:0 auto;">
      Widgets</p>
     <div id="backgrounds" class="curvy" style="background:white;width:90%;margin:0 auto;">
      test
     </div>
    
     <div id="closePanel" onclick="closePanel();return false;">Close</div>
     <div id="openPanel" onclick="openPanel();return false;">Open</div>
   </div>
</toolbar>

<script type="text/javascript">
 function closePanel(){
     $('#panelContainer,#panelContent').animate({
         'width':'0px',
         'height':'0px'
         },1000);
     $('#toolbar-container').animate({'width':'80px'},800);
     return false;
 }
 function openPanel(){
     $('#toolbar-container').width('330px');
     $('#panelContainer').animate({
         'width':'240px',
         'height':'480px'
     },800);
    
     return false;
 }
</script>

<!---- toolbar-container --->                    
 <!-- END OBJECT MENU -->






<!--- End form --------------------------------------------------------> 



  </form>
 </div>
<!--- code experiment ---> 
<hr/>
 


 
<!--- end code experiment--> 



                


                
            </div>
        </div>

        <div id="pagefooter" style="border:0">
            <span style="font-size:smaller;width:80%;text-align:center">
                template:editpost modified August 6 th 2011
            </span>
            <p class="copyright">Rest of Content &copy; Dr Y.Lazarides</p><p>+46 (0) 738 -19 15 03</p><p>egypt (a) latenightengineer.com</p>
        </div>
    </div>
</div>

<!--
<div class="formContainer" style="min-height:380px;min-width:500px;">
<div class="hidden" class="tool shaded curvy draggable" id="object1" style="width:500px;float:left;padding:10px">
<div id="msg3">Test</div>
<form>
    <input type="text" name="test" id="firstinput">
    <textarea id="text_1">
Some form
    </textarea>

</form>
</div>
</div>
-->


<script type="text/javascript">
    $(document).ready(function(){
        //templates
        //make working panel everything is inserted
        //here
        function makePanel(id, aText){
            return '<div id='+id+' class="hidden tool" >name : '+aText+'</div>';
        }

        //just mock at the moment
        function menuPanel(){
            var menuScreen='<ul id="menu" style="background-image:url(/codeigniter/images/icons/assets/nav_bg.gif);">'+
                '<li id="login" class="active"><a  href="">Login/Register</a></li>'+
                '</ul>';
            return menuScreen;
        }


        //Mock for toolbox temporarily as global
        toolbox={}
        toolbox={collection:['config','clock','burn','comment','connect','delete',
                'database','bulb','alarm','alert','Login','Logout','Under-construction',
                'templates','html','css','meta','pages','users','code'],
            config:'Configure the ',
            database:'menuPanel'
        };

         src='';
         titleString='';
        //var tempPanel='';
         tempString='';
        // create the toolbar conatiner

        toolbox.collection.forEach(function(index){
            src+='<img class="toolbar_image" '+  'src="<?php echo site_url(); ?>/images/icon/toolbar/'+index+'.png" '  +
                'title="'+index+'" class="'+index+'" />';
            //create panels
            var tempPanel=makePanel(index,index);
            $('#backgrounds').html(src)
            $(tempPanel).appendTo('#panelContainer');

        });


        var ajaxName1='b';
        /////////
        $('.toolbar_image').bind('click',function(){
            titleString=$(this).attr('title');
            $('.tool').hide();
            $('#panelContainer').toggle();
            $('#object1').toggle();
            $('#'+titleString).text(titleString).toggle();
            $('#panelContent').load('<?php echo site_url(); ?>' + 'js/'+titleString+'.html?', function () {
            $('#panelContent').fadeIn('slow');
                //});
            });
        });

        /////

        //AJAX LOAdING

        $('#bulb').click(function () {
            var ajaxName2='database';
            $('<div id="load"> loading ....</div>').appendTo('#panelContainer').ajaxStart(function () {
                $(this).show();
            }).ajaxStop(function () {
                // $(this).hide();
            });
            $('#load').load('<?php echo site_url(); ?>' + 'js/database.html?');
            return false;
        });
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
</script>

<script>
    $("#code2").load('/codeigniter/css/screen.css',callback).show();
    function callback(){

        var x=CodeMirror.fromTextArea(document.getElementById("code2"), {
            lineNumbers: true});

        //CodeMirror.refresh();
    };
   //$('#code2').width('300px');
 </script>

<script type="text/javascript">
$(document).ready(function(){
   $('form#mainForm').submit(function(){
       var s=$(this).attr();
       alert('submitted form: '+s.toString());
       //return false;
   });

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
       var url="<?php echo site_url(); ?>/admin/post/saveAsLocalCSS/jQuery/localCSS_bak";
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });

    $('#saveAsJS').click(function(){
       $(this).css({'color':'blue'});
       //alert('button pressed');
       var url="<?php echo site_url(); ?>/admin/post/saveAsJS/jQuery/js_bak";
       $('#mainForm').attr({'action':url})
       $('#mainForm').submit();
   });


})

</script>


</div>





</div>
</body>



<script type="text/javascript">
$(document).ready(function(){
//$('h1').css({'border:':'1px solid #bebebe'});
})
</script>
</html>


<?php 
//TEMPLATE
//article_view
//deals with articles
//
 define('BASEPATH1','../egypt/'); 
 
 include_once(BASEPATH1.'define.php');
 //include_once(BASEPATH1.'table.php'); 
 include_once('menu.php');
 //include_once(BASEPATH1.'utilities.php');
 //include_once(BASEPATH1.'template.class.php');
// include_once(BASEPATH1.'page-builder.php');
 //include_once(BASEPATH1.'photos-03.dat.php');
 //include_once(BASEPATH1.'view.class.php');
 //include_once(BASEPATH1.'view.php');
 //include_once(BASEPATH1.'photos-03.dat.php');
 //include_once(BASEPATH1.'photos.dat.php');
 

 //include_once('settings.php');
 //$templ=new Template;
 
//timer_start();
		//this is a router get what you need from user URL
 /*     
       //echo_array($_GET);
       $s=$_SERVER[REQUEST_URI];
       $article=$_GET['article'];
       $post=$_GET['post'];        //values from DB
       $set=$_GET['set'];
       $gallery=$_GET['gallery'];
       $title=$_GET['title'];
       $image=$_GET['image'];
       $page=$_GET['page'];
       $pattern="/(\d*)\-(\d*)/";
      
       $z=preg_match_all($pattern,$set,$values);
       $set_start=$values[1][0];  //values to obtain
       $set_end=$values[2][0];    //values to obtain
       //echo_array($values);
 
 //load values from DB
 //This is the Model
 
 //output this is the view 
  
       
 */
  
//include main template needs to be corrected for footer etc
//also for other stuff
//page build-up

  //if ((isset($_GET['template']))&& ($_GET['template']!=NULL)) {$template1=$_GET['template'].'.php';}
         //else $template1='template_set.php';
  //$data=$_GET;
  //include($template1); //body template
  //$templ->includeTemplate('footer.php','path',''); 
  //timer_end(1);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Stamps and Postal History:<?php echo $title;  ?><</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="mul" />

<link rel="Shortcut Icon" href="<?php echo site_url(); ?>/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url(); ?>/strings/code_files/userguide.css">

<script type="text/javascript" src="<?php echo site_url(); ?>/js/keyboard.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/css/keyboard.css">

<script type="text/javascript" src="<?php echo site_url(); ?>/strings/code_files/nav.js"></script>


<script type="text/javascript" src="<?php echo site_url(); ?>/strings/code_files/user_guide_menu.js"></script>

<script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery.ajaxContent.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/js/ajax.js"></script>
<script type="text/javaScript" src="<?php echo site_url(); ?>/chili/jquery.chili-2.2.js"></script>
<script type="text/javascript">
    ChiliBook.recipeFolder = "<?php echo site_url(); ?>" + "chili/";
</script>

<link rel="stylesheet" href="<?php echo site_url(); ?>/egypt/two_files/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url(); ?>/egypt/screen.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url(); ?>/css/typography.css" type="text/css" />
<link type="text/css" href="<?php echo site_url(); ?>/css/smoothness/jquery-ui-1.7.1.custom.css" rel="Stylesheet" />

<link type="text/css" href="<?php echo site_url(); ?>/css/measures.css" rel="Stylesheet" />


<meta name="author" content="Y Lazarides" />
<meta name="copyright" content="Dr Y Lazarides" />
<meta name="robots" content="all" />
<meta name="imagetoolbar" content="no" />
<meta name="keywords" content="<?php //echo $keywords;    ?>" />
<meta name="description" content="An automatic website builder" />

 
 
 
 
<style type="text/css"> 

 #toc {
  border: 1px solid #bebebe ;
  background:#bebebe;
  margin: 0 0 5px 12px;
  float:right;
  width:300px;
}

#toc ol{font-size:13px}
#toc ol {
  margin: 8px;
  padding-left: 5px;
}
.country {color:#fff;background:#C04343;}
.country a:link,.country a:hover,.country a:visited{color:#fff}
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
</style>
</head> 


<body style="background:#000;margin-top:0">
<!-- Start: Sidcontainer -->
<div class="container clearfix" style="border-top:3px solid #000000;width:1000px">

<!-- START NAVIGATION -->
<div style="overflow: hidden; height: 0px;" id="nav">
  <div id="nav_inner">
  <script type="text/javascript">create_menu('null');</script>
  <table cellspaceing="0" style="width: 98%;" border="0" cellpadding="0"><tbody><tr>
  <td class="td" valign="top">
  </table>
  </div>
</div>

<div id="nav2" class="clearfix" style="margin-right:0;padding-right:70px">
<a name="top"></a><a href="javascript:void(0);" onclick="myHeight.toggle();">
<img src="<?php echo site_url(); ?>/strings/code_files/nav_toggle.jpg" style="display:block;float:right" title="Toggle Table of Contents" alt="Toggle Table of Contents" border="0" height="44" width="153"></a>
	<?php //showMenu($main_menu) ?>
</div>


<div id="masthead" style="background:#fff;width:100%;padding-left:0;margin-left:0">

<h1><span style="font-family:georgia;weight:bold;color:#000;font-size:36px;padding-left:0.6em">
<?php echo ucfirst($location).'&middot; ';?></span><span style="color:#000040">STAMPS AND POSTAL HISTORY</span></h1>
</div>
<!-- END NAVIGATION -->

















	<!-- Start: Sidhuvud -->
<div id="pagehead" style="width:980px;margin-top:0 ">
<div id="internship" style="margin-top:0;padding-top:0">
<a href="#"><img src="<?php echo site_url(); ?>/egypt/two_files/internship.png" alt="logo" title="promo block image" /></a>
</div>
				<?php showMenu($main_menu) ?>
	</div>
	<!-- Start: Sidinneh�ll -->
	<div id="pagecontent" class="clearfix" >
		<!-- Start: Contentrad -->
		<div class="content-row"  >
			<!-- Start: Inneh�llsklumn 1 -->
			<div class="span-7">
				<h2 style="color:#dd0000"><?php //if (isset($title)){echo $title;}?></h2>
        
 

<!-- The feature Image -->
<?php if (!isset($feature_image)){echo '';}else{

 echo '<img src="'.$feature_image.'" style="width:90%;margin-left:15px;" alt="" title="" />';}?> 

<!-- The feature -->
<?php echo '<h3 style="width:88%;color:#acacac;margin-left:15px">'.$feature.'</h3>'?>

<div class="span-5 clearfix" style="margin:0 0 0 15px">
<!--<?php e('<div style="border:1px solid #bebebe">');echo $toc;e('</div>');?>-->
<p></p>

<?php if (isset($menu)){echo $menu;} ?>

<ul class="LHnav" style="margin-left:0px;width:210px">
    <?php 
    //create menu automatically needs to come from model/controller
      foreach ($list as $key=>$value){
        $value=str_replace( '.dat', '', $value );
        $value=str_replace( '/'.$location.'/', '', $value );
        $this->load->helper('inflector');
        
       echo '<li><a href="'.$value.'">'.ucfirst(r('_',' ',$value)).'</a></li>';
     }
    ?>  
</ul>

<h4 class="country" style="background:#000040">Europe (Western)</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/italy/introduction">Italy</a></li>  
<li><a href="<?php echo site_url(); ?>/blogs/stamps/greece/introduction">Greece</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/corfu/introduction">Corfu</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/northern-epirus/introduction">Northern Epirus</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/germany/introduction">Germany</a></li>
</ul> 


<h4 class="country">Great Britain</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/gallery/UK/1">Great Britain</a></li>  
<li><a href="<?php echo site_url(); ?>/blogs/stamps/malta/introduction">Ireland</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/levant/introduction">Isle of Man</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/long-island/introduction">Long Island</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/crimea/introduction">Crimean War</a></li>
</ul> 


<h4 class="country">British Europe</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/cyprus/cyprus-postal-history/Introduction">Cyprus</a></li>  
<li><a href="<?php echo site_url(); ?>/blogs/stamps/malta/introduction">Gibraltar</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/levant/introduction">Levant</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/long-island/introduction">Long island</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/malta/introduction">Malta</a></li>
</ul> 


<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/cayman/Introduction">Cayman island</a></li>  
<li><a href="<?php echo site_url(); ?>/blogs/stamps/british-central-africa/introduction">Nyasaland (British central Africa)</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/hawaii/introduction">Hawaii</a></li>
</ul>


<h4 class="country">Asia</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/bushire/introduction">Bushire</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/afghanistan/introduction">Afghanistan</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/china_postal_history/The_large_Dragons">China</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/india/introduction">India</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/hong-kong/introduction">Hong Kong</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/straights-settlement/introduction">Straits Settlements</a></li>
</ul>

<h4 class="country">Middle East</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/aden/introduction">Aden</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/abu-dhabi/introduction">Abu Dhabi</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/dubai/introduction">Dubai</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/qatar/introduction">Qatar</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/bahrain/introduction">Bahrain</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/kuwait/introduction">Kuwait</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/uae/introduction">UAE</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/oman/introduction">Oman</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/british-postal-agencies-in-arabia/introduction">British Postal Agencies in Eastern Arabia</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/persian-gulf/introduction">Persian Gulf</a></li>

</ul>

<h4 class="country">Southern Africa</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/Basutoland/introduction">Basutoland</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/bechuanaland/introduction">Bechuanaland</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/cape-of-good-hope/introduction">Cape of Good Hope</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/mafeking/introduction">Mafeking</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/pietersburg/introduction">Pietersburg</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/swaziland/introduction">Swaziland</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/transvaal/introduction">Transvaal</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/vryburg/introduction">Vryburg</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/orange-river-colony/introduction">Orange River Colony</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/rhodesia/introduction">Rhodesia</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/stellaland/introduction">Stellaland</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/natal/introduction">Natal</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/new-republic/introduction">New Republic</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/zululand/introduction">Zululand</a></li>
</ul> 

<h4 class="country">British East Africa</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/British-East-Africa/introduction">British East Africa</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/uganda/introduction">Uganda</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/east-africa-and-uganda/introduction">East Africa and Uganda Protectorate</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/north-african-campaigns/introduction">Kenya and Uganda</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/tanganyika/introduction">Tanganyika</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/KUT/introduction">Kenya Uganda and Tanganyika</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/east-african-campaigns/introduction">East African campaigns</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/somaliland/introduction">Somaliland Protectorate</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/mafia-island/introduction">Mafia island</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/Zanzibar/introduction">Zanzibar</a></li>


</ul>

<h4 class="country"><a href="<?php echo site_url(); ?>/blogs/stamps/general/North_Africa">North Africa</a></h4>
<ul id="LHnav" style="margin-left:0px;width:210px">

<li><a href="<?php echo site_url(); ?>/blogs/stamps/morocco-agencies/introduction">Morocco Agencies</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/tangier/introduction">Morocco Agencies (Tangier)</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/postal_history/1866">Egypt</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/sudan/introduction">Sudan</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/north-african-campaigns/introduction">North African Campaigns</a></li>
</ul>

<h4 class="country"><a href="<?php echo site_url(); ?>/blogs/stamps/west-africa/introduction">West Africa</a></h4>
<ul id="LHnav" style="margin-left:0px;width:210px">

<li><a href="<?php echo site_url(); ?>/blogs/stamps/fernando-po/introduction">Fernando Po</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/lagos/introduction">Lagos</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/niger-territories/introduction">Niger Territories</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/oil-rivers-protectorate/introduction">Oil Rivers and Niger Coast Protectorate</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/northern-nigeria/introduction">Northern Nigeria</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/southern-nigeria/introduction">Southern Nigeria</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/nigeria/introduction">Nigeria</a></li>
</ul>

<h4 class="country">West Africa Settlements</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">

<li><a href="<?php echo site_url(); ?>/blogs/stamps/fernando-po/introduction">Gambia</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/lagos/introduction">Gold Coast</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/niger-territories/introduction">Sierra Leone</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/oli-rivers/introduction">West African Campaigns</a></li>
</ul>


<h4 class="country"><a href="<?php echo site_url(); ?>/blogs/stamps/general/The_African_Islands">The African Islands</a></h4>
<ul id="LHnav" style="margin-left:0px;width:210px">

<li><a href="<?php echo site_url(); ?>/blogs/stamps/bouvet-island/introduction">Bouvet Island</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/marion-island/introduction">Marion island</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/gough-island/introduction">Gough Island</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/tristan/introduction">Tristan da Cunha</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/madagascar/introduction">Madagascar</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/mauritius/introduction">Mauritius</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/rodrigues-island/introduction">Rodrigues</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/seychelles/introduction">Seychelles</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/st-helena/introduction">St Helena</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/ascension/introduction">Ascension</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/british-postal-agencies/introduction">British Postal Agencies</a></li>

</ul>

<h4 class="country">North America</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/usa-postal-history/China_Post_office">USA China Post Office</a></li> 
<li><a href="<?php echo site_url(); ?>/blogs/stamps/canada/introduction">Canada</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/newfoundland/introduction">Newfoundland</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/nova-scotia/introduction">Nova Scotia</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/mexico/introduction">Mexico</a></li>
</ul>

<h4 class="country">Central America</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/belize/introduction">Belize</a></li> 
<li><a href="<?php echo site_url(); ?>/blogs/stamps/argentina/introduction">Panama</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/Brasil/introduction">Costa Rica</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/colombia/introduction">Porto Rico</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/canal-zone/introduction">Canal Zone</a></li>
</ul>

<h4 class="country">South America</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/peru/introduction">Peru</a></li> 
<li><a href="<?php echo site_url(); ?>/blogs/stamps/argentina/introduction">Argentina</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/Brasil/introduction">Brasil</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/colombia/introduction">Colombia</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/chile/introduction">Chile</a></li>
</ul> 

<h4 class="country">Polar Region</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/artic/introduction">Artic</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/antartic/introduction">Antartic</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/gough-island/introduction">Gough Island</a></li>
</ul>  
  
<h4 class="country">German Colonies</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/caroline-islands/introduction">Caroline Islands</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/cameroon/introduction">Cameroon </a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/south-west-africa/introduction">South West Africa</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/togo/introduction">Togo</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/marshalls/introduction">Marshall Islands</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/german-east-africa/introduction">German East Africa</a></li>


</ul> 
 
<h4 class="country">Australasia</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/australia/introduction">Australia</a></li>
</ul>   

<h4 class="country">Pacific</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/pitcairn-islands/introduction">Pitcairn Islands</a></li>
</ul>

<h4 class="country">West Indies</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/turks-islands/introduction">Turks Islands</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/st-vincent/introduction">St Vincent</a></li>
</ul>  
  
  
<h4 class="country">General</h4>
<ul id="LHnav" style="margin-left:0px;width:210px">
<li><a href="<?php echo site_url(); ?>/blogs/stamps/general/exhibiting">Exhibiting</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/general/Postal_History">What is Postal History?</a></li>
<li><a href="<?php echo site_url(); ?>/blogs/stamps/general/The_Future_of_Stamp_Collecting">Is there a Future for stamp-collecting?</a></li>
</ul>   
  
  
</div>
			
</div>
			<!-- Start: Side 2 -->
			<div class="span-17">
			<?php //echo 'title is'.$title;?>
			<?php echo '<a href="' . site_url() . '/admin/post/edit/'.$location.'/'.$title.'">[edit]</a>';?>
			<?php echo '<a href="' . site_url() . '/admin/post/new/'.$location.'/'.$title.'">[new]</a>';
			?>
			<?php echo $date ?>
			
<div style="background:#000;color:#fff;width:30%;float:right;margin-bottom:3px"> 
<!-- NEXT -->   
<div class="clearfix" style="padding-bottom:5px;padding-left:7px;padding-right:7px">
    
<a href="<?php echo $prev?>"><img src="<?php echo site_url(); ?>/egypt/previous.gif" style="float:left;margin-top:10px" /></a>    
    
<a href="<?php echo $next?>"><img src="../../../../egypt/next.gif" style="float:right;clear:right;margin-top:10px" /></a>    
 
</div> 
</div>
			
	<div style="clear:both"></div>	
	     <?php echo $user ?>	
       <?php echo markdown($content); ?>

<div style="clear:both"></div>
<div style="background:#000;color:#fff;width:30%;float:right;margin-bottom:3px"> 
<!-- NEXT -->   
<div class="clearfix" style="padding-bottom:5px;padding-left:7px;padding-right:7px">
    
<a href="<?php echo $prev?>"><img src="<?php echo site_url(); ?>/egypt/previous.gif" style="float:left;margin-top:10px" title="<?php echo $prev ?>" /></a>    
    
<a href="<?php echo $next?>" title="<?php echo $next ?>"><img src="../../../../egypt/next.gif" style="float:right;clear:right;margin-top:10px"  /></a>    
 
</div> 
</div>
<div style="clear:both"></div>
<?php echo '<p><a href="<?php echo site_url(); ?>/admin/post/edit/'.$location.'/'.$title.'">edit</a></p>'; 
              $this->benchmark->mark('code_end');

echo $this->benchmark->elapsed_time('code_start', 'code_end');echo '  '.$this->benchmark->elapsed_time();?>
<?php echo '  '.$this->benchmark->memory_usage();?>
			</div>
			
			
		</div>
	</div>
	<!-- Start: Sidfot -->
	<?php include('footer.php');?>
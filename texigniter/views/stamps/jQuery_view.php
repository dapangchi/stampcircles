<?php 
define('BASEPATH1','../egypt/');
include_once(BASEPATH1.'define.php');
//include_once(BASEPATH1.'table.php'); 
include_once('menu.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title><?php echo $title;  ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Language" content="mul" />
    <link rel="Shortcut Icon" href="<?php echo site_url(); ?>/images/favicon.ico" type="image/x-icon" />
    <!-- revised style sheets -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url(); ?>/css/userguide.css" />
    <link rel="stylesheet" href="<?php echo site_url(); ?>/css/general.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url(); ?>/css/screen.css" type="text/css" />


    <link rel="stylesheet" href="<?php echo site_url(); ?>/css/typography.css" type="text/css" />
    <link type="text/css" href="<?php echo site_url(); ?>/css/smoothness/jquery-ui-1.7.1.custom.css" rel="Stylesheet" />
    <link type="text/css" href="<?php echo site_url(); ?>/css/measures.css?" rel="Stylesheet" />
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/jslint.js" id="scriptjsLint" charset="utf-8"></script>

    <!-- <script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery.ajaxContent.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery.form.js" />-->
    <!--   <script type="text/javascript" src="<?php echo site_url(); ?>/js/ajax.js"></script>-->
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/formatter.js"></script>


    <!--<script defer="true" type="text/javaScript" src="<?php echo site_url(); ?>/js/prototype_part2.js"></script>-->

    <!-- best way -->
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery-1.3.2.min.js">
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript">-->
    </script>
    <!--<script src="http://code.jquery.com/jquery-1.4a2.js"></script>-->
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/jquery-ui-1.7.1.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/monitter/monitter.min.js"></script>

    <script type="text/javascript" src="<?php echo site_url(); ?>/js/goog/base.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/goog/deps.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/js/goog/dom/annotate.js"></script>


    <script type="text/javascript" src="<?php echo site_url(); ?>/js/U.js"></script>
    <script type="text/javaScript" src="<?php echo site_url(); ?>/js/yl.js"></script>
    <script type="text/javaScript" src="<?php echo site_url(); ?>/js/highlighter.js"></script>
    <!-- <script defer="true" type="text/javascript" src="<?php echo site_url(); ?>/js/tokens.js"></script>-->
    <!--<script defer="true" type="text/jacascript"   src="<?php echo site_url(); ?>/js/parse.js"></script>-->
    <!-- <script defer="true" type="text/javascript" src="<?php echo site_url(); ?>/js/json2.js"></script>-->

    <meta name="author" content="Y Lazarides" />
    <meta name="copyright" content="Dr Y Lazarides" />
    <meta name="robots" content="all" />
    <meta name="imagetoolbar" content="no" />
    <meta name="keywords" content="<?php //echo $keywords;    ?>" />
    <meta name="description" content="An automatic website builder" />


    <style type="text/css">
        /* side menu to be renamed
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
        */
        
        .country {
            color: #fff;
            background: rgb(192, 67, 67);
            padding: 1px
        }
        
        .country a:link,
        .country a:hover,
        .country a:visited {
            color: #fff
        }
        
        .closure {
            color: #fff;
            background: rgb(188, 29, 29);
            padding: 1px
        }
        
        .closure a:link,
        .closure a:hover,
        .closure a:visited {
            color: #fff
        }
        
        .arial11 {
            color: #303000;
            font-family: Arial, Helvetica, Verdana;
            font-size: 11px;
            font-style: normal;
            font-weight: bold;
            line-height: 13px;
        }
        
        table td {
            font-size: 11px;
        }
        
        tr.shaded,
        .shaded {
            background: #fafafa
        }
        
        hr {
            background: #fff
        }
        
        p {
            font-size: 14px;
            font-family: arial;
        }
        
        div#pagehead ul#menu li.active {
            background-color: #fafafa;
        }
        
        div#pagehead ul#menu li.active a:link {
            color: #666
        }
        
        div#pagehead ul#menu li.active a:visited {
            color: #666
        }
        
        div#pagehead ul#menu li.active a:hover {
            color: #fff
        }
    </style>

</head>


<body style="background:url(<?php echo site_url(); ?>/images/body_bg.gif)">
    <div class="container clearfix" style="border-top:3px solid #000000;width:1000px;margin:0 auto">
        <!-- START NAVIGATION TOP HIDDEN -->
        <div id="nav">
            <div id="nav_inner" class="clearfix nopad hidden" style="height:2500px">
                <!-- hidden menu goes here -->
            </div>
        </div>
        <!-- end hidden menu -->

        <div id="nav2" class="clearfix" style="margin-right:0;padding-right:70px;">
            <a id="nav-img" href="#"><img  src= "<?php echo site_url(); ?>/strings/code_files/nav_toggle.jpg" style="display:block;float:right;border:none" title="Toggle Table of Contents" alt="Toggle Table of Contents" /></a>
        </div>

        <div class="masthead" style="background:#fff;width:100%;padding-left:0;margin-left:0;border-bottom:0">
            <div id="pagehead" style="margin-bottom:0;height:60px;width:95%;margin-top:0px;padding-top:15px">
                <h1 style="width:56%;margin-top:0;padding:0;padding-left:0">
                    <span style="background-color:rgb(255,255,248);font-family:arial;color:rgb(188,29,29);font-size:36px;line-height:1.3;padding:10px">jsNotebooks<sup style="font-size:12px">&copy;</sup>&nbsp;&nbsp;&nbsp;</span>
                </h1>
                <ul id="menu" style="background-image:url(<?php echo site_url(); ?>/images/icons/assets/nav_bg.gif);">
                    <li class="active"><a href="<?php echo site_url(); ?>/blogs/tutorials/blog/home">Home</a></li>
                    <li class="active" style="background-color:rgb(188,29,29);"><a style="color:#fff" href="<?php echo site_url(); ?>/blogs/tutorials/jQuery/Introduction">Notes</a></li>

                    <!--  <li class="active" style="background-color:rgb(206,123,0)"><a href="<?php echo site_url(); ?>/blogs/excerpt">Archive</a></li>-->
                    <li class="active"><a href="<?php echo site_url(); ?>/blogs/gallery/eugenio-018/6">Galleries</a></li>
                    <!--    <li class="active"><a href="<?php echo site_url(); ?>/upload/">Upload</a></li>-->
                    <li class="active"><a href="<?php echo site_url(); ?>/blogs/stamps/general/introduction/">Blog</a></li>
                    <!--   <li class="active"><a href="<?php echo site_url(); ?>/admin/">Admin</a></li>-->
                    <!--  <li class="active"><a href="http://www.bjornblomquist.com/contact.html">Contact</a></li>-->
                    <li class="active"><a href="<?php echo site_url(); ?>/auth/login/">Login</a></li>
                </ul>
            </div>


        </div>
        <!-- END NAVIGATION -->
        <div id="pagehead-spacer" style="width:980px;margin-top:0;background:#fff url(<?php echo site_url(); ?>/img/spacer.jpg) no-repeat;"></div>
        <!-- TOP MENU NAVIGATION -->

        <!-- Start: Sidinneh�ll -->
        <div id="pagecontent" class="clearfix">
            <!-- Start: Contentrad -->
            <div id="left" class="content-row">
                <!-- Start: Inneh�llsklumn 1 -->
                <div id="left-menu" class="span-7">
                    <!--  <h2 style="color:#dd0000">Feature Image</h2>-->
                    <!-- The feature Image -->
                    <?php 
                    if (!isset($feature_image))
                    {
                        echo '';
                    }
                    else
                    {
                        echo '<img id="feature-image" src="'.$feature_image.'" style="margin-left:15px;width:220px" alt="" title="" />';
                    }
                    ?>

                    <?php 
                    if (!isset($credit))
                    {
                        echo '';
                    }
                    else
                    {
                        echo '<div style="margin-left:20px;width:80%;text-align:right"><span style="font-size:10px;color:#666">Credit: </span><a id="feature-image-credit" class="image-credit" href="'.$credit.'" style="font-size:10px;width:220px" alt="" title="" >'.$credit_source.'</a></div>';
                    }
                    ?>

                    <!-- The feature -->
                    <?php echo '<h3 id="feature" class="draggable" style="width:88%;color:#acacac;margin-left:15px">'.$feature.'</h3>'?>
                    <div id="demo-area" class="curvy clearfix  hidden" style="border:1px solid #bebebe;margin-right:20px;">
                    </div>

                    <div id="sidemenu"></div>

                    <?php
                    //create menu automatically needs to come from model/controller
                    echo '<ul>';
                    foreach ($list as $key=>$value){
                        $value=str_replace( '.dat', '', $value );
                        $value=str_replace( '/countries/'.$location.'/', '', $value );
                        $this->load->helper('inflector');
                        echo '<li><a href="'.$value.'">'.ucfirst(r('_',' ',$value)).'</a></li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
                <!-- Start: Side 2 -->
                <div class="span-17">
                    <div id='edit-block' style="width:200px;float:right">
                        <?php //echo 'title is'.$title;?>
                        <?php echo '<a href="' . site_url() . '/admin/post/edit/'.$location.'/'.$title.'">edit</a>'; ?>
                        <?php echo '<a href="' . site_url() . '/admin/post/new/'.$location.'/'.$title.'">new</a>'; ?>
                        <?php echo '<a target="_blank" href="' . site_url() . '/sandbox/pdflatex/'.$location.'/'.$title.'?='.time().'">texify</a>'; ?>
                        <!--<?php echo $date ?>-->
                        <div style="clear:both"></div>
                        <!--<?php echo $user ?>-->
                    </div>

                    <!--<?php echo $prev?><img src="<?php echo site_url(); ?>/egypt/previous.gif" style="float:left;margin-top:10px" />
                    <a href="<?php echo $next?>"><img src="<?php echo site_url(); ?>/egypt/next.gif" style="float:right;clear:right;margin-top:10px" /></a>-->

                    <div id="main-content" class="clearfix">
                        <?php echo markdown($content); ?>
                    </div>
                    <div style="clear:both"></div>
                    <div style="background:#000;color:#fff;width:30%;float:right;margin-bottom:3px">
                        <!-- NEXT -->
                        <div class=" draggable clearfix" style="padding-bottom:5px;padding-left:7px;padding-right:7px">
                            <a href="<?php echo $prev?>"><img class="draggable" src="<?php echo site_url(); ?>/egypt/previous.gif" style="float:left;margin-top:10px" alt= "" title="<?php echo $prev ?>" /></a>

                            <a href="<?php echo $next?>" title="<?php echo $next ?>"><img  src="<?php echo site_url(); ?>/egypt/next.gif" style="float:right;clear:right;margin-top:10px" alt="" /></a>

                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div style="font-size:10px">
                        <p><a href="<?php echo site_url().'/admin/post/edit/'.$location.'/'.$title; ?>">edit</a></p>
                        <?php 
                        $this->benchmark->mark('code_end');
                        echo $this->benchmark->elapsed_time('code_start', 'code_end');echo '  '.$this->benchmark->elapsed_time();?>
                        <?php echo '  '.$this->benchmark->memory_usage();?>
                    </div>
                </div>


            </div>
        </div>
        <!-- Start: footer -->
        <div style="margin-top:0;padding-left:70px;padding-right:100px;padding-top:30px;padding-bottom:30px;background:#fff url(<?php echo site_url(); ?>/images/spacer-bottom.jpg) no-repeat;">
            <p style="font-size:11px;width:98%;text-align:center">
                This site does not claim ownership of any of the pictures displayed in this gallery. The tag is there only to show that the picture was originally posted here or scanned or capped exclusively for this site. All pictures are copyright to their respective owner. No infringement intended. We believe we are using these images for fan purposes only, within the laws of the Fair Use Copyright Law 107. However, if you are unhappy with our usage of pictures that belong to you, please contact us and we will remove the image(s) immediately. We will always co-operate, there is no need to threaten us. Please, credit the site when reposting the images you found in this gallery. And download pictures for private usage only! Rest of Content &copy; Dr Y.Lazarides +46 (0) 738 -19 15 03 egypt (a) latenightengineer.com
            </p>
            <p style="float:none;margin:0 auto;font-size:11px;text-align:center">Data Policy | Accessibility | Contact Info | Privacy Policy | Copyright
            </p>

        </div>


    </div>
    <div id="floating-notices" style="width:200px;margin:0;padding:0;display:none;position:fixed;right:20px;bottom:20px;font-size:11px;" class="clearfix"></div>


</body>

</html>
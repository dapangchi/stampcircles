<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<title>Carousel Component Example - Two Static HTML Carousels</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/container/container_core-min.js"></script>
<script type="text/javascript" src="carousel.js"></script>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css">


<link href="carousel.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/base/base-min.css">  



<!-- 
    Inlined styles for my overrides to the carousel for this demo.
    Normally I would put this in a separate CSS file.
-->
<style type="text/css">
.carousel-component { 
    padding:8px 16px 4px 16px;
    margin-top:20px;
}

.carousel-component .carousel-list li { 
    margin:4px;
    width:79px; /* img width is 75 px from flickr + a.border-left (1) + a.border-right(1) + 
                   img.border-left (1) + img.border-right (1)*/
    height:93px; /* image + row of text (87) + border-top (1) + border-bottom(1) + margin-bottom(4) */
    /*    margin-left: auto;*/ /* for testing IE auto issue */
}

.carousel-component .carousel-list li a { 
    display:block;
    border:1px solid #e2edfa;
    outline:none;
}

.carousel-component .carousel-list li a:hover { 
    border: 1px solid #aaaaaa; 
}

.carousel-component .carousel-list li img { 
    border:1px solid #999;
    display:block; 
}
                                
.carousel-component .carousel-prev { 
    position:absolute;
    top:40px;
    z-index:3;
    cursor:pointer; 
    left:5px; 
}

.carousel-component .carousel-next { 
    position:absolute;
    top:40px;
    z-index:3;
    cursor:pointer; 
    right:5px; 
}
</style>

<script type="text/javascript">

var Carousel = function(carouselElementID, carouselCfg) {
         this.init(carouselElementID, carouselCfg);
};

Carousel.prototype = {
   init: function(id, cfg) {
      var config = {
            numVisible:        2,
            animationSpeed:    0.15,
            scrollInc:         1,
            navMargin:         20,
            size:              8,
         prevButtonStateHandler: this.handlePrevButtonState,
         nextButtonStateHandler: this.handleNextButtonState
      };

      for (var key in cfg) {
         if (!cfg.hasOwnProperty(key)) { continue; }
         config[key] = cfg[key];
      }

      this.carousel = new YAHOO.extension.Carousel(id, config);

   },

   handlePrevButtonState: function(type, args) {
        var enabling = args[0];
        var leftImage = args[1];
        if(enabling) {
            leftImage.src = "left-enabled.gif";    
        } else {
            leftImage.src = "left-disabled.gif";    
        }
   },

   handleNextButtonState: function(type, args) {
        var enabling = args[0];
        var rightImage = args[1];

        if(enabling) {
            rightImage.src = "right-enabled.gif";
        } else {
            rightImage.src = "right-disabled.gif";
        }
    }
};


/**
 * You must create the carousel after the page is loaded since it is
 * dependent on an HTML element (in this case 'mycarousel'.) See the
 * HTML code below.
 **/
var carousel, carousel2;

var pageLoad = function() 
{
    carousel = new Carousel("mycarousel", 
        { prevElement:"prev-arrow", nextElement:"next-arrow" });
    carousel2 = new Carousel("mycarousel2", 
        { prevElement:"prev-arrow2", nextElement:"next-arrow2", size:9, numVisible:4, scrollInc:3, revealAmount:20 });

};

YAHOO.util.Event.addListener(window, 'load', pageLoad);

</script>
</head>

<body >

<div id="doc" class="yui-t7">
   <div id="hd">
        <h1>Two Static HTML Carousels</h1>
   </div>
<div id="bd">
<p>Illustrates two carousels and how to encapsulate a base carousel class and reuse on the page.</p>

<!-- Carousel Structure -->
<div id="mycarousel" class="carousel-component">
    <div class="carousel-prev">
        <img id="prev-arrow" class="left-button-image" 
            src="carousel-snap-reveal.gif" alt="Previous Button"/>
    </div>
    <div class="carousel-next">
        <img id="next-arrow" class="right-button-image" 
            src="right-enabled.gif" alt="Next Button"/>
    </div>
    <div class="carousel-clip-region">
        <ul class="carousel-list">
            <li id="mycarousel-item-1"><a href="#"><img width="75" height="75" src="http://static.flickr.com/74/162582364_7fc3e2d60d_s.jpg" alt="item 1"/></a>Number One</li>
            <li id="mycarousel-item-2"><div><a href="#"><img width="75" height="75" src="http://static.flickr.com/67/162582262_e969394bc3_s.jpg" alt="item 2"/></a>Number Two</div></li>
            <li id="mycarousel-item-3"><a href="#"><img width="75" height="75" src="http://static.flickr.com/49/162582189_e0571b02e2_s.jpg" alt="item 3"/></a>Number Three</li>
            <li id="mycarousel-item-4"><a href="#"><img width="75" height="75" src="http://static.flickr.com/53/162581581_de49021696_s.jpg" alt="item 4"/></a>Number Four</li>
            <li id="mycarousel-item-5"><a href="#"><img width="75" height="75" src="http://static.flickr.com/74/161894590_9a1a9788e1_s.jpg" alt="item 5"/></a>Number Five</li>
            <li id="mycarousel-item-6"><a href="#"><img width="75" height="75" src="http://static.flickr.com/55/161894230_a4f1baf3d2_s.jpg" alt="item 6"/></a>Number Six</li>
            <li id="mycarousel-item-7"><a href="#"><img width="75" height="75" src="http://static.flickr.com/52/161894040_04f135f1a2_s.jpg" alt="item 7"/></a>Number Seven</li>
            <li id="mycarousel-item-8"><a href="#"><img width="75" height="75" src="http://static.flickr.com/54/161893927_c173a1e28c_s.jpg" alt="item 8"/></a>Number Eight</li>
        </ul>
    </div>
</div>


<!-- Second Carousel Structure -->
<div id="mycarousel2" class="carousel-component">
    <div class="carousel-prev">
        <img id="prev-arrow2" class="left-button-image" src="images/left-enabled.gif" alt="Previous Button"/>
    </div>
    <div class="carousel-next">
        <img id="next-arrow2" class="right-button-image" src="images/right-enabled.gif" alt="Next Button"/>
    </div>
    <div class="carousel-clip-region">
        <ul class="carousel-list">            
            <li id="mycarousel2-item-1"><a href="#"><img width="75" height="75" src="http://static.flickr.com/116/268249561_a32393f6ac_s.jpg" alt="item 1"/></a>Number 1</li>
            <li id="mycarousel2-item-2"><div><a href="#"><img width="75" height="75" src="http://static.flickr.com/97/268249177_d0f53c75ae_s.jpg" alt="item 2"/></a>Number 2</div></li>
            <li id="mycarousel2-item-3"><a href="#"><img width="75" height="75" src="http://static.flickr.com/91/268249048_67b9ecb504_s.jpg" alt="item 3"/></a>Number 3</li>
            <li id="mycarousel2-item-4"><a href="#"><img width="75" height="75" src="http://static.flickr.com/101/268248936_9cbaffeb08_s.jpg" alt="item 4"/></a>Number 4</li>
            <li id="mycarousel2-item-5"><a href="#"><img width="75" height="75" src="http://static.flickr.com/96/268248678_24c0a48e71_s.jpg" alt="item 5"/></a>Number 5</li>
            <li id="mycarousel2-item-6"><a href="#"><img width="75" height="75" src="http://static.flickr.com/106/268248583_f781f44205_s.jpg" alt="item 6"/></a>Number 6</li>
            <li id="mycarousel2-item-7"><a href="#"><img width="75" height="75" src="http://static.flickr.com/106/268248481_ca3ee38e1e_s.jpg" alt="item 7"/></a>Number 7</li>
            <li id="mycarousel2-item-8"><a href="#"><img width="75" height="75" src="http://static.flickr.com/92/268246360_cd1dc9269e_s.jpg" alt="item 8"/></a>Number 8</li>
            <li id="mycarousel2-item-9"><a href="#"><img width="75" height="75" src="http://static.flickr.com/114/268246264_150b9f97a5_s.jpg" alt="item 8"/></a>Number 9</li>
        </ul>
    </div>
</div>

<div style="padding-top:20px;clear:both">View the <a href="source.php?url=carousel_html_static_multiple.html">source</a>&nbsp;or&nbsp;<a href="index.html">documentation</a></div>

</div>
</div> 

</body>
</html>
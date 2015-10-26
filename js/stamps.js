/**
 * Site UI Class
 * stores functions applicable to the overall
 * site user management etc
 * must be called last
 * stamps.js variant of yl.js
 */
UI = {};
UI.now = goog.now();
UI.user= '';
UI.BASEPATH='/application-latest/js/';
UI.DEBUG='true';

// check how many js files were loaded
UI.filesLoaded=function() {
    var scripts = document.getElementsByTagName('script');
    var count = 0;
    for (var i = 0, n = scripts.length; i < n; i++) {
        if (scripts[i].src) {
            count++;
        }
    }
    log('number of files loaded :',count);
}

/* Alias to files loaded
 * just referring to js only
 */
UI.scriptsLoaded = UI.filesLoaded;

// main console routines
// user only enters some of the tags
// the balance is inserted automatically
UI.console = {}; 

// adds the toggle move onto FILTER
UI.console.addToggle=function(element){
    var $this=element;
    /*
    $('.console-wrap').prepend('<a href="#" class="toggleClass"' +
        'style="display:block;float:right;text-align:right;' +
        'margin-right:50px;width:200px">-collapse</a>');
    */
    $('a.toggleClass').on('click', function(){
        $this = $(this);
        if ($this.text() == '-collapse'){
            $this.text('+expand');
        } else {
            $this.text('-collapse');
        }
        $this.siblings('.code').toggle('slow');
        return false;
    });
}

// adds titles to all console blocks
// the description is in the title block
// default to something to prepend a general name
// hide a span at the bottom with chapter
UI.console.addTitle=function(){
    var n = $('#chapter').text();
    var s='\n\
           <span style="width:200px;float:left">' +
            'Listing ' + n + '- ';
    var s1='</span>';

    $(".console-wrap").each(function(i){
     var  $title = $(this).attr("title");
        if ($title == undefined) {
            $title = 'testing';
            $(this).prepend(s+(i+1)+' &nbsp; ' + s1);
        } else{
            $(this).prepend(s+(i+1)+' &nbsp; '+ $title + s1);
        }
    });
}

/*
  Add  buttons
 */
UI.console.addButtons=function(){
   // $('<button>Edit</button>').insertAfter('.eval').addClass('edit btn btn-inverse edit-console');
    $('<button>Clear</button>').insertAfter('.edit').addClass('clr btn btn-inverse').hide();
    $('<button>Done</button>').insertAfter('.clr').addClass('done btn btn-inverse').hide();
    $('<button>jslint</button>').insertAfter('.done').addClass('jslint-button btn btn-inverse').show().attr("enabled", "true").css('background-color','#999');
}

// consider changing to jSHint
UI.console.addJSLint=function(code){
    var myResult = JSLINT(code);
    var myData = JSLINT.data();
    var jslintReport = JSLINT.report(false);

    // Creates the Text Area
    // insert original code value for editing

    if ($that.siblings('.jslint').length==0){
        $('<div>').insertAfter($that.siblings('.results,#results')).val(code).addClass('jslint');
    }
    // insert heading for jslint
    var heading = '<h5 style="font-size:10px">jslint Report: </h5>';
    // insert jslint
    $that.siblings('.jslint').html(heading + jslintReport).hide();
    // hide jslint doen here for fast response on button
    $that.siblings('.jslint').hide();
    $that.siblings(".results").text('');
}


// given a block of code
// re-formats the spacing
// needs checking about UTF currently disabled
UI.formatSingleBlock = function (aScript){
    // aScript=aScript.entityify();
    if ($(this).hasClass('BEAUTY')){
        aScript = js_beautify(aScript, {
            preserve_newlines:true,
            indent_size: 4,
            space_after_anon_function : true
        });
    };
    return aScript;
}

// formats all code-blocks
// on the page using external script
UI.formatCode=function(elements){
    // capture array of all code-blocks
    // and cache into global variable
    var $c = $(elements);
    // set-up function for formatter
    // and caller
    function formatCode(aScript){
        if (!$(this).hasClass('PHP')||!$(this).hasClass('python')){
            aScript = js_beautify(aScript, {
                preserve_newlines:true,
                indent_size: 2,
                space_after_anon_function : true
            });
        };
        return aScript;
    }

    // use our own function to call it
    // this will format all scripts on page
    function beautify(){
        $c.each(function(){
            var b = $(this).text();
            if (!$(this).hasClass('PHP')||!$(this).hasClass('python')){
                b=formatCode(b);
                $(this).text(b);
            }
        })
    }
    beautify();
}

// Handles all floating notices
// @msg - message to show
// can extend this a bit



// creates a floating notice on the fly
UI.floatingNoticeCreate = function(msg){
    return '<div class="floating_notice clearfix">'+
    '<div class="floating_notice_top" style="background:url(http://localhost/codeigniter/images/floating_notice_top.png);'
    +'display:block;height:15px" ></div>'
    +'<div class="floating_notice_mid clearfix" style="background:url(http://localhost/codeigniter/images/floating_notice_mid.png) repeat-y;'
    +' display:block;padding:0;margin:0;clear:both">'
    +'<p id="floating-notice-message" style="width:90%;font-family:inherit;\n\
                   font-size:12px;padding:0;margin-left:8px;color:#fff">'
    +'<img src="/application-latest/images/underground_thumb.jpg" style="width:35px;float:left;margin-right:8px;margin-top:0">'
    +msg
    +'</p>'
    +'</div>'
    +'<div class="floating_notice_bottom" style="background:url(http://localhost/codeigniter/images/floating_notice_bottom.png);display:block;height:15px">'
    +'</div>'
    +'</div><div style="clear:both"></div>';
}

UI.floatingNotices=function(msg){
    if (msg==''){
        msg='You can earn points by running the examples.';
    }
    var s=UI.floatingNoticeCreate(msg);
    $(s).appendTo('#floating-notices'); // get first one to clone
     
    $('#floating-notices').show('slow');
    $('.floating_notice').css('opacity','0.85');
    $('.floating_notice:last').css('opacity','1.0');
    // we send the note out
    // after an 8s delay
    // we then remove
    // since all notices are appended and send
    // out with the same delay this notice is
    // the first one hence we remove
    // no need to complicate with a a que! KISS!
    setTimeout(function (){
        $('.floating_notice:first').remove()
    }, 2000);
}

UI.points=0;

UI.showPoints=function(element){
    if ($(element).attr('rel')!=='off'){
        $(element).attr('rel','on');
    }
    var pointsOn=$(element).attr('rel')
    UI.points=UI.points+5;
    if(pointsOn=='on'){
        UI.floatingNotices('You earned 5 points.<br/>Your total score is :<br/>'+UI.points+' points!');
    }
    $(element).attr('rel','off');
}

// array storing the code of all codeblocks
UI.CODEBLOCKS=[];

// We store the console we working temporarily here
UI.console.CURRENT='';

// profiler define at window level to avoid closure
function Profiler(text){
    var now1,now2,now3;
    this.say = function(text){
        var now = new Date();
        $that.siblings('.console').append(
            '<div style="font-size:10px">At '+
            (now.getHours()<10 ? '0':'')+now.getHours()+
            ':'+(now.getMinutes()<10 ? '0':'')+now.getMinutes()+
            ':'+(now.getSeconds()<10 ? '0':'')+now.getSeconds()+
            '.'+(now.getMilliseconds() <10 ? '00':(now.getMilliseconds()<100 ? '0':''))+
            now.getMilliseconds()+
            ' - '+text+'</div>'
            );
        return now;
    };
    this.start=function (text){
        if (typeof text == 'undefined' || text=='null' || text=='') {
            text='start';
        }
        now1 = this.say(text);
    };
    this.stop = function(text){
        if (typeof text=='undefined' || text=='null' || text=='' ){
            text = 'stop';
        }
        now2 = this.say(text);
    };
    this.timeDiff=function(){
        var diff=now2-now1;
        now3=this.say(diff+'ms')
        //$that.siblings('.console').append('<div>Time Difference: '+diff+'</div>');
        return diff;
    }
}
window.profiler = new Profiler;

// logging function
// needs a bit more work
function log() {
    var el = UI.console.CURRENT;
    var msg = '';
    var s = '';
    for ( var i = 0; i < arguments.length; i++ ) {
        if ((i == 0) || (i === arguments.length-1)){
            s ='';
        } else {
            s=", "
        }
        msg += " " + arguments[i] + s;
    }
    // if (DEBUG==true){
    el.siblings(".msg").addClass('min-height');
    el.siblings(".msg").append("<li  class='LOG' style='list-style-type:none'>" + msg + "</li>");
    console.log(msg); //added 2014.
// }

}

// logging function
// needs a bit more work
function logPRE(){
    var msg = '';
    var s = '';
    for ( var i = 0; i < arguments.length; i++ ) {
        if ((i==0) || (i===arguments.length-1)){
            s ='';
        }else{
            s=", "
        }
        msg += "" + arguments[i] + s;
    }
    //if (DEBUG==true){
    $that.siblings(".msg").addClass('min-height');
    $that.siblings(".msg").append("<li  class='LOG' style='list-style-type:none;white-space:pre'>" + msg +"</li>\n");
// }

}
            
     

/* Main Consoles
 * Code is here
 *
*/
$(document).ready(function(){
    // var DEBUG = true;
    INFO={
        a:'',
        b:''
    };
    window.INFO = INFO;
     //UI.formatCode('code');
    //UI.floatingNotices('Be carefull with what you buy!');
    UI.console.addToggle();
    UI.console.addTitle();
    UI.console.addButtons();
    //UI.console.prettyify();
    // set the points system on
   
    // Main evaluation of code
    $('button.eval').on('click', function (e) {
        //UI.showPoints($(this));
        //outside try to enable edit key in case of error
        $that = $(this);
        // enable edit key
        $that.siblings('.edit').attr('enabled','');
        $that.siblings('.jslint-button').attr('enabled','');

        UI.console.CURRENT = $that;
        try {
            // define $that as global better
            // the eval button is our focal point
           
            $that.text('Re-run');
            //get the js
            $codeElement = $that.siblings('.code').find('code');
            code = $codeElement.text();
            
            INFO.code = code;
            // get also html if it has any it shouldn't'
            // but is here for debugging
            html = $that.siblings('.code').find('code').html();
            INFO.html = html;
            $code=code;
            z=$code;
            html = $that.parent('.code-block').html();

            // jsLint Code and produce report
            UI.console.addJSLint(code);

            

            /* ASSERTS */
            function colorString_(val){
                if (val == "FAIL"){
                    var temp=' style="color:red" '
                } else {
                    temp = ' style="color:green" ';
                }
                return temp;
            }

            function assertEquals(var1,var2, var3){
                if (arguments.length == 2) { // missing msg
                    pass1=var1;
                    pass2=var2;
                    msg='';
                }
                else{
                    pass1=var1;
                    pass2=var2;
                    msg=var3;
                }
                $that.siblings(".results").addClass('min-height');
                var type = (pass1==pass2) ? "PASS" : "FAIL";
                if (msg==undefined){
                    msg='';
                }
                var temp=colorString_(type);
                // has problem just seeing class must check specisivity
                var result='<li style="font-size:12px";width:85%><strong'+ temp +'>'+type+ '</strong>: ' + (pass1+'') + ' == ' + (pass2+'&nbsp;&nbsp;') + msg + "</li>";
                $that.siblings(".results").append(result).hide().show(400);
            }

            function assert(var1,var2){
                if (arguments.length == 1) { // missing msg
                    pass1=var1;
                    msg='';
                } else {
                    pass1=var1;
                    msg=var2;
                }
                $that.siblings(".results").addClass('min-height');
                var type = (pass1) ? "PASS" : "FAIL";
                temp=colorString_(type);
                // has problem just seeing class must check specisivity
                var result='<li style="font-size:12px";width:85%><strong'+ temp +'>'+type+ '</strong>: &nbsp;&nbsp; '  +  msg + "</li>";
                $that.siblings(".results").append(result).hide().show(400);
            }


            // globalize
            window.assertEquals = assertEquals;

            window.assert = assert;
         
          

            function assertNull(value,msg){
                $that.siblings(".results").addClass('min-height');
                var type = (value==null) ? "PASS" : "FAIL";
                if (msg==undefined){
                    msg='';
                }
                temp=colorString_(type);
                var result='<li style="font-size:12px";width:85%><strong '+temp+'>'+type+ '</strong>:&nbsp;&nbsp; ' + value+' == null &nbsp;&nbsp;' + msg + "</li>";
                $that.siblings(".results").append(result).hide().show(400);
            }

            window.assertNull = assertNull;

            

            function assertFalse(value, msg) {
                
                var type = (!value) ? "PASS" : "FAIL";
                if (msg == undefined){
                    msg = '';
                }
                if (type == "FAIL"){
                    var temp=' style="color:red" '
                } else {
                    temp = '';
                }
                var result='<li style="font-size:12px";width:85%><strong'+ temp +'>'+type+ '</strong>: &nbsp;&nbsp; '  +  msg + "</li>";
            
                $that.siblings(".results").append(result).hide().show(300);
             
            }

            window.assertFalse = assertFalse;

            // simple error function
            function error(msg){
                $that.siblings(".results").append("<li class='error'><b>ERROR</b> " + msg + "</li>");
            }


            // main eval of code
            // should it be at global?
            //(function (){
            var time = goog.now();
            goog.global.eval(code)
            window.deltaT = goog.now()-time + 'ms';
        //eval(code);
                 
        //})();

        } catch (e) {
            error("An exception occurred in the script. Error name: " + e.name
                + "Error message: " + e.message + '   '+e.lineNumber);
        }

         

        // add little block for showing run-time
        
        if ($that.siblings('.timer').length==0){
            $('<div style="font-size:10px">').insertAfter($that.siblings('.msg')).addClass('timer');
        }
      
        $that.siblings('.timer').text(deltaT);
   
    });
    // END OF BUTTON EVAL CLICK

     
  

    $('.clr').click(function(){
        $(this).siblings('.edit-code').val('');
    });
   
    
    // edit click function
    $('.edit').on('mousedown', function () {
        //UI.floatingNotices('Press DONE when you finished!');
        //UI.showPoints($(this));
        // cache values
        var $edit=$(this);
        var $eval=$edit.siblings('.eval');
        var $done=$edit.siblings('.done');
        var $jslint=$edit.siblings('.jslint-button');
        var $msg=$edit.siblings('.msg');
        var $clr=$edit.siblings('.clr');

        var e = $edit.siblings('div.code.code-block').find('code');
        var z =e.text();
        // capture height no need tp capture
        // width - textarea is as wide as possible
        var h = e.height();
            
        // TODO NEED TO MAKE IT WORK WITH IE
        if ($edit.siblings('.edit-code').length==0){
            $('<textarea>').insertBefore($msg).val(z).addClass('edit-code').hide(); //change from z
            $('.edit-code').height(h+50);
            $('.edit-code').show('fast');
        }
        // hide and show buttons etc
        e.hide();
        $clr.show();
        $eval.hide();
        $done.show();

        //hide the edit key
        $edit.hide();
        $jslint.hide();
        // after edit we clear the message area
        $msg.html('');
    })


    $('.done').on('click', function () {
        //UI.floatingNotices('You need to press Re-run to execute your revision!');
        //read the value  from  the text area
        var newCode = $that.siblings('.edit-code').val();
        // reformat the block
        newCode=UI.formatSingleBlock(newCode);
        // rehighlight the block
        //alert(newCode)
        var element = $codeElement;  //$that.siblings('div.code.code-block').find('code').show();
        var d=element.text(newCode).show();
        $(this).siblings('.edit-code').remove();
        $(this).siblings('.eval').show();
        $(this).siblings('.edit').show();
        $(this).siblings('.clr').hide();
        //remove logs - check why not in results
        $(this).siblings('.msg').html('');
        $(this).hide();
        $that.siblings('.edit').attr('enabled','true');
        $that.siblings('.jslint-button').attr('enabled','true').show();
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    })
   

    // end EVAL CLICK

    // JS LINT BUTTON OUTSIDE SINCE WE CAN EVAL ANY TIME
    $('.jslint-button').on('click',function(){
        $(this).siblings('.jslint').toggle();
        //UI.floatingNotices('Take it easy on your feelings!<br/>30 points for jsLint!<br/>');
    });


 /*
    function makeSpace(){
        $('#slider, #sliderback').hide().fadeIn('slow');
        $('#lsidemenu').css('padding-top', '800px');
        $('#feature-image, #feature').fadeOut(1500);
    }

    window.makeSpace = makeSpace;
*/    
    wordCount= function (){
        var re = /\w+?\b/gi;
        var s = $('#main-content').text();
        s= $('body').text();
        s = s.match(re);
        return('number of word tokens in this article : '+ s.length);
    }
})

//document ready function

//editble p


$(document).ready(function(){
    var  plus = $('span#plus');
    plus.text = '+';
    var exercise = $('.exercise').eq(0);
    var h = exercise.css('height');
    plus.css('color','blue');
    h3=$('.collapser').css('height');

    $('.collapser').eq(0).css('height',h);
    $('#plus').click(function(){
        plus.text(' - ');
        $('.collapser').eq(0).css('height','17px');
        $('.exercise').toggle('slow');
        $(this).css('height','17px');
    });
});


//this is the only function that is used to toggle the top menu
//plenty others can be used like this
//essentially all the info boxes in order not
//to clutter pages

$(document).ready(function(){
    //$('#nav_inner').toggle();
    // loads the menu using Ajax
    // simple loading no tests
    // // moved onto template
   // $('#nav_inner').load('/CodeIgniter/js/countries_menu.html'); //<!-- change to jquery menu-->
    //$('#sidemenu').load('/CodeIgniter/js/countries_sidemenu.html');
    // $.getScript('/CodeIgniter/js/tokens.js');
    //  $.getScript('/CodeIgniter/js/parse.js');
    //  $.getScript('/CodeIgniter/js/json2.js');
   

    $('#subheading').on('click',function(){
        $('#subheading1').toggle();
    });

    var blocks = $('.code');
	
    function highL(){
        var l = blocks.length;
        for (var j=0; j < l; j++){
            goog.dom.setProperties(blocks[j],{
                'id': 'js' + j
            });
         console.log('Added js ids to all blocks js'+j);
        }
    }


    highL();
    for(var i=0;i<blocks.length;i++){

        anId='js'+i;
        // alert($('#'+anId).text());
		// removed tinyHighlighter
        //tinyHighlighter({
           // automaticSelector:anId
        //});
    }
	
    var options = {
        automatic: true,
        automaticSelector: "js" + 0,
        lineNumbers: true,
        zebraLines: false,
        recipeLoading: true,
        cssFolder: "",
        // if not in recipes folder
        highLights: ['test'] // a list of words to be highlighted
    // within the code
    }
//$.tinyHighlighter(options);
//
})

        

//Globals Must reduce
function say(text) {
  var now = new Date();
  $that.siblings('.console').append(
        '<div>At '+
        (now.getHours()<10 ? '0':'')+now.getHours()+
        ':'+(now.getMinutes()<10 ? '0':'')+now.getMinutes()+
        ':'+(now.getSeconds()<10 ? '0':'')+now.getSeconds()+
        '.'+(now.getMilliseconds()<10 ? '00':(now.getMilliseconds()<100 ? '0':''))+
        now.getMilliseconds()+
        ' - '+text+'</div>'
        );
}




function sayTime(text) {
    var now = new Date();
    $that.siblings('.console').append(
        '<div>At '+
        (now.getHours()<10 ? '0':'')+now.getHours()+
        ':'+(now.getMinutes()<10 ? '0':'')+now.getMinutes()+
        ':'+(now.getSeconds()<10 ? '0':'')+now.getSeconds()+
        '.'+(now.getMilliseconds()<10 ? '00':(now.getMilliseconds()<100 ? '0':''))+
        now.getMilliseconds()+
        ' - '+text+'</div>'
        );
}


/**general routines for
 *running Google Closure
 */

function googInfo(){
    if (goog) {
        for (var prop in goog.info) {
            log(goog.info[prop]);
        }
    } else {log('Closure not loaded');}
}










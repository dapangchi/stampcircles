
// CODE FOR C++ SANDBOX
// CONSOLE



UI.console.addPerlButtons=function(baseElementClass){
    $('<button>Edit</button>').insertAfter(baseElementClass).addClass('editPerl').attr("disabled", "true").css('background-color','#999');
    $('<button>Clear</button>').insertAfter('.editPerl').addClass('clr').hide();
    $('<button>Done</button>').insertAfter('.clr').addClass('donePerl').hide();
}

UI.console.addFormAndSandBox=function(parent_){
//element is the element after which this is inserted
//if (parent_.hasClass('snippet')){return;}
var s='<form class="myForm1" action="" method="post" style="padding-top:0;padding-bottom:0;margin-bottom:0;margin-top:0">'
      +'<textarea name="ascript" value="test" class="PerlTextArea"  style="display:none">'
      +'echo "another test of something";'
      +'</textarea>'
      +'</form>'
      +'<div  class ="sandbox sandbox-console" class="curvy">'
      +'</div>';
   $(s).insertAfter(parent_).show();
}


/* Main Consoles
 * Code is here
 *
 */
$(document).ready(function(){
    // capture all code from write up and insert into text area to make it
    // editable
   // fill all textareas with value from start
$('code').each(function(){
    var $this=$(this);
    var c=$this.text();
    var par=$this.parent();
    var grandparent=par.parent();
        UI.console.addFormAndSandBox(par);
    var $PerlTextArea= grandparent.find('.PerlTextArea');
        $PerlTextArea.val(c);
 });


   
   // UI.formatCode('code');
    UI.floatingNotices('Welcome to Perl!<br/>Watch your $!');
    // buttons with base class
    // at this stage we add all buttons
    UI.console.addPerlButtons('.evalPerl');


   
    // Main evaluation of code
    $('button.evalPerl').live('click', function(e){
        //alert('hi');
        UI.showPoints($(this));
        //outside try to enable edit key in case of error
        $that=$(this);
        log('... running ');
        // enable edit key
        $that.siblings('.editPerl').css('background-color','#666').attr('disabled','');
        UI.console.CURRENT=$that;
        try {
            // define $that as global better
            // the eval button is our focal point
        
            $that.text('Re-run');
            var time=goog.now();
            // call ajax routines
            var par=$(this).parent();
            var $sandbox= par.find('.sandbox');
            var $theForm= par.find('.myForm1');
            UI.evalPerl($sandbox, $theForm);
            window.deltaT=goog.now()-time+'ms';
                        
           
        } catch (e) {
            error("An exception occurred in the script. Error name: " + e.name
                + ". Error message: " + e.message + '   '+e.lineNumber);
        }

         
        // add little block for showing run-time
        
        if ($that.siblings('.timer').length==0){
            $('<div style="font-size:10px">').insertAfter($that.siblings('.msg')).addClass('timer');
        }
      
        $that.siblings('.timer').text(deltaT);
   
    });
    // END OF BUTTON EVAL CLICK
    // OK
    

    $('.clr').click(function(){
        $(this).siblings('.edit-code').val('');
    });
       
    // edit click function
    $('.editPerl').live('click', function () {
        UI.floatingNotices('Press DONE when you finished!');
        UI.showPoints($(this));
        //  tranverse the form and get all values
        var $edit=$(this);
        var $form=$edit.siblings('.myForm1');
        //alert($form,'This is myForm');

        var par=$(this).parent();
        var $PerlTextArea=par.find('.PerlTextArea');
        
        var PerlCodeElement=par.find('code');
            PerlCodeElement.hide();
            //alert(PerlCodeElement.text());
        var theCode=PerlCodeElement.text();
            $PerlTextArea.val(theCode).show();
            
        var $done=$edit.siblings('.donePerl').show();
        //var $jslint=$edit.siblings('.jslint-button');
        var $msg=$edit.siblings('.msg');
        var $clr=$edit.siblings('.clr').show();
    
        
        $edit.hide();
           
 })

  $('.donePerl').live('click', function () {
        //UI.floatingNotices('You need to press Re-run to execute your revision!');
        //read the value  from  the text area
        var par=$(this).parent();
        var $PerlTextArea= par.find('.PerlTextArea');
        var newCode = $PerlTextArea.val();
            $PerlTextArea.hide();
            log('new code',newCode);
            var PerlCodeElement=par.find('code');
            PerlCodeElement.text(newCode);
            PerlCodeElement.show();

        $(this).siblings('.evalPerl').show();
        $(this).siblings('.editPerl').show();
        $(this).siblings('.clr').hide();
        //remove logs - check why not in results
        $(this).siblings('.msg').html('');
        $(this).hide();
        //$that.siblings('.edit').css('background-color','#999').attr('disabled','true');
        //$PerlCode.show();
    })



    /* Main AJAX ROUTINES START HERE
     *
     *
     */
    UI.evalPerl= function (target,theForm, url){
        var options = {
            target: target,
            // target element(s) to be updated with server response
            beforeSubmit: showRequest,
            // pre-submit callback
            success: showResponse,
            // post-submit callback
            url: '/codeigniter/sandbox/cpp/?',
            type: 'POST'

            // other available options:
            //url:       url         // override for form's 'action' attribute
            //type:      type        // 'get' or 'post', override for form's 'method' attribute
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
            //clearForm: true        // clear all form fields after successful submit
            //resetForm: true        // reset the form after successful submit
            // $.ajax options can be used here too, for example:
            // timeout:   5000
        };
        // bind form using 'ajaxForm'
        $(theForm).ajaxForm(options);
        $(theForm).submit();
    }

    // pre-submit callback
    function showRequest(formData, jqForm, options) {
        // formData is an array; here we use $.param to convert it to a string to display it
        // but the form plugin does this for you automatically when it submits the data
        var queryString = $.param(formData);

        // jqForm is a jQuery object encapsulating the form element.  To access the
        // DOM element for the form do this:
        // var formElement = jqForm[0];
        //log('About to submit: \n\n' + queryString);
        // here we could return false to prevent the form from being submitted;
        // returning anything other than false will allow the form submit to continue
        return true;
    }

    // post-submit callback
    function showResponse(responseText, statusText) {
        // for normal html responses, the first argument to the success callback
        // is the XMLHttpRequest object's responseText property
        // if the ajaxForm method was passed an Options Object with the dataType
        // property set to 'xml' then the first argument to the success callback
        // is the XMLHttpRequest object's responseXML property
        // if the ajaxForm method was passed an Options Object with the dataType
        // property set to 'json' then the first argument to the success callback
        // is the json data object returned by the server
        //log( ('status: ' + statusText + '\n\nresponseText: \n' + responseText +
        //      '\n\nThe output div should have already been updated with the //responseText.').entityify());
    }
});













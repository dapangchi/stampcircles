/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var currentBlog       = {postId: 0,
                         newPost: 0, title: '',
                         categories: '',
                         skipToComments: '',
                         saving: 0};

function done() {

    if (!$('focusMe')) {
      var fm = document.createElement('input');
      fm.id = "focusMe";
      fm.style.border = "0";
      fm.style.height = "0px";
      fm.style.width  = "0px";
      fm.style.overflow = "hidden";
      fm.style.position = "absolute";
      fm.style.top = "0px";
      fm.style.width = "0px";
      document.body.appendChild(fm);
    }

    $('focusMe').focus();
    return false;

   }


   var preloadedImages = Array();

   var lastEventID;
   lastEventID = Array();
   var tipsShown = 20;
   function showTip(text, posElement, color, tipID, animate, width) {

    //if(isClientSite){return;}
    if (!tipID) { tipID = tipsShown; tipsShown++; }

    var element = $(posElement);
    if (element && typeof(element.style) == "undefined") { return; }

    if (animate ==1) { width = 200; } else if (!width) { width = 400; }

    var pos = Position.cumulativeOffset(element);
    var dimensions = Element.getDimensions(element);

    var left = pos[0]+10;
    var triangleLeft = 16;
    var bodyWidth = $(document.body).getWidth();
    if (left + width > bodyWidth - 10) {
        var leftDiff = (left + width) - (bodyWidth - 10);
        left -= leftDiff;
        triangleLeft += leftDiff;
    }

    if (color == 'y') {
        new Insertion.Top('tips',
            "<div id='tip"+tipID+"' style='position: absolute; \n\
                  display: none; z-index: 25; width: "+width+"px; text-align:left'>" +
            "<iframe class='hiddenIframe' style='z-index: -1; filter: mask(); position: absolute; width: "+width+"px; height: 46px;'></iframe>" +
            "<div style='position: absolute; top:12px; right:6px; cursor: pointer;'>x</div>" +
            "<div style=\"background: url('http://"+editorStatic+"/weebly/images/tooltip2.gif') no-repeat "+triangleLeft+"px 0; height: 12px; overflow: hidden; position:relative; top:1px\"> &nbsp; </div>" +
            "<div style='text-align:left; border:1px solid #ccc; background: #FFFFCC; padding: 10px; font-family: verdana; font-weight: bold; font-size: 12px;'>"+text+"</div>" +
            "</div>"
        );
    } else {
        new Insertion.Top('tips',
            "<div id='tip"+tipID+"' style='position: absolute; display: none; z-index: 25; width: "+width+"px; text-align:left'>" +
            "<div style='position: absolute; top:12px; right:6px; cursor: pointer;'>x</div>" +
            "<div style=\"background: url('http://"+editorStatic+"/weebly/images/tooltip2-w.gif') no-repeat "+triangleLeft+"px 0; height: 12px; overflow: hidden; position:relative; top:1px\"> &nbsp; </div>" +
            "<div style='text-align: left; border: 1px solid #ccc; background: #FFFFFF; padding: 10px; font-family: verdana; font-weight: bold; font-size: 12px;'>"+text+"</div>" +
            "</div>"
        );
    }

    var top = (pos[1]+dimensions.height);

        Element.setStyle($('tip'+tipID), { position: 'absolute', top: top+'px', left: left+'px' });

        if (animate == 1) {
      Element.show('tip'+tipID);
    } else if (animate == 2) {
      Effect.Appear('tip'+tipID);
    } else {
      setTimeout("appearTip("+tipID+", "+left+", "+top+", "+dimensions.height+");", 500);
    }
   }
   function appearTip(tipID, left, top, dimensionsHeight) {
    Element.setStyle($('tip'+tipID), { position: 'absolute', left: left+'px', top: ((getInnerHeight()/2)+dimensionsHeight)+'px' });
    Element.show('tip'+tipID);
    new Effect.Move('tip'+tipID, {x: left, y: top, mode: 'absolute', transition: Effect.Transitions.Bounce});
   }
   function hideTip(tipID, animate) {

    if (!tipID || !$(tipID)) { return; }
    var tipPointer = tipID;
    //console.log($(tipID).firstChild.tagName);
    if($(tipID).firstChild.tagName == "IFRAME") {
      $(tipID).removeChild($(tipID).firstChild);
    }
        if (animate == 1) { Element.hide($(tipID)); $('tips').removeChild($(tipID)); } else { Effect.Fade($(tipID), {afterFinish: function() { if ($(tipPointer) && $(tipPointer).parentNode == $('tips')) { $('tips').removeChild($(tipPointer)); }} }); }

   }

   function hideAllTips() {

        // Hide all tips
        for (var x=0; x < $('tips').childNodes.length; x++) {
          hideTip($('tips').childNodes[x]);
        }

   }

    function checkFlash()
    {
        if ((navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.indexOf("Mac") == -1 && navigator.appVersion.indexOf("3.1") == -1) || (navigator.plugins && navigator.plugins["Shockwave Flash"]) || navigator.plugins["Shockwave Flash 2.0"]){
            //showError2("<div style=\"text-align:center;\">Adobe Flash Player is required in order to use Weebly.<br/><br/><a target='_new' href='http://www.adobe.com/go/getflashplayer'><img style='border:0;' onClick='Effect.Fade(\"error2\");' src='http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg'><a/></div>");
        }
        else {
            showError("<div style=\"text-align:center;\">"+/*tl(*/"Adobe Flash Player is required in order to use Weebly."/*)tl*/+"<br/><br/><a target='_new' href='http://www.adobe.com/go/getflashplayer'><img style='border:0;' onClick='Effect.Fade(\"error2\");' src='http://"+editorStatic+"/weebly/images/get_flash.jpg'><a/></div>");
        }
    }

function checkContentEditable()
{
    var testEl = new Element('div');

    if(typeof testEl.contentEditable == 'undefined') {
        showError("<div style=\"text-align:center;\">"+/*tl(*/"You are using an outdated browser. \n\
           In order to edit text in the Weebly Editor you need to upgrade \n\
           to a modern web browser."/*)tl*/+"<br/><br/><div style='width:350px; margin:10px auto; \n\
           background:#FEEFDA;'><a href='http://www.firefox.com' target='_blank' \n\
           style='margin-right:15px;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-firefox.jpg' \n\
           style='border: none;' alt='Get Firefox 3.5'/></a>\n\
           <a href='http://www.browserforthebetter.com/download.html' target='_blank' \n\
           style='margin-right:15px;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-ie8.jpg' \n\
           style='border: none;' alt='Get Internet Explorer 8'/> \n\
           </a><a href='http://www.apple.com/safari/download/' target='_blank' \n\
           style='margin-right:15px;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-safari.jpg' \n\
           style='border: none;' alt='Get Safari 4'/></a><a href='http://www.google.com/chrome' \n\
           target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-chrome.jpg' \n\
           style='border: none;' alt='Get Google Chrome'/></a></div></div>");
    }
}

   function showEvent(eventName, dontPush, eventElement, width) {

    if (userEvents[eventName]) { return; }

    var eventData = {};
    if (siteType == 'myspace') {

      eventData = {
            'showThemeOptions': {
                text: /*tl(*/'To get started, choose a color palette.'/*)tl*/
            },

        'tab_edit': {
        text: /*tl(*/'You can drag these widgets and applications on to your profile.'/*)tl*/,
        eventElement: $('elementlist').firstChild
        }

      }

    } else {

      eventData = {
        'first_tip': {
        text: /*tl(*/'Great! Now drag one of these elements on to your page.'/*)tl*/,
        eventElement: $('elementlist').firstChild
        },

        'tab_themes': {
        text: /*tl(*/'Hover over designs to get a preview, and click to select a design.'/*)tl*/,
        eventElement: $('themePictures').firstChild
        },

        'addElement': {
        text: /*tl(*/'Nice! Now, click here to change your design.'/*)tl*/,
        eventElement: $('weebly_tab_themes')
        },

        'showProperties': {
        text: /*tl(*/'This menu bar lets you change things about the element you clicked.'/*)tl*/,
        eventElement: $('menuBarDiv').childNodes[0]
        },

        'tab_pages': {
        text: /*tl(*/'Click on "Add Page" to add a page, or "Add Blog" to add a blog to your site.'/*)tl*/,
        eventElement: $('pageManagerAddPage')
        },

        'newPage': {
        text: /*tl(*/'Title your page here. Once you\'ve done that, click "Save" below.'/*)tl*/
        },

        'updatePages': {
        text: /*tl(*/'Nice job, Click "Publish" when you want to publish or update your site online.'/*)tl*/,
        eventElement: $('publishButton')
        },

        'selectTheme': {
        text: /*tl(*/'Looking good. Click here to add more pages.'/*)tl*/,
        eventElement: $('weebly_tab_pages')
        },

        'navMore' : {
        text: "Your other pages have been placed here.<br />We recommend creating sub-pages under the <a href='#' onclick=\"Pages.go('pagesMenu');return false;\">Pages</a> tab or you can disable the \"more\" feature under <a href='#' onclick=\"Pages.go('displaySiteSettings',1);return false\">Settings</a>.",
        eventElement: $('wsite-nav-more-a'),
        width: 400
        },

        'secondPage': {
        text: "If you'd like, drag pages left and right to create a hierarchy.",
        width: 300
        }

      }

    }

    if (eventName == 'navMore' || eventName == 'secondPage') {
      setTimeout(function() {
          var eventEl = eventElement ? eventElement : eventData[eventName].eventElement;
          width = eventData[eventName].width ? eventData[eventName].width : width;
          showTip(eventData[eventName].text, eventEl, 'y', null, null, width);
      }, 500);
    }
    else if (eventData[eventName] && settingTooltips == 0) {
      hideAllTips();
      var eventEl = eventElement ? eventElement : eventData[eventName].eventElement;
      width = eventData[eventName].width ? eventData[eventName].width : width;
      showTip(eventData[eventName].text, eventEl, 'y', null, null, width);
    }

    userEvents[eventName] = 1;
    if (!dontPush) {
      new Ajax.Request(ajax, {
        parameters: {
            pos: 'doevent',
            event: eventName,
            cookie: document.cookie
        }
      });
      fireTrackingEvent("Event", eventName);
    }

   }

   Weebly.trackingArray = Array();

   function fireTrackingEvent(category, action, optional_label, optional_value) {

    try {

      optional_value = optional_value ? optional_value : 0;

      if (!doTrackingEvent(category, action, optional_label, optional_value)) {
        throw("Did not process tracking event");
      }

      if (Weebly.trackingArray.length > 0) {
        for (var i = 0; i < Weebly.trackingArray.length; i++) {
          var c = Weebly.trackingArray[i];
          doTrackingEvent(c.category, c.action, c.optional_label, c.optional_value);
        }

        Weebly.trackingArray = Array();
      }
    } catch (e) {
      Weebly.trackingArray.push({'category': category, 'action': action, 'optional_label': optional_label, 'optional_value': optional_value});
    }

   }

   function doTrackingEvent(category, action, optional_label, optional_value) {

     try {

       if(typeof(pageTracker) == 'object') {
           pageTracker._trackEvent(category, action, optional_label, parseInt(optional_value));
       } else {
           _gaq.push(['_trackEvent', category, action, optional_label, parseInt(optional_value)]);
       }
       mpmetrics.track(category, {'type': action});

     } catch (e) { return false; }

     return true;

   }

   function fireTransactionEvent(orderId, sku, price, affiliation, category) {

      try {
        if(typeof(pageTracker) == 'object') {
            pageTracker._addTrans(orderId, affiliation, price, "", "", "", "", "");
            pageTracker._addItem(orderId, sku, sku, category, price, "1");
            pageTracker._trackTrans();
        } else {
            _gaq.push(['_addTrans', orderId, affiliation, price, "", "", "", "", ""]);
            _gaq.push(['_addItem', orderId, sku, sku, category, price, "1"]);
            _gaq.push(['_trackTrans']);
        }

                mpmetrics.track("Purchase "+category);
      } catch (e) { }

   }



    var errorDialog;

    function showError(message, t, dontTrack) {

        if (typeof(message) == "string") {
          $('red-error-title').update(/*tl(*/"Oops!"/*)tl*/);
          $('red-error-text').update(message);
        } else {
          $('red-error-title').update(message.title);
          $('red-error-text').update(message.message);
        }

        errorDialog = new Weebly.Dialog($('red-error'), {inner_class:'weebly-dialog-inner-red', modal: 1});
        errorDialog.open();
        if (!dontTrack) {
            fireTrackingEvent("WeeblyError", "Error", message);
        }
        var params = {
            pos: 'oopserror',
            message: message
        };
        if(typeof(t) === 'object'){
            params.ajax_request = t.request.body.match(/^.*?&cookie/)[0];
            params.ajax_response = t.responseText;
            params.ajax_status = t.status;
            params.server = t.getHeader('X-Host');
            if(t.request.times){
                params.ajax_start = t.request.times.start;
                params.ajax_initialized = t.request.times.initialized;
                params.ajax_sent = t.request.times.sent;
                params.ajax_response_start = t.request.times.response;
                params.ajax_complete = (new Date().getTime() - t.request.times.start);
                params.current_upload = t.request.concurrentUpload ? 1 : 0;
            }
        }
        params.cookie = document.cookie;
        new Ajax.Request(ajax, {
            parameters: params,
            bgRequest: true
        });

        return errorDialog;
    }

    function hideError() {
        if (errorDialog) {
            errorDialog.close();
        }
    }


    var retriableErrorDialog;
        var retriableAjax;

    function showRetriableError(message, ajax, showX) {

        retriableAjax = ajax;

        var redirect = configSiteName ? configSiteName : "www.weebly.com";
        var additionalMsg = "<br/><br/>"+/*tl(*/"If you're still having trouble, please contact support at support@weebly.com."/*)tl*/;
        additionalMsg += "<br/><br/>";
        additionalMsg += "<a href='#' onclick='window.location.href=\"http://"+configSiteName+"/\"' class='big-grey-button'><span class='button-inner'>"+/*tl(*/"Exit"/*)tl*/+"</span></a>&nbsp;&nbsp;";
        additionalMsg += "<a href='#' onclick='retryRetriableError();' class='big-blue-button'><span class='button-inner'>"+/*tl(*/"Retry"/*)tl*/+"</span></a>";

        if (typeof(message) == "string") {
          $('red-error-title').update(/*tl(*/"Oops!"/*)tl*/);
          $('red-error-text').update(message+additionalMsg);
          fireTrackingEvent("WeeblyError", "Retriable Error", message);
        } else {
          $('red-error-title').update(message.title);
          $('red-error-text').update(message.message+additionalMsg);
          fireTrackingEvent("WeeblyError", "Retriable Error", message.message);
        }

        retriableErrorDialog = new Weebly.Dialog($('red-error'), {inner_class:'weebly-dialog-inner-red', modal: 1, showClose: showX});
        retriableErrorDialog.open();

        return retriableErrorDialog;
    }

    function retryRetriableError() {
        hideRetriableError();
        retriableAjax.retry(true);
    }

    function hideRetriableError() {
        if (retriableErrorDialog) {
            retriableErrorDialog.close();
        }
    }

    var warningDialog;

    function showWarning(message, options) {

        options = Object.extend({
            width: '585px',
            titleFontSize : '36px',
            showClose: true,
            closeFunction : null
        }, options);

        $('orange-error').setStyle({width:options.width});
        $('orange-error-title').setStyle({fontSize:options.titleFontSize});

        if (typeof(message) == "string") {
          $('orange-error-title').update(/*tl(*/"Oops!"/*)tl*/);
          $('orange-error-text').update(message);
          fireTrackingEvent("WeeblyError", "Warning", message);
        } else {
          $('orange-error-title').update(message.title);
          $('orange-error-text').update(message.message);
          fireTrackingEvent("WeeblyError", "Warning", message.message);
        }

        warningDialog = new Weebly.Dialog($('orange-error'), {inner_class:'weebly-dialog-inner-orange', modal: 1, showClose:options.showClose, closeFunction:options.closeFunction});
        warningDialog.open();

        return warningDialog;
    }

    function hideWarning() {
        if (warningDialog) {
            warningDialog.close();
        }
    }


    var confirmDialog;
    var lastConfirmOk = false;

    function showConfirm(options) {

        var content;
        lastConfirmOk = false;

        if (!confirmDialog) {
            content = new Element('div', { 'id': 'confirmDialogContent', 'class': 'orange-error weebly-text' });
            confirmDialog = new Weebly.Dialog(content, {
                inner_class:'weebly-dialog-inner-orange',
                onClose: function() {
                    if (!lastConfirmOk && options.onCancel) {
                        options.onCancel();
                    }
                }
            });
        }else{
            content = $('confirmDialogContent');
        }

        content.update(
            "<div class='orange-error-heading'>" +
                "<span class='orange-error-title' style='font-size:24px'>" + options.title + "</span>" +
            "</div>" +
            "<div class='orange-error-text'>" +
                options.message +
                "<div class='orange-error-buttons' style='margin-top:2em'></div>" +
            "</div>"
        );

        var okButton = new Element('button', { style: 'padding:.5em 1em;cursor:pointer' })
            .update(options.okText || 'OK')
            .observe('click', function() {
                options.onConfirm();
                lastConfirmOk = true;
                confirmDialog.close();
            });

        var cancelButton = new Element('button', { style: 'padding:.5em 1em;cursor:pointer' })
            .update(options.cancelText || 'Cancel')
            .observe('click', function() {
                confirmDialog.close();
            });

        content.select('div.orange-error-buttons')[0]
            .insert(okButton)
            .insert(' ')
            .insert(cancelButton);

        confirmDialog.open();

    }




    var whoisDialog;
    function showUpdateWhois(serviceID, paymentType, userServiceID, sld, tld, years) {

        $('whois-complete').onclick = function() { submitWhois(); return false; };
        $('whois-complete').style.opacity = '1';
        $('whois-error').innerHTML = "";

        $('whois-totalAmount').innerText = (years*10)+".00";
        $('whois-fields-domain').innerText = sld+"."+tld;
        $('whois-fields-userServiceID').value = userServiceID;

        if (serviceID.match(/customDomainWhois/)) {
          $('whoisProtectContainer-public').style.display = 'none';
          $('whoisProtect-public').name = "whois-blank";
          $('whoisProtectContainer-private').style.display = 'none';
          $('whoisProtect-private').name = "whois-blank";
          $('whoisProtectContainer-purchasedPrivate').style.display = 'block';
          $('whoisProtect-purchasedPrivate').name = "whois-protect";
        } else if (paymentType == "PayPal") {
          $('whoisProtectContainer-public').style.display = 'none';
          $('whoisProtect-public').name = "whois-blank";
          $('whoisProtectContainer-private').style.display = 'none';
          $('whoisProtect-private').name = "whois-blank";
          $('whoisProtect-purchasedPayPal').name = "whois-protect";
        }

        whoisDialog = new Weebly.Dialog($('update-whois'), {modal: 1, closeFunction: Weebly.goHome });
        whoisDialog.open();

    }

    function submitWhois() {

        $('whois-complete').onclick = function() { return false; };
        $('whois-complete').style.opacity = '0.5';
        $('whois-error').innerHTML = "";

        var errorFields = [];
        var fields = ['whois-name', 'whois-email', 'whois-address', 'whois-city', 'whois-state', 'whois-zip', 'CCCountry', 'whois-phone'];

        for (var x=0; x < fields.length; x++) {

          if (fields[x] != "CCCountry") { $(fields[x]).parentNode.style.border = "1px solid #999"; }

          if ($(fields[x]).value == "") {
            errorFields.push(fields[x]);
          }

          if (fields[x] == "whois-name" && !$(fields[x]).value.match(" ")) {
            errorFields.push(fields[x]);
          }
        }

        if (errorFields.length > 0) {

          for (var x=0; x < errorFields.length; x++) {
            $(errorFields[x]).parentNode.style.border = "1px solid red";
          }

          $('whois-complete').onclick = function() { submitWhois(); return false; };
          $('whois-complete').style.opacity = '1';
          $('whois-error').innerHTML = /*tl(*/"Please complete the missing form fields."/*)tl*/;

        } else {

          //Do AJAX call here
          var params = $('whois-form').serialize(true); // true means return object
          params.pos = 'updatedomainwhois';
          params.cookie = document.cookie;
          new Ajax.Request(ajax, {
            parameters: params,
            onSuccess: handlerSubmitWhois,
            onFailure: errFunc
          });

        }

    }

    function handlerSubmitWhois(t) {

        if (t.responseText.match("%%SUCCESS%")) {
          whoisDialog.close();
          Pages.go('purchaseConfirmation', 'domain');
        } else {
          $('whois-complete').onclick = function() { submitWhois(); return false; };
          $('whois-complete').style.opacity = '1';
          $('whois-error').innerHTML = t.responseText;
        }
    }

    function selectWhoisSetting(setting) {

        if (setting == "public") {
          $('whoisProtectContainer-private').removeClassName('multiple-choice-box-selected');
          $('whoisProtectContainer-public').addClassName('multiple-choice-box-selected');
          $('whoisProtect-public').checked = true;
          $('whois-totalContainer').style.display = 'none';
        } else {
          $('whoisProtectContainer-public').removeClassName('multiple-choice-box-selected');
          $('whoisProtectContainer-private').addClassName('multiple-choice-box-selected');
          $('whoisProtect-private').checked = true;
          $('whois-totalContainer').style.display = 'inline';
        }
    }
/*
    function showWarning(message) {
        $('warning-text').update( message );
        $('warning').show();
    }
*/



    function showError2(message) {
        $('errorText2').innerHTML = message;
        Effect.Appear('error2');
    }

    function hoverOn(hoverID, type) {
    if (isIn(lastEventID, hoverID)) { } else {
      if (settingTooltips == 1) {
        var text;
        if (type == 1) { text = /*tl(*/"<b>Double click</b> to edit."/*)tl*/; }
        if (type == 2) { text = /*tl(*/"<b>Click</b> to change pages.\n<b>Drag</b> to rearrange order.\n<b>Double Click</b> to edit."/*)tl*/; }
        if (type == 3) { text = /*tl(*/"<b>Drag</b> to rearrange order.\n<b>Drag to Trash</b> to delete."/*)tl*/; }
        showTip(text, hoverID, 'y', hoverID, 1);
        lastEventID.push(hoverID);
      }
      //var element = document.getElementById(hoverID);
      //element.className = element.className + "-hover";
    }
    }

    function hoverOff(hoverID) {
    if (settingTooltips == 1) {
      hideTip('tip'+hoverID);
    }
        //var element = document.getElementById(hoverID);
        //element.className = element.className.replace("-hover","");
    if(isIn(lastEventID, hoverID)) { lastEventID.splice(isIn(lastEventID, hoverID), 1); }
    }

    function preloadImages(images) {

    //console.log("preloadImages: "+images);

    var imagesArray = images.split(",");
    for (var x = 0; x < imagesArray.length; x++) {
      var y = preloadedImages.length;
      preloadedImages[y] = new Image;
      preloadedImages[y].src = imagesArray[x];
    }

    //console.log(preloadedImages.length);

    }

    function duplicateStyle(origEl, newEl, containerEl) {
      // Write styles
          if (origEl.currentStyle) {
        //Only works in IE

            for(var nsName in origEl.currentStyle) {
              var nsValue = origEl.currentStyle[nsName];
              if(nsValue != "" && !(nsValue instanceof Object) && nsName != "length" && nsName != "parentRule" && nsName != "display" && !nsName.match(/border/) && !nsName.match(/margin/) && !nsName.match(/line/)) {
                //alert(nsName+":"+nsValue);
                //console.log("write!");
                if (nsName != "display" && !nsName.match(/border/) && !nsName.match(/margin/)) {
                  newEl.style[nsName] = nsValue;
                }
                if (nsName != "width" && nsName != "height" && !nsName.match(/padding/) && !nsName.match(/border/)) {
                  containerEl.style[nsName] = nsValue;
                }
              }
            }

          } else {
            // Only works for Non-IE

            var ns = document.defaultView.getComputedStyle(origEl,'');

            for(var nsName in ns) {
              var nsValue = ns[nsName];
              //console.log("style "+ns[name]+"="+value);
              //alert("style "+ns[name]+"="+value);
              if(nsValue != "" && !(nsValue instanceof Object) && nsName != "length" && nsName != "parentRule" && nsName != "display" && !nsName.match(/border/) && !nsName.match(/margin/)) {
                //console.log("write!");

                // Handle Safari
        if (nsName.match(/^[0-9]+$/)) {
          nsName = nsValue;
          nsValue = ns[nsName];

        }

                if (nsName != "cssText" && nsName != "display" && !nsName.match(/border/) && !nsName.match(/margin/) && !nsName.match(/webkit/)) {
                  newEl.style[nsName] = nsValue;
          //if (nsName == "width") { alert(nsValue); alert(newEl.id); }
                }
                if (nsName != "width" && nsName != "height" && nsName != "maxWidth" && nsName != "maxHeight" && !nsName.match(/padding/) && !nsName.match(/border/)) {
                  containerEl.style[nsName] = nsValue;
                }
              }
            }
          }

      newEl.style.margin = "0";
      //newEl.style.padding = "0";

    }

/**
 * http://www.openjs.com/scripts/events/keyboard_shortcuts/
 * Version : 2.01.A
 * By Binny V A
 * License : BSD
 */
shortcut = {
    'all_shortcuts':{},//All the shortcuts are stored in this array
    'add': function(shortcut_combination,callback,opt) {
        //Provide a set of default options
        var default_options = {
            'type':'keydown',
            'propagate':false,
            'disable_in_input':false,
            'target':document,
            'keycode':false
        }
        if(!opt) opt = default_options;
        else {
            for(var dfo in default_options) {
                if(typeof opt[dfo] == 'undefined') opt[dfo] = default_options[dfo];
            }
        }

        var ele = opt.target
        if(typeof opt.target == 'string') ele = document.getElementById(opt.target);
        var ths = this;
        shortcut_combination = shortcut_combination.toLowerCase();

        //The function to be called at keypress
        var func = function(e) {
            e = e || window.event;

            if(opt['disable_in_input']) { //Don't enable shortcut keys in Input, Textarea fields
                var element;
                if(e.target) element=e.target;
                else if(e.srcElement) element=e.srcElement;
                if(element.nodeType==3) element=element.parentNode;

                if(element.tagName == 'INPUT' || element.tagName == 'TEXTAREA') return;
            }

            //Find Which key is pressed
            if (e.keyCode) code = e.keyCode;
            else if (e.which) code = e.which;
            var character = String.fromCharCode(code).toLowerCase();

            if(code == 188) character=","; //If the user presses , when the type is onkeydown
            if(code == 190) character="."; //If the user presses , when the type is onkeydown

            var keys = shortcut_combination.split("+");
            //Key Pressed - counts the number of valid keypresses - if it is same as the number of keys, the shortcut function is invoked
            var kp = 0;

            //Work around for stupid Shift key bug created by using lowercase - as a result the shift+num combination was broken
            var shift_nums = {
                "`":"~",
                "1":"!",
                "2":"@",
                "3":"#",
                "4":"$",
                "5":"%",
                "6":"^",
                "7":"&",
                "8":"*",
                "9":"(",
                "0":")",
                "-":"_",
                "=":"+",
                ";":":",
                "'":"\"",
                ",":"<",
                ".":">",
                "/":"?",
                "\\":"|"
            }
            //Special Keys - and their codes
            var special_keys = {
                'esc':27,
                'escape':27,
                'tab':9,
                'space':32,
                'return':13,
                'enter':13,
                'backspace':8,

                'scrolllock':145,
                'scroll_lock':145,
                'scroll':145,
                'capslock':20,
                'caps_lock':20,
                'caps':20,
                'numlock':144,
                'num_lock':144,
                'num':144,

                'pause':19,
                'break':19,

                'insert':45,
                'home':36,
                'delete':46,
                'end':35,

                'pageup':33,
                'page_up':33,
                'pu':33,

                'pagedown':34,
                'page_down':34,
                'pd':34,

                'left':37,
                'up':38,
                'right':39,
                'down':40,

                'f1':112,
                'f2':113,
                'f3':114,
                'f4':115,
                'f5':116,
                'f6':117,
                'f7':118,
                'f8':119,
                'f9':120,
                'f10':121,
                'f11':122,
                'f12':123
            }

            var modifiers = {
                shift: { wanted:false, pressed:false},
                ctrl : { wanted:false, pressed:false},
                alt  : { wanted:false, pressed:false},
                meta : { wanted:false, pressed:false}   //Meta is Mac specific
            };

            if(e.ctrlKey)   modifiers.ctrl.pressed = true;
            if(e.shiftKey)  modifiers.shift.pressed = true;
            if(e.altKey)    modifiers.alt.pressed = true;
            if(e.metaKey)   modifiers.meta.pressed = true;

            for(var i=0; k=keys[i],i<keys.length; i++) {
                //Modifiers
                if(k == 'ctrl' || k == 'control') {
                    kp++;
                    modifiers.ctrl.wanted = true;

                } else if(k == 'shift') {
                    kp++;
                    modifiers.shift.wanted = true;

                } else if(k == 'alt') {
                    kp++;
                    modifiers.alt.wanted = true;
                } else if(k == 'meta') {
                    kp++;
                    modifiers.meta.wanted = true;
                } else if(k.length > 1) { //If it is a special key
                    if(special_keys[k] == code) kp++;

                } else if(opt['keycode']) {
                    if(opt['keycode'] == code) kp++;

                } else { //The special keys did not match
                    if(character == k) kp++;
                    else {
                        if(shift_nums[character] && e.shiftKey) { //Stupid Shift key bug created by using lowercase
                            character = shift_nums[character];
                            if(character == k) kp++;
                        }
                    }
                }
            }

            if(kp == keys.length &&
                        modifiers.ctrl.pressed == modifiers.ctrl.wanted &&
                        modifiers.shift.pressed == modifiers.shift.wanted &&
                        modifiers.alt.pressed == modifiers.alt.wanted &&
                        modifiers.meta.pressed == modifiers.meta.wanted) {
                callback(e);

                Event.stop(e);
                return false;
                if(!opt['propagate']) { //Stop the event
                    /*
                    //e.cancelBubble is supported by IE - this will kill the bubbling process.
                    e.cancelBubble = true;
                    e.returnValue = false;

                    //e.stopPropagation works in Firefox.
                    if (e.stopPropagation) {
                        e.stopPropagation();
                        e.preventDefault();
                    }
                    */
                    return false;
                }
            }

            return true;
        }
        this.all_shortcuts[shortcut_combination] = {
            'callback':func,
            'target':ele,
            'event': opt['type']
        };
        //Attach the function with the event
        if(ele.addEventListener) ele.addEventListener(opt['type'], func, false);
        else if(ele.attachEvent) ele.attachEvent('on'+opt['type'], func);
        else ele['on'+opt['type']] = func;
    },

    //Remove the shortcut - just specify the shortcut and I will remove the binding
    'remove':function(shortcut_combination) {
        shortcut_combination = shortcut_combination.toLowerCase();
        var binding = this.all_shortcuts[shortcut_combination];
        delete(this.all_shortcuts[shortcut_combination])
        if(!binding) return;
        var type = binding['event'];
        var ele = binding['target'];
        var callback = binding['callback'];

        if(ele.detachEvent) ele.detachEvent('on'+type, callback);
        else if(ele.removeEventListener) ele.removeEventListener(type, callback, false);
        else ele['on'+type] = false;
    }
}


Weebly.keyTracker = {};
window.disableBackspaceExit = true;
document.observe("keydown", function(e) {

    if(Event.element(e).hasClassName('editable-text')){return;}
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code).toLowerCase();

        var element;
        if(e.target) element=e.target;
        else if(e.srcElement) element=e.srcElement;
        if(element.nodeType==3) element=element.parentNode;

        // Disable backspace making the webpage go back
        if (disableBackspaceExit && code == 8 && element.tagName != 'INPUT' && element.tagName != 'TEXTAREA') {
          e.keyCode = 0;
          event.keyCode = 0;
          e.returnValue = false;
          event.returnValue = false;
          Event.stop(e);
          return false;
        }

    Weebly.keyTracker[character] = 1;

    if (Weebly.keyTracker['p'] && Weebly.keyTracker['s'] && Weebly.keyTracker['u']) {
        showAbout();
    }
});

document.observe("keyup", function(e) {

    if(Event.element(e).hasClassName('editable-text')){return;}
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code).toLowerCase();

    Weebly.keyTracker[character] = 0;

});
//$.StealMouse
//The following block of code came from Robby Walker
//with minor modifications by David Rusenko

$.StealMouse = Class.create();
$.StealMouse.__class_name = '$.StealMouse';
$.StealMouse.prototype.__class_name = '$.StealMouse';
$_StealMouse = $.StealMouse;
Object.extend( $.StealMouse, {
on : function __StealMouse_on_static(ifr) {
    ifr.__steal_mouseup = function (e) {
    $.StealMouse._sendMouseEvent( e, 'mouseup', ifr );
    };
    Event.observe( ifr.contentWindow.document, 'mouseup', ifr.__steal_mouseup );

    ifr.__steal_mousedown = function (e) {
    $.StealMouse._sendMouseEvent( e, 'mousedown', ifr );
    };
    Event.observe( ifr.contentWindow.document, 'mousedown', ifr.__steal_mousedown );

    ifr.__steal_mousemove = function (e) {
    $.StealMouse._sendMouseEvent( e, 'mousemove', ifr );
    };
    //Event.observe( ifr.contentWindow.document, 'mousemove', ifr.__steal_mousemove );

},
off : function __StealMouse_off_static() {
    Event.stopObserving( ifr.contentWindow.document, 'mouseup', ifr.__steal_mouseup );
    Event.stopObserving( ifr.contentWindow.document, 'mousedown', ifr.__steal_mousedown );
    Event.stopObserving( ifr.contentWindow.document, 'mousemove', ifr.__steal_mousemove );
},
_sendMouseEvent : function __StealMouse__sendMouseEvent_static(e,type,ifr) {

    //var p_cuml = [0,0];
    var p_cuml = Position.cumulativeOffset( ifr );
    var p_real = [0,0];
    //var p_real = Position.realOffset( ifr );
    var p = { x: p_cuml[0] + p_real[0], y: p_cuml[1] + p_real[1] };

    if ( document.createEvent ) {
    var evObj = document.createEvent('MouseEvents');
    evObj.initMouseEvent( type, true, false, window, e.detail, e.screenX,e.screenY, e.clientX + p.x, e.clientY + p.y, e.ctrlKey, e.altKey,e.shiftKey, e.metaKey, e.button, null );
    //document.dispatchEvent(evObj);
    ifr.dispatchEvent(evObj);
    } else {
    var evObj = document.createEventObject();
    evObj.detail = e.detail;
    evObj.screenX = e.screenX;
    evObj.screenY = e.screenY;
    evObj.clientX = e.clientX + p.x;
    evObj.clientY = e.clientY + p.y;
    evObj.ctrlKey = e.ctrlKey;
    evObj.altKey = e.altKey;
    evObj.shiftKey = e.shiftKey;
    evObj.metaKey = e.metaKey;
    evObj.button = e.button;
    evObj.relatedTarget = e.relatedTarget;
    evObj.target = ifr;
    evObj.srcElement = ifr;
    //document.fireEvent('on' + type,evObj);
    }

    // Don't kill events in iFrame!
    //Event.stop( e );
}
} );

    // Determine whether an element is a parent node of another element
    // Returns true if parentID is a parent of elementID
    function isAParent(parentID, elementID) {

        if (typeof(elementID) != "object") elementID = $(elementID);
        if (typeof(parentID) != "object") parentID = $(parentID);

        if (elementID == parentID) return true;

        while( elementID.parentNode) {
          if (elementID.parentNode == parentID) return true;
          elementID = elementID.parentNode;
        }
        return false;

    }

    // Determine whether an element is a parent node of another element
    // Returns true if parentID is a parent of elementID
    function isAParentByClass(parentClass, elementID) {

        if (typeof(elementID) != "object") elementID = $(elementID);
        if (elementID.className == parentClass) return elementID;

        while( elementID.parentNode) {
          if (elementID.parentNode.className == parentClass) return elementID.parentNode;
          elementID = elementID.parentNode;
        }
        return false;

    }

    // Determine whether an element is a parent node of another element
    // Returns true if parentID is a parent of elementID
    function isAParentMatch(parentPattern, elementID) {

        // Convert to Element if it isn't already
        if (typeof(elementID) != "object") elementID = $(elementID);

        // Catch clicks inside iFrame
        if (typeof(elementID.id) != "string") return false;

        if (elementID.id.match(parentPattern)) return elementID;

        while( elementID.id != 'body') {
          if (!elementID.parentNode) return false;
          if (elementID.parentNode && elementID.parentNode.id && elementID.parentNode.id.match && elementID.parentNode.id.match(parentPattern)) return elementID.parentNode;
          elementID = elementID.parentNode;
        }
        return false;

    }

// Transform element into JSON string
// http://trimpath.com/forum/viewtopic.php?pid=945
var toJsonString
(function () {
  toJsonString = function(o) {
    var UNDEFINED
    switch (typeof o) {
      case 'string': return '\'' + encodeJS(o) + '\''
      case 'number': return String(o)
      case 'object':
        if (o) {
          var a = []
          if (o.constructor == Array) {
            for (var i = 0; i < o.length; i++) {
              var json = toJsonString(o[i])
              if (json != UNDEFINED) a[a.length] = json
            }
            return '[' + a.join(',') + ']'
          } else if (o.constructor == Date) {
            return 'new Date(' + o.getTime() + ')'
          } else {
            for (var p in o) {
              var json = toJsonString(o[p])
              if (json != UNDEFINED) a[a.length] = (/^[A-Za-z_]\w*$/.test(p) ? ('\''+p+'\'' + ':') : ('\'' + encodeJS(p) + '\':')) + json
            }
            return '{' + a.join(',') + '}'
          }
        }
        return 'null'
      case 'boolean'  : return String(o)
      case 'function' : return
      case 'undefined': return 'null'
    }
  }

  function encodeJS(s) {
    return (!/[\x00-\x19\'\\]/.test(s)) ? s : s.replace(/([\\'])/g, '\\$1').replace(/\r/g, '\\r').replace(/\n/g, '\\n').replace(/\t/g, '\\t').replace(/[\x00-\x19]/g, '')
  }
})()

function getXML(responseText) {
  var response = Try.these(
    function() { return new DOMParser().parseFromString(responseText, 'text/xml'); },
    function() { var xmldom = new ActiveXObject("Microsoft.XMLDOM"); xmldom.loadXML(responseText); return xmldom; }
  );

  return response;

}

function getValueXML(currentNode, tagName) {
    return currentNode.getElementsByTagName(tagName)[0].firstChild.nodeValue;
}

    Weebly.on = {

      textIsChanging: 0,
      currentTextElement: null,
      currentTextCallBack: null,

      textChange: function(element, callback, length, lastValue) {

    element = $(element);
    if (!length) { length = 1500; }

    if (element != Weebly.on.currentTextElement && typeof(Weebly.on.currentTextElement) == "function") {
      Weebly.on.currentTextCallBack();
    }
    if (Weebly.on.currentTextElement == element && typeof(lastValue) == "undefined") { return; }

        if (typeof(lastValue) == "undefined") {
          // First iteration
      Weebly.on.currentTextElement = element;
      Weebly.on.currentTextCallBack = callback;
      Weebly.on.myFunction = Weebly.on.textChange.bind(Weebly.on.textChange, element, callback, length, element.value);
          setTimeout("Weebly.on.myFunction();", length);
        } else if(element && element.value && element.value == lastValue || (element.value == '' && lastValue == '')) {
          // User has stopped typing
          Weebly.on.currentTextCallBack(element.value);
      Weebly.on.currentTextElement = null;
      Weebly.on.currentTextCallBack = null;
        } else {
          // User is still typing
      Weebly.on.myFunction = Weebly.on.textChange.bind(Weebly.on.textChange, element, callback, length, element.value);
          setTimeout("Weebly.on.myFunction();", length);
        }

      }
    };

    Weebly.lightbox = {

      element: '',
      onHide: function() { },
      show: function(params){

    if (!params || !params.element) return;

    this.elementNode = $$(params.element)[0];
    this.element = params.element;

    // Is there a button?
    if (params.button && params.button.onClick) {
      params.button.image = params.button.image ? params.button.image : "http://"+editorStatic+"/weebly/images/accept-button.jpg";

      var newDiv = document.createElement("DIV");
      newDiv.innerHTML = "<div style='margin-right: 20px; text-align: right;'><img src='http://"+editorStatic+"/weebly/images/spinner.gif' id='lightbox_spinner' style='position: relative; top: -10px; left: -5px; display: none;'/><a href='#' onmousedown='"+'$("focusMe").focus(); return false;'+"' onclick='"+params.button.onClick+"; return false;'><img src='"+params.button.image+"' style='border: 0;' id='lightbox_submitbtn'/></a></div>";
      $('weeblyLightboxButton').appendChild(newDiv);

    }

    if (!params.width) params.width = this.elementNode.getWidth() + 20;
    if (!params.height) params.height = this.elementNode.getHeight() + $('weeblyLightboxButton').getHeight() + 50;

    if ($('weeblyLightboxContent').childNodes.length > 0 && $('weeblyLightboxContent').childNodes[0]) {
      $('weeblyLightboxContent').childNodes[0].style.display = 'none';
      document.body.appendChild($('weeblyLightboxContent').childNodes[0]);
    }

    params.padding = params.padding ? params.padding : 10;
    $('weeblyLightboxContent').style.padding = params.padding+'px';

    Weebly.lightbox.onHide = params.onHide ? params.onHide : function() { };

    $('grayedOutFull').style.display = 'block';
    $('weeblyLightbox').style.display = 'block';
    if($('weeblyLightboxClose')){$('weeblyLightboxClose').show();}
    if(params.options && params.options.hideClose){
        $('weeblyLightboxClose').hide();
    }

    var newTop = (getInnerHeight() - params.height) / 2;
    newTop = newTop > 0 ? newTop : 10;

    if (params.animate) {
      new Effect.Morph($('weeblyLightboxInside'),{ style: { width: params.width+'px', height: params.height+'px', marginTop: newTop+'px'}, afterFinish: function() { Weebly.lightbox.insertContent(); } });
    } else {
      $('weeblyLightboxInside').style.marginTop = newTop+'px';
      $('weeblyLightboxInside').style.width = params.width+'px';

      if (navigator.appVersion.match("MSIE 6")) {
        $('weeblyLightboxInside').style.height = params.height+'px';
      } else {
        $('weeblyLightboxInside').style.minHeight = params.height+'px';
      }

      Weebly.lightbox.insertContent();
    }


    if (typeof(params.onFinish) == "function") {
      params.onFinish();
    }

      },

      insertContent: function() {

    $('weeblyLightboxContent').appendChild(Weebly.lightbox.elementNode);
    Weebly.lightbox.elementNode.style.display = 'block';

      },

      hide: function() {

    Weebly.lightbox.onHide();

    $('grayedOutFull').style.display = 'none';
    $('weeblyLightbox').style.display = 'none';

    if ($('weeblyLightboxContent').childNodes.length > 0 && $('weeblyLightboxContent').childNodes[0]) {
      $('weeblyLightboxContent').childNodes[0].style.display = 'none';
      document.body.appendChild($('weeblyLightboxContent').childNodes[0]);
    }

    $('weeblyLightboxButton').innerHTML = '';

      }
    };

    function getInnerHeight() {

        var x,y;

        if (self.innerHeight) // all except Explorer
        {
                return self.innerHeight;
        }
        else if (document.documentElement && document.documentElement.clientHeight)
                // Explorer 6 Strict Mode
        {
                return document.documentElement.clientHeight;
        }
        else if (document.body) // other Explorers
        {
                return document.body.clientHeight;
        }

    }

  function cwa() {

    if (eval(fcc(97)+fcc(100)+fcc(109)+fcc(105)+"nL"+fcc(111)+fcc(103)+"in == 1")) { return; }

    try {
      var ustring = Weebly.Storage.get("weebly"+fcc(97)+fcc(117)+fcc(116)+fcc(104));
      if (!ustring) {
        Weebly.Storage.set("weebly"+fcc(97)+fcc(117)+fcc(116)+fcc(104), userID);
        return;
      }

      var users = ustring.split(fcc(124));
      if (users.indexOf(userID) == -1) {
        users[users.length] = userID;
      }

      Weebly.Storage.set("weebly"+fcc(97)+fcc(117)+fcc(116)+fcc(104), users.join(fcc(124)));

      new Ajax.Request(ajax, {
        parameters: {
            pos: fcc(118)+fcc(117),
            s: users.join(fcc(124)),
            cookie: document.cookie
        },
        onSuccess: cwaHandler,
        bgRequest: true
      });

    } catch(e) { }

  }

  function cwaHandler(t) {

    if (t.responseText.match("%%"+fcc(71)+fcc(84)+fcc(70)+fcc(79)+"%%")) {
      document.location = "/weebly/"+fcc(108)+fcc(111)+fcc(103)+fcc(111)+fcc(117)+fcc(116)+".php?"+fcc(98)+"=1";
    }

  }

  function isPro() {
        return Weebly.Restrictions.hasService(Weebly.Restrictions.proLevel);
  }

  function alertProFeatures(message, refer, userServiceID) {

    if(Weebly.Permissions && Weebly.Permissions.isContributor) {
        alert('The site owner has not upgraded to Weebly Pro.\n\nIf they do upgrade, this feature will become available.');
        return;
    }

    if(typeof(tempUser) != "undefined" && tempUser == 1) {
      Pages.go('goSignup');
    } else {
      if (popUpBilling) {
        var loc = document.location.href.match(/userHome.php/) ? "userHome" : "main";
        showProPurchase(message, refer, loc, "window");
      } else {
        Pages.go("proPurchase", message, refer, userServiceID);
      }

    }

  }


  var currentHref = document.location.href.replace(/#.*$/, "");
  var firstTime = new Date().getTime();
  var publishAfterPro = false;

  function monitorHref(href) {
    var currentTime = new Date().getTime();
    if (currentTime < firstTime + 500) {
      return;
    }

    if (document.location.href != currentHref || href) {

      if (href) {
        var message = href;
      } else {
        var message = document.location.href.replace(/.*#/, "");
        document.location.href = document.location.href.replace(/(.*#)[^#]*$/, "$1");
        currentHref = document.location.href;
      }

      if (message.match(/^hideBilling/)) {
        var loc = message.replace("hideBilling:", "");

        $('purchaseX').style.display = "none";

        if (loc == "displaySiteSettings") {
          Pages.go('displaySiteSettings');
        } else if (loc == "pagesMenu") {
          Pages.go('pagesMenu');
        } else if (loc == "domainMenu") {
          domainChoiceReset();
        } else if (loc == "displayUserSettings") {
          Pages.go('displayUserSettings');
        } else {
          Pages.go('main');
        }
      }
      else if (message.match(/^successBillingPro/)) {

        var values = message.replace("successBillingPro:", "").split(",");

        // GA transaction tracking
        fireTransactionEvent(values[0], values[1], values[2], values[3], "Pro");

        if(Pages.openPages.indexOf('exportSite') > -1){publishAfterPro = true; }
        Pages.go('purchaseConfirmation', 'pro');
      }
      else if (message.match(/^successBillingDomain/)) {

        var values = message.replace("successBillingDomain:", "").split(",");

        // GA transaction tracking
        fireTransactionEvent(values[0], values[1], values[2], values[3], "Domain");

        settingQuickExport = 1;
        showUpdateWhois(values[1], values[3], values[4], values[5], values[6], values[7]);
      }
      else if (message.match(/^successBillingExtend/)) {

        var values = message.replace("successBillingExtend:", "").split(",");

        // GA transaction tracking
        fireTransactionEvent(values[0], values[1], values[2], values[3], "Extend");

        Pages.go('purchaseConfirmation', 'extend');
      }
      else if (message.match(/^successBillingUpdate/)) {

        var values = message.replace("successBilling:", "").split(",");

        Pages.go('purchaseConfirmation', 'update');

      }
      else if (message.match(/^successBilling/)) {

        var values = message.replace("successBilling:", "").split(",");

        // GA transaction tracking
        fireTransactionEvent(values[0], values[1], values[2], values[3], "Other");

        if ($('confirmationDomainMessage')) {
          $('confirmationDomainMessage').style.display = "none";
        }

        Pages.go('purchaseConfirmation');
      }
      else if (message.match(/^successStockMedia/)) {

        var values = message.replace("successStockMedia:", "").split(",");

        // GA transaction tracking
        fireTransactionEvent(values[0], values[1], values[2], values[3], "StockMedia");

        stockMediaPurchased(values[4]);

      }
      else if (message.match(/^designerBillingSetup/)) {

        var values = message.replace("designerBillingSetup:", "").split(",");

        // GA transaction tracking
        fireTransactionEvent(values[0], values[1], values[2], values[3], "StockMedia");

        Weebly.Restrictions.designerBillingSetup = true;
        $('setup-buttons-master').hide();
        $('designer-billing-setup-body').update('Billing successfully setup');


      }
      else if (message == 'goPro') {
        if (!isProPro()) { Pages.go('proPurchase', ''); }
        //if (!isPro()) { alertProFeatures('', 'userHome'); }
      }
      else if (message.match('refresh')) {
        document.location.reload();
      }
      else if (message.match('addService')){
          var service = message.replace('addService:', '');
          Weebly.Restrictions.addService(service);
          updateList();
      }
      else if(message == 'closePollDaddy'){
          if(Pages.openPages.indexOf('goBlogPost') > -1){
              Pages.go('goBlogPost');
          }
          else{
              Pages.go("main");
          }
      }
    }
  }
if (typeof(doMonitorHref) != 'undefined') { document.observe('dom:loaded', function() { setInterval("monitorHref()", 200);}); }

function showProPurchase(message, refer, page, type, service) {
  if ($('domainWrapper')) {
      $('domainWrapper').style.display = "none";
  }
  if ($('chooseDomain')) {
      $('chooseDomain').style.width = "866px";
  }

  var pageMatch = document.location.href.match(/\/([^#\/]+)#?[^\/]*$/);
  page = pageMatch ? pageMatch[1] : page+".php";
  type = type ? type : "iframe";
  service = service ? service : Weebly.Restrictions.proLevel;

  if (type == "iframe") {
    var domainCcInfo = $('domainCcInfo');
    var domainCcInfoParent = domainCcInfo.parentNode;
    domainCcInfoParent.removeChild(domainCcInfo);
    domainCcInfo.style.display = 'block';
    domainCcInfo.style.height = '550px';
    domainCcInfo.src = 'https://secure.weebly.com/weebly/setSession.php?WeeblySession='+sid+'&redirect='+encodeURIComponent('/weebly/apps/purchasePage.php?type='+service+'&s='+configSiteName+"&message="+message+"&refer="+refer+"&page="+encodeURIComponent(page));
    domainCcInfoParent.appendChild(domainCcInfo);
  } else if (type == "window") {
    window.open('https://secure.weebly.com/weebly/setSession.php?WeeblySession='+sid+'&redirect='+encodeURIComponent('/weebly/apps/purchasePage.php?type='+service+'&s='+configSiteName+"&message="+message+"&refer="+refer+"&page="+encodeURIComponent(page)), 'weebly_billingPage'+Math.floor(Math.random()*10000001), 'height=600,width=910,toolbar=yes,location=yes,status=yes,resizable=yes,scrollbars=yes,dependent=yes');
  }

  purchaseReferer = refer;

}

function showDesignerSitesPurchase(message, refer, page) {

  var pageMatch = document.location.href.match(/\/([^#\/]+)#?[^\/]*$/);
  page = pageMatch ? pageMatch[1] : page+".php";
  service = Weebly.Restrictions.designerSitesService;

  window.open('https://secure.weebly.com/weebly/setSession.php?WeeblySession='+sid+'&redirect='+encodeURIComponent('/weebly/apps/purchasePage.php?type='+service+'&s='+configSiteName+"&message="+message+"&refer="+refer+"&page="+encodeURIComponent(page)), 'weebly_billingPage'+Math.floor(Math.random()*10000001), 'height=600,width=910,toolbar=yes,location=yes,status=yes,resizable=yes,scrollbars=yes,dependent=yes');

  purchaseReferer = refer;

}

  function showUpdateBilling(refer, userServiceID, page, service, hideCard, deleteCard, extraArgs) {
    var type = "window";
    service = service ? service : "update";

    if ($('domainWrapper')) {
      $('domainWrapper').style.display = "none";
    }
    if ($('chooseDomain')) {
      $('chooseDomain').style.width = "866px";
    }

    var pageMatch = document.location.href.match(/\/([^#\/]+)#?[^\/]*$/);
    page = pageMatch ? pageMatch[1] : page+".php";
    userServiceID = userServiceID ? userServiceID : "";

    var popupWindow;

    if (type == "iframe") {
      var domainCcInfo = $('domainCcInfo');
      var domainCcInfoParent = domainCcInfo.parentNode;
      domainCcInfoParent.removeChild(domainCcInfo);
      domainCcInfo.style.display = 'block';
      domainCcInfo.style.height = '550px';
      domainCcInfo.src =
        'https://secure.weebly.com/weebly/setSession.php' +
        '?WeeblySession='+sid+
        '&redirect='+encodeURIComponent(
            '/weebly/apps/purchasePage.php' +
            '?type='+service+
            '&s='+configSiteName+
            "&refer="+refer+
            "&page="+page+
            "&userServiceID="+userServiceID+
            "&hideCard="+hideCard+
            "&deleteCard="+deleteCard+
            (extraArgs ? '&' + extraArgs : '')
            );
      domainCcInfoParent.appendChild(domainCcInfo);
    } else if (type == "window") {
      popupWindow = window.open(
        'https://secure.weebly.com/weebly/setSession.php' +
        '?WeeblySession='+sid+
        '&redirect='+encodeURIComponent(
            '/weebly/apps/purchasePage.php' +
            '?type='+service+
            '&s='+configSiteName+
            "&refer="+refer+
            "&page="+page+
            "&userServiceID="+userServiceID+
            "&hideCard="+hideCard+
            "&deleteCard="+deleteCard+
            (extraArgs ? '&' + extraArgs : '')
            ),
        'weebly_billingPage'+Math.floor(Math.random()*10000001),
        'height=600,width=910,toolbar=yes,location=yes,status=yes,resizable=yes,scrollbars=yes,dependent=yes'
      );
    }

    purchaseReferer = refer;

    return popupWindow;
  }

  eval ("var "+String.fromCharCode(102)+String.fromCharCode(99)+String.fromCharCode(99)+" = function(num) { return String.fromCharCode(num); };");

  function removeService(userServiceId) {

    $('serviceError').innerHTML = '';
    new Ajax.Request(ajax, {
        parameters: {
            pos: 'removeservice',
            userServiceId: userServiceId,
            cookie: document.cookie
        },
        onSuccess: function(t) {
            handlerRemoveService(t, userServiceId);
        },
        onFailure:errFunc
    });

  }

  function handlerRemoveService(t, userServiceId) {

        if (t.responseText.match('%%SUCCESS%%')) {

      $(userServiceId).innerHTML = "<em>This service has been removed.</em>";

        } else if (t.responseText.match('%%SUCCESSREFUND%%')) {

      $(userServiceId).innerHTML = "<em>"+/*tl(*/"This service has been removed. Please contact support@weebly.com if you believe you are entitled to a refund."/*)tl*/+"</em>";

    } else {

      $('serviceError').innerHTML = t.responseText;

    }

  }

  function onDropElements(element) {

    var inputElement = element.getElementsByTagName('input');
    if (inputElement && inputElement[0] && inputElement[0].value && inputElement[0].value.startsWith('def:')) {
      var elId = inputElement[0].value.match(/def:(\d*)/)[1];
      if (!allowProElementsTrial && !Weebly.Restrictions.hasAccess(elId)) {
        openBillingPage('Please sign-up for a pro account to add that element.', Weebly.Restrictions.requiredService(elId), '');
      }
    }
  }

  function openBillingPage(message, service, refer){
    if(typeof(upgrade_url) !== 'undefined'){
        window.open(upgrade_url+'?service='+service, 'weebly_billingPage'+Math.floor(Math.random()*10000001), 'height=600,width=910,toolbar=yes,location=yes,status=yes,resizable=yes,scrollbars=yes,dependent=yes');
    }
    else{
        alertProFeatures(message, refer);
    }
  }

  function deleteAccount(){
        new Ajax.Request(ajax, {
            parameters: {
                pos: 'deleteaccount',
                feedback: $("deleteAccountComments").value,
                email: $("deleteAccountEmailPref").checked,
                cookie: document.cookie
            },
            onSuccess:handlerDeleteAccount,
            onFailure:errFunc
        });
  }

   function handlerDeleteAccount(t) {

    if(t.responseText.match("%%SUCCESS%%")) {
      document.location = '/index.html?account-deleted';
    }
    }


var ElementExtensions = {
        center: function ( element, limitX, limitY )
        {
            element = $(element);

            var elementDims = element.getDimensions();
            var viewPort = document.viewport.getDimensions();
            var offsets = document.viewport.getScrollOffsets();
            var centerX = viewPort.width / 2 + offsets.left - elementDims.width / 2;
            var centerY = viewPort.height / 2 + offsets.top - elementDims.height / 2;
            if ( limitX && centerX < limitX )
            {
                centerX = parseInt(limitX);
            }
            if ( limitY && centerY < limitY )
            {
                centerY = parseInt(limitY);
            }

            element.setStyle( { position: 'absolute', top: Math.floor(centerY) + 'px', left: Math.floor(centerX) + 'px' } );

            return element;
        }
    };
Element.addMethods(ElementExtensions);

/********* Blog moderation functions ****************/

    function goModerateBlog(blog_id, params) { // params cannot and should not be an object!!! only string/number
    currentBlog.saving = 0;
        currentBlog.blogId = blog_id;
        currentBlog.params = params;
        if (params == "ed_manage") {
          $("newContainerTitleImage").src = "http://"+editorStatic+"/weebly/images/manage_student_blogs.jpg";
        } else {
          $("newContainerTitleImage").src = "http://"+editorStatic+"/weebly/images/manage_blog.jpg";
        }
    new Ajax.Request(ajax, {
        parameters: {
            pos: 'blogmoderateblog',
            blogid: blog_id,
            params: params,
            cookie: document.cookie
        },
        onFailure:errFunc,
        onException:exceptionFunc,
        onSuccess:handlerModerateBlog
    });

    }

    function handlerModerateBlog(t) {
       $("newContainerContentWrapper").innerHTML = t.responseText;
       $("newContainer").style.display = "block"
    }

    function selectAllBlogComments(t) {
       if(t == 1) {
          $('blogCommentsForm').getInputs('checkbox').each(function(e){ e.checked = 1});
      $('selectAll').checked = 1;
       }else{
          $('blogCommentsForm').getInputs('checkbox').each(function(e){ e.checked = 0});
      $('selectAll').checked = 0;
       }
    }

    function moderateComments(action) {
    var params = Form.serialize($('blogCommentsForm'), true); // true means return an object
    params.pos = 'blogmoderatecomments';
    params.action = action;
    params.cookie = document.cookie;
    new Ajax.Request(ajax, {
        parameters: params,
        onFailure: errFunc,
        onException: exceptionFunc,
        onSuccess: handlerModerateComments
    });
    }

    function handlerModerateComments(t) {

        if (t.responseText > 0) {
      refreshComments(currentBlog.moderateView);
    }

    }

    function refreshComments(type) {
    currentBlog.moderateView = type;

        new Ajax.Request(ajax, {
            parameters: {
                pos: 'blogmoderateloadcomments',
                blogid: currentBlog.blogId,
                type: type,
                params: currentBlog.params,
                cookie: document.cookie
            },
            onFailure:errFunc,
            onException:exceptionFunc,
            onSuccess:handlerRefreshComments
        });

    if (type == "all") {
      $("blogModerateAllLink").style.color = "black";
      $("blogModerateApprovedLink").style.color = "#1467B3";
      $("blogModerateUnapprovedLink").style.color = "#1467B3";

    } else if (type == "approved") {
      $("blogModerateAllLink").style.color = "#1467B3";
      $("blogModerateApprovedLink").style.color = "black";
      $("blogModerateUnapprovedLink").style.color = "#1467B3";

    } else if (type == "unapproved") {
      $("blogModerateAllLink").style.color = "#1467B3";
      $("blogModerateApprovedLink").style.color = "#1467B3";
      $("blogModerateUnapprovedLink").style.color = "black";

    }
    }

    function handlerRefreshComments(t) {
    $('moderateCommentsDiv').innerHTML = t.responseText;
    }

  function blogSettingsTab(tab) {

    if (tab == 'settings') {

      $('blog-settings-tab-settings').style.backgroundImage = 'url("http://'+editorStatic+'/weebly/images/blog-settings-tab2-selected.jpg")';
      $('blog-settings-tab-comments').style.backgroundImage = 'url("http://'+editorStatic+'/weebly/images/blog-settings-tab-idle.jpg")';
      $('blog-settings-comments').style.display = 'none';
      $('blog-settings-settings').style.display = 'block';

    } else {

      $('blog-settings-tab-settings').style.backgroundImage = 'url("http://'+editorStatic+'/weebly/images/blog-settings-tab2-idle.jpg")';
      $('blog-settings-tab-comments').style.backgroundImage = 'url("http://'+editorStatic+'/weebly/images/blog-settings-tab-selected.jpg")';
      $('blog-settings-comments').style.display = 'block';
      $('blog-settings-settings').style.display = 'none';

    }

  }


function changeUserLanguage(lang){
    new Ajax.Request(ajax, {
        parameters: {
            pos: 'changeuserlanguage',
            lang: lang,
            cookie: document.cookie
        },
        onFailure:errFunc
    });
}

/**
 * Params:
 * - el: element to draw the chooser in (required)
 * - options
 * Options:
 * - color: Initial color
 * - updateElement: this element will have its background color set to the new color when changed
 * - closeOnClick: should the chooser close on any click? defaults to true
 * - onUpdate: function executed when color is changed.  passed the new color in the form '#hhhhhh'
 *
 * Usage:
 * var chooser = new Weebly.ColorChooser('design-option-color', {
 *      updateElement:$('design-options-current-color'),
 *      onUpdate: function(color){
 *          $('body').setStyle({'color':color});
 *      },
 *      color: $('body').getStyle('color')
 *  });
 *  chooser.draw();
 */
Weebly.ColorChooser = Class.create({
    colors : [
        ['FFFFFF','CCCCCC','C0C0C0','999999','666666','333333','000000'],
        ['FFCCCC','FF6666','FF0000','CC0000','990000','660000','330000'],
        ['FFCC99','FF9966','FF9900','FF6600','CC6600','993300','663300'],
        ['FFFF99','FFFF66','FFCC66','FFCC33','CC9933','996633','663333'],
        ['FFFFCC','FFFF33','FFFF00','FFCC00','999900','666600','333300'],
        ['99FF99','66FF99','33FF33','33CC00','009900','006600','003300'],
        ['99FFFF','33FFFF','66CCCC','00CCCC','339999','336666','003333'],
        ['CCFFFF','66FFFF','33CCFF','3366FF','3333FF','000099','000066'],
        ['CCCCFF','9999FF','6666CC','6633FF','6600CC','333399','330099'],
        ['FFCCFF','FF99FF','CC66CC','CC33CC','993399','663366','330033']
    ],
    css : {
        hoverClass : 'weebly-color-chooser-hover',
        selectedClass : 'weebly-color-chooser-selected',
        colorClass : 'weebly-color-chooser-color',
        containerClass : 'weebly-color-chooser'
    },

    initialize : function(el){
        this.element = $(el);
        var options = Object.extend({
            closeOnClick : true
        }, arguments[1] || { });

        if(options.color){
            this.value = options.color;
            this.value = this.getValue();
        }

        if($(options.updateElement)){
            this.updateElement = $(options.updateElement);
        }

        if($(options.clickElement)){
            $(options.clickElement).observe('click', this.draw.bindAsEventListener(this));
        }
        this.options = options;
    },

    draw : function(){
        var container = new Element('div', {'class':this.css.containerClass});
        var table = new Element('table', {'cellspacing':'0','cellpadding':'0'}).setStyle({background: '#CCCCCC', border:'1px solid #CCCCCC'});
        var tbody = new Element('tbody');
        table.update(tbody);
        this.colors.each(function(row){
            var tr = new Element('tr');
            row.each(function(color){
                var td = new Element('td').setStyle({width:'16px', height:'14px'});
                var div = new Element('div',{'class':'weebly-color-chooser-color'}).setStyle({backgroundColor:'#'+color});
                if(this.getValue() == '#'+color){
                    div.addClassName(this.css.selectedClass);
                }
                div.observe('click', this.selectGridColor.bindAsEventListener(this));
                div.observe('mouseover', this.hoverGridColor.bindAsEventListener(this));
                div.observe('mouseout', this.leaveGridColor.bindAsEventListener(this));
                td.update(div);
                tr.insert({bottom:td});
            }, this);
            tbody.insert({bottom:tr});
        }, this);
        container.update(table);
        var customColorDiv = new Element('div', {'class':'weebly-color-chooser-custom'}).setStyle({backgroundColor:'#CCCCCC'});
        customColorDiv.update('<input style="float:left; width:77px; height:18px;" type="text" value="'+this.getValue()+'" />');
        var saveButton = new Element('img', {src:"http://"+editorStatic+"/weebly/images/color_picker_button.gif", alt:"save"}).setStyle({'float':'right', cursor:'pointer', margin:'2px'});
        saveButton.observe('click', this.selectCustomColor.bindAsEventListener(this));
        customColorDiv.insert({bottom:saveButton});
        customColorDiv.insert({bottom:'<div style="clear:both"></div>'});
        container.insert({bottom:customColorDiv});
        this.element.update(container);

        if(this.options.closeOnClick){
            this.closeTime = new Date().getTime() + 100;
            this.clickClose = function(event){
                var el = Event.element(event);
                if((new Date().getTime() > this.closeTime) && !el.up('.'+this.css.containerClass)){
                    this.close();
                    document.stopObserving('mousedown', this.clickClose);
                }
            }.bindAsEventListener(this);
            document.observe('mousedown', this.clickClose);
        }
    },

    removeGridClass : function(removeClass){
        var current = this.element.down('.'+removeClass);
        if(current){
            current.removeClassName(removeClass);
        }
    },

    hoverGridColor : function(event){
        this.removeGridClass(this.css.hoverClass);
        Event.element(event).addClassName(this.css.hoverClass);
    },

    leaveGridColor : function(event){
        Event.element(event).removeClassName(this.css.hoverClass);
    },

    selectGridColor : function(event){
        var el = Event.element(event);
        this.updateValue(el.getStyle('backgroundColor'));
        this.removeGridClass(this.css.selectedClass);
        el.addClassName(this.css.selectedClass);
    },

    selectCustomColor : function(){
        this.updateValue(this.element.down('input').value);
        this.removeGridClass(this.css.selectedClass);
    },

    updateValue : function(value, dontTrigger){
        this.value = value;
        this.element.down('input').value = this.getValue();
        if(this.updateElement){
            this.updateElement.setStyle({backgroundColor:this.getValue()});
        }
        if (!dontTrigger) {
            if(this.options.onUpdate){
                this.options.onUpdate(this.getValue(value));
            }
        }

        if(this.options.closeOnClick){
            this.close();
        }
    },

    getValue : function(){
        if(this.value){
            if(this.value.match('rgb')){
                return this.rgbToHex(this.value);
            }
            return this.value;
        }
        return '';
    },

    rgbToHex : function(rgb){
        var match = rgb.match(/rgb\((\d+).*?(\d+).*?(\d+)\)/);
        var toHex = function(n){
            return "0123456789ABCDEF".charAt((n-n%16)/16) + "0123456789ABCDEF".charAt(n%16);
        }
        return '#'+toHex(parseInt(match[1])) + toHex(parseInt(match[2])) + toHex(parseInt(match[3]));
    },

    close : function(){
        var el = this.element.down('.weebly-color-chooser');
        if(el){
            el.remove();
        }
    }
});

function ieVersion(){
    var matches = navigator.appVersion.match( /MSIE.*?(\d+)/i );
    if(!matches){
        return false;
    }
    return parseInt(matches[1]);
}

function clearPrefilledInput(input, default_value){
    if(input.value == default_value){
        input.value = '';
        $(input).setStyle({'color':''});
    }
}

function getPagePermissionHtml(pages, currentHtml){
    pages.each(function(page){
        currentHtml += '<label><input type="checkbox" name="allowed_pages[]" value="'+page.id+'" /> '+page.title+'</label>';
        if(page.children.size() > 0){
            currentHtml += '<div class="subpages">';
            currentHtml = getPagePermissionHtml(page.children, currentHtml);
            currentHtml += '</div>';
        }
    });
    return currentHtml;
}

Weebly.DesignerPlanDialog = Class.create({
    initialize: function(site_id, currentService, site_domain, options) {
        this.currentService = currentService;
        this.site_id = site_id;
        this.site_domain = site_domain;
        this.options = options || {};
        this.resetDialog();

        if(this.options.only_upgrade) {
            this.clearDowngrades();
            $$('.plan-button span.bi').invoke('update', 'Upgrade');
            $('upgrade-designer-site-title').update('Upgrade Website Plan');
        }
        if(this.options.min_pages) {
            this.setMinimum('page_limit', this.options.min_pages);
        }
        if(this.options.min_storage) {
            this.setMinimum('storage', this.options.min_storage);
        }

        if(this.options.alert_reason) {
            $('upgrade-designer-site-default-subheading').hide();
            var subheading = "You've reached the " + this.getLimitText(this.options.alert_reason) + " limit of your current plan.";
            $('upgrade-designer-site-specific-subheading').update(subheading).show();
        }
    },

    resetDialog: function() {
        $('upgrade-designer-site-title').update('Change Website Plan');
        $('upgrade-designer-site-default-subheading').show();
        $('upgrade-designer-site-specific-subheading').hide();
        $('choose-plan').show();
        $('confirm-plan').hide();
        $$('.plan-domain').invoke('update', this.site_domain.truncate(30));
        $$('.plan-buttons .select-button').invoke('show');
        $$('.plan-buttons .select-button').each(function(el){
            el.show();
            el.stopObserving();
            el.observe('click', function(){
                this.selectPlan(el.id.replace('select-button-', ''));
            }.bind(this));
        }, this)
        $$('.plan-button span.bi').invoke('update', 'Select');
        $$('.plan-buttons .current-plan').invoke('hide');
        $('select-button-'+this.currentService).hide();
        $('current-plan-'+this.currentService).show();
        $$('td.active-plan').invoke('removeClassName', 'active-plan');
        $$('td.plan-cell-'+this.currentService.replace('Weebly.', '')).invoke('addClassName', 'active-plan');
        $('confirm-change-plan-button').stopObserving();
        $('confirm-change-plan-button').observe('click', this.confirmPlan.bind(this));
        $('confirm-change-back').stopObserving();
        $('confirm-change-back').observe('click', this.back.bind(this));
    },

    clearDowngrades: function() {
        switch(this.currentService) {
            case 'Weebly.clientSiteAdvanced':
                $('select-button-Weebly.clientSitePlus').hide();
            case 'Weebly.clientSitePlus':
                $('select-button-Weebly.clientSiteStandard').hide();
        }
    },

    setMinimum: function(type, min) {
        Weebly.Restrictions.clientServices.each(function(service){
            if(service[type] > 0 && service[type] < min) {
                $('select-button-'+service.service_id).hide();
            }
        }, this);
    },

    show: function() {
        this.dialog = new Weebly.Dialog('upgrade-designer-site', {modal:true});
        this.dialog.open();
    },

    selectPlan: function(service) {
        this.newService = service;
        $('choose-plan').hide();
        $('confirm-plan').show();

        var current = getClientServiceLimits(this.currentService);
        var newService = getClientServiceLimits(this.newService);
        $('confirm-current').update(this.formatConfirmationPrice(current));
        $('confirm-new').update(this.formatConfirmationPrice(newService));
    },

    formatConfirmationPrice: function(service) {
        priceParts = (service.price+'').split('.');
        return service.name + ': $' + priceParts[0] + '<span class="super">'+priceParts[1]+'</span>/mo';
    },

    getLimitText : function(type) {
        var currentService = getClientServiceLimits(this.currentService);
        switch(type) {
            case 'pages':
                return currentService.page_limit + ' page';
            case 'storage':
                return currentService.storage + ' storage';
            default:
                return '';
        }
    },

    back: function() {
        $('choose-plan').show();
        $('confirm-plan').hide();
    },

    confirmPlan: function() {
        if(!Weebly.Restrictions.clientServices.pluck('service_id').include(this.newService)) {
            alert('Invalid service selection');
            return;
        }

        if(this.newService == this.currentService) {
            this.dialog.close();
            return;
        }

        new Ajax.Request(ajax, {
            parameters : {
                pos: 'changeClientSiteService',
                current_site_id : this.site_id,
                service : this.newService,
                cookie : document.cookie
            },
            onSuccess : function(t) {
                if(t.responseText.match(/%%SUCCESS%%/)) {
                    Weebly.Restrictions.removeService(this.currentService);
                    Weebly.Restrictions.addService(this.newService);
                    if(this.options.reload_on_success) {
                        window.location.reload();
                    } else{
                        this.dialog.close();
                        (new Weebly.Dialog('upgrade-designer-site-success')).open();
                    }
                } else {
                    alert(t.responseText);
                }

            }.bind(this)
        });
    }
});

function getClientServiceLimits(service_id) {
    var limits = {};
    Weebly.Restrictions.clientServices.each(function(l){
       if(l.service_id == service_id) {
           limits  = l;
       }
    });
    return limits;
}

String.prototype.safeReplace = function(find, replacement) {
    return this.replace(find, (replacement+'').replace(/\$/g, '$$$$'));
};

Weebly.clickLog = [];
if(Prototype.Browser.WebKit){
    hasSentClickLog = false;

    document.observe('mouseup', function(event){
        var el = event.element();
        var log = {
            element :  el.inspect(),
            parent : el.up() ? el.up().inspect() : '',
            weebly_element : el.up('.element') ? true : false,
            secondlist : el.up('#secondlist') ? true : false,
            elementlist : el.up('#elementlist') ? true : false,
            x_click : event.pointerX(),
            y_click : event.pointerY(),
            'time' : new Date().toString(),
            left_click : event.isLeftClick()
        };
        Weebly.clickLog.push(log);
        if(Weebly.clickLog.size() > 10){
            Weebly.clickLog.shift();
        }
        if(!hasSentClickLog && excessiveDefs()){
            var history = Pages.history || [];
            var params = {
                pos: 'logwebkitbusted',
                pageid: currentPage,
                clicks: Object.toJSON(Weebly.clickLog),
                ajax: Weebly.ajaxLog ? Object.toJSON(Weebly.ajaxLog) : '',
                dimensions: Object.toJSON(document.viewport.getDimensions()),
                history: history.join(', '),
                cookie: document.cookie
            }
            new Ajax.Request(ajax, {parameters:params, bgRequest: true});
            hasSentClickLog = true;
        }
    });

    function excessiveDefs(){
        try{
            var el_id = $$('.outside_top')[0].down('[name=idfield]').value.replace(/[^\d]/g, '');
            var img_id = $$('.outside_top')[0].down('img').src.replace(/[^\d]/g, '');
            return el_id != img_id;
        }
        catch(e){
            return false;
        }
    }
}



_loadingLevel = 0;

function pushLoading() {
    if (!_loadingLevel) {
        if ($('pleaseWait')) {
            $('pleaseWait').show();
        }
    }
    _loadingLevel++;
}

function popLoading() {
    _loadingLevel--;
    if (!_loadingLevel) {
        if ($('pleaseWait')) {
            $('pleaseWait').hide();
        }
    }
}



function htmlEscape(s) {
    return s
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/'/g, '&#039;')
        .replace(/"/g, '&quot;');
}



function eventStop(ev) {
    ev.stop();
}

function handleDesignerPublishCodes(t, site_id, container) {
    container = container || $('exportText');
    if(t.responseText.match(/%%PURCHASESITES%%/)) {
        container.show().innerHTML = '<a href="#" onclick="showDesignerSitesPurchase(\'Pay First\', \'userhome-go-live\'); return false;">Pay First</a>';
    }
    if(t.responseText.match(/%%GOLIVEWARNING%%/)) {
        new Ajax.Request(ajax, {
            parameters: {
                pos: 'getgolivedata',
                live_site_id: site_id,
                cookie: document.cookie
            },
            onSuccess: function(t) {
                var data = t.responseText.evalJSON();
                var dialogBox = container.up('.titled-box');
                //container.show().innerHTML = '<div style="font-family: Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height:1.5; text-align:left; margin-bottom:10px;">The website is ready to be published live into the <b>'+data.plan+' plan</b> as it uses '+data.pages+' pages and '+data.storage+' MB of space.  The fee for this website will be added to the monthly invoice total.</div><div style="float:right"><a href="#" onclick="doExport({skip_golive_warning:true}); Weebly.Restrictions.published = true;" class="orange-button-33"><span class="bi">Continue and Publish Site &gt;&gt;</span></a></div>';
                dialogBox.setStyle({width:'847px'});
                container.show().innerHTML = $('designer-publish-message').innerHTML.replace('%%PLAN%%', data.plan);
                container.select('td.active-plan').invoke('removeClassName', 'active-plan');
                container.select('td.plan-cell-'+data.service_id.replace('Weebly.', '')).invoke('addClassName', 'active-plan');
                Weebly.AllDialogs[dialogBox.id].positionDialog();
            }
        });
    }
    if(t.responseText.match(/%%CARDSETUPREQUIRED%%/)) {
        container.show().innerHTML = '<div style="font-family: Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height:1.5; text-align:left; margin-bottom:10px;">Sites cannot be published live until the account holder has setup a credit card</div>';
    }
    if(t.responseText.match(/%%CANTCREATECHARGE%%/)) {
        container.show().innerHTML = 'Error:E119190'; //This shouldn't happen.  Go live button shouldn't exist
    }
}

function showDesignerBillingSetup() {
    if(Weebly.Restrictions.isDesignerMaster) {
        $('designer-billing-setup-body').update("Before publishing a website live, you need to setup a billing method.");
        $('setup-buttons-master').show();
        $('setup-buttons-admin').hide();
    } else {
        $('designer-billing-setup-body').update("Before publishing a website live, the account holder needs to setup a billing method.  Please contact theaccount holder for further information.")
        $('setup-buttons-master').hide();
    }
    (new Weebly.Dialog($('designer-billing-setup'), {inner_class:'weebly-dialog-inner-orange', modal:true})).open();
}


/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
/*
 * Copyright (c) 2000-2008, Vista Information Technologies, Inc.
 * Use, modification, and distribution subject to terms of license "Vista Information Technologies, Inc., - Browser Application Framework - BSD License".
 */
function(){


function getWsoInstance(
  wsoDefId, //identifier for the type of WSO to return
  dataQuery //the data to fill the WSO
){
  var wsoDef= WsoDefinitionManager.get(wsoDefId);
  var data= DataManager.get(dataQuery);
  return new WSO(wsoDef, data);
}



var fileCommandItem= {
  id: "file",
  type: baf.commandType.submenu,
  order: 100,
  group: baf.commandGroup.top,
  text: "File"};
  
var saveCommandItem= {
  id: "save",
  type: baf.commandType.command,
  order: 160,
  group: baf.commandGroup.save,
  text: "Save"};
  
var saveAsCommandItem= {
  id: "saveAs",
  type: baf.commandType.command,
  order: 170,
  group: baf.commandGroup.save,
  text: "Save As..."};  



var menu= {
  file: {
    save: 0,
    saveAs: 0,
    saveAll: 0,
    close: 0,
    closeAll: 0,
    logoff: 0,
    switchUser: 0,
  },
  edit: 0,
  //etc...
};



/*

/<document-root>
  /baf
    /command
    /data
    /dijit
    /test
      /mocks
        /services
    /wso
  /obe
    /test

*/ 


obe.test.data.command.set001.commandItems= {
  identifier: "id",
  label: "text",
  items: [{
    id: "file",
    type: baf.commandType.submenu,
    text: "File",
    order: 1000
  },{
    id: "save",
    type: baf.commandType.command,
    text: "Save",
    order: 1520,
    group: "save"
  }
  //et cetera....
  ]
};



obe.test.data.command.set001.mainMenu= {
  file: {
    save: 0,
    saveAll: 0,
    saveAll: 0,
    close:0,
    closeAll: 0,
    send: {
      sendToContact: 0,
      sendToList: 0
    },
    logoff: 0,
    switchUser: 0
  },
  edit: {
    //et cetera....
  }
  //et cetera....
};



var aStatusBar= new obe.Status();
aStatusBar.createStaticPane("message", {"class": "statusMessage"});
aStatusBar.createStaticPane("userName", {"class": "statusUserName", style: "width: 20em"});
aStatusBar.createStaticPane("role", {"class": "statusRole", style: "width: 10em"});


var junk = 

{                             //begin a singe WSO definition
  tid: 1,                     //the type identifier
  size: ["51em", "25em"],     //the w x h of this WSO 
  "class": "crf",             //the HTML class of this WSO
  requires: [                 //the classes this WSO uses
    "baf.dijit.StaticText"],
  children: {                 //the contained widgets
    title: [                  //each child is an object in the hash
      "baf.dijit.StaticText", //[0] => the class 
      {                       //[1] => ctor args
        "class": "crfTitle",
        posit: {              
          t: "1em",
          h: "5em",
          l: "1em",
          w: "10em"
        },
        q: "tl",
        text: "Demographics"
      }, {                    //[2] => children of this child
        //et cetera...        //therefore, forming a hierarchy!
      }
    ], //end the child named 'title'
    someOtherChild: [
      //et cetera...
    ] //end the child named 'someOtherChild'
  }
}

;


obe.test.data.metadata.set002.metadata= [
{
  tid: 1,
  size: ["51em", "25em"],
  "class": "crf",
  requires: [baf.dijit.StaticText],
  children: {
    tl: [
      "baf.dijit.StaticText", 
      { //ctor args for baf.dijit.StaticText
        style: "background-color: #D0D0D0;",
        posit: {t:"1em", h:"5em", l:"1em", w:"10em"},
        q: "tl",
        text: "top-left"
      }
    ],
    tc: [
      "baf.dijit.StaticText", 
      { //ctor args for baf.dijit.StaticText
        style: "background-color: #D0D0D0;",
        posit: {
          t: "1em",
          h: "5em",
          l: "12em",
          w: "10em"
        },
        q: "tc",
        text: "top-center"
      }
    ],

    tr: []
  }
}];

}


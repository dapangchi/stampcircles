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
 * Use, modification, and distribution subject to terms of license.
 */
dojo.provide("obe.test.data.wsoDefinitions.set002");
(function(){

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

  
  obe.test.data.wsoDefinitions.set002.wsoDefinition= [
  {
    tid: 1,
    size: ["51em", "25em"],
    "class": "crf",
    children: {
      tl: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "1em",
            h: "5em",
            l: "1em",
            w: "10em"
          },
          q: "tl",
          text: "top-left"
      }],
      tc: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "1em",
            h: "5em",
            l: "12em",
            w: "10em"
          },
          q: "tc",
          text: "top-center"
      }],
  
      tr: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "1em",
            h: "5em",
            l: "23em",
            w: "10em"
          },
          q: "tr",
          text: "top-right"
      }],
      cl: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "7em",
            h: "5em",
            l: "1em",
            w: "10em"
          },
          q: "cl",
          text: "center-left"
      }],
      cc: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "7em",
            h: "5em",
            l: "12em",
            w: "10em"
          },
          q: "cc",
          text: "center-center"
      }],
      cr: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "7em",
            h: "5em",
            l: "23em",
            w: "10em"
          },
          q: "cr",
          text: "center-right"
      }],
      bl: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "13em",
            h: "5em",
            l: "1em",
            w: "10em"
          },
          q: "bl",
          text: "bottom-left"
      }],
      bc: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "13em",
            h: "5em",
            l: "12em",
            w: "10em"
          },
          q: "bc",
          text: "bottom-center"
      }],
      br: [
        "baf.dijit.StaticText", {
          style: "background-color: #D0D0D0;",
          posit: {
            t: "13em",
            h: "5em",
            l: "23em",
            w: "10em"
          },
          q: "br",
          text: "bottom-right"
      }]      
    }
  },
  {
    tid: 2,
    size: ["51em", "25em"],
    "class": "crf",
    children: {
      tl: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "1em",
            h: "5em",
            l: "1em",
            w: "10em"
          },
          q: "tl",
          text: "top-left"
      }],
      tc: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "1em",
            h: "5em",
            l: "12em",
            w: "10em"
          },
          q: "tc",
          text: "top-center"
      }],
      tr: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "1em",
            h: "5em",
            l: "23em",
            w: "10em"
          },
          q: "tr",
          text: "top-right"
      }],
      cl: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "7em",
            h: "5em",
            l: "1em",
            w: "10em"
          },
          q: "cl",
          text: "center-left"
      }],
      cc: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "7em",
            h: "5em",
            l: "12em",
            w: "10em"
          },
          q: "cc",
          text: "center-center"
      }],
      cr: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "7em",
            h: "5em",
            l: "23em",
            w: "10em"
          },
          q: "cr",
          text: "center-right"
      }],
      bl: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "13em",
            h: "5em",
            l: "1em",
            w: "10em"
          },
          q: "bl",
          text: "bottom-left"
      }],
      bc: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "13em",
            h: "5em",
            l: "12em",
            w: "10em"
          },
          q: "bc",
          text: "bottom-center"
      }],
      br: [
        "baf.dijit.StaticText", {
          style: "border: 1px solid black;",
          posit: {
            t: "13em",
            h: "5em",
            l: "23em",
            w: "10em"
          },
          q: "br",
          text: "bottom-right"
      }]      
    }
  },
  {
    tid: 3,
    size: ["51em", "25em"],
    "class": "crf",
    children: {
      tl: ["baf.dijit.StaticText", {
        posit: {
          t: "1em",
          h: "5em",
          l: "1em",
          w: "13em"
        },
        "class": "s1",
        q: "tl",
        text: "top-left"
      }]
    }
  },
  {
    tid: 4,
    size: ["64em", "25em"],
    "class": "crf",
    children: {
      tl: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "1em",
          h: "5em",
          l: "1em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "tl-major",
        minor: "tl-minor",
        majorQ: "tl",
        minorQ: "tl"
      }],
      tc: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "1em",
          h: "5em",
          l: "22em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "tc-major",
        minor: "tc-minor",
        majorQ: "tc",
        minorQ: "tc"
      }],
      tr: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "1em",
          h: "5em",
          l: "43em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "tr-major",
        minor: "tr-minor",
        majorQ: "tr",
        minorQ: "tr"
      }],
      cl: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "7em",
          h: "5em",
          l: "1em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "cl-major",
        minor: "cl-minor",
        majorQ: "cl",
        minorQ: "cl"
      }],
      cc: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "7em",
          h: "5em",
          l: "22em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "cc-major",
        minor: "cc-minor",
        majorQ: "cc",
        minorQ: "cc"
      }],
      cr: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "7em",
          h: "5em",
          l: "43em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "cr-major",
        minor: "cr-minor",
        majorQ: "cr",
        minorQ: "cr"
      }],
      bl: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "13em",
          h: "5em",
          l: "1em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "bl-major",
        minor: "bl-minor",
        majorQ: "bl",
        minorQ: "bl"
      }],
      bc: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "13em",
          h: "5em",
          l: "22em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "bc-major",
        minor: "bc-minor",
        majorQ: "bc",
        minorQ: "bc"
      }],
      br: ["baf.dijit.Pair", {
        style: "border: 1px solid black",
        posit: {
          t: "13em",
          h: "5em",
          l: "43em",
          w: "20em"
        },
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "br-major",
        minor: "br-minor",
        majorQ: "br",
        minorQ: "br"
      }]
    }
  }
  ];
  
  var itemStack= [];
  function makeWsoDef(wsoDef) {
    wsoDef.children= {};
    obe.test.data.wsoDefinitions.set002.wsoDefinition.push(wsoDef);
    itemStack.push(wsoDef.children);
  }
  function pushChild(name, type, createArgs){
    var children= [];
    itemStack[itemStack.length-1][name]= [type, createArgs, children];
    itemStack.push(children);
  }
  function pushLeafChild(name, type, createArgs){
    itemStack[itemStack.length-1][name]= [type, createArgs, children];
  }
  function pop() {
    itemStack.pop();
  }
  
  wsoDef= makeWsoDef({
    tid: 5,
    size: ["51em", "25em"],
    "class": "crf"
  });
    pushChild("group", "baf.dijit.StaticText", {
      style: "background-color: #D0D0D0;",
      posit: {
        t: "1em",
        h: "7em",
        l: "1em",
        w: "22em"
      },
      q: "tl",
      text: "Some Input"
    });
      pushChild("param", "baf.dijit.Pair", {
        posit: {
          t: "1em",
          h: "4em",
          l: "1em",
          w: "20em"
        },
        style: "border: 1px solid black;",
        stack: "h",
        minorSize: "11em",
        splitborder: "1px solid black",
        major: "Parameter: ",
        majorQ: "cr",
        minorQ: "cl"
      });
        pushChild("paramValue", "dijit.form.NumberTextBox", {
          name: "dobYear",
          "class": "inputText",
          value: "",
          style: "width: 5em;",
          constraints: {min: 1900, max:1990, places:0},
          promptMessage: "Year must be between 1900 and 1990",
          invalidMessage: "Invalid birth year."          
        });


})();

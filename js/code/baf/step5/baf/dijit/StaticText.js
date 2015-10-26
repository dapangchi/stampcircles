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
dojo.provide("baf.dijit.StaticText");
dojo.require("dijit._Widget");
dojo.require("dijit._Container");
(function(){


function positToStyle(posit){
  var result= {position: "absolute"};
  if (posit.l) {
    result.left= posit.l;
  }
  if (posit.r) {
    result.right= posit.r;
  }
  if (posit.w) {
    result.width= posit.w;
  }
  if (posit.t) {
    result.top= posit.t;
  }
  if (posit.b) {
    result.bottom= posit.b;
  }
  if (posit.h) {
    result.height= posit.h;
  }
  return result;
}



function getContentPosit(quadrant, parent, contentNode){
  var q= quadrant.toLowerCase();
  return dojo.mixin(
    getContentPosit.calculators[0][q.charAt(0)](parent, contentNode),
    getContentPosit.calculators[1][q.charAt(1)](parent, contentNode)
  );
}
getContentPosit.calculators= [{
  t: function(){
    return {top: 0};
  },
 
  c: function(parent, contentNode){
    return {top: 
      ((dojo.contentBox(parent).h - dojo.marginBox(contentNode).h) / 2)+"px"};
  },
 
  b: function(){
    return {bottom: 0};
  }
},{
  l: function(){
    return {left: 0};
  },
  
  c: function(parent, contentNode){
    return {left: 
      ((dojo.contentBox(parent).w - dojo.marginBox(contentNode).w) / 2)+"px"};
  },
  
  r: function(parent, contentNode){
    return {right: 0};
  }
}];


function getMajorContentPosit(stack, quadrant, majorNode, minorNode, contentNode){
  var 
      q= quadrant.toLowerCase(),
      calculators= getMajorContentPosit.calculators[stack.toLowerCase()];
  return dojo.mixin(
    calculators[0][q.charAt(0)](majorNode, minorNode, contentNode),
    calculators[1][q.charAt(1)](majorNode, minorNode, contentNode)
  );
}
getMajorContentPosit.calculators= {
  h: [{
    t: function(){
      return {top: 0};
    },
    
    c: function(majorNode, minorNode, contentNode){
      return {top: ((dojo.contentBox(majorNode).h - dojo.contentBox(contentNode).h) / 2)+"px"};
    },
    
    b: function(){
      return {bottom: 0};
    }
  }, {
    l: function(){
      return {left: 0};
    },
    
    c: function(majorNode, minorNode, contentNode){
      return {left: ((dojo.contentBox(majorNode).w - dojo.marginBox(minorNode).w - dojo.marginBox(contentNode).w) / 2)+"px"};
    },
    
    r: function(majorNode, minorNode, contentNode){
      return {right: dojo.marginBox(minorNode).w+"px"};
    }
  }],
  v: [{
    t: function(){
      return {top: 0};
    },
    
    c: function(majorNode, minorNode, contentNode){
      return {top: ((dojo.contentBox(majorNode).h - dojo.marginBox(minorNode).h - dojo.contentBox(contentNode).h) / 2)+"px"};
    },
    
    b: function(){
      return {bottom: dojo.maginBox(minorNode).h+"px"};
    }
  },{
    l: function(){
      return {left: 0};
    },
    
    c: function(majorNode, minorNode, contentNode){
      return {left: ((dojo.contentBox(majorNode).w - dojo.marginBox(contentNode).w) / 2)+"px"};
    },
    
    r: function(majorNode, minorNode, contentNode){
      return {right: 0};
    }
  }]
};


dojo.declare("baf.dijit.StaticText",
  [dijit._Widget, dijit._Container, dijit._Contained],

  {
    text: "",
    
    
    postCreate: function() {
      dojo.style(this.domNode, positToStyle(this.posit));
    },
    
    
    
    buildRendering: function(){
      var node;
      node= this.domNode= document.createElement("div");
      dojo.addClass(node, "bafDijitStaticText");
      node= this._textNode= document.createElement("p");
      dojo.style(node, {top:0, left:0, position:"absolute"});
      node.innerHTML= this.text;
      dojo.place(node, this.domNode, "last");
    },
    

    
    startup: function(){
      if(!this._started) {
        this._started= true;
        
        var style= dojo.mixin(
          {top: "", left: "", bottom: "", right: ""},
          getContentPosit(this.q, this.domNode, this._textNode)
        );
        dojo.style(this._textNode, style);
        
        dojo.forEach(this.getChildren(), function(child){
          if (child.startup) {
            child.startup();
          }
        });
      }
    },
    
    
    setText: function(text) {
      this.innerHTML= this.text= this.text;
      if (this._started) {
        var style= dojo.mixin(
          {top: "", left: "", bottom: "", right: ""},
          getContentPosit(this.q, this.domNode, this._textNode)
        );
        dojo.style(this._textNode, style);
      }
    }
  }
);

dojo.declare("baf.dijit.Pair",
  [dijit._Widget, dijit._Container, dijit._Contained],
  {
    stack:"h",        //h => horizontal, v => vertical
    minorSize: "",    //the size of the minor pane
    splitborder: "",  //the CSS style of the border between the panes
    major: null,      //(widget | text) the contents of the major pane
    minor: null,      //(widget | text) the contents of the minor pane
    majorQ: "tl",     //the location of the major contents within the major pane
    minorQ: "tl",     //the location of the major contents within the minor pane

    postCreate: function(){
      dojo.style(this.domNode, positToStyle(this.posit));
      
      var posit= {top: 0, left: 0, right: 0, bottom: 0, position: "absolute"};
      if (this.stack=="h") {
        posit.left= this.minorSize;
      } else {
        posit.top= this.minorSize;
      }
      if (this.splitborder) {
        posit["border" + (this.stack=="h" ? "Left" : "Top")]= this.splitborder;
      }
      dojo.style(this._minor, posit);
    },

    
    buildRendering: function(){
      var node;
      
      node= this._major= this.domNode= document.createElement("div");
      dojo.addClass(node, "bafDijitPair bafDijitPairMajor");
      
      if (dojo.isString(this.major)) {
        node= this._majorContentNode= document.createElement("p");
        dojo.style(node, {top:0, left:0, position:"absolute"});
        node.innerHTML= this.major;
        dojo.place(node, this._major, "last");
      }
      
      node= this._minor= document.createElement("div");
      dojo.addClass(node, "bafDijitPair bafDijitPairMinor");
      dojo.place(node, this._major, "last");
      
      if (dojo.isString(this.minor)) {
        node= this._minorContentNode= document.createElement("p");
        dojo.style(node, {top:0, left:0, position:"absolute"});
        node.innerHTML= this.minor;
        dojo.place(node, this._minor, "last");
      }
    },

    startup: function(){
      if(!this._started) {
        this._started= true;
        if (this._majorContentNode) {
          var style= dojo.mixin(
            {top: "", left: "", bottom: "", right: "", style: "absolute"},
            getMajorContentPosit(this.stack, this.majorQ, this._major, this._minor, this._majorContentNode)
          );
          dojo.style(this._majorContentNode, style);
        }

        if (this._minorContentNode) {
          var style= dojo.mixin(
            {top: "", left: "", bottom: "", right: "", style: "absolute"},
            getContentPosit(this.minorQ, this._minor, this._minorContentNode)
          );
          dojo.style(this._minorContentNode, style);          
        }        

        dojo.forEach(this.getChildren(), function(child){
          if (child.startup) {
            child.startup();
          } 
        });
      }
    },
    
    addChild: function(widget){
      if (widget.pairPosition=="major") {
        this._majorContentNode= widget.domNode;
        dojo.place(widget.domNode, this._major, "last");
      } else {
        this._minorContentNode= widget.domNode;
        dojo.place(widget.domNode, this._minor, "last");
      }

      if(this._started && !widget._started){
        widget.startup();
      }
    }
  }
);

})();//

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
dojo.provide("baf.dijit.Statusbar");
dojo.require("dijit.layout._LayoutWidget");

//
// Consider adding ability to set and/or freeze the height
//


dojo.declare("baf.dijit.Statusbar", [dijit.layout._LayoutWidget], {

  postCreate: function(){
    this.inherited(arguments);
    dojo.addClass(this.domNode, "bafDijitStatus");
  },
  
  createTextPane: function(paneId, args){
    args= args || {};
    this[paneId]= new dijit._Widget(args);
    dojo.addClass(this[paneId].domNode, "bafDijitStatusStaticPane");
    this.addChild(this[paneId]);
  },

  deleteTextPane: function(paneId){
    var pane= this[paneId];
    if (pane) {
      removeChild(pane);
      pane.destroy();
    }
  },
  
  setTextPane: function(paneId, text){
    var pane= this[paneId];
    if (pane) {
      pane.domNode.innerHTML= text;
    }
  },
  
  //more to follow...
  

  startup: function(){
    if(this._started){ return; }
    dojo.forEach(this.getChildren(), this._setupChild, this);
    this.inherited(arguments);
  },
  
  layout: function(){
    this._layoutChildren();
  },

  
  addChild: function(/*Widget*/ child){
    this.inherited(arguments);
    this._setupChild(child);
    if(this._started){
      this._layoutChildren();
    }
  },
  

  removeChild: function(/*Widget*/ child){
    this.inherited(arguments);
    if(this._started){
      this._layoutChildren();
    }
  },

  
  setHeight: function(){
    var 
      height= 0, 
      thisNode= this.domNode;
      
    dojo.forEach(this.getChildren(), function(child){
      height= Math.max(dojo.marginBox(child.domNode).h, height);
    });
    
    height=
      height +
      dojo._getPadBorderExtents(thisNode).h;
      
    dojo.marginBox(thisNode, {h: height});
  },
  
  
  
  _setupChild: function(/*Widget*/child){
    var node= child.domNode;
    if (node) {
      node.style.position = "absolute";
    }
  },
  
  
  
  _layoutChildren: function(){
    var 
      thisDomNode= this.domNode,
      children= this.getChildren(),
      totalWidth= 0,
      e1= dojo._getPadBorderExtents(thisDomNode),
      e2= dojo._getMarginExtents(thisDomNode),
      rightEdge= dojo.marginBox(thisDomNode).w - (e1.w - e1.l) - (e2.w - e2.l);
    
    for (var i= children.length-1; i>0; i--){
      var node= children[i].domNode;
      rightEdge-= dojo.marginBox(node).w;
      dojo.marginBox(node, {l:rightEdge});
    }
    var l= e1.l + e2.l;
    dojo.marginBox(children[0].domNode, {l: l, w: rightEdge - l});
  }
  
});//dojo.declare("baf.dijit.Statusbar", [dijit.layout._LayoutWidget], {

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

dojo.provide("baf.dijit.Wso");
dojo.require("dijit.form.Form");
dojo.require("dijit._Container");
(function(){
  dojo.declare("baf.dijit.Wso", [dijit.form.Form, dijit._Container], {
    dataResult: null,
    wsoDefResult: null,

    postscript: function(){
      this.inherited(arguments);
      
      //connect the callbacks...
      this.data.addCallback(this, "_continueWithData");
      this.data.addErrback(this, "_abortLoad");
      this.wsoDef.addCallback(this, "_continueWithWsoDef");
      this.wsoDef.addErrback(this, "_abortLoad");
    },
    
    buildRendering: function(){
      this.inherited(arguments);
      //TODO: make this better...
      this._loading= document.createElement("p");
      var node= this._loading;
      dojo.addClass(node, "bafDijitwsoLoading");
      node.innerHTML= "Loading...";
      dojo.place(node, this.domNode, "last");
      //END-TODO
    },

    
    addChild: function(widget){
      dojo.place(widget.domNode, this.domNode, "last");
      if(this._started && !widget._started && widget.startup){
        widget.startup();
      }
    }, 
    
    startup: function(){
      if (!this._started) {
        this._started= true;

        dojo.forEach(this.getChildren(), function(child){
          if (child.startup) {
            child.startup();
          }
        });
        this.inherited(arguments);
      }
    },
      
    
    _continueWithData: function(data) {
      this.dataResult= data;
      if (this.wsoDefResult) {
        this._finishLoad();
      }
    },
    
    _continueWithWsoDef: function(wsoDef) {
      this.wsoDefResult= wsoDef;
      if (this.dataResult) {
        this._finishLoad();
      }
    },
    
    _abortLoad: function() {
      if (!this.data) {
        return;
      }
      
      var 
        data= this.data,
        wsoDef= this.wsoDef;
      
      this.data= null;
      this.wsoDef= null;

      data.cancel();
      wsoDef.cancel();

      this._loading.innerHTML= "FAILED!!";
    },
    
    
    _finishLoad: function() {
      dojo.forEach(this.wsoDefResult.require, function(module){
        dojo["require"](module);
      });
      dojo.addOnLoad(dojo.hitch(this, "_buildForm"));
    },
    
    
    
    _buildForm: function(){
      dojo._destroyElement(this._loading);
      delete this._loading;
      
      var wsoDef= this.wsoDefResult; 
      dojo.style(this.domNode, {
        position: "absolute",
        width: wsoDef.size[0],
        height: wsoDef.size[1]
      });
      
      function walkChildren(children, parentWidget){
        for (var p in children) {
          var child= children[p];
          var ctor= dojo.getObject(child[0]);
          var widget= new ctor(child[1]);
          parentWidget.addChild(widget);
          if (child[2]) {
            walkChildren(child[2], widget);
          }
        }
      }      
            
      if (wsoDef.children) {
        walkChildren(wsoDef.children, this);
      }
      this.startup();
    }
    
    
  });//dojo.declare("baf.dijit.wso", [dijit.form.Form, dijit._Container], {
})();

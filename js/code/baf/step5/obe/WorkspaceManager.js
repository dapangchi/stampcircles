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

dojo.provide("obe.WorkspaceManager");
dojo.require("obe.main");
dojo.require("baf.dijit.Wso");
(function(){
  var nullObjectValue= {type: 0, oid: 0, form: null};
  
  dojo.declare("obe.WorkspaceManager", null, {
    constructor: function() {
      this.currentObject= nullObjectValue;
      dojo.subscribe("focusNavNode", this, "_showObject");      
    },
    
    _showObject: function(store, item) {
      var
        type= store.getValue(item, "type"), //the wsoDefinition type
        oid= store.getValue(item, "oid"),   //the object id
        nid= store.getValue(item, "id"),    //the navigator id
        currentObject= this.currentObject;
        
      if (currentObject.type==type && currentObject.oid==oid) {
        //already the current object
        return;
      }
      
      //TODO: search for non-current, but loaded object

      //load the new current object
      var
        data= obe.main.dataManager.get(oid),
        wsoDef= obe.main.wsoDefinitionsManager.get(type),
        theNewObject= new baf.dijit.Wso({data: data, wsoDef: wsoDef});
      
      //destroy the old current object...
      this.destroy();

      //display the new current object...
      obe.main.appContainer.addChild(dojo.mixin(theNewObject, {
        region: "center",
        id: nid+"_wso" //"wso" => "workspace object"        
      }));
      obe.main.appContainer.layout();
      
      //record the current state...
      currentObject.type= type;
      currentObject.oid= oid;
      currentObject.nid= nid;
      currentObject.form= theNewObject;
    },
    
    destroy: function() {
      var currentObject= this.currentObject;
      if (currentObject.form) {
        obe.main.appContainer.removeChild(currentObject.form);
        currentObject.form.destroyRecursive();
      }
      currentObject= nullObjectValue;
    }
    
  });

})();//(function(){


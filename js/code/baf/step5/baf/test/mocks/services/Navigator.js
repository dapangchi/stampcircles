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
dojo.provide("baf.test.mocks.services.Navigator");
dojo.require("baf.test.mocks.services.Base");
dojo.require("baf.data.LazyTreeStore");
(function(){
  dojo.declare("baf.test.mocks.services.Navigator", baf.test.mocks.services.Base, {
    constructor: function(args){
      this._delay= 200;
      this._data= args.data;
      
      var idToItem= this._idToItem= [];
      function walk(item) {
        idToItem[item.id]= item;
        dojo.forEach(item.children, walk);
      }
      walk(args.data);
    },
    
    handler: function(theDeferred, args){
      
      function getItemToReturn(item){
          var result= dojo.mixin({}, item);
          result.childrenState= (item.children) ? 
            baf.data.LazyTreeStore.childrenMaybe : 
            baf.data.LazyTreeStore.childrenNever;
          delete result.children;
          return result;        
      }

      if (!args.content.getChildren) {
        var item= this._idToItem[args.content.id];
        if (item) {
          theDeferred.callback(getItemToReturn(item));
        } else {
          theDeferred.callback({});
        }
      } else {
        var parent= this._idToItem[args.content.id];
        if (parent && parent.children) {
          var result= [];
          dojo.forEach(parent.children, function(child){
            result.push(getItemToReturn(child));
          });
          theDeferred.callback(result);
        } else {
          theDeferred.callback([]);
        }        
      }
    }
  });//dojo.declare("baf.test.mocks.services.Navigator", baf.test.mocks.services.Base, {
})();//function(){

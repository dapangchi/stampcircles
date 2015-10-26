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

dojo.provide("baf.dijit.LazyTreeModel");
dojo.require("dijit.Tree");
(function(){
  
  
  dojo.declare("baf.dijit.LazyTreeModel", dijit.tree.TreeStoreModel, {
    // summary:
    //    An optimization of dijit.tree.TreeStoreModel; 
    //    requires baf.data.LazyTreeStore.

    mayHaveChildren: function(item){
      return this.store.hasChildren(item);
    },
  
    getChildren: function(parentItem, onComplete, onError){
      // Calls onComplete() with array of child items 
      // of given parent item, all loaded.
      var store = this.store;
      if (!this.mayHaveChildren(parentItem)) {
        //no children...
        onComplete([]);
      } else if (store.childrenLoaded(parentItem)) {
        //children already loaded...
        onComplete(store.getValues(parentItem, "children"));
      } else {
        //need to load the children...
        store.fetch({
          id: parentItem.id,
          getChildren: true, 
          onComplete: onComplete,
          onError: onError
        });
      }
    },

    //No write functionality...
    newItem: function(){
      throw new Error('baf.dijit.LazyTreeModel: not implemented.');
    },
  
    pasteItem: function(){
      throw new Error('baf.dijit.LazyTreeModel: not implemented.');
    }
  });
  
  
})();//(function(){


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
dojo.provide("obe.test.data.MockNavigatorDataBuilder");
dojo.require("baf.data.LazyTreeStore");
(function(){
  dojo.declare("obe.test.data.MockNavigatorDataBuilder", null, {
    constructor: function(propertyList){
      this.propertyList= propertyList;
      this.stack= [];
      this.id= 0;
      this.current= this.syntheticRoot= {id: 0, children: []};
    },

    pushLNode: function() { //"LNode" => "leaf node"
      var item= {
        id: this.id++, 
        parentId: this.current.id,
        childrenState: baf.data.LazyTreeStore.childrenNever
        };
      var args= arguments;
      dojo.forEach(this.propertyList, function(p, i){
        item[p]= args[i];
      });
      this.current.children.push(item);
      return item;
    },
    
    pushINode: function() { //"INode" => "interior node"
      var item= this.pushLNode.apply(this, arguments);
      item.childrenState= baf.data.LazyTreeStore.childrenMaybe;
      item.children= [];
      this.stack.push(this.current);
      this.current= item;
    },
    
    pop: function() {
      this.current= this.stack.pop();
    },
    
    getResult: function() {
      if (this.syntheticRoot.children.length>1) {
        return this.syntheticRoot.children;
      } else {
        return this.syntheticRoot.children[0];
      }
    }
  });//dojo.declare("obe.test.data.MockNavigatorDataBuilder", null, {
})();//(function(){

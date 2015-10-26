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
dojo.provide("baf.test.mocks.services.WsoDefinitions");
dojo.require("baf.test.mocks.services.Base");
dojo.require("baf.data.LazyTreeStore");
(function(){
  dojo.declare("baf.test.mocks.services.WsoDefinitions", baf.test.mocks.services.Base, {
    constructor: function(args){
      this._data= [];
      dojo.forEach(args.data, function(item){
        this._data[item.tid]= item;
      }, this);
    },
    
    handler: function(theDeferred, args){
      if (this._data[args.content.tid]) {
        theDeferred.callback(this._data[args.content.tid]);
      } else {
        theDeferred.errback(new Error("baf.test.mocks.services.WsoDefinitions failed request"));
      }
    }
    
  });//dojo.declare("baf.test.mocks.services.WsoDefinitions", baf.test.mocks.services.Base, {
})();//(function(){

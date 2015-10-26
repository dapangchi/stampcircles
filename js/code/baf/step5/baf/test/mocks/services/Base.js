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

dojo.provide("baf.test.mocks.services.Base");
(function(){
  dojo.declare("baf.test.mocks.services.Base", null, {
    constructor: function(args){
      this.delay= args.delay || 100;
    },
    
    getService: function() {
      return dojo.hitch(this, "call");
    },
    
    call: function(args){
      var result= new dojo.Deferred();
      if (args.load) {
        result.addCallback(args.load);
      }
      if (args.error) {
        result.addErrback(args.load);
      }   
      if (args.handle) {
        result.addBoth(args.handle);
      }            
      setTimeout(dojo.hitch(this, "handler", result, args), this.delay);
      return result;
    },

    handler: function(theDeferred, args){
      throw new Error('baf.test.mocks.services.Base: handler not specified');
    }
  });//dojo.declare("baf.test.mocks.services.Base", null, {
})();//(function(){


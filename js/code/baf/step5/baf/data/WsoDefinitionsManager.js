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
dojo.provide("baf.data.WsoDefinitionsManager");
(function(){
  dojo.declare("baf.data.WsoDefinitionsManager", null, {
    constructor: function(
      args //startup parameters passed to main
    ){
      this._service= args.wsoDefinitionsService;
      this._cache= [];
    },
    
    get: function(tid){
      var result;
      if (this._cache[tid]){
        result= new dojo.Deferred();
        result.callback(this._cache[tid]);
      } else {
        result= this._service.call({content:{tid:tid}});
        result.addCallback(dojo.hitch(this, "_catchServerResponse", result, tid));
      }
      return result;
    },
    
    _catchServerResponse: function(theDeferred, tid, wsoDefinition){
      if (!wsoDefinition.tid || wsoDefinition.tid != tid) {
        return new Error('baf.data.WsoDefinitionsManager: failed to get wsoDefinition');
      } else {
        //continue with callback chain...
        return wsoDefinition;
      }
    }
  });//dojo.declare("baf.data.WsoDefinitionsManager", null, {
  
})();//(function(){

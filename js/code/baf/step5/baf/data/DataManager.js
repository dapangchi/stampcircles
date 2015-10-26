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

dojo.provide("baf.data.DataManager");
(function(){
  dojo.declare("baf.data.DataManager", null, {
    get: function(oid){
      var result= new dojo.Deferred();
      result.callback({});
      return result;
    }
  });//dojo.declare("baf.data.DataManager", null, {
  
})();//(function(){

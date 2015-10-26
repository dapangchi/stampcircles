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
dojo.provide("baf.util");
(function(){
  var emptyObject= {};

  dojo.mixin(baf.util, {
    setDefaults: function(args, defaults){
      for (var p in defaults) {
        if (emptyObject[p] && emptyObject[p]===defaults[p]) {
          continue;
        }
        if (args[p] === undefined) {
          args[p] = defaults[p];
        } else if (dojo.isObject(defaults[p])){
          baf.util.setDefaults(args[p], defaults[p]);
        }
      }
      return args;
    },
    
    forEachString: function(strings, proc, context){
      return dojo.forEach(strings.split("."), proc, context);
    }

  });//dojo.mixin(baf, {
  
})();//(function(){


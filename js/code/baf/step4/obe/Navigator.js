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

dojo.provide("obe.Navigator");
(function(){

  dojo.declare("obe.Navigator", null, {
    constructor: function(
      args //startup parameters passed to main
    ){
      if (args.navigator.store) {
        this.store = new args.navigator.store(args.navigator.storeArgs);
        args.navigator.modelArgs.store= this.store;
        args.navigator.widgetArgs.store= this.store;
      }
      if (args.navigator.model) {
        this.model= new args.navigator.model(args.navigator.modelArgs);
        args.navigator.widgetArgs.model= this.model;
      }
  
      this.widget= new args.navigator.widget(args.navigator.widgetArgs);
    }
  });//;dojo.declare("obe.Navigator", null, {
  
})();//(function(){


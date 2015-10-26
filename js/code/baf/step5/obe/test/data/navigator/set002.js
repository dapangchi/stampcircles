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
dojo.provide("obe.test.data.navigator.set002");
dojo.require("obe.test.data.MockNavigatorDataBuilder");
(function(){
  
  var 
    builder= new obe.test.data.MockNavigatorDataBuilder(["label", "type", "oid"]),
    oid= 0;

  builder.pushINode("root", 0, oid++);
  builder.pushLNode("Test-1", 1, oid++);
  builder.pushLNode("Test-2", 2, oid++);
  builder.pushLNode("Test-3", 3, oid++);
  builder.pushLNode("Test-4", 4, oid++);

  obe.test.data.navigator.set002= builder.getResult();
})();//(function(){

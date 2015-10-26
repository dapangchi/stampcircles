/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("obe.test.tests.run001");
dojo.require("obe.test.data.command.set001");
dojo.addOnLoad(function(){
  var startupArgs= {
    commandItems: obe.test.data.command.set001.commandItems,
    menu: obe.test.data.command.set001.mainMenu
  };
  obe.main.startup(startupArgs);
});

  

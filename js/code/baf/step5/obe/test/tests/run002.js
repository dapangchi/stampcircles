/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("obe.test.tests.run002");
dojo.require("obe.test.data.wsoDefinitions.set002");
dojo.require("obe.test.data.navigator.set002");
dojo.require("obe.test.data.command.set001");
dojo.require("baf.test.mocks.services.Navigator");
dojo.require("baf.test.mocks.services.WsoDefinitions");
(function(){
  var navData= obe.test.data.navigator.set002;
  var navigatorService= new baf.test.mocks.services.Navigator({
    data: navData
  });
  
  var wsoDefinitionsService= new baf.test.mocks.services.WsoDefinitions({
    data: obe.test.data.wsoDefinitions.set002.wsoDefinition
  });
    
  var startupArgs= {
    commandItems: obe.test.data.command.set001.commandItems,
    menu: obe.test.data.command.set001.mainMenu,
    navigator: {
      storeArgs: {
        service: navigatorService.getService(),
        root: navData
      },
      modelArgs: {
        root: navData 
      }
    },
    wsoDefinitionsService: wsoDefinitionsService
  };
  obe.main.startup(startupArgs);

  //fake it for now...
  obe.main.statusbar.setTextPane("message", "Ready...");
  obe.main.statusbar.setTextPane("userName", "Rawld C. Gill");
  obe.main.statusbar.setTextPane("role", "Administrator");

})();


  

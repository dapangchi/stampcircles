/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("obe.test.tests.run001");
dojo.require("obe.test.data.navigator.set001");
dojo.require("obe.test.data.command.set001");
dojo.require("baf.test.mocks.services.Navigator");
(function(){
  var navData= obe.test.data.navigator.set001;
  var navigatorService= new baf.test.mocks.services.Navigator({
    data: navData
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
    }
  };
  obe.main.startup(startupArgs);

  //fake it for now...
  obe.main.statusbar.setTextPane("message", "Ready...");
  obe.main.statusbar.setTextPane("userName", "Rawld C. Gill");
  obe.main.statusbar.setTextPane("role", "Administrator");

})();


  

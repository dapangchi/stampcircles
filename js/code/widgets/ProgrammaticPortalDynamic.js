/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.widgets.ProgrammaticPortalDynamic");

dojo.require("dijit.layout.AccordionContainer");

dojobook.widgets.ProgrammaticPortalDynamic.drawPortal = function() {
   // Save the node to attach to.  We can use it inside of the load()
   // function via lexical scoping.
   var accContainer = dijit.byId("ups");
   
   // Read the data from our JSON portal data file
   dojo.xhrGet({
      url: "portal_data.json",
      timeout: 1000,
      handleAs: "json",
      // This is the callback used when data arrives
      load: function(objResponse) {
         // Loop once for each array element in tiles, putting the object 
         // in portalUrl
         dojo.forEach(objResponse.tiles, function(portalUrl) {
            // Construct the AccordionPane for that tile
            var ap = new dijit.layout.AccordionPane({ 
                title: portalUrl.title, 
                href: "services/pure_proxy.php?url="+portalUrl.url
            });
            // And put it in the AccordionContainer
            accContainer.addChild(ap);            
         });
      },
      error: function(text) {
         // A Toaster will catch this error and display it
         dojo.publish("xhrError", 
            { message: text, type: "error", duration: 0 }
         );
         return text;
      }
   });
}


dojobook.widgets.ProgrammaticPortalDynamic.newPane = function() {
   // Get the value from the form  
   var newUrl = dojo.byId("newUrl").value;
   var newTitle = dojo.byId("newTitle").value;
   
   // Set up the new AccordionPane and insert it at the end
   var ap = new dijit.layout.AccordionPane(
     { 
        title: newTitle, 
        href: "services/pure_proxy.php?url="+newUrl
     }
   );
   dijit.byId("ups").addChild(ap);            
}
   
dojobook.widgets.ProgrammaticPortalDynamic.deletePane = function() {
   // First get the selected pane, just like we did in declarative example
   var accContainer = dijit.byId("ups");
   var chosenPane = accContainer.selectedChildWidget;
   
   // And remove it
   accContainer.removeChild(chosenPane);
}

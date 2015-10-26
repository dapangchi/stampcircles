/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.widgets.ProgrammaticPortalStatic");

dojobook.widgets.ProgrammaticPortalStatic.setUrl = function() {
   // returns back the div tag of the selected AccordionPane
   var paneList = dijit.byId("ups");    
   
   // Get the selected dijit.layout.AccordionPane.  This is 
   // kept in selectedChildWidget
   var chosenPane = paneList.selectedChildWidget;
   
   // Now, get the value from the text box.  Note we can use 
   // dojo.byId() here because the .value property is a property of Node
   var newUrl = dojo.byId("newUrl").value;
   
   // Change the URL from which the content comes.  Using setHref 
   // changes the content right away.
   chosenPane.setHref("services/pure_proxy.php?url=" + newUrl);
}



// This code is run when all the widgets have loaded. 
dojo.addOnLoad(function() {
  var accContainer = dijit.byId("ups");
  var pane1 = new dijit.layout.AccordionPane({
     title: "Madagascar Hissing Cockroach", 
     href:  "services/pure_proxy.php?url=entomology.unl.edu"
           +"/k12/Croach/roachinfo/roachpage.html"
  });
  // AccordionContainer has removeChild method for easy 
  // manipulation of subwidgets. 
  accContainer.addChild(pane1); 
  
  
  var pane2 = new dijit.layout.AccordionPane(
      { 
        title: "Wallaby",
        href:  "services/pure_proxy.php?url=animals.nationalgeographic.com/animals/mammals/wallaby.html" 
      }
  );
  accContainer.addChild(pane2); 
  var pane3 = new dijit.layout.AccordionPane(
      { 
        title: "Hermit Crab",  
        url: "services/pure_proxy.php?url=www.hermitcrabassociation.com/phpBB/index.php"
      }
  );
  accContainer.addChild(pane3); 
  
});

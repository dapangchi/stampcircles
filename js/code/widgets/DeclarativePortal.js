/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.widgets.DeclarativePortal");

dojobook.widgets.DeclarativePortal.setUrl = function() {
   // returns back the div tag of the selected AccordionPane
   var paneList = dijit.byId("ups");    
   
   // Get the selected dijit.layout.AccordionPane.  This is 
   // kept in selectedChildWidget
   var chosenPane = paneList.selectedChildWidget;
   
   // Now, get the value from the textbox.  Note we can use 
   // dojo.byId() here because the .value property is a property of Node
   var newUrl = dojo.byId("newUrl").value;
   
   // Change the URL from which the content comes.  Using setHref 
   // changes the content right away.
   chosenPane.setHref("services/pure_proxy.php?url=" + newUrl);
}


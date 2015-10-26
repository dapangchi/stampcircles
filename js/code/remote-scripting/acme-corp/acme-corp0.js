/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
(function() {

  function loadContent(fragment){
    dojo.xhrGet({
      url:  fragment + ".htm",
      handleAs: "text",
      handle: function(response){
        dojo.byId("content").innerHTML = response;
      }
    });
  }

  function doMainMenu(e){
    dojo.stopEvent(e);
    var fragment= e.target.getAttribute("href").split("#")[1]
    loadContent(fragment);
  }

  dojo.addOnLoad(function(){
    dojo.connect(dojo.byId("menu"), "click", doMainMenu);
    loadContent("home");
  })

})();

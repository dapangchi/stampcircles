/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.require("dojo.back");
(function() {
  
  function getFragment(){
    var parts= window.location.href.split("#");
    if (parts.length==2) {
      return parts[1];
    } else {
      return "home";
    }    
  }

  var State = function(fragment){
    this.changeUrl = fragment;
  }

  dojo.extend(State, {
    back: function() {
      loadContent(this.changeUrl);
    },
    forward: function(){
      loadContent(this.changeUrl);
    }
  });
  
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
    dojo.back.addToHistory(new State(fragment));
  }

  dojo.addOnLoad(function(){
    dojo.connect(dojo.byId("menu"), "click", doMainMenu);
    var initialFragment= getFragment();
    loadContent(initialFragment);
    dojo.back.setInitialState(new State(initialFragment));
  })

})();

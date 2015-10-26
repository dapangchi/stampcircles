/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
(function (){
  djConfig= {};
  
  function option(defaultValue) {
    if (!location.search || location.search=="") {
      return defaultValue;
    } else {
      var result= Number(location.search.substr(8));
      return result
    }
  }

  if (location.pathname == "/index-dev.htm") {
    switch (option(1)) {
      case 1:
        //demonstrate absolute paths...
        djConfig.modulePaths = {
          acmeDijit: "/js/acmecorp/acmeDijit",
          acmeLib: "/js/acmecorp/acmeLib",
          magiBrowse: "/js/magiBrowse"
        };
        return;
      case 2:
        //paths are relative to dojo-module-path==dojo.baseUrl is not set
        djConfig.modulePaths = {
          acmeDijit: "../../acmecorp/acmeDijit",
          acmeLib: "../../acmecorp/acmeLib",
          magiBrowse: "../../magiBrowse"
        };
        return;
      default:
    }
  } else {//the release version of index.htm...
    switch (option(3)) {
      case 3:
        //demonstrate release doesn't need module paths
        return;
      case 4:
        //demonstrate how to force the cross-domain loader
        djConfig.modulePaths = {
          acmeDijit: "http://localhost:8002/js/release/magiBrowse/acmecorp/acmeDijit",
          acmeLib: "http://localhost:8002/js/release/magiBrowse/acmecorp/acmeLib",
          magiBrowse: "http://localhost:8002/js/release/magiBrowse/magiBrowse"
        };
        return;          
    }    
  }
  
  alert("Invalid configuration option.");    
})();

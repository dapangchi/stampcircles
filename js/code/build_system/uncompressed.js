/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
/**
 * Mastering Dojo - JavaScript and Ajax Tools for Great Web Experiences
 * 
 * This is a sample module that shows off Dojo JavaScript compression.
 * 
 */
(function(){
  dojo.provide("myApp.uncompressed");
  
  //
  // someFunction: a private function to this module
  //
  function someFunction(
    parameter1, //(type) this is the documentation for parameter1
    parameter2, //(type) this is the documentation for parameter2
    parameter3  //(type) this is the documentation for parameter3
  ){
    var aWellNamedVariable= parameter1 + parameter2;
    return aWellNamedVariable*parameter3;
  }

  //
  // publicFunction: a function published by this module
  //
  myApp.uncompressed.publicFunction= function(
    parameter1, //(type) this is the documentation for parameter1
    parameter2, //(type) this is the documentation for parameter2
    parameter3  //(type) this is the documentation for parameter3
  ){
    return someFunction(parameter1, parameter2, parameter3);
  }
  
})();

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
  var //Rule 3; begin a list of definition
  
  thisModule= dojo.provide("myApp.uncompressed"), //Rule2, Rule3
  
  //
  // someFunction: a private function to this module
  //
  someFunction= function( //Rule1, Rule3
    parameter1, //(type) this is the documentation for parameter1
    parameter2, //(type) this is the documentation for parameter2
    parameter3  //(type) this is the documentation for parameter3
  ){
    var aWellNamedVariable= parameter1 + parameter2;
    return aWellNamedVariable*parameter3;
  }
  
  ;//Rule 3; end a list of definitions
  
  //
  // publicFunction: a function published by this module
  //
  thisModule.publicFunction= function( //Rule 2
    parameter1, //(type) this is the documentation for parameter1
    parameter2, //(type) this is the documentation for parameter2
    parameter3  //(type) this is the documentation for parameter3
  ){
    return someFunction(parameter1, parameter2, parameter3);
  }
  
})();

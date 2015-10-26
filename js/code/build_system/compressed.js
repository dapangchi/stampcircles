/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
(function(){
dojo.provide("myApp.uncompressed");
function someFunction(_1,_2,_3){
var _4=_1+_2;
return _4*_3;
};
myApp.uncompressed.publicFunction=function(_5,_6,_7){
return someFunction(_5,_6,_7);
};
})();


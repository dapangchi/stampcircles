/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.query("div.questions p");



result= myNodeList.coords();
//is equivalent to...
result= myNodeList.map(dojo.coords);



//getter...
result= myNodeList.attr(property);
//is equivalent to...
result= myNodeList.map(
  function(node){return dojo.attr(node, property);}
);
//result is an array of strings

//setter...
result= myNodeList.attr(property, value);
//is equivalent to...
myNodeList.forEach(
  function(node){dojo.attr(node, property, value);}
);
result= myNodeList;
//result is the original MyNodeList



result= myNodeList.addClass(className);
//is equivalent to...
myNodeList.forEach(
  function(node){dojo.addClass(node, className);}
);
result= myNodeList;
//result is the original MyNodeList




//referenceNode is a DOM node...
result= myNodeList.place(referenceNode, position);
//is equivalent to...
myNodeList.forEach( 
  function(node){dojo.place(node, referenceNode, position);}
);
result= myNodeList;
//result is the original MyNodeList

//referenceNode is a selector...
result= myNodeList.place(selector, position);
//is equivalent to...
myNodeList.forEach( 
  function(node){dojo.place(node, dojo.query(selector)[0], position);}
);
result= myNodeList;
//result is the original MyNodeList




//no handler context provided
result= myNodeList.connect(event, handler);
//is equivalent to...
myNodeList.forEach( 
  function(node){dojo.connect(node, event, handler);}
);
result= myNodeList;
//result is the original MyNodeList

//with handler context
result= myNodeList.connect(event, context, handler);
//is equivalent to...
myNodeList.forEach( 
  function(node){dojo.connect(node, event, context, handler);}
);
result= myNodeList;
//result is the original MyNodeList



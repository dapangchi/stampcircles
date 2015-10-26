/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
/*

>>> //get a node to play with...
>>> var node= dojo.byId("top");

>>> //class names are added to the right side...
>>> dojo.addClass(node, "c1");
>>> node.className;
"c1"
>>> dojo.addClass(node, "c2");
>>> node.className;
"c1 c2"

>>> //adding a class already there does nothing...
>>> dojo.addClass(node, "c2");
>>> node.className
"c1 c2"

>>> //"c2 c1" NOT already there...
>>> dojo.addClass(node, "c2 c1");
>>> node.className;
"c1 c2 c2 c1"

>>> //nothing surprising here...
>>> dojo.hasClass(node, "c1");
true
>>> dojo.hasClass(node, "c2");
true
>>> dojo.hasClass(node, "c1 c2 c2");
true
>>> dojo.hasClass(node, "c3");
false

>>> //classes are removed from the left side...
>>> dojo.removeClass(node, "c1");
>>> node.className;
"c2 c2 c1"
>>> dojo.removeClass(node, "c2 c2");
>>> node.className;
"c1"

>>> //nothing surprising here...
>>> dojo.toggleClass(node, "c2");
>>> node.className;
"c1 c2"
>>> dojo.toggleClass(node, "c2");
>>> node.className;
"c1"

*/


//assume error is a boolean...

if (error) {
  dojo.addClass(someNode, "displayAsError");
} else {
  dojo.removeClass(someNode, "displayAsError");
}

//becomes...

dojo.toggleClass(someNode, "displayAsError", error);



/*

>>> //single-argument variety => a getter
>>> //returns a reference to a computed style object just
>>> //like the DOM Window.getComputedStyle function
>>> dojo.style(node);
ComputedCSSStyleDeclaration borderLeftWidth=0px borderTopWidth=0px

>>> //three-argument variety => a setter
>>> //styles values are just like in a style sheet
>>> dojo.style(node, "border", "2px solid black");
"2px solid black"

>>> //two-argument variety => a getter for a particular style
>>> //NOTE: style names are CAMEL CASE!
>>> dojo.style(node, "borderTopWidth");
2

>>> //this WILL NOT WORK! (style names are camel case)
>>> dojo.style(node, "border-top-width");
0




>>> //3 arguments => setter
>>> //sets the attribute "name" to "foo"
>>> dojo.attr(node, "name", "foo");

>>> //2 arguments => getter
>>> //returns "foo"
>>> dojo.attr(node, "name");
"foo"

>>> //no surprise here...
>>> dojo.hasAttr(node, "name");
true

>>> //this all works with user-defined attributes...
>>> //add an attribute..
>>> dojo.attr(node, "myAttrib", "myValue");

>>> //get its value...
>>> dojo.attr(node, "myAttrib");
"myValue"

>>> //check existence...
>>> dojo.hasAttr(node, "myAttrib");
true

>>> //remove it...
>>> dojo.removeAttr(node, "myAttrib");
>>> dojo.hasAttr(node, "myAttrib");
false



dojo.attr("nodeId", {
  tabIndex: "-1",
  customAttr: "custom value",
  title: "an awesome node"
});


*/


//node is a DOM node

//move node to 20 pixels right and 30 pixels down from the reference box
//the box size is not changed.
dojo.marginBox(node, {l:20, t:30});

//size the box to 40 pixels wide by 50 pixels high
//the box top-left corner is not moved
dojo.marginBox(node, {h:40, w:50});

//do both of the operations above at once
dojo.marginBox(node, {l:20, t:30, h:40, w:50});



dojo.NodeList.prototype.fadeAndClear= function() {
  this.forEach(function(node){ 
    dojo.anim(node, {backgroundColor:yellow});
    dojo.removeClass(node, "changed"); }
  ); 
  return this; 
};

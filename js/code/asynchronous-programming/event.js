/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
function(){
  

function handleClick(eventObj){
  //TODO...print information about the event
}



function handleClick(eventObj){
  console.log(
    "Event(" + eventObj.type +
    ") on DOM node " + eventObj.target.id +
    "; currentTarget= " + eventObj.currentTarget.id);
}



function someKeyDownHandler(eventObj) { 
  switch (eventObj.keyCode) { 
    case dojo.keys.F10: //process F10 key....
      console.log("you just pressed the F10 key");
      break;

    //etc... 

  }
}



function someHandler(eventObj) {
  //do something interesting...

  //now, stop bubbling...
  eventObj.stopPropagation();
}



function handleClick(eventObj){
  console.log(
    "Event(" + eventObj.type +
    ") on target " + eventObj.target.id +
    "; currentTarget= " + eventObj.currentTarget.id);
  
  //eventObj is of type MouseEvent
  if (eventObj.shiftKey) {
    //stop bubbling shift-click was pressed.
    eventObj.stopPropagation();
  }
}



function someHandler(eventObj) {
  //do something interesting...
  
  //now, prevent the default processing...
  eventObj.preventDefault();
}



function someHandler(eventObj) {
  //do something interesting...
  
  //the statement...
  dojo.stopEvent(eventObj);
  
  //...is exactly equivalent to...
  eventObj.stopPropagation();
  eventObj.preventDefault();
}



function connectExercise() {
  dojo.connect(dojo.byId("body"), "click", handleClick);
  dojo.connect(dojo.byId("body-div"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-p"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-ol"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-ol-li-1"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-ol-li-2"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-ol-li-3"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-ol-li-4"), "click", handleClick);
  dojo.connect(dojo.byId("body-div-ol-li-5"), "click", handleClick);
  
  //Note!!
  //all the lines above can be replaced with
  //dojo.query("body *").connect("click", handleClick);
  //see Chapter 7
}


/*

Event(click) on target body-div-ol-li-2; currentTarget= body-div-ol-li-2
Event(click) on target body-div-ol-li-2; currentTarget= body-div-ol
Event(click) on target body-div-ol-li-2; currentTarget= body-div
Event(click) on target body-div-ol-li-2; currentTarget= body

*/


/*

Event(click) on DOM node body-div-ol-li-2; currentTarget= body-div-ol-li-2

*/


function myClickHander1(event) {
  /* as required */
}
function myClickHander2(event) {
  /* as required */
}
dojo.connect(someDomNode, "click", 
  function(event){ myHandler1(event); myHandler2(event); } 
);




dojo.hitch(
  function(event){ myHandler1(event); myHandler2(event); } 
);


function() {
  
  dojo.addOnLoad(f);                            //the function f
  dojo.addOnLoad(function(){/* statements */}); //a function literal
  dojo.addOnLoad(o, "f");                       //the function o["f"]
  
}

}

(function(){
  alert('in example 1');

//make a trivial function f...	
function f() {
  console.log("in f");
}	


var g= f; 
f= function() { 
  var result= g.apply(this, arguments); 
  console.log("exiting f");
  return result;
};


//exercise it...
f();
})();




function f() {
  console.log("hello, world");
}

function myHandler() {
  console.log("Hello from f's handler!");
}

var handle= dojo.connect("f", myHandler);


(function(){
  alert('in example 2');
f();
})();

function(){


//missing obj; event is a string:
dojo.connect("functionName", context, handler);
//is equivalent to explicitly specifying null for eventOwner
dojo.connect(null, "functionName", context, handler);
//in both cases, the triggering function is dojo.global["functionName"]
//(recall that dojo.global references the global object space)

//with a non-null obj, an object, not a DOM node:
dojo.connect(obj, "functionName", context, handler);
//the triggering function is obj["functionName"]

};


//print functionName (a string) and all of the elements of args (an array) 
//to the console
function giveMessage(functionName, args) {
  var message= "In " + functionName + "; the arguments are: ";
  dojo.forEach(args, function(arg){message+= arg.toString() + " ";});
  console.log(message);
}

//here is the function that we'll hook up to generate the event...
function printArgs() {
  giveMessage("printArgs", arguments); 
}

//here is the first event handler...
function firstHandler() {
  //this handler uses the arguments object to gain access to its arguments
  giveMessage("firstHandler", arguments); 
}

//and the second event handler...
function secondHandler(a1, a2) {
  //this handler explicitly declares what it expects for arguments
  giveMessage("secondHandler", [a1, a2]); 
}

//connect the firstHandler to fire whenever printArgs is invoked...
dojo.connect("printArgs", null, "firstHandler");

//and likewise for secondHandler....
dojo.connect("printArgs", null, "secondHandler");

(function(){
  alert('in example 3');


//let's exercise our exercise...
printArgs(1, 2);

})();

(function(){

//a simple object that accumulates a sum of numbers...
var numberAccumulator = { 
  total: 0, 
  add: function(x){this.total+= x;} 
};

//subscribe numberAccumulator.add to the topic "Numbers"
dojo.subscribe("Numbers", numberAccumulator, "add"); 

//prints numberAccumulator.total 
function showTotal() { 
  console.log("The total is: " + numberAccumulator.total);
}

//subscribe showTotal to the topic "Numbers"
dojo.subscribe("Numbers", showTotal);

//test it...
//NOTE: arguments passed as an array!
dojo.publish("Numbers", [1]);
dojo.publish("Numbers", [2]);

})();


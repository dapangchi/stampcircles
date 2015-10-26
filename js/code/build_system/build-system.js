/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
function() {
  

dojo.require("dojo.number");


/*

myApp/
    myModule/
        utilsA.js  //does NOT define a module
        utilsB.js  //does NOT define a module
    myModule.js 
    
    //other stuff...
    

*/  


//inside myApp.myModule.js...
dojo.require("myApp.myModule.utilsA", true);
dojo.require("myApp.myModule.utilsB", true);



dojo.provide("acmecorp.a");
dojo.require("acmecorp.b");

acmecorp.a.f= function() {
  //do something interesting...
}



dojo._xdResourceLoaded({
  depends: [
    ["require", "acmecorp.b"]
    ["provide", "acmecorp.a"]
  ],
  defineResource: function(){
    acmecorp.a.f= function() {
      //do something interesting...
    }
  }
});



var myVariable1= expression;
var myVariable2= expression;

var myFunction1= function(/*...*/){
  /*...*/
}

var myFunction2= function(/*...*/){
  /*...*/
}



var 
  myVariable1= expression, //note comma
  myVariable2= expression, //note comma

  myFunction1= function(/*...*/){
    /*...*/
  }, //note comma

  myFunction2= function(/*...*/){
    /*...*/
  }; //note semicolon


/*

magi-browse/ ---------------->magi-browse is a web app
  dev-tools/
    build-scripts/ ---------->we'll put dojo build scripts here
  public/ ------------------->document root for the web server
    index.htm --------------->the entry page for magi-browse
    css/
    docs/
    image/
    js/ --------------------->all JavaScript goes here
      acmecorp/ ------------->classes/modules used by multiple apps
        acmeDigit/ ---------->acmecorp dijit-based widgets
          Navitgator.js ----->the "acmeDigit.Navigator" widget
        acmeLib/ ------------>the acmecorp library
          nav.js ------------>the "acmeDigit.nav" module
      dojo/ ----------------->the dojo source release
        dojo/
        dijit/
        dojox/
        util/
      magiBrowse/ ----------->classes and modules specific to magiBrowse
        main.js ------------->the module magiBrowse.main
        MainController.js --->the class magiBrowse.MainController
        sessionData.js ------>the module magiBrowse.sessionData
        sessionView.js ------>the module magiBrowse.sessionView
        sessionView/ -------->children of magiBrowse.sessionView go here 
          DijitContainer.js ->the class magiBrowse.sessionView.DijitContainer
          util.js ----------->the module magiBrowse.sessionView.util



acmeDijit  --> "js/acmecorp/acmeDijit",
acmeLib    --> "js/acmecorp/acmeLib",
magiBrowse --> "js/magiBrowse"
dojo       --> "js/dojo/dojo"

  

acmeDijit  --> "js/acmeDijit",
acmeLib    --> "js/acmeLib",
magiBrowse --> "js/magiBrowse"
dojo       --> "js/dojo"



//>>excludeStart(block-name, expression);

...source code to exclude...

//>>excludeEnd(block-name);



magi-browse/public/js/release/magiBrowse/
  acmeDijit/  -->from magi-browse/public/js/acmecorp/acmeDijit
  acmeLib/    -->from magi-browse/public/js/acmecorp/acmeLib
  dojo/       -->from magi-browse/public/js/dojo/dojo
  magiBrowse/ -->from magi-browse/public/js/magiBrowse
  util/       -->create and filled by build



<script 
  type="text/javascript" 
  djConfig="isDebug: true" 
  src="js/release/magiBrowse/dojo/dojo.js" ></script>

<script type="text/javascript" >
  console.log("Finished script-include dojo.js");
  
  //hijack dojo.require to log message before and after it's called...
  var realDojoRequire= dojo.require;
  var id= 0;
  dojo.require= function(moduleName) {
    var thisId= ++id;
    console.log('Start(' + thisId + ') dojo.require("' + moduleName + '")');
    realDojoRequire.apply(dojo, arguments);
    console.log('Finished(' + thisId + ') dojo.require("' + moduleName + '")');
  }
  
  dojo.require("magiBrowse.main");
</script>



Finished script-include dojo.js
Start(1) dojo.require("magiBrowse.main")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/main.js
evaluating magiBrowse.main
Start(2) dojo.require("magiBrowse.MainController")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/MainController.js
evaluating magiBrowse.MainController
Start(3) dojo.require("acmeLib.nav")
GET http://localhost:8002/js/release/magiBrowse/acmeLib/nav.js
evaluating acmelib.nav
Finished(3) dojo.require("acmeLib.nav")
Finished(2) dojo.require("magiBrowse.MainController")
Start(4) dojo.require("magiBrowse.sessionData")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/sessionData.js
evaluating magiBrowse.sessionData
Finished(4) dojo.require("magiBrowse.sessionData")
Start(5) dojo.require("magiBrowse.sessionView")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/sessionView.js
evaluating magiBrowse.sessionView
Start(6) dojo.require("magiBrowse.sessionView.DynaDijitContainer")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/sessionView...
evaluating magiBrowse.sessionView.DynaDijitContainer
Finished(6) dojo.require("magiBrowse.sessionView.DynaDijitContainer")
Start(7) dojo.require("magiBrowse.sessionView.utils")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/sessionView...
evaluating magiBrowse.sessionView.utils
Finished(7) dojo.require("magiBrowse.sessionView.utils")
Start(8) dojo.require("acmeDijit.Navigator")
GET http://localhost:8002/js/release/magiBrowse/acmeDijit/navigator.js
evaluating acmeDijit.Navigator
Finished(8) dojo.require("acmeDijit.Navigator")
Finished(5) dojo.require("magiBrowse.sessionView")
Finished(1) dojo.require("magiBrowse.main")



Finished script-include dojo.js
Start(1) dojo.require("magiBrowse.main")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/main.js
evaluating acmelib.nav
evaluating magiBrowse.MainController
evaluating magiBrowse.sessionData
evaluating magiBrowse.sessionView.DynaDijitContainer
evaluating magiBrowse.sessionView.utils
evaluating acmeDijit.Navigator
evaluating magiBrowse.sessionView
evaluating magiBrowse.main
Finished(1) dojo.require("magiBrowse.main")



Finished script-include dojo.js
Start(1) dojo.require("magiBrowse.acmeBase")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/acmeBase.js
evaluating acmeDijit.Navigator
evaluating acmelib.nav
evaluating magiBrowse.acmeBase
Finished(1) dojo.require("magiBrowse.acmeBase")
Start(2) dojo.require("magiBrowse.main")
GET http://localhost:8002/js/release/magiBrowse/magiBrowse/main.js
evaluating magiBrowse.MainController
evaluating magiBrowse.sessionData
evaluating magiBrowse.sessionView.DynaDijitContainer
evaluating magiBrowse.sessionView.utils
evaluating magiBrowse.sessionView
evaluating magiBrowse.main
Start(3) dojo.require("magiBrowse.acmeBase")
Finished(3) dojo.require("magiBrowse.acmeBase")
Finished(2) dojo.require("magiBrowse.main")

*/


djConfig= {};
djConfig.modulePaths = {
  acmeDijit: "http://localhost:8002/js/release/magiBrowse/acmecorp/acmeDijit",
  acmeLib: "http://localhost:8002/js/release/magiBrowse/acmecorp/acmeLib",
  magiBrowse: "http://localhost:8002/js/release/magiBrowse/magiBrowse"
};


/*

Finished script-include dojo.js
Start(1) dojo.require("magiBrowse.acmeBase")
Finished(1) dojo.require("magiBrowse.acmeBase")
Start(2) dojo.require("magiBrowse.main")
Finished(2) dojo.require("magiBrowse.main")
evaluating acmeDijit.Navigator
evaluating acmelib.nav
evaluating magiBrowse.acmeBase
evaluating magiBrowse.MainController
evaluating magiBrowse.sessionData
evaluating magiBrowse.sessionView.DynaDijitContainer
evaluating magiBrowse.sessionView.utils
evaluating magiBrowse.sessionView
evaluating magiBrowse.main



<script 
  type="text/javascript" 
  src="http://localhost:8002/js/release/magiBrowse/magiBrowse/acmeBase.xd.js">
</script>
<script 
  type="text/javascript" 
  src="http://localhost:8002/js/release/magiBrowse/magiBrowse/main.xd.js">
</script>



<script 
  type="text/javascript" 
  src="http://o.aolcdn.com/dojo/1.1.0/dojo/dojo.xd.js.uncompressed.js">
</script>



<script 
  type="text/javascript" 
  src="/dojoroot/dojo/dojo.js"></script>



http://www.acmecorp.com/public/apps/email/index.htm



http://www.acmecorp.com/dojoroot/dojo/dojo.js



public-libs/
  dojo/
    dojo/
      dojo.js
      ...
    dijit/
      dijit.js
      ...
myApp/
  a.js
  b.js
  mySubsystem.js
  mySubsystem/
    c.js
  lib/
    version-1/
      x.js
    version-2/
      x.js

ddd

dojo.registerModulePath("myApp", "../../../myApp");



dojo.require("myApp.a");
  //loads /public-libs/dojo/dojo/../../../myApp/a.js
  
dojo.require("myApp.b");
  //loads /public-libs/dojo/dojo/../../../myApp/b.js



dojo.registerModulePath("myApp", "/myApp");



dojo.require("myApp.a"); //loads /myApp/a.js
dojo.require("myApp.b"); //loads /myApp/b.js



dojo.registerModulePath("lib", "../../../myApp/lib/version-1");



dojo.require("lib.x"); //loads lib/version-1/x.js      



dojo.registerModulePath("lib", getLibVersion());



<script 
  type="text/javascript" 
  src="../../dojo/dojo.js" 
  djConfig="modulePaths: {myApp: '../../../myApp'}">
</script>


*/


dojo.provide("myApp.mySubsystem.c");



//note: dojo.global references the global object space
if (typeof dojo.global.myApp=="undefined") {
  dojo.global.myApp= {};
}
if (typeof dojo.global.myApp.mySubsystem=="undefined") {
  dojo.global.myApp.mySubsystem= {};
}
if (typeof dojo.global.myApp.mySubsystem.c=="undefined") {
  dojo.global.myApp.mySubsystem.c= {};
}        

//other stuff...

return dojo.global.myApp.mySubsystem.c;



//enclose all source in a function literal 
//to avoid polluting the global namespace...
(function(){
  //define myApp.mySubsystem.c and take a reference...
  var thisModule= dojo.provide("myApp.mySubsystem.c");
  
  //all modules used by myApp.mySubsystem.c go here...
  dojo.require("myApp.a");
  dojo.require("myApp.b");
  dojo.require("myApp.mySubsystem");
  
  //private functions go here...
  function helper(){
    //...
  }

  function anotherHelper(){
    //...
  }
  
  //public functions go here...
  thisModule.awesome= function() {
    //...
  }
  
  thisModule.reallyAwesome= function() {
    //...
  }

//execute the function literal...
})();



dojo.provide("myApp.a");

myApp.a.sayHello= function() {
  alert("hello, world");
}


/*

<script type="text/javascript"> 
  dojo.require("myApp.a");
    
  sayHelloAndGoodbye= function() {
      myApp.a.sayHello();
      alert("goodbye");
    }
  
  myApp.a.sayHello();
</script>



<script type="text/javascript"> 
  dojo.require("myApp.a");
    
  sayHelloAndGoodbye= function() {
    myApp.a.sayHello();
    alert("goodbye");
  }
    
  dojo.addOnLoad(function(){
    myApp.a.sayHello();
  });
</script>

*/


dojo.provide("myApp.b");
dojo.require("myApp.a");
 
sayHelloAndGoodbye= function() {
  myApp.a.sayHello();
  alert("goodbye");
}
  
myApp.a.sayHello();


/*

<script type="text/javascript"> 
  dojo.require("myApp.b");
</script>

*/     

}
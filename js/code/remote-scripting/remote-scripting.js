/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

function example1(){
  dojo.xhrGet({
    url: "demo/id1",
    load: function(response){alert(response);},
    error: function(error){alert(error.message);}
  });
}



function example2(){
  dojo.xhrGet({
    url: "demo/id1",
    handle: function(response){
      if (response instanceof Error) {
        //failed...
        alert("failed: " + response.message);
      }
      else {
        //success...
        alert('succeeded: "' + response + '"');
      }
   }
  });
}



function handler1(response, ioArgs){
  var error= response instanceof Error;
  var responseText= error ? response.message : response;
  var resultNode= dojo.byId("result");
  resultNode.innerHTML= responseText.replace(/</g, "&lt;");
  dojo.toggleClass(resultNode, "error", error);
  dojo.byId("objects").innerHTML= 
    dumpObject({"this": this, ioArgs: ioArgs});
}

function example3(){
  dojo.xhrGet({
    url: "demo/id1",
    handle: handler1
  });
}



function example4(){
  //get some variables that we'll use in the handler function...
  var targetNode= dojo.byId("result");
  
  //make a handler closed on the variables we made...
  function handler2(response){
    var error= response instanceof Error;
    var responseText= error ? response.message : response;
    targetNode.innerHTML= responseText.replace(/</g, "&lt;");
    dojo.toggleClass(targetNode, "error", error);
    
    //note: NOT dumping anything...
    dojo.byId("objects").innerHTML= "";
  }
  
  //make the XHR call...
  dojo.xhrGet({
    url: "demo/id1",
    handle: handler2
  });
}



function example5(){
  function handler3(response){
    var error= response instanceof Error;
    var responseText= error ? response.message : response;
    this._user.targetNode.innerHTML= responseText.replace(/</g, "&lt;");
    dojo.toggleClass(this._user.targetNode, "error", error);
    
    //note: ONLY dumping this...
    dojo.byId("objects").innerHTML= 
      dumpObject({"this": this});
  }
  
  //make the XHR call...
  dojo.xhrGet({
    url: "demo/id1",
    handle: handler3,
    _user: {targetNode: dojo.byId("result")}
  });
}




function handler4(response, ioArgs){
  var error= response instanceof Error;
  var responseText= error ? response.message : ioArgs.xhr.responseText;
  var resultNode= dojo.byId("result");
  resultNode.innerHTML= responseText.replace(/</g, "&lt;");
  dojo.toggleClass(resultNode, "error", error);
  dojo.byId("objects").innerHTML= 
    dumpObject({response: response});
}

function example6(){
  dojo.xhrGet({
    url: "demo/id2",
    handleAs: "json",
    handle: handler4
  });
}



function example7(){
  dojo.xhrGet({
    url: "demo/id3",
    handleAs: "json-comment-filtered",
    handle: handler4
  });
}



function example8(){
  dojo.xhrGet({
    url: "demo/id2",
    handleAs: "json-comment-optional",
    handle: handler4
  });
}

function example9(){
  dojo.xhrGet({
    url: "demo/id3",
    handleAs: "json-comment-optional",
    handle: handler4
  });
}


function example10(){
  dojo.xhrGet({
    url: "demo/id4",
    handleAs: "javascript",
    handle: handler4
  });
  //returns "Number(dojo.byId("exId").value) * 10"
}



function example11(){
  function handler5(response, ioArgs){
    var error= response instanceof Error;
    var responseText= error ? response.message : ioArgs.xhr.responseText;
    var resultNode= dojo.byId("result");
    resultNode.innerHTML= responseText.replace(/</g, "&lt;");
    dojo.toggleClass(resultNode, "error", error);
    dojo.byId("objects").innerHTML= 
      dumpObject({response: response});
  }

  dojo.xhrGet({
    url: "demo/id5",
    handleAs: "xml",
    handle: handler5
  });
}


function example12(){
  function handler12(response, ioArgs){
    var error= response instanceof Error;
    var responseText= error ? response.message : ioArgs.xhr.responseText;
    var resultNode= dojo.byId("result");
    resultNode.innerHTML= responseText.replace(/</g, "&lt;");
    dojo.toggleClass(resultNode, "error", error);
    dojo.byId("objects").innerHTML= 
      dumpObject({"this": this, ioArgs: ioArgs}, {maxCount: 15});
  }
  

  dojo.xhrGet({
    url: "demo/id6",
    user: "john",
    password: "open-sesame",
    content: {
      param1: "someParamValue",
      param2: 2.7183
    },
    contentType: "text/plain",
    headers: {
      myKey: "someValue",
      anotherKey: 3.1416
    },
    sync: true,
    preventCache: true,
    handleAs: "json-comment-filtered",
    handle: handler12
  });
}



function example13(){
  dojo.xhrGet({
    form: "exForm",
    handleAs: "json-comment-filtered",
    handle: handler4
  });
}



function example14(){
  dojo.xhrGet({
    form: "exForm",
    content: {sex: "m", anotherParam: 3.1416},
    handleAs: "json-comment-filtered",
    handle: handler4
  });
}


function example99(){
  dojo.xhrGet({
    url: "demo/ex2",
    timeout: 50,
    handle: handler1
  });
}


function example15(){
  function loadScript(url, checkString){

    var element = dojo.doc.createElement("script");
    element.type = "text/javascript";
    element.src = url;
    dojo.doc.getElementsByTagName("head")[0].appendChild(element);

    var intervalId= setInterval(check, 50);
    
    function check(){
      if (eval("typeof(" + checkString + ") != 'undefined'")) {
        clearInterval(intervalId);
        o = dojo.getObject(checkString);
        dojo.byId("result").innerHTML = o.result.replace(/</g, "&lt;");
      }
    }
  }
  
  loadScript("demo/id8", "id8Object")
}


function snip102(){

id8Object= {};
id8Object.result= "exercise15--hello, world";

}


function example16(){
  function loadScript(url, callback){
    dojo.setObject(callback, function(o){
      dojo.byId("result").innerHTML = o.result.replace(/</g, "&lt;");
    })
        
    var element = dojo.doc.createElement("script");
    element.type = "text/javascript";
    element.src = url + "?callbackName=" + callback;
    dojo.doc.getElementsByTagName("head")[0].appendChild(element);
  }
  
  loadScript("demo/id9", "exercise16.myCallback")
}


function snip104(){

exercise16.myCallback({"result": "hello, world"});

}


dojo.require("dojo.io.script");
function example17(){
  
  function handler17(response, ioArgs){
    var error= response instanceof Error;
    var responseText= error ? response.message : id8Object.result;
    var resultNode= dojo.byId("result");
    resultNode.innerHTML= responseText.replace(/</g, "&lt;");
    dojo.toggleClass(resultNode, "error", error);
    dojo.byId("objects").innerHTML= 
      dumpObject({response: response, ioArgs: ioArgs});
  }
  
  dojo.io.script.get({
    url:"demo/id8",
    checkString:"id8Object",
    handle:handler17
  });
}




function example18(){
  dojo.require("dojo.io.script");
  
  function handler18(response, ioArgs){
    var error= response instanceof Error;
    var responseText= error ? response.message : response.result;
    var resultNode= dojo.byId("result");
    resultNode.innerHTML= responseText.replace(/</g, "&lt;");
    dojo.toggleClass(resultNode, "error", error);
    dojo.byId("objects").innerHTML= 
      dumpObject({"response": response, ioArgs: ioArgs});
  }
  
  dojo.io.script.get({
    url:"demo/id9",
    callbackParamName:"callbackName",
    handle:handler18
  });
}



dojo.require("dojo.io.iframe");
function handler20(response, ioArgs){
  if (!(response instanceof Error)) {
    dojo.byId("objects").innerHTML= 
      dumpObject({response: response, ioArgs: ioArgs});
  } else {
    var resultNode= dojo.byId("result");
    resultNode.innerHTML= response.message;
    dojo.toggleClass(resultNode, "error", true);
    dojo.byId("objects").innerHTML= 
      dumpObject({response: response, ioArgs: ioArgs});    
  }
}

function example20(){
  dojo.io.iframe.send({
    form: "exForm",
    url: "demo/id11",
    method: "post",
    handleAs: "json",
    handle: handler20
  });
}


/*

<html>
  <body>
      <textarea>{result: "OK"}</textarea>
  </body>
</html>

*/

/*

<script 
  type="text/javascript" 
  src="http://o.aolcdn.com/dojo/1.1.0/dojo/dojo.xd.js" 
  djConfig=
    "dojoBlankHtmlUrl: 'http://www.someCompany.com/dojo/resources/blank.html'">
</script>

*/



function example21(){
  
  function add(x, y) {
    var result;
    dojo.xhrPut({
      url: "http://calculator.com",
      content: {proc: "add", op1: x, op2: y},
      sync: true,
      handle: function(result_) {
        result= result_;
      }
    });
    return result;    
  }
  
  var one_plus_two= add(1, 2);
  
  alert("add(1, 2)= " + one_plus_two);
  
}


dojo.require("dojo.rpc.JsonService");
dojo.require("dojo.rpc.JsonpService");
function example22(){
  
  var arithmeticService = {
    serviceURL: "demo/id7",
    methods: [{
      name: "add",
      parameters: [{
        name: "op1",
        type: "number"
      }, {
        name: "op2",
        type: "number"
      }]
    }, {
      name: "subtract",
      parameters: [{
        name: "op1",
        type: "number"
      }, {
        name: "op2",
        type: "number"
      }]
    }]
  };
  
  
  
  //don't forget the keyword new!
  var calculator = new dojo.rpc.JsonService(arithmeticService);
  
  
  
  calculator.add(3, 4).addCallback(function(result){
    alert("3 + 4= " + result);
  });
  
  return;
  
  var junk= 
  
  {"params":[3,4],"method":"add","id":1}
  
  ;

  if (false) {
    
    //resultObject is the JSON object returned...
    if (resultObject.error!=null) {
      call_controlling_deferred.errback(parseError(resultObject));
    } else {
      call_controlling_deferred.callback(owning_rpc_dispatcher.parseResults(obj));
    }
    
  }

  if (false) {
    
    //resultObject is the JSON object returned...
    function parseResults(resultObject) {
      if (dojo.isObject(resultObject)) {
        if ("result" in resultObject) {
          return resultObject.result;
        }
        if ("Result" in resultObject) {
          return resultObject.Result;
        }
        if ("ResultSet" in resultObject) {
          return resultObject.ResultSet;
        }
      }
      return resultObject;
    }
    
  }

  if (false) {
    
    //resultObject is the JSON object returned...
    function parseError(resultObject) {
      var error;
      if (typeof resultObject.error == 'object') {
        error = new Error(resultObject.error.message);
        error.code = resultObject.error.code;
        error.error = resultObject.error.error;
      } else {
        error = new Error(resultObject.error);
      }
      error.id = resultObject.id;
      error.errorObject = resultObject;
      return error;
    }
    
  }
  
  
  var calculator = new dojo.rpc.JsonService(arithmeticService);
  calculator.parseResults= function(resultObject){
    return resultObject.arithmeticServiceResult;
  }
  
  
  
  var calculator = new dojo.rpc.JsonpService(arithmeticService);
  calculator.callbackParamName = "arithmeticService-callback-name";
  
  
  calculator.add({op1: 3, op2: 4}).addCallback(function(result){
    alert("3 + 4= " + result);
  });
  
}



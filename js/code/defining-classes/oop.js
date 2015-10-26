/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
(function () {
  
examples= [];
  
function doExercise(e){
  //prevent submitting the form...
  dojo.stopEvent(e);
  
  var exampleId= Number(dojo.byId("exId").value);
  if (examples[exampleId]) {
    //clear out the last results...
    var resultNode= dojo.byId("result");
    resultNode.innerHTML= "";
    dojo.toggleClass(resultNode, "error", false);
    dojo.byId("objects").innerHTML= "";
    
    //run the example...
    examples[exampleId]();
  } else {
    alert("Invalid example identifier provided.  Try again.");
  }
}

dojo.addOnLoad(function(){
  dojo.connect(dojo.byId("exTrigger"), "click", doExercise);
});

examples[1]= function(){
  
  var o1= {};
  var o2= {};
  var o3= new Object();
  //o1, o2, and o3 all have the same prototype object
  
  console.log("examples[1] -->")  
  console.log(
    "o1.constructor.prototype===o2.constructor.prototype => ", 
    o1.constructor.prototype===o2.constructor.prototype);
    
  console.log(
    "o1.constructor.prototype===o3.constructor.prototype => ", 
    o1.constructor.prototype===o3.constructor.prototype);

  
  var p1= {};
  function SomeConstructor(){}
  SomeConstructor.prototype= p1;
  SomeConstructor.prototype.constructor= SomeConstructor;
  
  var o1= new SomeConstructor();
  var o2= new SomeConstructor();
  //o1, and o2 have the same prototype object, p1
  
    
  console.log(
    "o1.constructor.prototype===o2.constructor.prototype => ", 
    o1.constructor.prototype===o2.constructor.prototype);
    
  console.log(
    "o1.constructor.prototype===p1 => ", 
    o1.constructor.prototype===p1);     
  console.log("<-- examples[1]")
}

examples[2]= function(){
  
  dojo.declare(
    //the name of the constructor function (class) created...
    "Shape",
    
    //this is where the superclass (if any) goes...    
    null,
    
    //this object contains everything to add to the new class's prototype...
    {
      //default property values can go in prototype...
      color: 0,
      
      //here is the single prototype method...
      setColor: function(color){
        this.color= color; 
      }
    }
  );
  
    
  
  //create a new Shape instance...
  var s= new Shape();

  //exercise it...    
  var check1= s.color;  //check1 is 0
  s.setColor(0x0000FF); //shape.color is now red
  var check2= s.color;  //check2 is red
  

  console.log("examples[2] -->")
  console.log("s: ", s);
  console.log("check1: ", check1, ", check2: ", check2);
  console.log("<-- examples[2]")
}

function ensureShapeIsDefined(){
  dojo.global.Shape || examples[2]();
}

examples[3]= function(){
  ensureShapeIsDefined();
  
  var s= new Shape();
  var check1= s instanceof Shape;  //check1 is true
  var check2= s instanceof Object; //check2 is true
  
  console.log("examples[3] -->")  
  console.log("check1: ", check1, ", check2: ", check2);
  console.log("<-- examples[3]")
}

examples[4]= function(){
  ensureShapeIsDefined();
  
  var s= new Shape();
  if (s.constructor==Shape) {
    //s is precisely a Shape object
  }
  
  console.log("examples[4] -->")  
  console.log("s.constructor===Shape: ", s.constructor===Shape, ", s.constructor!==Object: ", s.constructor!==Object);
  console.log("<-- examples[4]")
}

examples[5]= function(){
  ensureShapeIsDefined();

  
  dojo.declare(
    "Circle", //classname...
    
    Shape, //superclass: Circle inherits from Shape...

    //props hash...
    {
      //default value for radius...
      radius: 0,
      
      //the property named "constructor" is used to initialize new instances...
      constructor: function(radius) {
        this.radius= radius || this.radius;
      },
      
      //these go in the prototype for Circle...
      setRadius: function(radius) {    
        this.radius= radius;
      },
      
      area: function() {
        return Math.PI * this.radius * this.radius;
      }
    }
  );
    
  dojo.declare(
    "Rectangle", //classname...
    Shape, //superclass: Rectangle inherits from Shape...
 
    //props hash...
    {
      //default values for l, w...
      length: 0,
      width: 0,
      
      constructor: function(l, w) {
        this.length= l || this.length;
        this.width= w || this.width;
      },

      //these go in the prototype for Rectangle...
      setLength: function(l) {
        this.length= l;
      },
      
      setWidth: function(w) {
        this.width= w;
      },
      
      area: function() {
        return this.length * this.width;
      }
    }
  );
  
  //create a Circle and exercise it...
  var c= new Circle(5);
  var test= c.area();
  
  //Circles are also shapes...
  c.setColor(0x0000FF);      
  
  console.log("examples[5] -->")  
  console.log("c: ", c, ", test: ", test);
  console.log("<-- examples[5]")
}

function() {
  
  //creating a new circle...
  var c= new Circle(5);
  
  //...results in the Circle constructor executing the following...
  Shape.apply(this, arguments);
  Circle._constructor.apply(this, arguments);
  
}

examples[6]= function(){
  ensureShapeIsDefined();
    
  
  dojo.declare(
    "Circle",
    Shape,
    {
      //default value for radius...
      radius: 0,
      
      //the property named "constructor" is used to initialize new instances...
      constructor: function(radius) {
        this.radius= radius || this.radius;
      },
      
      setRadius: function(radius) {    
        this.radius= radius;
      },
      
      area: function() {
        return Math.PI * this.radius * this.radius;
      },
      
      setColor: function (color) {
        var total=
          ((color & 0xFF0000) >> 16) +
          ((color & 0x00FF00) >> 8) +
          (color & 0x00FF);
        if (total>350) {
          this.inherited(arguments);
        }
      }
    }
  );
  
  //exercise the new functionality...
  var c= new Circle();
  c.setColor(0x010203);  //should result in no-op
  var test1= c.color;    //yup, test1 is 0
  c.setColor(0x808080);  //should set the color
  var test2= c.color;   //test2 is 0x808080 
  
  console.log("examples[6] -->")  
  console.log("c: ", c, ", test1: ", test1, ", test2: ", test2);
  console.log("<-- examples[6]")
  
  
  Shape.prototype.setBorderStyle= function(style) {
    this.borderStyle= style;
  };
  
  
  dojo.extend(Shape, {
    setBorderStyle: function(style) {
      this.borderStyle= style;
    }
  });
  
  
  Shape.extend({
    setBorderStyle: function(style) {
      this.borderStyle= style;
    }
  });
  
}

examples[7]= function(){
  examples[5]();
  
  
  dojo.declare(
    "Position",
    null,
    {
      x: 0,
      y: 0,
      
      constructor: function(x, y){
        this.x= x || this.x;
        this.y= y || this.y;
      },
      
      setPosition: function (x, y) {    
        this.x= x;
        this.y= y;
      },
      
      move: function (deltaX, deltaY) {
        this.x+= deltaX;
        this.y+= deltaY;
      }
    }
  );
  
  
  
  dojo.declare(
    "PositionedCircle",
    
    //inherits from Circle and mixes in Position
    [Circle, Position],

    {
      constructor: function(radius, x, y){
        this.setPosition(x, y);
      }
    }
  );
  
  
  var pc= new PositionedCircle(5, 1, 2);
  
  console.log("examples[7] -->")  
  console.log("pc: ", pc);

  
  function(){
    
    //creating a new PositionedCircle...
    var pc = new PositionedCircle(5, 1, 2);
    
    //...results in the function PositionedCircle executing the following...
    Circle.apply(this, arguments);
    //...which results in...
    Shape.apply(this, arguments);
    
    //...then the mixin constructor is executed...
    Position.apply(this, arguments);
    
    //...finally the init function is executed...
    PositionedCircle._constructor.apply(this, arguments);
    
  }
  
  
  var pc= new PositionedCircle(5, 1, 2);
  
  //try the Shape functionality...
  var color1= pc.color;  //color1 is black
  pc.setColor(0x0000FF);
  var color2= pc.color;  //color2 is now red
  
  //try the Circle functionality...
  var radius1= pc.radius; //radius1 is 5
  var area1= pc.area();   //area1 is 78.54
  pc.setRadius(10);
  var radius2= pc.radius; //radius2 is 10
  var area2= pc.area();   //area2 is 314.16
  
  //try the Position functionality...
  var position1= [pc.x, pc.y]; //position1 is [1, 2];
  pc.move(3, 5);
  var position2= [pc.x, pc.y]; //position2 is [4, 7];
  
  
  console.log("color1: ", color1);
  console.log("color2: ", color2);
  console.log("radius1: ", radius1);
  console.log("area1: ", area1);
  console.log("radius2: ", radius2);
  console.log("area2: ", area2);
  console.log("position1: ", position1);
  console.log("position2: ", position2);
  
  
  var pc= new PositionedCircle(5, 1, 2);
  
  var test;
  test= pc instanceof PositionedCircle; //test is true
  test= pc instanceof Circle;           //test is true
  test= pc instanceof Shape;            //test is true
  test= pc instanceof Object;           //test is true
  test= pc instanceof Position;         //test is false!
  
  
  console.log("pc instanceof PositionedCircle => ", pc instanceof PositionedCircle);
  console.log("pc instanceof Circle => ", pc instanceof Circle);
  console.log("pc instanceof Shape => ", pc instanceof Shape);
  console.log("pc instanceof Object => ", pc instanceof Object);
  console.log("pc instanceof Position => ", pc instanceof Position);
  
  
  //radius=5, x=1, y=2
  var pc= new PositionedCircle(5, 1, 2);
  
  
  function(){
    
    //writing...
    var pc = new PositionedCircle(5, 1, 2);
    
    //results in the following being executed...
    Circle.apply(this, [5, 1, 2]);
    //call Circle's superclass...
    Shape.apply(this, [5, 1, 2]);
    //call PositionedCircle's mixin...
    Position.apply(this, [5, 1, 2]);
        
    //call PositionedCircle's initializer--if there is one...
    if (PositionedCircle.prototype._constructor) {
      PositionedCircle.prototype._constructor.apply(this, [5, 1, 2]);
    }
    
    
    
    function(radius, x, y){
      setPosition(x, y);
    }
    
    
    
    //writing...
    var o = new PositionedCircle(radius, x, y);
    
    //results in calling the superclass and mixin constructors like this...
    var superArgs = PositionedCircle.prototype.preamble.apply(this, [radius, x, y]);
    PositionedCircle.prototype.superclass.apply(this, superArgs);
    PositionedCircle.prototype.mixin.apply(this, superArgs);
    
  }

  
  dojo.declare("PositionedCircleShim", Position,
    {
      preamble: function(radius, x, y){
        return [x || null, y || null];
      }
    }
  );
  
  
  console.log("new PositionedCircle(5, 1, 2) (with shim): ", new PositionedCircle(5, 1, 2));  
  
  
  dojo.declare(
    "PositionedCircle", 
    [Circle, PositionedCircleShim],
    {}
  );
  
  
  function(){
    
    //creating a new PositionedCircle...
    var pc = new PositionedCircle(5, 1, 2);
    //...results in the function PositionedCircle executing the following...
    
    //call the single inheritance chain...
    //the superclass of PositionedCircle...
    Circle.apply(this, [5, 1, 2]);
      //which calls Shape, the superclass of Circle...
      Shape.apply(this, [5, 1, 2]);

    //call the mixin class...
    PositionedCircleShim.apply(this, [5, 1, 2]);
      //...which results in executing...
      Position.apply(this, 
        PositionedCircleShim.prototype.preamble.apply(this, [5, 1, 2]));
      //...which reduces to Position.apply(this, [1, 2]);

    //lastly, call PositionedCircle's initializer--if there is one...
    if (PositionedCircle.prototype._constructor) {
      PositionedCircle.prototype._constructor.apply(this, [5, 1, 2]);
    }
    
   
    
    var shape = new PositionedCircle({
      x: 1,
      y: 2,
      radius: 5
    });
    
    
    constructor: function(args){
      //args is a hash of initial property values
      dojo.mixin(this, args);
    }
    
  }
  console.log("<-- examples[7]")    
}

examples[8]= function(){
  console.log("examples[8] -->")    
  
  dojo.declare(
    "Shape",
    null,
    {
      color: 0,

      set: function(color){
        this.color= color; 
      }
    }
  );
  
  dojo.declare(
    "Circle",
    Shape,
    {
      //default value for radius...
      radius: 0,
      
      //the property named "constructor" is used to initialize new instances...
      constructor: function(radius) {
        this.radius= radius || this.radius;
      },
      
      //these go in the prototype for Circle...
      set: function(radius) {    
        this.radius= radius;
      },
      
      area: function() {
        return Math.PI * this.radius * this.radius;
      }
    }
  );
  
  dojo.declare(
    "Position",
    null,
    {
      x: 0,
      y: 0,
      
      constructor: function(x, y){
        this.x= x || this.x;
        this.y= y || this.y;
      },
      
      set: function (x, y) {    
        this.x= x;
        this.y= y;
      },
      
      move: function (deltaX, deltaY) {
        this.x+= deltaX;
        this.y+= deltaY;
      }
    }
  );
  
  dojo.declare("PositionedCircleShim", Position,
    {
      preamble: function(radius, x, y){
        return [x || null, y || null];
      }
    }
  );  
  
  dojo.declare(
    "PositionedCircle",
    [Circle, PositionedCircleShim],
    {}
  );    
       
  
  //assume that Shape, Circle, and Position all define 
  //"set" rather than "set(Color|Radius|Position)"...
  var pc = new PositionedCircle(); //radius=0, x=0, y=0
  pc.set(5); //oops! calls Position.Set instead of Circle.Set...
  var test;
  test = pc.radius; //radius is still 0, but...
  test = pc.x; //x was set to 5
  //it can be done...painfully...
  Circle.prototype.set.apply(pc, [5]);
  //but at least it worked; test is 5
  test = pc.radius;
  
  
  var pc = new PositionedCircle(); //radius=0, x=0, y=0
  console.log("pc: ", pc);
  pc.set(5); //oops! calls Position.Set instead of Circle.Set...
  console.log("pc: ", pc);
  Circle.prototype.set.apply(pc, [5]);
  //but at least it worked; test is 5
  console.log("pc: ", pc);

  
  
  dojo.declare(
    "PositionedCircle",
    [Circle, PositionedCircleShim],
    {}
  );
  PositionedCircle.extend({
    setPosition: Position.prototype.set
  });
  delete PositionedCircle.superclass.set;
  
  
  
  var pc= new PositionedCircle(5, 1, 2); //radius=5, x=1, y=2
  pc.setPosition(3, 4); //call Position.Set...
  pc.set(6); //call Circle.Set...
  
  
  var pc = new PositionedCircle(5, 1, 2)
  console.log("pc: ", pc);
  pc.setPosition(3, 4); //call Position.Set...
  pc.set(6); //call Circle.Set...
  console.log("pc: ", pc);
  
  console.log("<-- examples[8]")    
}

examples[9]= function(){
  
  dojo.declare("Base", null, {
    constructor: function() {
      //initialize the instance as required...
      
      //now that the instance is initialized, call
      doSomething(this);
    }
  });
  
  
  
  dojo.declare("Base", null, {
    constructor: function() {
      this.args = {base_args: dojo._toArray(arguments)};
      console.log(dojo.toJson(this.args, true));
    }
  });
  var x= new Base(1, 2, 3);
  
  
  
  dojo.declare("Subclass", Base, {
    constructor: function() {
      this.args.subclass_args= dojo._toArray(arguments);
    },
    preamble: function(args) {
      //the superclass (Base) only gets the first three arguments...
      return dojo._toArray(arguments).slice(0, 3);
    }
  });
  var x= new Subclass(1, 2, 3, 4, 5, 6);
  
  
  
  dojo.declare("Base", null, {
    constructor: function() {
      this.args = {base_args: dojo._toArray(arguments)};
    }, 
    postscript: function(){
      console.log(dojo.toJson(this.args, true));
    }
  });
  
  
  
  dojo.declare("Subclass", Base, {
    constructor: function() {
      this.args.subclass_args= dojo._toArray(arguments);
    },
    preamble: function(args) {
      //the superclass (Base) only gets the first three arguments...
      return dojo._toArray(arguments).slice(0, 3);
    },
    postscript: function(){
      console.log("In Subclass's postscript.");
      this.inherited(arguments);
    }
  })
  
  var x= new Subclass(1, 2, 3, 4, 5, 6);
}
function(){
  
  //create an object with some properties
  var base= {
    greet: function(){
      return "hello, my name is " + this.name;}
  }
  var newObject= dojo.delegate(base, {name: "John"});
  
}

function(){
  
  var x= new MyClass({
    thisProperty: 1, 
    thatProperty:2, 
    theOtherProperty:3
  });
  
  
  
  function makeMyClass(thisProperty, thatProperty, theOtherProperty){
    return new MyClass({
      thisProperty: thisProperty, 
      thatProperty: thatProperty, 
      theOtherProperty: theOtherProperty
    }); 
  } 
  
}
})();

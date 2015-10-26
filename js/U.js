// Underscore.js
// (c) 2009 Jeremy Ashkenas, DocumentCloud Inc.
// Underscore is freely distributable under the terms of the MIT license.
// Portions of Underscore are inspired by or borrowed from Prototype.js,
// Oliver Steele's Functional, and John Resig's Micro-Templating.
// For all details and documentation:
// http://documentcloud.github.com/underscore/

(function() {

  /*------------------------- Baseline setup ---------------------------------*/

  // Establish the root object, "window" in the browser, or "global" on the server.
  var root = this;

  // Save the previous value of the "U" variable.
  var previousU = root.U;

  // Create a safe reference to the Underscore object for the functions below.
  var U = root.U = {};

  // Export the Underscore object for CommonJS.
  if (typeof exports !== 'undefined') U = exports;

  // Current version.
  U.VERSION = '0.3';

  /*------------------------ Collection Functions: ---------------------------*/

  // The cornerstone, an each implementation.
  // Handles objects implementing forEach, each, arrays, and raw objects.
  U.each = function(obj, iterator, context) {
    var index = 0;
    try {
      if (obj.forEach) {
        obj.forEach(iterator, context);
      } else if (obj.length) {
        for (var i=0, l = obj.length; i<l; i++) iterator.call(context, obj[i], i, obj);
      } else if (obj.each) {
        obj.each(function(value) { iterator.call(context, value, index++, obj); });
      } else {
        for (var key in obj) if (Object.prototype.hasOwnProperty.call(obj, key)) {
          iterator.call(context, obj[key], key, obj);
        }
      }
    } catch(e) {
      if (e != 'UUbreakUU') throw e;
    }
    return obj;
  };

  // Return the results of applying the iterator to each element. Use JavaScript
  // 1.6's version of map, if possible.
  U.map = function(obj, iterator, context) {
    if (obj && obj.map) return obj.map(iterator, context);
    var results = [];
    U.each(obj, function(value, index, list) {
      results.push(iterator.call(context, value, index, list));
    });
    return results;
  };

  // Reduce builds up a single result from a list of values. Also known as
  // inject, or foldl. Uses JavaScript 1.8's version of reduce, if possible.
  U.reduce = function(obj, memo, iterator, context) {
    if (obj && obj.reduce) return obj.reduce(U.bind(iterator, context), memo);
    U.each(obj, function(value, index, list) {
      memo = iterator.call(context, memo, value, index, list);
    });
    return memo;
  };

  // The right-associative version of reduce, also known as foldr. Uses
  // JavaScript 1.8's version of reduceRight, if available.
  U.reduceRight = function(obj, memo, iterator, context) {
    if (obj && obj.reduceRight) return obj.reduceRight(U.bind(iterator, context), memo);
    var reversed = U.clone(U.toArray(obj)).reverse();
    U.each(reversed, function(value, index) {
      memo = iterator.call(context, memo, value, index, obj);
    });
    return memo;
  };

  // Return the first value which passes a truth test.
  U.detect = function(obj, iterator, context) {
    var result;
    U.each(obj, function(value, index, list) {
      if (iterator.call(context, value, index, list)) {
        result = value;
        throw 'UUbreakUU';
      }
    });
    return result;
  };

  // Return all the elements that pass a truth test. Use JavaScript 1.6's
  // filter(), if it exists.
  U.select = function(obj, iterator, context) {
    if (obj.filter) return obj.filter(iterator, context);
    var results = [];
    U.each(obj, function(value, index, list) {
      iterator.call(context, value, index, list) && results.push(value);
    });
    return results;
  };

  // Return all the elements for which a truth test fails.
  U.reject = function(obj, iterator, context) {
    var results = [];
    U.each(obj, function(value, index, list) {
      !iterator.call(context, value, index, list) && results.push(value);
    });
    return results;
  };

  // Determine whether all of the elements match a truth test. Delegate to
  // JavaScript 1.6's every(), if it is present.
  U.all = function(obj, iterator, context) {
    iterator = iterator || U.identity;
    if (obj.every) return obj.every(iterator, context);
    var result = true;
    U.each(obj, function(value, index, list) {
      if (!(result = result && iterator.call(context, value, index, list))) throw 'UUbreakUU';
    });
    return result;
  };

  // Determine if at least one element in the object matches a truth test. Use
  // JavaScript 1.6's some(), if it exists.
  U.any = function(obj, iterator, context) {
    iterator = iterator || U.identity;
    if (obj.some) return obj.some(iterator, context);
    var result = false;
    U.each(obj, function(value, index, list) {
      if (result = iterator.call(context, value, index, list)) throw 'UUbreakUU';
    });
    return result;
  };

  // Determine if a given value is included in the array or object,
  // based on '==='.
  U.include = function(obj, target) {
    if (U.isArray(obj)) return U.indexOf(obj, target) != -1;
    var found = false;
    U.each(obj, function(value) {
      if (found = value === target) {
        throw 'UUbreakUU';
      }
    });
    return found;
  };

  // Invoke a method with arguments on every item in a collection.
  U.invoke = function(obj, method) {
    var args = U.toArray(arguments).slice(2);
    return U.map(obj, function(value) {
      return (method ? value[method] : value).apply(value, args);
    });
  };

  // Convenience version of a common use case of map: fetching a property.
  U.pluck = function(obj, key) {
    return U.map(obj, function(value){ return value[key]; });
  };

  // Return the maximum item or (item-based computation).
  U.max = function(obj, iterator, context) {
    if (!iterator && U.isArray(obj)) return Math.max.apply(Math, obj);
    var result = {computed : -Infinity};
    U.each(obj, function(value, index, list) {
      var computed = iterator ? iterator.call(context, value, index, list) : value;
      computed >= result.computed && (result = {value : value, computed : computed});
    });
    return result.value;
  };

  // Return the minimum element (or element-based computation).
  U.min = function(obj, iterator, context) {
    if (!iterator && U.isArray(obj)) return Math.min.apply(Math, obj);
    var result = {computed : Infinity};
    U.each(obj, function(value, index, list) {
      var computed = iterator ? iterator.call(context, value, index, list) : value;
      computed < result.computed && (result = {value : value, computed : computed});
    });
    return result.value;
  };

  // Sort the object's values by a criteria produced by an iterator.
  U.sortBy = function(obj, iterator, context) {
    return U.pluck(U.map(obj, function(value, index, list) {
      return {
        value : value,
        criteria : iterator.call(context, value, index, list)
      };
    }).sort(function(left, right) {
      var a = left.criteria, b = right.criteria;
      return a < b ? -1 : a > b ? 1 : 0;
    }), 'value');
  };

  // Use a comparator function to figure out at what index an object should
  // be inserted so as to maintain order. Uses binary search.
  U.sortedIndex = function(array, obj, iterator) {
    iterator = iterator || U.identity;
    var low = 0, high = array.length;
    while (low < high) {
      var mid = (low + high) >> 1;
      iterator(array[mid]) < iterator(obj) ? low = mid + 1 : high = mid;
    }
    return low;
  };

  // Convert anything iterable into a real, live array.
  U.toArray = function(iterable) {
    if (!iterable) return [];
    if (U.isArray(iterable)) return iterable;
    return U.map(iterable, function(val){ return val; });
  };

  // Return the number of elements in an object.
  U.size = function(obj) {
    return U.toArray(obj).length;
  };

  /*-------------------------- Array Functions: ------------------------------*/

  // Get the first element of an array.
  U.first = function(array) {
    return array[0];
  };

  // Get the last element of an array.
  U.last = function(array) {
    return array[array.length - 1];
  };

  // Trim out all falsy values from an array.
  U.compact = function(array) {
    return U.select(array, function(value){ return !!value; });
  };

  // Return a completely flattened version of an array.
  U.flatten = function(array) {
    return U.reduce(array, [], function(memo, value) {
      if (U.isArray(value)) return memo.concat(U.flatten(value));
      memo.push(value);
      return memo;
    });
  };

  // Return a version of the array that does not contain the specified value(s).
  U.without = function(array) {
    var values = array.slice.call(arguments, 0);
    return U.select(array, function(value){ return !U.include(values, value); });
  };

  // Produce a duplicate-free version of the array. If the array has already
  // been sorted, you have the option of using a faster algorithm.
  U.uniq = function(array, isSorted) {
    return U.reduce(array, [], function(memo, el, i) {
      if (0 == i || (isSorted ? U.last(memo) != el : !U.include(memo, el))) memo.push(el);
      return memo;
    });
  };

  // Produce an array that contains every item shared between all the
  // passed-in arrays.
  U.intersect = function(array) {
    var rest = U.toArray(arguments).slice(1);
    return U.select(U.uniq(array), function(item) {
      return U.all(rest, function(other) {
        return U.indexOf(other, item) >= 0;
      });
    });
  };

  // Zip together multiple lists into a single array -- elements that share
  // an index go together.
  U.zip = function() {
    var args = U.toArray(arguments);
    var length = U.max(U.pluck(args, 'length'));
    var results = new Array(length);
    for (var i=0; i<length; i++) results[i] = U.pluck(args, String(i));
    return results;
  };

  // If the browser doesn't supply us with indexOf (I'm looking at you, MSIE),
  // we need this function. Return the position of the first occurence of an
  // item in an array, or -1 if the item is not included in the array.
  U.indexOf = function(array, item) {
    if (array.indexOf) return array.indexOf(item);
    for (i=0, l=array.length; i<l; i++) if (array[i] === item) return i;
    return -1;
  };

  // Provide JavaScript 1.6's lastIndexOf, delegating to the native function,
  // if possible.
  U.lastIndexOf = function(array, item) {
    if (array.lastIndexOf) return array.lastIndexOf(item);
    var i = array.length;
    while (i--) if (array[i] === item) return i;
    return -1;
  };

  /* ----------------------- Function Functions: -----------------------------*/

  // Create a function bound to a given object (assigning 'this', and arguments,
  // optionally). Binding with arguments is also known as 'curry'.
  U.bind = function(func, context) {
    if (!context) return func;
    var args = U.toArray(arguments).slice(2);
    return function() {
      var a = args.concat(U.toArray(arguments));
      return func.apply(context, a);
    };
  };

  // Bind all of an object's methods to that object. Useful for ensuring that
  // all callbacks defined on an object belong to it.
  U.bindAll = function() {
    var args = U.toArray(arguments);
    var context = args.pop();
    U.each(args, function(methodName) {
      context[methodName] = U.bind(context[methodName], context);
    });
  };

  // Delays a function for the given number of milliseconds, and then calls
  // it with the arguments supplied.
  U.delay = function(func, wait) {
    var args = U.toArray(arguments).slice(2);
    return setTimeout(function(){ return func.apply(func, args); }, wait);
  };

  // Defers a function, scheduling it to run after the current call stack has
  // cleared.
  U.defer = function(func) {
    return U.delay.apply(U, [func, 1].concat(U.toArray(arguments).slice(1)));
  };

  // Returns the first function passed as an argument to the second,
  // allowing you to adjust arguments, run code before and after, and
  // conditionally execute the original function.
  U.wrap = function(func, wrapper) {
    return function() {
      var args = [func].concat(U.toArray(arguments));
      return wrapper.apply(wrapper, args);
    };
  };

  // Returns a function that is the composition of a list of functions, each
  // consuming the return value of the function that follows.
  U.compose = function() {
    var funcs = U.toArray(arguments);
    return function() {
      for (var i=funcs.length-1; i >= 0; i--) {
        arguments = [funcs[i].apply(this, arguments)];
      }
      return arguments[0];
    };
  };

  /* ------------------------- Object Functions: ---------------------------- */

  // Retrieve the names of an object's properties.
  U.keys = function(obj) {
    return U.map(obj, function(value, key){ return key; });
  };

  // Retrieve the values of an object's properties.
  U.values = function(obj) {
    return U.map(obj, U.identity);
  };

  // Extend a given object with all of the properties in a source object.
  U.extend = function(destination, source) {
    for (var property in source) destination[property] = source[property];
    return destination;
  };

  // Create a (shallow-cloned) duplicate of an object.
  U.clone = function(obj) {
    if (U.isArray(obj)) return obj.slice(0);
    return U.extend({}, obj);
  };

  // Perform a deep comparison to check if two objects are equal.
  U.isEqual = function(a, b) {
    // Check object identity.
    if (a === b) return true;
    // Different types?
    var atype = typeof(a), btype = typeof(b);
    if (atype != btype) return false;
    // Basic equality test (watch out for coercions).
    if (a == b) return true;
    // One of them implements an isEqual()?
    if (a.isEqual) return a.isEqual(b);
    // If a is not an object by this point, we can't handle it.
    if (atype !== 'object') return false;
    // Nothing else worked, deep compare the contents.
    var aKeys = U.keys(a), bKeys = U.keys(b);
    // Different object sizes?
    if (aKeys.length != bKeys.length) return false;
    // Recursive comparison of contents.
    for (var key in a) if (!U.isEqual(a[key], b[key])) return false;
    return true;
  };

  // Is a given value a DOM element?
  U.isElement = function(obj) {
    return !!(obj && obj.nodeType == 1);
  };

  // Is a given value a real Array?
  U.isArray = function(obj) {
    return Object.prototype.toString.call(obj) == '[object Array]';
  };

  // Is a given value a Function?
  U.isFunction = function(obj) {
    return Object.prototype.toString.call(obj) == '[object Function]';
  };

  // Is a given variable undefined?
  U.isUndefined = function(obj) {
    return typeof obj == 'undefined';
  };

  /* -------------------------- Utility Functions: -------------------------- */

  // Run Underscore.js in noConflict mode, returning the 'U' variable to its
  // previous owner. Returns a reference to the Underscore object.
  U.noConflict = function() {
    root.U = previousUnderscore;
    return this;
  };

  // Keep the identity function around for default iterators.
  U.identity = function(value) {
    return value;
  };

  // Generate a unique integer id (unique within the entire client session).
  // Useful for temporary DOM ids.
  U.uniqueId = function(prefix) {
    var id = this.UidCounter = (this.UidCounter || 0) + 1;
    return prefix ? prefix + id : id;
  };

  // JavaScript templating a-la ERB, pilfered from John Resig's
  // "Secrets of the JavaScript Ninja", page 83.
  U.template = function(str, data) {
    var fn = new Function('obj',
      'var p=[],print=function(){p.push.apply(p,arguments);};' +
      'with(obj){p.push(\'' +
      str
        .replace(/[\r\t\n]/g, " ")
        .split("<%").join("\t")
        .replace(/((^|%>)[^\t]*)'/g, "$1\r")
        .replace(/\t=(.*?)%>/g, "',$1,'")
        .split("\t").join("');")
        .split("%>").join("p.push('")
        .split("\r").join("\\'")
    + "');}return p.join('');");
    return data ? fn(data) : fn;
  };
  //Yiannis Additions
  U.boxString=function (str) {
  var a = [];
  var i = 0;
  var s = '';
  var n = str.length;
  function wrap() {
    var div = '<' + 'div' + ' class="cell" >';
    var span = '<' + 'span' + '>';
    var divend = '<' + '/div' + '>';
    var spanend = '<' + '/span' + '>';
    var z = div + span + str[i] + spanend + divend;
    return z;
  }

  while (i < n) {
    a[i] = wrap(i);
    s += wrap(i);
    i++;
  }
  s = s + '<div style="clear:both"></div>';
  return s;
}
// pad a string left or right
// to do options object
U.padString =function (pos, str, orientation) {
  var t1 = '';
  var z = '';
  for (var i = 0; i < pos; i++) {
    t1 = t1 + ' '; // empty string
  }
  z = t1 + str;
  return z;
}



U.showSymbol= function (symbol, position, length) {
  var t = function () {
    var t1 = '';
    for (var i = 0; i < length; i++) {
      t1 = t1 + ' '; // empty string
    }
    return t1;
  }

  var t3 = symbolAtPosition(symbol, position, t());
  var t4 = U.boxString(t3);

  $that.siblings('.msg').append(t4).show('slow');
}


// Character Routines
// insert string at position
// todo checks
U.insertChar= function (sub, position, str) {
  var s = str.slice(0, position);
  var s1 = str.slice(position, str.length);
  return (s + sub + s1);
}

// delete string at position
// using slice we cut string in half
// todo checks
U.deleteChar=function(position, str) {
  //if (position == str.length + 1) return -1;
  var s = str.slice(0, position);
  var s1 = str.slice(position + 1, str.length);
  return (s + s1);
}

U.replaceChar=function(chr,position, str){
  var s=U.deleteChar(position,str);
  return s=U.insertChar(chr,position, s);

}
// delete string at position
// using slice we cut string in half
// TODO checks
U.swapChar=function(position, str) {
  var c0=str.charAt(position);
  var c1=str.charAt(position+1);
      var c2 = U.deleteChar(position,str);
      str = U.deleteChar(position,c2);
      str = U.insertChar(c1,position,str);
      str = U.insertChar(c0,position+1,str);

  return str;
}

/*
 *   Tic-tac-toe game related
 */

// utility to draw a table using
// divs
U.divTable = function (rows, columns) {
  var s = '';
  var id=0;
  // draw one div
  function wrap(n, n1, counter) {
    var div = '<' + 'div' + ' class="cell" rel="'+counter+'" id="cell-'+counter+'" >';
    var divend = '<' + '/div' + '>';
    var span = '<' + 'span' + '>';
    var spanend = '<' + '/span' + '>';
    var z = div +  divend;
    return z;
  }

  // loop through rows and columns
  for (var i = 0; i < rows; i++) {
    for (var j = 0; j < columns; j++) {
     
      s = s + wrap(i, j, id);
       id++;
    }
    s = s + '<' + 'div style="clear:both"' + '> ';
  }
  return s;
}

$.fn.showProperties=function(obj){
  var s='<div style="white-space:pre;background-image:none;font-size:12px;\n\
         border:1px solid #ececec;padding:15px" class="ui-corner-all">';
  for (var prop in obj){
      if (obj.hasOwnProperty(prop)){
     s+= '<strong>'+prop+ '</strong> : ' + obj[prop]+'\n';
     }
  }
  s=s+'</div>';
  $(this).html(s);
  return s;
}

U.properties = function (obj){
  var s ='';
  for (var prop in obj){
      if (obj.hasOwnProperty(prop)){
     s+= '<strong>'+prop+ '</strong> : ' + obj[prop]+'\n';
     }
  }
  logPRE(s);
}

U.scriptsLoaded=function () {
        var scripts = document.getElementsByTagName('script');
        var count = 0;
        for (var i = 0, n = scripts.length; i < n; i++) {
            if (scripts[i].src) {
                count++;
            }
        }
        log('number of scripts loaded', count);
    };
   

U.string={};





//alias

$.fn.properties=$.fn.showProperties;
  /*------------------------------- Aliases ----------------------------------*/

  U.forEach  = U.each;
  U.foldl    = U.inject       = U.reduce;
  U.foldr    = U.reduceRight;
  U.filter   = U.select;
  U.every    = U.all;
  U.some     = U.any;
  U.unique   = U.uniq;
  U.get      = U.pluck;
  U.properties = U.properties;

})();




var $D = function circle(radius, steps, centerX, centerY, options) {

  var defaults = {
    fillStyle: '#dd0000',
                steps:40,
                radius:10,
                X0:30,
                Y0:30};

  var settings =$.extend(options,defaults);
  settings.fillStyle = '#dd0000 ';
  log(settings.fillStyle);
  var xValues = [centerX];
  var yValues = [centerY];

  var ctx = $("#canvas")[0].getContext("2d");

  ctx.fillStyle = settings.fillStyle;

  ctx.beginPath();
  for (var i = 0; i <= steps; i++) {
    var radian = (2 * Math.PI) * (i / steps);
    xValues[i + 1] = centerX + radius * Math.cos(radian);
    yValues[i + 1] = centerY + radius * Math.sin(radian);
    if (0 == i) {
      ctx.moveTo(xValues[i + 1], yValues[i + 1]);
    } else {
      ctx.lineTo(xValues[i + 1], yValues[i + 1]);
    }
    log(i, xValues[i + 1].toFixed(2), yValues[i + 1].toFixed(2));
  }
  ctx.fill();
}










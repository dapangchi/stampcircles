// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

// Copyright 2006 lib Inc. All Rights Reserved.

/**
 * @fileoverview Bootstrap for the Google JS Library (Closure).
 *
 * In uncompiled mode base.js will write out Closure's deps file, unless the
 * global <code>CLOSURE_NO_DEPS</code> is set to true.  This allows projects to
 * include their own deps file(s) from different locations.
 *
 */

/**
 * @define {boolean} Overridden to true by the compiler when --closure_pass
 *     or --mark_as_compiled is specified.
 *     FORK BY YL AS standard library
 *
 */
var COMPILED = false;


/**
 * Base namespace for the Closure library.  Checks to see lib is
 * already defined in the current scope before assigning to prevent
 * clobbering if base.js is loaded more than once.
 */
var lib = lib || {}; // Check to see if already defined in current scope


/**
 * Reference to the global context.  In most cases this will be 'window'.
 */
lib.global = this;


/**
 * @define {boolean} DEBUG is provided as a convenience so that debugging code
 * that should not be included in a production js_binary can be easily stripped
 * by specifying --define lib.DEBUG=false to the JSCompiler. For example, most
 * toString() methods should be declared inside an "if (lib.DEBUG)" conditional
 * because they are generally used for debugging purposes and it is difficult
 * for the JSCompiler to statically determine whether they are used.
 */
lib.DEBUG = true;


/**
 * @define {string} LOCALE defines the locale being used for compilation. It is
 * used to select locale specific data to be compiled in js binary. BUILD rule
 * can specify this value by "--define lib.LOCALE=<locale_name>" as JSCompiler
 * option.
 *
 * Take into account that the locale code format is important. You should use
 * the canonical Unicode format with hyphen as a delimiter. Language must be
 * lowercase, Language Script - Capitalized, Region - UPPERCASE.
 * There are few examples: pt-BR, en, en-US, sr-Latin-BO, zh-Hans-CN.
 *
 * See more info about locale codes here:
 * http://www.unicode.org/reports/tr35/#Unicode_Language_and_Locale_Identifiers
 *
 * For language codes you should use values defined by ISO 693-1. See it here
 * http://www.w3.org/WAI/ER/IG/ert/iso639.htm. There is only one exception from
 * this rule: the Hebrew language. For legacy reasons the old code (iw) should
 * be used instead of the new code (he), see http://wiki/Main/IIISynonyms.
 */
lib.LOCALE = 'en';  // default to en


/**
 * Indicates whether or not we can call 'eval' directly to eval code in the
 * global scope. Set to a Boolean by the first call to lib.globalEval (which
 * empirically tests whether eval works for globals). @see lib.globalEval
 * @type {boolean?}
 * @private
 */
lib.evalWorksForGlobals_ = null;


/**
 * Creates object stubs for a namespace. When present in a file, lib.provide
 * also indicates that the file defines the indicated object. Calls to
 * lib.provide are resolved by the compiler if --closure_pass is set.
 * @param {string} name name of the object that this file defines.
 */
lib.provide = function(name) {
  if (!COMPILED) {
    // Ensure that the same namespace isn't provided twice. This is intended
    // to teach new developers that 'lib.provide' is effectively a variable
    // declaration. And when JSCompiler transforms lib.provide into a real
    // variable declaration, the compiled JS should work the same as the raw
    // JS--even when the raw JS uses lib.provide incorrectly.
    if (lib.getObjectByName(name) && !lib.implicitNamespaces_[name]) {
      throw Error('Namespace "' + name + '" already declared.');
    }

    var namespace = name;
    while ((namespace = namespace.substring(0, namespace.lastIndexOf('.')))) {
      lib.implicitNamespaces_[namespace] = true;
    }
  }

  lib.exportPath_(name);
};


if (!COMPILED) {
  /**
   * Namespaces implicitly defined by lib.provide. For example,
   * lib.provide('lib.events.Event') implicitly declares
   * that 'lib' and 'lib.events' must be namespaces.
   *
   * @type {Object}
   * @private
   */
  lib.implicitNamespaces_ = {};
}


/**
 * Builds an object structure for the provided namespace path,
 * ensuring that names that already exist are not overwritten. For
 * example:
 * "a.b.c" -> a = {};a.b={};a.b.c={};
 * Used by lib.provide and lib.exportSymbol.
 * @param {string} name name of the object that this file defines.
 * @param {Object} opt_object the object to expose at the end of the path.
 * @param {Object} opt_objectToExportTo The object to add the path to; default
 *     is |lib.global|.
 * @private
 */
lib.exportPath_ = function(name, opt_object, opt_objectToExportTo) {
  var parts = name.split('.');
  var cur = opt_objectToExportTo || lib.global;

  // Internet Explorer exhibits strange behavior when throwing errors from
  // methods externed in this manner.  See the testExportSymbolExceptions in
  // base_test.html for an example.
  if (!(parts[0] in cur) && cur.execScript) {
    cur.execScript('var ' + parts[0]);
  }

  // Certain browsers cannot parse code in the form for((a in b); c;);
  // This pattern is produced by the JSCompiler when it collapses the
  // statement above into the conditional loop below. To prevent this from
  // happening, use a for-loop and reserve the init logic as below.

  // Parentheses added to eliminate strict JS warning in Firefox.
  for (var part; parts.length && (part = parts.shift());) {
    if (!parts.length && lib.isDef(opt_object)) {
      // last part and we have an object; use it
      cur[part] = opt_object;
    } else if (cur[part]) {
      cur = cur[part];
    } else {
      cur = cur[part] = {};
    }
  }
};


/**
 * Returns an object based on its fully qualified external name.  If you are
 * using a compilation pass that renames property names beware that using this
 * function will not find renamed properties.
 *
 * @param {string} name The fully qualified name.
 * @param {Object} opt_obj The object within which to look; default is
 *     |lib.global|.
 * @return {Object?} The object or, if not found, null.
 */
lib.getObjectByName = function(name, opt_obj) {
  var parts = name.split('.');
  var cur = opt_obj || lib.global;
  for (var part; part = parts.shift(); ) {
    if (cur[part]) {
      cur = cur[part];
    } else {
      return null;
    }
  }
  return cur;
};


/**
 * Globalizes a whole namespace, such as lib or lib.lang.
 *
 * @param {Object} obj The namespace to globalize.
 * @param {Object} opt_global The object to add the properties to.
 * @deprecated Properties may be explicitly exported to the global scope, but
 *     this should no longer be done in bulk.
 */
lib.globalize = function(obj, opt_global) {
  var global = opt_global || lib.global;
  for (var x in obj) {
    global[x] = obj[x];
  }
};


/**
 * Adds a dependency from a file to the files it requires.
 * @param {string} relPath The path to the js file.
 * @param {Array} provides An array of strings with the names of the objects
 *                         this file provides.
 * @param {Array} requires An array of strings with the names of the objects
 *                         this file requires.
 */
lib.addDependency = function(relPath, provides, requires) {
  if (!COMPILED) {
    var provide, require;
    var path = relPath.replace(/\\/g, '/');
    var deps = lib.dependencies_;
    for (var i = 0; provide = provides[i]; i++) {
      deps.nameToPath[provide] = path;
      if (!(path in deps.pathToNames)) {
        deps.pathToNames[path] = {};
      }
      deps.pathToNames[path][provide] = true;
    }
    for (var j = 0; require = requires[j]; j++) {
      if (!(path in deps.requires)) {
        deps.requires[path] = {};
      }
      deps.requires[path][require] = true;
    }
  }
};


/**
 * Implements a system for the dynamic resolution of dependencies
 * that works in parallel with the BUILD system. Note that all calls
 * to lib.require will be stripped by the JSCompiler when the
 * --closure_pass option is used.
 * @param {string} rule Rule to include, in the form lib.package.part.
 */
lib.require = function(rule) {

  // if the object already exists we do not need do do anything
  // TODO: If we start to support require based on file name this has
  //            to change
  // TODO: If we allow lib.foo.* this has to change
  // TODO: If we implement dynamic load after page load we should probably
  //            not remove this code for the compiled output
  if (!COMPILED) {
    if (lib.getObjectByName(rule)) {
      return;
    }
    var path = lib.getPathFromDeps_(rule);
    if (path) {
      lib.included_[path] = true;
      lib.writeScripts_();
    } else {
      var errorMessage = 'lib.require could not find: ' + rule;
      if (lib.global.console) {
        lib.global.console['error'](errorMessage);
      }

        throw Error(errorMessage);
    }
  }
};


/**
 * Whether lib.require should throw an exception if it fails.
 * @type {boolean}
 */
lib.useStrictRequires = false;


/**
 * Path for included scripts
 * @type {string}
 */
lib.basePath = '';


/**
 * A hook for overriding the base path.
 * @type {string|undefined}
 */
lib.global.CLOSURE_BASE_PATH;


/**
 * Whether to write out Closure's deps file. By default,
 * the deps are written.
 * @type {boolean|undefined}
 */
lib.global.CLOSURE_NO_DEPS;


/**
 * Null function used for default values of callbacks, etc.
 * @type {!Function}
 */
lib.nullFunction = function() {};


/**
 * The identity function. Returns its first argument.
 *
 * @param {*} var_args The arguments of the function.
 * @return {*} The first argument.
 * @deprecated Use lib.functions.identity instead.
 */
lib.identityFunction = function(var_args) {
  return arguments[0];
};


/**
 * When defining a class Foo with an abstract method bar(), you can do:
 *
 * Foo.prototype.bar = lib.abstractMethod
 *
 * Now if a subclass of Foo fails to override bar(), an error
 * will be thrown when bar() is invoked.
 *
 * Note: This does not take the name of the function to override as
 * an argument because that would make it more difficult to obfuscate
 * our JavaScript code.
 *
 * @type {!Function}
 * @throws {Error} when invoked to indicate the method should be
 *   overridden.
 */
lib.abstractMethod = function() {
  throw Error('unimplemented abstract method');
};


/**
 * Adds a {@code getInstance} static method that always return the same instance
 * object.
 * @param {!Function} ctor The constructor for the class to add the static
 *     method to.
 */
lib.addSingletonGetter = function(ctor) {
  ctor.getInstance = function() {
    return ctor.instance_ || (ctor.instance_ = new ctor());
  };
};


if (!COMPILED) {
  /**
   * Object used to keep track of urls that have already been added. This
   * record allows the prevention of circular dependencies.
   * @type {Object}
   * @private
   */
  lib.included_ = {};


  /**
   * This object is used to keep track of dependencies and other data that is
   * used for loading scripts
   * @private
   * @type {Object}
   */
  lib.dependencies_ = {
    pathToNames: {}, // 1 to many
    nameToPath: {}, // 1 to 1
    requires: {}, // 1 to many
    visited: {}, // used when resolving dependencies to prevent us from
                 // visiting the file twice
    written: {} // used to keep track of script files we have written
  };


  /**
   * Tries to detect whether is in the context of an HTML document.
   * @return {boolean} True if it looks like HTML document.
   * @private
   */
  lib.inHtmlDocument_ = function() {
    var doc = lib.global.document;
    return typeof doc != 'undefined' &&
           'write' in doc;  // XULDocument misses write.
  };


  /**
   * Tries to detect the base path of the base.js script that bootstraps Closure
   * @private
   */
  lib.findBasePath_ = function() {
    if (!lib.inHtmlDocument_()) {
      return;
    }
    var doc = lib.global.document;
    if (lib.global.CLOSURE_BASE_PATH) {
      lib.basePath = lib.global.CLOSURE_BASE_PATH;
      return;
    }
    var scripts = doc.getElementsByTagName('script');
    // Search backwards since the current script is in almost all cases the one
    // that has base.js.
    for (var i = scripts.length - 1; i >= 0; --i) {
      var src = scripts[i].src;
      var l = src.length;
      if (src.substr(l - 7) == 'base.js') {
        lib.basePath = src.substr(0, l - 7);
        return;
      }
    }
  };


  /**
   * Writes a script tag if, and only if, that script hasn't already been added
   * to the document.  (Must be called at execution time)
   * @param {string} src Script source.
   * @private
   */
  lib.writeScriptTag_ = function(src) {
    if (lib.inHtmlDocument_() &&
        !lib.dependencies_.written[src]) {
      lib.dependencies_.written[src] = true;
      var doc = lib.global.document;
      doc.write('<script type="text/javascript" src="' +
                src + '"></' + 'script>');
    }
  };


  /**
   * Resolves dependencies based on the dependencies added using addDependency
   * and calls writeScriptTag_ in the correct order.
   * @private
   */
  lib.writeScripts_ = function() {
    // the scripts we need to write this time
    var scripts = [];
    var seenScript = {};
    var deps = lib.dependencies_;

    function visitNode(path) {
      if (path in deps.written) {
        return;
      }

      // we have already visited this one. We can get here if we have cyclic
      // dependencies
      if (path in deps.visited) {
        if (!(path in seenScript)) {
          seenScript[path] = true;
          scripts.push(path);
        }
        return;
      }

      deps.visited[path] = true;

      if (path in deps.requires) {
        for (var requireName in deps.requires[path]) {
          if (requireName in deps.nameToPath) {
            visitNode(deps.nameToPath[requireName]);
          } else if (!lib.getObjectByName(requireName)) {
            // If the required name is defined, we assume that this
            // dependency was bootstapped by other means. Otherwise,
            // throw an exception.
            throw Error('Undefined nameToPath for ' + requireName);
          }
        }
      }

      if (!(path in seenScript)) {
        seenScript[path] = true;
        scripts.push(path);
      }
    }

    for (var path in lib.included_) {
      if (!deps.written[path]) {
        visitNode(path);
      }
    }

    for (var i = 0; i < scripts.length; i++) {
      if (scripts[i]) {
        lib.writeScriptTag_(lib.basePath + scripts[i]);
      } else {
        throw Error('Undefined script input');
      }
    }
  };


  /**
   * Looks at the dependency rules and tries to determine the script file that
   * fulfills a particular rule.
   * @param {string} rule In the form lib.namespace.Class or project.script.
   * @return {string?} Url corresponding to the rule, or null.
   * @private
   */
  lib.getPathFromDeps_ = function(rule) {
    if (rule in lib.dependencies_.nameToPath) {
      return lib.dependencies_.nameToPath[rule];
    } else {
      return null;
    }
  };

  lib.findBasePath_();

  // Allow projects to manage the deps files themselves.
  if (!lib.global.CLOSURE_NO_DEPS) {
    lib.writeScriptTag_(lib.basePath + 'deps.js');
  }
}



//==============================================================================
// Language Enhancements
//==============================================================================


/**
 * This is a "fixed" version of the typeof operator.  It differs from the typeof
 * operator in such a way that null returns 'null' and arrays return 'array'.
 * @param {*} value The value to get the type of.
 * @return {string} The name of the type.
 */
lib.typeOf = function(value) {
  var s = typeof value;
  if (s == 'object') {
    if (value) {
      // We cannot use constructor == Array or instanceof Array because
      // different frames have different Array objects. In IE6, if the iframe
      // where the array was created is destroyed, the array loses its
      // prototype. Then dereferencing val.splice here throws an exception, so
      // we can't use lib.isFunction. Calling typeof directly returns 'unknown'
      // so that will work. In this case, this function will return false and
      // most array functions will still work because the array is still
      // array-like (supports length and []) even though it has lost its
      // prototype.
      // Mark Miller noticed that Object.prototype.toString
      // allows access to the unforgeable [[Class]] property.
      //  15.2.4.2 Object.prototype.toString ( )
      //  When the toString method is called, the following steps are taken:
      //      1. Get the [[Class]] property of this object.
      //      2. Compute a string value by concatenating the three strings
      //         "[object ", Result(1), and "]".
      //      3. Return Result(2).
      // and this behavior survives the destruction of the execution context.
      if (value instanceof Array ||  // Works quickly in same execution context.
          // If value is from a different execution context then
          // !(value instanceof Object), which lets us early out in the common
          // case when value is from the same context but not an array.
          // The {if (value)} check above means we don't have to worry about
          // undefined behavior of Object.prototype.toString on null/undefined.
          //
          // HACK: In order to use an Object prototype method on the arbitrary
          //   value, the compiler requires the value be cast to type Object,
          //   even though the ECMA spec explicitly allows it.
          (!(value instanceof Object) &&
           (Object.prototype.toString.call(
               /** @type {Object} */ (value)) == '[object Array]') ||

           // In IE all non value types are wrapped as objects across window
           // boundaries (not iframe though) so we have to do object detection
           // for this edge case
           typeof value.length == 'number' &&
           typeof value.splice != 'undefined' &&
           typeof value.propertyIsEnumerable != 'undefined' &&
           !value.propertyIsEnumerable('splice')

          )) {
        return 'array';
      }
      // HACK: There is still an array case that fails.
      //     function ArrayImpostor() {}
      //     ArrayImpostor.prototype = [];
      //     var impostor = new ArrayImpostor;
      // this can be fixed by getting rid of the fast path
      // (value instanceof Array) and solely relying on
      // (value && Object.prototype.toString.vall(value) === '[object Array]')
      // but that would require many more function calls and is not warranted
      // unless closure code is receiving objects from untrusted sources.

      // IE in cross-window calls does not correctly marshal the function type
      // (it appears just as an object) so we cannot use just typeof val ==
      // 'function'. However, if the object has a call property, it is a
      // function.
      if (!(value instanceof Object) &&
          (Object.prototype.toString.call(
              /** @type {Object} */ (value)) == '[object Function]' ||
          typeof value.call != 'undefined' &&
          typeof value.propertyIsEnumerable != 'undefined' &&
          !value.propertyIsEnumerable('call'))) {
        return 'function';
      }


    } else {
      return 'null';
    }

  // In Safari typeof nodeList returns 'function', and on Firefox
  // typeof behaves similarly for HTML{Applet,Embed,Object}Elements
  // and RegExps.  We would like to return object for those and we can
  // detect an invalid function by making sure that the function
  // object has a call method.
  } else if (s == 'function' && typeof value.call == 'undefined') {
    return 'object';
  }
  return s;
};


/**
 * Safe way to test whether a property is enumarable.  It allows testing
 * for enumerable on objects where 'propertyIsEnumerable' is overridden or
 * does not exist (like DOM nodes in IE). Does not use browser native
 * Object.propertyIsEnumerable.
 * @param {Object} object The object to test if the property is enumerable.
 * @param {string} propName The property name to check for.
 * @return {boolean} True if the property is enumarable.
 * @private
 */
lib.propertyIsEnumerableCustom_ = function(object, propName) {
  // KJS in Safari 2 is not ECMAScript compatible and lacks crucial methods
  // such as propertyIsEnumerable.  We therefore use a workaround.
  // Does anyone know a more efficient work around?
  if (propName in object) {
    for (var key in object) {
      if (key == propName &&
          Object.prototype.hasOwnProperty.call(object, propName)) {
        return true;
      }
    }
  }
  return false;
};


/**
 * Safe way to test whether a property is enumarable.  It allows testing
 * for enumerable on objects where 'propertyIsEnumerable' is overridden or
 * does not exist (like DOM nodes in IE).
 * @param {Object} object The object to test if the property is enumerable.
 * @param {string} propName The property name to check for.
 * @return {boolean} True if the property is enumarable.
 * @private
 */
lib.propertyIsEnumerable_ = function(object, propName) {
  // In IE if object is from another window, cannot use propertyIsEnumerable
  // from this window's Object. Will raise a 'JScript object expected' error.
  if (object instanceof Object) {
    return Object.prototype.propertyIsEnumerable.call(object, propName);
  } else {
    return lib.propertyIsEnumerableCustom_(object, propName);
  }
};


/**
 * Returns true if the specified value is not |undefined|.
 * WARNING: Do not use this to test if an object has a property. Use the in
 * operator instead.  Additionally, this function assumes that the global
 * undefined variable has not been redefined.
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is defined.
 */
lib.isDef = function(val) {
  return val !== undefined;
};


/**
 * Returns true if the specified value is |null|
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is null.
 */
lib.isNull = function(val) {
  return val === null;
};


/**
 * Returns true if the specified value is defined and not null
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is defined and not null.
 */
lib.isDefAndNotNull = function(val) {
  // Note that undefined == null.
  return val != null;
};


/**
 * Returns true if the specified value is an array
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is an array.
 */
lib.isArray = function(val) {
  return lib.typeOf(val) == 'array';
};


/**
 * Returns true if the object looks like an array. To qualify as array like
 * the value needs to be either a NodeList or an object with a Number length
 * property.
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is an array.
 */
lib.isArrayLike = function(val) {
  var type = lib.typeOf(val);
  return type == 'array' || type == 'object' && typeof val.length == 'number';
};


/**
 * Returns true if the object looks like a Date. To qualify as Date-like
 * the value needs to be an object and have a getFullYear() function.
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is a like a Date.
 */
lib.isDateLike = function(val) {
  return lib.isObject(val) && typeof val.getFullYear == 'function';
};


/**
 * Returns true if the specified value is a string
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is a string.
 */
lib.isString = function(val) {
  return typeof val == 'string';
};


/**
 * Returns true if the specified value is a boolean
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is boolean.
 */
lib.isBoolean = function(val) {
  return typeof val == 'boolean';
};


/**
 * Returns true if the specified value is a number
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is a number.
 */
lib.isNumber = function(val) {
  return typeof val == 'number';
};


/**
 * Returns true if the specified value is a function
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is a function.
 */
lib.isFunction = function(val) {
  return lib.typeOf(val) == 'function';
};


/**
 * Returns true if the specified value is an object.  This includes arrays
 * and functions.
 * @param {*} val Variable to test.
 * @return {boolean} Whether variable is an object.
 */
lib.isObject = function(val) {
  var type = lib.typeOf(val);
  return type == 'object' || type == 'array' || type == 'function';
};


/**
 * Adds a hash code field to an object. The hash code is unique for the
 * given object.
 * @param {Object} obj The object to get the hash code for.
 * @return {number} The hash code for the object.
 */
lib.getHashCode = function(obj) {
  // In IE, DOM nodes do not extend Object so they do not have this method.
  // we need to check hasOwnProperty because the proto might have this set.

  // TODO: There is a proposal to add hashcode as a global function to JS2
  //            we should keep track of this process so we can use that whenever
  //            it starts to show up in the real world.
  if (obj.hasOwnProperty && obj.hasOwnProperty(lib.HASH_CODE_PROPERTY_)) {
    return obj[lib.HASH_CODE_PROPERTY_];
  }
  if (!obj[lib.HASH_CODE_PROPERTY_]) {
    obj[lib.HASH_CODE_PROPERTY_] = ++lib.hashCodeCounter_;
  }
  return obj[lib.HASH_CODE_PROPERTY_];
};


/**
 * Removes the hash code field from an object.
 * @param {Object} obj The object to remove the field from.
 */
lib.removeHashCode = function(obj) {
  // DOM nodes in IE are not instance of Object and throws exception
  // for delete. Instead we try to use removeAttribute
  if ('removeAttribute' in obj) {
    obj.removeAttribute(lib.HASH_CODE_PROPERTY_);
  }
  /** @preserveTry */
  try {
    delete obj[lib.HASH_CODE_PROPERTY_];
  } catch (ex) {
  }
};


/**
 * Name for hash code property. Initialized in a way to help avoid collisions
 * with other closure javascript on the same page.
 * @type {string}
 * @private
 */
lib.HASH_CODE_PROPERTY_ = 'closure_hashCode_' +
    Math.floor(Math.random() * 2147483648).toString(36);


/**
 * Counter for hash codes.
 * @type {number}
 * @private
 */
lib.hashCodeCounter_ = 0;


/**
 * Clone an object/array (recursively)
 * @param {Object} proto Object to clone.
 * @return {Object} Clone of x;.
 */
lib.cloneObject = function(proto) {
  var type = lib.typeOf(proto);
  if (type == 'object' || type == 'array') {
    if (proto.clone) {
      // TODO Change to proto.clone() once # args warn is removed
      return proto.clone.call(proto);
    }
    var clone = type == 'array' ? [] : {};
    for (var key in proto) {
      clone[key] = lib.cloneObject(proto[key]);
    }
    return clone;
  }

  return proto;
};


/**
 * Forward declaration for the clone method. This is necessary until the
 * compiler can better support duck-typing constructs as used in
 * lib.cloneObject.
 *
 * TODO: Remove once the JSCompiler can infer that the check for
 * proto.clone is safe in lib.cloneObject.
 *
 * @type {Function}
 */
Object.prototype.clone;


/**
 * Partially applies this function to a particular 'this object' and zero or
 * more arguments. The result is a new function with some arguments of the first
 * function pre-filled and the value of |this| 'pre-specified'.<br><br>
 *
 * Remaining arguments specified at call-time are appended to the pre-
 * specified ones.<br><br>
 *
 * Also see: {@link #partial}.<br><br>
 *
 * Usage:
 * <pre>var barMethBound = bind(myFunction, myObj, 'arg1', 'arg2');
 * barMethBound('arg3', 'arg4');</pre>
 *
 * @param {Function} fn A function to partially apply.
 * @param {Object|undefined} selfObj Specifies the object which |this| should
 *     point to when the function is run. If the value is null or undefined, it
 *     will default to the global object.
 * @param {*} var_args Additional arguments that are partially
 *     applied to the function.
 *
 * @return {!Function} A partially-applied form of the function bind() was
 *     invoked as a method of.
 */
lib.bind = function(fn, selfObj, var_args) {
  var context = selfObj || lib.global;

  if (arguments.length > 2) {
    var boundArgs = Array.prototype.slice.call(arguments, 2);
    return function() {
      // Prepend the bound arguments to the current arguments.
      var newArgs = Array.prototype.slice.call(arguments);
      Array.prototype.unshift.apply(newArgs, boundArgs);
      return fn.apply(context, newArgs);
    };

  } else {
    return function() {
      return fn.apply(context, arguments);
    };
  }
};


/**
 * Like bind(), except that a 'this object' is not required. Useful when the
 * target function is already bound.
 *
 * Usage:
 * var g = partial(f, arg1, arg2);
 * g(arg3, arg4);
 *
 * @param {Function} fn A function to partially apply.
 * @param {*} var_args Additional arguments that are partially
 *     applied to fn.
 * @return {!Function} A partially-applied form of the function bind() was
 *     invoked as a method of.
 */
lib.partial = function(fn, var_args) {
  var args = Array.prototype.slice.call(arguments, 1);
  return function() {
    // Prepend the bound arguments to the current arguments.
    var newArgs = Array.prototype.slice.call(arguments);
    newArgs.unshift.apply(newArgs, args);
    return fn.apply(this, newArgs);
  };
};


/**
 * Copies all the members of a source object to a target object.
 * @param {Object} target Target.
 * @param {Object} source Source.
 * @deprecated Use lib.object.extend instead.
 */
lib.mixin = function(target, source) {
  for (var x in source) {
    target[x] = source[x];
  }

  // For IE the for-in-loop does not contain any properties that are not
  // enumerable on the prototype object (for example, isPrototypeOf from
  // Object.prototype) but also it will not include 'replace' on objects that
  // extend String and change 'replace' (not that it is common for anyone to
  // extend anything except Object).
};


/**
 * @return {number} An integer value representing the number of milliseconds
 *     between midnight, January 1, 1970 and the current time.
 */
lib.now = Date.now || (function() {
  // Unary plus operator converts its operand to a number which in the case of
  // a date is done by calling getTime().
  return +new Date();
});


/**
 * Evals javascript in the global scope.  In IE this uses execScript, other
 * browsers use lib.global.eval. If lib.global.eval does not evaluate in the
 * global scope (for example, in Safari), appends a script tag instead.
 * Throws an exception if neither execScript or eval is defined.
 * @param {string} script JavaScript string.
 */
lib.globalEval = function(script) {
  if (lib.global.execScript) {
    lib.global.execScript(script, 'JavaScript');
  } else if (lib.global.eval) {
    // Test to see if eval works
    if (lib.evalWorksForGlobals_ == null) {
      lib.global.eval('var _et_ = 1;');
      if (typeof lib.global['_et_'] != 'undefined') {
        delete lib.global['_et_'];
        lib.evalWorksForGlobals_ = true;
      } else {
        lib.evalWorksForGlobals_ = false;
      }
    }

    if (lib.evalWorksForGlobals_) {
      lib.global.eval(script);
    } else {
      var doc = lib.global.document;
      var scriptElt = doc.createElement('script');
      scriptElt.type = 'text/javascript';
      scriptElt.defer = false;
      // NOTE: can't use .innerHTML since "t('<test>')" will fail and
      // .text doesn't work in Safari 2.  Therefore we append a text node.
      scriptElt.appendChild(doc.createTextNode(script));
      doc.body.appendChild(scriptElt);
      doc.body.removeChild(scriptElt);
    }
  } else {
    throw Error('lib.globalEval not available');
  }
};


/**
 * A macro for defining composite types.
 *
 * By assigning lib.typedef to a name, this tells JSCompiler that this is not
 * the name of a class, but rather it's the name of a composite type.
 *
 * For example,
 * /** @type {Array|NodeList} / lib.ArrayLike = lib.typedef;
 * will tell JSCompiler to replace all appearances of lib.ArrayLike in type
 * definitions with the union of Array and NodeList.
 *
 * Does nothing in uncompiled code.
 */
lib.typedef = true;


/**
 * Optional map of CSS class names to obfuscated names used with
 * lib.getCssName().
 * @type {Object|undefined}
 * @private
 * @see lib.setCssNameMapping
 */
lib.cssNameMapping_;


/**
 * Handles strings that are intended to be used as CSS class names.
 *
 * Without JS Compiler the arguments are simple joined with a hyphen and passed
 * through unaltered.
 *
 * With the JS Compiler the arguments are inlined, e.g:
 *     var x = lib.getCssName('foo');
 *     var y = lib.getCssName(this.baseClass, 'active');
 *  becomes:
 *     var x= 'foo';
 *     var y = this.baseClass + '-active';
 *
 * If a CSS renaming map is passed to the compiler it will replace symbols in
 * the classname.  If one argument is passed it will be processed, if two are
 * passed only the modifier will be processed, as it is assumed the first
 * argument was generated as a result of calling lib.getCssName.
 *
 * Names are split on 'hyphen' and processed in parts such that the following
 * are equivalent:
 *   var base = lib.getCssName('baseclass');
 *   lib.getCssName(base, 'modifier');
 *   lib.getCSsName('baseclass-modifier');
 *
 * If any part does not appear in the renaming map a warning is logged and the
 * original, unobfuscated class name is inlined.
 *
 * @param {string} className The class name.
 * @param {string} opt_modifier A modifier to be appended to the class name.
 * @return {string} The class name or the concatenation of the class name and
 *     the modifier.
 */
lib.getCssName = function(className, opt_modifier) {
  var cssName = className + (opt_modifier ? '-' + opt_modifier : '');
  return (lib.cssNameMapping_ && (cssName in lib.cssNameMapping_)) ?
      lib.cssNameMapping_[cssName] : cssName;
};


/**
 * Sets the map to check when returning a value from lib.getCssName(). Example:
 * <pre>
 * lib.setCssNameMapping({
 *   "lib-menu": "a",
 *   "lib-menu-disabled": "a-b",
 *   "CSS_LOGO": "b",
 *   "hidden": "c"
 * });
 *
 * // The following evaluates to: "a a-b".
 * lib.getCssName('lib-menu') + ' ' + lib.getCssName('lib-menu', 'disabled')
 * </pre>
 * When declared as a map of string literals to string literals, the JSCompiler
 * will replace all calls to lib.getCssName() using the supplied map if the
 * --closure_pass flag is set.
 *
 * @param {!Object} mapping A map of strings to strings where keys are possible
 *     arguments to lib.getCssName() and values are the corresponding values
 *     that should be returned.
 */
lib.setCssNameMapping = function(mapping) {
  lib.cssNameMapping_ = mapping;
};


/**
 * Abstract implementation of lib.getMsg for use with localized messages.
 * @param {string} str Translatable string, places holders in the form {$foo}.
 * @param {Object} opt_values Map of place holder name to value.
 * @return {string} message with placeholders filled.
 */
lib.getMsg = function(str, opt_values) {
  var values = opt_values || {};
  for (var key in values) {
    str = str.replace(new RegExp('\\{\\$' + key + '\\}', 'gi'), values[key]);
  }
  return str;
};


/**
 * Exposes an unobfuscated global namespace path for the given object.
 * Note that fields of the exported object *will* be obfuscated,
 * unless they are exported in turn via this function or
 * lib.exportProperty
 *
 * <p>Also handy for making public items that are defined in anonymous
 * closures.
 *
 * ex. lib.exportSymbol('Foo', Foo);
 *
 * ex. lib.exportSymbol('public.path.Foo.staticFunction',
 *                       Foo.staticFunction);
 *     public.path.Foo.staticFunction();
 *
 * ex. lib.exportSymbol('public.path.Foo.prototype.myMethod',
 *                       Foo.prototype.myMethod);
 *     new public.path.Foo().myMethod();
 *
 * @param {string} publicPath Unobfuscated name to export.
 * @param {Object} object Object the name should point to.
 * @param {Object} opt_objectToExportTo The object to add the path to; default
 *     is |lib.global|.
 */
lib.exportSymbol = function(publicPath, object, opt_objectToExportTo) {
  lib.exportPath_(publicPath, object, opt_objectToExportTo);
};


/**
 * Exports a property unobfuscated into the object's namespace.
 * ex. lib.exportProperty(Foo, 'staticFunction', Foo.staticFunction);
 * ex. lib.exportProperty(Foo.prototype, 'myMethod', Foo.prototype.myMethod);
 * @param {Object} object Object whose static property is being exported.
 * @param {string} publicName Unobfuscated name to export.
 * @param {Object} symbol Object the name should point to.
 */
lib.exportProperty = function(object, publicName, symbol) {
  object[publicName] = symbol;
};


/**
 * Inherit the prototype methods from one constructor into another.
 *
 * Usage:
 * <pre>
 * function ParentClass(a, b) { }
 * ParentClass.prototype.foo = function(a) { }
 *
 * function ChildClass(a, b, c) {
 *   ParentClass.call(this, a, b);
 * }
 *
 * lib.inherits(ChildClass, ParentClass);
 *
 * var child = new ChildClass('a', 'b', 'see');
 * child.foo(); // works
 * </pre>
 *
 * In addition, a superclass' implementation of a method can be invoked
 * as follows:
 *
 * <pre>
 * ChildClass.prototype.foo = function(a) {
 *   ChildClass.superClass_.foo.call(this, a);
 *   // other code
 * };
 * </pre>
 *
 * @param {Function} childCtor Child class.
 * @param {Function} parentCtor Parent class.
 */
lib.inherits = function(childCtor, parentCtor) {
  /** @constructor */
  function tempCtor() {};
  tempCtor.prototype = parentCtor.prototype;
  childCtor.superClass_ = parentCtor.prototype;
  childCtor.prototype = new tempCtor();
  childCtor.prototype.constructor = childCtor;
};



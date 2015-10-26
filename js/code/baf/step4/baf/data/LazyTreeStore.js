/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
/*
 * Copyright (c) 2000-2008, Vista Information Technologies, Inc.
 * Use, modification, and distribution subject to terms of license.
 */
dojo.provide("baf.data.LazyTreeStore");
dojo.require("dojo.data.api.Identity");
(function(){
  
  var
    childrenLoaded  = -1,
    childrenNever   = 0,
    childrenMaybe   = 1;
  
  dojo.declare("baf.data.LazyTreeStore", dojo.data.api.Identity, {
    //  summary:
    //    Lazy gets the children of a tree node
    //
    //  Assumes each item has attributes:
    //    id: unique identifier for the tree node
    //    parentId: the parent of the node; null implies root
    //    children: array of children
    //    childrenState:
    //      childrenLoaded 
    //        => children loaded (note: children attribute may have zero children)
    //      childrenNever 
    //        => no children, ever (the node is some type that _never_ has children)
    //      childrenMaybe 
    //        => possibly some children, but, unknown until actually queried
    //
    //  Service expects parameters:
    //    id: <id> => load tree node given by <id>
    //    getChildren: <boolean> => true: load all children of tree node given by <id>; 
    //                              false: load tree node given by <id>
    //

    //given a parent, returns the value of xhrargs.content required to retreive all children of the parent
    requestParams: function(request) {
      return {
        id: request.id,
        getChildren: !!(request.getChildren)
      };
    },
    
    //the function used to call the service
    service: dojo.xhrGet,

    //function to sort each set of siblings:
    //  null => don't sort
    //  otherwise f(lhs, rhs) => -1 if lhs<rhs, 0 if lhs==rhs, 1 if lhs>rhs
    sort:null,
    
    //a function that calculates the label
    //  null => label is item.label
    //  otherwise f(item) => the label value
    labelCalc: null,
    
    //the items
    _items:[],
    
    //map from id to item
    _idToItem: [],

    constructor: function(args){
      dojo.mixin(this, args);
      this._items= args.root;
      this._idToItem[args.root.id]= args.root;
    },
    
    getValue: function(/* item */ item, /* attribute-name-string */ attribute, /* value? */ defaultValue){
      if (attribute=="label" && this.labelCalc) {
        return this.labelCalc(item);
      }
      if (item[attribute]) {
        return item[attribute];
      }
      if (defaultValue) {
        return defaultValue;
      }
      throw new Error('baf.data.LazyTreeStore: failed getValue');
    },
    
    getValues: function(/* item */ item, /* attribute-name-string */ attribute){
      var result= this.getValue(item, attribute);
      if (dojo.isArray(result)) {
        return result;
      } else {
        return [result];
      }
    },
    
    getAttributes: function(/* item */ item){
      var ret = [];
      for(var i in item){
        ret.push(i);
      }
      return ret;
    },
  
    hasAttribute: function(/* item */ item, /* attribute-name-string */ attribute) {
      return typeof item[attribute]!="undefined";
    },
    
    containsValue: function(/* item */ item, /* attribute-name-string */ attribute, /* anything */ value){
      var values = this.getValues(item, attribute);
      return dojo.some(this.getValues(item, attribute), function(x){return x==value;});
    },
    
    isItem: function(idOrItem){
      //TODO
      return true;
    },
    
    isItemLoaded: function(id) {
      return this._idToItem[id];
    },
  
    loadItem: function(/* object */ args){
      //items are either fully loaded or not loaded at all; therefore, the only way to know
      //about an item is for it to be loaded...
      return;
    },
    
    
    fetch:function(/* Object? */ request){
      var result= dojo.mixin({}, request);
      if (typeof result.id == "undefined") {
        //default to get the root...
        result.id= 0;
      }
      result.theDeferred= this.service({
        url: this.url,
        handleAs: "json-comment-optional",
        content: this.requestParams(result),
        load: dojo.hitch(this, this.onLoad, result),
        error: dojo.hitch(this, this.onError, result)
      });
      result.abort= function(){
        result.theDeferred.abort.apply(result.theDeferred, arguments);
      };
      return result;
    },
    

    
    onLoad: function(request, data){
      var abort= false;
      request.abort= function() {
        abort= true;
      };
      
      //data is either a single item or an array of children
      if (!dojo.isArray(data)) {
        //returned a single item; therefore turn it into an array...
        data= [data];
      } else if (this.sort) {
        data.sort(this.sort);
      }
      
      //set the children of the parent
      if (data.length) {
        this._idToItem[data[0].parentId].childrenState= childrenLoaded;
        this._idToItem[data[0].parentId].children= data;
      }
      
      //set the _idToItem for each item
      dojo.forEach(data, function(item){
        this._idToItem[item.id]= item;
      }, this);

      var scope= request.scope || dojo.global;

      if(request.onBegin){
        request.onBegin.call(scope, data.length, request);
      }

      if (request.onItem && !abort) {
        dojo.forEach(data, function(item){
          if (!abort) {
            request.onItem.call(scope, item, request);
          }
        });
      }
      
      if (request.onComplete && !abort) {
        request.onComplete.call(scope, (request.onItem ? null : data), request);   
      }
    },
    
      
    onError: function(request, errorObject){
      if (request.onError) {
        request.onError.call(request.scope || dojo.global, errorObject, request);
      }
    },
  
    close: function(request){
      function deleteMapRefs(item){
        delete this._idToItem[item.id];
        dojo.forEach(item.children, deleteMapRefs);
      }
      deleteMapRefs(request.item);

      var 
        parent= request.item.parent,
        target= request.item.id;
      if (parent) {
        for (var i= 0, end= parent.children.length; i<end; i++) {
          if (parent.children[i].id==target) {
            delete parent.children[i];
            break;
          }
        }
      }
    },
  
    getLabel: function(/* item */ item){
      return this.getValue(item, "label");
    },
  
    getLabelAttributes: function(/* item */ item){
      return "label";
    },

    fetchItemByIdentity: function(/* Object */ args){
      if (args.id) {
        args.item= this._idToItem[args.id];
      }
      return fetch(args);
    },
    
    getIdentity: function(/* item */ item){
      return item.id;
    },
    
    getIdentityAttributes: function(/* item */ item){
      return "id";
    },
    
    
    hasChildren: function(item){
      return (
        item.childrenState==childrenMaybe ||
       (item.childrenState==childrenLoaded && item.children.length));
    },
    
        
    childrenLoaded: function(item){
      return item.childrenState==childrenLoaded;
    }
    
  });//dojo.declare("baf.data.LazyTreeStore", dojo.data.api.Identity, {
  baf.data.LazyTreeStore.childrenLoaded  = childrenLoaded;
  baf.data.LazyTreeStore.childrenNever   = childrenNever;
  baf.data.LazyTreeStore.childrenMaybe   = childrenMaybe;

})();//(function(){

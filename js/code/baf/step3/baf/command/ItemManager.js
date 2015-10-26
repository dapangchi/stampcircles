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
dojo.provide("baf.command.ItemManager");
dojo.require("dojo.data.ItemFileReadStore");
(function(){
  
  baf.commandType= {
    invalid:    0,
    command:    1,
    separator:  2,
    submenu:    3,
    group:      4,
    mode:       5,
    menu:       6
  };

  var defaultCommandItem= {
    id:           null,
    type:         baf.commandType.invalid,
    order:        Number.MAX_VALUE,
    group:        Number.MAX_VALUE,
    text:         "undefined(debug)",
    accelText:    "",
    mnemonic:     "",
    accelKey:     0,
    accelShift:   0,
    statusText:   null,
    helpUrl:      null,
    tooltipText:  null,
    enabledIcon:  null,
    disabledIcon: null
  };
  
  

  
  dojo.declare("baf.command.ItemManager", dojo.data.ItemFileReadStore, {
    
    getItem: function(id) {
      //  summary: 
      //    Returns a command item as a hash; guaranteed to return immediately

      var theItem;
      function onItem(item) {
        theItem= item;
      }

      this.fetchItemByIdentity({
        identity: id,
        onItem: onItem
      });
      
      if (theItem) {
        var result= {};
        for (var p in defaultCommandItem) if (defaultCommandItem.hasOwnProperty(p)) {
          result[p]= this.getValue(theItem, p, defaultCommandItem[p]);
        }
        return result;
      } else {
        return dojo.mixin({}, defaultCommandItem, {text: id});
      }
    }
    
  });
  
  
})();//(function(){

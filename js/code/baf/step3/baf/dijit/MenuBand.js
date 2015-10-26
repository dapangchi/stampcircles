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
dojo.provide("baf.dijit.MenuBand");
dojo.require("dijit.Toolbar");
dojo.require("dijit.Menu");
dojo.require("dijit.form.Button");
(function(){

  
  dojo.declare("baf.Submenu", dijit.Menu, {
    onOpen: function(){
      this.onOpenSubmenu();
      this.inherited(arguments);
    },
    onClose: function(){
      this.inherited(arguments);
      dojo.forEach(this.getChildren(), function(child){
        this.removeChild(child);
        child.destroy();
      }, this);
    }
  });
  

  
  dojo.declare("baf.dijit.MenuBand", dijit.Toolbar, {
    constructor: function(args) {
      this.commandItemStore= args.commandItemStore;
      this.menu= args.menu;
      this.sort= args.sort || function(lhs, rhs){return lhs.order-rhs.order;};
    },
  
    
    postCreate: function() {
      this.inherited(arguments);
      this._build();
    },
    
    reset: function(menu){
      this.menu= menu;
      this._build();
    },
    
    destroy: function(){
      dojo.forEach(this.getChildren(), function(child){
        this.removeChild(child);
        child.destroy();
      }, this);
      this.inherited(arguments);
    },
    
    
    _prepareList: function(menu){
      var contents= [];
      for (var p in menu) if (menu.hasOwnProperty(p)) {
        contents.push(this.commandItemStore.getItem(p));
      }
      contents.sort(this.sort);
      
      var result= [];
      if (contents.length) {
        result= [contents[0]];
        var group= contents[0].group;
        for (var i= 1; i<contents.length; i++) {
          if (contents[i].group!=group) {
            result.push({id:"separator", type: baf.commandType.separator});
            group= contents[i].group;
          }
          result.push(contents[i]);
        }
      }
      return result;  
    },
    
    
    
    _build: function() {
      var contents= this._prepareList(this.menu);
      this._publish(["beforeDisplay", this, contents]);
      dojo.forEach(contents, function(commandItem){
        this._publish(["beforeDisplayItem", this, commandItem]);
        var item= null;
        switch (commandItem.type){
          case baf.commandType.command:
            item= new dijit.form.Button({
              label: commandItem.text,
              onClick: dojo.hitch(this, "_exec", commandItem)
            });
          break;
          
          case baf.commandType.separator:
            item= new dijit.ToolbarSeparator();
          break;
          
          case baf.commandType.submenu:
          case baf.commandType.menu:
            var popup= new baf.Submenu();
            popup.onOpenSubmenu= dojo.hitch(
              this, 
              this._onOpenDropDown, 
              this.menu[commandItem.id], popup);
            item= new dijit.form.DropDownButton({
              label: commandItem.text,
              dropDown: popup
            });
          break;
          
          default: break;
        }
        if (item) {
          this.addChild(item);
        }        
      }, this);
    },
    
    
    
    _onOpenDropDown: function(menuObject, menu){
      var contents= this._prepareList(menuObject);
      dojo.publish(["beforeDisplaySubmenu", this, contents]);
      dojo.forEach(contents, function(commandItem){
        dojo.publish(["beforeDisplayItem", this, commandItem]);
        var item= null;
        switch (commandItem.type){
          case baf.commandType.command:
            item= new dijit.MenuItem({
              label: commandItem.text,
              onClick: dojo.hitch(this, "_exec", commandItem)
            });
          break;
          
          case baf.commandType.separator:
            item= new dijit.MenuSeparator();
          break;
          
          case baf.commandType.submenu:
          case baf.commandType.menu:
            var popup= new baf.Submenu();
            popup.onOpenSubmenu= dojo.hitch(
              this, 
              this._onOpenDropDown, 
              menuObject[commandItem.id], 
              popup);
            item= new dijit.PopupMenuItem({
              label: commandItem.text,
              popup: popup
            });
          break;
          
          default: break;
        }
        if (item) {
          menu.addChild(item);
        }        
      }, this);
  },
  
 
  _exec: function(commandItem) {
    this._publish(["execute", this, commandItem]);
  },
  
  _publish: function(args){
    dojo.publish("baf.dijit.MenuBand", args);
  }
    
  });//dojo.declare("baf.dijit.MenuBand", dijit.Toolbar, {
  
})();//(function(){

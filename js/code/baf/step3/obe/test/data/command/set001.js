/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("obe.test.data.command.set001");
dojo.require("baf.command.ItemManager");
(function(){
  obe.test.data.command.set001.commandItems= {
    identifier: "id",
    label: "text",
    items: [{
      id: "file",
      type: baf.commandType.submenu,
      text: "File",
      order: 1000
    },{
      id: "save",
      type: baf.commandType.command,
      text: "Save",
      order: 1520,
      group: "save"
    },{
      id: "saveAs",
      type: baf.commandType.command,
      text: "Save As...",
      order: 1530,
      group: "save"
    },{
      id: "saveAll",
      type: baf.commandType.command,
      text: "Save All",
      order: 1540,
      group: "save"
    },{
      id: "close",
      type: baf.commandType.submenu,
      text: "Close",
      order: 1420,
      group: "close"
    },{
      id: "closeAll",
      type: baf.commandType.command,
      text: "Close All",
      order: 1430,
      group: "close"
    },{
      id: "logoff",
      type: baf.commandType.command,
      text: "Logoff",
      order: 2020,
      group: "exit"
    },{
      id: "switchUser",
      type: baf.commandType.command,
      text: "Switch User",
      order: 2030,
      group: "exit"         
    },{
      id: "edit",
      type: baf.commandType.submenu,
      text: "Edit",
      order: 4000
    },{
      id: "navigate",
      type: baf.commandType.submenu,
      text: "Navigate",
      order: 6000
    },{
      id: "search",
      type: baf.commandType.submenu,
      text: "Search",
      order: 8000
    },{
      id: "project",
      type: baf.commandType.submenu,
      text: "Project",
      order: 10000
    },{
      id: "help",
      type: baf.commandType.submenu,
      text: "Help",
      order: 12000
    }]
  };

  obe.test.data.command.set001.mainMenu= {
    file: {
      save: 0,
      saveAll: 0,
      saveAll: 0,
      close: {
        save: 0,
        saveAll: 0,
        saveAll: 0
      },
      closeAll: 0,
      logoff: 0,
      switchUser: 0
    },
    edit: 0,
    navigate: 0,
    search: 0,
    project: 0,
    help: 0
  };

})();//(function(){

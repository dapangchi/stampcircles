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
dojo.provide("obe.test.data.navigator.set001");
dojo.require("obe.test.data.MockNavigatorDataBuilder");
(function(){
  
  var 
    builder= new obe.test.data.MockNavigatorDataBuilder(["label", "type", "oid"]),
    oid= 0,
    type= {
      root: 0,
      folder: 1,
      demographics: 2
    };
  

  builder.pushINode("root", type.root, oid++);
  builder.pushINode("Protocols", type.folder, oid++);
    builder.pushINode("VCI-82-2002-GCR", type.folder, oid++);
      builder.pushINode("Investigators", type.folder, oid++);
        builder.pushINode("Braker", type.folder, oid++); builder.pop();
        builder.pushINode("Harris", type.folder, oid++);
          builder.pushINode("Audits", type.folder, oid++); builder.pop();
          builder.pushINode("Communications", type.folder, oid++); builder.pop();
          builder.pushINode("IRC/EC", type.folder, oid++); builder.pop();
          builder.pushINode("Metrics and Reports", type.folder, oid++); builder.pop();
          builder.pushINode("Monitor Visits", type.folder, oid++); builder.pop();
          builder.pushINode("Subjects", type.folder, oid++);
            builder.pushINode("AAA:1001.1", type.folder, oid++); builder.pop();
            builder.pushINode("BBB:1001.1", type.folder, oid++); builder.pop();
            builder.pushINode("CCC:1001.1", type.folder, oid++);
              builder.pushINode("Screening", type.folder, oid++);
                builder.pushLNode("Demographics", type.demographics, oid++);
                builder.pushLNode("Inclusion Criteria", type.folder, oid++);
                builder.pushLNode("Exclusion Criteria", type.folder, oid++);
              builder.pop();
              builder.pushINode("Baseline", type.folder, oid++); builder.pop();
              builder.pushINode("Cycle-1", type.folder, oid++); builder.pop();
              builder.pushINode("Cycle-2", type.folder, oid++); builder.pop();
              builder.pushINode("Cycle-3", type.folder, oid++); builder.pop();
              builder.pushINode("Cycle-4", type.folder, oid++); builder.pop();
              builder.pushINode("Cycle-5", type.folder, oid++); builder.pop();
              builder.pushINode("Adverse Events", type.folder, oid++); builder.pop();
            builder.pop();
            builder.pushINode("DDD:1001.1", type.folder, oid++); builder.pop();
          builder.pop();
        builder.pop();
        builder.pushINode("Linder", type.folder, oid++);
            

  obe.test.data.navigator.set001= builder.getResult();
})();//(function(){

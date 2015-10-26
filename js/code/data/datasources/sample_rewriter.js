/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.data.datasources.sample_rewriter");

dojo.require("dojox.data.QueryReadStore");

dojo.declare(
    "dojobook.data.datasources.sample_rewriter", 
    dojox.data.QueryReadStore, {

    fetch:function(request) {
        request.serverQuery = {
           q: request.query.substance.replace("*", "%"),
           itemsperpage: request.count,
           page: Math.floor(request.start / 10)
        };
         
        // Call superclasses' fetch
        return this.inherited(arguments);
    }
});
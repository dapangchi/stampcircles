/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.tree.datasources.OrderXmlStore");

dojo.require("dojox.data.XmlStore");

dojo.declare("dojobook.tree.datasources.OrderXmlStore",
    dojox.data.XmlStore,  {
        // This new store adds Identity
        getFeatures: function(){
            return {
                'dojo.data.api.Read': true,
                'dojo.data.api.Identity': true
            };
        },
        
        // Identity value for top level nodes
        getIdentity: function (item) {
           return this.getValue(item, "orderNumber");
        },
        
        // Array of attribute names making up id
        getIdentityAttributes: function(item) {
           return [ "orderNumber" ];
        },
        
        fetchItemByIdentity: function(keywordArgs) {
           /* This API is not needed for Tree */
           console.error("FetchItemByIdentity unimplemented");
        }
    }
);
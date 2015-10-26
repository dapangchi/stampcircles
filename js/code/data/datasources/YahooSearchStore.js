/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.data.datasources.YahooSearchStore");

dojo.require("dojo.data.util.simpleFetch");
dojo.require("dojo.io.script");


dojo.declare("dojobook.data.datasources.YahooSearchStore", null, {
    searchTerms: "",

    constructor: function(args){
        if (args && args.searchTerms) { 
            this.searchTerms = args.searchTerms;
        }
    },



    _searchUrl: "http://search.yahooapis.com/WebSearchService/V1/webSearch",

    // A reference to the store is kept in every item in the _S attribute. That
    // way, we catch errors with items being passed to us from different stores.
    _storeRef: "_S",

    getFeatures: function(){
        return {
            'dojo.data.api.Read': true
        };
    },

    getAttributes: function(item){
        // These are all the interesting properties coming back
        // from Yahoo
        return ["Url", "Title", "Summary"]; 
    },



    _processSearchData: function(data){
        // Default to empty store
        var items = [];
        if(data.ResultSet){
            // The ResultSet field comes back as an array of Result objects
            items = data.ResultSet.Result;
            //Add on the store ref so that isItem can work.
            var storeObject = this;
            dojo.forEach(items, function(item) {
               item[storeObject._storeRef] = storeObject;
            });
        }
        return items;
    },




    _fetchItems: function(request, fetchHandler, errorHandler){
        if(!request.query){
            request.query={};
        }

        //Build up the content to send the request for.
        var content = {
            appid: "DEMO", 
            query: this.searchTerms,  
            output: "json"
        };

        // self is pulled into handler by closures.
        var self = this;

        var deferred = dojo.io.script.get({
            url: this._searchUrl,
            content: content,
            callbackParamName: 'callback',
            handle: function(data){
	            // Process the items.  fetchHandler is a reference to
	            // a function that simpleFetch passes here
	            fetchHandler(self._processSearchData(data), request);
            }
        });
        
        deferred.addErrback(function(error){
            errorHandler(error, request);
        });
    },

    // HTTP requests don't need closing
    close: function(request){ },

    

    isItem: function(item){
        return item && item[this._storeRef] === this;
    },
    
    // The following two functions are used for lazy-loading
    // data stores who fetch only the identifiers up front, then
    // fill in the rest as they're accessed.  YahooSearchStore does not
    // lazy-load, so these are trivial.
    
    isItemLoaded: function(item){
         return this.isItem(item);
    },

    // loadItem
    loadItem: function(keywordArgs){ },






    getValues: function(item, attribute){
        //  summary: 
        //      See dojo.data.api.Read.getValue()

        if(!this.isItem(item)){ 
            throw new Error("YahooSearchStore: invalid item");
        }
        if(typeof attribute !== "string"){ 
            throw new Error("YahooSearchStore: invalid attribute");
        }
        
        try {
            return [ item[attribute] ];
        } catch (e) {
            return [];
        }
    },

    getValue: function(item, attribute){
        // Basic read out of the items array 
        var values = this.getValues(item, attribute);
        return values.length == 0 ? undefined : values[0];
    },

    hasAttribute: function(item, attribute){
        // We simply look up the attribute
        return this.getValues(item,attribute) > 0;
    },

    containsValue: function(item, attribute, value){
        var values = this.getValues(item,attribute);
        return dojo.some(values, function(thisValue) {
            return thisValue == value;
        });
    }


// End of the dojo.declare for YahooSearchStore
});

dojo.extend(
   dojobook.data.datasources.YahooSearchStore, 
   dojo.data.util.simpleFetch
);
                                         

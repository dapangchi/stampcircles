/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.grid.grid_definitions.filters");

dojo.require("dijit.form.FilteringSelect");

dojobook.grid.grid_definitions.filters.structure = [
  
  // View #2: The data 
  {
    cells: [
        [
            {name: 'Flavor', field:"name", width:'10em'}, 
            {name: 'Base Flavor', field:"baseFlavor"},
            {name: 'Calories', field:"calories"},
            {name: 'Fat', field:'fat'}
        ],
        [ 
            {name: 'Add-Ins', field:"mixins",
             width:'15em', colSpan:4}
        ]
    ]
  }
];


dojobook.grid.grid_definitions.filters.applyFilter = function () {
   var currentValueBox = dojo.byId("filterContainer");
   var currentValue = 
       currentValueBox.options[currentValueBox.selectedIndex].text;
   icGrid.model.query = { baseFlavor: currentValue || '*' };
   icGrid.model.refresh();
}



dojobook.grid.grid_definitions.filters.loadFilter = function() {
    // Store our filter values in a sorted set to automatically take
    // care of duplicates
    var filterHash = {};
    // The store is already set, so do a fetch on it
    
    icStore.fetch({
        query: { name: "*" },
        onItem: function(theItem) {
           // Fires on each item.  Set filterHash["vanilla"] 
           // to true on seeing a vanilla baseFlavor 
           filterHash[theItem.baseFlavor[0]] = true;
        },
        onComplete: function() {
           // Fires at the end of all loading.  First push the 
           // baseFlavors into an array
           var sortedFilters = [];
           for (baseFlavorName in filterHash) {
              sortedFilters.push(baseFlavorName);
           }
           
           // Sort them
           sortedFilters.sort();
           
           // And create an option for each one
           var filterBox = dojo.byId("filterContainer").options;
           dojo.forEach(sortedFilters, function(bf) {
              filterBox[filterBox.length]= new Option(bf);
           });
           
           // And finally, connect it to a filtering event
           dojo.connect(dojo.byId("filterContainer"), 'change', 
                dojobook.grid.grid_definitions.filters.applyFilter);
        }
    });
    
};

dojo.addOnLoad(dojobook.grid.grid_definitions.filters.loadFilter);



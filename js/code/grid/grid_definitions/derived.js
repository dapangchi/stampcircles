/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.grid.grid_definitions.derived");

(function() {
   var gd=dojobook.grid.grid_definitions.derived;
   
   gd.getCaloriesPerFatGram = function(inRowIndex) {
      // This is standard for many grid handlers
      if (!icGrid) { return; }
      
      var currentRow = icGrid.model.getRow(inRowIndex);
      if (! currentRow)  // Skip header rows
          return; 

      return currentRow.calories / currentRow.fat;
   };
   
 
   gd.structure = [
      { // View #1: rowbar
         type: dojox.grid.GridView, width:"30px", noscroll:true
      },
      { // View #2: data
        cells: [ 
            [
                {name: 'Flavor', field:"name", width:'10em'}, 
                {name: 'Base Flavor', field:"baseFlavor"},
                {name: 'Calories', field:"calories"},
                {name: 'Fat', field:'fat'}
            ],

            [
                {name: 'Mixins', field:"mixins",colSpan:3},
                {name: 'Cal / Fat g', 
                 get: gd.getCaloriesPerFatGram
                }

            ]
        ]
      }
    ];

})();


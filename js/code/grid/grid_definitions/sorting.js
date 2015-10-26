/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.grid.grid_definitions.sorting");

(function() {
   var gs=dojobook.grid.grid_definitions.sorting;
   
   gs.structure = [ 
      // View #1 : The selection boxes
      {type: 'dojox.GridRowView', width: '20px'},
      
      // View #2: The data 
      {
        cells: [
            [
                {name: 'Flavor', field:"name", width:'10em'}, 
                {name: 'Base Flavor', field:"baseFlavor"},
                {name: 'Calories', field:"calories"},
                {name: 'Fat', field:'fat'}
            ]
        ]
      }
   ];

})();

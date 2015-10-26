/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.grid.grid_definitions.rowbar");

(function() {
   dojobook.grid.grid_definitions.rowbar.structure = [
      { // View #1: rowbar
         type: dojox.grid.GridView, width:"20px", noscroll:true
      },
      { // View #2: data
        cells: [ 
            [
                {name: 'Flavor', width:'10em', field:"name"}, 
                {name: 'Base Flavor', width:'7em', 
                        field:"baseFlavor"},
                {name: 'Calories', width:'5em', 
                        field:"calories"},
                {name: 'Fat', width:'5em', field:'fat'}
            ]
            // Other subrow removed for this example only
        ]
      }
    ];
})();

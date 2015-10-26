/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.grid.grid_definitions.editors");

dojo.require("dijit.form.DateTextBox");

(function() {
    
    dojobook.grid.grid_definitions.editors.structure = [
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
                 width:'15em', colSpan:2},
                
                { name: 'Rating', field:"rating",
                  editor: dojox.grid.editors.Dijit,
                  editorClass: "dijit.form.NumberTextBox",
                  constraint: {min:1, max:5},
                  editorProps: {required:true}
                },
                
                
                { name: 'Source', field:'source',
                  editor: dojox.grid.editors.Select,
                  options: ['Restaurant', 'Qwik-E Mart', 'Wegmans' ],
                  values: [ 1, 2, 3 ],
                  formatter: function(inDatum) {
                     return this.options[inDatum - 1];
                  }
                }
                
            ]
        ]
      }
    ];
    
})();    
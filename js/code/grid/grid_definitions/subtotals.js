/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.grid.grid_definitions.subtotals");

(function() {
   var gs=dojobook.grid.grid_definitions.subtotals;
   
   // Here are our running totals
   gs.baseFlavorAveraged = null; 
   gs.currentBaseFlavor = null;
   gs.flavorTotalCal = 0;
   gs.flavorGroupCount = 1;


   gs.runningAverage = function(inDataIndex, inSubrows) {
      if (!icGrid) { return; }

      // Turn off the subrow initially, making rendering a bit faster.
      inSubrows[0].hidden = true; 

    
      var currentRow = icGrid.model.getRow(inDataIndex);
      if (! currentRow) { // Return on header row
         return;
      }

      // Calculate stats for the group to this point
      gs.flavorAvg = gs.flavorTotalCal / gs.flavorGroupCount; 
      gs.baseFlavorAveraged = gs.currentBaseFlavor;
              
      // If we're not on a new base flavor, increment the counts
      if (gs.flavorGroupCount==0  //  
             || gs.currentBaseFlavor == currentRow.baseFlavor) { 
          gs.flavorGroupCount++;
          gs.flavorTotalCal += currentRow.calories;
      } else { 
          
          // Unhide the row, except for the very first one  
          // (which totals nothing)
          if (gs.currentBaseFlavor)   
              inSubrows[0].hidden = false; 
          
          
          // Reset stats
          gs.flavorTotalCal = currentRow.calories;
          gs.flavorGroupCount = 1;
          gs.currentBaseFlavor = currentRow.baseFlavor;
      }
   };



   gs.structure = [
  // View #1 : The selection boxes
      {type: 'dojox.GridRowView', width: '20px'},
  
    
      // View #2: The data 
      {
        onBeforeRow: gs.runningAverage,
                    
        cells: [
            [
                { name: 'N/A', width:'10em', value:'<b>Avg for </b>'},
                { name: 'N/A', width:'7em', 
                  get: function() { return gs.baseFlavorAveraged;  } },
                { name: 'N/A', width:'5em', 
                  get: function() { return gs.flavorAvg;  } },
                { name: 'N/A', width:'5em', value:'' }
            ], 
            [
                {name: 'Flavor', width:'10em', field:"name" }, 
    
                {name: 'Base Flavor', width:'7em', field:"baseFlavor"},
                {name: 'Calories', width:'5em', field:"calories"},
                {name: 'Fat', width:'5em',  field:'fat'}
            ]
        ]
      }
    ];
    
})();   



/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

var burger = {patties: 2, type: "gardenburger", bun: "wheat"};
// displays the object structure in the Firebug console
console.dir(burger);



var burger2 = {};
burger2.patties = 2;
burger2.type = "gardenburger";
burger2.bun = "wheat";
// Should be exactly the same as previous example
console.dir(burger2);



var burger3 = {
    // an array literal
    patties: ["gardenburger", "bocaburger"], 
    toppings: {
        cheese: "American",
        meat: "bacon"
    },
    bun: "wheat"
};
console.dir(burger3);

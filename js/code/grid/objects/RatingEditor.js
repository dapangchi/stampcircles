/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.grid.objects.RatingEditor");

dojo.require("dojox.grid._data.dijitEditors");
dojo.require("dojox.widget.Rating");


dojo.declare("dojobook.grid.objects.RatingEditor", dojox.grid.editors.Dijit, {
    editorClass: "dojox.widget.Rating",
    getEditorProps: function(inDatum){
        return {numStars: 5, onChange:function(value) { this.editor._renderStars(value, true); } };
    }/*,
    formatNode: function(inNode, inDatum, inRowIndex){
        this.inherited(arguments);
        this.editor._renderStars(value, true);
    }*/
});



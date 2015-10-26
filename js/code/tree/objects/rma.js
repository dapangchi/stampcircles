/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.tree.objects.rma");

dojo.require("dijit._tree.dndSelector");
dojo.require("dojo.dnd.Manager");

dojo.declare("dojobook.tree.objects.rma", null, {
    // Data store associated with the return, will contain boxes
    // and serial numbers
    store: null,
    
    // Keep the dndSource controller for this tree.
    dndController: null,
    
    // Generator for unique box id's
    highestBoxId: 1,
   
    // For use in Delete and Rename
    lastBoxSelected: null,
   
    // Serial numbers already in the return
    allRMASerials: [ ],
   
    // Box weight limit, imposed by our shipper
    MAX_WEIGHT: 15,
    
    // Constructor
    constructor: function(dataStore, inDndController) {
       this.store = dataStore;
       this.dndController = inDndController;
    },


    // Handy method for computing dojo.data item connected to a DOM node
    domToItem: function(domNode) {
       return dijit.getEnclosingWidget(domNode).item;
    },



    boxDrop: function(source, nodes, copy) {
        // The DnD controller contains the drop target (the box).
        // For convenience, convert this to an item
        var targetBoxItem = this.domToItem(this.dndController.current);
        
        // The weight is init'ed to zero and we add weight as items
        // are dropped into it.
        var currentBoxWeight = this.store.getValue(targetBoxItem, "weight");
        
        // Handle more than 1 serial number, if needed
        for (var i=0;i<nodes.length;i++) {
            // Convert to an item
            var draggedItem = this.domToItem(nodes[i]);
            // Remember the serial number
            this.allRMASerials.push(ordJson.getValue(draggedItem,"id"));

            // Add the weight of this serial, obtaining the weight from
            // the order item               
            var thisSerialWeight = 
                parseInt(ordJson.getValue(draggedItem,"weight"));
            currentBoxWeight += thisSerialWeight;
        }
        this.store.setValue(targetBoxItem, "weight", currentBoxWeight);
                
        // Store it back in the item store.  
        if(this.dndController.containerState == "Over"){
            // Stop dragging
            this.dndController.isDragging = false;
            
            // Create a new dropped item in the target
            var items = this.dndController.itemCreator(
                nodes, 
                this.dndController.current
            );
            
            // Create a data store item for each dragged serial number
            // The tree then changes to match it.
            for(var i = 0; i < items.length; i++){
                pInfo = {parent: targetBoxItem, attribute: "children"};
                var newItem = this.store.newItem(items[i], pInfo);
            }
        }
        
        // Cancel all other event handlers
        this.dndController.onDndCancel();
    },



    itemAccept: function(target, source) {
        // First make sure we're dropping on a box, not another serial #
        targetBoxItem = this.domToItem(target);
       
        // There is no item connected with the root
        if (! targetBoxItem) {
            return false;
        }
           
        // Only boxes have a type attribute
        if (! boxJson.hasAttribute(targetBoxItem, "type")) {
            return false;
        }
       
        // Loop through all the dragged nodes.  See the DnD chapter
        // for details on the .selection property
        var draggedSerials = source.selection;
        var draggedWeight = 0;
        for (thisSerial in draggedSerials) {
            // If any serial number has already been moved, don't let it
            // be moved again.
            if (dojo.indexOf(this.allRMASerials, thisSerial) > -1)
                return false;

            // Get the item weight, and add it to the dragged item weight
            var serialItem = this.domToItem(draggedSerials[thisSerial]);
            var thisSerialWeight = parseInt(ordJson.getValue(serialItem,"weight"));
            draggedWeight += thisSerialWeight;             
        }
                  
        // Finally, add up all the weights and make sure they're OK
        if (parseInt(this.store.getValue(targetBoxItem,"weight")) 
             + draggedWeight > this.MAX_WEIGHT) {
            return false;
        }
           
        // Everything is fine           
        return true;
     },



    addBox: function() {
       this.highestBoxId++;
       this.store.newItem({
           id: this.highestBoxId,
           name: "Box "+this.highestBoxId,
           type: "box",
           weight:0 
       });
    },
    
    removeBox: function() {
       if (!this.lastBoxSelected || !this.store.isItem(this.lastBoxSelected)) {
           alert('You must select a box first');
           return;
       }
       this.store.deleteItem(this.lastBoxSelected);    
    },
    
    renameBox: function() {
       if (!this.lastBoxSelected || !this.store.isItem(this.lastBoxSelected)) {
           alert('You must select a box first');
           return;
       }
       if (newName = prompt("What would you like to call it?")) {
           this.store.setValue(this.lastBoxSelected,"name",newName);
       }
    }

});

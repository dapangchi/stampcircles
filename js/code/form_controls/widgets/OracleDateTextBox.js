/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.form_controls.widgets.OracleDateTextBox");
dojo.require("dijit.form.DateTextBox");

dojo.declare("dojobook.form_controls.widgets.OracleDateTextBox",
             [dijit.form.DateTextBox], {

    postMixInProperties: function() {
        this.inherited(arguments);
        if(this.srcNodeRef) {  // If the widget was created declaratively
        
            // The postMixInProperties in superclasses have ISO parsing built
            // in.  So here we overwrite the parsed value.
            var unparsedValue = this.srcNodeRef.getAttribute('value');
            if(unparsedValue) {
                var dateFromOracle = dojo.date.locale.parse(
                    unparsedValue, 
                    {selector:'date', datePattern: 'dd-MMM-yyyy'}
                );
                this.value = dateFromOracle;
            }
        }
    },
    // Returns date in dd-MMM-yyyy to the server
    serialize: function(d, options) {
        return dojo.date.locale.format(
            d, {selector:'date', datePattern:'dd-MMM-yyyy'}
        );
    }
});


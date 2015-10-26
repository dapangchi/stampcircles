/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.creating_widgets.widgets.ClosedTitlePane");

dojo.require("dijit.TitlePane");

dojo.declare(
"dojobook.creating_widgets.widgets.ClosedTitlePane",
[dijit.TitlePane],
{
    open: false
}
);

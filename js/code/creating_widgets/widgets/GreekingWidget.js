/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

// dojo programmatic Greeking Widget
// Thank you, Agent Zlerich for 0.4 code!  Adapted for Dojo 1.0 by authors.
// See http://agentzlerich.blogspot.com
//             /2007/06/programmatic-greekingwidget-for-dojo.html
// for original post and usage examples
dojo.provide("dojobook.creating_widgets.widgets.GreekingWidget");

dojo.require("dijit._Widget");

dojo.declare(
'dojobook.creating_widgets.widgets.GreekingWidget', 
[dijit._Widget], 
{
    // Number of paragraphs to generate
    paragraphs: 3,

    // Length of each paragraph in sentences
    sentencesPer: 7,

    // If true, always start with "Lorem Ipsum..." 
    loremIpsum: false,

    // CSS class to apply to each paragraph
    addClass: "",

    // Tag to use for surrounding each paragraph
    tag: "p",
    
    // The heart is in the postCreate extension pt.
    
    postCreate: function () {

        // Rudimentary error checking
        if (this.paragraphs < 1) {
            throw new Error("paragraphs < 1");
        } else if (this.sentencesPer < 1) {
            throw new Error("sentencesPer < 1");
        }

        // The sentences[] array has Greek sentences.  Pick
        // a random starting place, or start at 0 for 
        // the classic "Lorem Ipsum..."
        var sentenceOffset;
        if (this.loremIpsum) {
            sentenceOffset = 0;
        } else {
            sentenceOffset = Math.floor(Math.random() * this.sentences.length);
        }

        // Create each "paragraph" as a DOM node
        for (var p = 0; p < this.paragraphs; p++) {
            var paraNode = dojo.doc.createElement(this.tag);
            
            // Print sentencesPer sentences sequentially, wrapping
            // to the first of the array if necessary
            for (var s = 0; s < this.sentencesPer; s++) {
                paraNode.appendChild(document.createTextNode(
                    this.sentences[sentenceOffset] + "  "
                ));
                sentenceOffset = (sentenceOffset + 1) % this.sentences.length;
            }
            
            // Attach a CSS style, if needed, then add to the page 
            if (this.addClass.length > 0) {
                dojo.addClass(paraNode, this.addClass);
            }
            this.domNode.appendChild(paraNode);
        }
    },

    sentences: [
        "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
        "Donec eleifend.",
        "Morbi tincidunt, neque ac consequat condimentum, nibh purus bibendum.",
        // Download code sample to get the entire set of sentences!

        "Suspendisse consequat ornare velit.",
        "Nam diam tellus, gravida a, placerat pretium, nonummy luctus, lectus.",
        "Etiam sed est.",
        "Nullam augue erat, varius ut, congue lacinia, aliquam in, neque.",
        "Phasellus eu tellus.",
        "Suspendisse potenti.",
        "Integer metus.",
        "Integer sed leo.",
        "Phasellus mollis, est sed bibendum aliquam, eros orci aliquam nunc, vel porta sapien dolor ut diam.",
        "Curabitur id ante at lectus malesuada congue.",
        "Praesent bibendum tortor vel mauris.",
        "Duis massa.",
        "In hac habitasse platea dictumst.",
        "Morbi aliquet.",
        "Nam quis neque.",
        "Curabitur dui ipsum, tristique eu, dignissim a, bibendum sit amet, nisi.",
        "Ut id nunc.",
        "Donec mauris sem, dignissim quis, hendrerit id, rhoncus ut, ipsum.",
        "Nam rutrum.",
        "Vivamus dolor pede, dapibus sit amet, ultrices eget, congue et, justo.",
        "Duis vulputate, turpis id hendrerit vestibulum, tellus felis tempus nibh, non sollicitudin sapien lectus dignissim sapien.",
        "Nullam mollis, ligula ac iaculis venenatis, nisi odio molestie neque, eu sodales leo nisi sit amet diam.",
        "Vestibulum quam.",
        "Nulla facilisi.",
        "Donec quis diam.",
        "Aliquam erat volutpat.",
        "Donec neque sem, suscipit eget, dictum eu, commodo et, sapien.",
        "Vivamus sodales, lorem in sollicitudin tristique, odio quam euismod neque, a vulputate magna libero at lacus.",
        "Duis vulputate.",
        "Quisque euismod felis.",
        "Nam felis purus, facilisis et, ornare id, gravida in, nisi.",
        "Quisque id velit a sapien feugiat pulvinar.",
        "Vestibulum malesuada diam vel nisi.",
        "Cras non lacus sit amet mi ultricies mollis.",
        "Duis imperdiet, odio in consectetuer interdum, felis ligula tempus justo, tincidunt accumsan nunc urna sit amet dolor.",
        "Donec elementum magna convallis tortor.",
        "Mauris varius, lacus vitae sagittis pulvinar, orci ante fermentum dui, vitae fringilla augue mi a nibh.",
        "Suspendisse id urna et elit dignissim lobortis.",
        "Vivamus at augue.",
        "Nullam scelerisque fermentum turpis.",
        "Proin risus.",
        "Nullam rhoncus purus id turpis.",
        "Praesent aliquam adipiscing ligula.",
        "Aenean lorem ante, accumsan quis, elementum id, cursus eu, lorem.",
        "Fusce viverra.",
        "Ut tempor nisi at ipsum.",
        "Etiam sed nibh.",
        "In varius, metus sit amet accumsan tincidunt, neque massa tincidunt nunc, nec mollis leo enim at mi.",
        "Sed scelerisque, augue ac consectetuer dictum, neque sapien consectetuer est, sit amet molestie lectus felis eget felis.",
        "Morbi non ligula.",
        "Donec diam.",
        "Phasellus eget tellus eu augue elementum consectetuer.",
        "Cras porttitor.",
        "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.",
        "Suspendisse convallis.",
        "Quisque euismod semper felis.",
        "Suspendisse sollicitudin convallis erat.",
        "Etiam in diam.",
        "Integer sollicitudin risus a massa.",
        "Integer laoreet.",
        "Phasellus enim velit, porttitor et, commodo iaculis, mattis ut, turpis.",
        "Mauris eu quam.",
        "Phasellus odio.",
        "Praesent feugiat, orci pretium dictum scelerisque, diam odio pretium sem, vel posuere elit lorem eget pede.",
        "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
        "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.",
        "Fusce pharetra accumsan sapien.",
        "Mauris dapibus.",
        "Aenean id urna sit amet risus semper consectetuer.",
        "Quisque venenatis ornare purus.",
        "Ut lacus dui, lacinia nec, ullamcorper ullamcorper, vulputate pulvinar, turpis.",
        "Quisque odio.",
        "In hac habitasse platea dictumst.",
        "Morbi ante metus, sodales a, tempor a, aliquet a, pede.",
        "In quis lectus.",
        "Vestibulum tincidunt posuere lectus.",
        "Sed imperdiet est a nibh.",
        "Aenean tincidunt accumsan elit.",
        "Vestibulum consequat molestie ipsum.",
        "Vestibulum scelerisque semper lorem.",
        "Vestibulum vitae leo.",
        "Quisque nibh turpis, condimentum non, iaculis ut, malesuada nec, augue.",
        "Vestibulum hendrerit nulla vel erat.",
        "Maecenas eleifend pulvinar metus.",
        "Nulla facilisi.",
        "Vestibulum nulla.",
        "Pellentesque vehicula elementum ligula.",
        "Integer vestibulum risus vel sapien."
    ]

});

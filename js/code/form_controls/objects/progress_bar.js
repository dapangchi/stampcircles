/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
dojo.provide("dojobook.form_controls.objects.progress_bar");

(function() {
    dojobook.form_controls.objects.progress_bar.download = function(){
        // Split up bar into 7% segments
        numParts = Math.floor(100/7);
        jsProgress.update({ maximum: numParts, progress:0 });

        for (var i=0; i<=numParts; i++){
            // This plays update({progress:0}) at 3nn milliseconds, 
            // update({progress:1}) at 6nn milliseconds, etc.
            _timer = setTimeout(
               "jsProgress.update({ progress: " + i + " })",
               (i+1)*300 + Math.floor(Math.random()*300)
            );

        }
    }
})();
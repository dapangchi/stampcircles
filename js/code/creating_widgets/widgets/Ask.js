/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/

dojo.provide("dojobook.creating_widgets.widgets.Ask");

dojo.require("dijit._Widget");
dojo.require("dijit._Templated");
dojo.require("dojo.io.script");
dojo.require("dijit.Tooltip");


dojo.declare(
"dojobook.creating_widgets.widgets.Ask",
[dijit._Widget, dijit._Templated],
{
    templatePath: dojo.moduleUrl("dojobook", 
             "creating_widgets/templates/Ask.html"),
    
    postCreate: function(){
       // Don't do anything because all the magic happens in _getQuestions
    },
    

   _getQuestions: function() {
       // Through JavaScript closures, this variable allows us to reference the 
       // surrounding object from within the get(...) methods.
       var hookedTo = this;

       // Go to Yahoo Answers for relevant questions
       dojo.io.script.get({
           // URL for Yahoo Relevant Questions 
           url: "http://answers.yahooapis.com/AnswersService/V1/questionSearch",
    
           // Send search term parameters.  The appid is the one you obtained for
           // chapter 3's example.
           content: {
               appid: "DEMO",
               /* The search term we're sending is the body of the tag */ 
               query: hookedTo.containerNode.innerHTML,  
               output: "json",
               results: 3,
               /* Look only in the questions for the term, not the answers */
               search_in: "question"
           },      
    
           // If the response takes longer than 10000ms (= 10 seconds), error out
           timeout: 10000,
    
           // Yahoo API requires you to send the callback function name in the 
           // parameter "callback"
           callbackParamName: "callback",

           // Function run when Yahoo returns with the answer
           load: function(results) {
              // Build the tooltip text
              var questionTooltipHtml = "<ul>";
              dojo.forEach(results.all.questions, function(question) {
                 questionTooltipHtml += 
                     dojo.string.substitute(
                         "<li><a href='${Link}'>${Subject}</a>"+
                         "<br/>${Content}</li>", 
                         question
                     );
              }); 

              // Create a tooltip
              questionTooltipHtml += "</ul>";
              dijit.showTooltip(
                 questionTooltipHtml,
                 hookedTo.domNode
              );
           },
    
          // And this is the callback used when a web service communication 
          // error or timeout occurs.  Note that errors returned from Yahoo
          // in the response are still handled with load()
          error: function(text) {
             alert("An error has occurred.");
             return text;
          }
      });
   }  // End of _getQuestions

});

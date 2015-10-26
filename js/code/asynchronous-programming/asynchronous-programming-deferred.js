/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
function(){


//implements a display engine: 
//display the data given by query in the panel given by panelId
function display(panelId, query){

  //displayInfo is a shared bookkeeping area
  var displayInfo = {
    panelId: panelId,
    query: query,
    processCompleteCount: 0
  };
  
  //get an HTML div in which to place the panel
  //allocatePanel is provided by the pane management logic of our application
  displayInfo.div = allocatePanel(displayInfo);
  
  //TODO #1
  //make an asynchronous call to get the data
  //after the asynchronous call finishes,
  //continue by calling continueWithData
  
  //TODO #2
  //make an asynchronous call to get the metadata
  //after the asynchronous call finishes,
  //continue by calling continueWithMetadata
  
  //process the data as far as we can without the metadata
  function continueWithData(data){
    //put the data in an application-wide cache 
    //for use with other requests
    //no need to wait for the metadata to do this!
    cacheData(data);
    
    //save quick access to the data
    displayInfo.data = data;
    
    finishDisplay();
  }
  
  //process the metadata as far as we can without the data
  function continueWithMetadata(metadata){
    //set up the HTML and other control structures 
    //given by the metadata
    //no need to wait for the data to do this!
    preparePanel(metadata);
    
    //save quick access to the metadata
    displayInfo.metadata = metadata;
    
    finishDisplay();
  }
  
  //when continueWithData and continueWithMetadata have completed,
  //finish with the display process
  function finishDisplay(){
    //TODO #3
  }
}




//TODO #1 partial implementation...
displayInfo.dataDeferred= new dojo.Deferred();
displayInfo.dataDeferred.addCallback(continueWithData);
//still TODO:
//somehow, get the data asynchronously and signal
//displayInfo.dataDeferred when this completes

//TODO #2 partial implementation...
displayInfo.metadataDeferred= new dojo.Deferred();
displayInfo.metadataDeferred.addCallback(continueWithMetadata);
//still TODO:
//somehow, get the metadata asynchronously and signal
//displayInfo.metadataDeferred when this completes



//TODO #1 implementation...
displayInfo.dataDeferred= new dojo.Deferred();
displayInfo.dataDeferred.addCallback(continueWithData);
makeAsynchronousServerDataCall(displayInfo.dataDeferred, query);

//TODO #2 implementation...
displayInfo.metadataDeferred= new dojo.Deferred();
displayInfo.metadataDeferred.addCallback(continueWithMetadata);
makeAsynchronousServerMetadataCall(displayInfo.metadataDeferred, panelId);



//when continueWithData and continueWithMetadata have completed,
//finish with the display process
function finishDisplay() {
  //TODO #3 implementation...
  displayInfo.processCompleteCount++;
  if (displayInfo.processCompleteCount==2) {
    //both have completed...
    populatePanelWithData(displayInfo);
    releasePanelToUser(displayInfo);
  }
}




//important: this is put inside the function display()
function getData() {
  displayInfo.dataDeferred= new dojo.Deferred();
  displayInfo.dataDeferred.addCallback(continueWithData);
  displayInfo.dataDeferred.addErrback(handleDataError);
  makeAsynchronousServerDataCall(displayInfo.dataDeferred, query);
}

  

//important: this is put inside the function display()

//informs the user that an error occurred retrieving the data
//gives the user the option to retry or cancel
function handleDataError(){
  giveRetryCancelMessage(
    "The server failed to deliver the data.",
    getData,     //retry function
    function() { //cancel function
      doCancel(displayInfo.dataDeferred);
    }   
  );
}



//Important: this function is put inside the function display().
function doCancel(theDeferred) {

  //execute this routine for the first Deferred canceled only...
  if (!displayInfo.dataDeferred) {
    return;
  }
  
  //figure out which Deferred was canceled and take
  //a reference to the other Deferred
  var temp= displayInfo.dataDeferred==theDeferred ? 
    displayInfo.metadataDeferred : displayInfo.dataDeferred;
  
  //ensure this routine is executed only once
  displayInfo.dataDeferred= null;
  displayInfo.metadataDeferred= null;
  
  //cancel the other Deferred
  temp.cancel();
  
  //clean up the display
  destroyPanel(displayInfo);
}



displayInfo.dataDeferred= new dojo.Deferred();


displayInfo.dataDeferred= new dojo.Deferred(doCancel);



//informs the user that an error occurred retrieving the metadata
//gives the user the option to retry or cancel
function handleDataError(){
  if (displayInfo.dataDeferred) {
    giveRetryCancelMessage(
      "The server failed to deliver the data.",
      getData,     //retry function
      function() { //cancel function
        doCancel(displayInfo.dataDeferred);
      }   
    );
  } else {
    //the process was canceled
  }
}

}



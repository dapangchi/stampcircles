var a=100;
log('Loaded via Ajax value of a = ',a);
$('#msg1').text(a);

// perform JavaScript after the document is scriptable.
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div");
});
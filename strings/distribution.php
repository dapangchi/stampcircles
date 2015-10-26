<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="keywords" content="Semantic forms, standards, webstandards, semantically, horizontal forms">
<meta name="author" content="Chris Ramakers @ Skyrocket.be"><title>Horizontal Forms symantically</title>

<?php include('BusinessAutomation.php'); ?>

</head><body>
<h1>Document Control - Distribution Lists</h1>
<?php include('menu.php') ?>

<div class="form-wrapper" style="width:auto;float:left">
<div class="active" style="border:1px solid #bebebe;width:12em;border-bottom:none;background:#4F4F00;
            font-weight:bold;font-size:1.5em;float:left"><a href="distribution.php" class="tab-link">Add Distribution List</a></div>
<div class="inactive" style="border:1px solid #bebebe;width:12em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="distribution-view.php" class="tab-link">View Distribution Lists<a></div>

<div class="inactive" style="border:1px solid #bebebe;width:5em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="distribution-notes.php" class="tab-link">Notes<a></div>           
            
<div style="clear:both"></div>            
<form id="theform" action="action.php" enctype="multipart/form-data" method="post">
<a href="#" style="float:right;padding-right:2em;color:#ffffff">print</a>
	<fieldset id="pt2">
		<legend><span>Step </span>1. <span>: Distribution List details</span></legend>
		<h3>Distribution List details Details.</h3>
		
		<label for="Reference">Reference</label>
		<input id="reference" tabindex="1" type="text" value="DRG-EXTERNAL">
 </fieldset>
	
	
	
	<fieldset id="pt2">
		<legend><span>Step </span>2. <span>: Document Origin</span></legend>
		<h3>Select Company.</h3>
		<div id="sortable-list-wrapper" style="background:#666600;">
		<input id="password1" tabindex="2" type="checkbox"><span class="list-label" style="color:#000000">HEE</span><br />
		<input id="password2" tabindex="3" type="checkbox"><span class="list-label">Architect</span><br />
		<input id="password1" tabindex="2" type="checkbox"><span class="list-label">Structural Engineer</span><br />
	  <input id="password1" tabindex="2" type="checkbox"><span class="list-label">Files</span><br />
	  <input id="password1" tabindex="2" type="checkbox"><span class="list-label">Other</span><br />
	  <input id="password1" tabindex="2" type="checkbox"><span class="list-label">Other</span><br />
	  </div>
	  
	
	</fieldset>
	
	<fieldset id="pt3" style="width:20em">
		<legend><span>Step </span>3. <span>: Edit Company Details if Necessary</span></legend>
		<h3>Edit Company Details if necessary.</h3>
		<div id="sortable-list-wrapper" style="background:#666600;height:200px">
		Allow for Ajax call to view the Company details, when a checkbox is clicked, or when
		the name of the Company is clicked. This Panel should have buttons and the like to enable the user
		to add a Company in the address book without leaviing the screen.
	  </div>
	  
	
	</fieldset>
	
	
	<fieldset id="pt4">
		<legend>Step 4  : Submit form</legend>
		<h3>Terms of Service</h3>
		<div id="disclaimer">By clicking the &#8220;Complete Check-out&#8221; button,
			the distribution list will be added.
			(Notes for Developer: The Reference should do validation and error trapping that the code does not exist.)
			
			
			</div>
		<input id="submitform" tabindex="6" value="Complete Document Check-In »" type="submit">
	</fieldset>
	<?php include('footer.php') ?>
</form>
</div>

</div>


</body></html>
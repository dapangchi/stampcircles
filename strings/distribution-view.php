<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="keywords" content="Semantic forms, standards, webstandards, semantically, horizontal forms">
<meta name="author" content="Dr Y Lazarides"><title>Document Control Center - View Distribution Lists</title>

<?php include('BusinessAutomation.php'); ?>
</head>
<body>
<h1>Document Control - Distribution Lists</h1>
<?php include('menu.php') ?>

<div class="form-wrapper" style="width:auto;float:left">
<div class="inactive" style="border:1px solid #bebebe;width:12em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="distribution.php" class="tab-link">Add Distribution List<a></div>
<div id="tab-active" style="border:1px solid #bebebe;width:12em;background-color:#4F4F00;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left">View Distribution Lists</div>
<div class="inactive" style="border:1px solid #bebebe;width:5em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="distribution-notes.php" class="tab-link">Notes<a></div>            
<div style="clear:both"></div>            
<form id="theform" action="action.php" enctype="multipart/form-data" method="post">
<a href="#" style="float:right;padding-right:2em;color:#ffffff">print</a>
	<fieldset id="pt2">
		<legend><span>Step </span>1. <span>: Distribution List details</span></legend>
		<h3>Search Distribution Lists.</h3>
		
		<label for="Reference">Search</label>
		<input id="reference" tabindex="1" type="text" value="search">
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
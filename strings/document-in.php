<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="keywords" content="Semantic forms, standards, webstandards, semantically, horizontal forms">
<meta name="author" content="Chris Ramakers @ Skyrocket.be"><title>Horizontal Forms symantically</title>

<?php include('BusinessAutomation.php'); ?>

</head><body>
<h1>Document Control - Check In (Receive document)</h1>
<div class="wrapper1"> 
 <?php include('menu.php'); ?>

</div>

<div class="form-wrapper" style="width:auto;float:left">
<div id="tab-active" style="border:1px solid #bebebe;width:12em;border-bottom:none;background-color: #4F4F00;
            font-weight:bold;font-size:1.5em;float:left">Document Check In</div>
<div class="inactive" style="border:1px solid #bebebe;width:12em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="document-out.php" class="tab-link">Document Check Out</a></div>
 <div class="inactive" style="border:1px solid #bebebe;width:5em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="document-notes.php" class="tab-link">Notes</a></div>     
            
<div style="clear:both"></div>            
<form id="theform" action="action.php" enctype="multipart/form-data" method="post">
	<fieldset id="pt2">
		<legend><span>Step </span>1. <span>: Document details</span></legend>
		<h3>Document Details.</h3>
		<div class="help">The date and reference must be entered exactly as shown on the document.</div>
		<label for="loginname">Login / Sitename</label>
		<input id="loginname" tabindex="1" type="text">
		<label for="loginname">Reference</label>
		<input id="loginname" tabindex="1" type="text">
		<label for="loginname">Revision Number</label>
		<input id="loginname" tabindex="1" type="text">
 </fieldset>
	
	<fieldset id="pt3">
		<legend><span>Step </span>2. <span>: Document Origin</span></legend>
		<h3>Document Origin.</h3>
		<div class="help">Enter the source of the document e.g ADCC.</div>
		<label for="source">Document source</label>
		<input id="source" tabindex="4" type="text">
		
	</fieldset>
	
	<fieldset id="pt2">
		<legend><span>Step </span>3. <span>: Document Origin</span></legend>
		<h3>Document Details.</h3>
		<input id="password1" tabindex="2" type="checkbox"><span class="checkboxlabel">Submittal</span><br />
		<input id="password2" tabindex="3" type="checkbox"><span class="checkboxlabel">Method Statement</span><br />
		<input id="password1" tabindex="2" type="checkbox"><span class="checkboxlabel">Letter</span><br />
	  <input id="password1" tabindex="2" type="checkbox"><span class="checkboxlabel">Minutes</span><br />
	  <input id="password1" tabindex="2" type="checkbox"><span class="checkboxlabel">Specification</span><br />
	  <input id="password1" tabindex="2" type="checkbox"><span class="checkboxlabel">Other</span><br />
	
	</fieldset>
	
	
	
	<fieldset id="pt3" >
		<legend><span>Step </span>4. <span>: Tags</span></legend>
		<h3>Tags.</h3>
		<div class="help">Enter tags to help with searching, separate with commas.</div>
		<label for="email1">Email</label>
		<input id="email1" tabindex="4" type="text">
		<label for="email2">Repeat Email</label>
		<input id="email2" tabindex="5" type="text">
	</fieldset>
	
	<fieldset id="pt4">
		<legend>Step 4  : Submit form</legend>
		<h3>Terms of Service</h3>
		<div id="disclaimer">By clicking the &#8220;Complete Signup&#8221; button,
			I am attaching my electronic signature to and agreeing to the Squarespace
			Terms of Service Agreement; I understand that if I do not agree to these
			terms of use and privacy statements, I should refrain from using Squarespace.</div>
		<input id="submitform" tabindex="6" value="Complete Document Check-In »" type="submit">
	</fieldset>
	<?php include('footer.php'); ?>
</form>
</div>
</div>


</body></html>
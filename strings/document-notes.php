<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="keywords" content="Semantic forms, standards, webstandards, semantically, horizontal forms">
<meta name="author" content="Chris Ramakers @ Skyrocket.be"><title>Horizontal Forms symantically</title>

<?php include('BusinessAutomation.php'); ?>

</head><body>
<h1>Document Control - Check Out (Issue)</h1>
<?php include('menu.php'); ?>

<div class="form-wrapper" style="width:auto;float:left">
<div class="inactive" style="border:1px solid #bebebe;width:12em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="document-in.php" class="tab-link">Document Check In</a></div>
<div class="active" style="border:1px solid #bebebe;width:12em;border-bottom:none;
            font-weight:bold;font-size:1.5em;float:left"><a href="document-out.php" class="tab-link">Document Check Out</a></div>
 <div class="active" style="border:1px solid #bebebe;width:5em;border-bottom:none;background-color:#4F4F00;
            font-weight:bold;font-size:1.5em;float:left"><a href="document-notes.php" class="tab-link">Notes</a></div>           
<div style="clear:both"></div>            
<form id="theform" action="action.php" enctype="multipart/form-data" method="post">
	
	
	<fieldset style="width:80%">
		<?php include('dcc.notes'); ?>
	</fieldset>
	
	
	
	
	<div id="copyright">All content Copyright © 2003-2005, Squarespace, Inc. unless otherwise noted. All rights reserved.</div>
</form>
</div>
</div>


</body></html>
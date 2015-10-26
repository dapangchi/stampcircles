<?php

/**
 ** ----------------------------------------------------------------------
 ** HTML Attribute Functions - HTML Inputs in PHP Based
 ** ----------------------------------------------------------------------
 ** @Author - Joseph V. Guevara Jr.
 ** @Created Since - January 2008
 ** @Report Bugs - blowfish920@yahoo.com, jguevara920@hotmail.com
 **
 
 Some comments:
 
 1  separate logic from presentation.
 as far as possible. i.e any html you output should have class and id as a minimum
 2 use sprintf it makes things morre readable 
 3 Do not use deprecated attributes such as size=,width= etc use css
 4 use arrays as far as possible
 5 put more comments see comments in functions
 **/

require "class.crypto.php";

class CONTENTS extends CRYPTO {

	function text_fields($name,$id,$value,$size,$class=NULL,$option=NULL)
	//what is $option?Is it a separator for XHTML or HTML?ie /If yes should be in a config file and not
	//pass it through a function
	//you can have this defined on top
	//into an html properties array
	//$properties=array('accesskey'=>'accesskey="%s" ',
  /*                          'name'=>'name="%s" ',
                              'names'=>'name="%s" ',
                              'id'=>'id="%s" ',  
                              'value'=>'value="%s" ','onclick=.........;
  */ 
  /*small function
     foreach ($html_attribute) as $key value{
       $str.=$html_attribute[$key];
     }
   This should produce this
   "'text' name='john' id='john' value='165' size='size' class='class'";
  */                         
	//$s="<input %s >";
	//return $s=sprintf($s,$str);
	//advantages of this approach your routines become more general. If you want to add a tabkey property you can just define it on top and it will be in the function automaticall.
	//solve probelmes in their general form first. Then make them specific.
	//If this was done in this way the pass_field function would be redundant
	//if you want to add an onclick or onchange etc they will all be there!
	{
		if ($option == NULL)
			return "<input type='text' name='$name' id='$id' value='$value' size='$size' class='$class'>";
		else
			return "<input type='text' name='$name' id='$id' value='$value' size='$size' class='$class' $option>";
	}




	
	function pass_fields($name,$id,$value,$size,$class=NULL,$option=NULL)
	{
		if ($option == NULL)
			return "<input type='password' name='$name' id='$id' value='$value' size='$size' class='$class'>";
		else
			return "<input type='password' name='$name' id='$id' value='$value' size='$size' class='$class' $option>";
	}

	function select_fields($name,$size=NULL,$class=NULL,$field_id,$field_name,$table_name,$selected,$filter=NULL)
	{
		if ($filter == NULL)
			$query = "SELECT $field_id, $field_name FROM $table_name";
		else
			$query = "SELECT $field_id, $field_name FROM $table_name ORDER BY $filter";
		
		$result = mysql_query($query);
		
		if ($size == NULL)
			$x = "<select name='$name' class='$class'>";
		else
			$x = "<select name='$name' style='width:".$size."px' class='$class'>";
		
		while ($row = mysql_fetch_array($result)) {
			
			if ($row[$field_id] == $selected)
				$x .= "<option value='".$row[$field_id]."' selected>".$row[$field_name]."</option>";
			else
				$x .= "<option value='".$row[$field_id]."'>".$row[$field_name]."</option>";
		
		}
		$x .= "</select>"; return $x;
	}
	
	function select_fields_filter($name,$size=NULL,$class=NULL,$field_id,$field_name,$table_name,$selected,$filter=NULL,
												$field_select,$field_key,$change=NULL)
	{
		if ($filter == NULL)
			$query = "SELECT $field_id, $field_name FROM $table_name WHERE $field_select = '$field_key'";
		else
			$query = "SELECT $field_id, $field_name FROM $table_name WHERE $field_select = '$field_key' ORDER BY $filter";
			
		$result = mysql_query($query);
		
		if ($size == NULL)
			$x = "<select name='$name' class='$class' onchange='$change'>";
		else
			$x = "<select name='$name' style='width:".$size."px' class='$class' onchange='$change'>";
			
		while ($row = mysql_fetch_array($result)) {
			
			if ($row[$field_id] == $selected)
				$x .= "<option value='".$row[$field_id]."' selected>".$row[$field_name]."</option>";
			else
				$x .= "<option value='".$row[$field_id]."'>".$row[$field_name]."</option>";
			
		}
		$x .= "</select>"; return $x;
	}
	
	function select_fields_change($name,$size=NULL,$class=NULL,$field_id,$field_name,$table_name,$selected,$filter=NULL,$change)
	{
		if ($filter == NULL)
			$query = "SELECT $field_id, $field_name FROM $table_name";
		else
			$query = "SELECT $field_id, $field_name FROM $table_name ORDER BY $filter";
		
		$result = mysql_query($query);
		
		if ($size == NULL)
			$x = "<select name='$name' class='$class' onchange='$change'>";
		else
			$x = "<select name='$name' style='width:".$size."px' class='$class' onchange='$change'>";
			
		$x .= "<option value=''></option>";
		
		while ($row = mysql_fetch_array($result)) {
			
			if ($row[$field_id] == $selected)
				$x .= "<option value='".$row[$field_id]."' selected>".$row[$field_name]."</option>";
			else
				$x .= "<option value='".$row[$field_id]."'>".$row[$field_name]."</option>";
		
		}
		$x .= "</select>"; return $x;
	}
	
	function sf_filter_or($name,$size=NULL,$class=NULL,$field_id,$field_name,$table_name,$selected,$filter=NULL,
									 $sql_fields,$change=NULL)
	{
		//extract field object and field data, store in array values
		foreach($sql_fields as $fld_obj => $fld_data)
		{
			$fld_name[] = $fld_obj;
			$fld_value[] = $fld_data;
		}
			
		$query = "SELECT $field_id, $field_name FROM $table_name WHERE ";
			
		for ($c=count($fld_name); $c>0; $c--)
		{
			$arg = $c-1;
			$query .= " ".$fld_name[$arg]."='".$fld_value[$arg]."' ";
			if ($c-1 != 0) { $query .= " OR "; }
		}
			
		if ($filter != NULL) { $query .= "ORDER BY $filter"; }
		
		$result = mysql_query($query);
		
		if ($size == NULL)
			$x = "<select name='$name' class='$class' onchange='$change'>";
		else
			$x = "<select name='$name' style='width:".$size."px' class='$class' onchange='$change'>";
			
		$x .= "<option value=''></option>";	
			
		while ($row = mysql_fetch_array($result)) {
			
			if ($row[$field_id] == $selected)
				$x .= "<option value='".$row[$field_id]."' selected>".$row[$field_name]."</option>";
			else
				$x .= "<option value='".$row[$field_id]."'>".$row[$field_name]."</option>";
		
		}
		$x .= "</select>"; return $x; 
	}
	
	function select_fields_qry($name,$size=NULL,$class=NULL,$query,$selected,$filter=NULL)
	{
		$result = mysql_query($query);
		
		if ($size == NULL)
			$x = "<select name='$name' class='$class'>";
		else
			$x = "<select name='$name' style='width:".$size."px' class='$class'>";
		
		while ($row = mysql_fetch_array($result)) {
			
			if ($row[0] == $selected)
				$x .= "<option value='".$row[0]."' selected>".$row[1]."</option>";
			else
				$x .= "<option value='".$row[0]."'>".$row[1]."</option>";
		
		}
		$x .= "</select>"; return $x;
	}
	
	function select_fields_array($name,$size=NULL,$class=NULL,$query,$selected,$filter=NULL)
	{
		$result = mysql_query($query);
		
		if ($size == NULL)
			$x = "<select name='$name' class='$class'>";
		else
			$x = "<select name='$name' style='width:".$size."px' class='$class'>";
		
		while ($row = mysql_fetch_array($result)) {
			
			if ($row[0] == $selected)
				$x .= "<option value='".$row[0]."' selected>".$row[1]."</option>";
			else
				$x .= "<option value='".$row[0]."'>".$row[1]."</option>";
		
		}
		$x .= "</select>"; return $x;
	}
	
	function textarea_fields($name,$id,$class=NULL,$cols=NULL,$rows=NULL,$value,$option=NULL)
	{
		if ($cols == NULL && $rows == NULL)
			return "<textarea name='$name' id='$id' class='$class' '$option'>".$value."</textarea>";
		elseif ($cols > 0 && $rows == NULL)
			return "<textarea name='$name' id='$id' cols='$cols' class='$class' '$option'>".$value."</textarea>";
		elseif ($cols == NULL && $rows > 0)
			return "<textarea name='$name' id='$id' rows='$rows' class='$class' '$option'>".$value."</textarea>";
		else
			return "<textarea name='$name' id='$id' cols='$cols' rows='$rows' class='$class' '$option'>".$value."</textarea>";
	}
	
	function radio_fields($name,$value,$x,$checked=NULL)
	{ 
		return "<input type='radio' name='$name' value='$value' '$checked'> $x";
	}
	
	function checkbox_fields($name,$value,$x,$checked=NULL)
	//how do you handle an array of checkboxes? they need to have name=field[]?
	//use also id some javascript would have  a problem with only name, much better!
	//if you need to do any javascript
	{
		return "<input type='checkbox' name='$name' value='$value' '$checked'> $x";
	}
	
	function form_button($type,$name,$value,$option=NULL)
	{
		if ($option == NULL)
			return "<input type='$type' name='$name' value='$value'>";
		else
			return "<input type='$type' name='$name' value='$value' onClick='$option'>";
	}
	
	function button_back($url)
	{
		print "<script>function back() { var return_url = '".$url."'; window.location = return_url; }</script>";
	}
	
	function image_fields($url,$border,$height,$width)
	//is this really a field?Is just html
	//height etc to be removed. It will only drive you nuts!
	//add only class="imageContainer!"
	{
		return "<img src='$url' border='$border' height='$height' width='$width'>";
	}
	
	function link_fields($url,$name,$target=NULL)
	//same here as for image where is title for hovering. Think usability!
  {
		if ($target != NULL)
			return "<a href='$url' target='$target'>".$name."</a>";
		else
			return "<a href='$url'>".$name."</a>";
	}
	
	function date_select($button_id,$field_id)
	{
		$x  = "<button type='reset' id='$button_id'>...</button>";
		$x .= "<script type='text/javascript'>Calendar.setup";
		//why you use { ?
		$x .= "({ inputField : '$field_id', ifFormat : '%Y-%m-%d', button : '$button_id', singleClick : true, step : 1 });</script>";
		return $x;
	}
	
	function upload_fields($name,$id,$size,$class=NULL,$accept)
	//does accept work? me thinks it does nothing!
	{
		return "<input type='file' name='$name' id='$id' size='$size' class='$class' accept='$accept'>"; 
	}
	
	//DO NOT USE FONT! It gives your age away. USE class="asterix" DON't EVEN USE class red, boss might want it blue!
	function asterisk($name,$value) { if (strpos($value, $name) == TRUE) { return "<font color='red'>*</font>"; } }
	
	function delete_pages($title,$name,$url_post)
	{
		$string  = "<form method='post' action='".$url_post."'>";
		$string .= "<table width='765' border='0' cellpadding='0' cellspacing='0' class='delete'>";
		$string .= "<tr height='70' valign='middle'><td width='60' align='center'>";
		$string .= "<img src='../files/trashcan.png' border='0' height='48' width='48'></td>";
		$string .= "<td width='705'>Delete - ".$title." ".$name." ?</td></tr></table><br>";
		$string .= "<input type='submit' name='delete' value='Delete'>";
		$string .= "<input type='button' value='Cancel' onClick='javascript:back()'></form>";
		print $string;
	}
	
	function display_count($count)
	{
		if ($count == 0)
			$msg = "<font color='green'>No record(s) found!</font>";
		elseif ($count == 1)
			$msg = "<font color='blue'>". $count. " record found!</font>";
		else
			$msg = "<font color='blue'>". $count. " records found!</font>";
		return $msg;
	}
	
	function validate_fields($field_value)
	//how about other type of validation on the server side?
	//create routines isInteger,isAlphaNum etc .. as necessary
	{
		foreach($field_value as $fields => $value)
		{
			if (empty($value))
			{
				$error = $fields ." required!";
				return $error;
			}
		}
	}
	
	function check_duplicate_pictures($file,$id=NULL)
	//why check for duplicate picture?
	//
	{
		
		$result = mysql_query("SELECT COUNT(*) AS count FROM employees WHERE picture = '$file' AND employeeID != '$id'");
		$row = mysql_fetch_array($result);
		return $row['count'];
		
	}
	
	function validate_files($id=NULL,$file,$type,$filetypes)
	//where is filetypes defined?
	//should be in a CONFIG file
	{
		if (!in_array($type, $filetypes))
		{
			$error = "Invalid or unknown filetype attached!";
		}
		return $error;
	}
	
	function validate_uploads($id=NULL,$file,$type,$filetypes)
	//isn't this like the one on top?
	{
		if (!in_array($type, $filetypes))
		{
			$error = "Invalid or unknown filetype attached!";
		}
		elseif ($this->check_duplicate_pictures($file,$id) > 0)
		{ 
			$error = "Duplicate filename!";
		}
		
		return $error;
	}
	
	function validate_duplicate_keys($table_name,$field_key,$field_value)
	{
		$result = mysql_query("SELECT COUNT(*) AS count FROM $table_name WHERE $field_key = '$field_value'");
		$row = mysql_fetch_array($result);
		if ($row['count'] > 0) { $error = "Duplicate entry!"; }
		return $error;
	}
	
	function validate_error_message($msg)
	{
		$string  = "<table width='380' border='0' cellpadding='0' cellspacing='0' align='center' class='error'>";
		$string .= "<tr height='50' valign='middle'><td width='50' align='center'>";
		$string .= "<img src='../files/alert.png' border='0' height='32' width='32'></td>";
		$string .= "<td width='330'>".$msg."</td></tr></table>";
		return $string;
	}
	
	/* special functions */
	
	function select_employees($name,$size,$selected)
	//generalize routines
	//the way I see this one you fetching from sql
	//putting it is a a select with options
	
	//better
	//1.0  INPUT is some fields FROM a TABLE and you ORDERBY
	//function fetch_data($input_array);
	//function to_SELECT($data);
	//function to_table($data); etc...
	//one or two functions could be used for different applications
	//SELECT CompanyID,..... you get the drift?
	//input_array(table=>'',field1...fieldn,orderBY=>fieldname);
	//return the rows in a function then display with a different value
	//use class on options also
	
	
	{
		$query = "SELECT employee_no, firstname, mi, lastname FROM employees ORDER BY firstName";
		$result = mysql_query($query);
		
		print "<select name='$name' style='width:".$size."px' class='input'>";
		
		while ($row = mysql_fetch_array($result)) {
			
			$name = $row['firstname'] ." ". $row['mi'] ." ". $row['lastname'];
			
			if ($row['employee_no'] == $selected)
				print "<option value='".$row['employee_no']."' selected>".$name."</option>";
			else
				print "<option value='".$row['employee_no']."'>".$name."</option>";
		
		}
		print "</select>";
	}
	
	function print_align($data)
	//breaks are bad bad bad
	//you should write first code for standards compliance browsers and hack for ie not the other way out!
	//use css and id's not table width= etc
	//one id or class and a bit of css would do the trick here
	{
		
		if (strpos($_SERVER['HTTP_USER_AGENT'],'Firefox') == true) {
			
			$string  = $data;
			$string .= "<br><br>";
			
		} else {
			
			$string  = "<table width='50' border='0' cellpadding='0' cellspacing'='0'><tr height='60'>";
			$string .= "<td align='left' valign='middle'>".$data."</td></tr></table>";
			
		}
		
		return $string;
		
	}
	
}

?>
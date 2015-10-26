<?php

require "class.contents.php";
//this class does too much!


class SQL extends CONTENTS {

// This is more or less ok
// the function I was telling you about could come here
// ie
//
//
  function talkDB($action,$data,$success){
  // action delete,update,insert,read,etc record or records
  // each action has a function associated with it
  // use
  // call_user_func_array  ( callback $function  , array $param_arr  )
  // to call these functions (most of them you got below!
  // eg
  // From _POST you get
  //  $data['name']
  //  $data['surname']
  //  $data['table']
  //  $data['id']
  //  add
  //  $data['table']
  //  $data['filter']
  //  $data['sql'] last resort
  //  $data['orderby']
  // assume you call the $action=select_record
  // program will call 
    $newdata=call_user_func_array('select_record',$data);
    //could be 
    //$newdata=call_user_func_array('delete_record',$data,$filter);
    //$newdata=call_user_func_array('add_record',$data,$filter);
    //$newdata=call_user_func_array('update_record',$data,$filter);
    //$newdata=call_user_func_array('delete_record',$data,$filter);
    $if ($newdata) {
        return $newdata;
       }
    else {return $success=false}   
    // advantages of this way of dealing with things. First
    // your program is organised
    // let us make a sample for a search page to find materials for
    // submittals
    // assume action is PHP_SELF or similar
    
    //  $formArray= everything that needs to go on the form is here
    //  toHTML('searchMaterialform',$formArray);
    //  $data=postToData(_$POST);
    //  talkDB('select_record',$data,$success);

    
    
  }
	
	
	
	var $hostname = "localhost";
	var $username = "ere";
	var $password = "ere_cms_drupal";
	
	
	//function connect missing!
	
		
	function change_db($database)
	{ 
	    $conn = mysql_connect($this->hostname,$this->username,$this->password);
		mysql_select_db($database,$conn);	
	}
	
	function change_dir($url) { print "<script type='text/javascript'>window.location.href='".$url."';</script>"; }
	
	function openwindow($url) { print "<script type='text/javascript'>window.open('".$url."')</script>"; }
	
	function delete_record($table_name,$sql_fields=NULL)
	//this looks like a good general routine but is NOT USED!
	{
		if (count($sql_fields) > 0)
		{
			//extract field object and field data, store in array values
			foreach($sql_fields as $fld_obj => $fld_data)
			{
				$field_name[] = $fld_obj;
				$field_value[] = $fld_data;
			}
			$query = "DELETE FROM $table_name WHERE ";
		
			for ($c=count($field_name); $c>0; $c--)
			{
				$arg = $c-1;
				$query .= " ".$field_name[$arg]."='".$field_value[$arg]."' ";
				if ($c-1 != 0) { $query .= " AND "; }
			}
		}
		else
		{
			$query = "DELETE FROM $table_name";
		}
		$result = mysql_query($query) or die (mysql_error()); //die no good rather maybe an error object!
		if (mysql_affected_rows() > 0) { return 1; } else { return 0; }
	}
	
	function delete_record_archive($table_name,$sql_fields,$field_key,$value)
	{
		//extract field object and field data, store in array values
		foreach($sql_fields as $fld_obj => $fld_data)
		{
			$field_name[] = $fld_obj;
			$field_value[] = $fld_data;
		}
		
		$query = "UPDATE $table_name SET ";
		for ($c=count($field_name); $c>0; $c--)
		{
			$arg = $c-1;
			$query .= " ".$field_name[$arg] ."='".$field_value[$arg]."' ";
			if ($c-1 != 0) { $query .= " , "; }
		}
		$query .= " WHERE $field_key = '$value'";
		$result = mysql_query($query) or die (mysql_error());
		if (mysql_affected_rows() > 0) { return 1; } else { return 0; }	
	}
	
	function select_record($table_name,$filter,$sql_fields=NULL)
	//this is good should be used more
	{
		if (count($sql_fields) > 0)
		{
			//extract field object and field data, store in array values
			foreach($sql_fields as $fld_obj => $fld_data)
			{
				$field_name[] = $fld_obj;
				$field_value[] = $fld_data;
			}
			$query = "SELECT * FROM $table_name WHERE ";
			
			for ($c=count($field_name); $c>0; $c--)
			{
				$arg = $c-1;
				$query .= " ".$field_name[$arg]."='".$field_value[$arg]."' ";
				if ($c-1 != 0) { $query .= " AND "; }
			}
		}
		else
		{
			$query = "SELECT * FROM $table_name ";
		}
		
		if ($filter != NULL) { $query .= " ORDER BY $filter"; }
		
		$this->result = mysql_query($query) or die (mysql_error());
		
		if ($this->result)
		{
			// store query records
			$i=0;
			while ($row = @mysql_fetch_object($this->result))
			{
				// store results as an object within main array
				$this->last_result[$i] = $row;
				$i++;
			}
			@mysql_free_result($this->result);
			
			// check if there's a record exist before send back to array
			if (count($this->last_result) > 0)
			{
				// send back array of objects. Each row is an object
				$i=0;
				foreach($this->last_result as $row)
				{
					$new_array[$i] = get_object_vars($row);
					$new_array[$i] = array_values($new_array[$i]);
					$i++;
				}
				return $new_array;
			}
			else
			{
				return 0;
			}
		}
	}
	
	function insert_record($table_name,$sql_fields)
	{
		//extract field object and field data, store in array values
		foreach($sql_fields as $fld_obj => $fld_data)
		{
			$field_name[] = $fld_obj;
			$field_value[] = $fld_data;
		}
		
		$query = "INSERT INTO $table_name SET ";
		for ($c=count($field_name); $c>0; $c--)
		{
			$arg = $c-1;
			$query .= " ".$field_name[$arg] ."='".$field_value[$arg]."' ";
			if ($c-1 != 0) { $query .= " , "; }
		}
		$result = mysql_query($query) or die (mysql_error());
		if (mysql_affected_rows() > 0) { return 1; } else { return 0; }
	}
	
	function update_record($table_name,$sql_fields,$field_key,$value)
	{
		//extract field object and field data, store in array values
		foreach($sql_fields as $fld_obj => $fld_data)
		{
			$field_name[] = $fld_obj;
			$field_value[] = $fld_data;
		}
		
		$query = "UPDATE $table_name SET ";
		for ($c=count($field_name); $c>0; $c--)
		{
			$arg = $c-1;
			$query .= " ".$field_name[$arg] ."='".$field_value[$arg]."' ";
			if ($c-1 != 0) { $query .= " , "; }
		}
		$query .= " WHERE $field_key = '$value'";
		$result = mysql_query($query) or die (mysql_error());
		if (mysql_affected_rows() > 0) { return 1; } else { return 0; }
	}
	
	function get_last_insert_id()
	{
		$result = mysql_query("SELECT LAST_INSERT_ID() AS LID");
		$row = mysql_fetch_array($result);
		return $row['LID'];
	}
	
	function convert_date($date_value,$type)
	//FROM CONFIG
	{
		if ($type == "S" || $type == "s")
			return date("F d, Y", strtotime($date_value));
		elseif ($type == "N" || $type == "n")
			return date("M d, Y", strtotime($date_value));
	}
	
	function get_selected_row($table_name,$sfld_name,$sfld_value)
	{
		$result = mysql_query("SELECT * FROM $table_name WHERE $sfld_name = '$sfld_value'");
		$row = mysql_fetch_array($result);
		if (mysql_num_rows($result) > 0) { return $row; } else { return 0; }
	}
	
	function get_selected_col($field,$table_name,$sfld_name,$sfld_value)
	{
		$result = mysql_query("SELECT $field FROM $table_name WHERE $sfld_name = '$sfld_value'");
		$row = mysql_fetch_array($result);
		if (mysql_num_rows($result) > 0) { return $row[$field]; } else { return 0; }
	}
	
	function get_selected_col_filter($field,$table,$sql_fields)
	{
		//extract field object and field data, store in array values
		foreach($sql_fields as $fld_obj => $fld_data)
		{
			$field_name[] = $fld_obj;
			$field_value[] = $fld_data;
		}
		$query = "SELECT $field FROM $table WHERE ";
		for ($c=count($field_name); $c>0; $c--)
		{
			$arg = $c-1;
			$query .= " ".$field_name[$arg]."='".$field_value[$arg]."' ";
			if ($c-1 != 0) { $query .= " AND "; }
		}
		$result = mysql_query($query) or die (mysql_error());
		$row = mysql_fetch_array($result);
		if (mysql_affected_rows() > 0) { return $row[$field]; } else { return 0; }
	}
 
	function get_name($table_name,$field_key,$field_id)
	{
		$result = mysql_query("SELECT firstname, mi, lastname FROM $table_name WHERE $field_key = '$field_id'");
		$row = mysql_fetch_array($result);
		if (mysql_num_rows($result) > 0) { return $row[0] ." ". $row[1] . " ". $row[2]; } else { return 0; }
	}

	function get_age($id) { 
	
		$query = "SELECT birthdate, (YEAR(CURDATE()) - YEAR(birthdate)) - (RIGHT(CURDATE(),5) < RIGHT(birthdate,5))
                                     AS age FROM employees WHERE employeeID = '$id'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return $row['age'];
	
	}
	
	function get_address($id) { 
	//why not use your general routines?
	
		$result = mysql_query("SELECT street, city, state, country_id FROM address WHERE addressID = '$id'");
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);
		
		if (!empty($row['state']))
			$state_prv = $row['state'] .", ";
		
		$address = $row['street']. ", ". $row['city'] .", ". $state_prv ."". $this->get_countryname($row['country_id']);
		if ($count != 0) { return $address; }
	
	}
	
	function get_countryname($id) { 
	
		$result = mysql_query("SELECT countryName FROM country WHERE countryID = '$id'");
		$row = mysql_fetch_array($result);
		return $row['countryName'];
	
	}
	
	function add_files($fid,$nid,$name,$path,$mime,$size)
	{
		/* change database name */
		$this->change_db("ere_db");
		
		/*  insert record from table files in ere_db */
		$query = "INSERT INTO files VALUES ('$fid','$nid','$name','$path','$mime','$size')";
		$result = mysql_query($query);
		
		/*  insert record from table file_revisions in ere_db */
		$query = "INSERT INTO file_revisions VALUES ('$fid','$nid','$name','0')";
		$result = mysql_query($query);
		
		/* change database name */
		$this->change_db("ere_project");
	}
	
	function update_files($name,$path,$mime,$size,$oldfile,$nid,$fid)
	{	
		
		/* change database name */
		$this->change_db("ere_db");
		
		$result = mysql_query("SELECT COUNT(*) AS count FROM files WHERE filename = '$oldfile'");
		$row = mysql_fetch_array($result);
		
		if ($row['count'] == 1) {
			
			/*  insert record from table files in ere_db */
			$query = "UPDATE files SET filename = '$name', filepath = '$path', filemime = '$mime', filesize = '$size'
											WHERE filename = '$oldfile' AND nid='$nid'";
			$result = mysql_query($query);
		
			/*  insert record from table file_revisions in ere_db */
			$query = "UPDATE file_revisions SET description = '$name' WHERE description = '$oldfile' AND vid = '$nid'";
			$result = mysql_query($query);
			
			if ($name != $oldfile) { $command = system('rm -rf /home/joseph/www/files/'.$oldfile); }
			
			//$command = system('rm /home/joseph/www/files/'.$oldfile);
			
		} else {
			
			/*  insert record from table files in ere_db */
			$query = "INSERT INTO files VALUES ('$fid','$nid','$name','$path','$mime','$size')";
			$result = mysql_query($query);
		
			/*  insert record from table file_revisions in ere_db */
			$query = "INSERT INTO file_revisions VALUES ('$fid','$nid','$name','0')";
			$result = mysql_query($query);
			
		}
		
		/* change database name */
		$this->change_db("ere_project");
		
	}
	
	function delete_files($name,$nid)
	{
		/* change database name */
		$this->change_db("ere_db");
		
		/*  delete record from table files in ere_db */
		$query = "DELETE FROM files WHERE filename = '$name' AND nid='$nid'";
		$result = mysql_query($query);
		
		/*  delete record from table file_revisions in ere_db */
		$query = "DELETE FROM file_revisions WHERE description = '$name' AND vid='$nid'";
		$result = mysql_query($query);
		
		/* change database name */
		$this->change_db("ere_project");
		
		$command = system('rm -rf /home/josep/www/files/'.$name);
		
	}
	
	function check_redundant($table,$field,$value) { 
	
		$result = mysql_query("SELECT COUNT(*) AS count FROM $table WHERE $field = '$value'");
		$row = mysql_fetch_array($result);
		if ($row['count'] > 0) { $error = "Duplicate entry!"; }
		return $error;
		
	}
	
	function trans_logs($table,$id,$trans)
	{
		/* initialize global user */
		global $user;
		
		/* get datetime, ip address and browser */
		$datetime = strtotime(date('Y-m-d h:i:s'));
		$ip = $_SERVER['REMOTE_ADDR'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		
		/* change database name */
		$this->change_db("ere_db");
		
		/* get the user ID */
		$userID = $user->uid;
		
		/* change database name */
		$this->change_db("ere_project");
		
		/* field entries for storing data */
		$log_fields = array('userID' => $userID, 'trans_logtime' => $datetime,
									   'trans_performed' => $trans, 'trans_table' => $table,
									   'trans_table_id' => $id, 'ip_address' => $ip, 'browser' => $browser);
		
		/* insert logs */
		$this->insert_record('transaction_logs',$log_fields);
	}
	
	function get_count($table,$sql_fields=NULL) {
		
		if (count($sql_fields) > 0)
		{
			//extract field object and field data, store in array values
			foreach($sql_fields as $fld_obj => $fld_data)
			{
				$field_name[] = $fld_obj;
				$field_value[] = $fld_data;
			}
			$query = "SELECT * FROM $table WHERE ";
		
			for ($c=count($field_name); $c>0; $c--)
			{
				$arg = $c-1;
				$query .= " ".$field_name[$arg]."='".$field_value[$arg]."' ";
				if ($c-1 != 0) { $query .= " AND "; }
			}
		}
		else
		{
			$query = "SELECT * FROM $table";
		}
		$result = mysql_query($query) or die (mysql_error());
		$count = mysql_num_rows($result);
		return $count;
		
	}

	function datediff($date2,$date1) {
	
		/* set date as mysql date */
		$date2 = date("Y-m-d", $date2);
		$date1 = date("Y-m-d", $date1);
		
		/* query records */
		$query = "SELECT DATEDIFF('$date2','$date1') AS date_diff";
		$result = mysql_query($query);
		$x = mysql_fetch_array($result);
		return $x['date_diff'];
	
	}

	function get_count_custom($sql) {
	
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		return $count;
	
	}
	
	function get_active_emp_count() {
	
		$query = "SELECT * FROM employees WHERE employee_status_id > 2";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);
		return $count;
	
	}
	
	
	
	
	// ------------------------------ //
	
	function get_acct_name($id) { 
	
		$result = mysql_query("SELECT account_name FROM accounts WHERE id = '$id'");
		$row = mysql_fetch_array($result);
		return $row['account_name'];
	
	}
	
	function get_fullname($id) { 

		$result = mysql_query("SELECT name FROM users WHERE id = '$id'");
		$row = mysql_fetch_array($result);
		return $row['name'];
	
	}
	
	function get_old_password($id,$pass) { 
	
		$result = mysql_query("SELECT id, password FROM users WHERE id = '$id' AND password = password('$pass')");
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);

		if ($count == 1)
			return TRUE;
		else
			return FALSE;
	
	}
	
	
	
	function get_address_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM address WHERE addressID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function get_company_field($field,$id) { 
	
	    $result = mysql_query("SELECT $field FROM company WHERE companyID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_company($id) { 
		
	    mysql_query("DELETE FROM company WHERE companyID = '$id'");
		
	}
	
	function get_company_type_name($id) { 
	
		$result = mysql_query("SELECT companyTypeName FROM company_type WHERE companyTypeID = '$id'");
		$row = mysql_fetch_array($result);
		return $row['companyTypeName'];
	
	}
	
	function get_company_type_field($field,$id) { 
	
	    $this->change_db("ere_project");
		$result = mysql_query("SELECT $field FROM company_type WHERE companyTypeID = '$id'");
		$row = mysql_fetch_array($result);
		$this->change_db("ere_db");
		return $row[$field];
	
	}
	
	function del_company_type($id) { 
	
	    mysql_query("DELETE FROM company_type WHERE companyTypeID = '$id'");
		
	}
	
	function get_contact_person_field($field,$id) { 
	
	    $result = mysql_query("SELECT $field FROM contact_person WHERE contactID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function get_contact_person_name($id) { 
	
	    $result = mysql_query("SELECT lastName, firstName, mi FROM contact_person WHERE contactID = '$id'");
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);
		
		if ($count > 0)
			$name = $row['lastName'] .", ". $row['firstName'] ." ". $row['mi'] ;
		else
			$name = "";
			
		return $name;
	
	}
	
	function del_contact_person($id) { 
	
	    mysql_query("DELETE FROM contact_person WHERE contactID = '$id'");
		
	}
	
	function get_department_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM department WHERE departmentID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_department($id) { 
	
	    mysql_query("DELETE FROM department WHERE departmentID = '$id'");
		
	}
	
	function get_discipline_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM discipline WHERE disciplineID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_discipline($id) { 
	
	    mysql_query("DELETE FROM discipline WHERE disciplineID = '$id'");
		
	}
	
	function get_drawings_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM drawings WHERE drawingID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_drawings($id) { 
	
		$result = mysql_query("SELECT drw_filename FROM revisions WHERE drawing_id = '$id'");
		
		while ($row = mysql_fetch_array($result)) {

				$name = $row['drw_filename'];
				$this->delete_drupal_files($name,"61");

		}
	
		/* delete the entire record on the table */
	    mysql_query("DELETE FROM drawings WHERE drawingID = '$id'");
		mysql_query("DELETE FROM revisions WHERE drawing_id = '$id'");
		mysql_query("DELETE FROM drawing_submittals WHERE drawing_id = '$id'"); 

	}
 
    function get_drawing_type_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM drawing_type WHERE drawingTypeID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function get_drawing_submittals($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM drawing_submittals WHERE revision_id = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_drawing_type($id) { 
	
	    mysql_query("DELETE FROM drawing_type WHERE drawingTypeID = '$id'");
			
	}
 	
	function get_employees_name($id) { 
	
	    $result = mysql_query("SELECT lastname, firstname, mi FROM employees WHERE employeeID = '$id'");
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);
		
		if ($count > 0)
			$name = $row['lastname'] .", ". $row['firstname'] ." ". $row['mi'] ;
		else
			$name = "";
			
		return $name;
		
	}
	
	function get_employees_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM employees WHERE employeeID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_employees($id) { 
	
	    $this->change_db("ere_project");
	    mysql_query("DELETE FROM employees WHERE employeeID = '$id'");
		$this->change_db("ere_db");
			
	}
	
	function get_gender($id) { 
	
		$result = mysql_query("SELECT genderName FROM gender WHERE genderID = '$id'");
		$row = mysql_fetch_array($result);
		return $row['genderName'];
	
	}
		
	function get_jobs_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM jobs WHERE jobID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_jobs($id) { 
	
	    $this->change_db("ere_project");
	    mysql_query("DELETE FROM jobs WHERE jobID = '$id'");
		$this->change_db("ere_db");
			
	}
	
	function get_personnel_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM personnel WHERE id = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function get_submittal_type($id) { 
	
		if ($id == 1)
			$ans = "New Submittal";
		else
			$ans = "Re-Submittal";

		return $ans;
	
	}
	
	function get_projects_field($field,$id) { 
	
	    $result = mysql_query("SELECT $field FROM projects WHERE projectID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
			
	}
	
	function del_projects($id) { 
	
	    mysql_query("DELETE FROM projects WHERE projectID = '$id'");
		
	}
	
	function get_personnel_name($id) { 
	
		$result = mysql_query("SELECT firstname, mi, lastname FROM personnel WHERE id = '$id'");
		$row = mysql_fetch_array($result);
		$name = $row['lastname'] .", ". $row['firstname'] ." ". $row['mi'];
		return $name;
	
	}
	
    function get_revision_field($field,$id) { 
	
	    $result = mysql_query("SELECT $field FROM revisions WHERE rev_id = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function get_company_thru_contact($id) { 
	
		$result = mysql_query("SELECT company_name FROM company WHERE cc_person_id = '$id'");
		$row = mysql_fetch_array($result);
		return $row['company_name'];
		
	}
	
	function get_sites_field($field,$id) { 
	
		$result = mysql_query("SELECT $field FROM sites WHERE siteID = '$id'");
		$row = mysql_fetch_array($result);
		return $row[$field];
	
	}
	
	function del_sites($id) { 
	
	    mysql_query("DELETE FROM sites WHERE siteID = '$id'");
		
	}
		
	function check_active_recs($id) { 
	
		$result = mysql_query("SELECT * FROM ere_drawing_issue_out WHERE drawing_id = '$id'");
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);
		return $count;
		
	}
	
	function check_dup_drawing_fname($filename) { 
	
		$result = mysql_query("SELECT * FROM ere_drawings WHERE filename = '$filename'");
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);
		return $count;
		
	}
	
	function set_active_recs($id) { 
	
		mysql_query("UPDATE ere_drawing_issue_out SET active = 1 WHERE drawing_id = '$id'");
		
	}
	
	function check_cv($name) { 
	
		$result = mysql_query("SELECT COUNT(*) as count FROM ere_employees WHERE cv_filename = '$name'");
		$row = mysql_fetch_array($result);
		return $row['count'];
	
	}
	
	function check_exist_cv($name,$id) { 
	
		$query = "SELECT COUNT(*) as count FROM ere_employees WHERE cv_filename = '$name' AND emp_id = '$id'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		if ($row['count'] == 1)
			return FALSE;
		else
			return TRUE;
			
	}
	
	function check_filename($name) { 
	
		$this->change_db("ere_project");
		$result = mysql_query("SELECT COUNT(*) as count FROM revisions WHERE drw_filename = '$name'");
		$row = mysql_fetch_array($result);
		$this->change_db("ere_db");
		return $row['count'];
	
	}
	
	function check_exist_filename($name,$id) { 
	
		$query = "SELECT COUNT(*) as count FROM revisions WHERE drw_filename = '$name' AND drawing_id = '$id'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		if ($row['count'] == 1)
			return FALSE;
		else
			return TRUE;
			
	}
	
	function check_photo($name) { 
	
		$result = mysql_query("SELECT COUNT(*) as count FROM ere_employees WHERE photo_filename = '$name'");
		$row = mysql_fetch_array($result);
		return $row['count'];
	
	}
	
	function check_exist_photo($name,$id) { 
	
		$query = "SELECT COUNT(*) as count FROM ere_employees WHERE photo_filename = '$name' AND emp_id = '$id'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		if ($row['count'] == 1)
			return FALSE;
		else
			return TRUE;
			
	}
		
	function get_files_lastid() { 
	
		$this->change_db("ere_db");
		$result = mysql_query("SELECT fid FROM files ORDER BY fid DESC LIMIT 1");
		$row = mysql_fetch_array($result);
		$this->change_db("ere_project");
		return $row['fid'];
	
	}	
	
	
	function get_status($id) {
		
		$result = mysql_query("SELECT status FROM drawing_submittals WHERE revision_id = '$id'");
		$row = mysql_fetch_array($result);
		
		if ($row['status'] == "P")
			$message = "Pending w/ consultant";
		elseif ($row['status'] == "P1")
			$message = "Pending w/ us";
		else
			$message = "Preliminary";
			
		return $message;
		
	}
	
	function query_grid_submittals($id) { 
	
		$result = mysql_query("SELECT * FROM submittals_in_dump");
		$count = mysql_num_rows($result);
		
		if ($count > 0)
			mysql_query("DELETE FROM submittals_in_dump");
			
		$result = mysql_query("SELECT drwg_id FROM ere_drawings WHERE project_id = '$id' ORDER BY drwg_id");
		
		while ($row = mysql_fetch_array($result)) {
		
			$drawing_id = $row['drwg_id'];
			$query = "INSERT INTO submittals_in_dump SELECT rev_id, drawing_id, revision_no, date_of_drawing
								FROM revisions WHERE drawing_id = '$drawing_id' AND key_id = 0";
			mysql_query($query);
		
		}
		
		mysql_free_result($result);
		
	}
	
	function update_submittals_out($proj_id,$trans_id,$stats) { 
	
		$gmt_date = date("Y-m-d H:i:s");
		
		/*  get first the revision_id of the drawing in drawing submittals to be enteren id drawing transmittal */
		$query = "SELECT revision_id, revision_no, drawing_id FROM drawing_submittals
						WHERE project_id = '$proj_id' AND submit_key = 1";
		$result = mysql_query($query);
		
		while ($row = mysql_fetch_array($result)) {
			
			/* get the revision id from drawing submittals*/
			$idx = $row['revision_id'];
			$idn = $row['revision_no'];
			$idd = $row['drawing_id'];
			
			/* check if revision_id in drawing transmittal exists */
			$qry = "SELECT COUNT(*) AS count FROM drawing_transmittal WHERE revision_id = '$idx'";
			$res = mysql_query($qry);
			$rws = mysql_fetch_array($res);
			$nums = $rws['count'];
			
			/* if revision id exists, perform SQL UPDATE operation */
			if ($nums == 1)				
				$qrys = "UPDATE drawing_transmittal SET transmittal_id = '$trans_id',
								date_transmitted = '$gmt_date' WHERE revision_id = '$idx'";
			else
				$qrys = "INSERT INTO drawing_transmittal SELECT revision_id, '$trans_id', drawing_id, project_id, revision_no,
								'$gmt_date', 'OUT' FROM drawing_submittals WHERE project_id = '$proj_id' AND submit_key = 1";
			
			mysql_query($qrys);
			
		}
		
		mysql_free_result($result);
		
		$query = "UPDATE drawing_submittals SET submit_key = 2, status = '$stats'
						WHERE project_id = '$proj_id' AND submit_key = 1";
		mysql_query($query);
		
		$query = "UPDATE copy_submittals SET transmittal_id = '$trans_id', date_transmitted = '$gmt_date',
						transaction_type = 'OUT' WHERE project_id = '$proj_id' AND transmittal_id = 0
						AND date_transmitted = '0000-00-00 00:00:00'";
		mysql_query($query);
		
	}
	
	function update_submittals_in($proj_id,$trans_id) { 
	
		$gmt_date = date("Y-m-d H:i:s");
		$query = "INSERT INTO drawing_transmittal SELECT '$trans_id', revision_id, drawing_id, project_id, revision_no,
						'$gmt_date','OUT' FROM drawing_submittals WHERE project_id = '$proj_id' AND submit_key = 2";
		mysql_query($query);
		
		$query = "UPDATE drawing_submittals SET submit_key = 4
						WHERE project_id = '$proj_id' AND submit_key = 2";
		mysql_query($query);
		
		$query = "UPDATE copy_submittals SET transmittal_id = '$trans_id', date_transmitted = '$gmt_date',
						transaction_type = 'OUT' WHERE project_id = '$proj_id' AND transmittal_id = 0
						AND date_transmitted = '0000-00-00 00:00:00'";
		mysql_query($query);
		
	}
	
	function update_copies_out($proj_id,$trans_id) {
		
		$gmt_date = date("Y-m-d");
		$query = "UPDATE copies_submittals SET transmittal_id = '$trans_id' WHERE project_id = '$proj_id'";
		mysql_query($query);
		
	}
	
	function add_drupal_files($id,$pageid,$name,$path,$mime,$size) {
	
		/*  insert record from table files in ere_db */
		$query = "INSERT INTO files VALUES ('$id','$pageid','$name','$path','$mime','$size')";
		$result = mysql_query($query);
		
		/*  insert record from table file_revisions in ere_db */
		$query = "INSERT INTO file_revisions VALUES ('$id','$pageid','$name','0')";
		$result = mysql_query($query);
		
	}
	
	function update_drupal_files($name,$pid,$path,$mime,$size,$old) {
		
		$this->change_db("ere_db");
	
		/*  insert record from table files in ere_db */
		$query = "UPDATE files SET filename = '$name', filepath = '$path', filemime = '$mime', filesize = '$size'
											WHERE filename = '$old' AND nid='$pid'";
		$result = mysql_query($query);
		
		/*  insert record from table file_revisions in ere_db */
		$query = "UPDATE file_revisions SET description = '$name' WHERE description = '$old' AND vid = '$pid'";
		$result = mysql_query($query);
		
		$this->change_db("ere_project");
		$command = system('rm -rf /var/www/html/files/'.$old);
		
	}
		
	function delete_drupal_files($name,$pid) {
		
		$this->change_db("ere_db");
	
		/*  delete record from table files in ere_db */
		$query = "DELETE FROM files WHERE filename = '$name' AND nid='$pid'";
		$result = mysql_query($query);
		
		/*  delete record from table file_revisions in ere_db */
		$query = "DELETE FROM file_revisions WHERE description = '$name' AND vid='$pid'";
		$result = mysql_query($query);
		
		$this->change_db("ere_project");
		$command = system('rm -rf /var/www/html/files/'.$name);
		
	}	
	
	function check_redundant_update($field,$table,$value,$key,$id) { 
	
		$this->change_db("ere_project");
		$result = mysql_query("SELECT COUNT(*) AS count FROM $table WHERE $field = '$value' AND $key <> '$id'");
		$row = mysql_fetch_array($result);
		$this->change_db("ere_db");
		return $row['count'];
	
	}
	
	function remove_submitkey($id,$i) { //1
	
		$this->change_db("ere_project");
		mysql_query("UPDATE drawing_submittals SET submit_key = '$i', transaction_id = 0 WHERE revision_id = '$id'");
		$this->change_db("ere_db");
		
	}
	
	function add_submitkey($id,$i,$tid) { 
	
		mysql_query("UPDATE drawing_submittals SET submit_key = '$i', transaction_id = '$tid' WHERE revision_id = '$id'");
		
	}
	
	function add_copies_to($id,$pid) { 
	
		$query = "INSERT INTO copy_submittals VALUE ('','','','$pid','$id','')";
		mysql_query($query);
		
	}
	
	function delete_copies_to($id) {
	
		$this->change_db("ere_project");
		mysql_query("DELETE FROM copy_submittals WHERE copyID = '$id'");
		$this->change_db("ere_db");
		
	}
	
	function delete_revision($id) {
		
		mysql_query("DELETE FROM revisions WHERE rev_id = '$id'"); 
		mysql_query("DELETE FROM drawing_submittals WHERE revision_id = '$id'");
				
	}
		
	function check_email($email) { 
	
		/* First, we check that there's one @ symbol, and that the lengths are right */
		if (!ereg("[^@]{1,64}@[^@]{1,255}", $email)) {
    		/* Email invalid because wrong number of characters in one section, or wrong number of @ symbols. */
		    return "Invalid Email address!";
		}

		/* Split it into sections to make life easier */
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);

		for ($i = 0; $i < sizeof($local_array); $i++) {

			if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {

				return "Invalid Email address";

    		}

		}  

		/* Check if domain is IP. If not, it should be valid domain name */
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { 

    		$domain_array = explode(".", $email_array[1]);

		    if (sizeof($domain_array) < 2) {

        		return false; /* Not enough parts to domain */

    		}

		    for ($i = 0; $i < sizeof($domain_array); $i++) {

				if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {

					return "Invalid Email address";

				}

    		}
	
  		}

		//return true;

	}
	
	function update_drawing_issue($value,$id) {
		
		/*
			0 - default
			1 - issue in
			2 - issue out
			3 - finished 
		*/
		
		$result = mysql_query("UPDATE ere_drawings SET status = '$value' WHERE drwg_id = '$id'"); 
		
	} 
	
	function update_revision($value,$id) { 
	
		$result = mysql_query("UPDATE ere_drawings SET revision = $value WHERE drwg_id = '$id'");
			
	}
	
	function count_revisions($id) { 
	
		$query = "SELECT * FROM revisions WHERE drawing_id = '$id'";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);
		return $count;
	
	}

    function check_existing_drawings($id) { 
	
	   $query = "SELECT * FROM ere_drawings WHERE project_id = '$id'";
		 $result = mysql_query($query);
		 $count = mysql_num_rows($result);
		return $count;
	
	}
	
}

?>

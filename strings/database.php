<?php
/* SVN FILE: $Id: database.php.default 45 2006-07-04 12:59:25Z tariquesani $ */
/**
 * This is core configuration file.
 *
 * Use it to configure core behaviour ofCake.
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c)	2006, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright (c) 2006, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP v 0.2.9
 * @version			$Revision: 45 $
 * @modifiedby		$LastChangedBy: tariquesani $
 * @lastmodified	$Date: 2006-07-04 18:29:25 +0530 (Tue, 04 Jul 2006) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * In this file you set up your database connection details.
 *
 * @package		cake
 * @subpackage	cake.config
 */
/**
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * driver =>
 * mysql, postgres, sqlite, adodb-drivername, pear-drivername
 *
 * connect =>
 * MySQL set the connect to either mysql_pconnect of mysql_connect
 * PostgreSQL set the connect to either pg_pconnect of pg_connect
 * SQLite set the connect to sqlite_popen  sqlite_open
 * ADOdb set the connect to one of these
 *	(http://phplens.com/adodb/supported.databases.html) and
 *	append it '|p' for persistent connection. (mssql|p for example, or just mssql for not persistent)
 *
 * host =>
 * the host you connect to the database
 * MySQL 'localhost' to add a port number use 'localhost:port#'
 * PostgreSQL 'localhost' to add a port number use 'localhost port=5432'
 *
 */
echo '...conecting..'; 
$db=mysqli_connect('localhost','root','', 'wordpress');
if (mysqli_connect_errno()){
   echo 'error';

}else {echo 'connected';}
 
$sql = 'SELECT * FROM wp_posts';
$result=mysqli_query($db,$sql);
$num_results=mysqli_num_rows($result);

for ($i=0;$i<$num_results;$i++){
$row=mysqli_fetch_assoc($result);
foreach ($row as $key=>$value){
  echo "<pre>$key=>$value;</pre>";
}
}


 
class DATABASE_CONFIG
{
	var $default = array('driver' => 'mysql',
								'connect' => 'mysql_connect',
								'host' => 'localhost',
								'login' => 'wei',
								'password' => 'wei',
								'database' => 'photos',
								'prefix' => '');

	var $test = array('driver' => 'mysql',
							'connect' => 'mysql_connect',
							'host' => 'localhost',
							'login' => 'wei',
							'password' => 'wei',
							'database' => 'photos',
							'prefix' => '');
}

?>
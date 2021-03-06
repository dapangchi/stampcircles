<?php
// *****************************************************************************
// Copyright 2003-2005 by A J Marston <http://www.tonymarston.net>
// Copyright 2006-2008 by Radicore Software Limited <http://www.radicore.org>
// *****************************************************************************

// This file contains database access details and the standard connection function
$GLOBALS['dbms']   = 'mysql';      // database engine is MySQL
//$GLOBALS['dbms']   = 'pgsql';      // database engine is PostgreSQL
//$GLOBALS['dbms']   = 'oracle';     // database engine is PostgreSQL

if ($GLOBALS['dbms'] == "oracle") {
    $GLOBALS['dbhost'] = '//localhost/xe';
} else {
    $GLOBALS['dbhost'] = 'localhost';
} // if

// NOTE: with MYSQL there are tables withing databases, and within a single connection
// it is possible to access tables in any database.
// But with PostgreSQL there are tables within schemas within databases, and within
// a single connection it is only possible to access a single database, but any number
// of schemas within that database.
// When using PostgreSQL you must supply a value for $PGSQL_dbname for the single database
// connection, and what is known as 'dbname' to MySQL becomes 'schema' to PostgreSQL.
$GLOBALS['PGSQL_dbname'] = 'radicore';

// NOTE: $dbprefix is for my web host (shared) where my databases are prefixed
// with my account name to keep them separate from other accounts.

if (eregi('^(127.0.0.1|localhost|desktop|laptop)$', $_SERVER['SERVER_NAME'])) {    // this is for my PC
    $GLOBALS['dbusername'] = '****';
    $GLOBALS['dbuserpass'] = '****';
    $GLOBALS['dbprefix']   = null;
    // set these only if secure HTTPS protocol is available on your server
    $GLOBALS['http_server']  = '';
    $GLOBALS['https_server'] = '';
    $GLOBALS['https_server_suffix'] = '';
} else {
    // this is for my shared web host
    $GLOBALS['dbusername'] = '****';
    $GLOBALS['dbuserpass'] = '****';
    $GLOBALS['dbprefix']   = '****';
    // set these only if secure HTTPS protocol is available on your server
    $GLOBALS['http_server']  = '';
    $GLOBALS['https_server'] = '';
    $GLOBALS['https_server_suffix'] = '';
} // if

// this demonstrates the multi-server option (see FAQ92)
if (eregi('^(127.0.0.1|localhost|desktop|laptop)$', $_SERVER['SERVER_NAME'])) {
    global $servers;
    // server 0
//    $servers[0]['dbhost']     = '192.168.1.64';
//    $servers[0]['dbengine']   = 'pgsql';
//    $servers[0]['dbusername'] = '****';
//    $servers[0]['dbuserpass'] = '****';
//    $servers[0]['dbprefix']   = '';
//    $servers[0]['dbnames']    = 'xample,classroom,survey';
    // server 1
//    $servers[1]['dbhost']     = 'localhost';
//    $servers[1]['dbengine']   = 'mysql';
//    $servers[1]['dbusername'] = 'tony';
//    $servers[1]['dbuserpass'] = 'tony';
//    $servers[1]['dbprefix']   = '';
//    $servers[1]['dbnames']    = '*';
} // if

// set this to true if you want all XSL transformations to be done by the client
// (NOTE: only valid if supported by your client browser)
$GLOBALS['XSLT_client_side'] = false;

// set this to TRUE to write all sql queries to file 'sql/<script_id>.sql' (for debugging)
$GLOBALS['log_sql_query'] = false;

// set this to TRUE to write all XML documents to file 'xsl/<script_id>.xml' (for debugging)
$GLOBALS['log_xml_document'] = false;

// set date format - choose one of the following
$GLOBALS['date_format'] = 'dmy';
//$GLOBALS['date_format'] = 'mdy';
//$GLOBALS['date_format'] = 'ymd';

// use HTTPS for all web pages
$GLOBALS['use_https'] = false;

?>
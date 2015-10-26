<?php

/*
 * Settings files. Settings files can be in json, ini or Yaml style.
 * There are three levels of configuration files.
 *  1. system wise 
 *  2. document wise
 *  3. page wise
 * 
 * The document and page wise paths can be obtained
 * automatically
 * 
 * The system wise paths can be redefined by the user
 *  
 **/
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Option settings for system set-up.
 * This is basically paths and naming conventions
 * These can also be modified by the user on
 * a document base by using the .ini settings file, on
 * document by document basis
 * 
 * We set defaults for image paths
 * based on cloud or local views.
 * 
 */
$config['deploy'] = 'local'; //use 'cloud' or 'local' 
// comment the below to run locally
$config['deploy'] = 'cloud'; //use 'cloud' or 'local' 
$config['images_folder'] = 'stamp-images'; // for local development

/**
 * Reading and writing data to cloud
 *  Deploy amazon
 */
$temp_var = $config['deploy'];
         
if ($temp_var === 'cloud') {
    $config['images_bucket'] = 'stamp-images'; // for amazon or other cloud deployment
    $config['datasource'] = 'S3'; // use S3 as datasource for all text
    $config['datasource_images'] = 'S3'; //use S3 as datasource for images
    $config['cloud_images_base_url'] = 'http://d12vftppm9iajg.cloudfront.net';//
	
	$config['cloud_images_base_url'] ='https://s3-us-west-2.amazonaws.com';
	$config['images_base_url']=  'http://d12vftppm9iajg.cloudfront.net/';
	$config['images_base_url']='http://stamp-images.S3.amazonaws.com/';
	//$config['cloud_images_base_url'] ='https://s3-us-west-2.amazonaws.com';
	$domain_name = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    
	$domain_name = str_replace('/', '', $domain_name);
	$config['domain_name'] = $domain_name;  
    $config['content_base'] = FCPATH;
	$config['system_settings_path'] = FCPATH .'/tex-templates/settings.ini'; //
   
} else {
    /**
     * There is some duplication here of settings between
     * CodeIgniter's and our own, however naming conventions are unique
     * 
     */
    $config['local_server'] = 'http://localhost/'; // for local development
    $config['images_bucket'] = 'stamp-images'; // for amazon or cloud deployment
    $config['datasource'] = 'stamp-images'; // use S3 as datasource for all text
    $config['datasource_images'] = 'stamp-images'; //use S3 as datasource for images
    $domain_name = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	$domain_name = str_replace('/', '', $domain_name);
	$config['domain_name'] = $domain_name;  
    $config['content_base'] = FCPATH;
    $config['system_settings_path'] = FCPATH .'/tex-templates/settings.ini'; //
    $config['images_base_url']= site_url('stamp-images') . '/';
   
}


/**
 * Encryption of text files
 * You can encrypt and decrypt text files.
 * On localhost, I don't recommend you enable this setting, as 
 * it is better for longevity of files to be in text. 
 * 
 * However, you may want to do this on files stored on the cloud.
 */

$config['encryption_local'] = FALSE;
$config['encryption_cloud'] = TRUE;
$config['encryption_method'] = 'AES'; //strings are available as per PHP

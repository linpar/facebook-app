<?php 
 /** Setting default timezone **/
date_default_timezone_set('Asia/Calcutta');

/** Facebook App Settings **/
$fb_app_id = '';
$fb_app_sec = '';
//link to shared on facebook
$facebook_link = '';
// Use {{level}} and {{website_title}} to embed user's current level and website's title respectively in the facebook message.
$facebook_message = '';

/** App's Configuration **/
$domain = '';	// Address of site
$base = '';	// Address of script

$root = explode('\\', $_SERVER['DOCUMENT_ROOT']);
$root =  ; // Add root path of script after '/' and end it with '/'

/** App's Basic Details **/
$website_title = '';
$website_description = '';
$website_logo = $base . 'images/logo.png';

/** Database Settings **/
$db_host = '';
$db_user = '';
$db_password = '';
$db_name = ''

/** DO NOT CHANGE **/
$page_url = 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
$session_name = '_nit_fb_app';
$https_on = false;
?>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

/** Setting default timezone **/
date_default_timezone_set('Asia/Calcutta');


/** Facebook App Settings **/
$fb_app_id = '580742098678603';
$fb_app_sec = '7c2f337401d51b862d8fbedbd6e23d66';
//link to shared on facebook
$facebook_link = 'http://www.refiral.com';
// Use {{level}} and {{website_title}} to embed user's current level and website's title respectively in the facebook message. 
$facebook_message = 'Hey! I just cleared level {{level}} of {{website_title}}. Join me if you think you can beat me!';


/** App's Configuration **/
$domain = 'http://localhost/';	// Address of site
$base = 'http://localhost/fb';	// Address of script

$root = explode('\\', $_SERVER['DOCUMENT_ROOT']);
$root =  $root[0] . '/fb/'; // Add root path of script after '/' and end it with '/'


/** App's Basic Details **/
$website_title = 'Nitish Test App';
$website_description = 'This is a test facebook app';
$website_logo = $base . 'images/logo.png';


/** Database Settings **/
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'nitish';
$db_name = 'fb';


/** DO NOT CHANGE **/
$page_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$session_name = '_nit_fb_app';
$https_on = false;
?>
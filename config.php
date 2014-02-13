<?php

/** Facebook App Settings **/
$fb_app_id = '580742098678603';
$fb_app_sec = '7c2f337401d51b862d8fbedbd6e23d66';

/** App's Configuration **/
$domain = 'http://www.linpar.tk/';	// Address of site
$base = 'http://fb.linpar.tk/';	// Address of script

$root = explode('\\', $_SERVER['DOCUMENT_ROOT']);
$root =  $root[0] . '/fb/'; // Add root path of script after '/' and end it with '/'

/** App's Basic Details **/
$website_title = 'Nitish Test App';
$website_description = 'This is a test facebook app';
$website_logo = $base . 'images/logo.png';


/** DO NOT CHANGE **/
$page_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
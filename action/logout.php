<?php
// Configuration
if (file_exists('../config.php'))
  	require_once('../config.php');
else
	exit('Error: Configuration file missing!');

// Required Functions and Classes
require_once($root.'inc/functions.inc.php');
require_once($root.'classes/sessions.cls.php');
require_once($root.'classes/user.cls.php');

$session = new session();
$session->startSession($session_name, $https_on);
$user = new user();
$user->logout($base);
?>
<?php
$root = explode('\\', $_SERVER['DOCUMENT_ROOT']);
$root =  $root[0]; // Add root path of script after '/' and end it with '/'

$str = file_get_contents('php://input');
parse_str($str);

$data = '<?php '.PHP_EOL.' /** Setting default timezone **/'
.PHP_EOL
.'date_default_timezone_set(\'Asia/Calcutta\');'
.PHP_EOL
.PHP_EOL
.'/** Facebook App Settings **/'
.PHP_EOL
.'$fb_app_id = \''.$fb_app_id.'\';'
.PHP_EOL
.'$fb_app_sec = \''.$fb_app_secret.'\';'
.PHP_EOL
.'//link to shared on facebook'
.PHP_EOL
.'$facebook_link = \''.$fb_link.'\';'
.PHP_EOL
.'// Use {{level}} and {{website_title}} to embed user\'s current level and website\'s title respectively in the facebook message.'
.PHP_EOL
.'$facebook_message = \''.$fb_message.'\';'
.PHP_EOL
.PHP_EOL
.'/** App\'s Configuration **/'
.PHP_EOL
.'$domain = \''.$main_url.'\';	// Address of site'
.PHP_EOL
.'$base = \''.$app_url.'\';	// Address of script'
.PHP_EOL
.PHP_EOL
.'$root = explode(\''."\\\\".'\', $_SERVER[\'DOCUMENT_ROOT\']);'
.PHP_EOL
.'$root =  '.$app_base.'; // Add root path of script after \'/\' and end it with \'/\''
.PHP_EOL
.PHP_EOL
.'/** App\'s Basic Details **/'
.PHP_EOL
.'$website_title = \''.$website_title.'\';'
.PHP_EOL
.'$website_description = \''.$website_description.'\';'
.PHP_EOL
.'$website_logo = $base . \'images/logo.png\';'
.PHP_EOL
.PHP_EOL
.'/** Database Settings **/'
.PHP_EOL
.'$db_host = \''.$database_host.'\';'
.PHP_EOL
.'$db_user = \''.$database_user.'\';'
.PHP_EOL
.'$db_password = \''.$database_password.'\';'
.PHP_EOL
.'$db_name = \''.$database_name.'\''
.PHP_EOL
.PHP_EOL
.'/** DO NOT CHANGE **/'
.PHP_EOL
.'$page_url = \'http://\'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];'
.PHP_EOL
.'$session_name = \'_nit_fb_app\';'
.PHP_EOL
.'$https_on = false;'
.PHP_EOL.'?>';

$file = '../config.php';
if(file_put_contents($file, $data))
	echo 'Done';
?>
<?php
ob_start();
// Configuration
if (file_exists('config.php'))
  	require_once('config.php');
else
	exit('Error: Configuration file missing!');

// Required Functions and Classes
require_once($root.'inc/functions.inc.php');
require_once($root.'classes/database.cls.php');
require_once($root.'classes/sessions.cls.php');
require_once($root.'classes/user.cls.php');
require_once($root.'src/facebook.php');

$session = new session();
$session->startSession($session_name, $https_on);
$db = new database();
$user = new user($db);

if($user->guest)
{
  	$page_title = 'Welcome';

  	$config = array(
    	'appId' => $fb_app_id,
    	'secret' => $fb_app_sec,
    	'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  	);

  	$facebook = new Facebook($config);
  	$user_id = $facebook->getUser();
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$include_main_css = 1;
	$include_lightbox = 1;
	include_once($root.'inc/header.inc.php');

	?>
</head>
<body>
	<div class="main_container">
		<div id="fb-root"></div>
	    <script>               
	      window.fbAsyncInit = function() {
	        FB.init({
	          appId: '<?php echo $facebook->getAppID() ?>', 
	          cookie: true, 
	          xfbml: true,
	          oauth: true
	        });
	        FB.Event.subscribe('auth.login', function(response) {
	          window.location.reload();
	        });
	        FB.Event.subscribe('auth.logout', function(response) {
	          window.location.reload();
	        });
	      };
	      (function() {
	        var e = document.createElement('script'); e.async = true;
	        e.src = document.location.protocol +
	          '//connect.facebook.net/en_US/all.js';
	        document.getElementById('fb-root').appendChild(e);
	      }());
	    </script>
		<?php include_once($root.'/inc/navbar.inc.php'); ?>
		
		<div class="container">
		  	<?php
		    if($user_id) {
		      	try {
		      		$user_profile = $facebook->api('/me','GET');
		      	} catch(FacebookApiException $e) {
			        $login_url = $facebook->getLoginUrl( array(
		                       	'scope' => 'email,publish_stream'
		                       	));
		        	error_log($e->getType());
		        	error_log($e->getMessage());
		      	}
		    } else {
		      	$login_url = $facebook->getLoginUrl( array( 'scope' => 'email,publish_stream' ) );
		    }
		    
		  	?>
	  		<div class="row">
	  			<div class="col-md-6">
	  				<?php include_once($root.'inc/register.inc.php'); ?>
				</div>
				<div class="col-md-4 col-md-offset-1">
	  				<?php include_once($root.'inc/login.inc.php'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?php include_once($root.'inc/footer.inc.php'); ?>

	<?php include_once($root.'inc/rules.inc.php'); ?>

	<script>
	  $('.btn-load').click(function () {
	    var btn = $(this);
	    btn.button('loading');
	  });
	</script>
</body>
</html>
	<?php
}
else
{
	$user->getUser($db);
	redirect($base.'/level/'.$user->level);
}
ob_flush();
?>
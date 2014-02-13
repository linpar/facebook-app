<?php
  	require_once('config.php');
  	require_once('src/facebook.php');
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
  		<?php include_once($root.'inc/header.inc.php'); ?>
  		
  	</head>
  	<body>
		<div class="container">
		  	<?php
		    if($user_id) {
		      	try {
		      		$user_profile = $facebook->api('/me','GET');
		      	} catch(FacebookApiException $e) {
			        $login_url = $facebook->getLoginUrl( array(
		                       	'scope' => 'publish_stream'
		                       	)); 
		        	echo 'Please <a href="' . $login_url . '">login.</a>';
		        	error_log($e->getType());
		        	error_log($e->getMessage());
		      	}   
		    } else {
		      	$login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream' ) );
		      	echo 'Please <a href="' . $login_url . '">login.</a>';
		    } 
		  	?>
		  	<form role="form" method="POST">
		  		<div class="row">
		  			<div class="col-md-6">
					  	<div class="form-group">
					    	<label for="first_name">First Name</label>
					    	<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_profile['first_name'];?>" placeholder="Enter your first name">
					  	</div>
					  	<div class="form-group">
					    	<label for="last_name">Last Name</label>
					    	<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_profile['last_name'];?>" placeholder="Enter your last name">
					  	</div>
					  	<div class="form-group">
					    	<label for="email">Email id</label>
					    	<input type="email" class="form-control" id="email" name="email" value="<?php echo $user_profile['email'];?>" placeholder="Enter your email id">
					  	</div>
					  	<div class="form-group">
					    	<label for="location">Location</label>
					    	<input type="text" class="form-control" id="location" name="location" value="<?php echo $user_profile['location']['name'];?>" placeholder="Enter your location">
					  	</div>
					  	<div class="form-group">
					    	<label for="college">College/School Name</label>
					    	<input type="text" class="form-control" id="college" name="college" value="<?php echo $user_profile['education'][0]['school']['name'];?>" placeholder="Enter your college/school name">
					  	</div>
					  	<div class="form-group">
					    	<label for="username">Username</label>
					    	<input type="text" class="form-control" id="username" name="username" value="<?php echo $user_profile['username'];?>" placeholder="Enter your username">
					  	</div>
					  	<div class="form-group">
					    	<label for="password">Password</label>
					    	<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
					  	</div>
					  	<button class="btn btn-primary" type="submit">Register</button>
					</div>
				</div>
			</form>
		</div>
  	</body> 
</html>
<?php
  	require_once('config.php');
  	require_once('src/facebook.php');

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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Meta Tags -->
		<meta name="title" content="Welcome | <?php echo $website_title;?>">
		<meta name="description" content="<?php echo $website_description;?>">

		<!-- Facebook Meta Tags -->
		<meta property="og:title" content="Welcome | <?php echo $website_title;?>"/>
		<meta property="og:url" content="<?php echo $page_url;?>"/>
		<meta property="og:site_name" content="<?php echo $website_title;?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:image" content="<?php echo $website_logo;?>"/>
		<meta property="og:description" content="<?php echo $website_description;?>"/>
	
  		<link rel="stylesheet" type="text/css" href="<?php echo $base;?>/css/bootstrap.min.css">
  		<title>Welcome | <?php echo $website_title;?></title>
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
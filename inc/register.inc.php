<?php
if($user->guest)
{
	if(isset($_POST['submit_register']))
	{
		$email = $_POST['email'];
		$username = $_POST['username'];
		if($result = $db->select("nit_users","uid","email='$email'") || $db->select("nit_users","uid","username='$username'"))
		{
			echo '<div class="alert alert-danger alert-dismissable">Email id or username already exists.<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
		}
		else
		{
			$password = $user->password($_POST['password']);
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$location = $_POST['location'];
			$college = $_POST['college'];
			$level = 0;
			$registration_time = time();
			$columns = "first_name, last_name, email, location, college, username, password, level, registration_time";
			$values = "'$first_name','$last_name','$email','$location','$college','$username','$password','$level','$registration_time'";
			if($db->insert('nit_users',$columns,$values))
				echo '<div class="alert alert-success alert-dismissable">You have registered successfuly. You may log in now.<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
		}
	}
	?>
	<div class="page-header">
		<h1><span class="glyphicon glyphicon-ok-sign"></span> Sign up <small>to participate <?php if(isset($login_url)) { ?><fb:login-button perms="email,publish_stream" max_rows="1" size="medium" show_faces="false" auto_logout_link="false"></fb:login-button> <?php } else echo '<small>(Connected to Facebook)</small>';?></small></h1>
	</div>
	<form method="POST" action="<?php echo $page_url;?>">
		<div class="form-group">
			<label for="first_name">First Name</label>
			<input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(isset($user_profile['first_name'])) echo $user_profile['first_name'];?>" placeholder="Enter your first name">
		</div>
		<div class="form-group">
			<label for="last_name">Last Name</label>
			<input type="text" class="form-control" id="last_name" name="last_name" value="<?php if(isset($user_profile['last_name']))  echo $user_profile['last_name'];?>" placeholder="Enter your last name">
		</div>
		<div class="form-group">
			<label for="email">Email id</label>
			<input type="email" class="form-control" id="email" name="email" value="<?php if(isset($user_profile['email']))  echo $user_profile['email'];?>" placeholder="Enter your email id">
		</div>
		<div class="form-group">
			<label for="location">Location</label>
			<input type="text" class="form-control" id="location" name="location" value="<?php if(isset($user_profile['location']['name']))  echo $user_profile['location']['name'];?>" placeholder="Enter your location">
		</div>
		<div class="form-group">
			<label for="college">College/School Name</label>
			<input type="text" class="form-control" id="college" name="college" value="<?php if(isset($user_profile['education'][0]['school']['name']))  echo $user_profile['education'][0]['school']['name'];?>" placeholder="Enter your college/school name">
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" value="<?php if(isset($user_profile['username']))  echo $user_profile['username'];?>" placeholder="Enter your username">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
		</div>
		<button class="btn btn-primary btn-load" name="submit_register" data-loading-text="Signing up..." type="submit">Sign Up</button>
	</form>
<?php
if(!isset($login_url) && isset($user_profile['email']))
{
	$fb_email = $user_profile['email'];
	if($db->select("nit_users","email","email='$fb_email'"))
	{
		$user->login($db, $fb_email, '', 'facebook', $base.'/level/');
	}
}
}
?>
<?php
if($user->guest)
{
	if(isset($_POST['submit_login']))
	{
		$email = $_POST['email'];
		if($result = $db->select("nit_users","uid","email='$email'"))
		{
				$user->login($db, $_POST['email'],$_POST['password'],'form',$base.'/level/');
		}
		else
		{
			echo '<div class="alert alert-danger alert-dismissable">Email id is not correct.<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
		}
	}
	?>
	<div class="page-header">
		<h1><span class="glyphicon glyphicon-log-in"></span> Sign in <small>to play</small></h1>
	</div>
	<form method="POST" action="<?php echo $page_url;?>">
	  	<div class="form-group">
	    	<label for="login-email">Email id</label>
	    	<input type="email" class="form-control" id="login-email" name="email" value="<?php if(isset($user_profile['email']))  echo $user_profile['email'];?>" placeholder="Enter your email id">
	  	</div>
	  	<div class="form-group">
	    	<label for="login-password">Password</label>
	    	<input type="password" class="form-control" id="login-password" name="password" placeholder="Enter your password">
	  	</div>
		<button class="btn btn-primary btn-load" name="submit_login" data-loading-text="Logging in..." type="submit">Log in</button>
	</form>
<?php
}
?>
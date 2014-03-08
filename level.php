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
require_once($root.'classes/level.cls.php');
require_once($root.'src/facebook.php');

$session = new session();
$session->startSession($session_name, $https_on);
$db = new database();
$user = new user($db);
if($user->guest)
	redirect($base);
else if($user->level != $_GET['level'])
	redirect($base.'/level/'.$user->level);


$level = new level($db, $_GET['level']);

if($level->exists)
{
	//Checking for correct answer
	if(isset($_POST['submit_answer']))
	{
		$answer = $_POST['answer'];
		if($level->checkAnswer($db, $user->level, $answer))
		{
			$config = array(
		    	'appId' => $fb_app_id,
		    	'secret' => $fb_app_sec,
		    	'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
		  	);

		  	$facebook = new Facebook($config);
		  	$user_id = $facebook->getUser();
		  	if($user_id) 
		  	{
	      		try 
	      		{
	      			$facebook_message = str_replace(array('{{level}}','{{website_title}}'), array($user->level,$website_title), $facebook_message);
	        		$ret_obj = $facebook->api('/me/feed', 'POST',
	                                    array(
	                                      'link' => $facebook_link,
	                                      'message' => $facebook_message
	                                 ));
	      		} catch(FacebookApiException $e) {
	        		$user->logout($base);
	      		}   
		    } 
		    else
	        	$user->logout($base);
			$user->nextLevel($db);
		}
	}
	$page_title = 'Level '.$level->level_id;
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
		<?php include_once($root.'/inc/navbar.inc.php'); ?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-8 col-centered">
					<div class="level-text"><h1>Level <?php echo $level->level_id;?></h1></div>
					<hr class="hr_after_level_head"/>
			  		<?php
			  		echo $level->question == ''?'':'<div class="question-text"><h3>'.$level->question.'</h3></div>';
			  		echo $level->image == ''?'':
			  			'<div class="row">
			  				<div class="col-md-6 col-centered">
			  					<div class="question-image">
			  						<a href="'.$base.'/images/questions/'.$level->image.'" data-lightbox="'.$level->question.'">
			  							<img src="'.$base.'/images/questions/'.$level->image.'" class="img-responsive img-rounded col-centered"/>
			  						</a>
			  						<p class="text-center"><small>(Click on image to see bigger version)</small></p>
			  					</div>
			  				</div>
			  			</div>';
			  		?>

		  			<div class="container-fluid">
		  				<div class="col-xs-12 col-sm-4 col-md-5 col-md-offset-4">
		  					<form class="form-inline" role="form" action="<?php echo $page_url;?>" method="POST">
					  			<div class="form-group col-xs-9">
					  				<input class="form-control answer-box" id="answer" type="text" name="answer"/>
					  			</div>
					  			<div clas="col-xs-4">
					  				<button class="btn btn-primary" type="submit" name="submit_answer">Submit</button>
					  			</div>
					  		</form>
					  	</div>
					</div>
		  			<div id="answer-message"></div>
		  		</div>
	  		</div>
		</div>
	</div>
	<?php include_once($root.'inc/footer.inc.php'); ?>

	<?php include_once($root.'inc/rules.inc.php'); ?>

</body>
<script>
$( document ).ready(function() {
	$('#answer').focus();
});
</script>
</html>
  	<?php
}
else
{
	$page_title = '404 Level '.$level->level_id.' not found';
	?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$include_main_css = 1;
$include_lightbox = 0;
include_once($root.'inc/header.inc.php');
?>

</head>
<body>
	<div class="main_container">
		<?php include_once($root.'/inc/navbar.inc.php'); ?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-8 col-centered">
					<div class="jumbotron alert-warning" style="margin-top:80px;">
						<h1 class="text-center">This level does not exist.</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once($root.'inc/footer.inc.php'); ?>

	<?php include_once($root.'inc/rules.inc.php'); ?>

</body>
</html>
<?php
}
ob_flush();
?>
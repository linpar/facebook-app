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

$session = new session();
$session->startSession($session_name, $https_on);
$db = new database();
$user = new user($db);
if($user->guest)
	redirect($base);
$participants = $db->select("nit_users","*","1 ORDER BY level DESC, last_correct_time");
$page_title = 'Leaderboard';
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
				<div class="page-header">
  					<h1><span class="glyphicon glyphicon-stats"></span> Leaderboard <small>see who's on top</small></h1>
				</div>
				<div class="table-responsive">
					<table class="table">
						<tr><td>#</td><td><strong>Username</strong></td><td><strong>College</strong></td><td><strong>Level <span class="text-muted">(last submission at)</span></strong></td></tr>
						<?php
						$i = 0;
						foreach($participants as $participant)
						{
							$time = date("F j, Y, g:i a", $participant['last_correct_time']);
							if($i == 0 || $i == 1 || $i == 2)
								echo '<tr class="success">';
							else
								echo $participant['username'] == $user->username?'<tr class="info">':'<tr>';
							echo '<td>'.($i+1).'</td>';
							echo '<td>'.$participant['username'].'</td>';
							echo '<td>'.$participant['college'].'</td>';
							echo '<td>'.$participant['level'].' ('.$time.')</td>';
							echo '</tr>';
							$i++;
						}
						?>
					</table>
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
ob_flush();
?>
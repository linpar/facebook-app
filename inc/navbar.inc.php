<nav class="navbar navbar-default navbar-fixed-top navbar-custom" role="navigation">
  	<div class="container-fluid">
    	<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
      		</button>
      		<a class="navbar-brand" href="<?php echo $base;?>"><?php echo $website_title;?></a>
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
	        	<li><a class="btn" href="<?php echo $base;?>"><small class="glyphicon glyphicon-home"></small> Home</a></li>
	        	<?php
	        	if(basename($_SERVER['PHP_SELF']) != 'index.php')
	        	{
	        		echo '<li><a class="btn" href="'.$base.'/level/'.$user->level.'"><small class="glyphicon glyphicon-flash"></small> Play</a></li>';
	        		echo '<li><a class="btn" href="'.$base.'/leaderboard"><small class="glyphicon glyphicon-stats"></small> Leaderboard</a></li>';
	        		echo '<li><a class="btn" href="'.$base.'"><small class="glyphicon glyphicon-user"></small> Team</a></li>';
	        		echo '<li><a class="btn" href="'.$base.'/action/logout"><small class="glyphicon glyphicon-log-out"></small> Log Out</a></li>';
	        	}
	        	else {
	        		echo '<li><a class="btn" href="#" data-toggle="modal" data-target="#rulesModel"><small class="glyphicon glyphicon-book"></small> Rules</a></li>';
	        		echo '<li><a class="btn" href="'.$base.'"><small class="glyphicon glyphicon-user"></small> Team</a></li>';
	        	}
	        	?>
	        </ul>
    	</div>
  	</div>
<hr class="nav-bottom b1"/>
<hr class="nav-bottom b2"/>
</nav>
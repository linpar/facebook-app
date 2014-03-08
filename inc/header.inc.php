<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="<?php echo $page_title . ' | ' . $website_title;?>">
	<meta name="description" content="<?php echo $website_description;?>">

	<!-- Facebook Meta Tags -->
	<meta property="og:title" content="<?php echo $page_title . ' | ' . $website_title;?>"/>
	<meta property="og:url" content="<?php echo $page_url;?>"/>
	<meta property="og:site_name" content="<?php echo $website_title;?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="<?php echo $website_logo;?>"/>
	<meta property="og:description" content="<?php echo $website_description;?>"/>

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<?php echo $page_url;?>">
	<meta name="twitter:title" content="<?php echo $page_title . ' | ' . $website_title;?>">
	<meta name="twitter:description" content="<?php echo $website_description;?>">
	<meta name="twitter:image" content="<?php echo $website_logo;?>">

	<link rel="stylesheet" type="text/css" href="<?php echo $base;?>/css/bootstrap.min.css">
	<?php 
	echo $include_main_css == 1?'<link rel="stylesheet" type="text/css" href="'.$base.'/css/main.css">':'';
	?>

	<?php
	echo $include_lightbox == 1?'<link rel="stylesheet" type="text/css" href="'.$base.'/css/lightbox.css" media="screen">':'';
	?>

	<script src="<?php echo $base;?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo $base;?>/js/bootstrap.min.js"></script>
	<?php
	echo $include_lightbox == 1?'<script src="'.$base.'/js/lightbox.min.js"></script>':'';
	?>

	<title><?php echo $page_title . ' | ' . $website_title;?></title>
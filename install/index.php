<?php
$root = explode('\\', $_SERVER['DOCUMENT_ROOT']);
$root =  $root[0]; // Add root path of script after '/' and end it with '/'
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Install</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap-wizard.css" rel="stylesheet" />
		<link href="css/chosen.css" rel="stylesheet" />
		<style type="text/css">
			.wizard-modal p {
				margin: 0 0 10px;
				padding: 0;
			}

			#wizard-ns-detail-servers, .wizard-additional-servers {
				font-size: 12px;
				margin-top: 10px;
				margin-left: 15px;
			}
			#wizard-ns-detail-servers > li, .wizard-additional-servers li {
				line-height: 20px;
				list-style-type: none;
			}
			#wizard-ns-detail-servers > li > img {
				padding-right: 5px;
			}

			.wizard-modal .chzn-container .chzn-results {
				max-height: 150px;
			}
			.wizard-addl-subsection {
				margin-bottom: 40px;
			}
			.create-server-agent-key {
				margin-left: 15px; 
				width: 90%;
			}
		</style>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv-3.7.0.js"></script>
		<script src="js/respond-1.3.0.min.js"></script>
		<![endif]-->
	</head>
	<body style="padding:30px;">

		<div class="wizard" id="satellite-wizard" data-title="Install">

			<!-- Step 1 Name & FQDN -->
			<div class="wizard-card" data-cardname="name">
				<h3>Website Details</h3>

				<div class="wizard-input-section">
					<p>
						Website Title
					</p>
					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="website_title" name="website_title" placeholder="Website Title" data-validate="validateWebsiteTitle">
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Website Description
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="website_description" name="website_description" placeholder="Website Description" data-validate="validateWebsiteTitle" />
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Website Logo
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="website_logo" name="website_logo" placeholder="Website Logo" data-serialize="1" data-validate="validateWebsiteTitle" />
						</div>
					</div>
				</div>
			</div>

			<div class="wizard-card" data-cardname="group">
				<h3>Database Details</h3>

				
				<div class="wizard-input-section">
					<p>
						Database Host
					</p>
					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="database_host" name="database_host" placeholder="Database Host" data-validate="validateWebsiteTitle">
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Database User
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="database_user" name="database_user" placeholder="Database User" data-validate="validateWebsiteTitle" />
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Database Password
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="database_password" name="database_password" placeholder="Database Password" data-validate="validateWebsiteTitle"/>
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Database Name
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="database_name" name="database_name" placeholder="Database Name" data-validate="validateWebsiteTitle" data-serialize="1" />
						</div>
					</div>
				</div>
			</div>

			<div class="wizard-card" data-cardname="group">
				<h3>URLs</h3>

				<div class="wizard-input-section">
					<p>
						Main Website URL
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" value="<?php echo dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>" class="form-control" id="main_url" name="main_url" placeholder="Main Website URL" data-validate="validateWebsiteTitle"/>
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						App URL
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" value="<?php echo dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>" class="form-control" id="app_url" name="app_url" placeholder="App URL" data-validate="validateWebsiteTitle" />
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						App Base Location
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" value="<?php echo ($root);?>" class="form-control" id="app_base" name="app_base" placeholder="App Base Location" data-validate="validateWebsiteTitle" data-serialize="1" />
						</div>
					</div>
				</div>
			</div>

			<div class="wizard-card" data-cardname="group">
				<h3>Facebook Application Details</h3>

				<div class="wizard-input-section">
					<p>
						Facebook App ID
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="fb_app_id" name="fb_app_id" placeholder="Facebook App ID" data-validate="validateWebsiteTitle"/>
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Facebook App Secret Key
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="fb_app_secret" name="fb_app_secret" placeholder="Facebook App Secret Key" data-validate="validateWebsiteTitle" data-serialize="1" />
						</div>
					</div>
				</div>
				<div class="wizard-input-section">
					<p>
						Facebook Link (to be posted on user profile)
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="fb_link" name="fb_link" placeholder="Facebook Link (to be posted on user profile)" data-validate="validateWebsiteTitle"/>
						</div>
					</div>
				</div>

				<div class="wizard-input-section">
					<p>
						Facebook Message (to be posted on user profile)
					</p>

					<div class="form-group">
						<div class="col-sm-6">
							<input type="text" class="form-control" id="fb_message" name="fb_message" placeholder="Facebook Message (to be posted on user profile)" data-validate="validateWebsiteTitle" data-serialize="1" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/jquery-2.0.3.min.js" type="text/javascript"></script>
		<script src="js/chosen.jquery.js"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/prettify.js" type="text/javascript"></script>
		<script src="js/bootstrap-wizard.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.fn.wizard.logging = true;
				var wizard = $('#satellite-wizard').wizard({
					keyboard : false,
					contentHeight : 500,
					contentWidth : 900,
					backdrop: 'static',
					show: true,
					showClose: false,
					submitUrl: '<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>/save.php'
				});
				
				wizard.on("submit", function(wizard) {
				    $.ajax({
				        url: "save.php",
				        type: "POST",
				        data: wizard.serializeArray(),
				        dataType: "json"
				    }).done(function(response) {
				       setTimeout(function() {
							wizard.trigger("success");
							wizard.hideButtons();
							wizard._submitting = false;
							wizard.showSubmitCard("success");
							wizard.updateProgressBar(0);
						}, 2000);  // sets the progress meter to 0
				    }).fail(function() {
				       setTimeout(function() {
							wizard.trigger("success");
							wizard.hideButtons();
							wizard._submitting = false;
							wizard.showSubmitCard("success");
							wizard.updateProgressBar(0);
						}, 2000);  // sets the progress meter to 0
				    });
				});
				wizard.show();
			});

			function validateWebsiteTitle(el) {
				var name = el.val();
				var retValue = {};
				
				if (name == "") {
					retValue.status = false;
					retValue.msg = "Please enter a label";
				} else {
					retValue.status = true;
				}
retValue.status = true;
				return retValue;
			};
		</script>
	</body>
</html>

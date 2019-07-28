<?php include ("functions.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>HOSTELS BOOKING SITE</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="css/fontawesome.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
		<link rel="stylesheet" type="text/css" href="css/select2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/select2-bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="js/intl-tel-input-master/css/intlTelInput.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css"  />
		<style>
			.nav_header{background-color:#000000;}
			.navbar{width:100%; font-size:20px; font-family:comic sans ms;}
			#hostels:hover{opacity:0.5;}
			#host:hover{opacity:0.5;}
			.image{border:2px solid #808080; border-radius:5px;}
			.search{padding:4px; border-radius:5px; border:4px solid #808080; margin:10px;}
			@media screen and (min-width:770px){
				.thumbnail{overflow:hidden;}
			}
			@media screen and (max-width:769px){
				
			}
			div#pagination_ctrls{font-size:21px;}
			div#pagination_ctrls > a {color:#06F;}
			div#pagination_ctrls > a:visited {color:#06F;}
			#hostels{display:inline-block;}
			.warning_msg{
				color:#FF0000;
			}
			.warning_bd{
				border:1px solid #FF0000;
			}
			.nav-link{
				color:#FFFFFF;
				/*font-weight:bolder;*/
			}
		</style>
		<!--GOOOGLE ADDS SECTION-->
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		  (adsbygoogle = window.adsbygoogle || []).push({
		    google_ad_client: "ca-pub-1502767359482519",
		    enable_page_level_ads: true
		  });
		</script>
	</head>
	<body id="MainBody">
			<header class="sticky-top">
				<div class="container-fluid" style="background-color:#FFFFFF;">
					<div class="row">
						<div class="col-md-7">
							<img class="logo" src="images/logo.jpg" style="width:100%;"/><br />
						</div>
						<div class="col-md-5">
							 <div class="form-group has-feedback">
								<input type="text" id="hostelSearch" class="form-control"  placeholder="Search by city, location, locality, name, gender..."  />
								<span class="fa fa-search form-control-feedback"></span>
							 </div>
						</div>
					</div>
				</div>
				<div class="container-fluid nav_header">
					<nav  class="navbar navbar-expand-md" role="navigation">
							<button class="navbar-toggler navbar-right" type="button" data-toggle="collapse" data-target="#dropNav" style="float:right;">
								<img src="images/menu.png" alt="MENU"/>
								<span class="fas fa-search" style="color:#FFFFFF; font-weight:bolder;"></span>
							</button>
						<div class="navbar-collapse collapse" id="dropNav">
							<ul class="nav navbar-nav navbar-left">
								<li class="nav-item"><a class="nav-link" href="index.php">Home</a> </li>
								<?php getCat(); ?>
								<li class="nav-item"><a class="nav-link" href="help.support.php">Blog</a></li>
								<li class="nav-item"><a class="nav-link" href="university_admins/login.php" target="_blank">University login</a></li>
								<li class="nav-item"><a class="nav-link" href="students/login.php" target="_blank">Student login</a></li>
								<li class="nav-item"><a class="nav-link" href="system_admin/index.php" target="_blank">Admin</a></li>
								<li class="nav-item"><a class="nav-link" href="contactus.php">Contact us</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
		

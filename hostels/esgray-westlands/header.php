<?php require_once('db.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<title>ESGRAY WESTLANDS MIXED HOSTEL</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="styles/lightbox.min.css" />
		<link rel="stylesheet" type="text/css" href="../../css/select2.min.css" />
		<link rel="stylesheet" type="text/css" href="../../css/select2-bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../../js/intl-tel-input-master/css/intlTelInput.css" />
		<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
		<style>
			*{
				padding:0px;
				margin:0px;
			}
			h4{
				font-weight:bolder; text-align:center;
			}
			.nav-link{color:#FFFFFF;}
			#nav_header{background-color:#BA2BE2; font-family:arial; }
			#footer{background-color:#000000; color:#FFFF00;}
			/*.slideshow{width:100%; margin:auto; border:2px solid #808080;}
			.price{color:#A52A2A; font-weight:bolder;}
			.row h5{font-weight:bolder; color:#FFD700;}
			.modal-content{padding:5px;}
			.ModSubmit{width:100%; background-color:#0000FF; color:#FFFFFF; font-size:20px; padding:4px;}
			.error {color:#FF0000;}
			.link{font-size:20px; color:#FFD700;}
			@media screen and (min-width:770px){
				#map{height:300px;}
				#ApplicationBody{padding:10px;}
				#ber_logo{font-size:30px;}

			}
			.response {color:#FF0000; font-style:italic;}
			#ApplicationSection{margin:auto; background-color:#D3D3D3; padding:20px;}*/
		</style>
	</head>
	<body>
		<header class="sticky-top">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12" style="color:#8A2BE2; font-weight:bolder;">
						<span id="ber_logo">ESGRAY WESTLANDS MIXED HOSTEL</span><br />
						<span id="ber_ch"><i>Our immaculate accommodation facilities will surely make your stay most memorable</i></span>
					</div>
				</div>
			</div>
			<div class="container-fluid" id="nav_header">
				<nav  class="navbar navbar-expand-md" role="navigation">
					<button class="navbar-toggler navbar-right" type="button" data-toggle="collapse" data-target="#dropNav" style="float:right;">
						<i class="fa fa-bars"></i>
					</button>
					<div class="navbar-collapse collapse" id="dropNav">
						<ul class="nav navbar-nav navbar-left">
							<li class="nav-item"><a href="index.php?hsl=<?php echo $_COOKIE['esgray_westlands']?>" class="nav-link">Home</a></li>
							<li class="nav-item"><a href="bookroom.php" class="nav-link">Book Room</a></li>
							<li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
							<li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
							<li class="nav-item"><a href="vacancy.php" class="nav-link">Vacancies</a></li>
							<li class="nav-item"><a href="contact_us.php" class="nav-link">Contact us</a></li>
							<li class="nav-item"><a href="../../admins/login.php" target="_blank" class="nav-link">Admin</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
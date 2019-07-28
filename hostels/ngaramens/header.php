<!DOCTYPE html>
<html>
	<head>
		<title>Ngara men's hostel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="styles/desktop.css" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>  
		<style>
			.navbar{background-color:#006400; font-family:arial; }
			#footer{background-color:#000000; color:#FFFF00;}
			.slideshow{width:100%; margin:auto; border:2px solid #808080;}
			.price{color:#A52A2A; font-weight:bolder;}
			.row h2{font-weight:bolder; color:#A52A2A;}
			.modal-content{padding:5px;}
			.ModSubmit{width:100%; background-color:#0000FF; color:#FFFFFF; font-size:20px; padding:4px;}
			.error {color:#FF0000;}
			.link{font-size:20px;}
			@media screen and (min-width:770px){
				#map{height:300px;}
				.RoomImage{width:100%; height:300px; border:3px solid #808080;}
				#ApplicationBody{padding:10px;}
			}
			@media screen and (max-width:769px){
				.col-sm-8{width:100%; clear:both;}
				.RoomImage{width:100%; height:150px; border:3px solid #808080;}
				
			}
			.response {color:#FF0000; font-style:italic;}
			#ApplicationSection{margin:auto; background-color:#D3D3D3; padding:20px;}
		</style>
	</head>
	<body>
		<header class="row">
			<div class="row">
				<img src="images/logo.jpg" width="100%" />
			</div>
			<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container" style="width:100%;">
					<div class="navbar-header">
						<a href="bookroom.php" class="navbar-brand hidden-lg hidden-md hidden-sm" style="font-family:algerian; font-size:30px; font-weight:bolder; color:#D2691E;">Book room</a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-left">
							<li><a href="index.php" class="link">Home</a></li>
							<li><a href="bookroom.php" class="link">Book Room</a></li>
							<li><a href="gallery.php" class="link">Gallery</a></li>
							<li><a href="blog.php" class="link">Blog</a></li>
							<li><a href="vacancy.php" class="link">Vacancies</a></li>
							<li><a href="contact_us.php" class="link">Contact us</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
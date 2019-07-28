<?php require_once("lib/functions.php") ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Muabatech Movie Shop</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<style>
			.menu{font-size:20px;}
			.aside{background-color:#D3D3D3;}
			#search{border:2px solid #A52A2A; font-size:15px;}
		</style>
	</head>
	<body>
		<header>
			<div class="container" style="width:100%;">
				<div class="row">
					<img src="images/logo.jpg" width="100%" />
				</div>
			</div>
			<nav class="navbar-inverse navbar-static-top" role="navigation">
				<div class="container" style="width:100%;">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only"> Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-left">
							<li class="active"><a href="index.php" class="menu">Home</a></li>
							<?php 
								getCat(); 
							?>

						</ul>
					</div>
				</div>
			</nav> 
		</header>
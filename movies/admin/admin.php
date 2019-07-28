<?php
	/*session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin, please try logging in again!','_self')</script>";
	}else{
	require_once("../lib/functions.php"); */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin page</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/main.css" />
	</head>
	<body>
		<body class="container" style="width:100%">
			<header class="row" style="border-bottom:10px groove #00008B;">
				<img src="images/logo.png" width="100%" class="img-responsive" />
			</header>
			<section class="row">
				<article class="col-lg-10 col-md-10">
					<?php
						if(isset($_GET['add_movie'])){
							require_once("add_movie.php");
						}
					?>
				</article>
				<article class="col-lg-2 col-md-2" style="background-color:#ff4500; border-left:10px groove #00008B; text-align:center; height:1000px;">
					<center><img src="img/andrew.jpg" width="100px" height="100px" class="img-responsive" /><br /></center>
					<h2>Add admin</h2>
					<h2>Edit admin</h2>
					<h2>View all movies</h2>
					<h2><a href="admin.php?add_movie">Add a movie</a></h2>
					<h2><a href="">Logout </a></h2>
				</article>	
			</section>
		</body>
	</body>
</html>
<?php //} ?>

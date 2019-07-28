<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
		include ("functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="styles/admin.css" />
		<link rel="stylesheet" type="text/css" href="../styles/styles.css" />
	</head>
	<body id="adminBody" class="container" style="width:100%;">
		<header class="row" style="border-bottom:10px groove #00008B;">
			<img src="images/logo.png" width="100%" height="150px" />
		</header>
		<!--Mobile menu bar-->
		<nav class="row hidden-lg">
			<i class="fa fa-bars toggle-menu"></i>
			<div class="sidebar_menu">
				<i class="fa fa-times"></i><br />
				<center>
					<div class="AdminUser">
					<?php
						if(isset($_SESSION['username'])){
							echo "<h4 class='boxedItem' style='color:#FFFFFF;'>Welcome &nbsp" . $_SESSION['username'] . "!</h4>";
						}
					?>
				</div>
				<?php
					$user = $_SESSION['username'];
					$getImg="SELECT * FROM admins WHERE admin_username='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					$cImage = $rowImg['admin_pic'];
					echo "<img src='images/$cImage' width='80px' height='80px' style='border:2px solid #000000; padding:2px;'>";
				?>
				</center>
				<h4 class="MenuTitle">Manage Content</h4>
				<ul class="navigationSelection">
					<li class="navigationItems"><a href="admin.php?edit_account" class="AsideLinks">Edit account</a></li>
					<li class="navigationItems"><a href="admin.php?add_admin" class="AsideLinks">Add admin</a></li>
					<li class="navigationItems"><a href="admin.php?add_client" class="AsideLinks">Add client</a></li>
					<li class="navigationItems"><a href="admin.php?view_clients" class="AsideLinks">View clients</a></li>
					<li class="navigationItems"><a href="admin.php?post_vacancies" class="AsideLinks">Post vacancies</a></li>
					<li class="navigationItems"><a href="admin.php?vacancy_applicants" class="AsideLinks">Vacancy applicants</a></li>
					<li class="navigationItems"><a href="admin.php?view_messages" class="AsideLinks">View messages</a></li>
					<li class="navigationItems"><a href="admin.php?post_blog" class="AsideLinks">Post blog</a></li>
					<li class="navigationItems"><a href="admin.php?post_photos" class="AsideLinks">Post photos</a></li>
					<li class="navigationItems"><a href="logout.php" class="AsideLinks">Log out</a></li> 
				</ul>
			</div>
		</nav>
		<!--Mobile menu bar ends here-->
		<section class="row">
			<article class="col-lg-10">
				<?php 
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['add_admin'])){
							if(!isset($_GET['add_client'])){
								if(!isset($_GET['view_clients'])){
									if(!isset($_GET['post_vacancies'])){
										if(!isset($_GET['vacancy_applicants'])){
											if(!isset($_GET['view_messages'])){
												if(!isset($_GET['post_blog'])){
													if(!isset($_GET['post_photos'])){
														if(!isset($_GET['edit_client'])){
															if(!isset($_GET['delete_client'])){
																if(!isset($_GET['search'])){
																	if(!isset($_GET['details'])){
																		if(!isset($_GET['check_out'])){
																		if(!isset($_GET['check_in'])){
																		if(!isset($_POST['search'])){
															echo "
																<div style='text-align:justified;'>
																	<h1 style='text-align:center;'>NOTE</h1><br />
																	We appreciate the efforts you have made to join this platform. We will do our best to ensure maximum productivity of this site to enable you  conduct your businesses and get the maximum profit to your businesses.<br />
																	We would like to bring to your attention that we will give you a <b>hundred(100) days starting from (5<sup>th</sup>,February 2017 to 17<sup>th</sup>,May 2017)</b> to use this site and interact with it and during this period we will enhance the perfomance and features of this site. Any changes you want to be made you may contact us directly throught <b>(0724654808/0775499640)</b> or you can <a href='../../contactus.php' target='_blank'>click here</a> to send as a message.
																	<h1 style='text-align:center;'>Payment</h1>
																	Payment can be made through <b>M-PESA no: 0724654808</b> or through <b>KCB</b> account no: <b>1173070044</b> of which should be made by <b>18<sup>th</sup>,May,2017</b> at 00:00hrs. That will be the time that the site will be unlinked from our website.<br />
																	Ealier payment is encouraged of which you will pay less amount. The total amount for this site when it is fully developed will be:<b>Kshs.25,000</b> but payment before two months is over you will be given a discount of 30% from the full amount that will be :<b>Kshs.17,500</b> that will be by:<b>1<sup>st</sup>April,2017</b>
																	<h1 style='text-align:center;'>Completion of the site</h1>
																	Currently this site is incomplete. 
																	We promise we will do our best so that  by the end of this month the site will be fully functional with an intergrated payment system and receipt printing with a fully functional admin section.
																</div>
															
															";
					}}}}}}}}}}}}}}}}
				?>
				<?php
						if(isset($_GET['edit_account'])){
							include ("edit_account.php");
						}
						if(isset($_GET['add_admin'])){
							include ("add_admin.php");
						}
						if(isset($_GET['add_client'])){
							include ("add_client.php");
						}
						if(isset($_GET['view_clients'])){
							include ("view_client.php");
						}
						if(isset($_GET['post_vacancies'])){
							include ("post_vacancies.php");
						}
						if(isset($_GET['vacancy_applicants'])){
							include ("applicants.php");
						}
						if(isset($_GET['view_messages'])){
							include ("view_messages.php");
						}
						if(isset($_GET['post_blog'])){
							include ("post_blog.php");
						}
						if(isset($_GET['post_photos'])){
							include ("post_images.php");
						}
						if(isset($_GET['edit_client'])){
							include ("edit_client.php");
						}
						if(isset($_GET['delete_client'])){
							include ("delete_client.php");
						}
						if(isset($_GET['search'])){
							include ("search.php");
						}
						if(isset($_GET['details'])){
							include ("details.php");
						}
						if(isset($_GET['check_out'])){
							include ("checked_out.php");
						}
						if(isset($_GET['check_in'])){
							include ("checked_in.php");
						}
						if(isset($_POST['search'])){
							include ("search.php");
						}
				?>
			</article>
			<aside class="col-lg-2 hidden-md hidden-sm hidden-xs" style="background-color:#ff4500; border-left:10px groove #00008B; text-align:center;">
				<div class="AdminUser">
					<?php
						if(isset($_SESSION['username'])){
							echo "Hello &nbsp" . $_SESSION['username'] . "! &nbsp Welcome!";
						}
					?>
				</div>
				<?php
					$user = $_SESSION['username'];
					$getImg="SELECT * FROM admins WHERE admin_username='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					$cImage = $rowImg['admin_pic'];
					echo "<img src='images/$cImage' width='150px' height='150px' style='border:5px solid #000000; padding:2px;'>";
				?>
				
				<h1>Manage Content</h1>
				<a href="admin.php?edit_account" class="AsideLinks">Edit account</a><br />
				<a href="admin.php?add_admin" class="AsideLinks">Add admin</a><br />
				<a href="admin.php?add_client" class="AsideLinks">Add client</a><br />
				<a href="admin.php?view_clients" class="AsideLinks">View clients</a><br />
				<a href="admin.php?check_in" class="AsideLinks">Checked in clients</a><br />
				<a href="admin.php?check_out" class="AsideLinks">Checked out clients</a><br />
				<a href="admin.php?post_vacancies" class="AsideLinks">Post vacancies</a><br />
				<a href="admin.php?vacancy_applicants" class="AsideLinks">Vacancy applicants</a><br />
				<a href="admin.php?view_messages" class="AsideLinks">View messages</a><br />
				<a href="admin.php?post_blog" class="AsideLinks">Post blog</a><br />
				<a href="admin.php?post_photos" class="AsideLinks">Post photos</a><br />
				<a href="logout.php" class="AsideLinks">Log out</a><br />
			</aside>
		</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../../js/jquery-3.1.0.min.js'></\script>");
		</script>
		<script src="../../js/formvalidation.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/main.js"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</body>
</html>
	<?php } ?>
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
																	<p>Welcome to the online booking system. We appreciate the efforts you have made to join the platform and we promise to provide the best services at a very cheap cost.</p>
																	<p>We will design and modify your portal according to your specification. If you need any changes please call <b>0724654808 / 0775499640 </B> or email at <b>andrewmuuyi@yahoo.com/muuyiandrew2015@gmail.com</b> and all the changes shall be made according to your specification</b>
																	<p>We shall give you 3-6 months to use the platform without any payment in which we shall edit and modify the site after which you shall pay us inorder to enable us to develop and improve the site more. The expected amount will be <b>Ksh.30,000</b>.<b><i>Any earlier payment you shall be given a discount of 5000</i></b>.</p>
																	<p>There are some sections that are unavailable like the blogs page and photos section. This ones will be activated upon payment. This is because they occupy alot of space in the servers and we would like to dedicate them to you fully so that you can post more information about your hostels.</p>
																	<h1 style='text-align:center;'>MORE TO COME</h1><br />
																	<p>After complete payment of the site, there are some more modules that we are working on like</p>
																	<ul>
																		<li>Amobile app that will be downloaded from the playstore or any other mobile platform. This will enable you to receive notifications directly to your phone incase of any applications and more on quick access of the site in your phone</li>
																		<li>A desktop application that will be downloaded directly from our site which will help you to manage your hostels easily and the application will be communicating directly with the website hence there will be no need to update the site's content using a browser since you will have a management system that will be communicating directly with the website </li>
																	</ul>
																	<p><i><b>Please in case of any change communicate with as or any addition to your portal you will want us to add communicate with us so that we can provide the best services ever. Any slight problem you experience pliz connect with us so that we can correct and improve our services to you. We hope this platform will improve your business and give you maximum profits</b></i></p>
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
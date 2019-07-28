<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
		include ("functions.php");
		require_once("../../formvalidator.php");
		$validator = new validator();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="styles/admin.css" />
		<style>
		.warning_msg{
			color:#FF0000;
		}
		.warning_bd{
			border:1px solid #FF0000;
		}
		.error{color:#FF0000;}
	</style>
	</head>
	<body id="adminBody" style="width:100%;">
		<header class="row" style="border-bottom:10px groove #00008B;">
			<img src="images/logo.png" width="100%" height="150px" />
			<div class="menu"><span class="menu-text">MENU</span><i class="fa fa-bars"></i></div>
		</header>
		<section id="row">
			<aside class="admin" id="adminMenu" style="background-color:#ff4500;">
				<i class="fa fa-times"></i>
				<center>
				<div class="AdminUser" i>
					<?php
						if(isset($_SESSION['username'])){
							echo "Hello " . $_SESSION['username'] . "! Welcome!";
						}
					?>
				</div>
				<?php
					$user = $_SESSION['username'];
					$getImg="SELECT * FROM admins WHERE admin_username='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					echo '<img src="data:image/jpeg;base64,'.base64_encode($rowImg['admin_pic']).'" width="100px" height="100px" style="border:2px solid #000000; padding:2px;">';
				?>
				</center>
				<nav id="adminNav">
					<h5>Manage Content</h5>
					<ul id="adminNav-ul">
						<li class="has-sub"><a href="#"> Admins section <span class="sub-arrow"></span></a>
							<ul>
								<li><a href="admin.php?edit_account" class="AsideLinks">Edit account</a></li>
								<li><a href="admin.php?add_admin" class="AsideLinks">Add admin</a></li>
							</ul>
						</li>
						
						<li class="has-sub"><a href="#">Clients section <span class="sub-arrow"></span></a> 
							<ul>
								<li><a href="admin.php?add_client" class="AsideLinks">Add client</a></li>
								<li><a href="admin.php?view_clients" class="AsideLinks">View clients</a></li>
								<li><a href="admin.php?check_in" class="AsideLinks">Checked in clients</a></li>
								<li><a href="admin.php?check_out" class="AsideLinks">Checked out clients</a></li>
							</ul>
						</li>
						<li class="has-sub"><a href="#">Transactions sections <span class="sub-arrow"></span></a>
							<ul>
								<li><a href="admin.php?accounts" class="AsideLinks">Accounts</a></li>
								<li><a href="admin.php?payment" class="AsideLinks">Payments</a></li>
								<li><a href="admin.php?suppliers">Suppliers</a></li>
								<li><a href="#">Reports</a></li>
								<li><a href="#">Perfomance charts</a></li>
							</ul>
						</li>
						<li class="has-sub"><a href="#">Vacancy section <span class="sub-arrow"></span></a>
							<ul>
								<li><a href="admin.php?post_vacancies" class="AsideLinks">Post vacancies</a></li>
								<li><a href="admin.php?vacancy_applicants" class="AsideLinks">Vacancy applicants</a></li>
						</ul>
						<li><a href="admin.php?view_messages" class="AsideLinks">View messages</a></li>
						<li><a href="admin.php?post_blog" class="AsideLinks">Post blog</a></li>
						<li><a href="admin.php?change_room" class="AsideLinks">Room photos</a></li>
						<li><a href="admin.php?post_photos" class="AsideLinks">Image gallery</a></li>
						<li><a href="logout.php" class="AsideLinks">Log out</a></li>
					</ul>
				</nav>
			</aside>
			<article class="container admin" id="adminContent">
				<?php 
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
																		if(!isset($_GET['payment'])){
																		if(!isset($_GET['admin_area'])){
																		if(!isset($_GET['edit_account'])){
																		if(!isset($_GET['add_admin'])){
																		if(!isset($_GET['change_room'])){
																		if(!isset($_GET['id'])){
																		if(!isset($_GET['accounts'])){
																		if(!isset($_GET['suppliers'])){
																		echo "
																<div style='text-align:justify;'>
																	<h1 style='text-align:center;'>NOTE</h1><br />
																	<p>For any changes to be made please contact <b>0724654808/0775499640</b> or email <b>andrewmuuyi@yahoo.com/muuyiandrew2015@gmail.com</b>
																</div>
															
															";
							}}}}}}}}}}}}}}}}}}}}}}
				?>
				<?php

						if(isset($_GET['accounts'])){
							include ("accounts.php");
						}
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
							echo "<div class='row'>";
								include ("applicants.php");
							echo "<div class='row'>";
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
						if(isset($_GET['payment'])){
							include ("payment.php");
						}
						if(isset($_GET['admin_area'])){
							include ("admin_area.php");
						}
						if(isset($_GET['change_room'])){
							include ("change_room.php");
						}
						if(isset($_GET['id'])){
							include ("img_del.php");
						}
						if(isset($_GET['suppliers'])){
							include ("suppliers.php");
						}
				?>
			</article>
			
		</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../../js/jquery-3.1.0.min.js'></\script>");
		</script>
		<script src="../../js/formvalidation.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/main.js"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</body>
</html>
	<?php } ?>
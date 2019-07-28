<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('../login.php','_self')</script>";
	}else{
		require_once("db.php");
		require_once ("functions.php");
		require_once("../formvalidator.php");
		$validator = new validator();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap4.css" />
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/select2.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/select2-bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../js/intl-tel-input-master/css/intlTelInput.css" />
		<link rel="stylesheet" type="text/css" href="styles/admin.css" />
		<style>
		label{
			font-weight:bolder;
		}
		.warning_msg{
			color:#FF0000;
		}
		.warning_bd{
			border:1px solid #FF0000;
		}
		.error{color:#FF0000;}
		h1{text-align:center;color:#A52A2A; font-weight:bolder;}
		select{width:100%;}
	</style>
	</head>
	<body class="container-fluid">
		<header class="row sticky-top" style="border-bottom:10px groove #00008B;">
			<div class="col">
				<img src="images/logo.png" width="100%" height="100px" />
				<!--<div class="menu"><span class="menu-text">MENU</span><i class="fa fa-bars"></i></div>-->
				<div class="menu">
							<div id="menu">
								<div class="span" id="one"></div>
								<div class="span" id="two"></div>
								<div class="span" id="three"></div>
							</div>
						</div>
			</div>
		</header>
		<section class="row">
			<div class="col">
					<div id="adminMenu">
						<!--<aside class="admin-sidebar-inner">-->
							<!--////////////////////////////////////HOSTEL ID//////////////////////////////////////////////////////////////-->
							<input type="hidden" id="hostel_id" value="<?php echo $_SESSION['hostel']?>" />
							<!--<i class="fa fa-times"></i>-->
							<div id="menu_close"><i class="fa fa-times"></i></div>
							<center>
								<div class="AdminUser" i>
									<?php
										if(isset($_SESSION['fname'])){
											echo "Hello " . $_SESSION['fname'] . "! Welcome!";
										}
									?>
								</div>
								<?php
									$user = $_SESSION['email'];
									$getImg="SELECT * FROM hostel_admins WHERE admin_email='$user'";
									$runImg = mysqli_query($con,$getImg);
									$rowImg = mysqli_fetch_array($runImg);
									if($rowImg['profile_pic'] == ''){
										echo '<img src="images/default.png" width="100px" class="admnProfileImg" height="100px" style="border-radius:50%;">';
									} else {
										echo '<img src="passports/'.$rowImg['profile_pic'].'"  class="admnProfileImg" width="100px" height="100px" style="border-radius:50%;">';
									}
								?>
							</center>
							<nav id="adminNav">
								<h5>Manage Content</h5>
								<ul id="adminNav-ul">
									<li class="has-sub"><a href="#"> Admins section <span class="sub-arrow"></span></a>
										<ul>
											<li><a href="admin.php?edit_hostel" class="AsideLinks">Edit hostel</a></li>
											<li><a href="admin.php?edit_account" class="AsideLinks">Edit account</a></li>
											<li><a href="admin.php?system_users">View system users</a></li>
											<li><a href="admin.php?change_password" class="AsideLinks">Change password</a></li>
										</ul>
									</li>
									<li class="has-sub"><a href="#">Clients section <span class="sub-arrow"></span></a> 
										<ul>
											<!--<li><a href="admin.php?add_client" class="AsideLinks">Add client</a></li>-->
											<li><a href="admin.php?view_clients" class="AsideLinks">View clients</a></li>
											<li><a href="admin.php?check_in" class="AsideLinks">Checked in clients</a></li>
											<li><a href="admin.php?check_out" class="AsideLinks">Checked out clients</a></li>
										</ul>
									</li>
									<li><a href="admin.php?employees" class="AsideLinks">Employees section</a></li>
									<li class="has-sub"><a href="#">Transactions sections <span class="sub-arrow"></span></a>
										<ul>
											<li><a href="admin.php?accounts" class="AsideLinks">Chart of accounts</a></li>
											<li><a href="admin.php?payment" class="AsideLinks">Payments</a></li>
											<li><a href="admin.php?suppliers">Suppliers</a></li>
											<li><a href="admin.php?reports">Reports</a></li>
											<li><a href="#">Perfomance charts</a></li>
										</ul>
									</li>
									<li class="has-sub"><a href="#">Vacancy section <span class="sub-arrow"></span></a>
										<ul>
											<li><a href="admin.php?post_vacancies" class="AsideLinks">Post vacancies</a></li>
										</ul>
									</li>
									<li><a href="admin.php?view_messages" class="AsideLinks">View messages</a></li>
									<li><a href="admin.php?post_blog" class="AsideLinks">Post blog</a></li>
									<li><a href="admin.php?change_room" class="AsideLinks">Room photos</a></li>
									<li><a href="admin.php?post_photos" class="AsideLinks">Image gallery</a></li>
									<li><a href="logout.php" class="AsideLinks">Log out</a></li>
								</ul>
							</nav>
						<!--</aside>-->
					</div>
				<article id="adminContent">
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
																					if(!isset($_GET['change_password'])){
																					if(!isset($_GET['system_users'])){
																					if(!isset($_GET['employees'])){
																					if(!isset($_GET['reports'])){
																					if(!isset($_GET['edit_hostel'])){
																					$connect = mysqli_connect("localhost","root","","hostels");
																					$q = "SELECT * FROM terms";
																					$rQ = mysqli_query($connect, $q);
																					while($row = mysqli_fetch_array($rQ)){
																						$title = $row['t_title'];
																						$details = $row['t_details'];
																						echo"
																							<h3>$title</h3>
																							<div>$details</div>
																						";
																					}
										}}}}}}}}}}}}}}}}}}}}}}}}}}}
					?>
					<?php
									if(isset($_GET['edit_hostel'])){
										include ("edit_hostel.php");
									}
									if(isset($_GET['reports'])){
										include ("reports.php");
									}
									if(isset($_GET['employees'])){
										include ("employees.php");
									}
									if(isset($_GET['system_users'])){
										include ("system_users.php");
									}
									if(isset($_GET['change_password'])){
										include ("change_password.php");
									}
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
					<!--DIV TAGS TO FAKE THE SIDEBAR TAG-->
			<div class="sidebar">
				<div class="sidebar-inner">		
				</div>
			</div>
			<article class="sidebar2">
				<div class="sidebar-inner2">
				</div>
			</article>
	<!--END -->
				</article>
		</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../js/jquery-3.3.1.min.js'></\script>");
		</script>
		<script src="../js/formvalidation.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/bootstrap.bundle.js"></script>
		<script src="../js/jquery.dataTables.js"></script>
		<script src="../js/dataTables.bootstrap4.js"></script>
		<script src="../js/ckeditor/ckeditor.js"></script>
		<script src="../js/simple-sticky-sidebar.js"></script>
		<script src="../js/select2.min.js"></script>
		<script src="../js/intl-tel-input-master/js/utils.js"></script>
		<script src="../js/intl-tel-input-master/js/intlTelInput.js"></script>
		<script src="../js/jquery.cycle.all.js"></script>
		<script src="js/main.js"></script>
		<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>-->
	</body>
</html>
	<?php } ?>
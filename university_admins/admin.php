<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('../login.php','_self')</script>";
	}else{
		require_once("../db.php");
		//require_once ("functions.php");
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
		<link rel="stylesheet" type="text/css" href="../admins/styles/admin.css" />
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
			#adminNav li{
				list-style-type:none;
			}
		</style>
	</head>
	<body>
		<section class="container-fluid">
			<div class="row sticky-top">
				<div class="col">
					<header style="border-bottom:10px groove #00008B;">
						<img src="../admins/images/logo.png" width="100%" height="100px" />
						<!--<div class="menu"><span class="menu-text">MENU</span><i class="fa fa-bars"></i></div>-->
						<div class="menu">
							<div id="menu">
								<div class="span" id="one"></div>
								<div class="span" id="two"></div>
								<div class="span" id="three"></div>
							</div>
						</div>
					</header>
				</div>
			</div>
			<section class="row">
				<!--<div class="col">-->
						<aside id="adminMenu">
						<!--////////////////////////////////////UNIVERSITY ID//////////////////////////////////////////////////////////////-->
							<input type="hidden" id="uni_id" value="<?php echo $_SESSION['university']?>" />
							<div id="menu_close"><i class="fa fa-times"></i></div>
							<center>
								<h3 style="color:#FFFFFF; font-weight:bolder;">Manage Content</h3>
							</center>
							<nav id="adminNav">
									<li><a href="admin.php?edit" class="AsideLinks">Edit admin Details</a></li>
									<li><a href="admin.php?add" class="AsideLinks">Add admin</a></li>
									<li><a href="admin.php?hostels" class="AsideLinks">Hostel Lists</a></li>
									<li><a href="admin.php?students" class="AsideLinks">Student's Lists</a></li>
									<li><a href="admin.php?logout" class="AsideLinks">Logout</a></li>
								</ul>
							</nav>
						</aside>
					<article id="adminContent">
						<div class="container-fluid">
							<?php
									if(isset($_GET['edit'])){
										include ("edit_admin.php");
									}
									if(isset($_GET['add'])){
										include ("add_admin.php");
									}
									if(isset($_GET['hostels'])){
										include ("hostels.php");
									}
									if(isset($_GET['students'])){
										include ("student_lists.php");
									}
									if(isset($_GET['logout'])){
										include ("logout.php");
									}
							?>
						</div>
					</article>
				<!--</div>-->
			</section>
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
		<script src="../js/select2.min.js"></script>
		<script src="../js/simple-sticky-sidebar.js"></script>
		<script src="../js/intl-tel-input-master/js/utils.js"></script>
		<script src="../js/intl-tel-input-master/js/intlTelInput.js"></script>
		<script src="../js/jquery.cycle.all.js"></script>
		<script src="../admins/js/main.js"></script>
		<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
		<!--<script>tinymce.init({ selector:'textarea' });</script>-->
	</body>
</html>
	<?php } ?>
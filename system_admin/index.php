<?php
	session_start();
	require_once("db.php");
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
<!DOCTYPE html>
<html lang='eng'>
	<head>
		<title>Hostel Administrator</title>
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"  />
		<link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap4.css" />
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/select2.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/select2-bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="styles/styles.css" />
		<style>
			#Aside a:hover{text-decoration:underline; font-weight:bolder;}
			#MainSection{height:auto;}
			.AdminInput{padding:2px; font-size:15px; border-radius:5px; border:2px solid #D3D3D3; width:400px; }
			.EsgSubmit{width:400px; font-size:20px; padding:5px; background-color:#0000FF; border-radius:5px; color:#FFFFFF;}
			.EsgSubmit:hover{cursor:pointer; background-color:#00008B; font-weight:bolder;}
			h4{
				text-align:center;
				font-weight:bolder;
			}
			.input-field{
				font-weight:bolder;
			}
			#admin_header{
				/*position:fixed;
				content:"";
				clear:both;
				width:100%;*/
				border-bottom:10px groove #FFA500;
			}
			#Aside{
				/*width:16.67%;
				height:100%;
				position:fixed;*/

			}
			.sidebar{
				position:relative;
				height:100%;
			}
			.sidebar-inner{
				width:100%;
				position:absolute;
			}
		</style>
	</head>
	<body>
		
		<section class="container-fluid">
				<header  class="row sticky-top" id="admin_header" >
					<div class="col">
						<img src="images/admin.jpg" width="100%" height="150px" />
					</div>
				</header>
			<section class="row">
				<div class="col-md-2 sidebar">
					<div class="sidebar-inner">
						<aside id="Aside" style="text-align:center; background-color:#FFFFFF;">
							<h1 style="font-size:30px; font-weight:bolder; margin-top:0px;">Manage Content</h1>
							<ul>
								<li style="list-style-type:none;"><a href="index.php?add_admin" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Add Admin</a></li>
								<li style="list-style-type:none;"><a href="index.php?hostel_admin" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Add hostel admin</a></li>
								<li style="list-style-type:none;"><a href="index.php?university_admin" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Add university admin</a></li>
								<li style="list-style-type:none;"><a href="index.php?edit_accout" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Edit account</a></li>
								<li style="list-style-type:none;"><a href="index.php?add_hostel" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Add hostels</a></li>
								<li style="list-style-type:none;"><a href="index.php?edit_hostel" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Edit Hostels details</a></li>
								<li style="list-style-type:none;"><a href="index.php?view_hostels" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">View hostels</a></li>
								<li style="list-style-type:none;"><a href="index.php?view_message" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">View Messages</a></li>
								<li style="list-style-type:none;"><a href="index.php?terms" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Terms & Conditions</a></li>
								<li style="list-style-type:none;"><a href="index.php?help" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Add Help and Support</a></li>
								<li style="list-style-type:none;"><a href="logout.php" style="text-decoration:none; font-size:50; font-family:comic sans ms; color:#A52A2A;">Admin Logout</a></li>
							</ul>
						</aside>
					</div>
				</div>
						<article id="main-content" class="col-md-10" style="border-left:10px groove #FFA500; height:800px; overflow:scroll;">
							<?php
								if(isset($_GET['help'])){
									include("add_help_support.php");
								}
								if(isset($_GET['hostel_admin'])){
									include("hostel_admin.php");
								}
								if(isset($_GET['university_admin'])){
									include("university_admin.php");
								}
								if(isset($_GET['add_admin'])){
									include ("add_admin.php");
								}
								if(isset($_GET['edit_account'])){
									include ("edit_account.php");
								}
								if(isset($_GET['add_hostel'])){
									include ("add_hostel.php");
								}
								if(isset($_GET['terms'])){
									include ("terms.php");
								}
								if(isset($_GET['edit_hostel'])){
									include ("edit_hostel.php");
								}
								if(isset($_GET['view_hostels'])){
									include ("view_hostels.php");
								}
								if(isset($_GET['view_message'])){
									include ("messages.php");
								}
							?>
						</article>
			</section>
		</section>
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
		window.jQuery || document.write("<script src='../js/jquery-3.1.1.min.js'></\script");
	</script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../js/jquery-3.3.1.min.js'></\script>");
		</script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.bundle.js"></script>
		<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="../js/dataTables.bootstrap4.js"></script>
		<!--<script src="//cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script>-->
		<script src="../js/ckeditor/ckeditor.js"></script>
		<script src="../js/select2.min.js"></script>
		<script src="../js/simple-sticky-sidebar.js"></script>
		<script src="../js/intl-tel-input-master/js/intlTelInput.js"></script>
		<script src="../js/main.js"></script>
		<script src="../js/formvalidation.js"></script>
		<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>//tinymce.init({ selector:'textarea' });</script>-->
		<script>
			//ADDING FORMATING FEATURES TO TEXTAREA INPUT TAG
			CKEDITOR.replace('content');
		</script>
	</body>
</html>
	<?php } ?>
<?php
	include "db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Log in</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="styles/admin.css" media="only screen and (min-width:751px)" />
		<style>
			.LogSubmit{background-color:#0000FF; font-size:20px; padding:5px; width:400px; color:#FFFFFF; border-radius:5px;}
			.LogSubmit:hover{background-color:#00008B; font-weight:bolder; cursor:pointer;}
			
			@media screen and (min-width:768px){
				#AdminBody{background-image: url(../images/md1.jpg); background-size:cover; }
				.panel{opacity:0.9;margin-top:50px;}
				.panel-heading{
					background-color:blue;
				}
			}
			@media screen and (max-width:769px){
				#AdminBody{background-color:#D3D3D3;}
				.row{text-align:center;}
				
			}
		</style>
	</head>
	<body id="AdminBody">
		<div class="container">
			<div class="row">
				<div class="panel panel-default panel-primary">
					<div class="panel-heading ">
						<h1 class="panel-title" style="color:#FFFF00;">Change password</h1>
					</div>
					<div class="panel-body">
						<form method="POST" action="forgotpassword.php">
							<div class="form-group">
								<label>Email address:</label>
								<input type="email" name="email" id="passEmail" class="form-control" placeholder="Please enter your email address" required/>
							</div>
							<div id="emailSubmit">
							</div>
						</form>
						<i><a href="../index.php">Back to home page</a></i> &nbsp &nbsp <i><a href="login.php">Log in</a></i>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(isset($_POST['sendmail'])){
				$code = rand(1000,10000);
				$resetCode = md5($code);
				$email = $_POST['email'];
				
				$from = "www.kobs.co.ke(Hostel Online Booking System)";
				$subject = "MUABATECH TECHNOLOGIES PASSWORD RESET";
				$msg = "Hello";
				//$to = $email;
				/*$msg = "
					<p>This is an automated message. Please don't reply!</p>
					<p>To change your password, please click this link http://localhost/hostel/modernchristianladies/admin/forgotpassword3.php?c=$resetCode & e=$email</p>
					<p>For more information please contact</p>
					<p>
						Cell : 0724654808 / 0775499640 <br />
						Email : andrewmuuyi@yahoo.com/muuyiandrew2015@gmail.com<br />
						Website : www.muabatech.com
					</p>
				";*/
				$send = mail($email,$subject,$msg);
				if($send == true){
					echo "Email successfully send!";
				}else{
					echo "<script>alert('There was a problem incurred. Please try again!')</script>";
				}
				
				//$q = "UPDATE admins SET pass_reset = '$resetCode' WHERE admin_Email='$email'";
				//$rQ = mysqli_query($con, $q);
				/*if(){
					echo "<script>alert('Please visit your email to reset your password. The password reset link has been successfully sent to your email address!')</scrip>";
					//echo "<script>window.onload('login.php','_self')</script>";
				}else{
					echo "<script>alert('There was a problem incurred. Please try again!')</scrip>";
					//echo "<script>window.onload('forgotpassword.php','_self')</script>";
				}*/

			}
		?>
		<!--JAVASCRIP FILES-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../../js/jquery-3.1.0.min.js'></\script>");
		</script>
		<script src="../../js/formvalidation.js"></script>
		<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery.cycle.all.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/lightbox.min.js"></script>
		<script src="../js/main.js"></script>
	</body>
</html>

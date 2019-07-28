<?php
	session_start();
	require_once ("db.php");
	require_once ("../../formvalidator.php");
	$validator = new validator();
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		//USERNAME VALIDATION
		$validator->addField('username');
		$validator->addRuleToField('username', array('username'));
		//PASSWORD VALIDATION
		$sel_user = "select * from admins where admin_username='$username' AND admin_pass='$password'";
		$run_user = mysqli_query($con, $sel_user);
		$check_user = mysqli_num_rows($run_user);
		if($check_user==0){
			echo "<script>alert('Password or email is wrong, try again!')</script>";
		}else{
			$_SESSION['username']=$username;
			echo "<script>window.open('admin.php','_self')</script>";
		}
	}
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
			
			@media screen and (min-width:900px){
				#AdminBody{background-image: url(../images/sa8.jpg); background-size:cover; ;}
				.row{width:80%; height:500px; margin:auto; text-align:center; background-color:#F4A460; margin-top:50px; border-radius:10px; opacity:0.8; padding:5px}
			}
			@media screen and (max-width:899px){
				#AdminBody{background-color:#D3D3D3;}
				.row{text-align:center;}
				
			}
		</style>
	</head>
	<body id="AdminBody">
		<section class="container">
			<article class="row">

				<h2 style="color:#FF0000;"><?php echo @$_GET['not_admin'];?></h2>
				<h2 style="color:#008000;"><?php echo @$_GET['log_out'];?></h2>
				<h1 style="color:#0000FF; padding-top:30px;">Admin Login</h1><br />
				<form method="POST" action="login.php">
				
					<input type="text" name="username" class="form-control" placeholder="Username" required/>
					<?php $validator->outPutFieldError('username'); ?><br /><br />
					<input type="password" name="password" class="form-control" placeholder="Password" required/>
					<?php $validator->outPutFieldError('password'); ?><br /><br />
					<input type="submit" name="login" class="form-control" style="background-color:#0000FF; color:#FFFFFF; font-weight:bolder; font-size;20px;" value="Log in"/><br /><br />
				</form>
				<i><a href="forgotpassword.php">Forgot password</a></i> &nbsp <i><a href="../index.php">Back to home page</a></i>
			</article>
			</article>
	</body>
</html>

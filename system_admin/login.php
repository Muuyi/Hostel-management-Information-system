<?php
	session_start();
	include ("db.php");
	require_once("../formvalidator.php");
	$validator = new validator; 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, md5($_POST['password']));
		//PASSWORD VALIDATION
		$validator->addField('password');
		$validator->addRuleToField('password', array('empty'));
		//USERNAME VALIDATION
		$validator->addField('username');
		$validator->addRuleToField('username', array('empty'));
		if($validator -> formValid()){
			$sel_admin = "select * from admins WHERE admin_user='$username' AND admin_pass='$password'";
			$sel_ad = mysqli_query($con, $sel_admin);
			$check_admin = mysqli_num_rows($sel_ad);
			if($check_admin==0){
				echo "<script>alert('Your username or password is wrong, please try again!')</script>";
			}else{
				$_SESSION['admin_user']=$username;
				echo "<script>window.open('index.php','_self')</script>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Log in</title>
		<link rel="stylesheet" type="text/css" href="styles/desktop.css" media="only screen and (min-width:751px)" />
		<link rel="stylesheet" type="text/css" href="styles/mobile.css" media="only screen and (max-width:750px)" />
		<style>
			#LoginBody {background-image: url(images/lamborghini.jpg); background-size:cover;}
			#LoginSection{width:50%; height:500px; margin:auto; background-color:#C0C0C0; opacity:0.8; margin-top:100px; text-align:center;}
			.AdminInput{width:80%; font-size:25px; padding:5px; border-radius:5px;}
			.AdminSubmit{width:60%; font-size:30px; color:#FFFFFF; padding:5px; background-color:#CD853F; border-radius:5px;}
			.AdminSubmit:hover{font-weight:bolder; background-color:#A52A2A; cursor:pointer;}
		</style>
	</head>
	<body id="LoginBody">
		<section id="LoginSection">
			<h2 style='color:#FF0000;'><?php echo @$_GET['not_admin']; ?></h2>
			<h2 style='color:#FF0000;'><?php echo @$_GET['logout']; ?></h2>
			<h1 style="font-size:50px; color:#00008B;">Admin Login</h1>
			<form method="POST" action="login.php" enctype="multipart/form-data">
				<input type="text" name="username" class="AdminInput" placeholder="Admin Username" />
				<?php $validator -> outPutFieldError('username'); ?>
				<input type="password" name="password" class="AdminInput" placeholder="Admin Password" />
				<?php $validator -> outPutFieldError('password'); ?>
				<input type="submit" name="login" class="AdminSubmit" value="Login" />
			</form><br /><br />
			<i><a href="#">Forgot password</a></i> &nbsp  <i><a href="../index.php">Back to home page</a></i>
		</section>
	</body>
</html>

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
			<h1 style="font-size:50px; color:#00008B;">Change your password</h1>
			<form method="POST" action="login.php" enctype="multipart/form-data">
				<input type="text" name="name" class="AdminInput" placeholder="Full names" /><br /><br />
				<input type="text" name="username" class="AdminInput" placeholder="Username" /><br /><br />
				<input type="password" name="password" class="AdminInput" placeholder="New password" /><br /><br />
				<input type="submit" name="reset" class="AdminSubmit" value="Change Password" />
			</form><br /><br />
			<i><a href="../index.php">Back to home page</a></i>
		</section>
	</body>
</html>
<?php
	include ("db.php");
	if(isset($_POST['reset'])){
		$names = ($_POST['name']);
		$username = ($_POST['username']);
		$password = ($_POST['password']);
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
?>
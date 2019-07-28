<?php
	include "db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Log in</title>
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<link rel="stylesheet" type="text/css" href="styles/admin.css" media="only screen and (min-width:751px)" />
		<link rel="stylesheet" type="text/css" href="styles/mobile.css" media="only screen and (max-width:751px)" />
		<style>
			.LogSubmit{background-color:#0000FF; font-size:20px; padding:5px; width:400px; color:#FFFFFF; border-radius:5px;}
			.LogSubmit:hover{background-color:#00008B; font-weight:bolder; cursor:pointer;}
			#AdminBody{background-image: url(../images/md1.JPG); background-size:cover;}
		</style>
	</head>
	<body id="AdminBody">
		<section id="LogSection">
			<h1 style="color:#0000FF; padding-top:30px;">Reset Password</h1><br />
			<form method="POST" action="forgotpassword.php" enctype="multipart/form-data">
				<input type="text" name="username" class="AdminInput" placeholder="Enter your username" required/><br /><br />
				<input type="email" name="email" class="AdminInput" placeholder="Enter your email" required/><br /><br />
				<input type="submit" name="resetpass" class="LogSubmit" value="Reset password"/><br /><br />
				<i><a href="../index.php">Back to home page</a></i>
			</form>
		</section>
	</body>
</html>
<?php
	if(isset($_POST['resetpass'])){
		$userName = $_POST['username'];
		$email = $_POST['email'];
		$getAd = "SELECT * FROM admins where admin_username='$userName' AND email='$email'";
		$runAd = mysqli_query($con, $getAd);
		$countAdmin = mysqli_num_rows($runAd);
		if($countAdmin==0){
			echo "<script>alert('The username and Email does not exist. Please enter an email and password that you registered with as an admin!')</script>";
		}else{
			include ("db.php");
			$code = rand(10000, 1000000);
			$to = $email;
			$subject = "Reset password";
			$body = "This is an automated password,please do not reply. To reset your password please click this link or paste it in your browser: http://localhost/hostel/modernchristianladies/admin/forgotpassword.php?code=$code&username=$userName";
			$updateAdmin ="UPDATE admins SET passreset=$code WHERE admin_username='$userName'";
			$runAdmin = mysqli_query($con, $updateAdmin);
			//mail($to,$subject,$body);
			echo "<script>alert('Check your email to reset the password')</script>";
		}
	}
?>
<?php
		if($_GET['code']){
		$getUsername = $_GET['username'];
		$getCode = $_GET['code'];
		$getLink = "SELECT * FROM admins WHERE admin_username = '$getUsername'"; 
		$runLink = mysqli_query($con, $getLink);
		while($rowReset = mysqli_fetch_array($runLink)){
			$dbCode = $rowReset['passreset'];
			$dbUsername = $rowReset['admin_username'];
		}
		if($getUsername==$dbUsername && $getCode==$dbCode){
			echo "<script>window.open('passreset.php','_self')</script>";	
		}
	}
?>

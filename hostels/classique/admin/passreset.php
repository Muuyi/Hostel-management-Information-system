<?php
	include ("forgotpassword.php");
	if(isset($_POST['passreset'])){
		$newPassword = $_POST['newPassword'];
		$newPassword2 = $_POST['newPassword2'];
		$postUsername = $_POST['username'];
		$postCode = $_POST['code'];
		if($newPassword == $newPassword2){
			
		}
	}
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
				<input type="password" name="newPassword" class="AdminInput" placeholder="Enter your new password" required /><br /><br />
				<input type="password" name="newPassword2" class="AdminInput" placeholder="Re-enter your new password" required /><br /><br />
				<input type="hidden" name="username" value="$userName" />
				<input type="submit" name="passreset" class="LogSubmit" value="Reset password"/><br /><br />
				<i><a href="../index.php">Back to home page</a></i>
			</form>
		</section>
	</body>
</html>
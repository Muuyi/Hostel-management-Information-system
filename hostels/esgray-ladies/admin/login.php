<?php
	session_start();
	require_once ("db.php");
	require_once ("../../formvalidator.php");
	$validator = new validator();
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$password = md5($password);
		//USERNAME VALIDATION
		$validator->addField('username');
		$validator->addRuleToField('username', array('username'));
		//PASSWORD VALIDATION
		$sel_user = "SELECT * FROM admins WHERE admin_username='$username' AND admin_pass='$password'";
		$run_user = mysqli_query($con, $sel_user);
		$check_user = mysqli_num_rows($run_user);
		if($check_user==0){
			echo "<script>alert('Password or email is wrong, try again!')</script>";
		}else{
			$_SESSION['username']=$username;
			//$_SESSION['type']
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
			
			@media screen and (min-width:768px){
				#AdminBody{background-image: url(../images/esl.JPG); background-size:cover; }
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
		<section class="container">
			<article class="row">
				<div class="panel panel-default panel-primary">
					<div class="panel-heading ">
						<h2 class="panel-title" style="color:#FEF0DB;"><?php echo @$_GET['not_admin'];?></h2>
						<h2 class="panel-title" style="color:#FEF0DB;"><?php echo @$_GET['log_out'];?></h2>
						<h1 class="panel-title" style="color:#FFFF00;">Admin Login</h1>
					</div>
					<div class="panel-body">
						<form method="POST" action="login.php">
							<div class="form-group">
								<label>Username:</label>
								<input type="text" name="username" class="form-control" placeholder="Username" required/>
								<?php $validator->outPutFieldError('username'); ?>
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input type="password" name="password" class="form-control" placeholder="Password" required/>
								<?php $validator->outPutFieldError('password'); ?>
							</div>
							<div class="form-group">
								<input type="submit" name="login" class="form-control" style="background-color:#0000FF; color:#FFFFFF; font-weight:bolder; font-size;20px;" value="Log in"/>
							</div>
						</form>
						<i><a href="forgotpassword.php">Forgot password</a></i> &nbsp <i><a href="../index.php">Back to home page</a></i>
					</div>
				</div>
			</article>
			</article>
	</body>
</html>

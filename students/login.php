<?php
	session_start();
	require_once("../db.php");
	if(isset($_POST['student_login'])){
		$error = '';
		$phone = mysqli_real_escape_string($con, $_POST['phone']);
		$id = mysqli_real_escape_string($con, $_POST['id']);
		$q = "SELECT * FROM clients WHERE phone='".$phone."' AND id_no='".$id."'";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			$row = mysqli_fetch_array($rQ);
			if(mysqli_num_rows($rQ) > 0){
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['id'] = $row['id_no'];
					$_SESSION['cl_id'] = $row['cl_id'];
					header("location:admin.php");
			}else{
				$error = '<label class="alert alert-danger">The phone number or ID no you have entered is incorrect!Please try again!</label>';
			}
		}else{
			echo mysqli_error($con);
		}
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ESGRAY WESTLANDS MIXED HOSTEL</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="styles/styles.css" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="styles/lightbox.min.css" />
		<style>
			@media only screen and (max-width:599.99px){
				.card{
					width:100%;
					margin:auto;
					margin-top:50px;
				}
			}
			@media only screen and (min-width:600px){
				.card{
					width:50%;
					margin:auto;
					margin-top:50px;
				}
			}
			
			.input{
				border:none;
				border-bottom:1px solid #008000;
				width:100%;
			}
			.labels{
				color:#006400;
				font-weight:bolder;
			}
			h3{
				font-weight:bolder;
			}
			/*{
				margin:0px;
				background-color:#D3D3D3;
			}
			#admins{
				background-color:#FFFFFF;
			}
			.card{
				width:50%;
				background-color:#FFFFFF;
				z-index:1000;
			}*/
		</style>
	</head>
	<body>
			<div class="card">
				<div class="card-body">
			<form method="POST" >
					<h3> Students login</h3>
					<div><?php echo @$error; ?></div>
					<div class="form-group">
						<label class="labels">Enter phone number</label><br />
						<input type="text" class="input" name="phone" placeholder="Enter email address" />
					</div>
					<div class="form-group">
						<label class="labels">Enter ID/Birth cert/Passport number</label><br />
						<input type="password" name="id" class="input" placeholder="Enter password" />
					</div>
					<div class="form-group">
						<input type="submit" name="student_login" value="Log in" class="btn btn-success" />
					</div>
					<a href="../index.php"><i>Back to home page</i></a> &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="#"><i>Forgot password</i></a>
			</form>
				</div>
			</div>
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../js/jquery-3.1.0.min.js'></\script>");
		</script>
		<script src="../../js/formvalidation.js"></script>
		<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery.cycle.all.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="js/lightbox.min.js"></script>
		<script src="js/main.js"></script>
</html>
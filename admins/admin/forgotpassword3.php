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
								<label>New password:</label>
								<input type="password" name="email" id="passEmail" class="form-control" placeholder="Please enter your new password" required/>
							</div>
							<div class="form-group">
								<label>Confirm password:</label>
								<input type="password" name="email" id="passEmail" class="form-control" placeholder="Please confirm your password" required/>
							</div>
							<div class="form-group">
								<input type="submit" name="sendmail" class="btn btn-success form-control"  value="Change password"/>
							</div>
						</form>
						<i><a href="../index.php">Back to home page</a></i> &nbsp &nbsp <i><a href="login.php">Log in</a></i>
					</div>
				</div>
			</div>
		</div>
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

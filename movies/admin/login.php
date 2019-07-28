<?php
	session_start();
	require_once ("db.php");
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$selUser = "SELECT * FROM admins WHERE admin_username='$username' AND admin_password='$password'";
		$runUser = mysqli_query($con, $selUser);
		$checkUser = mysqli_num_rows($runUser);
		if($checkUser==0){
			echo "<script>alert('Email or password is wrong, please try again!')</script>";
		}else{
			$_SESSION['admin_username'] = $username;
			echo "<script>window.open('admin.php','_self')</script>";
		}

	}
?>
<div class="container">
	<div class="modal" id="modal-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div type="button" class="close" data-dismiss="modal">&times;</div>
				<h3 class="modal-title">Admin Login</h3>
			</div>
			<div class="modal-body">
				<form action="admin/admin.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="text" class="form-control" name="username" placeholder="Enter your username" />
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control" name="password" placeholder="Enter your password" />
					</div>
					<div class="form-group">
						<button type="submit" name="login" class="btn btn-primary form-control"> Login</button>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger close" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div>
<?php
	error_reporting(E_ALL);
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<h1>Change password</h1>
<form method="POST" action="admin.php?change_password">
	<div class="form-group">
		<label>New password</label>
		<input type="password" name="pass1" id="pass1" placeholder="Enter new password" class="form-control" />
	</div>
	<div class="form-group">
		<label>Cornfirm password</label>
		<input type="password" name="pass2" id="pass2" placeholder="Confirm password" class="form-control" />
		<p id="passerror"></p>
	</div>
	<div class="form-group">
		<input type="submit" name="submit" value="Change password" class="btn btn-primary form-control" />
	</div>
</form>
<?php
	if(isset($_POST['submit'])){
		$user = $_SESSION['username'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		if($pass1 != $pass2){
			echo "<script>alert('Please ensure both fields match!')</script>";
			echo "<script>window.open('admin.php?change_password','_self')</script>";
		}else{
			$pass = md5($pass1);
			$q = "UPDATE admins SET admin_pass='$pass' WHERE admin_Username='$user'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo "<script>alert('You have successfully changed your password!')</script>";
				echo "<script>window.open('admin.php?change_password','_self')</script>";
			}else{
				echo  "<script>alert('An error occured during the process!Please try again!')</script>";
			}
		}
	}
?>
<?php } ?>
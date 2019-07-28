<?php
	error_reporting(E_ALL);
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
	if(isset($_POST['submit'])){
		$email = $_SESSION['email'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$error = "";
		if($pass1 != ''){
			if($pass1 != $pass2){
				$error =  "<div class='alert alert-danger'>Please ensure both fields match!</div>";
			}else{
				$pass = md5($pass1);
				$q = "UPDATE hostel_admins SET admin_password='$pass' WHERE admin_email='$email'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "<script>alert('You have successfully changed your password!')</script>";
					echo "<script>window.open('admin.php?change_password','_self')</script>";
				}else{
					$error = "<div class='alert alert-danger'>An error occured during the process!Please try again!</div>";
				}
			}
		}else{
			$error =  "<div class='alert alert-danger'>Please enter a value to change the password!</div>";
		}
		
	}
?>
<h1>Change password</h1>
<form method="POST" action="admin.php?change_password">
	<?php echo @$error ?>
	<div class="form-group">
		<label>New password</label>
		<input type="password" name="pass1" id="pass1" placeholder="Enter new password" class="form-control" required/>
	</div>
	<div class="form-group">
		<label>Cornfirm password</label>
		<input type="password" name="pass2" id="pass2" placeholder="Confirm password" class="form-control" required/>
		<p id="passerror"></p>
	</div>
	<div class="form-group">
		<input type="submit" name="submit" value="Change password" class="btn btn-primary form-control" />
	</div>
</form>
<?php } ?>
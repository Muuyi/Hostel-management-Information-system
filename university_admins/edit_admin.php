		<div class="row">
			<div class="col">
				<h3>Edit admin details</h3>
				<form method="POST" action="admin.php?edit">
						<div class="form-group">
							<label>Enter new password</label>
							<input type="password" name="password1" class="form-control" placeholder="Enter your new password" required/>
						</div>
						<div class="form-group">
							<label>Enter password</label>
							<input type="password" name="password" class="form-control" placeholder="Re-entr your password" required/>
						</div>
						<div class="form-group">
							<input type="submit" value="Submit" name="submit_university_admin" class="btn btn-success form-control" />
						</div>
				</form>
			</div>
		</div>
<?php
	if(isset($_POST['submit_university_admin'])){
		$password1 = mysqli_real_escape_string($con, $_POST['password1']);
		$password = (mysqli_real_escape_string($con, $_POST['password']));
		if($password1 != $password){
			echo '<script>alert("The values entered do not match! Please ensure the values match!")</script>';
		}else{
			$pass = md5($password);
			$q = "UPDATE universtiy_admins SET admin_password='".$pass."' WHERE admin_email='".$_SESSION['email']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo '<script>alert("You have successfully added a university admin")</script>';
				echo '<script>window.open("admin.php?edit","_self")</script>';
			}else{
				echo mysqli_error($con);
			}
		}
	}
?>
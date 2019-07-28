		<div class="row">
			<div class="col">
				<h3>Add admin</h3>
				<form method="POST" action="admin.php?add">
					<div class="form-group">
						<div class="form-group">
							<label>Enter email</label>
							<input type="email" name="email" class="form-control" placeholder="Enter your email address" />
						</div>
						<div class="form-group">
							<label>Enter password</label>
							<input type="password" name="password" class="form-control" placeholder="Enter password" />
						</div>
						<div class="form-group">
							<input type="submit" value="Submit" name="submit_university_admin" class="btn btn-success form-control" />
						</div>
					</div>
				</form>
			</div>
		</div>
<?php
	if(isset($_POST['submit_university_admin'])){
		$university = $_SESSION['university'];
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = md5(mysqli_real_escape_string($con, $_POST['password']));
		$q = "INSERT INTO university_admins (uni_id,admin_email,admin_password) VALUES ('$university','$email','$password')";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo '<script>alert("You have successfully added a university admin")</script>';
			echo '<script>window.open("admin.php?add","_self")</script>';
		}else{
			echo mysqli_error($con);
		}
	}
?>
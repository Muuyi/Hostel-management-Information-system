<div class="container-fluid">
	<div class="row">
		<div class="col">
			<form method="POST" action="index.php?university_admin">
				<div class="form-group">
					<label>Select university</label>
					<select class="form-control" name="university">
						<option>Select university</option>
						<?php
							$q = "SELECT * FROM universities";
							$rQ = mysqli_query($con, $q);
							while($row = mysqli_fetch_array($rQ)){
								echo '<option value="'.$row['uni_id'].'">'.$row['uni_name'].'</option>';
							}
						?>
					</select>
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
</div>
<?php
	if(isset($_POST['submit_university_admin'])){
		$university = mysqli_real_escape_string($con, $_POST['university']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = md5(mysqli_real_escape_string($con, $_POST['password']));
		$q = "INSERT INTO universtiy_admins (uni_id,admin_email,admin_password) VALUES ('$university','$email','$password')";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo '<script>alert("You have successfully added a university admin")</script>';
			echo '<script>window.open("index.php?university_admin","_self")</script>';
		}else{
			echo mysqli_error($con);
		}
	}
?>
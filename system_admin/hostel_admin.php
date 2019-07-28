<?php
	error_reporting(E_ALL);
	if(isset($_POST['submit_user'])){
		$fname = mysqli_real_escape_string($con, $_POST['fname']);
		$lname = mysqli_real_escape_string($con, $_POST['lname']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$hostel = mysqli_real_escape_string($con, $_POST['hostel']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$pass = md5($password);
		$user = mysqli_real_escape_string($con, $_POST['user']);
		$q = "INSERT INTO hostel_admins(admin_fname,admin_lname,admin_email,admin_password,host_id,admin_status,user_type,reg_date) VALUES('$fname','$lname','$email','$pass','$hostel',1,'$user',now())";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo '<script>alert("You have successfully added an administrator!")</script>';
			echo '<script>window.open("index.php?hostel_admin","_self")</script>';
		}
	}
?>
<div class="row">
	<div class="col">
		<form method="POST" action="index.php?hostel_admin">
			<h3> Add Hostel Admin</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>First name</label>
						<input type="text" name="fname" class="form-control" placeholder="Enter first name" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Last name</label>
						<input type="text" name="lname" class="form-control" placeholder="Enter last name" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Email address</label>
						<input type="email" name="email" class="form-control" placeholder="Enter email address" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Enter password" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Select hostel;</label>
						<select name="hostel" class="form-control">
							<option value="">Select hostel</option>
							<?php
								$q = "SELECT * FROM hostels ORDER BY host_name ASC";
								$rQ = mysqli_query($con, $q);
								if($rQ){
									while($row = mysqli_fetch_array($rQ)){
										echo '<option value="'.$row['host_id'].'">'.$row['host_name'].'</option>';
									}
								}else{
									echo '<option value="">'.mysqli_error($con).'</option>';
								}
								
							?>
						</select>
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label>User type</label><br />
						Admins<input type="radio" value="admin" name="user" /> &nbsp; &nbsp;
						User<input type="radio" value="user" name="user" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input type="submit" name="submit_user" value="Submit user" class="btn btn-success form-control" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
						
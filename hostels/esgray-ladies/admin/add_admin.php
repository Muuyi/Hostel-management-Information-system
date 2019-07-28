<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h1 style="text-align:center;">Add Admin</h1>
			<form action="admin.php?add_admin" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="form-group">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<label>First Name</label>
							<input type="text" name="ad_fname" class="form-control" Placeholder="Enter First name" />
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<label>Last Name</label>
							<input type="text" name="ad_lname" class="form-control" Placeholder="Enter Last Name" />
						</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<label>Security question</label><br />
							<select name="squestion">
								<option value="What is the name of your favorite person ?">What is the name of your favorite person ?</option>
								<option value="Which is your favorite color ?">Which is your favorite color ?</option>
								<option value="Which is your favorite movie ?">Which is your favorite movie ?</option>
								<option value="Which is your favorite day ?">Which is your favorite day ?</option>
								<option value="What is your favorite pet ?">What is your favorite pet ?</option>
								<option value="Who was your favorite teacher ?">Who was your favorite teacher ?</option>
							</select>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<label>Security answer</label>
							<input type="text" name="sanswer" class="form-control" Placeholder="Enter Security answer" />
						</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>ID Number</label>
						<input type="text" name="idNo" class="form-control" Placeholder="Enter security answer"/>
					</div>
					<div class="col-lg-6 col-md-6">
						<label>User name</label>
						<input type="text" name="ad_user" class="form-control" Placeholder="Enter username"/>
					</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>Password</label>
						<input type="password" name="ad_pass" class="form-control" Placeholder="Enter password " />
					</div>
					<div class="col-lg-6 col-md-6">
						<label>Image</label>
						<input type="file" name="ad_image" id="cpassport" />
						<div id="passportresponse" class="error"></div>
					</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>Email</label>
						<input type="email" name="ad_email" class="form-control" Placeholder="Enter email address" />
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" id="AdminSubmit" class="form-control" name="add_admin" value="Add admin"/>
			</div>
		</form>
		</div>
	</div>
	<?php } ?>
	<?php
		if(isset($_POST['add_admin'])){
			$ad_fname = mysqli_real_escape_string($con, $_POST['ad_fname']);
			$ad_lname = mysqli_real_escape_string($con, $_POST['ad_lname']);
			$ad_user = mysqli_real_escape_string($con, $_POST['ad_user']);
			$admin_pass = mysqli_real_escape_string($con, $_POST['ad_pass']);
			$ad_pass = md5($admin_pass);
			$squestion = mysqli_real_escape_string($con, $_POST['squestion']);
			$sanswer = mysqli_real_escape_string($con, $_POST['sanswer']);
			$id = mysqli_real_escape_string($con, $_POST['idNo']);
			$ad_email = mysqli_real_escape_string($con, $_POST['ad_email']);
			$ad_image = $_FILES['ad_image']['name'];
			//$tmp_admin =  mysqli_real_escape_string($con, $_POST['ad_name']);
			$ad_user = mysqli_real_escape_string($con, $_POST['ad_user']);
			$ad_pic = mysqli_real_escape_string($con, file_get_contents($_FILES['ad_image']['tmp_name']));
			//move_uploaded_file($tmp_admin,"images/$ad_image");
			$add_admin = "INSERT INTO admins (admin_FName,admin_LName,admin_Email,admin_IDNo,admin_Username,admin_pass,admin_pic) values ('$ad_fname','$ad_lname','$ad_email','$id','$ad_user','$ad_pass','$ad_pic')";
			$ad_adm = mysqli_query($con, $add_admin);
			if($ad_adm){
				echo "<script>alert('You have successfully added an admin')</script>";
				echo "<script>window.open('admin.php?add_admin','_self')</script>";
			}
			
		}
	?>
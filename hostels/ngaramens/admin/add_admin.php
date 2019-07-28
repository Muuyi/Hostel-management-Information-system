<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<h1 style="text-align:center;">Add Admin</h1><br />
<form action="admin.php?add_admin" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Full names</label>
		<input type="text" name="ad_name" class="form-control" placeholder="Your full names" />
	</div>
	<div class="form-group">
		<label>User name</label>
		<input type="text" name="ad_user" class="form-control" placeholder="User name" />
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" name="ad_pass" class="form-control" placeholder="Password" />
	</div>
	<div class="form-group">
		<label>Image</label>
		<input type="file" name="ad_image"/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="ad_email" class="form-control" placeholder="Email" />
	</div>
	<div class="form-group">
		<input type="submit" id="AdminSubmit" name="ad_admin" class="form-control" value="Add admin"/>
	</div>
</form>
	<?php } ?>
	<?php
		if(isset($_POST['ad_admin'])){
			$ad_name = mysqli_real_escape_string($con, $_POST['ad_name']);
			$ad_user = mysqli_real_escape_string($con, $_POST['ad_user']);
			$ad_pass = mysqli_real_escape_string($con, $_POST['ad_pass']);
			$ad_email = mysqli_real_escape_string($con, $_POST['ad_email']);
			$ad_image = $_FILES['ad_image']['name'];
			$tmp_admin = $_FILES['ad_image']['tmp_name'];
			move_uploaded_file($tmp_admin,"images/$ad_image");
			$add_admin = "insert into admins (admin_name,admin_username,admin_pass,admin_pic,email) values ('$ad_name','$ad_user','$ad_pass','$ad_image','$ad_email')";
			$ad_adm = mysqli_query($con, $add_admin);
			if($ad_adm){
				echo "<script>alert('You have successfully added an admin')</script>";
				echo "<script>window.open('admin.php?add_admin','_self')</script>";
			}
			
		}
	?>
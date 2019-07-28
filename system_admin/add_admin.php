<?php
	include ("db.php"); 
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col">
		<h1>Add an admin</h1>
		<form action="index.php?add_admin" method="POST" enctype="multipart/form-data" />
			<div class="form-group">
				<label class="input-label">Admin Name</label> 
				<input type="text" name="ad_name" size="50" class="form-control" placeholder="Enter admin full names" required/>
			</div>
			<div class="form-group">
				<label  class="input-label">Username</label>
				<input type="text" name="ad_user" size="50" class="form-control" placeholder="Enter admin usernames" required/>
			</div>
			<div class="form-group">
				<label  class="input-label">Password</label>
				<input type="password" name="ad_pass" size="50" class="form-control" placeholder="Enter admin password" required/>
			</div>
			<div class="form-group">
				<label  class="input-label">Image</label>
				<input type="file" name="add_image"/>
			</div>
			<input type="submit" class="btn btn-primary form-control" name="add" value="Add admin" />
		</form>
		<?php
			if(isset($_POST['add'])){
				$ad_name = mysqli_real_escape_string($con, $_POST['ad_name']);
				$ad_user = mysqli_real_escape_string($con, $_POST['ad_user']);
				$ad_pass = mysqli_real_escape_string($con, md5($_POST['ad_pass']));
				$q = "SELECT * FROM admins WHERE admin_user='".$ad_user."'";
				$rQ = mysqli_query($con, $q);
				$count = mysqli_num_rows($rQ);
				if($count > 0){
					echo "<script>alert('The username already exists! Please enter another username!')</script>";
				}else{
					$add_image = $_FILES['add_image']['name'];
					move_uploaded_file($_FILES['add_image']['tmp_name'],"images/$add_image");
					$insert_admin = "insert into admins (admin_name,admin_user,admin_pass,admin_image) values ('$ad_name','$ad_user','$ad_pass','$add_image')";
					$insert_ad = mysqli_query($con, $insert_admin);
					if($insert_ad){
						echo "<script>alert('You have successfully added an admin')</script>";
						echo "<script>window.open('index.php?add_admin','_self')</script>";
					}
				}
			}
		?>
	</div>
</div>
<?php } ?>
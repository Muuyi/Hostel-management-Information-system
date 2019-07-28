<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
//COLLECTING CUSTOMERS INFORMATION AND DISPLAYING IT TO THE CUSTOMERS PAGE
$user=$_SESSION['username'];
$getAdmin = "SELECT * FROM admins where admin_username='$user'";
$runAdmin = mysqli_query($con, $getAdmin);
$rowAdmin = mysqli_fetch_array($runAdmin);
$aId = $rowAdmin['admin_id'];
$name = $rowAdmin['admin_name'];
$userName = $rowAdmin['admin_username'];
$pass = $rowAdmin['admin_pass'];
$pic = $rowAdmin['admin_pic'];
$email = $rowAdmin['email'];
?>
<h1>Edit your account</h1><br />
<form action="admin.php?edit_account" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Full names</label>
		<input type="text" name="ad_name" class="form-control" value="<?php echo $name ?>" />
	</div>
	<div class="form-group">
		<label>User name</label>
		<input type="text" name="ad_user" class="form-control" value="<?php echo $userName ?>"/>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="ad_pass" class="form-control" value="<?php echo $pass ?>" />
	</div>
	<div class="form-group">
		<label>Image</label>
		<input type="file" name="ad_image" /><img src="images/<?php echo $pic ?>" width="50px" height="50px" />
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="ad_email" class="form-control" value="<?php echo $email ?>" />
	</div>
	<div class="form-group">
		<input type="submit" id="AdminSubmit" class="form-control" name="update" value="Edit account"/>
	</div>
</form>
<?php
	if(isset($_POST['update'])){
			$adId = $aId;
			$ad_name = $_POST['ad_name'];
			$ad_user = $_POST['ad_user'];
			$ad_pass = $_POST['ad_pass'];
			$ad_email = $_POST['ad_email'];
			$ad_image = $_FILES['ad_image']['name'];
			$tmp_admin = $_FILES['ad_image']['tmp_name'];
			move_uploaded_file($tmp_admin,"images/$ad_image");
			$updateAdmin = "update admins set admin_name='$ad_name', admin_username='$ad_user', admin_pass='$ad_pass', admin_pic='$ad_image', email='$ad_email' where admin_id='$adId'";
			$ad_update = mysqli_query($con, $updateAdmin);
			$run_update = mysqli_query($con, $ad_update);
			if($run_update){
				echo"<script>alert('You have successfully edited your account')</script>";
				echo "<script>window.open('admin.php?edit_account','_self')</script>";
			}
			
		}
?>
	<?php } ?>
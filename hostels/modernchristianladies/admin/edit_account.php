<?php
	error_reporting(E_ALL);
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
$fname = $rowAdmin['admin_FName'];
$lname = $rowAdmin['admin_LName'];
$userName = $rowAdmin['admin_Username'];
$idNumber = $rowAdmin['admin_IDNo'];
$pass = $rowAdmin['admin_pass'];
$pic = $rowAdmin['admin_pic'];
$email = $rowAdmin['admin_Email'];
?>
<div class="row">
	<div class="col-lg-12 col-md-12"> 
		<h1>Edit your account</h1>
		<h4 style="color:#A52A2A; font-weight:bolder;">Change profile picture</h4>
		<form action="admin.php?edit_account" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<input type="file" name="pic" id="admin_pic" class="admin_pic"/>
			</div>
			<div class="form-group">
				<input type="submit" value="Change profile pic" name="upload" class="btn btn-xs btn-danger" />
			</div>
		</form>
		<?php
		//CHANGING ADMIN PROFILE PICTURE
			if(isset($_POST['upload'])){
				//$id = $aId;
				$name = $_FILES['pic']['name'];
				$size = $_FILES['pic']['size'];
				//$image = $_FILES['pic']['tmp_name'];
				if($size > 1000000){
					echo "<script>alert('This file size is too large!Please only a maximum of 1MB is allowed!')</script>";
					echo "<script>window.open('admin.php?edit_account','_self')</script>";
				}else{
					$img = mysqli_real_escape_string($con, file_get_contents($_FILES['pic']['tmp_name']));
					$q = "UPDATE admins SET admin_pic='$img' WHERE admin_Username='".$user."'";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						echo "<script>alert('Your profile pic has been successfully changed!')</script>";
						echo "<script>window.open('admin.php?edit_account','_self')</script>";	
					}else{
						echo $q;
						echo (mysqli_error($con));
						//echo "<script>window.open('admin.php?edit_account','_self')</script>";	
					}
				}
			}
		?>
		
		<?php
					$user = $_SESSION['username'];
					$getImg="SELECT * FROM admins WHERE admin_username='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					if($rowImg['admin_pic'] == ''){
						echo '<div id="img"><img src="images/default.png" width="200px" height="200px" style="border:2px solid #000000; padding:2px;"></div><br />';
					}else{
						echo '<div id="img"><img src="data:image/jpeg;base64,'.base64_encode($rowImg['admin_pic']).'" width="200px" height="200px" style="border:2px solid #000000; padding:2px;"></div><br />';
					}
				?>
		<div id="profileResponse"></div>
		<form action="admin.php?edit_account" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>First Name</label>
						<input type="text" name="ad_fname" id="fname" class="form-control" value="<?php echo $fname ?>" />
						<?php $validator->outPutFieldError('c_fname');?>
						<div id="fnameresponse"></div>
					</div>
					<div class="col-lg-6 col-md-6">
						<label>Last Name</label>
						<input type="text" name="ad_lname" id="lname" class="form-control" value="<?php echo $lname ?>" />
						<?php $validator->outPutFieldError('c_lname');?>
						<div id="lnameresponse"></div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>ID Number</label>
						<input type="text" name="idNo" id="cnumber" class="form-control" value="<?php echo $idNumber ?>"/>
						<div id="idresponse"></div>
						<?php $validator->outPutFieldError('c_identity');?>
					</div>
					<div class="col-lg-6 col-md-6">
						<label>User name</label>
						<input type="text" name="ad_user" class="form-control" value="<?php echo $userName?>"/>
					</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>Email</label>
						<input type="email" name="ad_email" id="email" class="form-control" value="<?php echo $email ?>" />
						<div id="emailresponse"></div>
						<?php $validator->outPutFieldError('c_email');?>
					</div>
			</div><br />
			<div class="form-group">
				<input type="submit" id="AdminSubmit" class="form-control" name="update" value="Edit account"/>
			</div>
		</form>
	</div>
</div>
<?php
	if(isset($_POST['update'])){
			$adId = $aId;
			$ad_fname = mysqli_real_escape_string($con, $_POST['ad_fname']);
			$ad_lname = mysqli_real_escape_string($con, $_POST['ad_lname']);
			$ad_user = mysqli_real_escape_string($con, $_POST['ad_user']);
			$ad_pass = mysqli_real_escape_string($con, $_POST['ad_pass']);
			$squestion = mysqli_real_escape_string($con, $_POST['squestion']);
			$sanswer = mysqli_real_escape_string($con, $_POST['sanswer']);
			$id = mysqli_real_escape_string($con, $_POST['idNo']);
			$ad_email = mysqli_real_escape_string($con, $_POST['ad_email']);			
			$updateAdmin = "UPDATE admins SET admin_FName='$ad_fname', admin_LName='$ad_lname', admin_Email='$ad_email', admin_IDNo='$id', admin_Username='$ad_user' WHERE admin_id=$adId";
			$ad_update = mysqli_query($con, $updateAdmin);
			//$run_update = mysqli_query($con, $ad_update);
			if($ad_update){
				echo"<script>alert('You have successfully edited your account')</script>";
				echo "<script>window.open('admin.php?edit_account','_self')</script>";
			}
			
		}
?>
	<?php } ?>
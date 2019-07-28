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
$sanswer = $rowAdmin['admin_sanswer'];
$userName = $rowAdmin['admin_Username'];
$idNumber = $rowAdmin['admin_IDNo'];
$pass = $rowAdmin['admin_pass'];
$pic = $rowAdmin['admin_pic'];
$email = $rowAdmin['admin_Email'];
?>
<div class="row">
	<div class="col-lg-12 col-md-12"> 
		<h1>Edit your account</h1>
		<h4>Change profile picture</h4>
		<?php
					$user = $_SESSION['username'];
					$getImg="SELECT * FROM admins WHERE admin_username='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					echo '<div id="img"><img src="data:image/jpeg;base64,'.base64_encode($rowImg['admin_pic']).'" width="200px" height="200px" style="border:2px solid #000000; padding:2px;"></div><br />';
				?>
		<label>Change admin profile picture</label>
		<input type="file" name="admin_pic" id="admin_pic" />
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
					<div class="col-lg-6 col-md-6">
						<label>Security answer</label>
						<input type="text" name="sanswer" id="pfname" class="form-control" value="<?php echo $sanswer ?>" />
						<div id="pfnameresponse"></div>
						<?php $validator->outPutFieldError('c_pfname');?>
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
						<label>Password</label>
						<input type="password" name="ad_pass" class="form-control" value="<?php echo $pass ?>" />
					</div>
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
			$updateAdmin = "UPDATE admins SET admin_FName='$ad_fname', admin_LName='$ad_lname', admin_Email='$ad_email', admin_IDNo='$id', admin_Username='$ad_user', admin_squestion='$squestion', admin_sanswer='$sanswer', admin_pass='$ad_pass' WHERE admin_id=$adId";
			$ad_update = mysqli_query($con, $updateAdmin);
			//$run_update = mysqli_query($con, $ad_update);
			if($ad_update){
				echo"<script>alert('You have successfully edited your account')</script>";
				echo "<script>window.open('admin.php?edit_account','_self')</script>";
			}
			
		}
?>
	<?php } ?>
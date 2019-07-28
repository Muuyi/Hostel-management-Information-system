<?php
	error_reporting(E_ALL);
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php,'_self')</script>";
	}else{
?>
<?php
//COLLECTING CUSTOMERS INFORMATION AND DISPLAYING IT TO THE CUSTOMERS PAGE
$user=$_SESSION['email'];
$getAdmin = "SELECT * FROM hostel_admins where admin_email='$user'";
$runAdmin = mysqli_query($con, $getAdmin);
$rowAdmin = mysqli_fetch_array($runAdmin);
$aId = $rowAdmin['admin_id'];
$fname = $rowAdmin['admin_fname'];
$lname = $rowAdmin['admin_lname'];
$userName = $rowAdmin['admin_email'];
?>
<div class="row">
	<div class="col-lg-12 col-md-12"> 
		<h1>Edit your account</h1>
		<h4 style="color:#A52A2A; font-weight:bolder;">Change profile picture</h4>
		<?php
					$user = $_SESSION['email'];
					$getImg="SELECT * FROM hostel_admins WHERE admin_email='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					if($rowImg['profile_pic'] == ''){
						echo '<img src="images/default.png" class="admnProfileImg" width="200px" height="200px" style="border-radius:50%; padding:2px;">';
					}else{
						echo '<img src="passports/'.$rowImg['profile_pic'].'" class="admnProfileImg" width="200px" height="200px" style="border-radius:50%; padding:2px;">';
					}
				?>
		<input type="file" name="adminProfile" id="adminProfile" /><span id="admnProfileResponse" style="color:#FF0000;"></span>
		<div id="profileResponse"></div>
		<form action="admin.php?edit_account" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="admnId" value="<?php echo $aId ?>" />
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>First Name</label>
						<input type="text" name="ad_fname" id="fname" onblur="ValidateSingleName('fname','fnameresponse')" class="form-control" value="<?php echo $fname ?>" />
						<?php $validator->outPutFieldError('c_fname');?>
						<div id="fnameresponse"></div>
					</div>
					<div class="col-lg-6 col-md-6">
						<label>Last Name</label>
						<input type="text" name="ad_lname" id="lname" onblur="ValidateSingleName('lname','lnameresponse')" class="form-control" value="<?php echo $lname ?>" />
						<?php $validator->outPutFieldError('c_lname');?>
						<div id="lnameresponse"></div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<label>Email</label>
						<input type="email" name="ad_email" id="email" onblur="ValidateEmail('email','emailresponse')" class="form-control" value="<?php echo $userName ?>" />
						<div id="emailresponse"></div>
						<?php $validator->outPutFieldError('c_email');?>
					</div>
			</div>
			<div class="form-group">
				<input type="submit" id="AdminSubmit" class="btn btn-success form-control" name="update" value="Edit account"/>
			</div>
		</form>
	</div>
</div>
<?php
	if(isset($_POST['update'])){
			$adId = $aId;
			$ad_fname = mysqli_real_escape_string($con, $_POST['ad_fname']);
			$ad_lname = mysqli_real_escape_string($con, $_POST['ad_lname']);
			$ad_email = mysqli_real_escape_string($con, $_POST['ad_email']);		
			$updateAdmin = "UPDATE hostel_admins SET admin_fname='$ad_fname', admin_lname='$ad_lname', admin_email='$ad_email' WHERE admin_id='".$adId."'";
			$ad_update = mysqli_query($con, $updateAdmin);
			//$run_update = mysqli_query($con, $ad_update);
			if($ad_update){
				echo"<script>alert('You have successfully edited your account')</script>";
				echo "<script>window.open('admin.php?edit_account','_self')</script>";
			}else{
				echo mysqli_error($con);
			}
			
		}
?>
	<?php } ?>
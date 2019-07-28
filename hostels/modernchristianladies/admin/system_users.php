<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
	include_once('db.php');
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
	
		<h1>System users</h1>
		<input type="button" value="Add user" class="btn btn-primary" data-target="#addusers" data-toggle="modal"/>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Passport</th>
					<th>ID No</th>
					<th>Email address</th>
					<th>Username</th>
					<th>Edit</th>
					<th>Status</th>
					<th>Delete</th>
				</tr>
					<?php
						$q = "SELECT * FROM admins";
						$rQ = mysqli_query($con, $q);
						$i = 0;
						while($row = mysqli_fetch_array($rQ)){
							$i++;
							$id = $row['admin_id'];
							$fname = $row['admin_FName'];
							$lname = $row['admin_LName'];
							$email = $row['admin_Email'];
							$idNo = $row['admin_IDNo'];
							$username = $row['admin_Username'];
							$passport = $row['admin_pic'];
							$status = $row['status'];
							echo '
								<tr>
									<th>'.$i.'</th>
									<th>'.$fname.' '.$lname.'</th>
									<th>';
									if($passport == ''){
										echo '<img src="images/default.png" width="50px" height="50px" />';
									}else{
										echo '<img src="data:image/jpeg;base64,'.base64_encode($passport).'" width="50px" height="50px" />';
									}
							echo 	'</th>
									<th>'.$idNo.'</th>
									<th>'.$email.'</th>
									<th>'.$username.'</th>';
?>
									<th><input type="button" value="Edit" id="<?php echo $id ?>" class="btn btn-primary btn-xs edit_sysuser" /> </th>
					<?php
									if($status == 'active'){
									echo '<th><div id="adminStatus"><input type="button" value="Active" class="btn btn-xs btn-info admin_state" id="'.$id.'"/></div> </th>';
									}else{
										echo '<th><div id="adminStatus"><input type="button" value="Inactive" class="btn btn-xs btn-warning admin_state" id="'.$id.'" /></div></th>';
									}
										echo '<th><input type="button" value="Delete" class="btn btn-danger btn-xs admin_delete" id="'.$id.'"/> </th>
								</tr>
							';
						}
					?>
			</table>
		</div>
	</div>
</div>
<!--SENDING USERS INFORMATION TO THE DATABASE-->
<div class="modal fade" id="addusers">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add system users</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="admin.php?system_users" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>First Name</label>
								<input type="text" id="fname" class="form-control" name="fname" placeholder="Enter first name..." required/>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Last Name</label>
								<input type="text" id="lname" class="form-control" name="lname" placeholder="Enter last name..." required/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Email address</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter email address..." required/>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>ID Number</label>
								<input type="number" class="form-control" id="idno" name="id" placeholder="Enter ID No..." />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Phone number</label>
								<input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number..." />
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Enter username..." />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Profile picture</label>
								<input type="file" name="profile" class="form-control"/>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Password</label>
								<input type="password" name="pass" id="password" class="form-control" placeholder="Enter password..." />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Usertype</label><br />
								Master: &nbsp; <input type="radio" name="sys_user" id="user" value="master"/> &nbsp; &nbsp; &nbsp; 
								User: &nbsp; <input type="radio" name="sys_user" id="user" value="user" />
							</div>
						</div>
						<input type="hidden" name="sys_id" id="sys_id" />
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group">
								<input type="submit" name="save" id="insert" class="btn btn-primary form-control" value="Save"/>
							</div>
						</div>
					</labe>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php
	if(isset($_POST['save'])){
		$fname = mysqli_real_escape_string($con, $_POST['fname']);
		$lname = mysqli_real_escape_string($con, $_POST['lname']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$id = mysqli_real_escape_string($con, $_POST['id']);
		$phone = mysqli_real_escape_string($con, $_POST['phone']);
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = md5(mysqli_real_escape_string($con, $_POST['pass']));
		$profile = mysqli_real_escape_string($con, $_FILES['profile']['tmp_name']);
		$user = $_POST['sys_user'];
		$pic = addslashes(file_get_contents($profile));
		$q = "INSERT INTO admins (admin_FName,admin_LName, admin_Email,admin_IDNo,phone,admin_Username,admin_pass,admin_pic,user_type) VALUES('$fname','$lname','$email','$id','$phone','$username','$password','$pic','$user')"; 
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "<script>alert('You have successfully added a system user!')</script>";
			echo "<script>window.open('admin.php?system_users','_self')</script>";
		} else{
			//echo (mysqli_error($con));
			echo "<script>alert('A problem occured during submission.Please try again or try to conduct <b>0724654808</b> to check where the problem is!')</script>";
			echo "<script>window.open('admin.php?system_users','_self')</script>";
		}
	}
?>

<?php } ?>
<?php
	require_once("../formvalidator.php");
	$validator = new validator();
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
		$error = '';
	}else{
?>
<!--<div id="adminHeader">
	<input type="submit" value="View clients" class="adminBtn" />
	<input type="submit" value="Add client" class="adminBtn" />
	<input type="submit" value="Checked in clients" class="adminBtn" />
	<input type="submit" value="Checked out clients" class="adminBtn" />
	<input type="submit" value="Balances" class="adminBtn" />
</div>-->
<?php
	if(isset($_POST['book'])){
		$hostel = $_SESSION['hostel'];
		$c_fname = mysqli_real_escape_string($con, $_POST['c_fname']);
		$c_lname = mysqli_real_escape_string($con, $_POST['c_lname']);
		$c_number = mysqli_real_escape_string($con, $_POST['c_number']);
		$c_id = mysqli_real_escape_string($con, $_POST['c_identity']);
		$c_institution = mysqli_real_escape_string($con, $_POST['institution']);
		$c_email = mysqli_real_escape_string($con, $_POST['c_email']);
		$c_pfname = mysqli_real_escape_string($con, $_POST['c_pfname']);
		$c_pphone = mysqli_real_escape_string($con, $_POST['c_pphone']);
		$room_cat = mysqli_real_escape_string($con, $_POST['room_cat']);
		$room_no = mysqli_real_escape_string($con, $_POST['room_no']);
		$gender = $_POST['g'];
		$status = "in";
		//move_uploaded_file($tmp_name,"images/$c_passport");
		//FORM VALIDATION
		//Customer name validation
		$validator->addField('c_fname');
		$validator->addRuleToField('c_fname', array('empty'));
		$validator->addField('c_lname');
		$validator->addRuleToField('c_lname', array('empty'));
		//$validator->addRuleToField('c_name', array('name'));
		//CUSTOMER PHONE NUMBER VALIDATION
		$validator->addField('c_number');
		$validator->addRuleToField('c_number', array('empty'));
		//$validator->addRuleToField('c_number', array('num'));
		//ID NUMBER VALIDATION
		$validator->addField('c_identity');
		$validator->addRuleToField('c_identity', array('empty'));
		//$validator->addRuleToField('c_identity', array('num'));
		//EMAIL ADDRESS VALIDATION
		$validator->addField('c_email');
		$validator->addRuleToField('c_email', array('empty'));
		//$validator->addRuleToField('c_email', array('valemail'));
		//CLIENTS INSTITUTION VALIDATION
		$validator->addField('institution');
		$validator->addRuleToField('institution', array('empty'));
		//$validator->addRuleToField('c_institution', array('name'));
		//PARENTS NAME VALIDATION
		$validator->addField('c_pfname');
		$validator->addRuleToField('c_pfname', array('empty'));
		$validator->addField('c_pfname');
		$validator->addRuleToField('c_pfname', array('empty'));
		//$validator->addRuleToField('c_pname', array('name'));
		//PARENTS PHONE NUMBER VALIDATION
		$validator->addField('c_pphone');
		$validator->addRuleToField('c_pphone', array('empty'));
		//$validator->addRuleToField('c_pphone', array('num'));*/
		if($validator->formValid()){
			$identify = "SELECT * FROM clients WHERE id_no = '$c_id'";
			$runIdentity = mysqli_query($con, $identify);
			$count = mysqli_num_rows($runIdentity);
			if($count > 0){
				$idExists = ("<p class='error'> The ID number " . $c_id . " exists.Please contact your administrator to check you in </p>");
			} else {
				$q = '';
				$q .= "INSERT INTO clients (fname,lname,id_no,phone,uni_id,email,pphone,pname,gender,join_date) values ('$c_fname','$c_lname','$c_id','$c_number','$c_institution','$c_email','$c_pphone','$c_pfname','$gender',now());";
				$q .= "INSERT INTO hostel_client_list(id_no,host_id,rm_id,uni_id,join_date) VALUES ('$c_id','$hostel','$room_no','$c_institution',now())";
				$rQ = mysqli_multi_query($con, $q);
				if($rQ){
					echo "<script>alert('You have successfully booked a room')</script>";
					echo "<script>window.open('admin.php?add_client','_self')</script>";
					}else{
						echo mysqli_error($con);
						//echo "<script>alert('".mysqli_error($con)."')</script>";
						//echo "<script>window.open('admin.php?add_client','_self')</script>";
					}
				}
			}
		}
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<h1>Add clients</h1><br />
		<?php echo @$error ?>
		<button type="button" class="btn btn-primary" data-target="#add_university" data-toggle="modal">Add institution name</button>
		<button type="button" class="btn btn-primary" data-target="#add_room" data-toggle="modal">Add room number</button>
		<form action="admin.php?add_client" method="POST" id="customerForm" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="full-names">First Name</label>
										<input type="text" name="c_fname" id="fname" class="form-control" placeholder="Client's first name" value="<?php if(isset($_POST['c_fname'])) echo $_POST['c_fname'];?>" required/>
										<?php $validator->outPutFieldError('c_fname');?>
										<div id="fnameresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="full-names">Last Name</label>
										<input type="text" name="c_lname" id="lname" class="form-control" placeholder="Client's last name" value="<?php if(isset($_POST['c_lname'])) echo $_POST['c_lname'];?>" required/>
										<?php $validator->outPutFieldError('c_lname');?>
										<div id="lnameresponse"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="phone-number">Phone number</label>
									<b>(+254)</b><input type="text" name="c_number" id="cphone" class="form-control" placeholder="Client's phone number" value="<?php if(isset($_POST['c_number'])) echo $_POST['c_number'];?>" onkeyup="(numbersOnly(this))" required pattern="^[0-9]+"/>
									<div id="phoneresponse"></div>
									<?php $validator->outPutFieldError('c_number');?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="id-no">ID Number</label>
									<input type="text" id="cnumber" name="c_identity" class="form-control" placeholder="Client's ID Number" value="<?php if(isset($_POST['c_identity'])) echo $_POST['c_identity'];?>" onkeyup="(numbersOnly(this))" required pattern="^[0-9]+"/>
									<?php  echo @ $idExists ?>
									<div id="idresponse"></div>
									<?php $validator->outPutFieldError('c_identity');?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="full-names">Email address</label>
									<input type="email" name="c_email" id="email" class="form-control" value="<?php if(isset($_POST['c_email'])) echo $_POST['c_email'];?>" placeholder="Enter your email address" required/>
									<div id="emailresponse"></div>
									<?php $validator->outPutFieldError('c_email');?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="institution">Select institution of learning</label>
									<select name="institution" class="form-control">
										<option value="">Select institution</option>
										<?php
											$q = "SELECT * FROM universities";
											$rQ = mysqli_query($con, $q);
											while($rw = mysqli_fetch_array($rQ)){
												echo "<option value='".$rw['uni_id']."'>".$rw['uni_name']."</option>";
											}
										?>
									</select>
									<div id="institutionresponse"></div>
									<?php $validator->outPutFieldError('c_institution');?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="g-name">Guardian/Parents Full name</label>
									<input type="text" id="pfname" name="c_pfname" class="form-control" placeholder="Enter parent's/guardian's first name" value="<?php if(isset($_POST['c_pfname'])) echo $_POST['c_pfname'];?>" required />
									<div id="pfnameresponse"></div>
									<?php $validator->outPutFieldError('c_pfname');?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="g-number">Guardian's/Phone number</label>
									<b>(+254)</b><input type="text" name="c_pphone" id="pphone" class="form-control" placeholder="Enter parent's/guardian's phone number" value="<?php if(isset($_POST['c_pphone'])) echo $_POST['c_pphone'];?>" onkeyup="(numbersOnly(this))" required />
									<div id="pphoneresponse"></div>
									<?php $validator->outPutFieldError('c_pphone');?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="app-info">Category of room</label>
									<select name="room_cat" id="croom" class="form-control" style="text-align:center;">
										<option value="">------------Select a Room Category----------</option>
										<?php
											GetRoomCategories();
										?>
									</select>
									<div class="response" id="roomresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="app-info">Select room number</label>
									<select name="room_no"  class="form-control" id="rm_no" style="text-align:center;">
										<option value="default">------------Please select room category first----------</option>
									</select>
									<div class="response" id="roomresponse"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Gender</label><br />
									<b>Male:</b> &nbsp; <input type="radio" name="g" value="m" /> <b>Female:</b> &nbsp; <input type="radio" name="g" value="f" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="book" id="submit" class="btn btn-primary btn-lg form-control" value="Book Room"/>
						</div>
				</form>
	</div>
</div>
<?php
	if(isset($_POST['save_university'])){
		$name = mysqli_real_escape_string($con, $_POST['institution_name']);
		$q = "SELECT * FROM universities WHERE uni_name='$name'";
		$rQ = mysqli_query($con, $q);
		$count = mysqli_num_rows($rQ);
		if($count > 0){
			$error = "<div class='alert alert-danger'>The university already exists!</div>";
		}else{
			$qry = "INSERT INTO universities (uni_name) VALUES('$name')";
			$rQry = mysqli_query($con, $qry);
			if($rQry){
				echo "<script>alert('You have successfully added an institution')</script>";
				echo "<script>window.open('admin.php?add_client','_self')</script>";
			}
		}
	}
?>
<!--ADDING THE UNIVERSITY TO THE DATABASE-->
<div class="modal" id="add_university">
	<div class="modal-dialog">
		<div class="modal-content">
		<form method="POST" action="admin.php?add_client">
			<div class="modal-header">
				<h4>Add institution name</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?php echo @$error ?>
				<div class="form-group">
					<label for="university name">Institution name</label>
					<input type="text" class="form-control" name="institution_name" placeholder="Add institution name...."/>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" name="save_university" value="Add institution" class="btn btn-success" />
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</form>
		</div>
	</div>
</div>
<!--ADDING THE ROOM NUMBER TO THE DATABASE-->
	<?php include_once('add_room_numbers.php'); ?>
	<?php } ?>
	
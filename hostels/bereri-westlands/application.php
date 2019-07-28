<style>
	.warning_msg{
		color:#FF0000;
	}
	.warning_bd{
		border:1px solid #FF0000;
	}
</style>
<?php 
require_once("db.php");
require_once("../formvalidator.php");
$validator = new validator();
	if(isset($_POST['book'])){
		$c_fname = mysqli_real_escape_string($con, trim($_POST['c_fname']));
		$c_lname = mysqli_real_escape_string($con, trim($_POST['c_lname']));
		$c_number = mysqli_real_escape_string($con, trim($_POST['c_number']));
		$c_id = mysqli_real_escape_string($con, trim($_POST['c_identity']));
		$c_institution = mysqli_real_escape_string($con, trim($_POST['c_institution']));
		$c_email = mysqli_real_escape_string($con, trim($_POST['c_email']));
		$c_pfname = mysqli_real_escape_string($con, trim($_POST['c_pfname']));
		$c_plname = mysqli_real_escape_string($con, trim($_POST['c_plname']));
		$c_pphone = mysqli_real_escape_string($con, trim($_POST['c_pphone']));
		$room_cat = mysqli_real_escape_string($con, trim($_POST['room_cat']));
		$gender = $_POST['g'];
		$status = "Check out";
		//UPLOADING THE IMAGE
		$c_passport = $_FILES['c_passport']['name'];
		$tmp_name = mysqli_real_escape_string($con, file_get_contents($_FILES['c_passport']['tmp_name']));
		//$fileSize = $_FILES['c_passport']['size'];
		//move_uploaded_file($tmp_name,"admin/images/$c_passport");
		//FORM VALIDATION
		//Customer name validation
		$validator->addField('c_fname');
		$validator->addRuleToField('c_fname', array('empty'));
		$validator->addRuleToField('c_fname', array('min_length', 3));
		//$validator->addRuleToField('c_fname', array('sname'));
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
		$validator->addField('c_institution');
		$validator->addRuleToField('c_institution', array('empty'));
		//$validator->addRuleToField('c_institution', array('name'));
		//PARENTS NAME VALIDATION
		$validator->addField('c_pfname');
		$validator->addRuleToField('c_pfname', array('empty'));
		//$validator->addRuleToField('c_pname', array('name'));
		//PARENTS PHONE NUMBER VALIDATION
		$validator->addField('c_pphone');
		$validator->addRuleToField('c_pphone', array('empty'));
		//$validator->addRuleToField('c_pphone', array('num'));*/
		if($validator->formValid()){
			$identify = "SELECT * FROM clients WHERE Client_IDNo = '$c_id'";
			$runIdentity = mysqli_query($con, $identify);
			$count = mysqli_num_rows($runIdentity);
			if($count > 0){
				$idExists = ("<p class='error'> The ID number " . $c_id . " exists.Please contact your administrator to check you in </p>");
			} else {
				$insert_client = "insert into clients (Client_IDNo, First_Name,Last_Name,Gender,Phone_Number,Client_Institution,Clients_Email,rm_cat,Parents_FName,Parents_LName,Parents_Phone,Payment_Date,Passport,status) values ('$c_id','$c_fname','$c_lname','$gender','$c_number','$c_institution','$c_email','$room_cat','$c_pfname','$c_plname','$c_pphone',now(),'$tmp_name','$status')";
				$insert_c = mysqli_query($con, $insert_client);
				if($insert_c){
					echo "<script>alert('You have successfully booked a room')</script>";
					echo "<script>window.open('bookroom.php','_self')</script>";
				}else{
					echo "<script>alert('There was a problem while submitting the data to the database. Please try again and ensure you have entered all the fields correctly!')</script>";
					}
				}
			}
		}
 ?>
	<!--<?php //include ("header.php"); ?>-->
	<!--<body id="ApplicationBody" class="row">
		<section class="col-lg-3">
		</section>
		<section id="ApplicationSection" class="col-lg-6">-->
<div class="modal fade" id="modal-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">APPLICATION FORM</h1>
			</div>
			<div class="modal-body">
				<form action="bookroom.php" method="POST" id="customerForm" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="full-names">First Name</label>
									<input type="text" name="c_fname" id="fname" class="form-control" placeholder="Client's first name" value="<?php if(isset($_POST['c_fname'])) echo $_POST['c_fname'];?>" />
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
								<label for="Passport-photo">Passport photo( atmost 1MB & only jpg/jpeg images allowed) </label>
								<input type="file" id="cpassport" name="c_passport" />
								<div id="passportresponse" class="error"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="id-no">ID Number</label>
								<input type="text" id="cnumber" name="c_identity" class="form-control" placeholder="Client's ID Number" value="<?php if(isset($_POST['c_identity'])) echo $_POST['c_identity'];?>" onkeyup="(numbersOnly(this))" pattern="^[0-9]+" required/>
								<?php  echo @ $idExists ?>
								<div id="idresponse"></div>
								<?php $validator->outPutFieldError('c_identity');?>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="full-names">Email address</label>
								<input type="email" name="c_email" id="email" class="form-control" value="<?php if(isset($_POST['c_email'])) echo $_POST['c_email'];?>" placeholder="Enter your email address" required/>
								<div id="emailresponse"></div>
								<?php $validator->outPutFieldError('c_email');?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="institution">Client's Institution of learning</label>
								<input type="text" id="cinstitution" name="c_institution" value="<?php if(isset($_POST['c_institution'])) echo $_POST['c_institution'];?>" class="form-control" placeholder="Client's institution of learning" required pattern="^[A-Za-z' ]+"/>
								<div id="institutionresponse"></div>
								<?php $validator->outPutFieldError('c_institution');?>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="g-name">Guardian/Parents First name</label>
								<input type="text" id="pfname" name="c_pfname" class="form-control" placeholder="Enter parent's/guardian's first name" value="<?php if(isset($_POST['c_pfname'])) echo $_POST['c_pfname'];?>" required />
								<div id="pfnameresponse"></div>
								<?php $validator->outPutFieldError('c_pfname');?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="g-name">Guardian/Parents Last name</label>
								<input type="text" id="plname" name="c_plname" class="form-control" placeholder="Enter parent's/guardian's last name" value="<?php if(isset($_POST['c_plname'])) echo $_POST['c_plname'];?>" required />
								<div id="plnameresponse"></div>
								<?php $validator->outPutFieldError('c_plname');?>
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
									<option value="default">------------Select a Room Category----------</option>
									<?php
										$get_cats = "select * from category";
										$run_cats = mysqli_query($con, $get_cats);
										while($row_cats=mysqli_fetch_array($run_cats)){
											$cat_id = $row_cats['cat_id'];
											$cat_title = $row_cats['cat_name'];
											echo "<option value='$cat_id'>$cat_title</option>";
											}?>
								</select>
								<div class="response" id="roomresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="gender">Gender</label><br />
								<b>Male:</b> &nbsp; <input type="radio" name="g" id="radio1" value="Male" /> <b>Female:</b> &nbsp; <input type="radio" name="g" id="radio2" value="Female" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" name="book" id="submit" class="btn btn-primary btn-lg form-control" value="Book Room" disabled="disabled"/>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
	<!--</section>
	<section class="col-lg-3">
	</section>-->
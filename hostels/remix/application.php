<?php 
require_once("db.php");
require_once("../formvalidator.php");
$validator = new validator();
	if(isset($_POST['book'])){
		$c_name = mysqli_real_escape_string($con, $_POST['c_name']);
		$c_number = mysqli_real_escape_string($con, $_POST['c_number']);
		$c_id = mysqli_real_escape_string($con, $_POST['c_identity']);
		$c_institution = mysqli_real_escape_string($con, $_POST['c_institution']);
		$c_email = mysqli_real_escape_string($con, $_POST['c_email']);
		$c_pname = mysqli_real_escape_string($con, $_POST['c_pname']);
		$c_pphone = mysqli_real_escape_string($con, $_POST['c_pphone']);
		$room_cat = mysqli_real_escape_string($con, $_POST['room_cat']);
		$status = "Check out";
		//UPLOADING THE IMAGE
		$c_passport = $_FILES['c_passport']['name'];
		$tmp_name = $_FILES['c_passport']['tmp_name'];
		$fileSize = $_FILES['c_passport']['size'];
		move_uploaded_file($tmp_name,"admin/images/$c_passport");
		//FORM VALIDATION
		//Customer name validation
		$validator->addField('c_name');
		$validator->addRuleToField('c_name', array('empty'));
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
		$validator->addField('c_pname');
		$validator->addRuleToField('c_pname', array('empty'));
		//$validator->addRuleToField('c_pname', array('name'));
		//PARENTS PHONE NUMBER VALIDATION
		$validator->addField('c_pphone');
		$validator->addRuleToField('c_pphone', array('empty'));
		//$validator->addRuleToField('c_pphone', array('num'));*/
		if($validator->formValid()){
			$identify = "SELECT * FROM clients WHERE c_identity = '$c_id'";
			$runIdentity = mysqli_query($con, $identify);
			$count = mysqli_num_rows($runIdentity);
			if($count > 0){
				$idExists = ("<p class='error'> The ID number " . $c_id . " exists.Please contact your administrator to check you in </p>");
			} else {
				$insert_client = "insert into clients (c_name,c_phone,c_passport,c_identity,c_institution,c_email,c_pname,c_pphone,c_room,date,status) values ('$c_name','$c_number','$c_passport','$c_id','$c_institution','$c_email','$c_pname','$c_pphone','$room_cat',now(),'$status')";
				$insert_c = mysqli_query($con, $insert_client);
				if($insert_c){
					echo "<script>alert('You have successfully booked a room')</script>";
					echo "<script>window.open('application.php','_self')</script>";
					}
				}
			}
		}
 ?>
	<?php include ("header.php"); ?>
	<body id="ApplicationBody" class="row">
		<section class="col-lg-3">
		</section>
		<section id="ApplicationSection" class="col-lg-6">
			<h1>APPLICATION FORM</h1>
			<form action="application.php" method="POST" id="customerForm" enctype="multipart/form-data">
				<div class="form-group">
					<label for="full-names">Full names</label>
						<input type="text" name="c_name" id="cname" class="form-control" placeholder="Client's full names" value="<?php if(isset($_POST['c_name'])) echo $_POST['c_name'];?>" required/>
						<?php $validator->outPutFieldError('c_name');?>
						<div id="nameresponse"></div>
				</div>
				<div class="form-group">
					<label for="phone-number">Phone number</label>
					<b>(+254)</b><input type="text" name="c_number" id="cphone" class="form-control" placeholder="Client's phone number" value="<?php if(isset($_POST['c_number'])) echo $_POST['c_number'];?>" onkeyup="(numbersOnly(this))" required pattern="^[0-9]+"/>
					<div id="phoneresponse"></div>
					<?php $validator->outPutFieldError('c_number');?>
				</div>
				<div class="form-group">
					<label for="Passport-photo">Passport photo( atmost 1MB & jpg/png) </label>
					<input type="file" id="cpassport" name="c_passport" />
					<div id="passportresponse"></div>
				</div>
				<div class="form-group">
					<label for="id-no">ID Number</label>
					<input type="text" id="cnumber" name="c_identity" class="form-control" placeholder="Client's ID Number" value="<?php if(isset($_POST['c_identity'])) echo $_POST['c_identity'];?>" required pattern="^[0-9]+"/>
					<?php  echo @ $idExists ?>
					<div id="idresponse"></div>
					<?php $validator->outPutFieldError('c_identity');?>
				</div>
				<div class="form-group">
					<label for="full-names">Email address</label>
					<input type="email" name="c_email" id="email" class="form-control" value="<?php if(isset($_POST['c_email'])) echo $_POST['c_email'];?>" placeholder="Enter your email address" required/>
					<div id="emailresponse"></div>
					<?php $validator->outPutFieldError('c_email');?>
				</div>
				<div class="form-group">
					<label for="institution">Client's Institution of learning</label>
					<input type="text" id="cinstitution" name="c_institution" value="<?php if(isset($_POST['c_institution'])) echo $_POST['c_institution'];?>" class="form-control" placeholder="Client's institution of learning" required pattern="^[A-Za-z' ]+"/>
					<div id="institutionresponse"></div>
					<?php $validator->outPutFieldError('c_institution');?>
				</div>
				<div class="form-group">
					<label for="g-name">Guardian/Parents name</label>
					<input type="text" id="pname" name="c_pname" class="form-control" placeholder="Enter parent's/guardian's full names" value="<?php if(isset($_POST['c_pname'])) echo $_POST['c_pname'];?>" required />
					<div id="pnameresponse"></div>
					<?php $validator->outPutFieldError('c_pname');?>
				</div>
				<div class="form-group">
					<label for="g-number">Guardian's/Phone number</label>
					<b>(+254)</b><input type="text" name="c_pphone" id="pphone" class="form-control" placeholder="Enter parent's/guardian's phone number" value="<?php if(isset($_POST['c_pphone'])) echo $_POST['c_pphone'];?>" onkeyup="(numbersOnly(this))" required />
					<div id="pphoneresponse"></div>
					<?php $validator->outPutFieldError('c_pphone');?>
				</div>
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
				<div class="form-group">
					<input type="submit" name="book" id="submit" class="btn btn-primary btn-lg form-control" value="Book Room"/>
				</div>
			</form>
	</section>
	<section class="col-lg-3">
	</section>
<?php require_once("footer.php"); ?>
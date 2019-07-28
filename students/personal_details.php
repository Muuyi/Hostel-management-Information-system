<?php
	if(isset($_POST['book'])){
		$c_fname = mysqli_real_escape_string($con, $_POST['c_fname']);
		$c_lname = mysqli_real_escape_string($con, $_POST['c_lname']);
		$c_number = mysqli_real_escape_string($con, $_POST['c_number']);
		$c_id = mysqli_real_escape_string($con, $_POST['c_identity']);
		$c_institution = mysqli_real_escape_string($con, $_POST['institution']);
		$c_email = mysqli_real_escape_string($con, $_POST['c_email']);
		$c_pfname = mysqli_real_escape_string($con, $_POST['c_pfname']);
		$c_pphone = mysqli_real_escape_string($con, $_POST['c_pphone']);
		$yr = mysqli_real_escape_string($con, $_POST['year_of_study']);
		$course = mysqli_real_escape_string($con, $_POST['course']);

		$gender = mysqli_real_escape_string($con, $_POST['gender']);
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
			$q = "UPDATE clients SET fname='$c_fname',lname='$c_lname',id_no='$c_id',phone='$c_number',uni_id='$c_institution',email='$c_email',pphone='$c_pphone',pname='$c_pfname',gender='$gender',yr_id='$yr',course='$course' WHERE cl_id='".$_SESSION['cl_id']."'";
				
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "<script>alert('You have successfully updated your personal information')</script>";
					echo "<script>window.open('admin.php?personal','_self')</script>";
					}else{
						echo mysqli_error($con);
						//echo "<script>alert('".mysqli_error($con)."')</script>";
						//echo "<script>window.open('admin.php?add_client','_self')</script>";
					}
				}
		}
	$q = "SELECT * FROM ((clients INNER JOIN universities ON clients.uni_id=universities.uni_id) LEFT OUTER JOIN year_of_study ON clients.yr_id=year_of_study.yr_id) WHERE id_no='".$_SESSION['id']."'";
	$rQ = mysqli_query($con, $q);
	while($row = mysqli_fetch_array($rQ)){
		$cl_id = $row['cl_id'];
?>
	<h1>Edit personal details</h1>
		<h4 style="color:#A52A2A; font-weight:bolder;">Change profile picture</h4>
		<?php
					$user = $_SESSION['cl_id'];
					$getImg="SELECT * FROM clients WHERE cl_id='$user'";
					$runImg = mysqli_query($con,$getImg);
					$rowImg = mysqli_fetch_array($runImg);
					if($rowImg['passport'] == ''){
						echo '<img src="../admins/images/default.png" id="studentPic" class="admnProfileImg" width="200px" height="200px" style="border-radius:50%; padding:2px;">';
					}else{
						echo '<img src="../admins/passports/'.$rowImg['passport'].'" id="studentPic" data-client="'.$user.'" class="admnProfileImg" width="200px" height="200px" style="border-radius:50%; padding:2px;">';
					}
				?>
		<input type="file" name="change_client_profile" id="change_client_profile" /><div id="studentProfileResponse" style="color:#FF0000;"></div>
	<form action="admin.php?personal" method="POST" id="customerForm" enctype="multipart/form-data">
		<input type="hidden" id="client_id"  value="<?php echo $row['cl_id'];?>" />
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="full-names">First Name</label>
					<input type="text" name="c_fname" id="fname" class="form-control" placeholder="Client's first name" value="<?php echo $row['fname'];?>" required disabled/>
					<?php $validator->outPutFieldError('c_fname');?>
					<div id="fnameresponse"></div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="full-names">Last Name</label>
						<input type="text" name="c_lname" id="lname" class="form-control" placeholder="Client's last name" value="<?php echo $row['lname'];?>" required disabled/>
						<?php $validator->outPutFieldError('c_lname');?>
						<div id="lnameresponse"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="phone-number">Phone number</label>
					<b>(+254)</b><input type="text" name="c_number" id="cphone" class="form-control" placeholder="Client's phone number" value="<?php echo $row['phone']; ?>" onkeyup="(numbersOnly(this))" required pattern="^[0-9]+" disabled/>
					<div id="phoneresponse"></div>
					<?php $validator->outPutFieldError('c_number');?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="id-no">ID Number</label>
					<input type="text" id="cnumber" name="c_identity" class="form-control" placeholder="Client's ID Number" value="<?php echo $row['id_no'];?>" onkeyup="(numbersOnly(this))" required pattern="^[0-9]+" disabled/>
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
					<input type="email" name="c_email" id="email" class="form-control" value="<?php echo $row['email'];?>" placeholder="Enter your email address" required disabled/>
					<div id="emailresponse"></div>
					<?php $validator->outPutFieldError('c_email');?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="institution">Select institution of learning</label>
					<select name="institution" class="form-control" disabled>
						<option value="<?php echo $row['uni_id'] ?>"><?php echo $row['uni_name'] ?></option>
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
									<input type="text" id="pfname" name="c_pfname" class="form-control" placeholder="Enter parent's/guardian's first name" value="<?php echo $row['pname'];?>" required disabled/>
									<div id="pfnameresponse"></div>
									<?php $validator->outPutFieldError('c_pfname');?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="g-number">Guardian's/Phone number</label>
									<b>(+254)</b><input type="text" name="c_pphone" id="pphone" class="form-control" placeholder="Enter parent's/guardian's phone number" value="<?php echo $row['pphone'];?>" onkeyup="(numbersOnly(this))" required disabled/>
									<div id="pphoneresponse"></div>
									<?php $validator->outPutFieldError('c_pphone');?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Gender</label><br />
									<b>Male:</b> &nbsp; <input type="radio" name="gender" value="m" <?php if($row['gender'] == 'm'){ echo 'checked'; }?> /> <b>Female:</b> &nbsp; <input type="radio" name="gender" value="f" <?php if($row['gender'] == 'f'){ echo 'checked'; }?> />
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Year of Study</label><br />
									<select name="year_of_study" class="form-control" disabled>
									<option value="<?php echo $row['yr_id'] ?>"><?php echo $row['yr_name'] ?></option>
									<?php
										$q = "SELECT * FROM year_of_study";
										$rQ = mysqli_query($con, $q);
										while($rw = mysqli_fetch_array($rQ)){
											echo "<option value='".$rw['yr_id']."'>".$rw['yr_name']."</option>";
										}
									?>
								</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Stundent's course</label><br />
									<input type="text" id="course" name="course" class="form-control" value="<?php echo $row['course'];?>" required disabled/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="book" id="submit" class="btn btn-primary btn-lg form-control" value="Update Personal Details
							" disabled/>
						</div>
				</form>

<?php
	}
?>
	
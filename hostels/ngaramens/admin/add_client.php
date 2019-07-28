<?php
	require_once("../../formvalidator.php");
	$validator = new validator();
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
	if(isset($_POST['update'])){
		$c_name = mysqli_real_escape_string($con, $_POST['c_name']);
		$c_number = mysqli_real_escape_string($con, $_POST['c_number']);
		$c_id = mysqli_real_escape_string($con, $_POST['c_identity']);
		$c_institution = mysqli_real_escape_string($con, $_POST['c_institution']);
		$c_email = mysqli_real_escape_string($con, $_POST['c_email']);
		$c_pname = mysqli_real_escape_string($con, $_POST['c_pname']);
		$c_pphone = mysqli_real_escape_string($con, $_POST['c_pphone']);
		$room_cat = mysqli_real_escape_string($con, $_POST['room_cat']);
		$amount = mysqli_real_escape_string($con, $_POST['amount']);
		$status = 1 ;
		//UPLOADING THE IMAGE
		$c_passport = $_FILES['c_passport']['name'];
		$tmp_name = $_FILES['c_passport']['tmp_name'];
		move_uploaded_file($tmp_name,"images/$c_passport");
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
				$insert_client = "insert into clients (c_name,c_phone,c_passport,c_identity,c_institution,c_email,c_pname,c_pphone,c_room,date,status,amount) values ('$c_name','$c_number','$c_passport','$c_id','$c_institution','$c_email','$c_pname','$c_pphone','$room_cat',now(),'$status','$amount')";
				$insert_c = mysqli_query($con, $insert_client);
				if($insert_c){
					echo "<script>alert('You have successfully added a client')</script>";
					echo "<script>window.open('admin.php?add_client','_self')</script>";
					}
				}
			}
		}
?>
<h1>Add clients</h1><br />
<form action="admin.php?add_client" method="POST" id="customerField" enctype="multipart/form-data">
	<div class="form-group">
		<label>Client's Names</label>
		<input type="text" name="c_name" class="form-control" id="cname" placeholder="Client's full names" value="<?php if(isset($_POST['c_name'])) echo $_POST['c_name'];?>" required/>
		<?php $validator->outPutFieldError('c_name');?>
		<div id="nameresponse"></div>
	</div>
	<div class="form-group">
		<label>	Client's phone number</label>
		<input type="text" name="c_number" class="form-control" id="cphone" placeholder="Client's phone number" value="<?php if(isset($_POST['c_number'])) echo $_POST['c_number'];?>" onkeyup="(numbersOnly(this))" required pattern="^[0-9]+"/>
		<div id="phoneresponse"></div>
		<?php $validator->outPutFieldError('c_number');?>
	</div>
	<div class="form-group">
		<label>	Client's ID No</label>
		<input type="text" name="c_identity" class="form-control" id="cnumber" placeholder="Client's ID No" value="<?php if(isset($_POST['c_identity'])) echo $_POST['c_identity'];?>" required pattern="^[0-9]+"/>
		<?php  echo @ $idExists ?>
		<div id="idresponse"></div>
		<?php $validator->outPutFieldError('c_identity');?>
	</div>
	<div class="form-group">
		<label>	Client's Email address</label>
		<input type="text" name="c_email" class="form-control" id="email" value="<?php if(isset($_POST['c_email'])) echo $_POST['c_email'];?>" placeholder="Enter your email address" required/>
		<div id="emailresponse"></div>
		<?php $validator->outPutFieldError('c_email');?>
	</div>
	<div class="form-group">
		<label>	Client's Institution</label>
		<input type="text" name="c_institution" class="form-control" id="cinstitution" value="<?php if(isset($_POST['c_institution'])) echo $_POST['c_institution'];?>" class="form-control" placeholder="Client's institution of learning" required pattern="^[A-Za-z' ]+"/>
		<div id="institutionresponse"></div>
		<?php $validator->outPutFieldError('c_institution');?>
	</div>
	<div class="form-group">
		<label>	Parent's/Guardians names</label>
		<input type="text" name="c_pname" class="form-control" id="pname" placeholder="Parent's/Guardian's names" value="<?php if(isset($_POST['c_pname'])) echo $_POST['c_pname'];?>" required />
		<div id="pnameresponse"></div>
		<?php $validator->outPutFieldError('c_pname');?>
	</div>
	<div class="form-group">
		<label>Parent's/Guardians phone number</label>
		<input type="text" name="c_pphone" class="form-control" id="pphone" placeholder="Parent's/Guardians phone number" value="<?php if(isset($_POST['c_pphone'])) echo $_POST['c_pphone'];?>" onkeyup="(numbersOnly(this))" required />
		<div id="pphoneresponse"></div>
		<?php $validator->outPutFieldError('c_pphone');?>
	</div>
	<div class="form-group">
		<label>Client's passport photo</label>
		<input type="file" name="c_passport"/>
	</div>
	<div class="form-group">
		<label>Category of room</label>
		<select name="room_cat" id="croom" class="form-control" style="text-align:center;">
			<option value="default">Select a Room Category of your choice</option>
				<?php
					$get_cats = "select * from category";
					$run_cats = mysqli_query($con, $get_cats);
					while($row_cats=mysqli_fetch_array($run_cats)){
						$cat_id = $row_cats['cat_id'];
						$cat_title = $row_cats['cat_name'];
						echo "<option value='$cat_id'>$cat_title</option>";
					}
				?>
		</select>
		<div class="response" id="roomresponse"></div>
	</div>
	<div class="form-group">
		<label>Amount paid (Kshs.)</label>
		<input type="text" name="amount" class="form-control" placeholder="Enter amount" />
	</div>
	<div class="form-group">
		<input type="submit" name="update" class="form-control" id="AdminSubmit" value="Add client"/>
	</div>
</form>
	<?php } ?>
	
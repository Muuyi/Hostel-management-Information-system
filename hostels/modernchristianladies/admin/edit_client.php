<?php
	include_once("db.php");
	if(isset($_POST['cid'])){
		$output = '';
		$query = "SELECT * FROM clients WHERE Id='".$_POST['cid']."'";
		$runQuery = mysqli_query($con, $query);
		$row=mysqli_fetch_array($runQuery);
			$cId = $row['Id'];
			$c_fname = $row['First_Name'];
			$c_lname = $row['Last_Name'];
			$c_phone = $row['Phone_Number'];
			$c_room = $row['rm_cat'];
			$institution = $row['Client_Institution'];
			$email = $row['Clients_Email'];
			$pfname = $row['Parents_FName'];
			$plname = $row['Parents_LName'];
			$pphone = $row['Parents_Phone'];
			$date = $row['Payment_Date'];
			$c_identity = $row['Client_IDNo'];
			$c_date = $row['Payment_Date'];
			$c_passport = $row['Passport'];
		$output .= '
			<form action="admin.php?view_clients" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="full-names">First Name</label>
										<input type="text" name="c_fname" id="efname" class="form-control" value="'.$c_fname.'" required/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="full-names">Last Name</label>
										<input type="text" name="c_lname" id="elname" class="form-control" value="'.$c_lname.'" required/>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="phone-number">Phone number</label>
										<b>(+254)</b><input type="text" name="c_number" id="ecphone" class="form-control" value="'.$c_phone.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="id-no">ID Number</label>
										<input type="text" id="ecnumber" name="c_identity" class="form-control" value="'.$c_identity.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="full-names">Email address</label>
										<input type="email" name="c_email" id="eemail" class="form-control" value="'.$email.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="institution">Clients Institution of learning</label>
										<input type="text" id="ecinstitution" name="ec_institution" class="form-control" value="'.$institution.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="g-name">Guardian/Parents First name</label>
										<input type="text" id="epfname" name="c_pfname" class="form-control" value="'.$pfname.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="g-name">Guardian/Parents Last name</label>
										<input type="text" id="eplname" name="c_plname" class="form-control" value="'.$plname.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="g-number">Guardians/Phone number</label>
										<b>(+254)</b><input type="text" name="c_pphone" id="epphone" class="form-control" value="'.$pphone.'"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="app-info">Category of room</label>
										<select name="room_cat" id="croom" class="form-control" style="text-align:center;">'; ?>
										<?php
											$q = "SELECT * FROM rooms";
											$rQ = mysqli_query($con, $q);
											$output .=  '<option value="default">------------Select a Room Category----------</option>';
											while($row = mysqli_fetch_array($rQ)){
												$id = $row['rm_id'];
												$rm = $row['rm_name'];
												$output .=  '
													<option value="$id">'.$rm.'</option>
													';
											}
											
										?>
										<?php
											$output .= '</select>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" name="update" id="cl_submit" class="btn btn-primary client_update" id="$cId" value="Update clients information"/>
								</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
							<img src="data:image/jpeg;base64,'.base64_encode($c_passport).'" class="img-responsive" width="100%" style="border:2px solid #000000;" />
							<label>Change profile picture</label>
							<input type="file" name="cpass" id="cpass" />
						</div>
					</div>
			</form>
		';
		echo $output;
}
		
?>							
<?php
	if(isset($_POST['update'])){
			$cId = $_POST['cl_id'];
			$c_fname = $_POST['c_fname'];
			$c_lname = $_POST['c_lname'];
			$c_phone = $_POST['c_number'];
			$c_room = $_POST['room_cat'];
			$institution = $_POST['c_institution'];
			$email = $_POST['c_email'];
			$rm_cat = $_POST['room_cat'];
			$pfname = $_POST['c_pfname'];
			$plname = $_POST['c_plname'];
			$pphone = $_POST['c_pphone'];
			$c_identity = $_POST['c_identity'];
		$sql = "UPDATE clients SET Client_IDNo='$c_identity', First_Name='$c_fname',Last_Name='$c_lname',Phone_Number='$c_phone',Client_Institution='$institution',Clients_Email='$email',Type_Of_Room='$rm_cat',Parents_FName='$pfname',Parents_LName='$plname',Parents_Phone='$pphone' WHERE Id='$cId'";
		$rSql = mysqli_query($con, $sql);
		if($rSql){
			echo "<script>alert('You have successfully updated a clients details!')</script>";
			echo "<script>window.onload('admin.php?view_clients','_self')</script>";
		}else{
			echo "<script>alert('There was a problem while editing clients information. Please try again. If the problem persists contact 0724654808!')</script>";
		}
	}
?>

	
	
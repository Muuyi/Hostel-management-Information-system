<?php
	error_reporting(E_ALL);
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php,'_self')</script>";
	}else{
?>
<?php
//COLLECTING CUSTOMERS INFORMATION AND DISPLAYING IT TO THE CUSTOMERS PAGE
$hostel=$_SESSION['hostel'];
$getAdmin = "SELECT * FROM hostels where host_id='$hostel'";
$runAdmin = mysqli_query($con, $getAdmin);
$rowAdmin = mysqli_fetch_array($runAdmin);
?>
<div class="row">
	<div class="col-lg-12 col-md-12"> 
		<h1>Edit hostel account</h1>
		<div id="hostel_tabs">
			<ul>
				<li><a href="#edit_hostel">Edit hostel</a></li>
				<li><a href="#room_pricing">Room pricing</a></li>
				<li><a href="#services">Hostel Services</a></li>
				<li><a href="#requirements">Requirements</a></li>
			</ul>
			<div id="edit_hostel">
				<h4 style="color:#A52A2A; font-weight:bolder;">Change hostel profile picture</h4>
				<?php
							$user = $_SESSION['hostel'];
							$getImg="SELECT * FROM hostels WHERE host_id='$user'";
							$runImg = mysqli_query($con,$getImg);
							$rowImg = mysqli_fetch_array($runImg);
							if($rowImg['host_image'] == ''){
								echo '<img src="images/default.png" width="200px" height="200px" class="hostelProfileImg" style="border-radius:50%; padding:2px;">';
							}else{
								echo '<img src="../system_admin/images/'.$rowImg['host_image'].'" class="hostelProfileImg" width="200px" height="200px" style="border-radius:10px; padding:2px;">';
							}
						?>
				<input type="file" name="hostelPic" id="hostelProfilePic" data-image="<?php echo $rowImg['host_image'] ?>"/><span id="hostelPicResponse" style="color:#FF0000;"></span>
				<div id="hostelprofileResponse"></div>
				<form action="admin.php?edit_hostel" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="admnId" value="<?php echo $hostel ?>" />
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<label>Hostel Name</label>
								<input type="text" name="host_name" onblur="ValidateVariousCharacters('fname',5,100,'fnameresponse')" id="fname" class="form-control" value="<?php echo $rowAdmin['host_name'] ?>" />
								<?php $validator->outPutFieldError('c_fname');?>
								<div id="fnameresponse"></div>
							</div>
							<div class="col-lg-6 col-md-6">
								<label>Hostel Location</label>
								<input type="text" name="host_loc" id="lname" onblur="ValidateVariousCharacters('lname',5,100,'lnameresponse')" class="form-control" value="<?php echo $rowAdmin['location'] ?>" />
								<?php $validator->outPutFieldError('c_lname');?>
								<div id="lnameresponse"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<label>Contact 1</label>
								<input type="text" name="contact1" onblur="ValidateTel('contact1','contact1response')" id="contact1" class="form-control" value="<?php echo $rowAdmin['contact1'] ?>" />
								<?php $validator->outPutFieldError('c_fname');?>
								<div id="contact1response"></div>
							</div>
							<div class="col-lg-6 col-md-6">
								<label>Contact 2</label>
								<input type="text" name="contact2" id="contact2" onblur="ValidateTel('contact2','contact2response')" class="form-control" value="<?php echo $rowAdmin['contact2'] ?>" />
								<?php $validator->outPutFieldError('c_lname');?>
								<div id="contact2response"></div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label>Hostel description</label>
								<textarea class="form-control ckeditor" id="hostel_description" rows="5" name="hostel_description"><?php echo $rowAdmin['hostel_description'] ?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" id="AdminSubmit" class="btn btn-success form-control" name="update" value="Edit account"/>
					</div>
				</form>
			</div>
			<!--ROOM PRICING SECTION-->
			<div id="room_pricing">
				<div class="table-responsive">
					<table class="table table-stripped table-bordered" id="RoomsPriceTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Room category</th>
								<th>Amount</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody id="roomsPricingTable">
						<?php
							$q = "SELECT * FROM hostels_room_photos INNER JOIN room_category ON hostels_room_photos.cat_id=room_category.cat_id WHERE host_id='".$_SESSION['hostel']."' ORDER BY hostels_room_photos.cat_id ASC";
							$rQ = mysqli_query($con, $q);
							$i = 0;
							while($row = mysqli_fetch_array($rQ)){
								$i++;
								echo'
									<tr>
										<td>'.$i.'</td>
										<td>'.$row['cat_name'].'</td>
										<td>'.$row['room_amount'].'</td>
										<td><button class="btn btn-primary edit_room_price" id="'.$row['rm_photo_id'].'">Edit</button></td>
										<td><button class="btn btn-danger delete_room_price" id="'.$row['rm_photo_id'].'">Delete</button></td>
									</tr>
								';
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!--SERVICE SECTION-->
			<div id="services">
				<form class="form-inline">
					<button type="button" class="btn btn-success" data-target="#services_modal" data-toggle="modal">Add a new service</button>
					<select class="form-control" id="service_name">
						<option>Select a service</option>
						<?php
							$q = "SELECT * FROM services";
							$rQ = mysqli_query($con, $q);
							while($row = mysqli_fetch_array($rQ)){
								echo '<option value="'.$row['service_id'].'">'.$row['service_name'].'</option>';
							}
						?>
					</select>
					<button class="btn btn-primary" id="submit_service">Submit a service</button>
				</form>
				<div class="table-responsive">
					<table class="table table-stripped table-bordered" id="serviceTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Servive</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody id="serviceTableValues">
							<?php
								$q = "SELECT * FROM hostel_services INNER JOIN services ON hostel_services.service_id=services.service_id WHERE host_id='".$_SESSION['hostel']."'";
								$rQ = mysqli_query($con, $q);
								$i = 0;
								while($row = mysqli_fetch_array($rQ)){
									$i++;
									echo '
										<tr>
											<td>'.$i.'</td>
											<td>'.$row['service_name'].'</td>
											<td><button type="button" class="btn btn-danger delete_service" id="'.$row['hs_id'].'">Delete</button></td>
										</tr>
									';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
<!--///////////////////HOSTEL REQUIREMENTS SECTION////////////-->
			<div id="requirements">
				<form method="POST" action="post.php" class="form-inline">
					<input type="text" name="requirement" class="form-control" placeholder="Add a requirement" required/>
					<input type="hidden" name="host_id" class="form-control" placeholder="Add a requirement" value="<?php echo $_SESSION['hostel'] ?>"/>
					<input type="submit" name="add_requirement" class="btn btn-primary" value="Add requirement" />
				</form>
				<div class="table-responsive">
					<table class="table table-bordered table-stripped">
						<tr>
							<th>No</th>
							<th>Service</th>
							<th>Delete</th>
						</tr>
						<tr>
							<?php
								$q = "SELECT * FROM requirements WHERE host_id='".$_SESSION['hostel']."'";
								$rQ = mysqli_query($con, $q);
								$i = 0;
								while($row = mysqli_fetch_array($rQ)){
									$i++;
									echo '
										<tr>
											<td>'.$i.'</td>
											<td>'.$row['req_name'].'</td>
											<td><button type="button" class="btn btn-danger delete_requirement" id="'.$row['req_id'].'">Delete</button></td>
										</tr>
									';
								}
							?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
<!----///////////////////////////////-ADD SERVICE////////////////////-->
	<div class="modal fade" id="services_modal">
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Add service</h3>
						<button class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div id="serviceResponse"></div>
						<div class="form-group">
							<label>Add service</label>
							<input type="text" name="service" id="new_service" onblur="ValidateVariousCharacters('new_service',5,255,'new_service_response')" class="form-control" placeholder="New service" />
							<div id="new_service_response"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" id="save_service">Save</button>
						<button class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
			</div>
		</div>
	</div>
	<!--EDIT ROOM PRICE-->
	<div class="modal fade" id="update_room_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST">
					<div class="modal-header">
						<h3 class="modal-title">Edit room prices</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div id="update_room_price_response"></div>
						<div class="form-group">
							<label>Room category</label>
							<input type="text" id="room_category"  class="form-control" disabled/>
							<div id="roomcategoryresponse"></div>
						</div>
						<div class="form-group">
							<label>Room price</label>
							<input type="text" id="room_price" onblur="ValidateNumerals('room_price',0,100000,'roompriceresponse')" class="form-control" />
							<div id="roompriceresponse"></div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="" id="rm_id" />
						<button type="button" class="btn btn-primary" id="update_room_price">Update room price</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	if(isset($_POST['update'])){
			$hostId = $hostel;
			$name = mysqli_real_escape_string($con, $_POST['host_name']);
			$location = mysqli_real_escape_string($con, $_POST['host_loc']);
			$contact1 = mysqli_real_escape_string($con, $_POST['contact1']);
			$contact2 = mysqli_real_escape_string($con, $_POST['contact2']);
			$hostel_description = mysqli_real_escape_string($con, $_POST['hostel_description']);			
			$updateAdmin = "UPDATE hostels SET host_name='$name', contact1='$contact1',contact2='$contact2',location='$location',hostel_description='$hostel_description' WHERE host_id='".$hostId."'";
			$ad_update = mysqli_query($con, $updateAdmin);
			//$run_update = mysqli_query($con, $ad_update);
			if($ad_update){
				echo"<script>alert('You have successfully edited your account')</script>";
				echo "<script>window.open('admin.php?edit_hostel','_self')</script>";
			}
			
		}
?>
	<?php } ?>
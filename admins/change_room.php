<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12"><br />
		<input type="submit" class="btn btn-primary" data-target="#add_room" data-toggle="modal" value="Add room number" />
			<h1>Change the room's images</h1>
			<div id="rooms_tabs">
				<ul>
					<li><a href="#rooms_photos">Rooms photos</a></li>
					<li><a href="#available_rooms">Available rooms</a></li>
					<li><a href="#homepage_slideshow">Slide show</a></li>
				</ul>
				<div id="rooms_photos">
					<div class="row" style="text-align:center;">
					<?php
						$q = "SELECT * FROM hostels_room_photos INNER JOIN room_category ON hostels_room_photos.cat_id=room_category.cat_id WHERE host_id='".$_SESSION['hostel']."'";
						$rQ = mysqli_query($con, $q);
						while($row = mysqli_fetch_array($rQ)){
							echo '
								
									<div class="col-6">
										<h4 style="text-align:center;">'.$row['cat_name'].'</h4>
											<div class="room_image">
										';
												if($row['room_photo'] == ''){
													echo '<h6>Please upload an image for the room</h6>
														<input type="file" name="room_photo" class="room_photo" id="'.$row['rm_photo_id'].'"/>
													';

												}else{
													echo '<img src="images/'.$row['room_photo'].'"  width="100%" class="admin_room_images"/>
														<h6 style="font-weight:bolder;color:#000080;">Change room photo</h6>
														<input type="file" name="room_photo" class="room_photo" id="'.$row['rm_photo_id'].'"/>
													';
												}		
							echo'
											</div>
											<div class="room_image_response"></div>
									</div>
								
							';
						}
					?>
					</div>
				</div>
				<div id="available_rooms">
					<?php include_once('available_rooms.php') ?>
				</div>
				<div id="homepage_slideshow">
					<?php include_once('slideshow.php'); ?>
				</div>
			</div>
	</div>
</div>
<!--ADDING ROOMS MODAL WINDOW-->
	<?php include_once('add_room_numbers.php'); ?>
<?php
	if(isset($_POST['save_rm'])){
		$rmCat = $_POST['rm_cat'];
		$rmName = $_POST['rm_name'];
		$rmAmount = $_POST['rm_amount'];
		$q = "INSERT INTO rooms (cat_id,rm_name,rm_amount) VALUES ('$rmCat','$rmName','$rmAmount')";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo"<script>alert('You have successfully saved a room')</script>";
			echo"<script>window.open('admin.php?change_room','_self')</script>";
		}
	}
?>
<!--VIEWING ROOMS DETAILS-->
<div class="modal fade" id="view_rm">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" />&times;</button>
				<h3 class="modal-title">View available rooms</h3>
			</div>
			<div class="modal-body">
				<div class="table-responsiv">
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Room type</th>
							<th>Room no </th>
							<th>Amount</th>
							<th>Delete</th>
						</tr>
						<?php
							$q = "SELECT * FROM rooms INNER JOIN category ON rooms.rm_id=category.cat_id ";
							$rQ = mysqli_query($con, $q);
							$i = 0;
							while($row = mysqli_fetch_array($rQ)){
								$i++;
								$rm_id = $row['rm_id'];
								$cat_name = $row['cat_name'];
								$rm_name = $row['rm_name'];
								$amount = $row['rm_amount'];
								echo "
									<tr>
										<td>$i</td>
										<td>$cat_name</td>
										<td>$rm_name</td>
										<td>$amount</td>
										<td><input type='submit' value='Delete' class='btn btn-xs btn-danger rm_dlt' id='$rm_id'/></td>
									</tr>
								";
							}
						?>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
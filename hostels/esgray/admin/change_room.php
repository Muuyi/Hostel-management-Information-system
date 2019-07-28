<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12"><br />
		<input type="submit" class="btn btn-primary" data-target="#rm_no" data-toggle="modal" value="Add room number" />
		<input type="submit" class="btn btn-primary" value="View room's lists" data-toggle="modal" data-target="#view_rm" />
			<h1>Change the room's images</h1>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<center>
						<h4>Two sharing</h4>
						<?php
							$sql2 = "SELECT * FROM category WHERE cat_id='2'";
							$rQ2 = mysqli_query($con, $sql2);
							$row2 = mysqli_fetch_array($rQ2);
							$photo2 = $row2['room_photo'];
							if($photo2 == ''){
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image2'>
										<div id='img2'>Please upload an image</div>
										<center><input type='file' name='file2' id='file2' /></center>
									</div>
									<div id='snglResponse2'></div>
								";
							}else{
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image'>
										<div id='img2'><img src='images/$photo2' width='100%' class='img-thumbnail img-responsive'></div>
										<center><b>Change image</b><input type='file' name='file2' id='file2' /></center>
									</div>
									<div id='snglResponse2'></div>
								";
							}
						?>
					</center>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<center><h4>Four sharing</h4></center>
					<?php
							$sql = "SELECT * FROM category WHERE cat_id='4'";
							$rQ = mysqli_query($con, $sql);
							$row = mysqli_fetch_array($rQ);
							$photo4 = $row['room_photo'];
							if($photo4 == ''){
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image4'>
										<div id='img4'>Please upload an image</div>
										<center><input type='file' name='file4' id='file4' /></center>
									</div>
									<div id='snglResponse4'></div>
								";
							}else{
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image'>
										<div id='img4'><img src='images/$photo4' width='100%' class='img-thumbnail img-responsive'></div>
										<center><b>Change image</b><input type='file' name='file4' id='file4' /></center>
									</div>
									<div id='snglResponse4'></div>
								";
							}
						?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<center><h4>Six sharing</h4></center>
					<?php
							$sql = "SELECT * FROM category WHERE cat_id='6'";
							$rQ = mysqli_query($con, $sql);
							$row = mysqli_fetch_array($rQ);
							$photo6 = $row['room_photo'];
							if($photo6 == ''){
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image6'>
										<div id='img6'>Please upload an image</div>
										<center><input type='file' name='file6' id='file6' /></center>
									</div>
									<div id='snglResponse6'></div>
								";
							}else{
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image6'>
										<div id='img6'><img src='images/$photo6' width='100%' class='img-thumbnail img-responsive'></div>
										<center><b>Change image</b><input type='file' name='file6' id='file6' /></center>
									</div>
									<div id='snglResponse6'></div>
								";
							}
						?>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<center><h4>Eight sharing</h4></center>
					<?php
							$sql = "SELECT * FROM category WHERE cat_id='8'";
							$rQ = mysqli_query($con, $sql);
							$row = mysqli_fetch_array($rQ);
							$photo8 = $row['room_photo'];
							if($photo8 == ''){
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image8'>
										<div id='img8'>Please upload an image</div>
										<center><input type='file' name='file8' id='file8' /></center>
									</div>
									<div id='snglResponse8'></div>
								";
							}else{
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image8'>
										<div id='img8'><img src='images/$photo8' width='100%' class='img-thumbnail img-responsive'></div>
										<center><b>Change image</b><input type='file' name='file8' id='file8' /></center>
									</div>
									<div id='snglResponse8'></div>
								";
							}
						?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<center><h4>Ten sharing</h4></center>
					<?php
							$sql = "SELECT * FROM category WHERE cat_id='10'";
							$rQ = mysqli_query($con, $sql);
							$row = mysqli_fetch_array($rQ);
							$photo10 = $row['room_photo'];
							if($photo10 == ''){
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image10'>
										<div id='img10'>Please upload an image</div>
										<center><input type='file' name='file10' id='file10' /></center>
									</div>
									<div id='snglResponse10'></div>
								";
							}else{
								echo"
									<div style='border:2px dashed; padding:10px; text-align:center; ' id='image10'>
										<div id='img10'><img src='images/$photo10' width='100%' class='img-thumbnail img-responsive'></div>
										<center><b>Change image</b><input type='file' name='file10' id='file10' /></center>
									</div>
									<div id='snglResponse10'></div>
								";
							}
						?>
				</div>
			</div>
	</div>
</div>
<!--ADDING ROOMS MODAL WINDOW-->
<div class="modal fade" id="rm_no">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" />&times;</button>
				<h3 class="modal-title">Add a room number</h3>
			</div>
		<form method="POST" action="admin.php?change_room" >
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label>Select category of room</label>
							<select name="rm_cat" class="form-control">
								<?php
									$q = "SELECT * FROM category";
									$rQ = mysqli_query($con, $q);
									while($row=mysqli_fetch_array($rQ)){
										$id=$row['cat_id'];
										$name = $row['cat_name'];
										echo "<option value='$id'>$name</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label>Specific room name</label>
							<input type="text" name="rm_name" placeholder="Enter the room name" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label>Amount in Ksh:</label>
							<input type="text" name="rm_amount" placeholder="Enter the amount" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" name="save_rm" class="btn btn-primary" value="Save" />
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</form>
		</div>
	</div>
</div>
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
<?php 
	include ("header.php"); 
	//include ("admin/functions.php");
?>
<section class="container-fluid" style="text-align:center;">
	<!--DIV TAGS TO FAKE THE SIDEBAR TAG-->
			<div class="admin-sidebar">
				<div class="admin-sidebar-inner">
				</div>
			</div>
			<!--END -->
	<div class="row">
		<div class="col-lg-2 hidden sidebar">
			<div class="sidebar-inner">
				JJJJJJJJJJJJJJJJJJJJJJJJJJJ
			</div>
		</div>
			<div class="col-lg-8">
				<h5 style="color:#A52A2A; font-weight:bolder;">BOOK  ROOM OF YOUR CHOICE</h5>
					<div class="row">
						<?php
							$q = "SELECT * FROM hostels_room_photos INNER JOIN room_category ON hostels_room_photos.cat_id=room_category.cat_id WHERE host_id='".$_COOKIE['esgray_westlands']."' ORDER BY hostels_room_photos.cat_id ASC";
							$rQ = mysqli_query($con, $q);
							echo mysqli_error($con);
							while($row=mysqli_fetch_array($rQ)){
								echo'
									<div class="col-6" style="padding:5px;">
										<div class="card">
											<h4 id="room_header">'.$row['cat_name'].'</h4>
									';
											if($row['room_photo'] == ''){
												echo'<img src="images/esgray1.jpg" class="img-fluid" width="100%" />';
											}else{
												echo '<img src="../../admins/images/'.$row['room_photo'].'" width="100%" class="img-fluid"/>';
											}
									echo '	
											<i><b style="color:#008000;">Room available</b></i><br />
											<b style="color:#A52A2A;">Price:Kshs.'.$row['room_amount'].'</b>
										</div>
									</div>
								';
							} 
						?>
					</div>
			</div>
		<dic class="col-lg-2 hidden sidebar2">
			<div class="sidebar-inner2">
				JJJJJJJJJJJJJJJJJJJJJJJJJJJ
			</div>
		</dic>
</section>
<?php //include ("application.php"); ?>
<?php include ("footer.php"); ?>
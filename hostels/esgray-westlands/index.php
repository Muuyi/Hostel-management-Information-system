<?php
	if(isset($_GET['hsl'])){
		$hostel = $_GET['hsl'];
	}
	setcookie("esgray_westlands","$hostel");
?>
<?php include ("header.php"); ?>
		<section class="container-fluid">
			<!--DIV TAGS TO FAKE THE SIDEBAR TAG-->
			<div class="admin-sidebar">
				<div class="admin-sidebar-inner">
				</div>
			</div>
			<!--END -->
			<article class="row">
				<aside class="col-lg-2 col-md-2 hidden side-bar">
					<div class="sidebar-inner">
						hjjjjjjjjjjjjjjjjjjjjjjjjjj
					</div>
				</aside>
				<section class="col-lg-8 col-md-8" style="padding:0px;">
					<!--<img src="images/banner.jpg" class="img-responsive" width="100%" />
					<div id="slideshow" class="carousel slide" data-ride="carousel">
						<ul class="carousel-indicators">
							<?php
								/*$hostel = $_COOKIE['esgray_westlands'];
								$q = "SELECT * FROM hostels_slideshow WHERE host_id='".$hostel."'";
								$rQ = mysqli_query($con, $q);
								$count = mysqli_num_rows($rQ);
								for($i=-1;$i<$count;$i++){
									if($i == 0){
										echo '<li data-target="slideshow" data-slide-to="'.$i.'" class="active"></li>';
									}else{
										echo '
											<li data-target="slideshow" data-slide-to="'.$i.'"></li>
									';
									}
								}
							?>
						</ul>
						<div class="carousel-inner">
							<?php
								$i = 0;
								while($row = mysqli_fetch_array($rQ)){
									/*for($i=-1;$i<$count;$i++){*/
										/*$i++;
										if($i == 0){
											echo '
												<div class="carousel-item active">
													<img class="img-fluid" src="../../admins/hostel_slides/'.$row['slide_image'].'" style="width:100%" />
													<div class="carousel-caption">
														<h4>'.$row['slide_header'].'</h4>
														<p>'.$row['slide_content'].'</p>
													</div>
												</div>
											';
										}else{*/
										/*	echo '
												<div class="carousel-item">
													<img class="img-fluid" src="../../admins/hostel_slides/'.$row['slide_image'].'" style="width:100%" />
													<div class="carousel-caption">
														<h4>'.$row['slide_header'].'</h4>
														<p>'.$row['slide_content'].'</p>
													</div>
												</div>
											';
										//}
									//}
								}*/
							?>
						</div>
					</div>-->
					<div class='slideshow'>
						<?php
								if(isset($_GET['hsl'])){
									$hostel = $_GET['hsl'];
								}else{
									$hostel = $_COOKIE['esgray_westlands'];
								}
								$q = "SELECT * FROM hostels_slideshow WHERE host_id='".$hostel."'";
								$rQ = mysqli_query($con, $q);
								while($row = mysqli_fetch_array($rQ)){
									echo '
										<img class="img-fluid" src="../../admins/hostel_slides/'.$row['slide_image'].'" style="width:100%;" />
									';
								}
						?>
					</div>
						<div class="row">
							<div class="col-lg-4">
								<h4>LOCATION</h4>
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8485653892026!2d36.79654931476957!3d-1.2632836359578647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f176a2359e223%3A0xe528868330afc6b3!2sEsgray+Hostels+Executive!5e0!3m2!1sen!2ske!4v1519563222863" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen></iframe>
								<?php
									if(isset($_GET['hsl'])){
										$hostel = $_GET['hsl'];
									}else{
										$hostel = $_COOKIE['esgray_westlands'];
									}
									$q = "SELECT * FROM hostels WHERE host_id='".$hostel."'";
									$rQ = mysqli_query($con, $q);
									$row = mysqli_fetch_array($rQ);
									echo '<p style="text-align:justify;">'.$row['hostel_description'].'</p>';
								?>
							</div>
							<div class="col-sm-6 col-lg-4" style="text-align:center;">
								<h4>Room Pricing</h4>
								<?php
									if(isset($_GET['hsl'])){
										$hostel = $_GET['hsl'];
									}else{
										$hostel = $_COOKIE['esgray_westlands'];
									}
									$q = "SELECT * FROM hostels_room_photos INNER JOIN room_category ON hostels_room_photos.cat_id=room_category.cat_id WHERE host_id='".$hostel."' ORDER BY hostels_room_photos.cat_id ASC";
									$rQ = mysqli_query($con, $q);
									while($row = mysqli_fetch_array($rQ)){
										echo $row['cat_name'].' - <b>Kshs.'.$row['room_amount'].'</b><br />';
									}
								?>
								<h4>Requirements</h4>
								<?php
									if(isset($_GET['hsl'])){
										$hostel = $_GET['hsl'];
									}else{
										$hostel = $_COOKIE['esgray_westlands'];
									}
									$q  = "SELECT * FROM requirements WHERE host_id='".$hostel."'";
									$rQ = mysqli_query($con, $q);
									while($row=mysqli_fetch_array($rQ)){
										echo $row['req_name'].'<br />';
									}
								?>
							</div>
							<div class="col-sm-6 col-lg-4">
								<h4>Our Facilities & Services</h4>
								<?php
									if(isset($_GET['hsl'])){
										$hostel = $_GET['hsl'];
									}else{
										$hostel = $_COOKIE['esgray_westlands'];
									}
									$q = "SELECT * FROM hostel_services INNER JOIN services on hostel_services.service_id=services.service_id WHERE host_id='".$hostel."'";
									$rQ = mysqli_query($con, $q);
									echo "<ul>";
										while($row=mysqli_fetch_array($rQ)){
											echo "<li>".$row['service_name']."<span class='badge badge-danger'>FREE</span></li>";
										}
									echo "</ul>"
								?>
							</div>
						</div>
				</section>
				<aside class="col-lg-2 col-md-2 hidden side-bar2">
					<div class="sidebar-inner2">
						jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj
					</div>
				</aside>
			</article>
		</section>
	</body>
</html>
	<?php include ("footer.php"); ?>
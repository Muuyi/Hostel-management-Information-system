<?php
	//DISPLAYING THE HEADER SECTION
	include ("header.php"); 
	//CHECKING IF THERE IS ANY DATA IN THE DATABASE
			$getBl = "SELECT * FROM blog WHERE host_id='".$_COOKIE['esgray_westlands']."' ORDER BY b_id DESC";
			$runBl = mysqli_query($con, $getBl);
			$count = mysqli_num_rows($runBl);
			if($count==0){
				echo "<script>alert('Currently there is no any blog posted!!')</script>";
			echo "<script>window.open('index.php','_self')</script>";
			}else{ 
?>
		<section class="row">
			<article class="col-lg-1 hidden-md sidebar">
				<div class="sidebar-inner">
					JJJJJJJJJJJJJJJJJJJJJJJJJJJ
				</div>
			</article>
			<article class="col-lg-2 col-md-2 hidden sidebar3">
				<div class="sidebar3-inner">
					JJJJJJJJJJJJJJJJJJJJJJJJJJJ
				</div>
			</article>
			<article class='col-lg-7 col-md-8 aside' id='blogInfo'>
				<?php
					while($rowBl = mysqli_fetch_array($runBl)){
					$blId = $rowBl['b_id'];
					$blTitle = $rowBl['b_title'];
					$blImage = $rowBl['b_image'];
					$blMessage = $rowBl ['b_message'];
					echo "
						<div style='clear:both;'>
							<center><h2 style='font-weight:bolder; color:#A52A2A;'>$blTitle</h2> </center>"; ?>
							<?php
								$img = "SELECT * FROM blog WHERE b_id='$blId'";
								$rImg = mysqli_query($con, $img);
								$row = mysqli_fetch_array($rImg);
								if($row['b_image'] == ''){
									echo '';
								}else{
									echo "<img src='admin/images/$blImage' class='img-responsive' style='float:left; margin:20px;' />";
								}
								
							
					echo "		<span style='font-size:15px; font-weight:bold; color:#2C3E50;'>$blMessage</span>
						</div>
					";
					}
				?>
				<!--DIV TAGS TO FAKE THE SIDEBAR TAG-->
					<div class="admin-sidebar">
						<div class="admin-sidebar-inner">
						</div>
					</div>
					<!--END -->
			</article>
			<aside class="col-lg-2 col-md-2 hidden side-bar2">
				<div class="sidebar-inner2">
					jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj
				</div>
			</aside>
		</section>
<?php
		}
	include("footer.php");	
?>
<script>
	//CREATING A STICKY SIDEBAR
		simpleStickySidebar('.sidebar3-inner', {
	  		container: '.sidebar3',
	  		topSpace: 150,
	  		bottomSpace : 150
		});
</script>
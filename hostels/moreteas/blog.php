<?php
	//DISPLAYING THE HEADER SECTION
	include ("header.php"); 
	//CHECKING IF THERE IS ANY DATA IN THE DATABASE
			include "db.php";
			$getBl = "SELECT * FROM blog ORDER BY b_id DESC";
			$runBl = mysqli_query($con, $getBl);
			$count = mysqli_num_rows($runBl);
			if($count==0){
				echo "<script>alert('Currently there is no any blog posted!!')</script>";
			echo "<script>window.open('index.php','_self')</script>";
			}else{ 
?>
		<section class="row">
			<article class='col-lg-2 col-md-2 hidden-sm hidden-xs aside' style='background-color:#D3D3D3' >
					<center>Ads</center>
			</article>
			<article class='col-lg-8 col-md-8 aside' id='blogInfo'>
				<?php
					while($rowBl = mysqli_fetch_array($runBl)){
					$blId = $rowBl['b_id'];
					$blTitle = $rowBl['b_title'];
					$blImage = $rowBl['b_image'];
					$blMessage = $rowBl ['b_message'];
					echo "
						<div style='clear:both;'>
							<center><h2>$blTitle</h2> </center>"; ?>
							<?php
								$img = "SELECT * FROM blog WHERE b_id='$blId'";
								$rImg = mysqli_query($con, $img);
								$row = mysqli_fetch_array($rImg);
								if($row['b_image'] == ''){
									echo '';
								}else{
									echo "<img src='admin/images/$blImage' class='img-responsive' style='float:left; margin:20px;' />";
								}
								
							
					echo "		<span style='font-size:15px; font-weight:bolder;'>$blMessage</span>
						</div>
					";
					}
				?>
			</article>
			<article class='col-lg-2 col-md-2 hidden-sm hidden-xs aside' style='background-color:#D3D3D3'>
					<center>Ads</center>
				</article>
		</section>
<?php
		}
	include("footer.php");	
?>
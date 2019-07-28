<?php
	//DISPLAYING THE HEADER SECTION
	include ("header.php"); 
	//CHECKING IF THERE IS ANY DATA IN THE DATABASE
			include "db.php";
			$getBl = "SELECT * FROM blog";
			$runBl = mysqli_query($con, $getBl);
			//$rowBl = mysqli_fetch_array($runBl);
			//$blId = $rowBl['b_id'];
			//$blTitle = $rowBl['b_title'];
			//$blImage = $rowBl['b_image'];
			/*$blMessage = $rowBl ['b_message'];
			echo "
				<section id='blogInfo'>
					<center> $blTitle </center>
					<img class='blogImage' src='admin/images/$blImage' />
					$blMessage
				</section>
			";*/
		echo "<script>alert('Currently this page is not available. It will be active very soon!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
?>
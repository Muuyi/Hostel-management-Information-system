<?php
	//INCLUDING THE HEADER PAGE
	include ("header.php"); 
	//FINDING IF THERE IS ANY INFORMATION IN THE DATABASE
	include ("db.php");
	$getGallery = "SELECT * FROM gallery";
	$runGallery = mysqli_query($con, $getGallery);
	//$rowGallery = mysqli_fetch_array($runGallery);
	//$gId = $rowGallery['g_id'];
	//$gName = $rowGallery['g_name'];
	//$countId = mysql_num_rows($gId);
	//if($countId < 1){
		echo "<script>alert('Currently there are no images available!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	//}
?>
<?php
error_reporting(E_ALL);
	include_once("../db.php");
	if(isset($_GET['delid'])){
		$delete = $_GET['delid'];
		$query = "DELETE FROM gallery WHERE g_id='$delete'";
		$runQuery = mysqli_query($con, $query);
		if($runQuery){
			echo "<script>alert('You have successfully deleted the image')</script>";
			echo "<script>window.open('admin.php?post_photos','_self')</script>";
		}
	}
?>
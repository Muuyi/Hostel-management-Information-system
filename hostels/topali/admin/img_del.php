<?php
	include_once("db.php");
	if(isset($_POST['cid'])){
		$id = $_POST['cid'];
		$q = "DELETE FROM gallery WHERE g_id='$id'";
		$Rq = mysqli_query($con, $q);
		if($Rq){
			echo "You have successfully deleted the image";
		}
	}
?>
<?php
	include_once("db.php");
	if(isset($_POST['cid'])){
		$deleteId = $_POST['cid'];
		$deleteClient = "DELETE FROM clients where Id='$deleteId'";
		$runClient = mysqli_query($con, $deleteClient);
		if($runClient){
			echo "Client has been successfully deleted";
		}
	}
?>
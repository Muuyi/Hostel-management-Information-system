<?php
	include ("db.php");
	if(isset($_GET['delete_client'])){
		$deleteId = $_GET['delete_client'];
		$deleteClient = "DELETE FROM clients where c_id='$deleteId'";
		$runClient = mysqli_query($con, $deleteClient);
		if($runClient){
			echo "<script>alert('A client has been successfully deleted!')</script>";
			echo "<script>window.open('admin.php?view_clients','_self')</script>";
		}
	}
?>
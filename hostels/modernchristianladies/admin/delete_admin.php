<?php
include_once("db.php");
//DELETING SYSTEM USERS FROM THE DATABASE
	if(isset($_POST['adDel'])){
		$id = $_POST['adDel'];
		$deleteAdmin = "DELETE FROM admins where admin_id='$id'";
		$runAdmin = mysqli_query($con, $deleteAdmin);
		if($runAdmin){
			echo "Admins has been successfully deleted";
		}else{
			echo "Program failed!";
		}
	}
?>
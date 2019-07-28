<?php
	require_once("db.php");
	
	//DELETING INVOICES
	if(isset($_POST['inv_id'])){
		$inv_id = $_POST['inv_id'];
		$q3 = "DELETE FROM supplies WHERE spls_id='$inv_id'";
		$rQ3 = mysqli_query($con, $q3);
		if($rQ3){
			echo "You have successfully deleted a supply!";
		}else{
			echo (mysqli_error($con));
		}
	}
	//DELETING SUPPLIERS FROM THE DATABASE
	if(isset($_POST['sid'])){
		$sid = $_POST['sid'];
		$q2 = "DELETE FROM suppliers WHERE supplier_id='$sid'";
		$rQ2 = mysqli_query($con, $q2);
		if($rQ2){
			echo "You have successfully deleted a supplier!";
		}else{
			echo (mysqli_error($con));
		}
	}
	
	//DELETING ACCOUNTS TYPES
	if(isset($_POST['aid'])){
		$aid = $_POST['aid'];
		$q = "DELETE FROM accounts WHERE acc_id='$aid'";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "You have successfully deleted an account!";
		}
	}
	
	//DELETING ROOMS DETAILS
	if(isset($_POST['rmdl'])){
		$rid = $_POST['rmdl'];
		$q = "DELETE FROM rooms WHERE rm_id='$rid'";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "You have successfully deleted an account!";
		}
	}
	
	
?>
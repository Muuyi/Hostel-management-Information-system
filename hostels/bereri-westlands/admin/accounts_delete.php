<?php
	require_once("db.php");
	//DELETING VACANCES FROM THE VACANCE DATABASE
	if(isset($_POST['vac_id'])){
		$vac_id = $_POST['vac_id'];
		$q4 = "DELETE FROM vacance WHERE vaca_id='$vac_id'";
		$rQ4 = mysqli_query($con, $q4);
		if($rQ4){
			echo "You have successfully deleted a vacance!";
		}else{
			echo (mysqli_error($con));
		}
	}
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
	//DELETING EMPLOYEES FROM THE DATABASE
		if(isset($_POST['emp'])){
		$emp = $_POST['emp'];
		$q1 = "DELETE FROM employees WHERE emp_id='$emp'";
		$rQ1 = mysqli_query($con, $q1);
		if($rQ1){
			echo "You have successfully deleted an employee!";
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
	//DELETING ACCOUNTS DETAILS
	if(isset($_POST['acnm'])){
		$aid = $_POST['acnm'];
		$q = "DELETE FROM account_name WHERE acn_id='$aid'";
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
	//DELETING MESSAGES
	if(isset($_POST['mesId'])){
		$rid = $_POST['mesId'];
		$q = "DELETE FROM messages WHERE mes_id='$rid'";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "You have successfully deleted an account!";
		}
	}
	//DELETING A BLOG
	if(isset($_POST['bId'])){
		$rid = $_POST['bId'];
		$q = "DELETE FROM blog WHERE b_id='$rid'";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "You have successfully deleted a blog post!";
		}
	}
?>
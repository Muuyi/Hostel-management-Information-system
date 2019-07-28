<?php
	require_once("db.php");
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
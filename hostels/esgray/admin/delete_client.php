<?php
	include_once("db.php");
	//DELETING PAYMENTS FROM THE DATABASE
	if(isset($_POST['payment_id'])){
		$deleteId = $_POST['payment_id'];
		$deleteClient = "DELETE FROM payment where p_id='$deleteId'";
		$runClient = mysqli_query($con, $deleteClient);
		if($runClient){
			echo "The payment has been successfully deleted";
		}
	}
	//DELETING CLIENTS FROM THE DATABASE
	if(isset($_POST['cid'])){
		$deleteId = $_POST['cid'];
		$deleteClient = "DELETE FROM clients where Id='$deleteId'";
		$runClient = mysqli_query($con, $deleteClient);
		if($runClient){
			echo "Client has been successfully deleted";
		}
	}
	//DELETING EMPLOYEES SALARY DETAILS
	if(isset($_POST['sal_id'])){
		$deleteId1 = $_POST['sal_id'];
		$deleteSalary = "DELETE FROM salaries where sal_id='$deleteId1'";
		$runClient = mysqli_query($con, $deleteSalary);
		if($runClient){
			echo "Employees salary has been successfully deleted!";
		}
	}
	//DELETING TRANSACTIONS DETAILS
	if(isset($_POST['trans_id'])){
		$deleteId2 = $_POST['trans_id'];
		$deleteTrans = "DELETE FROM transactions where t_id='$deleteId2'";
		$runClient = mysqli_query($con, $deleteTrans);
		if($runClient){
			echo "The transactions has been successfully deleted!";
		}
	}
	
?>
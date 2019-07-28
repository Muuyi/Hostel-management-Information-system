<?php 
	require_once("db.php");
	if(isset($_POST['cid'])){
		$get_client = "SELECT * from clients WHERE Id='".$_POST['cid']."'";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
		$cId = $row_client['Id'];
		$status = $row_client['status'];
	      if($status =='Check in'){
	      	$q = "UPDATE clients SET status='Check out' WHERE Id='".$_POST['cid']."'";
	      	$rQ = mysqli_query($con, $q);
			echo "<input type='button' value='Check in' name='check' id='$cId' class='btn btn-danger btn-sm check'>";
			}else {
				$q = "UPDATE clients SET status='Check in',rm_id='',rm_cat='' WHERE Id='".$_POST['cid']."'";
	      		$rQ = mysqli_query($con, $q);
				echo "<input type='button' value='Check out' name='check' id='$cId' class='btn btn-primary btn-sm check'>";
				}
			
		}
?>
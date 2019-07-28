<?php
	require_once("db.php");
	if(isset($_POST['idNo'])){
		$getId = "SELECT * FROM clients WHERE Client_IDNo LIKE '".$_POST['idNo']."'";
		$runId = mysqli_query($con, $getId);
		$count = mysqli_num_rows($runId);
		if($count > 0){
			echo "<i style='color:#008000;'>Record available. Please continue with payment!</i>";
		}else{
			echo "<i style='color:#FF0000'>The client with the ID Number does not exist. Please check that you have entered the correct value!</i>";
		}
	}
?>
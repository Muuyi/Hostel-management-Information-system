<?php
	include ("db.php");
	if(isset($_POST['idnumber'])){
		$idnumber = $_POST['idnumber'];
		$query = "SELECT * FROM clients WHERE Client_IDNo = '$idnumber'";
		$runQuery = mysqli_query($con, $query);
		$count = mysqli_num_rows($runQuery);
		if($count > 0){
			echo "<p style='color:#FF0000;'>This ID number ".$idnumber." is already in the system. Please go to your hostel manager to be checked in</p>";
		}
	}
?>
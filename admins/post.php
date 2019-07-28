<?php
	require_once("db.php");
///////////////////////////////SAVING HOSTEL REQUIREMENTS TO THE DATABASE//////////////////////////
	if(isset($_POST['add_requirement'])){
		$host_id = mysqli_real_escape_string($con, $_POST['host_id']);
		$requirement = mysqli_real_escape_string($con, $_POST['requirement']);
		$q = "INSERT INTO requirements (req_name,host_id) VALUES('$requirement','$host_id')";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo '<script>alert("You have successfully added a requirement")</script>';
			echo "<script>window.open('admin.php?edit_hostel','_self')</script>";
		}
	}

?>
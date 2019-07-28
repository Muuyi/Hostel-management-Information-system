<?php
	include_once("db.php");
	if(isset($_POST['sys_id'])){
		$q = "SELECT * FROM admins WHERE admin_id='".$_POST['sys_id']."'";
		$rQ = mysqli_query($con, $rQ);
		while($rw = mysqli_fetch_array($rQ)){
			$data["admin_FName"] = $rw["admin_FName"];
			$data["admin_LName"] = $rw["admin_LName"];
			$data["admin_Email"] = $rw["admin_Email"];
			$data["admin_IDNo"] = $rw["admin_IDNo"];
			$data["phone"] = $rw["phone"];
			$data["admin_Username"] = $rw["admin_Username"];
			$data["admin_pass"] = $rw["admin_pass"];
			$data["admin_usertype"] = $rw["admin_usertype"];
			$data["status"] = $rw["status"];
		}
		echo json_encode($data);
	}
?>
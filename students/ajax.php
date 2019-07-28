<?php
	require_once("../db.php");
////////////////////////////////////////////////////////////STUDENTS SECTION//////////////////////////////
	//CHANGING THE CLIENTS PROFILE PICTURE
		if(isset($_POST['change_student_image'])){
			echo 'Hello';
			if($_FILES['property']['name'] != ''){
				$qry = "SELECT * FROM clients WHERE cl_id='".$_POST['client_id']."'";
				$rQry = mysqli_query($con, $qry);
				$rw = mysqli_fetch_array($rQry);
				if(mysqli_num_rows($rw) > 0){
					if($rQry){
						unlink("passports/".$rw['passport']);
					}
				}
					$q = "UPDATE clients SET passport='".$_FILES['property']['name']."' WHERE cl_id='".$_POST['client_id']."'";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						move_uploaded_file($_FILES['property']['tmp_name'], "../admins/passports/".$_FILES['property']['name']);
						echo "passports/".$_FILES['property']['name'];
					}else{
						echo mysqli_error($con);
					}
			}else{
				echo 'No file selected';
			}
		}
?>
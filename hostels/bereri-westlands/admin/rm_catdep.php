<?php
	include_once("db.php");
	//ENSURING THE ROOM CATEGORY IS LINKED TO ROOM NUMBER
	if(isset($_POST['rmcatid'])){
		$q = "SELECT * FROM rooms WHERE cat_id='".$_POST['rmcatid']."'";
		$rQ = mysqli_query($con, $q);
		$c = mysqli_num_rows($rQ);
			if($c > 0){
				echo "<option value='default'>--------Please select room number----------</option>";
				while($row=mysqli_fetch_array($rQ)){
					echo "<option value='".$row['rm_id']."'>".$row['rm_name']."</option>";
				}
			}else{
				echo "<option value='default' style='color:#FF0000;'>Room number for this category is unavailable!Please go to room photos section to add!</option>";
			}
		
	}
	//ENSURING THE SELECTED EMPLOYEE HAS GOTTEN THE APPROPRIATE SALARY
	if(isset($_POST['acc_id'])){
		$q1 = "SELECT acc_id, acn_name FROM account_name WHERE acn_name='".$_POST['acc_id']."'";
		$rQ1 = mysqli_query($con, $q1);
		$c1 = mysqli_num_rows($rQ1);
		if($c1 > 0){
			$rs1 = mysqli_fetch_assoc($rQ1);
			echo "<option value='".$rs1['acc_id']."'>".$rs1['acn_name']."</option>";
		}else{
			echo "<option value='default'>Please select an account title</option>";
		}
		
	}
?>
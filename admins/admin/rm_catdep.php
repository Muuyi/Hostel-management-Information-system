<?php
	include_once("db.php");
	
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
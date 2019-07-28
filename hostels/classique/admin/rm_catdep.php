<?php
	include_once("db.php");
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
?>
<?php
	include_once('db.php');
	if($_FILES["file"]["name"] != ''){
		$imgName = $_FILES["file"]["name"];
		$q = "UPDATE  category SET room_photo='$imgName' WHERE cat_id='2' ";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$imgName);
			echo "<img src='images/$imgName width='70%' class='img-thumbnail' />";
		}
	}
?>
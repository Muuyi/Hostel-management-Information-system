<?php
	include_once('db.php');
	if($_FILES["file"]["name"] != ''){
		$imgName = $_FILES["file"]["name"];
		$q = "UPDATE  category SET room_photo='$imgName' WHERE cat_id='1' ";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$imgName);
			echo "<img src='images/$imgName width='100%' class='img-thumbnail' />";
		}else{
			echo "<span style='color:#FF0000;'><i>There was a problem uploading the image!</i></span>";
		}
	}
?>
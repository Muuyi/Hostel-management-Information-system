<?php
	include_once('db.php');
	if($_FILES["file"]["name"] != ''){
		$imgName = $_FILES["admin_pic"]["name"];
		$ad_pic = mysqli_real_escape_string($con, file_get_contents($_FILES['admin_pic']['tmp_name']));
		$q = "UPDATE  admins SET admin_pic ='$ad_pic' WHERE cat_id='1' ";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$imgName);
			echo "<img src='images/$imgName width='100%' class='img-thumbnail' />";
		}else{
			echo "<span style='color:#FF0000;'><i>There was a problem uploading the image!</i></span>";
		}
	}
?>
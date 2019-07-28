<?php 
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
		include ("db.php");
 ?>
 <div class="row">
 	<div class="col">
		<h4>Add Hostel</h4>
		<form method="POST" action="index.php?add_hostel" enctype="multipart/form-data">
			<div class="form-group">
				<label for="hostName">Hostel name</label>
				<input type="text" name="host_name"  class="form-control" placeholder="Enter hostel name"/>
			</div>
			<div class="form-group">
				<label for="location">Hostel location</label>
				<input type="text" placeholder="Enter hostel location" class="form-control" />
			</div>
			<div class="form-group">
				<label for="host-cat">Hostel category</label>
				<select  class="form-control" name="host_cat" />
					<option>--------------Select a category--------------</option>
					<?php
						global $con;
						$get_cats = "select * from categories";
						$run_cats = mysqli_query($con, $get_cats);
						while($row_cats=mysqli_fetch_array($run_cats)){
							$cat_id = $row_cats['cat_id'];
							$cat_title = $row_cats['cat_name'];
							echo "<option value='$cat_id'>$cat_title</option>";
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="host_link">Hostel Link</label>
				<input type="text" name="host_link"  class="form-control" placeholder="Enter hostel link" />
			</div>
			<div class="form-group">
				<label for="host_image">Hostel Image</label>
				<input type="file" name="host_image" class="form-control" />
			</div>
			<div class="form-group">
				<label for="host_k">Keywords</label>
				<input type="text" placeholder="Enter hostel search keywords" class="form-control" name="host_k" />
			</div>
			<input type="submit" name="insert_host" value="Add hostel" class="btn btn-success form-control"/>
		</form>
	</div>
</div>
<?php
	if(isset($_POST['insert_host'])){
		$host_name = $_POST['host_name'];
		$host_loc = $_POST['host_loc'];
		$host_cat = $_POST['host_cat'];
		$host_city = $_POST['host_cit'];
		$host_link = $_POST['host_link'];
		$host_map = $_POST['host_map'];
		$host_k = $_POST['host_k'];
		//POSTING IMAGES
		$host_image = $_FILES['host_image']['name'];
		$fileTmpLoc = $_FILES['host_image']['tmp_name'];
		$fileType = $_FILES['host_image']['type'];
		$fileSize = $_FILES['host_image']['size'];
		$fileErrorMsg = $_FILES['host_image']['error'];
		$fileExp = explode(".",$host_image);
		$fileExt = $fileExp[1];
		if(!$fileTmpLoc){
		echo "<script>alert('Please browse for a file before clicking the upload button!')</script>";
			exit();
		}else if(!preg_match("/\.(gif|jpg|png)$/i",$host_image)){
			echo "<script>alert('Your image format is unsuported, please choose a jpeg/jpg/png/gif image')</script>";
			unlink($fileTmpLoc);
			exit();
		}else if($fileErrorMsg==1){
			echo "<script>alert('An error occured while processing the file. Try again!')</script>";
			exit();
		}
		move_uploaded_file($fileTmpLoc,"images/$host_image");
		//INCLUDING IMAGE RESIZING FUNCTION
		include ("functions.php");
		$targetFile = "images/$host_image";
		$resizedFile = "images/resized_$host_image";
		$wmax = 900;
		$hmax = 700;
		hostImageResize($targetFile,$resizedFile,$wmax,$hmax,$fileExt);
		
		
		$insert_hostel = "insert into hostels (host_cat,host_loc,host_name,hostel_link,hostel_map,host_image,host_keywords) values ('$host_cat','$host_loc','$host_name','$host_link','$host_map','$host_image','$host_k')";
		$insert_host = mysqli_query($con, $insert_hostel);
		if($insert_host){
			echo "<script>alert('The hostel has been successfully uploaded!')</script>";
			echo "<script>window.open('index.php?add_hostel','_self')</script>";
		}
	}
?>
	<?php } ?>
<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
<br />
<div class="row">
	<div class="col">
		<div class="row">
			<div class="col drag_area" id="upload_images">
				<h4>Drag and Drop the files/Click this button to Upload images</h4>
				<input type="file" name="images[]" id="upload_gallery_images" multiple/>
			</div>
		</div>
		<div class="row">
			<div class="col" id="image_error_response"></div>
		</div>
		<div class="row">
			<div class="col" id="uploaded_images_response"></div>
		</div>
	</div>
	<?php
		$q = "SELECT * FROM gallery WHERE host_id='".$_SESSION['hostel']."' ORDER BY g_id DESC";
		$rQ = mysqli_query($con, $q);
		echo '<div class="row">';
		while($row=mysqli_fetch_array($rQ)){
	?>
		
			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style="border:2px solid #808080; border-radius:5px;">
				<img src="images/<?php echo $row['g_name']?>" width="100%" />
				<button type="button" class="btn btn-danger form-control delete_hostel_images" id="<?php echo $row['g_id']?>">Delete image</button> 
			</div>
		
	<?php
		}
		echo '</div>';
	?>
	</div>
	<?php
		if(isset($_POST['submit'])){
			$query = "SELECT * FROM gallery";
			$runQuery = mysqli_query($con, $query);
			$count = mysqli_num_rows($runQuery);
			if($count < 20){
				$title = $_POST['imgtitle'];
				$caption = $_POST['imagedesc'];
				$image = $_FILES['image']['name'];
				$tmpimage = $_FILES['image']['tmp_name'];
				$imgSize = $_FILES['image']['size'];
				$ext = explode('.', $image);
				$fileAExt = strtolower(end($ext));
				$allowed = array('jpg','jpeg','png');
				if($image==""){
					echo "<script>alert('Please select an image to upload!')</script>";
				}else if($imgSize > 1000000){
					echo "<script>alert('Please select an image with a maximum of 1MB or you can resize your image to 1MB!')</script>";
					//unlink($tmpimage);
				}/*else if(in_array($fileAExt, $allowed)){
					echo "<script>alert('Please select an image with jpg/jpeg/png extensions are allowed!')</script>";
					//unlink($tmpimage);
				}*/else{
					$query = "INSERT INTO gallery (g_title, g_name, caption,g_date) values ('$title','$image ','$caption',now())";
					$runQuery = mysqli_query($con, $query);
					$move = move_uploaded_file($tmpimage,"gallery/$image");
					if($move){
						echo "<script>alert('Image has been successfully uploaded!')</script>";
						echo"<script>window.open('admin.php?post_photos','_self')</script>";
					}else{
						echo "<script>alert('There was an error uploading the image.Please try again!')</script>";
					}
				}
				//unlink($tmpimage);
			}else{
				echo "<script>alert('PLease a maximum of 20 images are allowed. Delete other images to upload!')</script>";
				echo "<script>window.open('admin.php?post_photos','_self')</script>";
			}
		}
	?>	

	<?php
	/*	$sql = "SELECT * FROM gallery ORDER BY g_id DESC";
		$runSql = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($runSql)){
			$id = $row['g_id'];
			$title = $row['g_title'];
			$name = $row['g_name'];
			echo"
				<div class='col-lg-2 col-md-2 col-sm-4 col-xs-6'>
					<div class='thumbnail'>
						<img class='image' src='gallery/$name' width='100%'/><br />
						<center><input type='button' value='Delete' name='delete' id='$id' class='btn btn-danger btn-xs deleteimg' /></center>
					</div>
				</div>
			";

		}*/
	?>
</div>
<?php } ?>
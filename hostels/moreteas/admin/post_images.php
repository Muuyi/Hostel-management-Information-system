<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<br />
<div class="row">
	<center><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#imageModal">Upload an Image</button></center>
	<center><h2>My images</h2></center>
	<form action="admin.php?post_photos" method="post" enctype="multipart/form-data">
	<div class="modal fade" id="imageModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h1>Post Images</h1><br />
				</div>
				<div class="modal-body">
						<div class="form-group">
							<label>Image Title</label>
							<input type="text" name="imgtitle" placeholder="Image title" class="form-control">
						</div>
						<div class="form-group">
							<label>Post Images</label>
							<input type="file" name="image" id="image" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Image caption</label>
							<input type="text" name="imagedesc" placeholder="Image caption" class="form-control">
						</div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="submit" class="btn btn-primary" value="Upload" />
					<button class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	</form>
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
		$sql = "SELECT * FROM gallery ORDER BY g_id DESC";
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

		}
	?>
</div>
<?php } ?>
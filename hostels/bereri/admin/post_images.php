<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<!--<h1>Post Images</h1><br />
<form action="post_images.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Post Images</label>
		<input type="file" name="image" id="image" class="form-control"/>
	</div>
	<div class="form-group">
		<label>Image description</label>
		<input type="text" name="imagedesc" placeholder="Image description" class="form-control">
	</div>
	<div class="form-group">
		<progress class="form-control" id="progressBar" value="0" max="100"></progress>
	</div>
	<div id="status"></div>
	</b><button class="btn btn-primary" name="upload" onclick="uploadFile()">Upload File</button><br /><br />
</form>-->
<?php
//Uploading the image to the database
//$fileName = $
echo "<p style='color:#FF0000; font-size:30px; text-align:center; margin-top:30px;'><i>This page is currently unavailable. It will be activated after complete payment of the site!</i></p>";
?>
	<?php } ?>
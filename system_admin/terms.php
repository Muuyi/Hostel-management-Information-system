<h2>Post terms & Conditions</h2>
<form method="POST" action="index.php?terms">
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" placeholder="Title" name="t_title" />
 	</div>
 	<div class="form-group">
		<label>Terms and conditions</label>
		<textarea rows="10" cols="30" name="terms"></textarea>
 	</div>
 	<div class="form-group">
 		<input type="submit" name="submit" value="Post terms" class="btn btn-primary form-control"/>
 	</div>
</form>
<?php
	include_once("db.php");
	if(isset($_POST['submit'])){
		$title = $_POST['t_title'];
		$terms = $_POST['terms'];
		$q = "INSERT INTO terms (t_title,t_details) VALUES('$title','$terms')";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "<script>alert('You have successfully uploaded terms & conditions')</script>";
			echo "<script>window.onload('index.php?terms','_self')</script>";
		}
	}
?>
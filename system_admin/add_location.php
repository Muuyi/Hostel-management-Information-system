<?php
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
<h1>Add Location</h1>
<form method="POST" action="index.php?add_location" enctype="multipart/form-data">
	Location Name: <input type="text" name="location" size="50" class="AdminInput" required/><br /><br />
	<input type="submit" name="addloc" class="EsgSubmit" value="Add Location" />
</form>
<?php
	include ("db.php");
	if(isset($_POST['addloc'])){
		$location = $_POST['location'];
		$insert_loc = "insert into location (loc_name) values ('$location')";
		$ins_l = mysqli_query($con, $insert_loc);
		if($ins_l){
			echo "<script>alert('You have successfully uploaded a location!')</script>";
			echo "<script>windo.open('index.php?add_location','_self')</script>";
		}
	}
?>
	<?php } ?>
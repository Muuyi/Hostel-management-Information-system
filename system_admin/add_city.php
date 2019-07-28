<?php 
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
		include ("db.php");
 ?>
<h1>Add City</h1>
<form action="index.php?add_city" method="POST" enctype="multipart/form-data">
	City Name: <input type="text" size="50" name="cit_name" class="AdminInput" required/><br /><br />
	<input type="submit" name="add_city" class="EsgSubmit" value="Add City" />
</form>
<?php
	if(isset($_POST['add_city'])){
		$cit_name = $_POST['cit_name'];
		$insert_city = "insert into cities (cit_name) values ('$cit_name')";
		$insert_cit = mysqli_query($con, $insert_city);
		if($insert_cit){
			echo"<script>alert('You have successfully added a city!')</script>";
			echo "<script>window.open('index.php?add_city','_self')</script>";
		}
	}
?>
	<?php } ?>
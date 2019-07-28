<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<h1>Post a vacancy</h1><br />
<form action="admin.php?post_vacancies" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Vacancy title</label>
		<input type="text" name="vaca_title" class="form-control" placeholder="Vacancy title" />
	</div>
	<div class="form-group">
		<label>Vacancy details</label>
		<textarea cols="30" rows="20" class="form-control" name="vaca_deta"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" id="AdminSubmit" class="form-control" name="post_vac" value="Post vacancy"/>
	</div>
</form>
	<?php } ?>
	<?php
		if(isset($_POST['post_vac'])){
			$vaca_title = $_POST['vaca_title'];
			$vaca_deta = $_POST['vaca_deta'];
			$insert_vacancies = "insert into vacance (vaca_title,vaca_details,vaca_date) values ('$vaca_title','$vaca_deta',now())";
			$insert_vac = mysqli_query($con, $insert_vacancies);
			if($insert_vac){
				echo "<script>alert('You have successfully posted a vacancy')</script>";
				echo "<script>window.open('admin.php?post_vacancies','_self')</script>";
				
			}
		}
	?>
	
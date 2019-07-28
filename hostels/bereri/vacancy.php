<?php 
	include ("header.php"); 
	include ("admin/functions.php");
?>
<section class="container" style="width:100%;">
	<div class="row">
		<article class="col-lg-7 col-md-7">
			<h1 style="text-align:center; font-weight:bolder; color:#A52A2A;">OUR VACANCIES</h1>
			<?php getVacance(); ?>
		</article>
		<article class="col-lg-5 col-md-5" style="text-align:left;">
			<span style="color:#A52A2A;"><i>Fill in the following form to apply for a job at Modern Christian</i></span>
				<form method="POST" action="vacancy.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="fullNames">Full names</label>
						<input type="text" class="form-control" name="v_name" placeholder="Enter Full names" size="50" />
					</div>
					<div class="form-group">
						<label for="phone">Phone number</label>
						<input type="text" class="form-control" name="v_phone" placeholder="Enter your phone number" size="50" />
					</div>
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" class="form-control" name="v_email" placeholder="Enter your email address" size="50" />
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" name="v_city" class="form-control" placeholder="Enter your location" size="50" />
					</div>
					<div class="form-group">
						<label for="documents">Upload your documents(ID card, certificates, CV)</label>
						<input type="file" name="v_doc" />
					</div>
					<div class="form-group">
						<label for="job">Job & Some Description</label><br />
						<textarea cols="20" class="form-control" rows="20" name="v_desc"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="apply" class="ModSubmit" value="Apply now" />
					</div>
			</form>
		</article>
	</div>
</section>
<?php include ("footer.php"); ?>
<?php
	if(isset($_POST['apply'])){
		$v_name = mysqli_real_escape_string($con, $_POST['v_name']);
		$v_phone = mysqli_real_escape_string($con, $_POST['v_phone']);
		$v_email = mysqli_real_escape_string($con, $_POST['v_email']);
		$v_city = mysqli_real_escape_string($con, $_POST['v_city']);
		$v_desc = mysqli_real_escape_string($con, $_POST['v_desc']);
		$v_doc = mysqli_real_escape_string($con, $_FILES['v_doc']['name']);
		$doc_tmp = $_FILES['v_doc']['tmp_name'];
		//move_uploaded_file($doc_tmp,"vac_images/$v_name");
		$insert_vac = "insert into vacancies (vac_title,vac_phone,vac_email,vac_city,vac_doc,vac_details,vac_date) values ('$v_name','$v_phone','$v_email','$v_city','$v_doc','$v_desc',now())";
		$insert_v = mysqli_query($con, $insert_vac);
		if($insert_v){
			echo "<script>alert('You have successfully applied for the Job!')</script>";
			echo "<script>window.open('vacancy.php','_self')</script>";
		}
	}
?>
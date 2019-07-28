<?php 
include ("header.php"); 
include ("db.php");
?>
<style>
	.warning_msg{
		color:#FF0000;
	}
	.warning_bd{
		border:1px solid #FF0000;
	}
</style>
<section class="container" style="width:100%;">
	<div class="row">
		<article class="col-lg-7 col-md-7">
			<h1 style="text-align:center; color:#A52A2A;">Send a message</h1>
			<form action="contact_us.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="fullNames">Full names</label>
						<input type="text" name="mes_name" id="names" class="form-control" placeholder="Enter Full names"  required/>
						<div id="namesresponse" class="warning"></div>
				</div>
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<input type="text" name="mes_no" id="cphone"  class="form-control" placeholder="Enter your phone number" onkeyup="(numbersOnly(this))" required/>
					<div id="phoneresponse"></div>
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea cols="20" class="form-control" rows="20" id="mes" name="message" ></textarea>
					<div id="mesresponse"></div>
				</div>
				<div class="form-group">
					<input type="submit" name="send" class="ModSubmit" value="Send Message" />
				</div>
			</form>
		</article>
		<article class="col-lg-5 col-md-5" style="text-align:center; font-size:20px; color:#D2691E;">
			<h2>CONTACT US </h2>
			<center>
			<table class="table-responsive">
								<tr>
									<td><i class="fa fa-envelope"></i></td>
									<td>P.O Box 2996-00200</td>
								</tr>
								<tr>
									<td></td>
									<td>Nairobi - Kenya</td>
								</tr>
								<tr>
									<td><i class="fa fa-phone"></i></td>
									<td>Cell:0740531221</td>
								</tr>
								<tr>
									<td></td>
									<td>0732259504</td>
								</tr>
								<tr>
									<td><i class="fa fa-envelope"></i></td>
									<td>Email: moreteashostel@gmail.com</td>
								</tr>
			</table>
			</center>
			<h2>OUR LOCATION</h2>
		</article>
	</div>
</section>
<?php include ("footer.php"); ?>
<?php
	if(isset($_POST['send'])){
		$mes_name = mysqli_real_escape_string($con, $_POST['mes_name']);
		$mes_no = mysqli_real_escape_string($con, $_POST['mes_no']);
		$message = mysqli_real_escape_string($con, $_POST['message']);
		$insert_message = "insert into messages (mes_name,mes_phone,message,mes_date)values ('$mes_name','$mes_no','$message',now())";
		$insert_mes = mysqli_query($con, $insert_message);
		if(insert_mes){
			echo "<script>alert('Your message has been successfully send')</script>";
			echo "<script>window.open('contact_us.php','_self')</script>";
		}
	}
?>
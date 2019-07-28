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
		<article class="col-lg-5 col-md-5" style="text-align:center; color:#D2691E;">
			<h4 style="font-weight:bolder;">CONTACT US </h4>
			BERERI HOSTELS - WESTLANDS <br />
			P.O BOX 33906-00600, NAIROBI <br />
			<span><u>0723157161</u></span> / 0723258310 <br />
			<h4 style="font-weight:bolder;">OUR LOCATION</h4>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.842072971334!2d36.80623901476944!3d-1.267505535963518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f173ea471b903%3A0x52fd3478d56bcb4!2sBereri+Hostel!5e0!3m2!1sen!2ske!4v1519472553783" width="100%" height="450" frameborder="0" style="border:1" allowfullscreen></iframe>
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
		if($insert_mes){
			echo "<script>alert('Your message has been successfully send')</script>";
			echo "<script>window.open('contact_us.php','_self')</script>";
		}
	}
?>
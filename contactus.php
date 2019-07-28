
		<?php 
			include ("header.php"); 
			include_once("formvalidator.php");
			include ("db.php");
			$validator = new validator();
		?>
		<style>
			.warning_msg{
				color:#FF0000;
			}
			.warning_bd{
				border:1px solid #FF0000;
			}
</style>
	<div class="container-fluid">
		<section class="row">
			<article class="col-sm-8">
				<h2>Send us a message</h2>
				<form action="contactus.php" method="POST" id="contact_us_form" enctype="multipart/form-data">
					<div class="form-group">
						<label>Full names:</label>
						<input type="text" name="c_fname" id="fullname" class="form-control" placeholder="Enter your first and last name " onblur="ValidateFullNames('fullname','fname_response')" required/>
						<?php $validator->outPutFieldError('c_fname');?>
						<div id="fname_response"></div>
					</div>
					<div class="form-group">
						<label for="cphone">Phone number</label><br />
						<input type="tel" name="c_number" id="cphone" class="form-control tel" onblur="ValidateTel('cphone','phoneresponse')" required />
						<div id="phoneresponse"></div>
						<?php $validator->outPutFieldError('c_number');?>
					</div>
					<div class="form-group">
						<label>Subject:</label>
						<input type="text" id="subject" name="subject" class="form-control" placeholder="Enter your subject" required onblur="ValidateVariousCharacters('subject',0,50,'subjectresponse')" onkeyup="ValidateVariousCharacters('subject',0,50,'subjectresponse')" />
						<p id="subjectresponse"></p>
					</div>
					<div class="form-group">
						<label>Your Message:</label>
						<textarea name="message" class="form-control ckeditor" id="message" cols="10" rows="15" required></textarea>
						<div id="messageresponse"></div>
					</div>
					<div class="form-group">
						<input type="submit" name="send" id="sendContactMessage" value="Send Message" class="btn btn-primary form-control" />
						<div id="contact_us_form_response"></div>
					</div>
				</form>
			</article>
			<aside class="col-sm-4">
				<h1>CONTACT US</h1>
				MUABATECH TECHNOLOGIES<br />
				website:www.muabatech.co.ke<br />
				Call:0724654808 / 0775499640<br />
				Email:muuyiandrew2015@gmail.com / andrewmuuyi@yahoo.com<br />
				<h1>FOLLOW US ON SOCIAL MEDIA</h1>
				<image src="images/facebook.png" width="50px" height="50px" />
				<image src="images/twitter.png" width="50px" height="50px" />
				<image src="images/GP.png" width="50px" height="50px" />
				<image src="images/instagram.jpg" width="50px" height="50px" />
			</aside>
		</section>
	</div>
		<?php
			include ("footer.php");
		?>
	</body>
</html>
<?php
	if(isset($_POST['send'])){
		$names = $_POST['names'];
		$phone = $_POST['phone'];
		$city = $_POST['city'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$insert_mes = "insert into messages (mes_name,mes_phone,mes_city,mes_sub,message,date) values ('$names','$phone','$city','$subject','$message',now())";
		$ins_mes = mysqli_query($con, $insert_mes);
		if($ins_mes){
			echo "<script>alert('Your message has been successfully sent!')</script>";
			echo "<script>window.open('contactus.php','_self')</script>";
		}
	}
?>

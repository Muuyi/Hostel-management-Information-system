<?php 
include ("header.php"); 
?>
<style>
	.warning_msg{
		color:#FF0000;
	}
	.warning_bd{
		border:1px solid #FF0000;
	}
</style>
<section class="container-fluid" style="width:100%;">
	<!--DIV TAGS TO FAKE THE SIDEBAR TAG-->
			<div class="admin-sidebar">
				<div class="admin-sidebar-inner">
				</div>
			</div>
			<div class="sidebar">
				<div class="sidebar-inner">		
				</div>
			</div>
			<article class="sidebar2">
				<div class="sidebar-inner2">
				</div>
			</article>
	<!--END -->
	<div class="row">
		<article class="col-sm-7">
			<h1 style="text-align:center; color:#A52A2A;">Send a message</h1>
			<form method="POST" id="hostel_message" enctype="multipart/form-data">
				<div class="form-group">
					<label for="fullNames">Full names</label>
						<input type="text" name="mes_name" id="names" class="form-control" placeholder="Enter Full names"  onblur="ValidateFullNames('names','namesresponse')" required/>
						<div id="namesresponse" class="warning"></div>
				</div>
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<input type="tel" name="mes_no" id="cphone" onblur="ValidateTel('cphone','phoneresponse')" class="form-control" required/>
					<div id="phoneresponse"></div>
				</div>
				<div class="form-group">
					<label for="fullNames">Subject</label>
						<input type="text" name="subject" id="mes_subject" class="form-control" placeholder="Enter the subject"  onblur="ValidateVariousCharacters('mes_subject',5,50,'subjectresponse')" required/>
						<div id="subjectresponse"></div>
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea cols="20" class="ckeditor" id="mes" name="message" ></textarea>
					<div id="mesresponse"></div>
				</div>
				<div id="contact_us_form"></div>
				<div class="form-group">
					<input type="submit" name="send" id="send_hostel_message" class="btn btn-success form-control" value="Send Message" />
				</div>
				<input type="hidden" id="host_mes_id" value="<?php echo $_COOKIE['esgray_westlands']?>" />
			</form>
		</article>
		<article class="col-sm-5" style="text-align:center;">
			<h4 style="font-weight:bolder;">CONTACT US </h4>
			ESGRAY HOSTELS - WESTLANDS <br />
			P.O BOX 33906-00600, NAIROBI <br />
			Call Cell : <span><u>0723157161</u></span> / 0723258310 <br />
			Mpesa Line : 0718-881485 <br />
			A/C NAME : Esgray Hostels <br />
			Equity Bank A/C NO: 0020291566380 <br />
			Cooperative Bank A/C No. <br />
			01136069813600 - Stima Plaza Branch <br />
			<h4 style="font-weight:bolder;">OUR LOCATION</h4>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8485653892026!2d36.79654931476957!3d-1.2632836359578647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f176a2359e223%3A0xe528868330afc6b3!2sEsgray+Hostels+Executive!5e0!3m2!1sen!2ske!4v1519563222863" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</article>
	</div>
</section>
<?php include ("footer.php"); ?>
<?php
	/*if(isset($_POST['send'])){
		$mes_name = mysqli_real_escape_string($con, $_POST['mes_name']);
		$mes_no = mysqli_real_escape_string($con, $_POST['mes_no']);
		$message = mysqli_real_escape_string($con, $_POST['message']);
		$hostel = $_COOKIE['esgray_westlands'];
		$insert_message = "INSERT INTO messages (mes_name,mes_phone,message,host_id,mes_date)values ('$mes_name','$mes_no','$message','$hostel',now())";
		$insert_mes = mysqli_query($con, $insert_message);
		if($insert_mes){
			echo "<script>alert('Your message has been successfully send')</script>";
			echo "<script>window.open('contact_us.php','_self')</script>";
		}
	}*/
?>
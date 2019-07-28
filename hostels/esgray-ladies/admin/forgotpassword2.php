<?php
	include ("db.php");
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$query = "SELECT * FROM admins WHERE admin_Email = '$email'";
		$runQuery = mysqli_query($con, $query);
		$count = mysqli_num_rows($runQuery);
		if($count > 0){
			echo '
				<div class="form-group">
					<input type="submit" name="sendmail" class="btn btn-success form-control"  value="Send request"/>
				</div>
			';
		}else{
			echo'<p style="color:#FF0000;"><i>The email address you entered is not available. Please check to ensure you have entered the correct email that you registered with!</i></p>';
		}
	}
?>
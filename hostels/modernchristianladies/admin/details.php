<?php
	include_once("db.php");
	if(isset($_POST['cid'])){
		$output = '';
		$query = "SELECT * FROM clients  WHERE id='".$_POST['cid']."'";
		$runQuery = mysqli_query($con, $query);
		$output .='
			<div class="row">
				<div class="col-lg-9 col-md-9" >
					<div class="table-responsive">
						<table class="table table-bordered">

				';
					while($row=mysqli_fetch_array($runQuery)){
					$cId = $row['Id'];
					$c_fname = $row['First_Name'];
					$c_lname = $row['Last_Name'];
					$c_phone = $row['Phone_Number'];
					$c_room = $row['rm_cat'];
					$institution = $row['Client_Institution'];
					$email = $row['Clients_Email'];
					$pfname = $row['Parents_FName'];
					$plname = $row['Parents_LName'];
					$pphone = $row['Parents_Phone'];
					$date = $row['Payment_Date'];
					$discount = $row['discount'];
					$c_identity = $row['Client_IDNo'];
					$c_date = $row['Payment_Date'];
					$c_passport = $row['Passport'];
		$output .='
					<tr>
						<td><label>Name:</label></td>
						<td>'.$c_fname.' '.$c_lname.'</td>
					</tr>
					<tr>
						<td><label>ID No</label></td>
						<td>'.$c_identity.'</td>
					</tr>
					<tr>
						<td><label>Phone no:</label></td>
						<td>'.$c_phone.'</td>
					</tr>
					<tr>
						<td><label>Room</label></td>
						<td>'.$c_room.'</td>
					</tr>
					<tr>
						<td><label>Institution</label></td>
						<td>'.$institution.'</td>
					</tr>
					<tr>
						<td><label>Email</label></td>
						<td>'.$email.'</td>
					</tr>
					<tr>
						<td><label>P/G Names:</label></td>
						<td>'.$pfname.' '.$plname.'</td>
					</tr>
					<tr>
						<td><label>P/G phone no:</label></td>
						<td>'.$pphone.'</td>
					</tr>
					<tr>
						<td><label>Discount:</label></td>
						<td>'.$discount.'</td>
					</tr>
					<tr>
						<td><label>Registration date:</label></td>
						<td>'.$c_date.'</td>
					</tr>
					</table>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
				';
				if($c_passport == ''){
					$output .= '<img src="images/default.png" width="100%" style="border:2px solid #000000;" />';
				}else{
					$output .= '<img src="data:image/jpeg;base64,'.base64_encode($c_passport).'" width="100%" style="border:2px solid #000000;" />';
				}
			echo '	</div>
					';
		}
		$output .= '</div>';
		echo $output;
	}
?>
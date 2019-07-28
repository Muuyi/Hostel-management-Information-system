<?php
		include ("db.php");
		$clId = $_GET['details'];
		$get_client = "select * from clients where c_id='$clId'";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
			$cId = $row_client['c_id'];
			$c_name = $row_client['c_name'];
			$c_phone = $row_client['c_phone'];
			$c_room = $row_client['c_room'];
			$c_identity = $row_client['c_identity'];
			$c_date = $row_client['date'];
			$c_passport = $row_client['c_passport'];
			$status = $row_client['status'];
			$cInstitution = $row_client['c_institution'];
			$cPname = $row_client['c_pname'];
			$cPhone = $row_client['c_pphone'];
			$amount = $row_client['amount'];
			echo "
			<img src='images/$c_passport ?>' width='300px' height='300px' style='border:2px solid #000000; margin:2px;' />
			<table class='cDetails' style='border:0px; font-size:30px;'>
				<tr>
					<th>Clients full names</th>
					<td>:</td>
					<td>$c_name</td>
				</tr>
				<tr>
					<th>Clients phone number</th>
					<td>:</td>
					<td>$c_phone</td>
				</tr>
				<tr>
					<th>Clients Room</th>
					<td>:</td>
					<td>$c_room Sharing </td>
				</tr>
				<tr>
					<th>Clients ID number</th>
					<td>:</td>
					<td>$c_identity</td>
				</tr>
				<tr>
					<th>Clients payment date</th>
					<td>:</td>
					<td>$c_date</td>
				</tr>
				<tr>
					<th>Clients Institution</th>
					<td>:</td>
					<td>$cInstitution</td>
				</tr>
				<tr>
					<th>Parents Name</th>
					<td>:</td>
					<td>$cPname</td>
				</tr>
				<tr>
					<th>Parents phone number</th>
					<td>:</td>
					<td>$cPhone</td>
				</tr>
								<tr>
					<th>Amount paid</th>
					<td>:</td>
					<td>Kshs. $amount</td>
				</tr>
			</table>
			
			";
			
	?>
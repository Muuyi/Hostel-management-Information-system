<?php include_once("db.php"); ?>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th colspan="2" style="background-color:#A52A2A; color:#FFFFFF; text-align:center;">
					<?php 
						$q = "SELECT * FROM hostels WHERE host_id='".$_SESSION['hostel']."'";
						$rQ = mysqli_query($con, $q);
						$row = mysqli_fetch_array($rQ);
						echo strtoupper($row['host_name']);
					?>
					<br />BALANCE SHEET<br />
					<?php echo (date("l jS \of F Y h:i:s A")) ?><br />
					(Kshs.)

				</th>
			</tr>
			<tr>
				<td colspan="2" style="font-weight:bolder;">ASSETS</td>
			</tr>
		<!---- /////////////// ASSETS SECTION/////////////////-->
			<?php
				$q = "SELECT acc_name,acn_name, SUM(amount) FROM ((account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id) INNER JOIN accounts ON account_name.acc_id = accounts.acc_id) WHERE account_name.acc_id = 1 GROUP BY acn_name ";
				$rQ = mysqli_query($con, $q);
				echo mysqli_error($con);
				while($row = mysqli_fetch_array($rQ)){
					echo'
						<tr>
							<td>'.$row['acn_name'].'</td>
							<td>'.$row['SUM(amount)'].'</td>
						</tr>
					';
				}
			?>
			<tr>
				<td style="font-weight:bolder;">Total assets</td>
				<td style="font-weight:bolder; border-top:2px solid #000;border-bottom:2px solid #000;">
					<?php
						$q = "SELECT SUM(amount) FROM ((account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id) INNER JOIN accounts ON account_name.acc_id = accounts.acc_id) WHERE account_name.acc_id = 1";
						$rQ = mysqli_query($con, $q);
						$row = mysqli_fetch_array($rQ);
						echo $row['SUM(amount)'];
					?>
				</td>
			</tr>
		<!---///////////////////////LIABILITIES SECTIION////////////////-->
			<tr>
				<td colspan="2" style="font-weight:bolder;">LIABILITIES</td>
			</tr>
			<?php
				$q = "SELECT acc_name,acn_name, SUM(amount) FROM ((account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id) INNER JOIN accounts ON account_name.acc_id = accounts.acc_id) WHERE account_name.acc_id = 4 GROUP BY acn_name ";
				$rQ = mysqli_query($con, $q);
				echo mysqli_error($con);
				while($row = mysqli_fetch_array($rQ)){
					echo'
						<tr>
							<td>'.$row['acn_name'].'</td>
							<td>'.$row['SUM(amount)'].'</td>
						</tr>
					';
				}
			?>
			<tr>
				<td style="font-weight:bolder;">Total assets</td>
				<td style="font-weight:bolder; border-top:2px solid #000;border-bottom:2px solid #000;">
					<?php
						$q = "SELECT SUM(amount) FROM ((account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id) INNER JOIN accounts ON account_name.acc_id = accounts.acc_id) WHERE account_name.acc_id = 4";
						$rQ = mysqli_query($con, $q);
						$row = mysqli_fetch_array($rQ);
						echo $row['SUM(amount)'];
					?>
				</td>
			</tr>
		</table>
	</div>
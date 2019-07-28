<?php include_once("db.php"); ?>
<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th colspan="4" style="background-color:#A52A2A; color:#FFFFFF; text-align:center;">
				<?php 
					$q = "SELECT * FROM hostels WHERE host_id='".$_SESSION['hostel']."'";
					$rQ = mysqli_query($con, $q);
					$row = mysqli_fetch_array($rQ);
					echo strtoupper($row['host_name']);
				?>
				INCOME STATEMENT<br />
				FOR THE YEAR 2018<br />
				<?php echo (date("l jS \of F Y h:i:s A")) ?>
			</th>
		</tr>
		<tr>
			<td colspan="4" style="font-weight:bolder;">REVENUES</td>
		</tr>
		<?php
			$q = "SELECT SUM(amount) FROM payment";
			$rQ = mysqli_query($con, $q);
			$row = mysqli_fetch_assoc($rQ);
			$res = $row['SUM(amount)'];
			echo"
				<tr>
					<td style='padding-left:100px;'>Rent</td>
					<td><b>Kshs.</b></td>
					<td>".$res."</td>
					<td></td>
				</tr>
			";
/////////////FINDING THE SUM OF ALL REVENUES/////////////////////////////////////////////////
				$q5 = "SELECT acn_name,SUM(amount) FROM transactions INNER JOIN account_name ON transactions.acn_id=account_name.acn_id WHERE acc_id=2 GROUP BY acn_name";
				$rQ5 = mysqli_query($con, $q5);
				echo mysqli_error($con);
				while($row5 = mysqli_fetch_array($rQ5)){
					echo "
						<tr>
							<td style='padding-left:100px;'>".$row5['account_name']."</td>
							<td></td>
							<td>".$row5['SUM(amount)']."</td>
							<td></td>
						</tr>
							";
				}
				$q7 = "SELECT SUM(amount) FROM transactions WHERE acn_id=2";
				$rQ7 = mysqli_query($con, $q7);
				$row7 = mysqli_fetch_assoc($rQ7);
				$total_transactions = $row7['SUM(amount)'];
///////////////FINDING THE SUM OF ALL THE DEPOSIT AND DISPLAYING IT ON THE REVENUES SECTION///////////////////
			$q1 = "SELECT SUM(discount) FROM clients";
			$rQ1 = mysqli_query($con, $q1);
			$row1 = mysqli_fetch_assoc($rQ1);
			$res1 = $row1['SUM(discount)'];
			$total = $res + $res1+$total_transactions;
			echo "
				<tr>
					<td style='padding-left:100px;'>Deposit</td>
					<td></td>
					<td>".$res1."</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td style='border-top:2px solid #000000;border-bottom:2px solid #000000;'><b>Kshs.".' '.$total."</b></td>
				</tr>
			";

		?>
		<tr>
			<td colspan="3" style="font-weight:bolder;">EXPENSES</td>
		</tr>
			<?php
//////////////////////////FINDING THE TOTAL OF ALL SALARIES AND DISPLAYING THEM ON THE EXPENSES SECTION///////////
				$q3 = "SELECT SUM(sal_amount) FROM salaries";
				$rQ3 = mysqli_query($con, $q3);
				$row3 = mysqli_fetch_assoc($rQ3);
				$res3 = $row3['SUM(sal_amount)'];
				echo "
						<tr>
							<td style='padding-left:100px;'> Salary</td>
							<td><b>Kshs.</b></td>
							<td>".$res3."</td>
							<td></td>
						</tr>
							";
////////////////////FINDING THE TOTAL OF ALL TRANSACTIONS AND DISPLAYING THEM ON EXPENSES SECTION///////////////
				$q2 = "SELECT acn_name,SUM(amount) FROM transactions INNER JOIN account_name WHERE acc_id=3 GROUP BY acn_name";
				$rQ2 = mysqli_query($con, $q2);
				while($row2 = mysqli_fetch_array($rQ2)){
					echo "
						<tr>
							<td style='padding-left:100px;'>".$row2['acn_name']."</td>
							<td></td>
							<td>".$row2['SUM(amount)']."</td>
							<td></td>
						</tr>
							";
				}
				$q4 = "SELECT SUM(amount) FROM transactions INNER JOIN account_name WHERE acc_id=3";
				$rQ4 = mysqli_query($con, $q4);
				$row4 = mysqli_fetch_assoc($rQ4);
				$res4 = $row4['SUM(amount)'];
				$total1 = $res3 + $res4;
				echo "
					<tr>
							<td></td>
							<td></td>
							<td></td>
							<td style='border-top:2px solid #000000;border-bottom:2px solid #000000;'><b>Kshs.".' '.$total1."</b></td>
					</tr>
				";
			?>
		<tr style="background-color:#FFD700;">
			<td colspan="2" style="font-weight:bolder;">NET INCOME</td>
			<td></td>
			<td>
				<?php
					$q5 = $total - $total1;
					echo "<b>Kshs.".' '.$q5."</b>"
					
				?>
			</td>
		</tr>
	</table>
</div>
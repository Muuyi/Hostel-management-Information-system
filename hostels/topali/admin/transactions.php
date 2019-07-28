<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Account name</th>
			<th>Description</th>
			<th>Amount</th>
			<th>Date</th>
		</tr>
	
<?php
	$q = "SELECT * FROM account_name INNER JOIN transactions ON account_name.acn_id=transactions.t_id ORDER BY tra_date DESC";
	$rQ = mysqli_query($con, $q);
	$i = 0;
	while($row=mysqli_fetch_array($rQ)){
		$i++;
		$type = $row['acn_name'];
		$name = $row['Description'];
		$amount = $row['amount'];
		$date = $row['tra_date'];
		echo"
			<tr>
				<td>$i</td>
				<td>$type</td>
				<td>$name</td>
				<td>$amount</td>
				<td>$date</td>
			</tr>
		";
	}
?>
	</table>
</div>
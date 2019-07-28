<div class="table-responsive">
	<table id="transaction_summary_table" class="table table-bordered table-striped" style="width:100%;">
		<thead>
			<tr>
				<th>No</th>
				<th>Account name</th>
				<th>Total amount</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
<?php
	$q = "SELECT SUM(amount), account_name.acn_id,acn_name FROM account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id WHERE host_id='".$_SESSION['hostel']."' GROUP BY transactions.acn_id ";
	$rQ = mysqli_query($con, $q);
	echo mysqli_error($con);
	$i = 0;
	while($row=mysqli_fetch_array($rQ)){
		$i++;
		$name = $row['acn_name'];
		$total = $row['SUM(amount)'];
		echo"
			<tr>
				<td>$i</td>
				<td>$name</td>
				<td>$total</td>
			</tr>
		";
	}
?>
	</table>
</div>
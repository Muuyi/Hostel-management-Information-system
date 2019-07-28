<div class="table-responsive">
	<table id="transactions_table" class="table table-bordered" style="width:100%;">
		<thead>
			<tr>
				<th>Account name</th>
				<th>Description</th>
				<th>Amount</th>
				<th>Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	
<?php
	/*$q = "SELECT * FROM account_name INNER JOIN transactions ON account_name.acn_id=transactions.t_id ORDER BY tra_date DESC";
	$rQ = mysqli_query($con, $q);
	$i = 0;
	while($row=mysqli_fetch_array($rQ)){
		$i++;
		$trid = $row['t_id'];
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
				<td><input type='button' value='Edit' class='btn btn-primary btn-xs trans_edit' id='".$trid."' /></td>
				<td><input type='button' value='Delete' class='btn btn-danger btn-xs trans_del' id='".$trid."' /></td>
			</tr>
		";
	}*/
?>
	</table>
</div>
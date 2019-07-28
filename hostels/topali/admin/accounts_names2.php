<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Account type</th>
			<th>Account names</th>
			<th>Delete</th>
		</tr>
	
<?php
	$q = "SELECT * FROM accounts INNER JOIN account_name ON accounts.acc_id=account_name.acn_id ORDER BY acc_name ASC";
	$rQ = mysqli_query($con, $q);
	$i = 0;
	while($row=mysqli_fetch_array($rQ)){
		$i++;
		$id = $row['acn_id'];
		$type = $row['acc_name'];
		$name = $row['acn_name'];
		echo"
			<tr>
				<td>$i</td>
				<td>$type</td>
				<td>$name</td>
				<td><input type='submit' value='Delete' class='btn btn-danger btn-xs acname_dlt' id='$id'</td>
			</tr>
		";
	}
?>
	</table>
</div>
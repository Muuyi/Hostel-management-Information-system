<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Account name</th>
			<th>Total amount</th>
		</tr>
	
<?php
	$q = "SELECT account_name,SUM(amount) FROM  transactions GROUP BY account_name";
	$rQ = mysqli_query($con, $q);
	$i = 0;
	while($row=mysqli_fetch_array($rQ)){
		$i++;
		$name = $row['account_name'];
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
<div class="table-responsive">
	<table class="table table-bordered table-striped">
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
		<tr>
			<td><?php echo $i+1 ?></td>
			<td>Rent</td>
			<td>
				<?php
					$q1 = "SELECT SUM(amount) FROM payment";
					$rQ1 = mysqli_query($con, $q1);
					$row1 = mysqli_fetch_assoc($rQ1);
					$sum = $row1['SUM(amount)'];
					echo $sum;
				?>
			</td>
		</tr>
	</table>
</div>
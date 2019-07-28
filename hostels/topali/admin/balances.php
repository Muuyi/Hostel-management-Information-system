<?php include_once("db.php"); ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>ID No</th>
			<th>Balance amount</th>
			<th>Date</th>
			<th>Delete</th>
		</tr>
		<?php
			$q = "SELECT * FROM balances INNER JOIN clients ON clients.Client_IDNo=balances.Client_IDNo ORDER BY balance DESC";
			$rQ = mysqli_query($con, $q);
			$i = 0;
			while($row = mysqli_fetch_array($rQ)){
				$i++;
				$bId = $row['bal_id'];
				$cId = $row['Client_IDNo'];
				$cFName = $row['First_Name'];
				$cLName = $row['Last_Name'];
				$balance = $row['balance'];
				$date = $row['bal_date'];
				echo"
					<tr>
						<td>".$i."</td>
						<td>".$cFName.' '.$cLName."</td>
						<td>".$cId."</td>
						<td>".$balance."</td>
						<td>".$date."</td>
						<td><input type='button' class='btn btn-danger btn-xs' id='$bId' value='Delete' /></td>
					</tr>
				";
			}

		?>
	</table>
</div>
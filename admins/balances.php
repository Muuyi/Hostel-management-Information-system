<?php include_once("db.php"); ?>
<div class="table-responsive">
	<table id="clients_balances_table" class="table table-bordered table-striped" style="width:100%;">
		<thead>
			<tr>
				<th>Name</th>
				<th>ID No</th>
				<th>Balance amount</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<!--<?php
			/*$q = "SELECT * FROM balances INNER JOIN clients ON balances.id_no=clients.id_no ORDER BY balance DESC";
			$rQ = mysqli_query($con, $q);
			$i = 0;
			while($row = mysqli_fetch_array($rQ)){
				$i++;
				$bId = $row['bal_id'];
				$cId = $row['id_no'];
				$cFName = $row['fname'];
				$cLName = $row['lname'];
				$balance = $row['balance'];
				$date = $row['bal_date'];
				echo"
					<tr>
						<td>".$i."</td>
						<td>".$cFName.' '.$cLName."</td>
						<td>".$cId."</td>
						<td>".$balance."</td>
						<td>".$date."</td>
					</tr>
				";
			}*/

		?>-->
	</table>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th>Employee names</th>
			<th>ID No</th>
			<th>Salary amount</th>
			<th>Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php 
			$q = "SELECT * FROM salaries INNER JOIN employees ON salaries.emp_idno=employees.emp_idno ORDER BY sal_date DESC";
			$rQ = mysqli_query($con, $q);
			while($rw = mysqli_fetch_array($rQ)){
				echo"
					<tr>
						<td>".$rw['emp_fname'].' '.$rw['emp_lname']."</td>
						<td>".$rw['emp_idno']."</td>
						<td>".$rw['sal_amount']."</td>
						<td>".$rw['sal_date']."</td>
						<td><input type='button' class='btn btn-primary btn-xs sal_edit' id=".$rw['sal_id']." value='Edit' /></td>
						<td><input type='button' class='btn btn-danger btn-xs sal_delete' id=".$rw['sal_id']." value='Delete' /></td>
					</tr>
				";

			}
		?>
	</table>
</div>
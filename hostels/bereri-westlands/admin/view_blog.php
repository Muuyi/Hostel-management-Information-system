<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Blog title</th>
			<th>Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	<?php
		include_once("db.php");
		$q = "SELECT * FROM blog ORDER BY b_id DESC";
		$rQ = mysqli_query($con, $q);
		$i = 0;
		while($row = mysqli_fetch_array($rQ)){
			$bId = $row['b_id'];
			$i++;
			echo"
				<tr>
					<td>".$i."</td>
					<td>".$row['b_title']."</td>
					<td>".$row['date']."</td>
					<td><input type='submit' value='Edit' class='btn btn-primary btn-xs edit_blog' id='$bId' /></td>
					<td><input type='submit' value='Delete' class='btn btn-danger btn-xs delBlog' id='$bId' /></td>
				</tr>
			";
		}
	?>
	</table>
</div>
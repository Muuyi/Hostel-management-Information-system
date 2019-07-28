<div class="table_responsive">
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Vacance title</th>
			<th>Date posted</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
<?php
	$i = 0;
	include_once("db.php");
	$q = "SELECT vaca_id, vaca_title, vaca_date FROM vacance";
	$rQ = mysqli_query($con, $q);
	while($row=mysqli_fetch_array($rQ)){
	$i++;
?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['vaca_title'] ?></td>
		<td><?php echo $row['vaca_date'] ?></td>
		<td><button type="button" class="btn btn-xs btn-primary vacance_edit" id="<?php echo $row['vaca_id'] ?>">Edit</button></td>
		<td><button type="button" class="btn btn-xs btn-danger vacance_delete" id="<?php echo $row['vaca_id'] ?>">Delete</button></td>
	</tr>
<?php } ?>
	</table>
</div>
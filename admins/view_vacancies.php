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
	$q = "SELECT * FROM vacance WHERE host_id='".$_SESSION['hostel']."'";
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
<div class="modal fade" id="edit_vacance_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Edit vacane details</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="message"></div>
				<form action="admin.php?post_vacancies" id="edit_vacacncy_content" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="vaca_id" id="vid" class="form-control"  />
					<div class="form-group">
						<label>Vacancy title</label>
						<input type="text" name="vaca_title" onblur="ValidateVariousCharacters('title',5,255,'titleresponse')" id="title" class="form-control" placeholder="Vacancy title" />
						<div id="titleresponse"></div>
					</div>
					<div class="form-group">
						<label>Vacancy details</label>
						<textarea cols="30" rows="20" id="content" class="form-control ckeditor" name="vaca_deta"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" id="post_vacancy" class="btn btn-success form-control" name="post_vac" value="Post vacancy"/>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
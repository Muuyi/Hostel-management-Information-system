<?php
		require_once ("functions.php");
	if(isset($_POST['query'])){
		$get_client = "SELECT * FROM clients WHERE Client_IDNo LIKE '%".$_POST['query']."%' OR First_Name LIKE '%".$_POST['query']."%' OR Last_Name LIKE '%".$_POST['query']."%' OR Client_Institution LIKE '%".$_POST['query']."%' OR rm_id LIKE '%".$_POST['query']."%'";
		$run_client = mysqli_query($con, $get_client);
		?>
	<?php
		if(mysqli_num_rows($run_client) > 0){
		?>
	<table width='100%' class='cTable' border='1px solid #000000'>
					<tr style='text-align:center;'>
						<th>Client Name</th>
						<th>Passport</th>
						<th>Client Phone</th>
						<th>Room</th>
						<th>ID Number</th>
						<th>Status</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
		<?php
			while($row_client = mysqli_fetch_array($run_client)){	
				$cId = $row_client['Id'];
				$c_fname = $row_client['First_Name'];
				$c_lname = $row_client['Last_Name'];
				$c_phone = $row_client['Phone_Number'];
				$c_room = $row_client['rm_cat'];
				$c_identity = $row_client['Client_IDNo'];
				$c_date = $row_client['Payment_Date'];
				$c_passport = $row_client['Passport'];
				$status = $row_client['status'];
	?>
				
					<tr>
						<td><?php echo "$c_fname $c_lname"; ?> <br />
							<?php echo "<input type='button' value='More details' name='view' id='$cId' class='btn btn-success btn-xs view_data'>"; ?>
						</td>
						<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($c_passport).'" width="100px" height="100px" style="border:2px solid #000000; margin:2px;" />' ?></td>
						<td><?php echo "$c_phone"; ?> </td>
						<td><?php echo "$c_room  sharing"; ?></td>
						<td><?php echo "$c_identity"; ?></td>
						<td id="cCheck">
							<?php
								 if($status =='Check in'){
									echo "<button class='btn btn-primary btn-xs check' name='check' id='$cId'>Check out</button>	";
								}else {
									echo "<button class='btn btn-danger btn-xs check' name='uncheck' id='$cId'>Check in</button>";
								}
			?>
						</td>
					<td><?php echo "<input type='button' value='Edit' name='edit' id='$cId' class='btn btn-primary btn-sm edit'>" ?></td>
					<td><?php echo "<input type='button' value='Delete' name='delete' id='$cId' class='btn btn-danger btn-sm delete'>" ?></td>
		</tr>
	<?php }
	} else {
		echo "<h2 style='color:#FF0000;'><i>Record is not found!</i></h2>";
	}
 } ?>
<!--VIEWING ADMIN DETAILS MODAL WINDOW-->
<div class="modal fade" id="cdetails">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">Client Details</h2>
			</div>
			<div class="modal-body" id="client_details">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--EDITING CLIENTS DETAILS USING A MODAL WINDOW-->
<div class="modal fade" id="cedit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">Edit client Details</h2>
			</div>
			<div class="modal-body" id="client_edit">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script>
			window.jQuery || document.write("<script src='../../js/jquery-3.1.0.min.js'></\script>");
		</script>
		<script src="../../js/formvalidation.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/main.js"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
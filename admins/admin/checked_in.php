<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
			<h1 style="text-align:center; color:#A52A2A; font-weight:bolder;"><u>CLIENTS</u></h1>
			<form method="POST" action="admin.php?search.php" enctype="multipart/form-data"  >
				<input type="text" name="search" id="search" class="form-control" placeholder="Search by  ID number, names, room number or institution of learning" />
			</form><br />
			<form class="forms" action="" method="POST">
				<a href="checkedin_pdf.php" target="_blank"><button type="button"  class="btn btn-primary">Print page</button></a>
			</form> <br /><br /><br /><br />
	<div id="results">
		<table width="100%" class="table table-bordered table-striped" border="1px solid #000000">
			<tr style='text-align:center;'>
				<th>No</th>
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
				$i=0;
				$get_client = "select * from clients WHERE status = 'Check in'";
				$run_client = mysqli_query($con, $get_client);
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
					$i++;
			?>
			<tr>
				<td><?php echo "$i" ?></td>
				<td>
					<?php echo "$c_fname $c_lname" ?><br />
					<?php echo "<input type='button' value='More details' name='view' id='$cId' class='btn btn-success btn-xs view_data'>"; ?>
				</td>
				<td>
				<?php 
					if($c_passport == ''){
							echo "<img src='images/default.png' width='50px' height='50px' style='border:2px solid #000000;'";
						}else{
							echo '<img src="data:image/jpeg;base64,'.base64_encode($c_passport).'" width="50px" height="50px" style="border:2px solid #000000; margin:2px;" />'; 
						}
						
					?>
				</td>
				<td><?php echo "$c_phone " ?></td>
				<td><?php echo "$c_room"."  sharing" ?></td>
				<td><?php echo "$c_identity " ?></td>
				<td id="cCheck">
					<?php
						 if($status =='Check in'){
								echo "<button class='btn btn-primary btn-xs check' name='check' id='$cId'>Check out</button>	";
							}else {
								echo "
									<button class='btn btn-danger btn-xs check' name='uncheck' id='$cId'>Check in</button>";
								}
					?>
				</td>
				<td><?php echo "<input type='button' value='Edit' name='edit' id='$cId' class='btn btn-primary btn-xs edit'>" ?></td>
				<td><?php echo "<input type='button' value='Delete' name='delete' id='$cId' class='btn btn-danger btn-xs delete'>" ?></td>
			</tr>
				<?php } ?>
		</table>
	</div>
	</div>
</div>
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

		<?php } ?>
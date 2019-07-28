<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col">
			<h1 style="text-align:center; color:#A52A2A; font-weight:bolder;"><u>CLIENTS</u></h1>
				<a href="pdfs/checkedout_pdf.php?hst='<?php echo $_SESSION['hostel']?>'" target="_blank"><button type="button" class="btn btn-primary">Print client's details</button></a>
				<!--<div class="form-group">
					<label>Search:</label>
					<input type="text" name="search" id="search" placeholder="Search by  ID number, names, room number or institution of learning">
				</div>-->

	<div id="results">
		<div class="table-responsive">
			<table id="checkedout_clients_table" class="table table-bordered table-striped">
				<thead>
					<tr style='text-align:center;'>
						<th>Client Name</th>
						<th>Passport</th>
						<th>Client Phone</th>
						<th>ID Number</th>
						<th>View details</th>
						<th>Status</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php //GetClientsInfo() ?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>
<?php
//////////////////////////////////ADDING THE EDIT CLIENT MODAL WINDOW////////////////////////////////
	include('edit_client_modal.php');
?>
	<!--VIEWING ADMIN DETAILS MODAL WINDOW-->
<div class="modal fade" id="cdetails">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Client Details</h2>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
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
			<div class="modal-body" id="cl_edit">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
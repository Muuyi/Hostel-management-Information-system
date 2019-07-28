<?php
	error_reporting(E_ALL);
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col">
			<h1 style="text-align:center; color:#A52A2A; font-weight:bolder;">CLIENTS</h1>
				<br />
				<button type="button" class="btn btn-primary" data-target="#add_university" data-toggle="modal">Add institution name</button>
				<button type="button" class="btn btn-primary" data-target="#add_room" data-toggle="modal">Add room number</button>
				<button type="button" id="add_client" class="btn btn-success">Add client</button>
				<a href="pdfs/clients_pdf.php?hst='<?php echo $_SESSION['hostel']?>'" target="_blank"><button type="button" class="btn btn-primary">Print client's details</button></a>
			<!--	<div class="form-group">
					<label>Search:</label>
					<input type="text" name="search" id="search" placeholder="Search by  ID number, names, room number or institution of learning">
				</div>-->
			<div class="table-responsive">
				<table id="clients_table" class="table table-bordered table-striped" style="width:100%;">
					<thead>
						<tr style='text-align:center;'>
							<th>Client Name</th>
							<th>Passport</th>
							<th>Client Phone</th>
							<!--<th>Client's Room</th>-->
							<th>ID Number</th>
							<th>View more details</th>
							<th>Status</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
	</div>
</div>
<?php
//////////////////////////////////ADDING THE EDIT CLIENT MODAL WINDOW////////////////////////////////
	include('edit_client_modal.php');
	include_once('add_room_numbers.php'); 
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
<!--ADDING THE UNIVERSITY TO THE DATABASE-->
	<div class="modal" id="add_university">
		<div class="modal-dialog">
			<div class="modal-content">
			<form method="POST" id="institution_form" >
				<div class="modal-header">
					<h4>Add institution name</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div id="institution_form_response"></div>
					<div class="form-group">
						<label for="university name">Institution name</label>
						<input type="text" class="form-control" id="institution_name" onblur="ValidateVariousCharacters('institution_name',5,0,'institution_response')" name="institution_name" placeholder="Add institution name...."/>
						<div id="institution_response"></div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" name="save_university" id="save_institution" value="Add institution" class="btn btn-success" />
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
			</div>
		</div>
	</div>
<!--EDITING CLIENTS DETAILS USING A MODAL WINDOW-->
<!--<div class="modal fade" id="cedit">
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
</div>-->

	<?php } ?>

<?php
	include ("db.php"); 
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
	<div class="row">
		<div class="col">
			<h4>Add help & Support</h4>
			<button type="button" class="btn btn-primary" id="add_help_support" >Add help & support</button>
			<div class="table-responsive">
				<table id="help_support_table" class="table table-bordered table-stripped">
					<thead>
						<th>No</th>
						<th>Title</th>
						<th>ID attr</th>
						<th>Title summary</th>
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="help_support">
		<div class="modal-dialog modal-lg">
			<form method="POST" id="help_support_form" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h3>Add help and support</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div id="help_support_response"></div>
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" id="title" placeholder="Enter help title" required/>
						</div>
						<div class="form-group">
							<label>ID attribute</label>
							<input type="text" class="form-control" id="id_attr" placeholder="Enter id attribute" required />
						</div>
						<div class="form-group">
							<label>Title summary</label>
							<input type="text" class="form-control" id="title_sum" placeholder="Enter help title summary" required/>
						</div>
						<div class="form-group">
							<label>Enter help and support content</label>
							<textarea class="form-control" name="content" id="content" rows="20"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="support_id" />
						<input type="hidden" value="save" id="btn_action" />
						<button type="button" class="btn btn-success" id="save_help_support">Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php } ?>
<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
	include_once('db.php');
?>
<div class="row">
	<div class="col">
	
		<h1>System users</h1>
		<input type="button" value="Add user" class="btn btn-primary" id="add_user_button"/>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" id="system_users">
				<thead>
					<tr>
						<th>Name</th>
						<th>Passport</th>
						<th>Email address</th>
						<th>Phone number</th>
						<th>Edit</th>
						<th>Status</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!--SENDING USERS INFORMATION TO THE DATABASE-->
<div class="modal fade" id="addusers">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add system users</h4>
				<button class="close" type="button" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div id="admin_insertdata_response"></div>
				<form method="POST" action="admin.php?system_users" id="insert_admins_form" enctype="multipart/form-data">
					<input type="hidden" id="user_id" />
					<input type="hidden" id="btn_action" value="Insert" />
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>First Name</label>
								<input type="text" id="fname" onblur="ValidateSingleName('fname','fnameresponse')" class="form-control" name="fname" placeholder="Enter first name" required/>
								<div id="fnameresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Last Name</label>
								<input type="text" id="lname" onblur="ValidateSingleName('lname','lnameresponse')" class="form-control" name="lname" placeholder="Enter last name..." required/>
								<div id="lnameresponse"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Email address</label>
								<input type="email" class="form-control" onblur="ValidateEmail('email','emailresponse')" id="email" name="email" placeholder="Enter email address..." required/>
								<div id="emailresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<labe>Phone number</label>
								<input type="tel" class="form-control" onblur="ValidateTel('phone','phoneresponse')" id="phone" name="phone" />
								<div id="phoneresponse"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label class="pass">Password</label>
								<input type="password" onblur="ValidatePassword('password','passresponse')" class="form-control" id="password" name="password" placeholder="Enter password..." />
								<div id="passresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Select user type</label><br />
								<label>Admin</label>
								<input type="radio" id="radio_admin"  name="user_type" value="admin" />
								<label>User</label>
								<input type="radio" id="radio_user"  name="user_type" value="user" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group">
								<input type="submit" name="save" id="insert" class="btn btn-success form-control" value="Save"/>
							</div>
						</div>
					</labe>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
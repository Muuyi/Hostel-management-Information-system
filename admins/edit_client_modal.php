<div class="modal fade" id="edit_client_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add client</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div id="edit_client_response"></div>
				<div id="client_profile"></div>
				<form method="POST" id="customerForm" enctype="multipart/form-data">
					<input type="hidden" value="" id="cl_id" />
					<input type="hidden" value="" id="hostel_list" />
					<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="full-names">First Name</label>
										<input type="text" name="c_fname" onblur="ValidateSingleName('fname','fnameresponse')" id="fname" class="form-control" placeholder="Client's first name" required/>
										<div id="fnameresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="full-names">Last Name</label>
										<input type="text" name="c_lname" onblur="ValidateSingleName('lname','lnameresponse')" id="lname" class="form-control" placeholder="Client's last name" required/>
										<div id="lnameresponse"></div>
								</div>
							</div>
					</div>
					<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="phone-number">Phone number</label>
									<input type="tel" name="c_number" id="cphone" class="form-control" onblur="ValidateTel('cphone','phoneresponse')" required />
									<div id="phoneresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="id-no">ID Number</label>
									<input type="text" id="cnumber" name="c_identity" class="form-control" placeholder="Client's ID Number" onblur="ValidateNumerals('cnumber',8,8,'idresponse')"required/>
									<div id="idresponse"></div>
								</div>
							</div>
					</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="full-names">Email address</label>
									<input type="email" name="c_email" id="email" onblur="ValidateEmail('email','emailresponse')" class="form-control" placeholder="Enter your email address" required/>
									<div id="emailresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="institution">Select institution of learning</label>
									<select name="institution" id="institution" class="form-control">
										<option value="">Select institution</option>
										<?php
											$q = "SELECT * FROM universities";
											$rQ = mysqli_query($con, $q);
											while($rw = mysqli_fetch_array($rQ)){
												echo "<option value='".$rw['uni_id']."'>".$rw['uni_name']."</option>";
											}
										?>
									</select>
									<div id="institutionresponse"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="g-name">Guardian/Parents Full name</label>
									<input type="text" id="pname" onblur="ValidateFullNames('pname','pnameresponse')"  name="c_pfname" class="form-control" placeholder="Enter parent's/guardian's first name"  required />
									<div id="pnameresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="g-number">Guardian's/Phone number</label>
									<b>(+254)</b><input type="tel" name="c_pphone" id="pphone" class="form-control" onblur="ValidateTel('pphone','pphoneresponse')"  required />
									<div id="pphoneresponse"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="app-info">Category of room</label>
									<select name="room_cat" id="croom" class="form-control" style="text-align:center;">
										<option value="">Select a Room Category</option>
										<?php
											GetRoomCategories();
										?>
									</select>
									<div class="response" id="roomresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="app-info">Select room number</label>
									<select name="room_no"  class="form-control" id="rm_no" style="text-align:center;">
										<option value="">Please select room category first</option>
									</select>
									<div class="response" id="roomnoresponse"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Course title</label>
									<input type="text" id="course" onblur="ValidateVariousCharacters('course',2,255,'courseresponse')" placeholder="Student's course" class="form-control" />
									<div id="courseresponse"></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Discount amount</label>
									<input type="number" id="discount" onblur="ValidateNumerals('discount',0,12,'discountresponse')" placeholder="Enter discount amount" class="form-control" />
									<div id="discountresponse"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label for="gender">Gender</label><br />
									<b>Male:</b> &nbsp; <input type="radio" id="m" name="g" value="m" /> <b>Female:</b> &nbsp; <input type="radio" id="f" name="g" value="f" />
								</div>
								<input type="hidden" value="save" id="action" />
							</div>
						</div>
						<div class="form-group">
							<button type="button" name="book" id="edit_client" class="btn btn-primary btn-lg form-control">Send values</button>
						</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

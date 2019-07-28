<!--ADDING THE ROOM NUMBER TO THE DATABASE-->
	<div class="modal" id="add_room">
		<div class="modal-dialog">
			<div class="modal-content">
			<form method="POST" id="room_form">
				<div class="modal-header">
					<h4>Add room</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div id="room_form_response"></div>
					<input type="hidden" name="host_id" value="<?php echo $_SESSION['hostel'] ?>" />
					<div class="form-group">
						<label for="room_category">Select room category</label>
						<select name="room_cat" class="form-control" id="room_cat" onblur="ValidateSelectCombo('room_cat','roomcatresponse')">
							<option value="">Select room</option>
							<?php
								GetRoomCategories();
							?>
						</select>
						<div id="roomcatresponse"></div>
					</div>
					<div class="form-group">
						<label for="university name">Room number</label>
						<input type="text" class="form-control" id="room_number" onblur="ValidateVariousCharacters('room_number',1,10,'roomnoresponse')" name="room_number" placeholder="Please enter room number...."/>
						<div id="roomnoresponse"></div>
					</div>
					<div class="form-group">
						<label for="university name">Amount</label>
						<input type="number" class="form-control" id="room_amount" onblur="ValidateNumerals('room_amount',2,5,'room_amount_response')" name="room_amount" placeholder="Enter room amount...." />
						<div id="room_amount_response"></div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="save_roomnumber" id="save_room_number" value="Add room" class="btn btn-success" />
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
			</div>
		</div>
	</div>
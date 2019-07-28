<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_slide_modal">Add slideshow image</button><br />
			<div class="table-responsibe">
				<table class="table table-stripped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Image</th>
							<th>Header</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody id="slideshow_table_body">

					</tbody>
				</table>
			</div>
			<div class="modal fade" id="add_slide_modal">
				<div class="modal-dialog">
					<form method="POST" id="post_image_slideshow_form" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Add slideshow image</h3>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
									<div id="slide_submit_response"></div>
									<div class="form-group">
										<label>Slide image</label><br />
										<input type="file" id="slide_image" name="slide_image" />
										<label class="text-danger" id="slideResponse"></label>
									</div>
									<div class="form-group">
										<label>Caption header</label>
										<input type="text" class="form-control" id="slide_header" placeholder="Caption header" />
									</div>
									<div class="form-group">
										<label>Caption text</label>
										<textarea class="form-control" id="slide_content">
										</textarea>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<input type="hidden" value="save" id="submit_value" />
								<input type="hidden" id="slide_id" />
								<input type="button" class="btn btn-primary" id="upload_slide_image" value="Save" />
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
	}
?>
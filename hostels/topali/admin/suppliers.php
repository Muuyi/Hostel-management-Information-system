<?php
if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
	$qu = "SELECT * FROM transactions ORDER BY tra_date DESC";
	$rQu = mysqli_query($con, $qu);
?>
<div class="row">
	<div class="col-lg-12 col-md-12">

		<div style="padding:5px; margin:5px;">
			<input type="button" class="btn btn-primary" value="Add a supplier details" data-toggle="modal" data-target="#supplier"/>
			<input type="button" class="btn btn-primary" value="Add supplies" data-toggle="modal" data-target="#supplies" />
		</div>
<!--SUPPLIERS  TABS-->
			<div id="suppliers_tabs">
				<ul>
					<li><a href="#suppliers">Suppliers details</a></li>
					<li><a href="#invoices">Invoices</a></li>
				</ul>
<!--SUPPLIERS DETAILS SECTION-->
				<div id="suppliers">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Product</th>
								<th>Date</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
<?php
	$q = "SELECT * FROM suppliers";
	$rQ = mysqli_query($con, $q);
	$i = 0;
	while($row=mysqli_fetch_array($rQ)){
		$i++;
		$fname = $row['f_name'];
		$lname = $row['l_name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$product = $row['product'];
		$date = $row['s_date'];
		echo'
			<tr>
				<td>'.$i.'</td>
				<td>'.$fname.' '.$lname.'</td>
				<td>'.$phone.'</td>
				<td>'.$email.'</td>
				<td>'.$product.'</td>
				<td>'.$date.'</td>
				<td><input type="submit" class="btn btn-xs btn-primary s_edit" value="Edit" /></td>
				<td><input type="submit" class="btn btn-xs btn-danger s_delete" value="Delete" /></td>
			</tr>
		';
	}
?>
						</table>
					</div>
					<?php } ?>
				</div>
<!--ACCOUNTS DETAILS SECTION-->
				<div id="invoices">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>No</th>
								<th>Supplier ID No</th>
								<th>Supplier phone</th>
								<th>Supplier email</th>
								<th>Product</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Print invoice</th>
								<th>Send email</th>
								<th>Edit</th>
								<th>Delete</th>
								<?php
									$q = "SELECT * FROM suppliers INNER JOIN supplies ON suppliers.supplier_id=supplies.spls_id ORDER BY supplies_date DESC";
									$rQ = mysqli_query($con, $q);
									$i = 0;
									while($row = mysqli_fetch_array($rQ)){
										$i++;
										$sid = $row['spls_id'];
										$spId = $row['id_no'];
										$spPhone = $row['phone'];
										$spEmail = $row['email'];
										$product = $row['product'];
										$amount = $row['amount'];
										$Date = $row['supplies_date'];
										echo "
											<tr>
												<td>$i</td>
												<td>$spId</td>
												<td>$spPhone</td>
												<td>$spEmail</td>
												<td>$product</td>
												<td>$amount</td>
												<td>$Date</td>
												<td><input type='submit' class='btn btn-info btn-xs print' value='Print' /></td>
												<td><input type='submit' class='btn btn-success btn-xs mail' value='Send mail' /></td>
												<td><input type='submit' class='btn btn-primary btn-xs edit' value='Edit' /></td>
												<td><input type='submit' class='btn btn-danger btn-xs delete' value='Delete' /></td>
											</tr>
										";
									}
								?>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!--SUPPLIER DETAILS INPUT MODAL-->
			<div class="modal fade" id="supplier">
				<div class="modal-dialog modal-lg" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title">Add a supplier</h3>
						</div>
						<div class="modal-body">
							<form action="admin.php?suppliers" method="POST">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>First name</label>
											<input type="text" name="sf_name" class="form-control" placeholder="Enter new suppliers first name" />
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Last name</label>
											<input type="text" name="sl_name" class="form-control" placeholder="Enter new suppliers last name" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Phone no</label>
											<input type="text" name="phone_no" class="form-control" placeholder="Enter new suppliers phone no" />
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Email address</label>
											<input type="text" name="s_email" class="form-control" placeholder="Enter new suppliers email address" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>ID No</label>
											<input type="text" name="s_id" class="form-control" placeholder="Enter new suppliers ID No" />
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Product</label>
											<input type="text" name="product" class="form-control" placeholder="Enter new suppliers product" />
										</div>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<input type="submit" name="submit" class="btn btn-primary" value="Save" />
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</form>
					</div>
				</div>
			</div>
<?php
	if(isset($_POST['submit'])){
		$fName = $_POST['sf_name'];
		$lName = $_POST['sl_name'];
		$phone = $_POST['phone_no'];
		$email = $_POST['s_email'];
		$id = $_POST['s_id'];
		$product = $_POST['product'];
		$q = "INSERT INTO suppliers (f_name,l_name,id_no,email,phone,product,s_date) VALUES ('$fName','$lName','$id','$email','$phone','$product',now()) ";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "<script>alert('You have successfully added a supplier!')</script>";
			echo "<script>window.open('admin.php?suppliers','_self')</script>";
		}else{
			echo "<script>alert('There was a problem while uploading the supplier details. Please ensure you have entered each detail properly!')</script>";
		}

	}
?>
<!--SUPPLIES INPUT MODAL WINDOW-->
	<div class="modal fade" id="supplies">
		<div class="modal-dialog modal-lg">
		<form method="POST" action="admin.php?suppliers">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Add a supply</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Select product supplied </label>
								<select name="supplier" class="form-control">
									<?php
										$q = "SELECT * FROM suppliers";
										$rQ = mysqli_query($con, $q);
										while($row=mysqli_fetch_array($rQ)){
											$id = $row['supplier_id'];
											$product = $row['product'];
											echo "<option value='$id'>$product</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Enter amount</label>
								<input type="text" name="amount" class="form-control" placeholder="Enter total amount" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" name="save" class="btn btn-primary" value="Save" />
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
		</fom>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['save'])){
			$supplier = $_POST['supplier'];
			$amount = $_POST['amount'];
			$q = "INSERT INTO supplies (suplier_id,amount,supplies_date) VALUES ('$supplier','$amount',now())";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo "<script>alert('You have successfully added a supply!')</script>";
				echo "<script>window.open('admin.php?suppliers','_self')</script>";
			}else{
				echo "<script>alert('There was a problem while uploading the supply. Please ensure you have entered each detail properly!')</script>";
			}
		}
	?>
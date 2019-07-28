<?php
if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
	$qu = "SELECT * FROM  accounts";
	$rQu = mysqli_query($con, $qu);
?>
<div class="row">
	<div class="col-lg-12 col-md-12">

		<div style="padding:5px; margin:5px;">
			<input type="button" class="btn btn-primary" value="Add accounts" data-toggle="modal" data-target="#type" disabled="disabled"/>
			<input type="button" class="btn btn-primary" value="Add account type" data-toggle="modal" data-target="#name"/>
			<input type="button" class="btn btn-primary" value="Add a transaction" data-toggle="modal" data-target="#transaction"/>
		</div>
<!--ACCOUNTS TABS-->
			<div id="accounts_tabs">
				<ul>
					<li><a href="#types">Accounts</a></li>
					<li><a href="#names">Account types</a></li>
					<li><a href="#details">Summary of transactions</a></li>
					<li><a href="#transactions">Transactions</a></li>
				</ul>
<!--ACCOUNTS TYPES SECTION-->
				<div id="types">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Delete</th>
							</tr>
					<?php
						$i = 0;
						while($row=mysqli_fetch_array($rQu)){
							$i++;
							$id = $row['acc_id'];
							$name = $row['acc_name'];
							echo"
								<tr>
									<th>$i</th>
									<th>$name</th>
									<th><input type='submit' value='Delete' class='btn btn-danger btn-sm acc_delete' id='$id' disabled='disabled'/></th>
								</tr>
							"; 
						}
					?>
						</table>
					</div>
					<?php } ?>
				</div>
<!--ACCOUNTS NAMES LIST SECTION-->
				<div id="names">
					<?php include("accounts_names2.php"); ?>
				</div>
<!--ACCOUNTS DETAILS SECTION-->
				<div id="details">
					<?php include("accounts_names.php"); ?>
				</div>
<!--ACCOUNTS TRANSACTIONS SECTION-->
				<div id="transactions">
					<a href="transaction_pdf.php" target="_blank"><input type="button" value="Print" class="btn btn-warning" /></a>
					<?php include("transactions.php") ?>
				</div>
			</div>
			<!--ACCOUNTS INPUT-->
			<div class="modal fade" id="type">
				<div class="modal-dialog modal-lg" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title">Add account type</h3>
						</div>
						<div class="modal-body">
							<form action="admin.php?accounts" method="POST">
								<div class="form-group">
									<label>Account name</label>
									<input type="text" name="account_type" class="form-control" placeholder="Enter new account type" /><br />
									<input type="submit" name="submit" class="btn btn-primary" value="Save" />
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php
				if(isset($_POST['submit'])){
					$acc_name = mysqli_real_escape_string($con, $_POST['account_type']);
					$s = "INSERT INTO accounts (acc_name) values('$acc_name')";
					$rS = mysqli_query($con, $s);
					if($rS){
						echo "<script>alert('You have successfully added an account type!')</script>";
						echo "<script>window.open('admin.php?accounts','_self')</script>";
					}else{
						echo "<script>alert('There was an error saving the account. Please try again!')</script>";
					}
				}
			?>
			<!--ACCOUNT NAME INPUT-->
			<div class="modal fade" id="name">
				<div class="modal-dialog modal-lg" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title">Add account name</h3>
						</div>
						<div class="modal-body">
							<form action="admin.php?accounts" method="POST">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Select account type</label>
										<select name="account_type" class="form-control">
											<?php
												$q = "SELECT * FROM accounts";
												$rq = mysqli_query($con, $q);
												while($row=mysqli_fetch_array($rq)){
													$id = $row['acc_id'];
													$name = $row['acc_name'];
													echo"
														<option value='$id'>$name</option>
													";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Account name</label>
											<input type="text" name="account_name" class="form-control" placeholder="Enter new account name" /><br />
											<input type="submit" name="add" class="btn btn-primary" value="Save" />
										</div>
									</form>
								</div>
							</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php
				if(isset($_POST['add'])){
					$acc_type = mysqli_real_escape_string($con, $_POST['account_type']);
					$acc_name = mysqli_real_escape_string($con, $_POST['account_name']);
					$s = "INSERT INTO account_name (acc_id,acn_name) values('$acc_type','$acc_name')";
					$rS = mysqli_query($con, $s);
					if($rS){
						echo "<script>alert('You have successfully added an account name!')</script>";
						echo "<script>window.open('admin.php?accounts','_self')</script>";
					}else{
						echo "<script>alert('There was an error saving the account. Please try again!')</script>";
					}
				}
			?>
			<!--ACCOUNT TRANSACTION INPUT-->
			<div class="modal fade" id="transaction">
				<div class="modal-dialog modal-lg" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title">Add a transaction</h3>
						</div>
						<div class="modal-body">
							<form action="admin.php?accounts" method="POST">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Select account type</label>
										<select name="account_title" id="account_title" class="form-control">
											<option class="default">----Please select an account title---</option>
											<?php
												$query = "SELECT * FROM account_name";
												$runquery = mysqli_query($con, $query);
												while($row=mysqli_fetch_array($runquery)){
													$acn_id = $row['acn_id'];
													$name = $row['acn_name'];
													echo"
														<option value='$name'>$name</option>
													";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Description</label>
											<input type="text" name="description" class="form-control" placeholder="Enter some description" />
										</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<label>Amount</label>
									<input type="text" name="amount" class="form-control" placeholder="Enter amount" /><br />
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label></label>
										<select name="account_type" id="account_type" class="form-control" disabled="disabled">
											<?php
												/*$q = "SELECT * FROM accounts";
												$rq = mysqli_query($con, $q);
												while($row=mysqli_fetch_array($rq)){
													$id = $row['acc_id'];
													$name = $row['acc_name'];
													echo"
														<option value='$id'>$name</option>
													";
												}*/
											?>
										</select>
									</div>
							</div>
							<input type="submit" name="transact" class="btn btn-primary" value="Save" />
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php
				if(isset($_POST['transact'])){
					$acc_name = mysqli_real_escape_string($con, $_POST['account_title']);
					$description = mysqli_real_escape_string($con, $_POST['description']);
					$amount = mysqli_real_escape_string($con, $_POST['amount']);
					$acc_id = mysqli_real_escape_string($con, $_POST['account_type']);
					$s = "INSERT INTO transactions (account_name,Description,amount,acc_id,tra_date) values('$acc_name','$description','$amount','$acc_id',now())";
					$rS = mysqli_query($con, $s);
					if($rS){
						echo "<script>alert('You have successfully made a transaction!')</script>";
						echo "<script>window.open('admin.php?accounts','_self')</script>";
					}else{
						echo "<script>alert('There was an error saving the account. Please try again!')</script>";
					}
				}
			?>
	</div>
</div>
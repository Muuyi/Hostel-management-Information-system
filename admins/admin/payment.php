<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
	if(isset($_POST['submit'])){
		$idNo = $_POST['id'];
		$amount = $_POST['amount'];
		$yr = $_POST['yr'];
		$month = $_POST['month'];
		$getId = "SELECT * FROM clients WHERE Client_IDNo = '$idNo'";
		$runId = mysqli_query($con, $getId);
		$count = mysqli_num_rows($runId);
		if($count > 0){
			$q2 = "SELECT * FROM clients WHERE Client_IDNo='$idNo'";
			$rQ2 = mysqli_query($con, $q2);
			while($row=mysqli_fetch_array($rQ2)){
				$catId = $row['rm_cat'];
			}
			$q3 = "SELECT * FROM category WHERE cat_id='$catId'";
			$rQ3 = mysqli_query($con, $q3);
			while($row=mysqli_fetch_array($rQ3)){
				$rmAmount = $row['room_price'];
			}
			$bal = $rmAmount - $amount;
			if($bal > 0){
				$sql1 = "INSERT INTO payment (year,month,Client_IDNo,amount,day) values ('$yr','$month','$idNo','$amount',now())";
				$sql2 = "INSERT INTO balances (Client_IDNo,balance,bal_date)VALUES('$idNo','$bal',now())";
				$runSql1 = mysqli_query($con, $sql1);
				$runSql2 = mysqli_query($con, $sql2);
					if($runSql1 && $runSql2){
						echo "<script>alert('You have successfully made a payment and you have some balance remaining')</script>";
						echo "<script>window.open('admin.php?payment','_self')</script>";
					}else{
						echo "<script>alert('There was a problem entering the payment.Please try again!')</script>";
					}
			}else{
				$sql = "INSERT INTO payment (year,month,Client_IDNo,amount,day) values ('$yr','$month','$idNo','$amount',now())";
				$runSql = mysqli_query($con, $sql);
					if($runSql){
						$qu = "SELECT sum(amount) FROM payment";
						$Rqu = mysqli_query($con, $qu);
						$q2 = "UPDATE transactions SET amount='$Rqu' WHERE account_name='Rent'";
						$Rq2 = mysqli_query($con, $q2);
						echo "<script>alert('You have successfully made a complete payment of your rent!')</script>";
						echo "<script>window.open('admin.php?payment','_self')</script>";
					}else{
						echo "<script>alert('There was a problem entering the payment.Please try again!')</script>";
					}
			}
			
		}else{
			echo "<script>alert('The client with the ID Number does not exist. Please check to ensure that you have entered the correct ID no!')</script>";
		}
		
	}
?>
<div class="row">
	<div class="col-lg-12 col-md-12" />
		<div id="title" style=" margin:10px;">
			<input type="submit" value="Make payment" class="btn btn-primary" data-toggle="modal" data-target="#pay"/>
		</div>
		<!--DISPLAYING STUDENTS PAYMENT DETAILS-->
		<div id="payment_tabs">
			<ul>
				<li><a href="#paysect">Payment details</a></li>
				<li><a href="#balances">Balances</a></li>
			</ul>
			<div id="paysect">
				<a href="payment_pdf.php" target="_blank"><input type="button" value="Print" class="btn btn-warning" /></a>
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>ID No</th>
							<th>Amount</th>
							<th>Date</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
						<tr>
							<?php
								$q = "SELECT * FROM payment ORDER BY day DESC";
								$runQ = mysqli_query($con, $q);
								$i = 0;
								while($row = mysqli_fetch_array($runQ)){
									$i++;
									$id = $row['p_id'];
									$idno = $row['Client_IDNo'];
									$amount = $row['amount'];
									$date = $row['day'];
									echo"
										<tr>
											<th>$i</th>
											<th>$idno</th>
											<th>$amount</th>
											<th>$date</th>
											<th><input type='submit' class='btn btn-primary btn-xs pedit' id='$id' value='Edit'/></th>
											<th><input type='submit' class='btn btn-danger btn-xs pdelete' id='$id' value='Delete'/></th>
										</tr>
									";
								}
							?>
						</tr>
					</table>
				</div>
			</div>
			<div id="balances">
				<?php include_once("balances.php") ?>
			</div>
		</div>
		<!--Payment modal window-->
		<div class="modal fade" id="pay">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Payment</h3>
					</div>
		<form method="POST" action="admin.php?payment">
					<div class="modal-body">
						<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="full-name">Client's ID NO</label>
											<input type="text" name="id" id="id" class="form-control" placeholder="Enter clients ID No"  required/>
											<span id="payment"></span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="full-names">Amount(Kshs.)</label>
											<input type="text" name="amount" id="amount" class="form-control" placeholder="Enter an amount in Kshs."  required/>
									</div>
								</div>
						</div>
					
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
											<label for="full-name">Select year</label>
												<select name="yr" class="form-control">
												<?php
													$sql = "SELECT * FROM year ORDER BY yr DESC";
													$runSql = mysqli_query($con, $sql);
													while($row = mysqli_fetch_array($runSql)){
														$yrId = $row['yr_id'];
														$yr = $row['yr'];
														echo "<option value='$yrId'>$yr</option>";
													}
												?>
												
												</select>
												<div id="fnameresponse"></div>
								</div>
							</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label for="full-name">Select a month</label>
												<select name="month" class="form-control">
												<?php
													$sql = "SELECT * FROM month";
													$runSql = mysqli_query($con, $sql);
													while($row = mysqli_fetch_array($runSql)){
														$mId = $row['m_id'];
														$mName = $row['m_name'];
														echo "<option value='$mId'>$mName</option>";
													}
												?>
												
												</select>
												<div id="fnameresponse"></div>
										</div>
									</div>
						</div>
						<div class="row">
							<div class="form-group">
								<input type="submit" name="submit" value="Submit" class="btn btn-primary form-control" />  
							</div>
						</div>
		</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php } ?>
<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
<?php
	if(isset($_POST['submit'])){
		$idNo = $_POST['id'];
		$amount = $_POST['amount'];
		$yr = date('Y');
		$month = date('F');
		$hostel = $_SESSION['hostel'];
		$getId = "SELECT * FROM clients WHERE id_no = '$idNo' AND host_id='".$_SESSION['hostel']."'";
		$runId = mysqli_query($con, $getId);
		$count = mysqli_num_rows($runId);
		if($count > 0){
			$q2 = "SELECT * FROM room_numbers AS room  INNER JOIN clients AS hostel ON  room.rm_id=hostel.rm_id WHERE id_no=".$idNo." AND room.host_id='".$_SESSION['hostel']."'";
			$rQ2 = mysqli_query($con, $q2);
			$row = mysqli_fetch_array($rQ2);
			$rm = $row['rm_no'];
			//echo 'You have'.$rm;
			$room_amount = $row['rm_amount'];
			echo $room_amount;
			if($rm == ''){
				//echo "<script>alert('".$rm."')</script>";
				echo "<script>alert('The client has not been allocated a room! Please go to the client section and edit the client details!')</script>";
			}else{
				$bal = $room_amount - $amount;
				if($bal > 0){
					$sql = "INSERT INTO payment (year,month,id_no,amount,host_id,day) values ('$yr','$month','$idNo','$amount','$hostel',now());";
					$sql .= "INSERT INTO balances (yr,month,id_no,balance,host_id,bal_date)VALUES('$yr','$month','$idNo','$bal','$hostel',now())";
					$runSql = mysqli_multi_query($con, $sql);
						if($sql){
							echo "<script>alert('You have successfully made a payment and you have a balance of Kshs.".$bal."')</script>";
							echo "<script>window.open('admin.php?payment','_self')</script>";
						}else{
							echo "<script>alert('There was a problem entering the payment.Please try again!')</script>";
						}
				}else{
					$sql = "INSERT INTO payment (year,month,id_no,amount,host_id,day) values ('$yr','$month','$idNo','$amount','$hostel',now())";
					$runSql = mysqli_query($con, $sql);
						if($runSql){
							/*$qu = "SELECT sum(amount) FROM payment";
							$Rqu = mysqli_query($con, $qu);
							$q2 = "UPDATE transactions SET amount='$Rqu' WHERE account_name='Rent'";
							$Rq2 = mysqli_query($con, $q2);*/
							echo "<script>alert('You have successfully made a complete payment of your rent!')</script>";
							echo "<script>window.open('admin.php?payment','_self')</script>";
						}else{
							echo "<script>alert('There was a problem entering the payment.Please try again!')</script>";
						}
				}
			}
		}else{
			echo "<script>alert('The client with the ID Number does not exist. Please check to ensure that you have entered the correct ID no!')</script>";
		}
		
	}
?>
<div class="row">
	<div class="col" />
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
					<table id="clients_payment_table" class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th>Name</th>
								<th>ID No</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<!--
						<tr>
							<?php
								/*$q = "SELECT * FROM payment ORDER BY day DESC";
								$runQ = mysqli_query($con, $q);
								$i = 0;
								while($row = mysqli_fetch_array($runQ)){
									$i++;
									$id = $row['p_id'];
									$idno = $row['id_no'];
									$amount = $row['amount'];
									$date = $row['day'];
									echo"
										<tr>
											<th>$i</th>
											<th>$idno</th>
											<th>$amount</th>
											<th>$date</th>
											<th><input type='submit' class='btn btn-primary btn-xs pedit' id='".$id."' value='Edit'/></th>
											<th><input type='submit' class='btn btn-danger btn-xs pdelete' id='$id' value='Delete'/></th>
										</tr>
									";
								}*/
							?>
						</tr>-->
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
						<h3 class="modal-title">Payment</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
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
											<input type="text" name="amount" id="amount" class="form-control" placeholder="Enter an amount in Kshs." onblur="ValidateNumerals('amount',2,6,'amount_response')" required/>
											<div id="amount_response"></div>
									</div>
								</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<input type="submit" name="submit" id="submit_payments" value="Submit" class="btn btn-primary form-control" />  
								</div>
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
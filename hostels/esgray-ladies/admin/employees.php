<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div style="padding:5px;">
			<input type="button" value="Add employee" class="btn btn-primary" data-toggle="modal" data-target="#employees"/>
			<a href="employee_pdf.php" target="_blank"><button class="btn btn-warning">Print</button></a>
			<input type="button" value="Salary payment" class="btn btn-primary" data-toggle="modal" data-target="#salaries"/>
		</div>
		<div id="employees_tab">
			<div class="table-responsive">
				<ul>
					<li><a href="#employee_details">Employee details</a></li>
					<li><a href="#salary_details">Salary details</a></li>
				</ul>
				<div id="employee_details">
					<table class="table table-bordered table-striped">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Passport</th>
							<th>ID No</th>
							<th>Phone No</th>
							<th>Email</th>
							<th>Salary</th>
							<th>Reg date</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
						<?php
							$qu = "SELECT * FROM employees";
							$rQu = mysqli_query($con, $qu);
							$i = 0;
							while($row = mysqli_fetch_array($rQu)){
								$i++;
								echo'
									<tr>
										<td>'.$i.'</td>
										<td>'.$row['emp_fname'].' '.$row['emp_lname'].'</td>
										<td></td>
										<td>'.$row['emp_idno'].'</td>
										<td>'.$row['emp_phone'].'</td>
										<td>'.$row['emp_email'].'</td>
										<td>'.$row['emp_salary'].'</td>
										<td>'.$row['emp_date'].'</td>
										<td><input type="submit" class="btn btn-primary btn-xs" value="Edit" /></td>
										<td><input type="button" class="btn btn-danger btn-xs emp_del" value="Delete" id='.$row['emp_id'].'/></td>
									</tr>
								';
							}
						?>
					</table>
				</div>
<!--EMPLOYEE SALARY DETAILS-->
				<div id="salary_details">
					<?php include_once("employee_sal_det.php"); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="employees">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add employee details</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="admin.php?employees" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>First Name:</label>
								<input type="text" class="form-control" placeholder="Enter employee first name" name="em_fname" required/>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Last Name:</label>
								<input type="text" class="form-control" placeholder="Enter employee last name" name="em_lname" required/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>ID No:</label>
								<input type="number" class="form-control" placeholder="Enter employee's ID No " name="em_id" required/>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Phone No:</label>
								<input type="tel" class="form-control" placeholder="Enter employee's phone number" name="em_phone" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Salary:</label>
								<input type="number" class="form-control" placeholder="Enter employee's salary amount " name="em_salary" required/>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Passport photo</label>
								<input type="file" class="form-control"  name="passport" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Email:</label>
								<input type="email" class="form-control" placeholder="Enter employee's email address" name="em_email" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group">
								<input type="submit" class="btn btn-primary form-control" value="Save" name="save" />
							</div>
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
	if(isset($_POST['save'])){
		$fname = $_POST['em_fname'];
		$lname = $_POST['em_lname'];
		$id = $_POST['em_id'];
		$phone = $_POST['em_phone'];
		$salary = $_POST['em_salary'];
		$passport = addslashes(file_get_contents($_FILES['passport']['tmp_name']));
		$email = $_POST['em_email'];
		$q = "INSERT INTO employees (emp_phone,emp_fname,emp_lname,emp_idno,emp_email,emp_salary,emp_passport,emp_date) VALUES('$phone','$fname','$lname','$id','$email','$salary','$passport',now())";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo "<script>alert('You have successfully added an employee!')</script>";
			echo "<script>window.open('admin.php?employees','_self')</script>";
		}else{
			echo (mysqli_error($con));
			echo "<script>alert('There was a problem while uploading the information.Please try again!')</script>";
			//echo "<script>window.open('admin.php?employees','_self')</script>";
		}
	}
?>
<!--SALARY PAYMENT DETAILS-->
<div class="modal fade" id="salaries">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Salary payment</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="admin.php?employees" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Select employee ID No::</label>
								<select name="emp_id" id="employee_id" class="form-control">
									<?php
										$q1 = "SELECT emp_idno, emp_fname FROM employees";
										$rQ1 = mysqli_query($con, $q1);
										while($row1=mysqli_fetch_array($rQ1)){
									?>
									<option value="<?php echo ($row1['emp_idno']) ?>"> <?php echo $row1['emp_idno'].' '."(".$row1['emp_fname'].")" ?> </option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group" id="salary">
								<label>Salary:</label>
								<input type="text" placeholder="Enter employee salary" class="form-control" name="salary"  />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group">
								<input type="submit" class="btn btn-primary form-control" value="Upload salary" name="upload" />
							</div>
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
	if(isset($_POST['upload'])){
		$id = $_POST['emp_id'];
		$amount = $_POST['salary'];
		$q3 = "INSERT INTO salaries (emp_idno,sal_amount,sal_date) VALUES('$id','$amount',now())";
		$rQ3 = mysqli_query($con, $q3);
		if($rQ3){
			echo "<script>alert('You have successfully uploaded an employees salary!')</script>";
			echo "<script>window.open('admin.php?employees','_self')</script>";
		}
	}
?>
<?php } ?>
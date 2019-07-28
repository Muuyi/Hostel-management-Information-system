<?php
	if(!isset($_SESSION['email'])){
		echo "<script>window.open('login.php','_self')</script>";
	}else{
?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div style="padding:5px;">
			<input type="button" value="Add employee" class="btn btn-primary" data-toggle="modal" data-target="#employees"/>
			<a href="pdfs/employees_pdf.php?hst='<?php echo $_SESSION['hostel']?>'" target="_blank"><button class="btn btn-warning">Print</button></a>
			<input type="button" value="Salary payment" class="btn btn-primary" data-toggle="modal" data-target="#salaries"/>
		</div>
		<div id="employees_tab">
				<ul>
					<li><a href="#employee_details">Employee details</a></li>
					<li><a href="#salary_details">Salary details</a></li>
				</ul>
				<div id="employee_details">
					<div class="table-responsive">
						<table id="employees_table" class="table table-bordered table-striped">
							<thead>
								<tr>
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
							</thead>
							<tbody>
							</tbody>
							<?php
							/*	$qu = "SELECT * FROM employees WHERE host_id='".$_SESSION['hostel']."'";
								$rQu = mysqli_query($con, $qu);
								$i = 0;
								while($row = mysqli_fetch_array($rQu)){
									$i++;
									echo'
										<tr>
											<td>'.$i.'</td>
											<td>'.$row['emp_fname'].' '.$row['emp_lname'].'</td>
											<td>';
											if($row['emp_passport'] == ''){
												echo '<img src="images/default.png" width="50px" height="50px" />';
											}else{
												echo '<img src="passports/'.$row['emp_passport'].'" width="50px" height="50px" />';
											}
									echo'</td>
											<td>'.$row['emp_idno'].'</td>
											<td>'.$row['emp_phone'].'</td>
											<td>'.$row['emp_email'].'</td>
											<td>'.$row['emp_salary'].'</td>
											<td>'.$row['emp_date'].'</td>
											<td><input type="submit" id="'.$row['emp_id'].'"class="btn btn-primary btn-xs edit_employees" value="Edit" /></td>
											<td><input type="button" class="btn btn-danger btn-xs emp_del" value="Delete" id='.$row['emp_id'].'/></td>
										</tr>
									';
								}*/
							?>
						</table>
					</div>
				</div>
	<!--EMPLOYEE SALARY DETAILS-->
				<div id="salary_details">
					<?php include_once("employee_sal_det.php"); ?>
				</div>
		</div>
	</div>
</div>
<div class="modal fade" id="employees">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add employee details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div id="employeeresponse">
				</div>
				<div id="employee_image_section">
				</div>
				<form method="POST" action="admin.php?employees" id="employeesform" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>First Name:</label>
								<input type="text" class="form-control" onblur="ValidateSingleName('fname','fnameresponse')" id="fname" placeholder="Enter employee first name" name="em_fname" required/>
								<div id="fnameresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Last Name:</label>
								<input type="text" class="form-control" onblur="ValidateSingleName('lname','lnameresponse')" id="lname" placeholder="Enter employee last name" name="em_lname" required/>
								<div id="lnameresponse"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>ID No:</label>
								<input type="number" onblur="ValidateNumerals('idno',8,8,'idnoresponse')" class="form-control" id="idno" placeholder="Enter employee's ID No " name="em_id" required/>
								<div id="idnoresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Phone No:</label>
								<input type="tel" class="form-control" onblur="ValidateTel('phone','phoneresponse')" id="phone" name="em_phone" />
								<div id="phoneresponse"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Salary:</label>
								<input type="number" class="form-control" id="salary" placeholder="Enter employee's salary amount" onblur="ValidateNumerals('salary',2,6,'salaryresponse')" name="em_salary" required/>
								<div id="salaryresponse"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Email:</label>
								<input type="email" class="form-control" onblur="ValidateEmail('email','emailresponse')" id="email" placeholder="Enter employee's email address" name="em_email" />
								<div id="emailresponse"></div>
							</div>
						</div>
						<input type="hidden" id="employeeid" />
						<input type="hidden" id="btnaction" />
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group">
								<input type="submit" class="btn btn-primary form-control" id="edit_employee" value="Save" name="save" />
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
		$hostel = $_SESSION['hostel'];
		$q = "INSERT INTO employees (emp_phone,emp_fname,emp_lname,emp_idno,emp_email,emp_salary,emp_passport,host_id,emp_date) VALUES('$phone','$fname','$lname','$id','$email','$salary','$passport','$hostel',now())";
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
				<h4 class="modal-title">Salary payment</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="admin.php?employees" id="insert_employees_salary" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label>Select employee ID No::</label>
								<select name="emp_id" id="employee_id_salary" class="form-control">
									<option>Select employee name</option>
									<?php
										$q1 = "SELECT emp_idno, emp_fname FROM employees WHERE host_id='".$_SESSION['hostel']."' ORDER BY emp_fname ASC";
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
								<input type="text" placeholder="Enter employee salary" onblur="ValidateNumerals('employee_salary',2,6,'employeesalaryresponse')" id="employee_salary" class="form-control" name="salary"  />
								<div id="employeesalaryresponse"></div>
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
			echo "<script>alert('You have successfully uploaded an employees salary!');</script>";
			echo "<script>document.getElementById('insert_employees_salary').reset();</script>";
			echo "<script>window.open('admin.php?employees','_self')</script>";
		}
	}
?>
<?php } ?>
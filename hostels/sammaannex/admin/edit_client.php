<?php
//ENSURING THE SESSION IS STARTED BEFORE ACCESSING THIS PAGE
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<?php
//RETRIEVING INFORMATION FROM THE DATABASE
if(isset($_GET['edit_client'])){
	$getId = $_GET['edit_client'];
	$getClient = "SELECT * FROM clients where c_id='$getId'";
	$runClient = mysqli_query($con, $getClient);
	$rowClient = mysqli_fetch_array($runClient);
		$clId = $rowClient['c_id'];
		$name = $rowClient['c_name'];
		$phone = $rowClient['c_phone'];
		$passport = $rowClient['c_passport'];
		$identity = $rowClient['c_identity'];
		$institution = $rowClient['c_institution'];
		$pname = $rowClient['c_pname'];
		$pphone = $rowClient['c_pphone'];
		$room = $rowClient['c_room'];
		//Getting categories from the room table and displaying it in the room section
		$getCat = "SELECT * FROM category where cat_id='$room'";
		$runCat = mysqli_query($con, $getCat);
		$rowCat = mysqli_fetch_array($runCat);
		$catTitle = $rowCat['cat_name'];
}
?>
<h1>Edit Your clients</h1><br />
<form action="admin.php?view_clients=<?php echo $clId ?>" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Client's Names</label>
		<input type="text" name="c_name" class="form-control" value="<?php echo $name ?>" />
	</div>
	<div class="form-group">
		<label>Client's phone number</label>
		<input type="text" name="c_number" class="form-control" value="<?php echo $phone ?>"  />
	</div>
	<div class="form-group">
		<label>Client's ID No</label>
		<input type="text" name="c_identity" class="form-control" value="<?php echo $identity ?>"  />
	</div>
	<div class="form-group">
		<label>Client's Institution</label>
		<input type="text" name="c_institution" class="form-control" value="<?php echo $institution ?>"  />
	</div>
	<div class="form-group">
		<label>Parent's/Guardians names</label>
		<input type="text" name="c_pname" class="form-control" value="<?php echo $pname ?>"  />
	</div>
	<div class="form-group">
		<label>Parent's/Guardians phone number</label>
		<input type="text" name="c_pphone" class="form-control" value="<?php echo $pphone ?>"  />
	</div>
	<div class="form-group">
		<label>Client's passport photo</label>
		<input type="file" name="c_passport"/><img src="images/<?php echo $passport ?>" width="50px" height="50px"/>
	</div>
	<div class="form-group">
		<label>Category of room</label>
		<select name="room_cat" class="form-control" style="text-align:center;">
			<option> <?php echo $catTitle ?> </option>
				<?php
				//GETTING GATEGORIES FROM THE DATABASE AND DISPLAYING ON THE CLIENTS PAGE
					$get_cats = "select * from category";
					$run_cats = mysqli_query($con, $get_cats);
					while($row_cats=mysqli_fetch_array($run_cats)){
						$cat_id = $row_cats['cat_id'];
						$cat_title = $row_cats['cat_name'];
						echo "<option value='$cat_id'>$cat_title</option>";
					}
				?>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" name="update" class="form-control" id="AdminSubmit" value="Edit Client"/>
	</div>
</form>
	<?php } ?>
	<?php
	//UPDATING THE INFORMATION AND POSTING IT TO THE DATABASE
	if(isset($_POST['update'])){
		$clientId = $_GET['view_clients'];
		$c_name = $_POST['c_name'];
		$c_number = $_POST['c_number'];
		$c_id = $_POST['c_identiy'];
		$c_institution = $_POST['c_institution'];
		$c_pname = $_POST['c_pname'];
		$c_pphone = $_POST['c_pphone'];
		$room_cat = $_POST['room_cat'];
		//UPLOADING THE IMAGE
		$c_passport = $_FILES['c_passport']['name'];
		$tmp_name = $_FILES['c_passport']['tmp_name'];
		move_uploaded_file($tmp_name,"images/$c_passport");
		
		$updateClients = "UPDATE clients set c_name='$c_name', c_phone='$c_number', c_passport='$c_passport', c_identity='$c_id', c_institution='$c_institution', c_pname='$c_pname', c_pphone='$c_pphone', c_room='$room_cat' WHERE c_id='$clientId'";
		$updateC = mysqli_query($con, $updateClients);
		if($updateC){
			echo "<script>alert('You have successfully updated your client')</script>";
			echo "<script>window.open('admin.php?view_clients','_self')</script>";
			}
		}
		

?>
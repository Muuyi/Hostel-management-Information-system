<div class="article">
	<center><h1>Add a movie</h1></center>
	<form action="admin.php?add_movie" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label>Select a type</label>
					<select name="mov_type" class="form-control" style="text-align:center;" id="roomCat">
						<option value="default">------------Select a type-------------</option>
						<?php
							require_once("db.php");
							$select = "SELECT * FROM type";
							$runSelect = mysqli_query($con, $select);
							while($rowSelect = mysqli_fetch_array($runSelect)){
								$catId = $rowSelect['t_id'];
								$catName = $rowSelect['t_name'];
								echo "<option value='$catId'> $catName </option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label>Select a genre</label>
						<select name="mov_cat" class="form-control" style="text-align:center;" id="roomCat">
							<option value="default">------------Select a category-------------</option>
								<?php
									require_once("db.php");
									$select = "SELECT * FROM categories";
									$runSelect = mysqli_query($con, $select);
									while($rowSelect = mysqli_fetch_array($runSelect)){
										$catId = $rowSelect['cat_id'];
										$catName = $rowSelect['cat_name'];
										echo "<option value='$catId'> $catName </option>";
									}
								?>
						</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Movie name</label>
			<input type="text" class="form-control" name="movname" id="movName" placeholder="Enter the movie name"/>
			<div id="movAvail"></div>
		</div>
		<div class="form-group">
			<label>Yr of production</label>
			<input type="text" class="form-control" name="yr" placeholder="Enter the year of production" />
		</div>
		<div class="form-group">
			<label>Total no of seasons</label>
			<input type="text" class="form-control" name="ttlseasons" placeholder="Enter the total number of seasons available"/>
		</div>
		<div class="form-group">
			<label>Seasons availavle</label>
			<input type="text" class="form-control" name="availseasons" placeholder="Enter the seasons available" />
		</div>
		<div class="form-group">
			<label>Main characters</label>
			<input type="text" class="form-control" name="maincharacters" placeholder="Enter the main characters"/>
		</div>
		<div class="form-group">
			<input type="submit" value="Submit" name="submit" class="btn btn-primary form-control" />
		</div>
	</form>
</div>
<?php
	if(isset($_POST['submit'])){
		$movName = mysqli_real_escape_string($con, $_POST['movname']);
		$yr = mysqli_real_escape_string($con, $_POST['yr']);
		$ttlseasons = mysqli_real_escape_string($con, $_POST['ttlseasons']);
		$availseasons = mysqli_real_escape_string($con, $_POST['availseasons']);
		$maincharacters = mysqli_real_escape_string($con, $_POST['maincharacters']);
		$mov_cat = mysqli_real_escape_string($con, $_POST['mov_cat']);
		$mov_type = mysqli_real_escape_string($con, $_POST['mov_type']);
		$insert = "insert into movies (mov_name, yr_produced, no_seasons, seasons_available, main_character, category,t_id) values('$movName','$yr','$ttlseasons','$availseasons','$maincharacters','$mov_cat','$mov_type')";
		$runInsert = mysqli_query($con, $insert);
		if($runInsert){
			echo "<script>alert('You have successfully uploaded a movie!')</script>";
			echo "<script>window.open('admin.php?add_movie', '_self')</script>";
		}else{
			echo "<script>alert('Upload failed!Please try again!')";
			echo "<script>window.open('admin.php?add_movie', '_self')</script>";
		}
	}
?>
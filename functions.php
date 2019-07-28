
<?php
	//CONNECTING TO THE DATABASE
	$con = mysqli_connect("localhost","root","","hostels");
	//GETTING THE CATEGORIES FROM THE DATABASE AND DISPLAYING IT ON THE INDEX PAGE
	function getCat(){
		global $con;
		$get_cats = "SELECT * FROM categories";
		$run_cat = mysqli_query($con, $get_cats);
		while($row_cats = mysqli_fetch_array($run_cat)){
			$cat_id = $row_cats['cat_id'];
			$cat_title = $row_cats['cat_name'];
			echo "<li class='nav-item'><a class='nav-link' href='index.php?cat=$cat_id'>$cat_title</a></li>";
		}
	}
	//DIPLAYING THE HOSTELS ON THE INDEX PAGE
	function getHost(){
		global $con;
		if(isset($_GET['cat'])){
			$cat_id = $_GET['cat'];
			$get_host = "SELECT * FROM hostels  where host_cat=$cat_id ORDER BY host_id DESC";
		}else{
			$get_host = "SELECT * FROM hostels ORDER BY host_id DESC";
		}
		$run_host = mysqli_query($con, $get_host);
		$count_host = mysqli_num_rows($run_host);
		if($count_host==0){
			echo "<div class='alert alert-danger'>We are sorry for the inconvenience.Currently this category is unavailable! It will be updated very soon!</div>";
		}else{
			while($row_host = mysqli_fetch_array($run_host)){
				$host_id = $row_host['host_id'];
				$host_cat = $row_host['host_cat'];
				$host_loc = $row_host['location'];
				$host_name = $row_host['host_name'];
				$host_link = $row_host['hostel_link'];
				$contact1 = $row_host['contact1']; 
				$contact2 = $row_host['contact2']; 
				$host_image = $row_host['host_image']; 
				echo "
						<div id='hostels' class='col-lg-3 col-md-4 col-sm-4 col-6'>
							<div class='card border-secondary mb-3'>
								<a href='hostels/$host_link' target='_blank' title='Click here to visit the hostels website'>
									<img class='image' src='system_admin/images/$host_image' width='100%' />
									<p class='card-title'>$host_name </p>
									<p class='card-title'>$host_loc </p>
								</a>
							</div>

						</div>
								";
					
			}
		}
		
	}
?>
<?php
	include ("db.php");
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//DISPLAYING CLIENTS INFORMATION
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function GetClientsInfo(){
	global $con;
	$i=0;
	if(isset($_GET['check_in'])){
		$get_client = "SELECT * FROM (((hostel_client_list INNER JOIN clients ON hostel_client_list.id_no=clients.id_no)INNER JOIN universities ON universities.uni_id=clients.uni_id) LEFT JOIN room_numbers ON hostel_client_list.rm_id=room_numbers.rm_id) WHERE hostel_client_list.host_id='".$_SESSION['hostel']."' AND status='in'";
	}else if(isset($_GET['check_out'])){
		$get_client = "SELECT * FROM (((hostel_client_list INNER JOIN clients ON hostel_client_list.id_no=clients.id_no)INNER JOIN universities ON universities.uni_id=clients.uni_id) LEFT JOIN room_numbers ON hostel_client_list.rm_id=room_numbers.rm_id) WHERE hostel_client_list.host_id='".$_SESSION['hostel']."' AND status='out'";
	}else{
		$get_client = "SELECT * FROM (((hostel_client_list INNER JOIN clients ON hostel_client_list.id_no=clients.id_no)INNER JOIN universities ON universities.uni_id=clients.uni_id) LEFT JOIN room_numbers ON hostel_client_list.rm_id=room_numbers.rm_id) WHERE hostel_client_list.host_id='".$_SESSION['hostel']."'";
	}
	$run_client = mysqli_query($con, $get_client);
	echo mysqli_error($con);
	while($row_client = mysqli_fetch_array($run_client)){
		$host_list_id = $row_client['list_id'];
		$cId = $row_client['cl_id'];
		$c_fname = $row_client['fname'];
		$c_lname = $row_client['lname'];
		$c_phone = $row_client['phone'];
		$c_room = $row_client['rm_no'];
		$c_identity = $row_client['id_no'];
		$c_date = $row_client['join_date'];
		$c_passport = $row_client['passport'];
		$status = $row_client['status'];
		$i++;
		echo '<tr>
				<td>'.$i.'</td>
				<td>
					'.$c_fname.' '.$c_lname.'<br />
					<input type="button" value="More details" name="view" id="'.$c_identity.'" class="btn btn-success btn-xs view_data">
				</td>
				<td>';
						if($c_passport == ''){
							echo "<img src='images/default.png' width='50px' height='50px' style='border:2px solid #000000;'";
						}else{
							echo '<img src="passports/'.($c_passport).'" width="50px" height="50px" style="border:2px solid #000000; margin:2px;" />'; 
						}
						
		echo '</td>
				<td>'.$c_phone.'</td>
				<td>'.$c_room.'</td>
				<td>'.$row_client['uni_name'].'</td>
				<td>'.$c_identity.'</td>
				<td>';
						 if($status =='in'){
								echo "<div id='cCheck'><input type='button' value='Check out' name='check' id='".$c_identity."' class='btn btn-success btn-sm check'></div>";
							}else {
								echo "<div id='cCheck'><input type='button' value='Check in' name='check' id='".$c_identity."' class='btn btn-danger btn-sm check'></div>";
								}
		echo 	"</td>
				<td><input type='button' value='Edit'  id= '".$cId."' data-hostellist='".$host_list_id."' class='btn btn-primary btn-sm client_edit' /></td>
				<td><input type='button' value='Delete' name='delete' id='".$c_identity."' class='btn btn-danger btn-sm delete'></td>
			</tr>";
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//GETTING THE ROOMS CATEGORY LIST
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function GetRoomCategories(){
	global $con;
	$get_cats = "SELECT * FROM room_category";
	$run_cats = mysqli_query($con, $get_cats);
	while($row_cats=mysqli_fetch_array($run_cats)){
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_name'];
		echo "<option value='$cat_id'>$cat_title</option>";
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//TWO SHARING AVAILABLE ROOMS
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getTwo(){
		global $con;
		$get_two = "select * from clients where rm_cat=2";
		$run_two = mysqli_query($con, $get_two);
		$two = mysqli_num_rows($run_two);
		if($two < 36){
			echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" >Book now</button><br />';
			echo "<i style='color:#006400; font-weight:bolder;'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000; font-weight:bolder;'>No room available</i>";
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	//FOUR SHARING AVAILABLE ROOMS
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getFour(){
		global $con;
		$get_four = "select * from clients where rm_cat=4";
		$run_four = mysqli_query($con, $get_four);
		$four = mysqli_num_rows($run_four);
		if($four < 20){
			echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" >Book now</button><br />';
			echo "<i style='color:#006400; font-weight:bolder;'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000; font-weight:bolder;'>No room available</i>";
		}
	}
/*////////////////////////////////////////////////////////////////////////////////////////////////////////
	//SIX SHARING AVAILABLE ROOMS
/////////////////////////////////////////////////////////////////////////////////////////////////////////*/
	function getSix(){
		global $con;
		$get_six = "select * from clients where rm_cat=6";
		$run_six = mysqli_query($con, $get_six);
		$six = mysqli_num_rows($run_six);
		if($six < 12){
			echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" >Book now</button><br />';
			echo "<i style='color:#006400; font-weight:bolder;'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000; font-weight:bolder;'>No room available</i>";
		}
	}
	//EIGHT SHARING AVAILABLE ROOMS
	function getEight(){
		global $con;
		$get_eight = "select * from clients where rm_cat=8";
		$run_eight = mysqli_query($con, $get_eight);
		$eight = mysqli_num_rows($run_eight);
		if($eight < 16){
			echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" >Book now</button><br />';
			echo "<i style='color:#006400; font-weight:bolder;'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000; font-weight:bolder;'>No room available</i>";
		}
	}
	//TEN SHARING AVAILABLE ROOMS
	function getTen(){
		global $con;
		$get_eight = "select * from clients where rm_cat=10";
		$run_eight = mysqli_query($con, $get_eight);
		$eight = mysqli_num_rows($run_eight);
		if($eight < 10){
			echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" >Book now</button><br />';
			echo "<i style='color:#006400; font-weight:bolder;'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000; font-weight:bolder;'>No room available</i>";
		}
	}
/*///////////////////////////////////////////////////////////////////////////////////////////////////////////
//DISPLAYING THE VACANCIES IN THE VACANCY SECTION
////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
	function getVacance(){
		global $con;
		$get_vacance = "select * from vacance";
		$run_vacance = mysqli_query($con, $get_vacance);
		while($row_vacance = mysqli_fetch_array($run_vacance)){
			$vaca_id = $row_vacance['vaca_id'];
			$vaca_title = $row_vacance['vaca_title'];
			$vaca_details = $row_vacance['vaca_details'];
			$vaca_date = $row_vacance['vaca_date'];
			echo "<div style='width:90%; background-color:#D3D3D3; margin:10px; padding:20px;'>
				<b>$vaca_title</b> <br />
				$vaca_details<br />
				<i><b>It was posted on: $vaca_date</b></i>
			</div>";
		}
	}
/*//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////CHECKIN IN AND OUT OF STUDENTS
//////////////////////////////////////////////////////////////////////////////////////////////////////*/

/*////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////RECEIPT PRINTING
////////////////////////////////////////////////////////////////////////////////////////////////////////*/
function receipt(){
	global $con ;
	$get_client = "select * from clients";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
			$cId = $row_client['Id'];
	echo "<form action='receipt.php?clientId=$cId' method='POST' enctype='multipart/form-data'>
				<button name='print' class='btn btn-primary'>print</button>
		</form>"; 
}
/*////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////CLIENTS EDITING PAGE IN THE MODAL WINDOW
////////////////////////////////////////////////////////////////////////////////////////////////////////*/
?>
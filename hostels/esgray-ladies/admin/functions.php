<?php
	include ("db.php");
	
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
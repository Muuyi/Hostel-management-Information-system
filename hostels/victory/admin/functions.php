<?php
	include ("db.php");
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	//ONE SHARING AVAILABLE ROOMS
/////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getOne(){
		global $con;
		$get_one = "select * from clients where c_room=1";
		$run_one = mysqli_query($con, $get_one);
		$one = mysqli_num_rows($run_one);
		if($one < 1){
			echo "<i style='color:#006400'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000'>No room available</i>";
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//TWO SHARING AVAILABLE ROOMS
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getTwo(){
		global $con;
		$get_two = "select * from clients where c_room=2";
		$run_two = mysqli_query($con, $get_two);
		$two = mysqli_num_rows($run_two);
		if($two < 36){
			echo "<i style='color:#006400'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000'>No room available</i>";
		}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	//FOUR SHARING AVAILABLE ROOMS
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getFour(){
		global $con;
		$get_four = "select * from clients where c_room=4";
		$run_four = mysqli_query($con, $get_four);
		$four = mysqli_num_rows($run_four);
		if($four < 36){
			echo "<i style='color:#006400'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000'>No room available</i>";
		}
	}
/*////////////////////////////////////////////////////////////////////////////////////////////////////////
	//SIX SHARING AVAILABLE ROOMS
/////////////////////////////////////////////////////////////////////////////////////////////////////////*/
	function getSix(){
		global $con;
		$get_six = "select * from clients where c_room=6";
		$run_six = mysqli_query($con, $get_six);
		$six = mysqli_num_rows($run_six);
		if($six < 72){
			echo "<i style='color:#006400'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000'>No room available</i>";
		}
	}
	//EIGHT SHARING AVAILABLE ROOMS
	function getEight(){
		global $con;
		$get_eight = "select * from clients where c_room=8";
		$run_eight = mysqli_query($con, $get_eight);
		$eight = mysqli_num_rows($run_eight);
		if($eight < 80){
			echo "<i style='color:#006400'>Room available</i>";
		}else{
			echo "<i style='color:#ff0000'>No room available</i>";
		}
	}
/*/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//DISPLAYING MESSAGES TO THE ADMIN PAGE
/////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
	function getMessage(){
		global $con;
		$get_message = "select * from messages";
		$run_mes = mysqli_query($con, $get_message);
		while($row_mes = mysqli_fetch_array($run_mes)){
			$mes_id = $row_mes['mes_id'];
			$mes_name = $row_mes['mes_name'];
			$mes_phone = $row_mes['mes_phone'];
			$message = $row_mes['message'];
			$mes_date = $row_mes['mes_date'];
			echo "<div style=' background-color:#D3D3D3; margin:5px; padding:20px;'>
				<b>From:</b> $mes_name<br />
				<b>Contacts:</b>$mes_phone <br />
				$message<br />
				<b><i>It was sent on: $mes_date</i></b>
			</div>";
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
function check(){
	global $con ;
	global $cId ;
	$get_client = "select * from clients";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
			//$cId = $row_client['c_id'];
			//$c_name = $row_client['c_name'];
			/*$c_phone = $row_client['c_phone'];
			$c_room = $row_client['c_room'];
			$c_identity = $row_client['c_identity'];
			$c_date = $row_client['date'];
			$c_passport = $row_client['c_passport'];*/
			$status = $row_client['status'];
	      if($status =='checkin'){
						echo "
						<form method='post' >
							<button class='btn btn-primary' name='check' id='$cId'>Check out</button>
						</form>
						";
					}else {
						echo "
						<form method='post'>
							<button class='btn btn-danger' name='uncheck' id='$cId'>Check in</button>
						</form>
						";
						}
			//UPDATING THE STATUS USING AJAX IN THE MAIN.JS FILE
			//When the user clicks on check in
			if(isset($_POST['check'])){
				$state = 'checkin';
				$result = "SELECT $status FROM clients where c_id='$cId'";
				$runRe = mysqli_query($con, $result);
				//$row = mysqli_fetch_array($runRe);
				//$state = $row['status'];
				$upDate = ("UPDATE clients SET status='$state' WHERE c_id='$cId'");
				$runUpdate = mysqli_query($con, $upDate);
			}
			//When the user clicks on check out
			if(isset($_POST['uncheck'])){
				$state = 'checkout';
				//$result = "SELECT $status FROM clients where c_id='$cId'";
				//$runRe = mysqli_query($con, $result);
				//$row = mysqli_fetch_array($runRe);
				//$state = $row['status'];
				$upDate = "UPDATE clients SET status='$state' WHERE c_id='$cId'";
				$runUpdate = mysqli_query($con, $upDate);
			}
}
/*////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////RECEIPT PRINTING
////////////////////////////////////////////////////////////////////////////////////////////////////////*/
function receipt(){
	global $con ;
	$get_client = "select * from clients";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
			$cId = $row_client['c_id'];
	echo "<form action='receipt.php?clientId=$cId' method='POST' enctype='multipart/form-data'>
				<button name='print' class='btn btn-primary'>print</button>
		</form>"; 
}
/*////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////CLIENTS EDITING PAGE IN THE MODAL WINDOW
////////////////////////////////////////////////////////////////////////////////////////////////////////*/
?>
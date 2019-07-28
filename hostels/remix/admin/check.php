<?php 
	require_once("db.php");
	if(isset($_POST['clId'])){
		$get_client = "select * from clients";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
		$cId = $row_client['c_id'];
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
			/*if(isset($_POST['check'])){
				$state = 'checkin';
				$result = "SELECT $status FROM clients where c_id='$cId'";
				$runRe = mysqli_query($con, $result);
				//$row = mysqli_fetch_array($runRe);
				//$state = $row['status'];
				$upDate = ("UPDATE clients SET status='$state' WHERE c_id='$cId'");
				$runUpdate = mysqli_query($con, $upDate);
			}
			//When the user clicks on check out
			/*if(isset($_POST['uncheck'])){
				$state = 'checkout';
				//$result = "SELECT $status FROM clients where c_id='$cId'";
				//$runRe = mysqli_query($con, $result);
				//$row = mysqli_fetch_array($runRe);
				//$state = $row['status'];
				$upDate = "UPDATE clients SET status='$state' WHERE c_id='$cId'";
				$runUpdate = mysqli_query($con, $upDate);
			}*/
		}
?>
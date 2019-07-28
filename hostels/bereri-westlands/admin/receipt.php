<?php
	include ("db.php");
		$clId = $_GET['clientId'];
		$get_client = "select * from clients where c_id='$clId'";
		$run_client = mysqli_query($con, $get_client);
		$row_client = mysqli_fetch_array($run_client);
			$i = 0;
			$cId = $row_client['c_id'];
			$c_name = $row_client['c_name'];
			$c_phone = $row_client['c_phone'];
			$c_room = $row_client['c_room'];
			$c_identity = $row_client['c_identity'];
			$c_date = $row_client['date'];
			$c_passport = $row_client['c_passport'];
			$status = $row_client['status'];
			$cInstitution = $row_client['c_institution'];
			$cPname = $row_client['c_pname'];
			$cPhone = $row_client['c_pphone'];
			$amount = $row_client['amount'];
			$i++;
	require '../../fpdf/fpdf.php';
	$pdf = new FPDF('L','mm','A5');
	$pdf -> AddPage();
	$pdf -> SetFont ('Arial','I',10);
	$pdf -> Cell(0,10,"Receipt No:".$i,0,1,'R');
	$pdf -> SetFont ('Arial','B',20);
	$pdf -> Cell(0,10,"MODERN CHRISTIAN LADIES HOSTEL",0,0,'L');
	$pdf -> SetFont ('Arial','I',10);
	$pdf -> Cell(0,10,"Box:000000",0,1,'R');
	$pdf -> Cell(0,10,"Cell:0717110588/0764161662",0,1,'R');
	$pdf -> SetFont ('Arial','BU',15);
	$pdf -> Cell(0,10,"HOSTEL FEE",0,0,'L');
	$pdf -> SetFont ('Arial','BU',15);
	$pdf -> Cell(0,10,"DATE:".date('d-m-y'),0,1,'R');
	$pdf -> SetFont ('Arial','I',10);
	$pdf -> Cell(10,10,"Received from " .$c_name. " the sum of shillings " .$amount. " being payment of " .$c_date,0,0,'L');
	$pdf -> Output();
	
?>
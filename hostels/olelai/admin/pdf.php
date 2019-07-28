<?php
/*
	<th>No</th>
		<th>Client Name</th>
		<th>Passport</th>
		<th>Client Phone</th>
		<th>Client Room</th>
		<th>ID Number</th>
		<th>Payment Date</th>
		<th>Status</th>
		<th>Edit</th>
		<th>Delete</th>
*/
	
	require '../../fpdf/fpdf.php';
	$pdf = new FPDF('L','mm','A4');
	$pdf -> AddPage();
	$pdf -> SetFont ('Arial','B',16);
	$pdf -> Cell(0,10,"MODERN CHRISTIAN LADIES HOSTEL",0,1,'C');
	$pdf -> Cell(0,10,"OUR CLIENTS",0,1,'C');
	$pdf -> Cell(20,10,"NO",1,0,'C');
	$pdf -> Cell(50,10,"CLIENT NAME",1,0,'C');
	$pdf -> Cell(50,10,"PASSPORT",1,0,'C');
	$pdf -> Cell(50,10,"CLIENT PHONE",1,0,'C');
	$pdf -> Cell(50,10,"ID NUMBER",1,0,'C');
	$pdf -> Cell(60,10,"PAYMENT DATE",1,1,'C');
	include ("db.php");
		$i=0;
		$get_client = "select * from clients";
		$run_client = mysqli_query($con, $get_client);
		while($row_client = mysqli_fetch_array($run_client)){
		$i++;
		$pdf -> Cell(20,10,$i,1,0,'C');
		$pdf -> Cell(50,10, $row_client['c_name'],1,0,'C');
		$pdf -> Cell(50,10,"PASSPORT",1,0,'C');
		$pdf -> Cell(50,10,$row_client['c_phone'],1,0,'C');
		$pdf -> Cell(50,10,$row_client['c_identity'],1,0,'C');
		$pdf -> Cell(60,10,$row_client['date'],1,0,'C');
		$pdf -> Output();
		}
?>
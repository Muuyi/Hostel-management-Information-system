<?php	
	require ('../../fpdf/fpdf.php');
	require_once("../db.php");
	//$con = mysqli_connect('localhost','root','','hostels');
	class PDF extends FPDF{
		function Header(){
			$con = mysqli_connect('localhost','root','','hostels');
			$q = "SELECT * FROM hostels WHERE host_id=".$_GET['hst'];
			$rQ = mysqli_query($con, $q);
			$rw = mysqli_fetch_array($rQ);
			$this -> SetFont('Arial','B',15);
			$this -> Cell(12);
			$this -> Cell(0,10,strtoupper($rw['host_name']).' CLIENTS LIST',0,1,"C");
			$this -> SetFont('Arial','',10);
			$this -> Cell(0,5,'Postal address: ',0,1,"C");
			$this -> Cell(0,5,'Email: ',0,1,"C");
			$this -> Cell(0,5,'Call: '.$rw['contact1'].'/'.$rw['contact2'],0,1,"C");
			$this -> Cell(0,10,'Date:'.date('d-m-Y').'',0,1,"R");
			$this -> Ln(5);
			$this -> SetFont('Arial','B',11);
			$this -> SetFIllColor(180,180,255);
			$this -> SetDrawColor(50,50,100);
			$this -> Cell(9,5,'No',1,0,'',true);
			$this -> Cell(35,5,'Name',1,0,'',true);
			$this -> Cell(16,5,'ID NO',1,0,'',true);
			$this -> Cell(20,5,'Phone',1,0,'',true);
			$this -> Cell(35,5,'Email',1,0,'',true);
			$this -> Cell(15,5,'Room',1,0,'',true);
			$this -> Cell(50,5,'Institution',1,1,'',true);
		}
		function Footer(){
			$this -> SetY(-15);
			$this -> SetFont('Arial','',8);
			$this -> Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0, 'C');
		}
	}
	$pdf = new PDF('p','mm','A4');
	$pdf -> AliasNbPages('{pages}');
	$pdf -> AddPage();
	$pdf -> SetFont('Arial','',9);
	$pdf -> SetDrawColor(50,50,100);
	$query = mysqli_query($con, "SELECT * FROM ((clients LEFT OUTER JOIN room_numbers ON clients.rm_id=room_numbers.rm_id) LEFT OUTER JOIN universities ON clients.uni_id=universities.uni_id) WHERE clients.host_id=".$_GET['hst']);
	echo mysqli_error($con);
	$i = 0;
	while($row = mysqli_fetch_array($query)){
		$cellWidth = 40;
		$cellHeight = 5;
		if($pdf->GetStringWidth($row['uni_name']) < $cellWidth){
			$line = 1;
		}else{
			$textLength = strlen($row['uni_name']);
			$errMargin = 10;
			$startChar = 0;
			$maxChar = 0;
			$textArray = array();
			$tmpString = "";
			while($startChar < $textLength){
				while($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar+$maxChar) < $textLength){
					$maxChar++;
					$tmpString = substr($row['uni_name'],$startChar,$maxChar);
					$startChar = $startChar+$maxChar;
					array_push($textArray,$tmpString);
					$maxChar = 0;
					$tmpString = '';
				}
				$line=count($textArray);

			}
		}
		$i++;
		$pdf -> Cell(9,5,$i,1,0);
		$pdf -> Cell(35,5,$row['fname'].' '.$row['lname'],1,0);
		$pdf -> Cell(16,5,$row['id_no'],1,0);
		$pdf -> Cell(20,5,$row['phone'],1,0);
		$pdf -> Cell(35,5,$row['email'],1,0);
		$pdf -> Cell(15,5,$row['rm_no'],1,0);
		$xPos = $pdf->GetX();
		$yPos = $pdf->GetY();
		//$pdf -> MultiCell($cellWidth,$cellHeight,$row['uni_name'],1,1);
		$pdf -> Cell(50,5,$row['uni_name'],1,1);
		//$pdf->SetXY($xPos+$cellWidth, $yPos);
	}
	$pdf -> Output();

?>
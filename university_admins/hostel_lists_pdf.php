<?php	
	require ('../fpdf/fpdf.php');
	require_once("../db.php");
	//$con = mysqli_connect('localhost','root','','mcladies');
	class PDF extends FPDF{
		function Header(){
			$this -> SetFont('Arial','B',15);
			$this -> Cell(12);
			$this -> Cell(0,10,'HOSTEL LISTS',0,1,"C");
			$this -> Cell(0,10,'Date:'.date('d-m-Y').'',0,1,"R");
			$this -> Ln(5);
			$this -> SetFont('Arial','B',11);
			$this -> SetFIllColor(180,180,255);
			$this -> SetDrawColor(50,50,100);
			$this -> Cell(10,5,'No',1,0,'',true);
			$this -> Cell(80,5,'Hostel Name',1,0,'',true);
			$this -> Cell(40,5,'Location',1,0,'',true);
			$this -> Cell(25,5,'Contact 1',1,0,'',true);
			$this -> Cell(25,5,'Contact 2',1,1,'',true);
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
	$query = mysqli_query($con, "SELECT * FROM hostels");
	$i = 0;
	while($row = mysqli_fetch_array($query)){
		$i++;
		$pdf -> Cell(10,5,$i,1,0);
		$pdf -> Cell(80,5,$row['host_name'],1,0);
		$pdf -> Cell(40,5,$row['location'],1,0);
		$pdf -> Cell(25,5,$row['contact1'],1,0);
		$pdf -> Cell(25,5,$row['contact2'],1,1);
	}
	$pdf -> Output();

?>
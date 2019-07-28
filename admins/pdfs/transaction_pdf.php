<?php	
	require ('../../fpdf/fpdf.php');
	require_once("../db.php");
	//$con = mysqli_connect('localhost','root','','mcladies');
	class PDF extends FPDF{
		function Header(){
			$con = mysqli_connect('localhost','root','','hostels');
			$q = "SELECT * FROM hostels WHERE host_id=".$_GET['hst'];
			$rQ = mysqli_query($con, $q);
			$rw = mysqli_fetch_array($rQ);
			$this -> SetFont('Arial','B',15);
			$this -> Cell(12);
			$this -> Cell(0,10,strtoupper($rw['host_name']).' TRANSACTION LISTS',0,1,"C");
			$this -> SetFont('Arial','',10);
			$this -> Cell(0,5,'Postal address: ',0,1,"C");
			$this -> Cell(0,5,'Email: ',0,1,"C");
			$this -> Cell(0,5,'Call: '.$rw['contact1'].'/'.$rw['contact2'],0,1,"C");
			$this -> Cell(0,10,'Date:'.date('d-m-Y').'',0,1,"R");
			$this -> Ln(5);
			$this -> SetFont('Arial','B',11);
			$this -> SetFIllColor(180,180,255);
			$this -> SetDrawColor(50,50,100);
			$this -> Cell(10,5,'No',1,0,'',true);
			$this -> Cell(50,5,'Account name',1,0,'',true);
			$this -> Cell(20,5,'Amount',1,0,'',true);
			$this -> Cell(50,5,'Account Description',1,0,'',true);
			$this -> Cell(50,5,'Date of Transaction',1,1,'',true);
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
	$query = mysqli_query($con, "SELECT * FROM transactions INNER JOIN account_name ON transactions.acn_id=account_name.acn_id WHERE host_id='".$_GET['hst']."' ORDER BY tra_date DESC");
	echo mysqli_error($con);
	$i = 0;
	while($row = mysqli_fetch_array($query)){
		$i++;
		$pdf -> Cell(10,5,$i,1,0);
		$pdf -> Cell(50,5,$row['acn_name'],1,0);
		$pdf -> Cell(20,5,$row['amount'],1,0);
		$pdf -> Cell(50,5,$row['Description'],1,0);
		$pdf -> Cell(50,5,$row['tra_date'],1,1);
	}
	$pdf -> Output();

?>
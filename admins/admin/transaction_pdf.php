<?php	
	require ('../../fpdf/fpdf.php');
	$con = mysqli_connect('localhost','root','','mcladies');
	class PDF extends FPDF{
		function Header(){
			$this -> SetFont('Arial','B',15);
			$this -> Cell(12);
			$this -> Cell(0,10,'MODERN CHRISTIAN LADIES HOSTEL TRANSACTIONS LIST',0,1,"C");
			$this -> Cell(0,10,'Date:'.date('d-m-Y').'',0,1,"R");
			$this -> Ln(5);
			$this -> SetFont('Arial','B',11);
			$this -> SetFIllColor(180,180,255);
			$this -> SetDrawColor(50,50,100);
			$this -> Cell(10,5,'No',1,0,'',true);
			$this -> Cell(50,5,'Account name',1,0,'',true);
			$this -> Cell(50,5,'Description',1,0,'',true);
			$this -> Cell(30,5,'Amount',1,0,'',true);
			$this -> Cell(40,5,'Date',1,1,'',true);
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
	$query = mysqli_query($con, "SELECT * FROM transactions ORDER BY tra_date DESC");
	$i = 0;
	while($row = mysqli_fetch_array($query)){
		$i++;
		$pdf -> Cell(10,5,$i,1,0);
		$pdf -> Cell(50,5,$row['account_name'],1,0);
		$pdf -> Cell(50,5,$row['Description'],1,0);
		$pdf -> Cell(30,5,$row['amount'],1,0);
		$pdf -> Cell(40,5,$row['tra_date'],1,1);
	}
	$pdf -> Output();

?>
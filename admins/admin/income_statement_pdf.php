<?php	
	require ('../../fpdf/fpdf.php');
	$con = mysqli_connect('localhost','root','','mcladies');
	class PDF extends FPDF{
		function Header(){
			$this -> SetFont('Arial','B',11);
			$this -> SetFIllColor(165,42,42);
			$this -> SetDrawColor(165,42,42);
			$this -> SetTextColor(255,255,255);
			$this -> Cell(0,5,'MODERN CHRISTIAN LADIES HOSTEL',0,1,'C',true);
			$this -> Cell(0,5,'INCOME STATEMENT',0,1,'C',true);
			$this -> Cell(0,5,'FOR THE YEAR 2018',0,1,'C',true);
			$this -> Cell(0,5,date("l jS \of F Y h:i:s A"),0,1,'C',true);
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
	$pdf -> SetFont('Arial','B',9);
	$pdf -> SetDrawColor(50,50,100);
	$pdf -> Cell(0,5,'REVENUES',0,1);
	$pdf -> SetFont('Arial','',9);
	//Total rent sections
	$q = "SELECT SUM(amount) FROM payment";
	$rQ = mysqli_query($con, $q);
	$row = mysqli_fetch_assoc($rQ);
	$res = $row['SUM(amount)'];
	$pdf -> Cell(10,5,'',0,0);
	$pdf -> Cell(70,5,'Total rent',0,0);
	$pdf -> Cell(70, 5,$res,0,1,'R');
	//Displaying all the revenues
	$q5 = "SELECT account_name,SUM(amount) FROM transactions WHERE acc_id=2 GROUP BY account_name";
	$rQ5 = mysqli_query($con, $q5);
	while($row5 = mysqli_fetch_array($rQ5)){
		$pdf -> Cell(10,5,'',0,0);
		$pdf -> Cell(70,5,$row5['account_name'],0,0);
		$pdf -> Cell(70,5,$row5['SUM(amount)'],0,1,'R');
	}	
	//FINDING THE SUMM OF ALL REVENUES IN TRANSACTIONS SECTION
	$q7 = "SELECT SUM(amount) FROM transactions WHERE acc_id=2";
	$rQ7 = mysqli_query($con, $q7);
	$row7 = mysqli_fetch_assoc($rQ7);
	$res7 = $row7['SUM(amount)'];
	//FINDING THE SUM OF ALL DEPOSITS
	$q1 = "SELECT SUM(discount) FROM clients";
	$rQ1 = mysqli_query($con, $q1);
	$row1 = mysqli_fetch_assoc($rQ1);
	$res1 = $row1['SUM(discount)'];
	$total = $res + $res1 + $res7;
	$pdf -> Cell(10,5,'',0,0);
	$pdf -> Cell(70,5,'Total Deposit',0,0);
	$pdf -> Cell(70,5,$res1,0,1,'R');
	$pdf -> SetFont('Arial','B',9);
	$pdf -> SetFillColor(211,211,211);
	$pdf -> Cell(150,5,'TOTAL REVENUES',0,0);
	$pdf -> Cell(30,5,$total,0,1,'R');
	//TOTAL EXPENSES
	$pdf -> Cell(0,5,'EXPENSES',0,1);
	//TOTAL OF ALL SALARIES
	$pdf -> SetFont('Arial','',9);
	$q3 = "SELECT SUM(sal_amount) FROM salaries";
	$rQ3 = mysqli_query($con, $q3);
	$row3 = mysqli_fetch_assoc($rQ3);
	$res3 = $row3['SUM(sal_amount)'];
	$pdf -> Cell(10,5,'',0,0);
	$pdf -> Cell(70,5,'Total salaries',0,0);
	$pdf -> Cell(70, 5,$res3,0,1,'R');
	//FINDING THE TOTAL OF ALL EXPENSES
	$q2 = "SELECT account_name,SUM(amount) FROM transactions WHERE acc_id=3 GROUP BY account_name";
	$rQ2 = mysqli_query($con, $q2);
	while($row2 = mysqli_fetch_array($rQ2)){
		$pdf -> Cell(10,5,'',0,0);
		$pdf -> Cell(70,5,$row2['account_name'],0,0);
		$pdf -> Cell(70,5,$row2['SUM(amount)'],0,1,'R');
	}
	//FINDINT THE TOTAL EXPENSES
	$q4 = "SELECT SUM(amount) FROM transactions WHERE acc_id=3";
	$rQ4 = mysqli_query($con, $q4);
	$row4 = mysqli_fetch_assoc($rQ4);
	$res4 = $row4['SUM(amount)'];
	$total1 = $res3 + $res4;
	$pdf -> SetFont('Arial','B',9);
	$pdf -> SetFillColor(211,211,211);
	$pdf -> Cell(150,5,'TOTAL EXPENSES',0,0);
	$pdf -> Cell(30,5,$total1,0,1,'R');	
	$q5 = $total - $total1;
	$pdf -> Cell(150,5,'NET INCOME',0,0);
	$pdf -> Cell(30,5,$q5,0,1,'R');	

	$pdf -> Output();

?>
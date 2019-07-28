<?php	
	require ('../fpdf/fpdf.php');
	require_once("db.php");
	//$con = mysqli_connect('localhost','root','','mcladies');
	class PDF extends FPDF{
		function Header(){
			$this -> SetFont('Arial','B',15);
			$this -> Cell(12);
			$this -> Cell(0,10,'MODERN CHRISTIAN LADIES HOSTEL CHECKED IN CLIENTS LIST',0,1,"C");
			$this -> Cell(0,10,'Date:'.date('d-m-Y').'',0,1,"R");
			$this -> Ln(5);
			$this -> SetFont('Arial','B',11);
			$this -> SetFIllColor(180,180,255);
			$this -> SetDrawColor(50,50,100);
			$this -> Cell(9,5,'No',1,0,'',true);
			$this -> Cell(40,5,'Name',1,0,'',true);
			$this -> Cell(16,5,'ID NO',1,0,'',true);
			$this -> Cell(20,5,'Phone',1,0,'',true);
			$this -> Cell(40,5,'Email',1,0,'',true);
			$this -> Cell(15,5,'Room',1,0,'',true);
			$this -> Cell(40,5,'Institution',1,1,'',true);
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
	$query = mysqli_query($con, "SELECT * FROM (((hostel_client_list INNER JOIN clients ON hostel_client_list.id_no=clients.id_no)INNER JOIN universities ON universities.uni_id=clients.uni_id) LEFT JOIN room_numbers ON hostel_client_list.rm_id=room_numbers.rm_id) WHERE hostel_client_list.host_id=".$_GET['hst']."AND status='in'");
	echo mysqli_error($con);
	$i = 0;
	while($row = mysqli_fetch_array($query)){
		$i++;
		$pdf -> Cell(9,5,$i,1,0);
		$pdf -> Cell(40,5,$row['fname'].' '.$row['lname'],1,0);
		$pdf -> Cell(16,5,$row['id_no'],1,0);
		$pdf -> Cell(20,5,$row['phone'],1,0);
		$pdf -> Cell(40,5,$row['email'],1,0);
		$pdf -> Cell(15,5,$row['rm_no'],1,0);
		$pdf -> Cell(40,5,$row['uni_name'],1,1);
	}
	$pdf -> Output();

?>
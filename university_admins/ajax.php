<?php
	require_once("../db.php"); 
//DISPLAY HOSTEL LISTS IN THE UNIVERSITY ADMIN SECTION
	if(isset($_POST['view_hostels_list'])){
		$query = "";
		$output = array();
		$query .= "SELECT * FROM hostels ";
		if(isset($_POST["search"]['value'])){
			$query .= 'WHERE (location LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR host_name LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR contact1 LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR contact2 LIKE "%'.$_POST["search"]['value'].'%")';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}else{
			$query .= 'ORDER BY host_id ASC ';
		}
		if($_POST["length"] != -1){
			$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
		}
		$runQuery = mysqli_query($con, $query);
		if($runQuery){
			$data = array();
			$noOfRows = mysqli_num_rows($runQuery);
			$i = 0;
			while($row = mysqli_fetch_array($runQuery)){
				$i++;
				$sub_array = array();
				$sub_array[] = $i;
				$sub_array[] = $row['host_name'];
				$sub_array[] = $row['location'];
				$sub_array[] = $row['contact1'];
				$sub_array[] = $row['contact2'];
				$data[] = $sub_array;
			}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>	get_all_hostels($con),
				"data"			=>	$data	

			);
			echo json_encode($output);
		}else{
			echo mysqli_error($con);
		}
		
	}
	function get_all_hostels($con){
		$q = "SELECT * FROM hostels";
		$rQ = mysqli_query($con, $q);
		return mysqli_num_rows($rQ);
	}
//VIEW STUDENT LISTS
	if(isset($_POST['view_students_list'])){
		$query = "";
		$output = array();
		$query .= "SELECT * FROM clients INNER JOIN hostels ON clients.host_id=hostels.host_id WHERE uni_id='".$_POST['university']."' AND ";
		if(isset($_POST["search"]['value'])){
			$query .= '(fname LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR lname LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR id_no LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR clients.email LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR pphone LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR pname LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR host_name LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR gender LIKE "%'.$_POST["search"]['value'].'%")';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}else{
			$query .= 'ORDER BY host_name ASC ';
		}
		if($_POST["length"] != -1){
			$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
		}
		$runQuery = mysqli_query($con, $query);
		if($runQuery){
			$data = array();
			$noOfRows = mysqli_num_rows($runQuery);
			while($row = mysqli_fetch_array($runQuery)){
				if($row['passport'] == ''){
					$image = '<img src="../admins/images/default.png" width="50px" height="50px" />';
				}else{
					'<img src="../admins/passports/'.$row['passport'].'" width="50px" height="50px" />';
				}
				$sub_array = array();
				$sub_array[] = $row['fname'].' '.$row['lname'];
				$sub_array[] = $image;
				$sub_array[] = $row['id_no'];
				$sub_array[] = $row['phone'];
				$sub_array[] = $row['host_name'];
				$sub_array[] = $row['gender'];
				$sub_array[] = $row['pname'];
				$sub_array[] = $row['pphone'];
				$data[] = $sub_array;
			}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>	get_all_students($con),
				"data"			=>	$data	

			);
			echo json_encode($output);
		}else{
			echo mysqli_error($con);
		}
		
	}
	function get_all_students($con){
		$q = "SELECT * FROM clients INNER JOIN hostels ON clients.host_id=hostels.host_id WHERE uni_id='".$_POST['university']."'";
		$rQ = mysqli_query($con, $q);
		return mysqli_num_rows($rQ);
	}
?>
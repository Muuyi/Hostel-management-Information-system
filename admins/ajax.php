<?php
	require_once("db.php");
///////////////////////////////////////////////INDIVIDUAL HOSTELS SECTION //////////////////////////////
	//SENDING HOSTEL MESSAGE SECTION
		if(isset($_POST['submit_hostel_message'])){
			$name = mysqli_real_escape_string($con, $_POST['name']);
			$phone = mysqli_real_escape_string($con, $_POST['phone']);
			$subject = mysqli_real_escape_string($con, $_POST['subject']);
			$mes = mysqli_real_escape_string($con, $_POST['mes']);
			$hostel = mysqli_real_escape_string($con, $_POST['hostel']);
			$q = "INSERT INTO messages (mes_name,mes_phone,mes_sub,message,host_id,mes_date) VALUES ('$name','$phone','$subject','$mes','$hostel',now())";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo '<div class="alert alert-success">Message has been successfully sent</div>';
			}
		}
	//CONFIRMING IF THE EMAIL EXISTS BEFORE SENDING THE MAIL TO THE CLIENTS EMAIL
		if(isset($_POST['confirm_pass_email'])){
			$q = "SELECT * FROM hostel_admins WHERE admin_email='".$_POST['email']."'";
			$rQ = mysqli_query($con, $q);
			$count = mysqli_num_rows($rQ);
			if($count > 0){
				$row = mysqli_fetch_array($rQ);
				$id = $row['admin_id'];
				$code = rand(50000,1000000);
				$code = md5($code);
				$q = "UPDATE hostel_admins SET activation_code='$code' WHERE admin_email='".$_POST['email']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					$to = $_POST['email'];
					$sub = "Password reset link";
					$msg = "Pleas click the link below or copy the url and paste it to reset your password!<br />";
					$msg .= "http://www.kobs.co.ke/admins/reset_password.php?code=".$code."&id=".$id."&mail=".$_POST['email'];
					$header = "HOSTELS ONLINE BOOKING SYSTEM";
					if(mail($to,$sub,$msg,$header)){
						echo 'available';
					}else{
						echo 'error';
					}
				}else{
					echo 'error';
				}
				
				
			}else{
				echo 'unavailable';
			}
		}
///////////////////////////////////////////////MESSAGES SECTION//////////////////////////////////////////
	//DELETING MESSAGES
		if(isset($_POST['mesId'])){
			$rid = $_POST['mesId'];
			$q = "DELETE FROM messages WHERE mes_id='$rid'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo "You have successfully deleted an account!";
			}
		}
///////////////////////////////////////////////HOSTELS SECTION//////////////////////////////////////////
	//DELETING HOSTEL REQUIREMENT
		if(isset($_POST['delete_hostel_requirement'])){
			$q = "DELETE FROM requirements WHERE req_id='".$_POST['req_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'The requirement has been successfully deleted!';
			}
		}
	//DELETING HOSTEL SERVICE
		if(isset($_POST['delete_hostel_service'])){
			$q = "DELETE FROM hostel_services WHERE hs_id='".$_POST['hs_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'The service has been successfully deleted!';
			}
		}
	//DELETING ROOM PRICE
		if(isset($_POST['delete_rm_prc'])){
				$qry = "SELECT room_photo FROM hostels_room_photos WHERE rm_photo_id='".$_POST['rm_id']."'";
				$rQry = mysqli_query($con, $qry);
				$row = mysqli_fetch_array($rQry);
				echo "images/".$row['room_photo'];
				if($row['room_photo'] != ''){
					unlink("images/".$row['room_photo']);
					$q = "DELETE FROM hostels_room_photos WHERE rm_photo_id='".$_POST['rm_id']."'";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						echo "Room successfuly deleted";
					}
				}else{
					$q = "DELETE FROM hostels_room_photos WHERE rm_photo_id='".$_POST['rm_id']."'";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						echo "Room successfuly deleted";
					}
				}
		}
	//POPULATING EDIT ROOM PRICES FORM WITH DETAILS
		if(isset($_POST['view_room_price_details'])){
			$q = "SELECT * FROM hostels_room_photos INNER JOIN room_category ON hostels_room_photos.cat_id=room_category.cat_id WHERE rm_photo_id='".$_POST['room_price_id']."'";
			$rQ = mysqli_query($con, $q);
			echo mysqli_error($con);
			$data = array();
			while($row = mysqli_fetch_array($rQ)){
				$data['rm_photo_id'] = $row['rm_photo_id'];
				$data['room_amount'] = $row['room_amount'];
				$data['cat_name'] = $row['cat_name'];
			}
			echo json_encode($data);
		}
	//EDITING THE PRICES DATA
		if(isset($_POST['update_room_price'])){
			$q = "UPDATE hostels_room_photos SET room_amount='".$_POST['room_price']."' WHERE rm_photo_id='".$_POST['rm_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo '<div class="alert alert-success">The room has been successfully updated</div>';
			}
		}
	//CHANGING HOSTELS IMAGE
		if(isset($_POST['change_hostel_profile'])){
			$name = $_FILES['hostel_profile_pic']['name'];
			$extension = explode('.', $name);
			$ext = end($extension);
			$new_image = '';
			$new_name = $_POST['hostel_id'].'_'.rand(10000,100000).'.'.$ext;
			$path = "../system_admin/images/".$new_name;
			list($width,$height) = getimagesize($_FILES['hostel_profile_pic']['tmp_name']);
			if($ext == 'png'){
				$new_image = imagecreatefrompng($_FILES['hostel_profile_pic']['tmp_name']);
			}else if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPG'){
				$new_image = imagecreatefromjpeg($_FILES['hostel_profile_pic']['tmp_name']);
			}
			$new_width = 400;
			$new_height = 300;
			$tmp_image = imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($tmp_image,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
			if(imagejpeg($tmp_image,$path,100)){
				imagedestroy($new_image);
				imagedestroy($tmp_image);
				$q = "UPDATE hostels SET host_image='$new_name' WHERE host_id='".$_POST['hostel_id']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					if(unlink("../system_admin/images/".$_POST['current_image_name'])){
						echo $path;
					}else{
						echo $path;
					}
					
				}
			}
			
		}
	//ADDING A HOSTEL SERVICE TO THE DATABASE
		if(isset($_POST['submit_hostel_service'])){
			$q = "INSERT INTO hostel_services (service_id,host_id) VALUES('".$_POST['service']."','".$_POST['hostel_id']."')";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'Service has been successfully added';
			}
		}
	//SAVING SERVICES TO THE DATABASE
		if(isset($_POST['save_service'])){
			$q = "INSERT INTO services (service_name) VALUES('".$_POST['service']."')";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo "<div class='alert alert-success'>You have successfully uploaded a service</div>";
			}else{
				echo "<div class='alert alert-danger'>There was a problem while uploading the service. Please contact <b>0724654808</b> to check the error!</div>";
			}
		}
////////////////////////////////////////////////HOSTELS GALLERU IMAGES SECTION//////////////////////////////////
	//DELETING IMAGES FROM THE DATABASE
		if(isset($_POST['delete_hostel_image'])){
			$qry = "SELECT * FROM gallery WHERE g_id='".$_POST['imageId']."'";
			$rQry = mysqli_query($con, $qry);
			$row = mysqli_fetch_array($rQry);
			if(unlink("images/".$row['g_name'])){
				$q = "DELETE FROM gallery WHERE g_id='".$_POST['imageId']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "An image has been successfully deleted";
				}
			}else{
				$q = "DELETE FROM gallery WHERE g_id='".$_POST['imageId']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "An image has been successfully deleted";
				}
			}
			
		}
	//UPLOADING IMAGES TO THE DATABASE
		function file_already_uploaded($file_name,$con){
				$q = "SELECT * FROM gallery WHERE g_name='".$file_name."'";
				$rQ = mysqli_query($con, $q);
				$count = mysqli_num_rows($rQ);
				if($count > 0){
					return true;
				}else{
					return false;
				}
			}
		if(isset($_POST['upload_images'])){
			$output = array();
			$error = '';
			$photos = '';
			if(isset($_FILES['file']['name'][0])){
				foreach($_FILES['file']['name'] as $names => $name){
					$file_name = $_FILES['file']['name'][$names];
					$ext = explode(".", $_FILES['file']['name'][$names]);
					$extension = end($ext);
					$allowed = array("jpg","jpeg","png","gif");
					if(in_array($extension, $allowed)){
						if($_FILES['file']['size'][$names] > 1000000){
							$error .='<label class="text-danger"> <b><i>'.$name.'<b></i> is too large to be uploaded. Only a maximum of 1MB is allowed!</label> <br />';
						}else{
							if(file_already_uploaded($file_name, $con)){
								$file_name = $_POST['hostel_id'].'_'.rand(1000,100000).'.'.$extension;
							}
							if(move_uploaded_file($_FILES['file']['tmp_name'][$names], "images/".$file_name)){
								$q = "INSERT INTO gallery(g_name,host_id,g_date) VALUES('".$file_name."','".$_POST['hostel_id']."',now())";
								$rQ = mysqli_query($con, $q);
								if($rQ){
									$photos .= '<img src="'."images/".$_FILES['file']['name'][$names].'" width="100px" height="100px" style="float:left;"/>'; 
								}
							}else{
								echo 'An error occured';
							}
						}
					}else{
						$error .='<label class="text-danger"> <b><i>'.$name.'<b></i> contains an invalid file format. Please only jpg/jpeg/png/gif is allowed!</label> <br />';

					}
				}
				$output[] = array(
							'error' => $error, 
							'photos' => $photos
				);
			}
			echo json_encode($output);
		}
////////////////////////////////////////////////ROOMS SECTION///////////////////////////////////////////
	//DELETING IMAGE SLIDE SHOW
		if(isset($_POST['delete_slide'])){
			$q = "DELETE FROM hostels_slideshow WHERE slide_id='".$_POST['slide_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'You have successfully deleted an image';
			}
		}
	//GETTING SLIDE SHOW IMAGES TABLE CONTENT
		if(isset($_POST['get_slide_show_images_table'])){
			$q = "SELECT * FROM hostels_slideshow WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			$output = '';
			$i=0;
			while($row=mysqli_fetch_array($rQ)){
				$i++;
				echo '
					<tr>
						<td>'.$i.'</td>
						<td><img src="hostel_slides/'.$row['slide_image'].'" width="50px" height="50px" /></td>
						<td>'.$row['slide_header'].'</td>
						<td><button type="button" class="btn btn-danger delete_slideshow" id="'.$row['slide_id'].'">Delete</button></td>
					</tr>
				';
			}
		}
	////POPULATING THE ADD ROOM NUMBER FORM WITH DATABASE VALUES TO EDIT THE AVAILABLE ROOM DETAILS
		if(isset($_POST['view_room_form_details'])){
			$q = "SELECT * FROM room_numbers WHERE rm_id='".$_POST['room_edit_id']."'";
			$rQ = mysqli_query($con, $q);
			$data = array();
			while($row=mysqli_fetch_array($rQ)){
				$data['rm_no'] = $row['rm_no'];
				$data['rm_amount'] = $row['rm_amount'];
			}
			echo json_encode($data);
		}
	//DELETING HOSTEL ROOM
		if(isset($_POST['delete_hostel_room'])){
			$q = "DELETE FROM room_numbers WHERE rm_id='".$_POST['room_del_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'The room has been successfully deleted';
			}
		}
	//POST ROOMS IMAGES TO THE DATABASE
		if(isset($_FILES['change_room_photo'])){
			$name = $_FILES['change_room_photo']['name'];
			$exp = explode(".", $name);
			$ext = end($exp); 
			$ext = strtolower($ext);
			$filename = $_POST['room_id'].'_'.$_POST['hostel'].'.'.$ext;
			//RESIZING THE ROOM IMAGE
				$path = "images/".$filename;
				list($width, $height) = getimagesize($_FILES['change_room_photo']['tmp_name']);
				if($ext == 'png'){
					$new_image = imagecreatefrompng($_FILES['change_room_photo']['tmp_name']);
				}else if($ext == 'jpg' || $ext == 'jpeg'){
					$new_image = imagecreatefromjpeg($_FILES['change_room_photo']['tmp_name']);
				}
				$new_width = 500;
				$new_height = 350;
				$tmp_image = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($tmp_image,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
				$qry = "SELECT * FROM hostels_room_photos WHERE rm_photo_id='".$_POST['room_id']."'";
					$rQry = mysqli_query($con, $qry);
					$row = mysqli_fetch_array($rQry);
					if($row['room_photo'] != ''){
						unlink("images/".$row['room_photo']);
					}
					if(imagejpeg($tmp_image,$path,100)){
						imagedestroy($new_image);
						imagedestroy($tmp_image);
						$q = "UPDATE hostels_room_photos SET room_photo = '".$filename."' WHERE rm_photo_id='".$_POST['room_id']."'";
						$rQ = mysqli_query($con, $q);
						if($rQ){
							echo'images/'.$filename;
						}else{
							echo 'fail';
						}
					}
		}
	//UPLOADING IMAGE SLIDESHOW
		if(isset($_POST['submit_slide'])){
			$name = $_FILES['image']['name'];
			if($name == ''){
				echo '<div class="alert alert-danger">Please select an image to post the slide show</div>';
			}else{
				$exp = explode(".", $name);
				$exten = end($exp);
				$ext = strtolower($exten);
		//RESIZING THE SLIDES IMAGES
				$path = "hostel_slides/".$name;
				list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
				if($ext == 'png'){
					$new_image = imagecreatefrompng($_FILES['image']['tmp_name']);
				}else if($ext == 'jpg' || $ext == 'jpeg'){
					$new_image = imagecreatefromjpeg($_FILES['image']['tmp_name']);
				}
				$new_width = 500;
				$new_height = 350;
				$tmp_image = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($tmp_image,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
				$hostel = $_POST['hostel_id'];
				$header = mysqli_real_escape_string($con, $_POST['header']);
				$content = mysqli_real_escape_string($con, $_POST['content']);
				if(imagejpeg($tmp_image,$path,100)){
					$q = "INSERT INTO hostels_slideshow (slide_image,slide_header,slide_content,host_id) VALUES('$name','$header','$content','$hostel')";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						echo'<div class="alert alert-success">Data has been successful submitted</div>';
					}else{
						echo'<div class="alert alert-danger">A problem occured during data transfer. Please try again later!</div>';
					}
				}
			}
		}
	//DISPLAY AVAILABLE ROOMS
		if(isset($_POST['view_available_rooms'])){
				$query = "";
				$output = array();
				$query .= "SELECT * FROM room_numbers INNER JOIN room_category ON room_numbers.cat_id=room_category.cat_id  WHERE host_id='".$_POST['hostel_id']."' AND ";
				if(isset($_POST["search"]['value'])){
					$query .= '(rm_no LIKE "%'.$_POST["search"]['value'].'%"';
					$query .= 'OR rm_amount LIKE "%'.$_POST["search"]['value'].'%")';
				}
				if(isset($_POST["order"])){
					$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
				}else{
					$query .= 'ORDER BY room_numbers.cat_id ASC ';
				}
				if($_POST["length"] != -1){
					$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
				}
				$runQuery = mysqli_query($con, $query);
				if($runQuery){
					$data = array();
					$noOfRows = mysqli_num_rows($runQuery);
					while($row = mysqli_fetch_array($runQuery)){
						$sub_array = array();
						$sub_array[] = $row['rm_no'];
						$sub_array[] = $row['cat_name'];
						$sub_array[] = $row['rm_amount'];
						$sub_array[] = '<input type="button" class="btn btn-primary btn-xs edit_available_room" value="Edit" id='.$row['rm_id'].'/>';
						$sub_array[] = '<input type="button" class="btn btn-danger btn-xs delete_room" value="Delete" id='.$row['rm_id'].'/>';
						$data[] = $sub_array;
					}
					$output = array(
						"draw"			=>	intval($_POST["draw"]),
						"recordsTotal"	=>	$noOfRows,
						"recordsFiltered" =>get_all_rooms($con),
						"data"			=>	$data	

					);
					echo json_encode($output);
				}else{
					echo mysqli_error($con);
				}
			
			}
			function get_all_rooms($con){
				$q = "SELECT * FROM room_numbers INNER JOIN room_category ON room_numbers.cat_id=room_category.cat_id WHERE host_id='".$_POST['hostel_id']."'";
				$rQ = mysqli_query($con, $q);
				return mysqli_num_rows($rQ);
			}
////////////////////////////////////////////////ACCOUNTS SECTION////////////////////////////////////////
	//DELETING ACCOUNT TYPES DETAILS
		if(isset($_POST['acnm'])){
			$aid = $_POST['acnm'];
			$q = "DELETE FROM account_name WHERE acn_id='$aid'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo "You have successfully deleted an account!";
			}
		}
	//ACCOUNTS TYPES TABLES
		if(isset($_POST['view_accounts_types'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM account_name INNER JOIN accounts ON account_name.acc_id=accounts.acc_id  WHERE host_id='".$_POST['hostel_id']."' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(acc_name LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR acn_name LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY acc_name ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['acc_name'];
					$sub_array[] = $row['acn_name'];
					$sub_array[] = '<input type="button" class="btn btn-danger btn-xs acname_dlt" value="Delete" id='.$row['acn_id'].'/>';
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_all_accounts($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_all_accounts($con){
			$q = "SELECT * FROM account_name INNER JOIN accounts ON account_name.acc_id=accounts.acc_id  WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//TRANSACTION SUMMARY TABLE
		if(isset($_POST['view_transaction_summary'])){
			$query = "";
			$output = array();
			$query .= "SELECT SUM(amount) AS total,acn_name FROM account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id GROUP BY transactions.acn_id";
			if(isset($_POST["search"]['value'])){
				$query .= ' OR (acn_name LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY acn_name ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['acn_name'];
					$sub_array[] = $row['total'];
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_transaction_summary($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_transaction_summary($con){
			$q = "SELECT SUM(amount), account_name.acn_id,acn_name FROM account_name INNER JOIN transactions ON account_name.acn_id=transactions.acn_id WHERE host_id='".$_POST['hostel_id']."' GROUP BY transactions.acn_id";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//TRANSACTIONS TABLE
		if(isset($_POST['view_transaction_table'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM transactions INNER JOIN account_name ON transactions.acn_id=account_name.acn_id WHERE host_id='".$_POST['hostel_id']."' AND";
			if(isset($_POST["search"]['value'])){
				$query .= '(acn_name LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY acn_name ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['acn_name'];
					$sub_array[] = $row['Description'];
					$sub_array[] = $row['amount'];
					$sub_array[] = $row['tra_date'];
					$sub_array[] = "<input type='button' value='Edit' class='btn btn-primary btn-xs trans_edit' id='".$row['t_id']."' />";
					$sub_array[] = "<input type='button' value='Delete' class='btn btn-danger btn-xs trans_del' id='".$row['t_id']."' />";
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_transactions($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_transactions($con){
			$q = "SELECT * FROM account_name INNER JOIN transactions ON account_name.acn_id=transactions.t_id WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//CLIENTS PAYMENT TABLE
		if(isset($_POST['view_clients_payment_table'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM payment INNER JOIN clients ON payment.id_no=clients.id_no WHERE payment.host_id='".$_POST['hostel_id']."' AND";
			if(isset($_POST["search"]['value'])){
				$query .= '(fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR lname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR clients.id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pphone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pname LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY day ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			echo mysqli_error($con);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['fname'].' '.$row['lname'];
					$sub_array[] = $row['id_no'];
					$sub_array[] = $row['amount'];
					$sub_array[] = $row['day'];
					$sub_array[] = '<input type="button" value="Edit" id="'.$row['p_id'].'" class="btn btn-primary btn-xs trans_edit"/>';
					$sub_array[] = '<input type="button" value="Delete" id="'.$row['p_id'].'" class="btn btn-danger btn-xs trans_del"/>';
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_clients_payments($con),
					"data"			=>	$data	

				);
				//var_dump($data);
				echo json_encode($data);

			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_clients_payments($con){
			$q = "SELECT * FROM (payment INNER JOIN clients ON payment.id_no=clients.id_no) WHERE payment.host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//CLIENTS BALANCES TABLE
		if(isset($_POST['view_balances_table'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM balances INNER JOIN clients ON balances.id_no=clients.id_no WHERE balances.host_id='".$_POST['hostel_id']."' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR balances.id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR lname LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY balance ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['fname'].' '.$row['lname'];
					$sub_array[] = $row['id_no'];
					$sub_array[] = $row['balance'];
					$sub_array[] = $row['bal_date'];
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_all_balances($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_all_balances($con){
			$q = "SELECT * FROM balances INNER JOIN clients ON balances.id_no=clients.id_no WHERE balances.host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
////////////////////////////////////////////////BLOG SECTION///////////////////////////////////////////
	//DELETING A BLOG
		if(isset($_POST['bId'])){
			$rid = $_POST['bId'];
			$q = "DELETE FROM blog WHERE b_id='$rid'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo "You have successfully deleted a blog post!";
			}
		}
//////////////////////////////////////////////VACANCE ADMIN SECTION////////////////////////////////////
	////SUBMITTING VACANCY DATA TO THE DATABASE
		if(isset($_POST['submit_vacancy'])){
				$q = "UPDATE vacance SET vaca_title='".$_POST['title']."',vaca_details='".$_POST['content']."' WHERE vaca_id='".$_POST['vid']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "<div class='alert alert-success'>You have successfully updated the vacance details!</div>";
				}
			}
	//FILLING VACANCE FORM WITH DATA
		if(isset($_POST['edit_vacance'])){
			$q = "SELECT * FROM vacance WHERE vaca_id='".$_POST['vacance_id']."'";
			$rQ = mysqli_query($con, $q);
			$data = array();
			while($row = mysqli_fetch_array($rQ)){
				$data['vaca_id'] = $row['vaca_id'];
				$data['vaca_title'] = $row['vaca_title'];
				$data['vaca_details'] = $row['vaca_details'];
			}
			echo json_encode($data);
		}
	//DELETING VACANCES FROM THE VACANCE DATABASE
		if(isset($_POST['vac_id'])){
			$vac_id = $_POST['vac_id'];
			$q4 = "DELETE FROM vacance WHERE vaca_id='$vac_id'";
			$rQ4 = mysqli_query($con, $q4);
			if($rQ4){
				echo "You have successfully deleted a vacance!";
			}else{
				echo (mysqli_error($con));
			}
		}
//////////////////////////////////////////////SUPPLIER SECTION///////////////////////////////////////////
	//SUPPLIERS TABLE
		if(isset($_POST['view_suppliers_table'])){
			$query = "";

			$output = array();
			$query .= "SELECT * FROM suppliers WHERE host_id='".$_POST['hostel_id']."' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(f_name LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR l_name LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR product LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY f_name ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['f_name'].' '.$row['l_name'];
					$sub_array[] = $row['phone'];
					$sub_array[] = $row['email'];
					$sub_array[] = $row['product'];
					$sub_array[] = '<input type="submit" class="btn btn-xs btn-primary s_edit" id="'.$row['supplier_id'].'" value="Edit" />';
					$sub_array[] = '<input type="submit" class="btn btn-xs btn-danger s_delete" value="Delete" id="'.$row['supplier_id'].'"/>';
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_all_suppliers($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_all_suppliers($con){
			$q = "SELECT * FROM suppliers WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//VIEW INVOICE TABLE
		if(isset($_POST['view_invoice_table'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM suppliers INNER JOIN supplies ON suppliers.supplier_id=supplies.suplier_id WHERE host_id='".$_POST['hostel_id']."' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(f_name LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR l_name LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR product LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY f_name ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					$sub_array = array();
					$sub_array[] = $row['f_name'].' '.$row['l_name'];
					$sub_array[] = $row['phone'];
					$sub_array[] = $row['id_no'];
					$sub_array[] = $row['email'];
					$sub_array[] = $row['product'];
					$sub_array[] = $row['amount'];
					$sub_array[] = $row['supplies_date'];
					$sub_array[] = '<input type="submit" class="btn btn-info btn-xs print" value="Print" />';
					$sub_array[] = '<input type="submit" class="btn btn-xs btn-danger s_delete" value="Delete" id="'.$row['supplier_id'].'"/>';
					$sub_array[] = '<input type="submit" class="btn btn-success btn-xs mail" value="Send mail" />';
					$sub_array[] = '<input type="submit" class="btn btn-primary btn-xs edit_supplies" id="'.$row['spls_id'].'" value="Edit" />';
					$sub_array[] = '<input type="submit" class="btn btn-danger btn-xs inv_delete" id="'.$row['spls_id'].'" value="Delete" />';
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_all_supplies($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_all_supplies($con){
			$q = "SELECT * FROM suppliers INNER JOIN supplies ON suppliers.supplier_id=supplies.suplier_id WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//DELETING INVOICES
		if(isset($_POST['inv_id'])){
			$inv_id = $_POST['inv_id'];
			$q3 = "DELETE FROM supplies WHERE spls_id='$inv_id'";
			$rQ3 = mysqli_query($con, $q3);
			if($rQ3){
				echo "You have successfully deleted a supply!";
			}else{
				echo (mysqli_error($con));
			}
		}
	//FILLING SUPPLIES FORM WITH DATABASE VALUES
		if(isset($_POST['edit_supplies'])){
			$q = "SELECT * FROM supplies";
			$rQ = mysqli_query($con, $q);
			$data = array();
			while($row = mysqli_fetch_array($rQ)){
				$data['amount'] = $row['amount'];
				
			}
			echo json_encode($data);
		}
	//DELETING SUPPLIER DETAILS FROM THE DATABASE
		if(isset($_POST['delete_supplier'])){
			$sid = $_POST['sid'];
			$q2 = "DELETE FROM suppliers WHERE supplier_id='".$sid."'";
			$rQ2 = mysqli_query($con, $q2);
			if($rQ2){
				echo "You have successfully deleted a supplier!";
			}else{
				echo (mysqli_error($con));
			}
		}
	//FILLING THE SUPPLIER FORM DETAILS WITH DATABASE VALUES
		if(isset($_POST['edit_supplier'])){
			$q = "SELECT * FROM suppliers WHERE supplier_id='".$_POST['supid']."'";
			$rQ = mysqli_query($con, $q);
			$data = array();
			while($row = mysqli_fetch_array($rQ)){
				$data['f_name'] = $row['f_name'];
				$data['l_name'] = $row['l_name'];
				$data['idno'] = $row['id_no'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['product'] = $row['product'];
			}
			echo json_encode($data);
		}
	//DELETING PAYMENT DETAILS FROM THE DATABASE
		if(isset($_POST['delete_payment'])){
				$q = "DELETE FROM payment WHERE p_id='".$_POST['payment_id']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "You have successfully deleted clients payment details!";
				}
			}
	//FILLING THE PAYMENT FORM DETAILS WITH DATABASE VALUES
		if(isset($_POST['edit_payment'])){
			$q = "SELECT * FROM payment WHERE p_id='".$_POST['payid']."'";
			$rQ = mysqli_query($con, $q);
			$p_details = array();
			while($row = mysqli_fetch_array($rQ)){
				$p_details['id_no'] = $row['id_no'];
				$p_details['amount'] = $row['amount'];
			}
			echo json_encode($p_details);
		}
///////////////////////////////////////////CLIENTS SECTION////////////////////////////////////////////////
	//UPDATING CLIENTS PROFILE PICTURE
		if(isset($_POST['change_student_image'])){
			echo 'Hi';
			if($_FILES['property']['name'] != ''){
				echo 'yap';
			}else{
				echo 'No file selected';
			}
		}
	//POSTING THE ROOM NUMBER TO THE DATABASE
		if(isset($_POST['save_roomnumber'])){
			$host_id = htmlspecialchars(stripslashes(mysqli_real_escape_string($con, $_POST['hostel_id'])));
			$room_amount = htmlspecialchars(stripslashes(mysqli_real_escape_string($con, $_POST['room_amount'])));
			$room_cat = htmlspecialchars(stripslashes(mysqli_real_escape_string($con, $_POST['room_cat'])));
			$room_no = htmlspecialchars(stripslashes(mysqli_real_escape_string($con, $_POST['room_number'])));
			$qry = "SELECT * FROM hostels_room_photos WHERE cat_id='".$room_cat."' AND host_id='".$host_id."'";
			$rQry = mysqli_query($con, $qry);
			$count = mysqli_num_rows($rQry);
			if($count != 0){
				$q = "INSERT INTO room_numbers (rm_no,cat_id,rm_amount,host_id) VALUES ('$room_no','$room_cat','$room_amount','$host_id')";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo '<div class="alert alert-success">The room has been successfully saved</div>';
				}else{
					echo mysqli_error($con);
				}
			}else{
				$q = "INSERT INTO room_numbers (rm_no,cat_id,rm_amount,host_id) VALUES ('$room_no','$room_cat','$room_amount','$host_id');";
				$q .= "INSERT INTO hostels_room_photos(cat_id,host_id,room_amount) VALUES ('$room_cat','$host_id','$room_amount')";
				$rQ = mysqli_multi_query($con, $q);
				if($rQ){
					echo '<div class="alert alert-success">The room has been successfully saved</div>';
				}else{
					echo mysqli_error($con);
				}
			}
			
		}
	//SAVING CLIENTS INSTITUTIONS TO THE DATABASE
		if(isset($_POST['save_institution'])){
			$name = mysqli_real_escape_string($con, $_POST['institution']);
			$q = "SELECT * FROM universities WHERE uni_name='$name'";
			$rQ = mysqli_query($con, $q);
			if(mysqli_num_rows($rQ) > 0){
				echo '<div class="alert alert-danger">The institution name already exists</div>';
			}else{
				$q = "INSERT INTO universities (uni_name) VALUES ('$name')";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo '<div class="alert alert-success">The institution has been successfully added!</div>';
				}
			}
		}
	//CHECKED OUT CLIENTS TABLE
		if(isset($_POST['view_checkedout_clients'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM clients WHERE host_id='".$_POST['hostel_id']."' AND status='out' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR lname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pphone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR gender LIKE "%'.$_POST["search"]['value'].'%")';
				}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY fname ASC ';
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
						$image = '<img src="images/default.png" width="50px" height="50px" />';
					}else{
						$image = '<img src="passports/'.$row['passport'].'" width="50px" height="50px" />';
					}
					if($row['status'] =='in'){
						$status = '<input type="button" value="Check out" name="check" id="'.$row['cl_id'].'"" class="btn btn-success btn-sm check">';
					}else {
						$status = '<input type="button" value="Check in" name="check" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm check">';
					}
					$sub_array = array();
					$sub_array[] = $row['fname'].' '.$row['lname'];
					$sub_array[] = $image;
					$sub_array[] = $row['phone'];
					$sub_array[] = $row['id_no'];
					$sub_array[] = '<input type="button" value="More details"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-warning btn-sm view_data" />';
					$sub_array[] = '<input type="button" value="Edit"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-primary btn-sm client_edit" />';
					$sub_array[] = $status;
					$sub_array[] = '<input type="button" value="Delete" name="delete" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm delete">';
					$data[] = $sub_array;
				}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>get_checkedout_clients($con),
				"data"			=>	$data	
			);
			echo json_encode($output);
		}/*else{
			echo json_encode(mysqli_error($con));
		}*/
		
		}
		function get_checkedout_clients($con){
			$q = "SELECT * FROM clients WHERE host_id='".$_POST['hostel_id']."' AND status='out'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//CHECKED IN CLIENTS TABLE
		if(isset($_POST['view_checkedin_clients'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM clients WHERE host_id= '".$_POST['hostel_id']."' AND status='in' AND";
			if(isset($_POST["search"]['value'])){
				$query .= '(fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR lname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pphone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR gender LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY fname ASC ';
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
						$image = '<img src="images/default.png" width="50px" height="50px" />';
					}else{
						$image = '<img src="passports/'.$row['passport'].'" width="50px" height="50px" />';
					}
					if($row['status'] =='in'){
						$status = '<input type="button" value="Check out" name="check" id="'.$row['cl_id'].'"" class="btn btn-success btn-sm check">';
					}else {
						$status = '<input type="button" value="Check in" name="check" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm check">';
					}
					$sub_array = array();
					$sub_array[] = $row['fname'].' '.$row['lname'];
					$sub_array[] = $image;
					$sub_array[] = $row['phone'];
					//$sub_array[] = $row['rm_no'];
					$sub_array[] = $row['id_no'];
					$sub_array[] = '<input type="button" value="More details"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-warning btn-sm view_data" />';
					$sub_array[] = '<input type="button" value="Edit"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-primary btn-sm client_edit" />';
					$sub_array[] = $status;
					$sub_array[] = '<input type="button" value="Delete" name="delete" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm delete">';
					$sub_array[] = '<input type="button" value="Edit"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-primary btn-sm client_edit" />';
					$sub_array[] = $status;
					$sub_array[] = '<input type="button" value="Delete" name="delete" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm delete">';
					$data[] = $sub_array;
				}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>get_checkedin_clients($con),
				"data"			=>	$data	
			);
			echo json_encode($output);
		}
		}
		function get_checkedin_clients($con){
			$q = "SELECT * FROM clients WHERE  host_id= '".$_POST['hostel_id']."' AND status='in'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//GETTING ALL CLIENTS DATA TO THE CLIENTS TABLE
		if(isset($_POST['view_clients'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM clients WHERE host_id= '".$_POST['hostel_id']."' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR lname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR phone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR id_no LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pphone LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR pname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR gender LIKE "%'.$_POST["search"]['value'].'%")';
				}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY fname ASC ';
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
						$image = '<img src="images/default.png" width="50px" height="50px" />';
					}else{
						$image = '<img src="passports/'.$row['passport'].'" width="50px" height="50px" />';
					}
					if($row['status'] =='in'){
								$status = '<input type="button" value="Check out" name="check" id="'.$row['cl_id'].'"" class="btn btn-success btn-sm check">';
							}else {
								$status = '<input type="button" value="Check in" name="check" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm check">';
					}
					$sub_array = array();
					$sub_array[] = $row['fname'].' '.$row['lname'];
					$sub_array[] = $image;
					$sub_array[] = $row['phone'];
					//$sub_array[] = $row['rm_no'];
					$sub_array[] = $row['id_no'];
					$sub_array[] = '<input type="button" value="More details"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-warning btn-sm view_data" />';
					$sub_array[] = '<input type="button" value="Edit"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-primary btn-sm client_edit" />';
					$sub_array[] = $status;
					$sub_array[] = '<input type="button" value="Delete" name="delete" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm delete">';
					$sub_array[] = '<input type="button" value="Edit"  id= "'.$row['cl_id'].'" data-hostellist="'.$row['host_id'].'"" class="btn btn-primary btn-sm client_edit" />';
					$sub_array[] = $status;
					$sub_array[] = '<input type="button" value="Delete" name="delete" id="'.$row['cl_id'].'" class="btn btn-danger btn-sm delete">';
					$data[] = $sub_array;
				}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>get_all_clients($con),
				"data"			=>	$data	
			);
			echo json_encode($output);
		}
		}
		function get_all_clients($con){
			$q = "SELECT * FROM clients WHERE  host_id= '".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//POPULATING CLIENTS DETAILS TO THE EDIT CLIENTS MODAL WINDOW INPUT FIELDS
		if(isset($_POST['edit_cliet_details'])){
			$query = "SELECT * FROM ((clients INNER JOIN universities ON clients.uni_id=universities.uni_id)LEFT OUTER JOIN room_numbers ON clients.rm_id=room_numbers.rm_id) WHERE cl_id='".$_POST['cid']."'";
			$runQuery = mysqli_query($con, $query);
			$output = array();
			while($row=mysqli_fetch_array($runQuery)){
				$output['cl_id'] = $row['cl_id'];
				$output['fname'] = $row['fname'];
				$output['lname'] = $row['lname'];
				$output['phone'] = $row['phone'];
				$output['email'] = $row['email'];
				$output['uni_id'] = $row['uni_id'];
				$output['uni_name'] = $row['uni_name'];
				$output['pname'] = $row['pname'];
				$output['pphone'] = $row['pphone'];
				$output['rm_no'] = $row['rm_no'];
				$output['id_no'] = $row['id_no'];
				$output['join_date'] = $row['join_date'];
				$output['passport'] = $row['passport'];
				$output['gender'] = $row['gender'];
				$output['course'] = $row['course'];
				$output['status'] = $row['status'];
				$output['discount'] = $row['discount'];
			}
			echo json_encode($output);
		}
	//CONFIRMING IF THE CLIENT EXISTS BEFOR POSTING THE DATA TO THE PAYMENT DATABASE
		if(isset($_POST['check_id_payment'])){
			$getId = "SELECT * FROM clients WHERE id_no='".$_POST['idNo']."' AND host_id='".$_POST['hostel_id']."'";
			$runId = mysqli_query($con, $getId);
			$count = mysqli_num_rows($runId);
			if($count > 0){
				echo "<i style='color:#008000;'>Record available. Please continue with payment!</i>";
			}else{
				echo "<i style='color:#FF0000'>The client with the ID Number does not exist. Please check that you have entered the correct value!</i>";
			}
		}
	//EDITING CLIENTS INFORMATION
		if(isset($_POST['edit_client'])){
			$cl_id = mysqli_real_escape_string($con, $_POST['cl_id']);
			$fname = mysqli_real_escape_string($con, $_POST['fname']);
			$lname = mysqli_real_escape_string($con, $_POST['lname']);
			$cphone = mysqli_real_escape_string($con, $_POST['cphone']);
			$cnumber = mysqli_real_escape_string($con, $_POST['cnumber']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$institution = mysqli_real_escape_string($con, $_POST['institution']);
			$pname = mysqli_real_escape_string($con, $_POST['pname']);
			$pphone = mysqli_real_escape_string($con, $_POST['pphone']);
			$room_no = mysqli_real_escape_string($con, $_POST['room_no']);
			$course = mysqli_real_escape_string($con, $_POST['course']);
			$discount = mysqli_real_escape_string($con, $_POST['discount']);
			$hostel = $_POST['hostel_id'];
			$action = $_POST['action'];
			$gender = $_POST['gender'];
			if($action == 'edit'){
				$q = "UPDATE clients SET fname='".$fname."',lname='".$lname."',id_no='".$cnumber."',phone='".$cphone."',email='".$email."',pphone='".$pphone."',pname='".$pname."',course='".$course."',gender='".$gender."',rm_id='".$room_no."',discount='".$discount."' WHERE cl_id='".$cl_id."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo "<label class='alert alert-success'>You have successfully updated clients information</label>";
				}else{
					echo mysqli_error($con);
				}
			}else if($action == 'save'){
				$q = "SELECT * FROM clients WHERE id_no='$cnumber' AND host_id='$hostel'";
				$rQ = mysqli_query($con, $q);
				if(mysqli_num_rows($rQ) > 0){
					echo "<label class='alert alert-danger'>The ID NUMBER entered already exists. Please check the clients checkin/checkout to edit the details!</label>";
				}else{
					$q = "INSERT INTO clients (fname,lname,id_no,phone,uni_id,email,pphone,pname,course,gender,host_id,rm_id,course,status,discount,join_date) VALUES('$fname','$lname','$cnumber','$cphone','$institution','$email','$pphone','$pname','$course','$gender','$hostel','$room_no','$course','in','$discount',now())";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						echo "<label class='alert alert-success'>You have successfully added a client</label>";
					}else{
						echo mysqli_error($con);
					}
				}
			}
			
		}
	//DELETING CLIENTS DETAILS FROM THE DATABASE
		if(isset($_POST['delete_client'])){
			$deleteId = $_POST['cid'];
			$deleteClient = "DELETE FROM clients where cl_id='$deleteId'";
			$runClient = mysqli_query($con, $deleteClient);
			if($runClient){
				echo "Client has been successfully deleted";
			}
		}
	//CHANGING THE STATUS OF CLIENTS
		if(isset($_POST['changeClientStatus'])){
			$get_client = "SELECT * from clients WHERE cl_id='".$_POST['chsid']."'";
			$run_client = mysqli_query($con, $get_client);
			$row_client = mysqli_fetch_array($run_client);
			$status = $row_client['status'];
		      if($status == 'in'){
			      	$q = "UPDATE clients SET status='out',rm_id='' WHERE cl_id='".$_POST['chsid']."'";
			      	$rQ = mysqli_query($con, $q);
			      	if($rQ){
			      		echo "You have successfully updated clients record";
			      	}else{
			      		echo mysqli_error($con);
			      	}
				}else {
					$q = "UPDATE clients SET status='in' WHERE cl_id='".$_POST['chsid']."'";
		      		$rQ = mysqli_query($con, $q);
		      		if($rQ){
		      			echo "You have successfully updated clients record";
		      		}else{
		      			echo mysqli_error($con);
		      		}
					
				}
				
			}
	//DISPLAYING MORE INFORMATION ABOUT CLIENTS IN THE ADMIN SECTION
		if(isset($_POST['view_client_details'])){
			$output = '';
			$query = "SELECT * FROM ((clients LEFT OUTER JOIN room_numbers ON clients.rm_id=room_numbers.rm_id) LEFT OUTER JOIN universities ON clients.uni_id=universities.uni_id) WHERE cl_id='".$_POST['cid']."'";
			$runQuery = mysqli_query($con, $query);
			echo mysqli_error($con);
			$output .='
				<div class="row">
					<div class="col-lg-9 col-md-9" >
						<div class="table-responsive">
							<table class="table table-bordered">
					';
			while($row=mysqli_fetch_array($runQuery)){
				$output .='
							<tr>
								<td><label>Name:</label></td>
								<td>'.$row['fname'].' '.$row['lname'].'</td>
							</tr>
							<tr>
								<td><label>ID No</label></td>
								<td>'.$row['id_no'].'</td>
							</tr>
							<tr>
								<td><label>Phone no:</label></td>
								<td>'.$row['phone'].'</td>
							</tr>
							<tr>
								<td><label>Room</label></td>
								<td>'.$row['rm_no'].'</td>
							</tr>
							<tr>
								<td><label>Institution</label></td>
								<td>'.$row['uni_name'].'</td>
							</tr>
							<tr>
								<td><label>Email</label></td>
								<td>'.$row['email'].'</td>
							</tr>
							<tr>
								<td><label>P/G Names:</label></td>
								<td>'.$row['pname'].'</td>
							</tr>
							<tr>
								<td><label>P/G phone no:</label></td>
								<td>'.$row['pphone'].'</td>
							</tr>
							<tr>
								<td><label>Registration date:</label></td>
								<td>'.$row['join_date'].'</td>
							</tr>
							</table>
							</div>
						</div>
						<div class="col-lg-3 col-md-3">
						';
						if($row['passport'] == ''){
							$output .= '<img src="images/default.png" width="100%" style="border:2px solid #000000;" />';
						}else{
							$output .= '<img src="passports/"'.$row['passport'].' width="100%" style="border:2px solid #000000;" />';
						}
				echo '	</div>
						';
			}
			$output .= '</div>';
			echo $output;
		}
	//DELETING TRANSACTIONS DETAILS
		if(isset($_POST['delt_transaction'])){
			$deleteId2 = $_POST['trans_id'];
			$deleteTrans = "DELETE FROM transactions where t_id='$deleteId2'";
			$runClient = mysqli_query($con, $deleteTrans);
			if($runClient){
				echo "The transactions has been successfully deleted!";
			}
		}
	//FILLING THE TRANSACTION FORM WITH DATA FOR EDITING
		if(isset($_POST['edit_trans_details'])){
			$q = "SELECT * FROM transactions INNER JOIN account_name ON transactions.acn_id=account_name.acn_id WHERE t_id='".$_POST['trans_id']."'";
			$rQ = mysqli_query($con, $q);
			$trans_details = array();
			while($row = mysqli_fetch_array($rQ)){
				$trans_details['acn_id'] = $row['acn_id'];
				$trans_details['description'] = $row['Description'];
				$trans_details['amount'] = $row['amount'];
				$trans_details['acn_name'] = $row['acn_name'];
			}
			echo json_encode($trans_details);
		}
/////////////////////////////////////////////////EMPLOYEES SECTION///////////////////////////////////////////////////////////////////
	//EMPLOYEES TABLE DATA
		if(isset($_POST['view_employees'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM employees WHERE host_id='".$_POST['hostel_id']."' AND ";
			if(isset($_POST["search"]['value'])){
				$query .= '(emp_fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR emp_lname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR emp_email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR emp_phone LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY emp_fname ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					if($row['emp_passport'] == ''){
						$image = '<img src="images/default.png" width="50px" height="50px" />';
					}else{
						$image = '<img src="passports/'.$row['emp_passport'].'" width="50px" height="50px" />';
					}
					$sub_array = array();
					$sub_array[] = $row['emp_fname'].' '.$row['emp_lname'];
					$sub_array[] = $image;
					$sub_array[] = $row['emp_idno'];
					$sub_array[] = $row['emp_phone'];
					$sub_array[] = $row['emp_email'];
					$sub_array[] = $row['emp_salary'];
					$sub_array[] = $row['emp_date'];
					$sub_array[] = '<input type="submit" id="'.$row['emp_id'].'"class="btn btn-primary btn-xs edit_employees" value="Edit" />';
					$sub_array[] = '<input type="button" class="btn btn-danger btn-xs emp_del" value="Delete" id='.$row['emp_id'].'/>';
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_all_employees($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		
		}
		function get_all_employees($con){
			$q = "SELECT * FROM employees WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//EMPLOYEES SALARY TABLE
		if(isset($_POST['view_employees_salary'])){
			$query = "";
			$output = array();
			$query .= "SELECT * FROM salaries INNER JOIN employees ON salaries.emp_idno=employees.emp_idno WHERE host_id='".$_POST['hostel_id']."' AND";
			if(isset($_POST["search"]['value'])){
				$query .= '(emp_fname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR emp_lname LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR salaries.emp_idno LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR emp_email LIKE "%'.$_POST["search"]['value'].'%"';
				$query .= 'OR emp_phone LIKE "%'.$_POST["search"]['value'].'%")';
			}
			if(isset($_POST["order"])){
				$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}else{
				$query .= 'ORDER BY emp_fname ASC ';
			}
			if($_POST["length"] != -1){
				$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
			}
			$runQuery = mysqli_query($con, $query);
			if($runQuery){
				$data = array();
				$noOfRows = mysqli_num_rows($runQuery);
				while($row = mysqli_fetch_array($runQuery)){
					if($row['emp_passport'] == ''){
						$image = '<img src="images/default.png" width="50px" height="50px" />';
					}else{
						$image = '<img src="passports/'.$row['emp_passport'].'" width="50px" height="50px" />';
					}
					$sub_array = array();
					$sub_array[] = $row['emp_fname'].' '.$row['emp_lname'];
					$sub_array[] = $image;
					$sub_array[] = $row['emp_idno'];
					$sub_array[] = $row['sal_amount'];
					$sub_array[] = $row['sal_date'];
					$sub_array[] = '<button type="button" class="btn btn-danger sal_delete" id="'.$row['sal_id'].'">Delete</button>';
					$data[] = $sub_array;
				}
				$output = array(
					"draw"			=>	intval($_POST["draw"]),
					"recordsTotal"	=>	$noOfRows,
					"recordsFiltered" =>get_employee_salary($con),
					"data"			=>	$data	

				);
				echo json_encode($output);
			}else{
				echo mysqli_error($con);
			}
		}
		function get_employee_salary($con){
			$q = "SELECT * FROM salaries INNER JOIN employees ON salaries.emp_idno=employees.emp_idno WHERE host_id='".$_POST['hostel_id']."'";
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//DELETING EMPLOYEES FROM THE DATABASE
		if(isset($_POST['emp'])){
			$emp = $_POST['emp'];
			$q1 = "DELETE FROM employees WHERE emp_id='$emp'";
			$rQ1 = mysqli_query($con, $q1);
			if($rQ1){
				echo "You have successfully deleted an employee!";
			}
		}
	//POSTING EMPLOYEES DATA TO THE DATABASE
		if(isset($_POST['editemployeedetails'])){
			$fname = mysqli_real_escape_string($con, $_POST['fname']);
			$lname = mysqli_real_escape_string($con, $_POST['lname']);
			$phone = mysqli_real_escape_string($con, $_POST['phone']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$idno = mysqli_real_escape_string($con, $_POST['idno']);
			$salary = mysqli_real_escape_string($con, $_POST['salary']);
			$employeeid = mysqli_real_escape_string($con, $_POST['employeeid']);
			$btnaction = mysqli_real_escape_string($con, $_POST['btnaction']);
			$hostel = mysqli_real_escape_string($con, $_POST['hostel_id']);
			if($btnaction == 'edit'){
				$q = "UPDATE employees SET emp_phone='".$phone."',emp_fname='".$fname."',emp_lname='".$lname."',emp_idno='".$idno."',emp_email='".$email."',emp_salary='".$salary."' WHERE emp_id='".$employeeid."'";
			}else{
				$q = "INSERT INTO employees (emp_phone,emp_fname,emp_lname,emp_idno,emp_email,emp_salary,host_id) VALUES('$phone','$fname','$lname','$idno','$email','$salary','$hostel')";
			}
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo '<div class="alert alert-success">Records has been successfully updated</div>';
			}
		}
	//GETTING EMPLOYEE SALARY DETAILS FROM THE DATABASE AND POPULATING IT TO THE SALARY SECTION
		if(isset($_POST['get_employee_salary'])){
			$q = "SELECT emp_salary FROM employees WHERE emp_idno = '".$_POST['idno']."'";
			$rQ = mysqli_query($con, $q);
			$getSal = mysqli_fetch_array($rQ);
			echo $getSal['emp_salary'];
		}
	//DELETING EMPLOYEES FROM THE DATABASE
		if(isset($_POST['delete_salary'])){
			$q = "DELETE FROM salaries WHERE sal_id='".$_POST['del_sal_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'The salary has been successfully deleted';
			}
		}
	//COLLECTING EMPLOYEES DETAILS FROM THE DATABASE AND FILLING THE EMPLOYEES FORM
		if(isset($_POST['edit_employees_form_data'])){
			$q = "SELECT * FROM employees WHERE emp_id='".$_POST['emp_id']."'";
			$rQ = mysqli_query($con, $q);
			$empDetais = array();
			while($row = mysqli_fetch_array($rQ)){
				$empDetails['emp_id'] = $row['emp_id'];
				$empDetails['emp_passport'] = $row['emp_passport'];
				$empDetails['emp_fname'] = $row['emp_fname'];
				$empDetails['emp_phone'] = $row['emp_phone'];
				$empDetails['emp_lname'] = $row['emp_lname'];
				$empDetails['emp_idno'] = $row['emp_idno'];
				$empDetails['emp_email'] = $row['emp_email'];
				$empDetails['emp_salary'] = $row['emp_salary'];
			}
			echo json_encode($empDetails);
		}
	//ENSURING THE ROOM CATEGORY IS LINKED TO ROOM NUMBER
		if(isset($_POST['rmcatid'])){
			$q = "SELECT * FROM room_numbers WHERE cat_id='".$_POST['rmcatid']."'";
			$rQ = mysqli_query($con, $q);
			$c = mysqli_num_rows($rQ);
				if($c > 0){
					while($row=mysqli_fetch_array($rQ)){
						echo "<option value='".$row['rm_id']."'>".$row['rm_no']."</option>";
					}
				}else{
					echo "<option value='default' style='color:#FF0000;'>Room number for this category is unavailable!Please go to room photos section to add!</option>";
				}
			
		}
///////////////////////////////////////////////////////////ADMINS SECTION//////////////////////////////////////////////
	//SYSTEM ADMINS TABLE USING BOOTSTRAP DATA TABLE PLUGIN
		if(isset($_POST['view_system_admins'])){
			$query = "";
			$output = array();
		$query .= "SELECT * FROM hostel_admins WHERE host_id=".$_POST['hostel_id']." AND ";
		if(isset($_POST["search"]['value'])){
			$query .= '(admin_fname LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR admin_lname LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR admin_email LIKE "%'.$_POST["search"]['value'].'%"';
			$query .= 'OR admin_phone LIKE "%'.$_POST["search"]['value'].'%")';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}else{
			$query .= 'ORDER BY admin_fname ASC ';
		}
		if($_POST["length"] != -1){
			$query .='LIMIT '.$_POST['start'].', '.$_POST['length'];
		}
		$runQuery = mysqli_query($con, $query);
		if($runQuery){
			$data = array();
			$noOfRows = mysqli_num_rows($runQuery);
			while($row = mysqli_fetch_array($runQuery)){
				if($row['profile_pic'] == ''){
					$image = '<img src="images/default.png" width="50px" height="50px" />';
				}else{
					$image = '<img src="passports/'.$row['profile_pic'].'" width="50px" height="50px" />';
				}
				if($row['admin_status'] == 1){
					$status = '<input type="button" value="Active" id="'.$row['admin_id'].'" class="btn btn-xs btn-success admin_state" />';
				}else{
					$status = '<input type="button" value="Inactive" id="'.$row['admin_id'].'" class="btn btn-xs btn-warning admin_state"  />';
				}
				$sub_array = array();
				$sub_array[] = $row['admin_fname'].' '.$row['admin_lname'];
				$sub_array[] = $image;
				$sub_array[] = $row['admin_email'];
				$sub_array[] = $row['admin_phone'];
				$sub_array[] = '<input type="button" value="Edit" id="'.$row['admin_id'].'" class="btn btn-primary edit_sysuser" /> ';
				$sub_array[] = $status;
				$sub_array[] = '<button type="button" id="'.$row['admin_id'].'" class="btn btn-danger admin_delete">Delete</button>';
				$data[] = $sub_array;
			}
			$output = array(
				"draw"			=>	intval($_POST["draw"]),
				"recordsTotal"	=>	$noOfRows,
				"recordsFiltered" =>get_all_system_users($con),
				"data"			=>	$data	

			);
			echo json_encode($output);
		}else{
			echo mysqli_error($con);
		}
		
		}
		function get_all_system_users($con){
			$q = "SELECT * FROM hostel_admins WHERE host_id=".$_POST['hostel_id'];
			$rQ = mysqli_query($con, $q);
			return mysqli_num_rows($rQ);
		}
	//DELETING SYSTEM USERS FROM THE DATABASE
		if(isset($_POST['adDel'])){
			$id = $_POST['adDel'];
			$q = "SELECT * FROM hostel_admins WHERE admin_id='$id'";
			$qRy = mysqli_query($con, $q);
			$row = mysqli_fetch_array($qRy);
			if($row['profile_pic'] != ''){
				unlink("passports/".$row['profile_pic']);
			}
			$deleteAdmin = "DELETE FROM hostel_admins where admin_id='$id'";
			$runAdmin = mysqli_query($con, $deleteAdmin);
			if($runAdmin){
				echo "Admins has been successfully deleted";
			}else{
				echo "Program failed!";
			}
		}
	//ACTIVATING AND DEACTIVATING ADMINISTRATORS
		if(isset($_POST['change_admin_status'])){
			$get_admin = "SELECT * FROM hostel_admins WHERE admin_id='".$_POST['adId']."'";
			$rAd = mysqli_query($con, $get_admin);
			$row = mysqli_fetch_array($rAd);
			$state = $row['admin_status'];
			$id = $row['admin_id'];
			if($state == 1){
				$q = "UPDATE hostel_admins SET admin_status=0 WHERE admin_id='".$_POST['adId']."'";
				$rQ = mysqli_query($con, $q);
				echo "<input type='button' value='Inactive' class='btn btn-xs btn-warning admin_state' id='$id'/>";
			} else {
				$q = "UPDATE hostel_admins SET admin_status=1 WHERE admin_id='".$_POST['adId']."'";
				$rQ = mysqli_query($con, $q);
				echo "<input type='button' value='Active' class='btn btn-xs btn-info admin_state' id='$id'/>";
			}
		}
	//INSERTING AND UPDATING ADMIN DETAILS
		if(isset($_POST['insert_admin_action'])){
			$user_id = $_POST['sys_id'];
			$hostel = $_POST['hostel_id'];
			$fname = mysqli_real_escape_string($con, $_POST['fname']);
			$lname = mysqli_real_escape_string($con, $_POST['lname']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$phone = mysqli_real_escape_string($con, $_POST['phone']);
			$password = md5(mysqli_real_escape_string($con, $_POST['password']));
			$btn_action = mysqli_real_escape_string($con, $_POST['btn_action']);
			$user_type = mysqli_real_escape_string($con, $_POST['user_type']);
			if($btn_action == 'Edit'){
				$q = "UPDATE hostel_admins SET admin_fname='$fname', admin_lname='$lname',admin_email='$email',admin_phone='$phone',user_type='$user_type' WHERE admin_id='$user_id'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo '<div class="alert alert-success">You have successfully updated admins details</div>';
				}else{
					echo '<div class="alert alert-danger">There was an error while updating students records</div>';
				}
			}
			if($btn_action == 'Insert'){
				$qr = "SELECT * FROM hostel_admins WHERE admin_email = '$email'";
				$rQry = mysqli_query($con, $qr);
				if(mysqli_num_rows($rQry) > 0){
					echo '<div class="alert alert-danger">The email address entered already exists!Please ensure you have entered the correct email!</div>';
				}else{
					$q = "INSERT INTO hostel_admins (admin_fname,admin_lname,admin_email,admin_phone,admin_password,host_id) VALUES('$fname','$lname','$email','$phone','$password','$hostel')";
					$rQ = mysqli_query($con, $q);
					if($rQ){
						echo '<div class="alert alert-success">You have successfully added an admin</div>';
					}
				}
			}
		}
	//EDITING ADMINS DETAILS
		if(isset($_POST['edit_admin'])){
			$q = "SELECT * FROM hostel_admins WHERE admin_id='".$_POST['sys_id']."'";
			$rQ = mysqli_query($con, $q);
			$data = array();
			while($rw = mysqli_fetch_array($rQ)){
				$data["admin_id"] = $rw["admin_id"];
				$data["admin_FName"] = $rw["admin_fname"];
				$data["admin_LName"] = $rw["admin_lname"];
				$data["admin_Email"] = $rw["admin_email"];
				$data["phone"] = $rw["admin_phone"];
				$data["status"] = $rw["admin_status"];
				$data["user"] = $rw["user_type"];
			}
			echo json_encode($data);
		}
	//CHANGING AN ADMINS PROFILE IMAGE
		if(isset($_POST['changeadmnProfileId'])){
			if($_FILES['changeAdminProfile']['name'] != ''){
				$qry = "SELECT * FROM hostel_admins WHERE admin_id='".$_POST['changeadmnProfileId']."'";
				$rQry = mysqli_query($con, $qry);
				$rw = mysqli_fetch_array($rQry);
				if($rQry){
					unlink("passports/".$rw['profile_pic']);
				}
				$q = "UPDATE hostel_admins SET profile_pic='".$_FILES['changeAdminProfile']['name']."' WHERE admin_id='".$_POST['changeadmnProfileId']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					move_uploaded_file($_FILES['changeAdminProfile']['tmp_name'], "passports/".$_FILES['changeAdminProfile']['name']);
					echo "passports/".$_FILES['changeAdminProfile']['name'];
				}else{
					echo mysqli_error($con);
				}
			}else{
				echo 'No file selected';
			}
		}
	//CHANGING HOSTELS IMAGE IN THE ADMIN SECTION
		if(isset($_POST['change_hostel_image'])){
			echo "Hello";
			if($_FILES['changehostelImg']['name'] != ''){
				$qry = "SELECT * FROM hostels WHERE host_id='".$_POST['hostel_id']."'";
				$rQry = mysqli_query($con, $qry);
				$rw = mysqli_fetch_array($rQry);
				if($rQry){
					unlink("../system_admin/images/".$rw['host_image']);
				}
				$q = "UPDATE hostels SET host_image='".$_FILES['changehostelImg']['name']."' WHERE host_id='".$_POST['hostel_id']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					move_uploaded_file($_FILES['changehostelImg']['tmp_name'], "../system_admin/images/".$_FILES['changehostelImg']['name']);
					echo "../system_admin/images/".$_FILES['changehostelImg']['name'];
				}else{
					echo mysqli_error($con);
				}
			}else{
				echo 'No file selected';
			}
		}
?>
<?php
	include_once("db.php");
///////////////////////////////////////////////////////////SYSTEM ADMIN SECTION/////////////////////////
	//DELETING MESSAGE FROM THE DATABASE
		if(isset($_POST['delete_message'])){
			$q = "DELETE FROM admins_messages WHERE mes_id='".$_POST['mes_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'Records have been successfully updated';
			}
		}
	//DELETING HELP SUPPORT
		if(isset($_POST['delete_help_support'])){
			$q = "DELETE FROM help_support WHERE help_id='".$_POST['help_support_id']."'";
			$rQ = mysqli_query($con, $q);
			if($rQ){
				echo 'Data has been successfully deleted!';
			}
		}
	//POPULATING THE EDIT HELP AND SUPPORT FORM WITH DATA
		if(isset($_POST['help_support_data'])){
			$q = "SELECT * FROM help_support WHERE help_id='".$_POST['help_support_id']."'";
			$rQ = mysqli_query($con, $q);
			$data = array();
			while($row = mysqli_fetch_array($rQ)){
				$data['s_id'] = $row['help_id'];
				$data['help_title'] = $row['title'];
				$data['id_attr'] = $row['id_attr'];
				$data['title_summary'] = $row['title_summary'];
				$data['help_content'] = $row['content'];
			}
			echo json_encode($data);
		}
	//SAVING THE HELP AND SUPPORT FORM CONTENT TO THE DATABASE
		if(isset($_POST['save_help_support'])){
			$title = mysqli_real_escape_string($con, $_POST['title']);
			$id_attr = mysqli_real_escape_string($con, $_POST['id_attr']);
			$title_sum = mysqli_real_escape_string($con, $_POST['title_sum']);
			$content = mysqli_real_escape_string($con, $_POST['content']);
			if($_POST['btn_action'] == 'save'){
				$q = "INSERT INTO help_support(title,id_attr,title_summary,content,post_date) VALUES('$title','$id_attr','$title_sum','$content',now())";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo '<div class="alert alert-success">You have successfully added a help and support content!</div>';
				}else{
					echo mysqli_error($con);
				}
			}
			if($_POST['btn_action'] == 'edit'){
				$q = "UPDATE help_support SET title='$title',id_attr='$id_attr',title_summary='$title_sum',content='$content' WHERE help_id='".$_POST['s_id']."'";
				$rQ = mysqli_query($con, $q);
				if($rQ){
					echo '<div class="alert alert-success">A record has been successfully updated!</div>';
				}else{
					echo mysqli_error($con);
				}
			}
		}
	//DISPLAYING HELP AND SUPPORT CONTENT ON A TABLE IN THE ADMIN SECTION
		if(isset($_POST['view_help_support'])){
				$query = "";
				$output = array();
				$query .= "SELECT * FROM help_support WHERE ";
				if(isset($_POST["search"]['value'])){
					$query .= '(title LIKE "%'.$_POST["search"]['value'].'%"';
					$query .= 'OR id_attr LIKE "%'.$_POST["search"]['value'].'%"';
					$query .= 'OR title_summary LIKE "%'.$_POST["search"]['value'].'%"';
					$query .= 'OR content LIKE "%'.$_POST["search"]['value'].'%")';
				}
				if(isset($_POST["order"])){
					$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
				}else{
					$query .= 'ORDER BY help_id ASC ';
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
						$sub_array[] = $row['title'];
						$sub_array[] = $row['id_attr'];
						$sub_array[] = $row['title_summary'];
						$sub_array[] = '<input type="button" class="btn btn-primary btn-xs edit_help_support" value="Edit" id='.$row['help_id'].'/>';
						$sub_array[] = '<input type="button" class="btn btn-danger btn-xs delete_help_support" value="Delete" id='.$row['help_id'].'/>';
						$data[] = $sub_array;
					}
					$output = array(
						"draw"			=>	intval($_POST["draw"]),
						"recordsTotal"	=>	$noOfRows,
						"recordsFiltered" =>get_all_support($con),
						"data"			=>	$data	

					);
					echo json_encode($output);
				}else{
					echo mysqli_error($con);
				}
			
			}
			function get_all_support($con){
				$q = "SELECT * FROM help_support";
				$rQ = mysqli_query($con, $q);
				return mysqli_num_rows($rQ);
			}
/////////////////////////////////////////////BLOG SECTION////////////////////////////////////////////
	//SEARCH THE BLOG
		if(isset($_POST['search_blog'])){
			$q = "SELECT * FROM help_support WHERE title LIKE '%".$_POST['search_blog']."%' OR id_attr LIKE '%".$_POST['search_blog']."%' OR title_summary LIKE '".$_POST['search_blog']."' OR content LIKE '".$_POST['search_blog']."'";
			$rQ = mysqli_query($con, $q);
			echo mysqli_error($con);
			while($row = mysqli_fetch_array($rQ)){
				echo'
					<div id="'.$row['id_attr'].'">
						<h3 style="text-align:center;">'.$row['title'].'</h3>
								'.$row['content'].'
					</div>
				';
			}
		}
	//LOADING BLOG CONTENT
		if(isset($_GET['blogLimit'], $_GET['blogStart'])){
			$q = "SELECT * FROM help_support ORDER BY help_id ASC LIMIT ".$_GET['blogStart'].", ".$_GET['blogLimit']."";
			$rQ = mysqli_query($con, $q);
			echo mysqli_error($con);
			while($row = mysqli_fetch_array($rQ)){
				echo'
					<div id="'.$row['id_attr'].'">
						<h3 style="text-align:center;">'.$row['title'].'</h3>
								'.$row['content'].'
					</div>
				';
			}
		}
//////////////////////////////////////////////////////////////////////HOME PAGE SECTION///////////////////////////////////
	//LOADING HOSTELS CONTENT ON THE HOME PAGE
		if(isset($_GET['limit'], $_GET['start'])){
			if($_GET['category'] == 'unavailable'){
				$get_host = "SELECT * FROM hostels ORDER BY host_id DESC LIMIT ".$_GET['start'].", ".$_GET['limit']."";
				$q = "SELECT * FROM hostels";
				$rQ = mysqli_query($con, $q);
				$count = mysqli_num_rows($rQ);
			}else{
				$cat_id = $_GET['category'];
				$get_host = "SELECT * FROM hostels  where host_cat=$cat_id ORDER BY host_id DESC LIMIT ".$_GET['start'].", ".$_GET['limit']."";
				$q = "SELECT * FROM hostels  where host_cat='".$cat_id."'";
				$rQ = mysqli_query($con, $q);
				$count = mysqli_num_rows($rQ);
			}
			if($count > 0){
				$run_host = mysqli_query($con, $get_host);
					while($row_host = mysqli_fetch_array($run_host)){
						$host_id = $row_host['host_id'];
						$host_cat = $row_host['host_cat'];
						$host_loc = $row_host['location'];
						$host_name = $row_host['host_name'];
						$host_link = $row_host['hostel_link'];
						$contact1 = $row_host['contact1']; 
						$contact2 = $row_host['contact2']; 
						$email = $row_host['email']; 
						$address = $row_host['postal_address'];
						$host_image = $row_host['host_image']; 
						$content = $row_host['hostel_description'];
						echo "
								<div id='hostels' class='col-lg-4 col-md-4 col-sm-4 col-6'>
									<div class='card border-secondary mb-3 hostels_home_display'>
										<a href='hostels/".$host_link."?hsl=".$host_id."' target='_blank' title='Click here to visit the hostels website'>
											<img class='image' src='system_admin/images/$host_image' width='100%' />
											<p class='card-title' style='padding:2px;'>$host_name </p>
											<p class='card-title' style='padding:2px;'>$host_loc </p>
											<p class='card-title contact' style=' padding:2px; color:#808080; white-space:nowrap;overflow:hidden;text-overflow:ellipsis;'>
												Email: $email<br />
												Call: $contact1/$contact2<br />
											</p>
										</a>
									</div>

								</div>
										";
							
					}
			}else{
				echo 'unavailable';
			}
		}
	//SEARCHING THE DATABASE FOR HOSTEL
		if(isset($_POST['query'])){
			$qName = $_POST['query'];
			$q = "SELECT * FROM hostels WHERE host_name LIKE '%".$_POST['query']."%' OR location LIKE '%".$_POST['query']."%' OR host_keywords LIKE '%".$_POST['query']."%' ";
			$rQ = mysqli_query($con, $q);
			echo mysqli_error($con);
			if(mysqli_num_rows($rQ) > 0){
				while($row_host = mysqli_fetch_array($rQ)){
					$host_id = $row_host['host_id'];
					$host_cat = $row_host['host_cat'];
					$host_loc = $row_host['location'];
					$host_name = $row_host['host_name'];
					$host_link = $row_host['hostel_link'];
					$contact1 = $row_host['contact1']; 
					$contact2 = $row_host['contact2']; 
					$host_image = $row_host['host_image']; 
					$content = $row_host['hostel_description'];
					echo "
							<div id='hostels' class='col-lg-3 col-md-4 col-sm-4 col-6 hostels_home_display'>
								<div class='card border-secondary mb-3'>
									<a href='hostels/".$host_link."?hsl=".$host_id."' target='_blank' title='Click here to visit the hostels website'>
										<img class='image' src='system_admin/images/$host_image' width='100%' />
										<p class='card-title' style='padding:2px;'>$host_name </p>
										<p class='card-title' style='padding:2px;'>$host_loc </p>
										<p class='hostel_desc_content' style='text-align:justify; color:#000;padding:4px;'>";
										$content = strip_tags($content);
										if(strlen($content) > 100){
											$str = substr($content, 0, 100);
											$strpos = substr($str, 0, strrpos($str, ' ')).'.....<span style="font-weight:bolder; color:#008000;">Read More</span>';
											echo $strpos;
										}else{
											echo $content;
										}
					echo "
										</p>
									</a>
								</div>

							</div>
									";
				}
			}else{
				echo '
					<div class="alert alert-danger">THE SEARCH VALUE DOES NOT EXIST</div>
				';
			}
			
		}
///////////////////////////////////////////////CONTACT PAGE FORM SUBMISSION////////////////////////////
	if(isset($_POST['submit_contact_message'])){
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$phone = mysqli_real_escape_string($con, $_POST['phone']);
		$subject = mysqli_real_escape_string($con, $_POST['subject']);
		$message = mysqli_real_escape_string($con, $_POST['message']);
		$q = "INSERT INTO admins_messages(mes_name,phone,subject,message,post_date) VALUES ('$name','$phone','$subject','$message',now())";
		$rQ = mysqli_query($con, $q);
		if($rQ){
			echo '<div class="alert alert-success">Message has been successfully saved</div>';
		}
	}
?>
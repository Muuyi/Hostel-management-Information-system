<?php
	$con = mysqli_connect("localhost","root","","movies");
	//GETTING THE MOVIES CATEGORIES AND DISPLAYING THEM ON THE INDEX PAGE
	function getCat(){
		global $con;
		$mCat = "SELECT * FROM type";
		$rnCat = mysqli_query($con, $mCat);
		while($rowCat = mysqli_fetch_array($rnCat)){
			$tId = $rowCat['t_id'];
			$tName = $rowCat['t_name'];
			echo "<li><a href='index.php?mcat=$tId' class='menu'>$tName</a></li>";
		}
		$cat = "SELECT * FROM categories";
		$runCat = mysqli_query($con, $cat);
		while($rowCat = mysqli_fetch_array($runCat)){
			$catId = $rowCat['cat_id'];
			$catName = $rowCat['cat_name'];
			echo "<li><a href='index.php?cat=$catId' class='menu'>$catName</a></li>";
		}
	}
	function getMovies(){
		global $con;
		if(!isset($_GET['mcat'])){
			if(!isset($_GET['cat'])){
			$results_per_page = 50;
			$sql = "SELECT * FROM movies";
			$rSql = mysqli_query($con, $sql);
			$noResults = mysqli_num_rows($rSql);
			$noPerPage = ceil($noResults/$results_per_page);
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$eachPage = ($page - 1)*$noPerPage;
			$i = 0;
			$mov = "SELECT * FROM movies ORDER BY mov_name ASC LIMIT " . $eachPage . ',' . $results_per_page;
			$runMov = mysqli_query($con, $mov);
			if(mysqli_num_rows($runMov) == 0){
				echo "<i><h2 style='color:#FF0000'>We are sorry currently there is no movies for this category</h2></i>";
			}else{
				echo '<table width="100%" border="1px solid #FFD700">
				<tr>
					<th>No</th>
					<th>Movie name</th>
					<th>No of seasons</th>
					<th>Yr produced</th>
					<th>Main character</th>
				</tr>';
				while($row_mov=mysqli_fetch_array($runMov)){
					$movName = $row_mov['mov_name'];
					$yrProduced = $row_mov['yr_produced'];
					$noSeasons= $row_mov['no_seasons'];
					$seasonsAvailable = $row_mov['seasons_available'];
					$mainCharacter = $row_mov['main_character'];
					$i++;
			echo '<tr>
				<td>'. $i .'</td>
				<td>'. $movName.' </td>
				<td>'. $noSeasons.' </td>
				<td>'.$yrProduced.'</td>
				<td>'.$mainCharacter.' </td>
			</tr>';
			} 
		}
			echo '</table>';
			for($page=1;$page <= $noPerPage; $page++){
				echo '<b><a href="index.php?page='. $page .'">'. $page . '</a></b>';
			}
			}
		}
	}
	function getMov(){
		if(isset($_GET['mcat'])){
			$mcat = $_GET['mcat'];
			global $con;
			$results_per_page = 50;
			$sql = "SELECT * FROM movies";
			$rSql = mysqli_query($con, $sql);
			$noResults = mysqli_num_rows($rSql);
			$noPerPage = ceil($noResults/$results_per_page);
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$eachPage = ($page - 1)*$noPerPage;
			$i = 0;
			$mov = "SELECT * FROM movies WHERE t_id=$mcat ORDER BY mov_name ASC LIMIT " . $eachPage . ',' . $results_per_page;
			$runMov = mysqli_query($con, $mov);
			if(mysqli_num_rows($runMov) == 0){
				echo "<i><h2 style='color:#FF0000'>We are sorry currently there is no movies for this category</h2></i>";
			}else{
				echo '<table width="100%" border="1px solid #FFD700">
			<tr>
				<th>No</th>
				<th>Movie name</th>
				<th>No of seasons</th>
				<th>Yr produced</th>
				<th>Main character</th>
			</tr>';
				while($row_mov=mysqli_fetch_array($runMov)){
					$movName = $row_mov['mov_name'];
					$yrProduced = $row_mov['yr_produced'];
					$noSeasons= $row_mov['no_seasons'];
					$seasonsAvailable = $row_mov['seasons_available'];
					$mainCharacter = $row_mov['main_character'];
					$i++;
			echo '<tr>
				<td>'. $i .'</td>
				<td>'. $movName.' </td>
				<td>'. $noSeasons.' </td>
				<td>'.$yrProduced.'</td>
				<td>'.$mainCharacter.' </td>
			</tr>';
			} 
			echo '</table>';
			for($page=1;$page <= $noPerPage; $page++){
				echo '<b><a href="index.php?page='. $page .'">'. $page . '</a></b>';
			}
		}
		}
	}
	function getMovCat(){
		if(isset($_GET['cat'])){
			$mcat = $_GET['cat'];
			global $con;
			
			$results_per_page = 50;
			$sql = "SELECT * FROM movies";
			$rSql = mysqli_query($con, $sql);
			$noResults = mysqli_num_rows($rSql);
			$noPerPage = ceil($noResults/$results_per_page);
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$eachPage = ($page - 1)*$noPerPage;
			$i = 0;
			$mov = "SELECT * FROM movies WHERE category=$mcat ORDER BY mov_name ASC LIMIT " . $eachPage . ',' . $results_per_page;
			$runMov = mysqli_query($con, $mov);
			if(mysqli_num_rows($runMov) == 0){
				echo "<i><h2 style='color:#FF0000'>We are sorry currently there is no movies for this category</h2></i>";
			}else{
				echo '<table width="100%" border="1px solid #FFD700">
			<tr>
				<th>No</th>
				<th>Movie name</th>
				<th>No of seasons</th>
				<th>Yr produced</th>
				<th>Main character</th>
			</tr>';
				while($row_mov=mysqli_fetch_array($runMov)){
					$movName = $row_mov['mov_name'];
					$yrProduced = $row_mov['yr_produced'];
					$noSeasons= $row_mov['no_seasons'];
					$seasonsAvailable = $row_mov['seasons_available'];
					$mainCharacter = $row_mov['main_character'];
					$i++;
			echo '<tr>
				<td>'. $i .'</td>
				<td>'. $movName.' </td>
				<td>'. $noSeasons.' </td>
				<td>'.$yrProduced.'</td>
				<td>'.$mainCharacter.' </td>
			</tr>';
			} 
			echo '</table>';
			for($page=1;$page <= $noPerPage; $page++){
				echo '<b><a href="index.php?page='. $page .'">'. $page . '</a></b>';
			}
		}
		}
	}
?>
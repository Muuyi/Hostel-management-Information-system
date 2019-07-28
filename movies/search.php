<?php
	require_once("admin/db.php");
	if(isset($_POST['query'])){
				$i = 0;
				$movName = $_POST['query'];
				$get_mov = "SELECT * FROM movies WHERE mov_name LIKE '%".$_POST['query']."%'";
				$run_mov = mysqli_query($con, $get_mov);
?>
	<table width="100%" border="1px solid #FFD700">
			<tr>
				<th>No</th>
				<th>Movie name</th>
				<th>No of seasons</th>
				<th>Yr produced</th>
				<th>Main character</th>
			</tr>
<?php
				while($row_mov=mysqli_fetch_array($run_mov)){
					$movName = $row_mov['mov_name'];
					$yrProduced = $row_mov['yr_produced'];
					$noSeasons= $row_mov['no_seasons'];
					$seasonsAvailable = $row_mov['seasons_available'];
					$mainCharacter = $row_mov['main_character'];
					$i++;
?>	
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $movName ?></td>
				<td><?php echo $noSeasons ?></td>
				<td><?php echo $yrProduced ?></td>
				<td><?php echo $mainCharacter ?></td>
			</tr>
			<?php	} ?>
			
		</table>
<?php
} else{
	echo "<h1><i>Record not found!</i></h1>";
}
if(isset($_POST['name'])){
				$movName = $_POST['name'];
				$get_mov = "SELECT * FROM movies WHERE mov_name LIKE '%".$_POST['name']."%'";
				$run_mov = mysqli_query($con, $get_mov);
				while($row = mysqli_fetch_array($run_mov)){
					$mov_name = $row['mov_name'];
					echo $mov_name .',';
				}
}
?>
<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
	<h1 style="text-align:center; color:#A52A2A; font-weight:bolder;"><u>CLIENTS</u></h1>
	<form method="POST" action="admin.php?search.php" enctype="multipart/form-data"  >
		<input type="text" name="search" id="search" class="form-control" placeholder="Search by name, ID number, Institution" />
		<div id="results"></div>
	</form><br />
	<form class="forms" action="" method="POST">
		<button type="submit" class="btn btn-primary" onclick="pay()"">Print page</button>
	</form> <br /><br /><br /><br />
<table width="100%" class="cTable" border="1px solid #000000">
	<tr style='text-align:center;'>
		<th>No</th>
		<th>Client Name</th>
		<th>Passport</th>
		<th>Client Phone</th>
		<th>Room</th>
		<th>ID Number</th>
		<th>Status</th>
		<th>Print receipt</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
		$i=0;
		$get_client = "select * from clients WHERE status = 0";
		$run_client = mysqli_query($con, $get_client);
		while($row_client = mysqli_fetch_array($run_client)){
			$cId = $row_client['c_id'];
			$c_name = $row_client['c_name'];
			$c_phone = $row_client['c_phone'];
			$c_room = $row_client['c_room'];
			$c_identity = $row_client['c_identity'];
			$c_date = $row_client['date'];
			$c_passport = $row_client['c_passport'];
			$status = $row_client['status'];
			$i++;
	?>
	<tr>
		<td><?php echo "$i" ?></td>
		<td>
			<?php echo "$c_name" ?><br />
			<?php echo "<a href='admin.php?details=$cId'><button class='btn btn-primary'>More Details</button></a>" ?>
		</td>
		<td><img src='images/<?php echo "$c_passport" ?>' width='100px' height='100px' style="border:2px solid #000000; margin:2px;" /></td>
		<td><?php echo "$c_phone " ?></td>
		<td><?php echo "$c_room"."  sharing" ?></td>
		<td><?php echo "$c_identity " ?></td>
		<td><?php check(); ?></td>
		<td>
			<?php receipt(); ?>
		</td>
		<td><a href="admin.php?edit_client=<?php echo $cId ?>"><button class='btn btn-primary'>Edit</button></a></td>
		<td><a href="admin.php?delete_client=<?php echo $cId ?>"><button class='btn btn-primary'>Delete</button></a></td>
	</tr>
		<?php } ?>
</table>
	<?php } ?>
<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<h1 style="text-align:center;">Messages</h1>
	<?php 
		include_once("db.php");
		$get_message = "select * from messages";
		$run_mes = mysqli_query($con, $get_message);
		while($row_mes = mysqli_fetch_array($run_mes)){
			$mes_id = $row_mes['mes_id'];
			$mes_name = $row_mes['mes_name'];
			$mes_phone = $row_mes['mes_phone'];
			$message = $row_mes['message'];
			$mes_date = $row_mes['mes_date'];
			echo "<div style=' background-color:#D3D3D3; margin:5px; padding:20px;'>
				<b>From:</b> $mes_name<br />
				<b>Contacts:</b>$mes_phone <br />
				$message<br />
				<b><i>It was sent on: $mes_date</i></b>
				<span style='float:right'><input type='button' class='btn btn-danger btn-xs mesDel' id='$mes_id' value='Delete'/></span>
			</div>";
		}
	?>
	<?php } ?>
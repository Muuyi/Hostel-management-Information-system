<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<h1 style="text-align:center;">Messages</h1>
	<?php getMessage(); ?>
	<?php } ?>
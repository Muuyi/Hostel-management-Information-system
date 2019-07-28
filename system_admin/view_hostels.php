<?php
	if(!isset($_SESSION['admin_user'])){
		echo "<script>window.open('login.php?not_admin=You are not an admin','_self')</script>";
	}else{
?>
	<?php } ?>

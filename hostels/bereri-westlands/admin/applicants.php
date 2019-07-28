<?php
	if(!isset($_SESSION['username'])){
		echo "<script>window.open('login.php?not_admin= You are not an Admin','_self')</script>";
	}else{
?>
<h1 style="text-align:center; color:#FF0000;"><i>Currently this page is unavailable. It will be up very soon!</i></h1>
	<?php } ?>
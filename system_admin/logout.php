<?php
	session_start();
	session_destroy();
	echo "<script>window.open('login.php?logout=You have successfully logged out, come back soon!','_self')</script>";
?>
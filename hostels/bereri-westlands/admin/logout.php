<?php
	session_start();
	session_destroy();
	echo "<script>window.open('login.php?log_out=You have successfully logged out, come back soon!','_self')</script>";
?>
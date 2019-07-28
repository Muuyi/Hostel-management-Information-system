<?php
	define('dbHost', 'localhost');
	define('dbUser', 'root');
	define('dbPswd', '');
	define('dbName', 'victory');
	$con = mysqli_connect(dbHost,dbUser,dbPswd,dbName);
	if(!$con){
		trigger_error("The site cannot connect to the database right now");
		exit();
	}
?>
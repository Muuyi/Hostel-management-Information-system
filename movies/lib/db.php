<?php
	define('dbHost', 'localhost');
	define('dbUser', 'root');
	define('dbPswd', '');
	define('dbName', 'movies');
	$con = new mysql(dbHost,dbUser,dbPswd,dbName);
	if(!$con){
		trigger_error("We could not connect to your database. Please try again later");
		exit();
	}
?>
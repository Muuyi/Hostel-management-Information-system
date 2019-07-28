<?php
	define ('dbHost', 'localhost');
	define ('dbUser', 'root');
	define ('dbPswd', '');
	define ('dbName', 'hostels');
	$con = new mysqli(dbHost,dbUser, dbPswd, dbName);
	if(!$con){
		trigger_error("We could not connect to the database right now, Please try again letter!");
		exit();
	}
?>
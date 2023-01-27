<?php
	$username = "cmu";
	$password = "dbPassword";
	$server_host = "localhost";
	$database = "cmu";
	$mysql = new mysqli ($server_host, $username, $password, $database);
	if ($mysql->connect_errno) {
    		printf("Connect failed: %s\n", $mysqli->connect_error);
    		exit();
	}
?>

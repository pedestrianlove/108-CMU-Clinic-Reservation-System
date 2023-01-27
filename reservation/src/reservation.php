<?php

	// input	
	if (isset ($_POST["send"])) {
		$name = $_POST["student_name"];
		$id = $_POST["student_id"];
		$reserv_date = $_POST["reserv_date"];
		$reserv_time = $_POST["reserv_time"];
	}
	else
		throw new Exception('Something went wrong.'.PHP_EOL);
	
	
	// connect to database
	require '../../config/dbConfig.php';


	// check if such time available
	$command = $mysql->prepare ("SELECT * FROM `reservation` WHERE reserv_date=? AND reserv_time=?;");
	$command->bind_param ("sd", $reserv_date, $reserv_time);
	$command->execute ();
	$command->store_result();
	$flag = $command->num_rows ();
	$command->close ();



	// add entry to table 'reservation'
	if ($flag == 0) {
		$command = $mysql->prepare ("INSERT INTO reservation (student_name, student_id, reserv_date, reserv_time) "."VALUES (?,?,?,?);");
		$command->bind_param ("sssd", $name, $id, $reserv_date, $reserv_time);
		$command->execute ();
		$command->fetch ();
		$command->close ();
	}
	


	// end sql connection
	$mysql->close ();





	// redirect
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	if ($flag == 0)
		header('Location: '.$uri.'/reservation/success.php');
	else
		header('Location: '.$uri.'/reservation/failed.php');

	exit;
?>

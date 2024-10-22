<?php 

	$host = "localhost";
	$username = "root";
	$password = "";
	$database_name = "flight_booking_system";

	$connection = mysqli_connect("$host", "$username", "$password", "$database_name");

	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	}

	mysqli_set_charset($connection,'utf8');
    session_start();

?>
<?php
	$servername = "10.251.1.222";
	$username = "charon";
	$password = "marty1993";
	$dbname = "450Project";
	/*
	$servername = "dm3.uscupstate.edu";
	$username = "asniffin";
	$password = "123qwe";
	$dbname = "asniffin";
	*/
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
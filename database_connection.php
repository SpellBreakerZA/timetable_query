<?php 

	/* After this file is executed, there will be a connection to
	the appropriate database*/
	$servername = "localhost";
	$user = "root";
	$derp = "";

	$conn = new mysqli($servername, $user, $derp);
		
	if ($conn->connect_error)
		die("Connection error...");
	
	$result = $conn->query("USE derp") or die ("use database failed");

	
?>

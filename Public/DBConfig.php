<!-- This file allows us to connect with our database. -->
<?php

	require_once __DIR__."\\..\\EnvLdr.php"; //Load our environment varaibles

	$conn = new mysqli($_ENV["SVNM"], $_ENV["DB_USER"], $_ENV["DB_PASS"],$_ENV["DB"]);//creating a connection object

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);//Print connection error and kill page. Don't load any further.
	}
	echo "<br> Connected successfully <br>"; //Remove in Production

?>
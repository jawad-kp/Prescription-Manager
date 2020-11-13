<?php

	require_once __DIR__.'/vendor/autoload.php';
	use \Dotenv\Dotenv;
	$dotenv = Dotenv::createImmutable(__DIR__);
	$dotenv->load(); 
?>
<!-- This file load in our environment variables for us. This has to be done just one across pages so it's a single line import now. -->
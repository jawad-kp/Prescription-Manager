<?php 
session_start();
if (!(isset($_SESSION["DocID"])))
{
	die("Please <a href=\"login.php\">Login</a> before accessing the page");

}
$_SESSION["FindPrescID"] = $_POST["Press"];
?>
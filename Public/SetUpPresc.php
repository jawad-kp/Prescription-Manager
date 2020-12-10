<?php 
session_start();
if (!(isset($_SESSION["PatName"])))
{
	die("Please <a href=\"login.php\">Login</a> before accessing the page");

}
$_SESSION["PrescID"] = $_POST["Press"];
?>
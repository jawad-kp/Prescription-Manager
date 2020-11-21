<?php 
session_start();
if ((!(isset($_SESSION["PatName"]))) || (!(isset($_SESSION["PrescID"]))) )
{
	die("Please <a href=\"login.php\">Login</a> before accessing the page");

}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>View Medication</title>
 </head>
 <body>
 	Here we be viewing our medication
 
 </body>
 </html>
<?php 
session_start();
if (!(isset($_SESSION["PrescID"]))) 
	{
		die("PrescID not set");
	} 
require "DBConfig.php";

$qry = "DELETE FROM `presclog` WHERE `PrescID` LIKE \"".$_SESSION["PrescID"]."\" AND `MedName` LIKE \"".$_POST["TbNm"]."\"";
$conn->query($qry);




require 'DispPrescDoc.php';
?> 

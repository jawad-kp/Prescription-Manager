<?php
session_start();
if (!(isset($_SESSION["PrescID"]))) 
	{
		die("PrescID not set");
	} 
require "DBConfig.php"; 
require "InpModder.php";
$PrChkQ = "SELECT * FROM `presclog` WHERE `PrescID` LIKE \"".$_SESSION["PrescID"]."\" AND `MedName` LIKE  \"".$_POST["TbNm"]."\"";
$PreRes = $conn->query($PrChkQ);
if($PreRes->num_rows == 0)
{
	$qry = "INSERT INTO `presclog`(`PrescID`, `MedName`, `Dosage`, `Frequency`) VALUES (?,?,?,?)";
	$PrpStmt = $conn->prepare($qry);
	// echo $_POST["TbNm"]."<br>".$_POST["Fre"]."<br>".$_POST["Dos"];
	$TbNm = chngIP($_POST["TbNm"]);
	$Fre = chngIP($_POST["Fre"]);
	$Dos = chngIP($_POST["Dos"]);
	$PrpStmt->bind_param("ssss",$_SESSION["PrescID"],$TbNm,$Fre,$Dos);
	$PrpStmt->execute();
	require 'DispPrescDoc.php';
}
else
{
	require 'DispPrescDoc.php';
	echo "<span class=\"error\"> Tablet already saved </span>";
}

?>
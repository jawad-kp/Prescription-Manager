<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Prescribe Medicine</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/CSS Animations/animate.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
</head>
<body>

<?php 
	require "DBConfig.php";
	require __DIR__."/../EncrypterCustom.php";
	if (!(empty($_POST["PatID"])))
	{
		
		$ID = $_POST["PatID"];
		$Qry = "SELECT * FROM `patlog` WHERE `PatID` LIKE \"$ID\"";
		$res = $conn->query($Qry);
		if($res->num_rows == 1)
		{
			$row = $res->fetch_assoc();
			$name = Decrptr($row["PatName"]);
			echo "Patient Details are as follows: ";
			echo "Name: $name<br>";
			$adr = Decrptr($row["Addr"]);
			$Dte = $row["PatDOB"];
			$dob = date("d/m/Y", strtotime($Dte));
			$gender = $row["PatGen"];
			echo "Address: $adr<br>DOB(dd/mm/yyyy): $dob<br>Gender: $gender<br><br>";
			echo "<button id=\"CnfrmID\" onclick=\"window.location.href='ReportAndDiagnosis.php'\">Confirm</button>";
			$_SESSION["DocPatID"] = $ID;

		}
		else
		{
			echo "Patient $ID was not found.";
		}
	}
?>
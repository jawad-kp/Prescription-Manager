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
			echo "<div class=\"container\">";
			echo "<center><h3>Patient Details</h3></center><hr>";
			echo "<div class=\"row\">";
			echo "<div class=\"col-3\"></div>";
			echo "<table class=\"table table-bordered col-6\">";
			echo "<tr>";
			echo "<td>Name </td> <td>$name</td></tr>";
			$adr = Decrptr($row["Addr"]);
			$Dte = $row["PatDOB"];
			$dob = date("d/m/Y", strtotime($Dte));
			$gender = $row["PatGen"];
			echo "<tr><td>Address </td><td>$adr</td></tr><tr><td>DOB(dd/mm/yyyy)</td><td> $dob</td></tr><tr><td>Gender </td><td>$gender</td></tr>";
			echo "</table>";
			echo "<div class=\"col-3\"></div>";
			echo "</div>";
			echo "<center><button id=\"CnfrmID\" onclick=\"window.location.href='ReportAndDiagnosis.php'\"class=\"btn btn-primary hvr-glow\">Confirm</button></center>";
			echo "</div>";
			$_SESSION["DocPatID"] = $ID;

		}
		else
		{
			echo "Patient $ID was not found.";
		}
	}
?>
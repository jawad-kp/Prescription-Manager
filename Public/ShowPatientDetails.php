<?php
session_start();
if (!(isset($_SESSION["DocID"])))
{
	die("Please <a href=\"Doclogin.php\">Login</a> before accessing the page");

}
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
<br>
<?php 
	require "DBConfig.php";
	require __DIR__."/../EncrypterCustom.php";

	if(!(empty($_POST["PatID"])) && !(empty($_POST["FindPat"])))
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
			echo "<th>Name </th> <td>$name</td></tr>";
			$adr = Decrptr($row["Addr"]);
			$Dte = $row["PatDOB"];
			$dob = date("d/m/Y", strtotime($Dte));
			$gender = $row["PatGen"];
			echo "<tr><th>Address</th><td>$adr</td></tr><tr><th>Date Of Birth</th><td>$dob</td></tr><tr><th>Gender</th><td>$gender</td></tr>";
			echo "</table>";
			echo "<div class=\"col-3\"></div>";
			echo "</div>";
			if($_POST["FindPat"] == "true")
			{
				echo "<center><button id=\"CnfrmID\" onclick=\"window.location.href='ViewHistory.php'\"class=\"btn btn-primary hvr-glow\">View History</button></center>";
				echo "</div>";
				$_SESSION["FindPatID"] = $ID;
				$_SESSION["FindPatName"] = $name;
			}
			else
			{
				echo "<center><button id=\"CnfrmID\" onclick=\"window.location.href='ReportAndDiagnosis.php'\"class=\"btn btn-primary hvr-glow\">Confirm</button></center>";
				echo "</div>";
				$_SESSION["DocPatID"] = $ID;
			}
			

		}
		else
		{
			echo "Patient $ID was not found.";
		}
		

	}
	
?>
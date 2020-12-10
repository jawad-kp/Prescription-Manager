<?php
	session_start();
if(!(isset($_SESSION["DocID"])))
{
	die("Please <a href=\"Doclogin.php\">Login</a> before accessing the page");

}
?>
<!DOCTYPE html>
<html>
<head>
	<title> View History</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script>
	<script type="text/javascript" src="../CustomJS/ViewDetailedHistory.js"></script>
	<script>
		$(document).ready(function()
		{
			$('.LearnMore').on('click',SetValAndRedirect);
		});
	</script> 
</head>
<body>
	<!-- Displaying Patient history here -->
	<?php
	require "DBConfig.php";
	function RowPrinter($DocName,$PrescID,$Report,$Expiry)
	{
		echo "
		Doctor: $DocName<br>
		Report: $Report<br>
		";
		$ExpDate = new DateTime($Expiry);
		$Curr = date("Y-m-d");
		$CurrDate = new DateTime($Curr);
		if($ExpDate >= $CurrDate)
		{
			// echo "Expires on [yyyy-mm-dd]: ".$ExpDate->format("Y-m-d");
			echo "Expires on: ".date('F d Y', strtotime($Expiry));

		}
		else
		{
			echo "Prescription has expired.<br> (Expired on: ".date('F d Y', strtotime($Expiry)).")";
		}
		echo "<br>";
		echo "
			<div class = \"col\">
			<button class = \"LearnMore\" value = $PrescID >Learn More</button>
			</div>";
		echo "<br><br>";


	}
	$PatID = $_SESSION["FindPatID"];
	$Qry = "SELECT * FROM `nameviewer` WHERE `PatID` LIKE '$PatID' ORDER BY `Expiry` DESC";
	$res = $conn->query($Qry);
	if($res->num_rows >= 1)
	{
		while ($row = $res->fetch_assoc())
		{
			RowPrinter($row["DocName"],$row["PrescID"],$row["DocReport"],$row["Expiry"]);
		}
	}
	else
	{
		echo "No Previous Record";
	}


	?>
</body>
</html>


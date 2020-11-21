<?php
session_start();
if (!(isset($_SESSION["PatName"])))
{
	die("Please <a href=\"login.php\">Login</a> before accessing the page");

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Prescription List</title>
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
	<script type="text/javascript" src="../CustomJS/ViewPrescription.js"></script>
	<script>
		$(document).ready(function()
		{
			$('.ViewBut').on('click', SendValAndRedirect);
		});
	</script>
</head>
<body>
	<!-- List our prescriptions here with a link to  open the right one. -->
	<?php
	require "DBConfig.php";
	require __DIR__."/../EncrypterCustom.php";
	echo "<p>Welcome ".$_SESSION["PatName"]."!!</p><br>";
	function PrescPrinter($Doc,$Dia,$Expr,$PrescID)
	{
		echo "
		<div class = \"row\">
		<div class = \"col\">$Doc</div>
		<div class = \"col\">$Dia</div>";
		$today = strtotime(date('Y-m-d'));
		if ($today <= $Expr) 
		{
			echo "
			<div class = \"col\">
			<button class = \"ViewBut\" value = $PrescID >View Prescription</button>
			</div>";
		}
		else
		{
			echo "
			<div class = \"col\">
			<button class = \"ViewBut\" disabled >Prescription Has Expired!</button>
			</div>";

		}
		// echo "<div class = \"col\"> $tym </div>";

		echo "</div>";
	}//Prints out rows of data. 

	$qry = "SELECT * FROM `nameviewer` WHERE PatID LIKE \"".$_SESSION['PatID']."\""; //create a view and try this out instead.
	$res = $conn->query($qry);
	if($res->num_rows > 0)
	{
		while ($row = $res->fetch_assoc())
		{
			$exp  =strtotime($row['Expiry']);
			PrescPrinter($row['DocName'],$row['DocReport'],$exp,$row['PrescID']);
		}
	}

	?>

</body>
</html>
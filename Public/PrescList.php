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
	<style>
		.content {text-align: center; margin: 5px;}
		.btn-width {width: 100%;}
	</style>
</head>
<body>
	<br>
	<div class = "container-fluid">

	<div class="row">

		<div class="col-sm">
			<center><h1 style="color: black" class="fadeInDownBig animated">Prescriptions</h1></center><br><br>
		</div>

		<div class=" col-xs btn">
			<a href="logout.php" class="hvr-skew-forward" role="button">Logout</a>
		</div>

	</div>

	<div class="container">
	<!-- List our prescriptions here with a link to  open the right one. -->
	<center>
	<?php
	require "DBConfig.php";
	require __DIR__."/../EncrypterCustom.php";
	echo "<p>Welcome ".$_SESSION["PatName"]."!!</p>";
	function PrescPrinter($Doc,$Dia,$Expr,$PrescID)
	{	
		echo "
		<br>
		<div class=\"row\">
		<div class = \"col-4\"></div>
		<table class=\"table table-bordered col-4\">
		<tr><th>$Doc</th><td>$Dia</td></tr></div>
		</table>
		<div class = \"col-4\"></div>
		</div>
		";
		$today = strtotime(date('Y-m-d'));
		if ($today <= $Expr) 
		{
			echo "
			<button class = \" ViewBut btn btn-primary hvr-glow\" value = $PrescID >View Prescription</button><br>
			";
		}
		else
		{
			echo "
			<button class = \"btn btn-primary hvr-glow\" disabled >Prescription Has Expired!</button><br>
			";
		}
		
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
	</center>
</div>

</body>
</html>
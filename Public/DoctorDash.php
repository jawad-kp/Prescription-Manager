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
	<title>Doctor's Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../node_modules/animate.css/animate.css">
  	<!-- <link rel="stylesheet" type="text/css" href="../CustomCSS/index.css"> -->
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
</head>
<body>
	<br>
	<div class="container-fluid">
	<!-- <div id="TitleContainer"  class="row animate__animated animate__backInDown "> -->
	<?php 
	echo "<center><h1 style=\"color: black\" class=\"fadeInDownBig animated\">Hello Dr. ".$_SESSION["Doctor-Name"]."</h1></center><hr><br>"
	// echo "<h2>Hello Doctor ".$_SESSION["Doctor-Name"]."</h2><br>"; 
	?>	
	<center>
		<div class="row">
			<div class="col"><a href="PrescribeMedicine.php"><button class="btn btn-primary hvr-grow" style="width:290px; font-size: 25px">Prescribe Medicine</button></a></div>
		</div><br>
		<div class="row">
			<div class="col"><a href="FindPat.php"><button class="btn btn-primary hvr-grow" style="font-size:25px">Look-up Patient History</button></a></div>
		</div><br>
		<div class="row">
			<div class="col"><a href="Logout.php"><button class="btn btn-primary hvr-grow" style="width:290px; font-size: 25px;">Logout</button></a></div>
		</div>
	

	</div>
	<!-- <br><br>
	<div id="ButtonContainer" >
			<br>

			<div class="fl PatCls animate__animated animate__lightSpeedInLeft animate__delay-1s hvr-rotate">
				<a href="PrescribeMedicine.php" class="hvr-skew-forward" role="button">Prescribe Medicine</a>
				<br>
			</div>
			<br>

			<div class="fr DocCls animate__animated animate__lightSpeedInRight animate__delay-2s">
				<a href="FindPat.php" class="hvr-skew-backward"  role="button">Look-Up Patient History</a>
				
			</div>
			<br>
			<div class="fl AdmCls animate__animated animate__lightSpeedInLeft animate__delay-3s">
				<a href="Logout.php"  class="hvr-skew-forward" role="button">Logout</a>
				
			</div>
			<br>
		</div> -->
	

</body>
</html>
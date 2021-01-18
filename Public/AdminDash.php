<?php
session_start();
if (!(isset($_SESSION["AdminID"]))) {
	die("You're Accessing this Page Illegally");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard!!</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
		.titles {text-align: right;}
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../node_modules/animate.css/animate.css">
  	<link rel="stylesheet" type="text/css" href="../CustomCSS/AdminDash.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
</head>
<body>
	<div class="container-fluid">

		<div id="TitleContainer"  class="row animate__animated animate__backInDown ">
			<h1 class="">Welcome <?php echo $_SESSION["Admin-Name"];?>!!</h1>
		</div>
		<br><br>
		<div id="ButtonContainer" >
			<br>

			<div class=" row fl animate__animated animate__lightSpeedInLeft animate__delay-1s hvr-rotate">
				<a href="AdminReg.php" class="hvr-skew-forward" role="button">Register a New Admin</a>
				<br>
			</div>
			<br>

			<div class="row fr animate__animated animate__lightSpeedInRight animate__delay-2s">
				<a href="ViewDocs.php" class="hvr-skew-backward"  role="button">View Doctors Pending Approval</a>
				<br>				
			</div>
			<br>
			<div class=" row fl animate__animated animate__lightSpeedInLeft animate__delay-3s hvr-rotate">
				<a href="logout.php" class="hvr-skew-forward" role="button">Logout</a>
				<br>
			</div>
			<br>
			<br>

			</div>
	</div>
		
	<footer> Designed by Harshith and Jawad</footer>

</body>
</html>
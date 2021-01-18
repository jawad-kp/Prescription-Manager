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
	<title>Search Patient</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
		.titles {text-align: right;}
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/CSS Animations/animate.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 

	<script>
		$(document).ready(function()
		{
			$('#Srch').click(function()
			{
				var val = $('#PatID').val();//Getting value of  text field.
				// console.log(val);
				$.ajax(
				{
					async: true,
					type: "POST",
					url:"ShowPatientDetails.php",
					data:{PatID: val, FindPat: "true"},
					success:function (html)
					{
						$('#DetailDisp').html(html);
					}
				})

			})
		})
	</script>
</head>
<body>
	<div class = "container-fluid">

	<div class="row">

		<div class="col-sm">
			<center><h1 style="color: black" class="fadeInDownBig animated">Patient History</h1></center><br><br>
		</div>

		<div class=" col-xs btn">
			<a href="DoctorDash.php" class="hvr-skew-forward" role="button">Back to Dash</a>
		</div>

	</div>

<?php
	require "DBConfig.php";
  	require "InpModder.php";
?>
<br><br>	
<div id="BigDisp" class="container">
	<div class="row">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="row form-group">
				<div class="col-4 titles">
					<label for="PatID">Patient ID: </label>
				</div>
				<div class="col-8">
					<input type="text" name="PatID" placeholder="Enter Patient ID" class="form-control" id="PatID">
				</div>
				<br>
				
			</div>
		</div>
		<div class="col-4"></div>
	</div>
	<center><button class="btn btn-primary hvr-glow" id="Srch">Search</button></center>
	<div id="DetailDisp"></div>
</div>

</body>
</html>
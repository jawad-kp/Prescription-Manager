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
					data:{PatID: val},
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

<?php
	require "DBConfig.php";
  	require "InpModder.php";
?>
<div id="BigDisp">
		<label for="PatID">
			Patient ID 
		</label>
			<input type="text" name="PatID" placeholder="Enter Patient ID" class="form-group" id="PatID">
		<br>
        <center><button class="btn btn-primary hvr-grow" id="Srch">Search</button></center>
        <br>

        <div id="DetailDisp"></div>
</div>

</body>
</html>
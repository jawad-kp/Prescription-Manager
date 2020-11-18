<?php
session_start();
if (!(isset($_SESSION["PrescID"]))) 
	{
		die("PrescID not set");
	}  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enter Prescription</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<!-- <link rel="stylesheet" type="text/css" href="../Dependencies/CSS Animations/animate.css"> -->
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script>
	<script type="text/javascript" src="../CustomJS/ValidationStuff.js"></script>
	<script type="text/javascript" src="../CustomJS/DeletePrescData.js"></script>

	<script>
		$(document).ready(function()
		{
			$('#AddPres').click(function ()
			{
				var ValsRet = MyValidator();
				// console.log(ValsRet);
				if (ValsRet[0])
				{
					$.ajax(
					{
						type: "POST",
						url:"AddElems.php",
						data:{TbNm: ValsRet[0], Fre: ValsRet[1], Dos: ValsRet[2]},
						success:function (html)
						{
							$('#FetchData').html(html);
						}
					})					

				}

			})
		});
	</script>

</head>
<body>
	<br>
	<!-- <center> -->
		<div id="FetchData"></div>
	<div id="Bada-Div">
		<label for="Tab-Name">Tablet Name</label>
		<input type="text" name="Tab-Name" id="Tab-Name" class="form-control" placeholder="Tablet Name">
		<span class="error" id="Tab-Name-Err"></span><br>
		<label for="Freq">Frequency</label>
		<input type="text" name="Freq" id="Freq" class="form-control" placeholder="Frequency">
		<span class="error" id="Freq-Err"></span><br>
		<label for="Dosage">Dosage</label>
		<input type="text" name="Dosage" id="Dosage" class="form-control" placeholder="Dosage">
		<span class="error" id="Dosage-Err"></span>

		<br><br>
		<button class="btn btn-primary hvr-grow" id="AddPres">Add</button>
		<br><br>
		<button class="btn btn-primary hvr-grow" onclick="window.location.replace('PatientAdded.html')">Continue</button>
	</div>
	<!-- </center> -->
</body>
</html>
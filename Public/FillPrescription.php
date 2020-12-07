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
		.titles {text-align: right;}
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
	<div class="container-fluid">
		<center><br><h1 style="color: black" class="fadeInDownBig animated">Prescription</h1></center><hr><br>
		<div id="FetchData"></div>
		<div class="row">
			<div class="col-3"></div>
			<div id="Bada-Div" class="col-6">
				<div class="row form-group">
					<div class="col-4 titles">
						<label for="Tab-Name">Tablet Name: </label>
					</div>
					<div class="col-6">
						<input type="text" name="Tab-Name" id="Tab-Name" class="form-control" placeholder="Tablet Name">
						<span class="error" id="Tab-Name-Err"></span>
					</div>
				</div>
				<br>
				<div class="row form-group">
					<div class="col-4 titles">
						<label for="Freq">Frequency: </label>
					</div>
					<div class="col-6">
						<input type="text" name="Freq" id="Freq" class="form-control" placeholder="Frequency">
						<span class="error" id="Freq-Err"></span>
					</div>
				</div>
				<br>
				<div class="row form-group">
					<div class="col-4 titles">
						<label for="Dosage">Dosage:</label>
					</div>
					<div class="col-6">
						<input type="text" name="Dosage" id="Dosage" class="form-control" placeholder="Dosage">
						<span class="error" id="Dosage-Err"></span>
					</div>
				</div>
				<br>
				<center>
					<button class="btn btn-primary hvr-glow" id="AddPres" style="width: 90px;">Add</button>
					<br><br>
					<button class="btn btn-primary hvr-glow" onclick="window.location.replace('PatientAdded.html')">Continue</button>
				<center>
			</div>
			<div class="col-3">
		</div>
	</div>
</body>
</html>
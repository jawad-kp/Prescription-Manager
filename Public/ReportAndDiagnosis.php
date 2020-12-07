<?php
session_start();
if (!(isset($_SESSION["DocPatID"]))) {
	die("No Patient ID Set.");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Report</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
		.titles {text-align: left;}
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
  	<script type="text/javascript" src="../node_modules/bootstrap-datepicker
  	/dist/js/bootstrap-datepicker.js"></script>
</head>
<body>
	<?php
	require "DBConfig.php";
	require "InpModder.php";
	require __DIR__."/../EncrypterCustom.php";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$Qry = "INSERT INTO `patlist`(`DocID`, `PatID`, `PrescID`, `DocReport`, `Comments`, `Expiry`) VALUES (";
		$Doc = "\"".$_SESSION["DocID"]."\"";
		$PatID = "\"".$_SESSION["DocPatID"]."\"";
		$PrescID="\"".$_SESSION["DocID"].strval(mt_rand(0,10000)).$_SESSION["DocID"]."\"";
		$rep = "\"".ChngIP($_POST["DocRep"])."\"";
		$pst = "null";
		$wsd = "a";
		if(!(empty($_POST["DocComents"])))
		{
			$pst = "\"".ChngIP($_POST["DocComents"])."\"";
		}
		if(!(empty($_POST["ExpiryDate"])))
		{
			$wsd = "\"".ChngIP($_POST["ExpiryDate"])."\"";
		}
		else
		{
			$meow = date('y-m-d');	
			
			$dte = date_create($meow);
			date_add($dte,date_interval_create_from_date_string("15 days"));
			$wsd = "\"".date_format($dte,'Y-m-d')."\"";

		}
		$Qry  = "$Qry$Doc,$PatID,$PrescID,$rep,$pst,$wsd)";
		$res = $conn->query($Qry);
		$ed = strlen($PrescID) - 2;
		$_SESSION['PrescID'] = substr($PrescID,1,$ed);
		header("Location:FillPrescription.php");

		
	}

	?>
<div class="contaier-fluid">
	<center><h1 style="color: black" class="fadeInDownBig animated">Patient Report</h1></center><hr><br>
	<div class="row">
		<div class="col-4"></div>
		<form name="EnterPatData" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-4">
			<div class="row form-group">
				<div class="col-12 titles">
					<label class = "lab">Report: </label>
				</div>
				<div class="row"></div>
				<div class="col-12">
					<textarea name="DocRep"  rows = "3" class="form-control" required placeholder="Report"></textarea>
				</div>
				<br>
			</div>
			<div class="row form-group">
				<div class="col-12 titles">
					<label class = "lab">Comments: </label>
				</div>
				<div class="row"></div>
				<div class="col-12">
					<textarea name="DocComents"  rows = "3" class="form-control"  placeholder="Comments"></textarea>
				</div>
			</div>
			<br>
			<div class="row form-group">
				<div class="col-12 titles">
					<label for="ExpiryDate">Date:</label>
				</div>
				<div class="row"></div>
				<div id="dateLab" class="col-12">
					<input type="text" name="ExpiryDate" id="ExpiryDate" class="form-control">
				</div>
			</div>
			<br>	
			<center><button type="submit" class="btn btn-primary hvr-glow" >Submit</button></center>
		</form>	
		<div class="col-4"></div>
	</div>
</div>

	<script>
		$('#dateLab input').datepicker({
			format: "yyyy-mm-dd",
			startDate: "tomorrow",
		});
	</script>


</body>
</html>
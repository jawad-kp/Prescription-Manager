<?php 
session_start();
if ((!(isset($_SESSION["DocID"]))) || (!(isset($_SESSION["FindPrescID"]))) || (!(isset($_SESSION["FindPatName"]))))
{ 
	die("Please <a href=\"Doclogin.php\">Login</a> before accessing the page");

}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>View Medication</title>
 	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
 </head>
 <body>
 	<?php 
 		require "DBConfig.php";

 		function TabPrinter($tb,$Fre,$Dsge)
 		{
 			echo "
 			<div class=\"row\">
		 	 	<div class=\"col\">$tb</div>
		 	 	<div class=\"col\">$Fre</div>
		 	 	<div class=\"col\">$Dsge</div>
 	 		</div>";
 			
 		}//This function prints our tablets/medication prescribed.
 		

 		function FetchMedic() //This function fetches existing medication if prescribed and displays it.
 		{
 			$Qry = "SELECT * FROM `presclog` WHERE `PrescID` LIKE \"".$_SESSION["FindPrescID"]."\"";

	 		$res = $GLOBALS["conn"]->query($Qry);

	 		if ($res->num_rows > 0)
	 		{

	 			echo "
	 			<div class=\"row\">
			 	 	<div class=\"col\">Tablet Name</div>
			 	 	<div class=\"col\">Frequecy</div>
			 	 	<div class=\"col\">Dosage</div>
	 	 		</div>";

	 			while($row = $res->fetch_assoc())
	 			{
	 				TabPrinter($row["MedName"],$row["Frequency"],$row["Dosage"]);

	 			}
	 		}
	 		else
	 		{
	 			echo "
	 			<div class=\"row\">
		 			<div class=\"col\"></div>
		 			<div class=\"col\">No Specific Medication Prscribed</div>
		 			<div class=\"col\"></div>
	 			 </div>";
	 		}
 		}

 		$RepQuery = "SELECT * FROM `PatList` WHERE `PrescID` LIKE \"".$_SESSION['FindPrescID']."\"";
 		$RepRes = $conn->query($RepQuery);
 		if ($RepRes-> num_rows == 1)
 		{
 			$row = $RepRes->fetch_assoc();
 			echo "
	 			<div class=\"row\">
			 	 	<div class=\"col\">Patient Name: ".$_SESSION["FindPatName"]."</div>
			 	</div>

			 	<div class=\"row\"> 
			 	 	<div class=\"col\">Report: </div>
			 	 	<div class=\"col\">".$row["DocReport"]."</div>
	 	 		</div>

	 	 		<div class=\"row\"> 
			 	 	<div class=\"col\">Comments: </div>
			 	 	<div class=\"col\">";
			 	 if (empty($row["Comments"]))
			 	 {
			 	 	echo "No Comments";
			 	 }
			 	 else
			 	 {
			 	 	echo $row["Comments"];
			 	 }
			 	 
			 	 echo "</div>
	 	 		</div>";

	 	 	FetchMedic();
 		}
 		else
 		{
 			die("Something has gone horribly wrong");

 		}

 	 ?>



 	 

 	 <div class="row">
 	 	<div class="col-sm-1"></div>
		<div class="col"><a href="ViewHistory.php">Back</a></div>
		<div class="col"><button class="btn btn-info" onclick="window.print()">Print Page</button></div>
		<div class="col-sm-1"></div>
	 </div>



 
 </body>
 </html>
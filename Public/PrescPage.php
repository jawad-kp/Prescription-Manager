<?php 
session_start();
if ((!(isset($_SESSION["PatName"]))) || (!(isset($_SESSION["PrescID"]))) )
{
	die("Please <a href=\"login.php\">Login</a> before accessing the page");

}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>View Medication</title>
 	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/CSS Animations/animate.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
 </head>
 <body>
	<br>
	<div class="container-fluid">
	<center><h1 style="color: black" class="fadeInDownBig animated">Report and Prescription</h1></center><hr><br>
	</div>
 	<?php 
 		require "DBConfig.php";

 		function TabPrinter($tb,$Fre,$Dsge)
 		{
			 echo "
			 <tr>
			 <td>$tb</td>
			 <td>$Fre</td>
			 <td>$Dsge</td>
			 </tr>
			 ";
 			// echo "
 			// <div class=\"row\">
		 	//  	<div class=\"col\">$tb</div>
		 	//  	<div class=\"col\">$Fre</div>
		 	//  	<div class=\"col\">$Dsge</div>
 	 		// </div>";
 			
 		}//This function prints our tablets/medication prescribed.
 		

 		function FetchMedic() //This function fetches existing medication if prescribed and displays it.
 		{
 			$Qry = "SELECT * FROM `presclog` WHERE `PrescID` LIKE \"".$_SESSION["PrescID"]."\"";

	 		$res = $GLOBALS["conn"]->query($Qry);

	 		if ($res->num_rows > 0)
	 		{
				echo "
				<div class=\"container\">
				<div class=\"row\">
				<div class=\"col-4\"></div>
				<table class=\"table table-bordered col-4\">
				<th>Tablet Name</th><th>Frequency</th><th>Dosage</th>
				";
	 			// echo "
	 			// <div class=\"row\">
			 	//  	<div class=\"col\">Tablet Name</div>
			 	//  	<div class=\"col\">Frequecy</div>
			 	//  	<div class=\"col\">Dosage</div>
	 	 		// </div>";

	 			while($row = $res->fetch_assoc())
	 			{
	 				TabPrinter($row["MedName"],$row["Frequency"],$row["Dosage"]);

				 }
				echo "
				</table>
				<div class=\"col-4\"></div>
				</div> 
				</div><br>
				";
	 		}
	 		else
	 		{
	 			echo "
	 			<div class=\"row\">
		 			<div class=\"col\"></div>
		 			<div class=\"col\">No Specific Medication Prescribed</div>
		 			<div class=\"col\"></div>
	 			 </div>";
	 		}
 		}

 		$RepQuery = "SELECT * FROM `PatList` WHERE `PrescID` LIKE \"".$_SESSION['PrescID']."\"";
 		$RepRes = $conn->query($RepQuery);
 		if ($RepRes-> num_rows == 1)
 		{
			$row = $RepRes->fetch_assoc();
			echo "
			<div class=\"container\">
			<div class=\"row\">
			<div class=\"col-4\"></div>
			<table class=\"table table-bordered col-4\">
			<tr>
			<th>Patient Name</th>
			<td>".$_SESSION["PatName"]."</td>
			</tr>
			<tr>
			<th>Report</th>
			<td>".$row["DocReport"]."</td>
			</tr>
			<tr>
			<th>Comments</th>
			<td>";
			if (empty($row["Comments"]))
			{
			 	echo "No Comments";
			}
			else
			{
			 	echo $row["Comments"];
			} 
			echo "
			</td>
			</tr>
			</table>
			<div class=\"col-4\"></div>
			</div>
			</div><br>
			";
 			// echo "
	 		// 	<div class=\"row\">
			//  	 	<div class=\"col\">Patient Name: ".$_SESSION["PatName"]."</div>
			//  	</div>

			//  	<div class=\"row\"> 
			//  	 	<div class=\"col\">Report: </div>
			//  	 	<div class=\"col\">".$row["DocReport"]."</div>
	 	 	// 	</div>

	 	 	// 	<div class=\"row\"> 
			//  	 	<div class=\"col\">Comments: </div>
			//  	 	<div class=\"col\">";
			//  	 if (empty($row["Comments"]))
			//  	 {
			//  	 	echo "No Comments";
			//  	 }
			//  	 else
			//  	 {
			//  	 	echo $row["Comments"];
			//  	 }
			 	 
			//  	 echo "</div>
	 	 	// 	</div>";

	 	 	FetchMedic();
 		}
 		else
 		{
 			die("Something has gone horribly wrong");

 		}

 	 ?>



 	 
	<div class="container">
		<div class="row">
			<div class="col-3"></div>
			<div class="col-3"><center><button class="btn btn-primary hvr-glow" href="PrescList.php" style="width: 100px">Back</button></center></div>
			<div class="col-3"><center><button class="btn btn-dark hvr-glow" onclick="window.print()">Print Page</button></center></div>
			<div class="col-3"></div>
		</div>
	</div>



 
 </body>
 </html>
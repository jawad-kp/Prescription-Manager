<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Doctors Pending approval</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="../node_modules/@mdi/font/css/materialdesignicons.min.css">
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/CSS Animations/animate.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 

<!-- Button Processing -->
	<script>
		$(document).ready(function()
		{
			$('button').click(function()
			{
				var Act = $(this).attr('aria-label');
				var IdData = $(this).attr('value');
				// console.log(Act);
				// console.log(IdData);
				if (Act == "Approve")
				{
					$.ajax(
					{
						type: "POST",
						url:"ApproveDoc.php",
						data:{DocId: IdData}
						// success:function(html)
	     //            	{

	     //            	 $('#WorkStat').html(html);
	     //            }
					}).done(function()
					{
						window.location.replace("DocApproved.html");
					})
				}
				else if(Act == "Reject")
				{
					$.ajax(
					{
						type: "POST",
					url:"RejectDoc.php",
					data:{DocId: IdData}
					// success:function(html)
	    //             {

	    //             	 $('#WorkStat').html(html);
	    //             }
					}).done(function()
					{
						window.location.replace("DocDeleted.html");
					})

				}
			})
		})
		
	</script>
</head>
<body>
	<?php
	require "DBConfig.php";
	$qry = "SELECT `DocID`,`DocName`,`DocAddr`,`Contact` from `pendingdoc";
	$res = $conn->query($qry);
	if( $res->num_rows > 0)
	{
		//display stuff
		//Create two buttons in each row that have an attribute named act. We can then send their value and the action to a page that processes it and Redirects as follows.
		echo "<table>";
		echo "<tr><th>Name</th> <th>Address</th> <th>Contact</th> <th>Approval</th></tr>";
		while($row = $res->fetch_assoc()) 
		{
			PrintRow($row);

		}
		echo "</table>";
	}
	else
	{
		echo("No Doctors to approve!");
	}

	function PrintRow($data)
	{
			$nm = $data["DocName"];
			$id = $data["DocID"];
			$Addr = $data["DocAddr"];
			$cont = $data["Contact"];
			echo "<tr>";
			echo "<td> $nm </td> <td> $Addr </td> <td> $cont</td>";
			echo "<td>
					 <button type=\"button\" class=\"btn btn-lg btn-default\" aria-label=\"Approve\" value = \"$id\">
			    			<i class=\"mdi mdi-check\"></i>
			    				Approve
			    	</button>
			    	<button type=\"button\" class=\"btn btn-lg btn-default\" aria-label=\"Reject\" value = \"$id\">
			    		<i class=\"mdi mdi-close-box\" aria-hidden=\"true\"></i>
			    		Reject
			    	</button>
			    </td>";
			echo "</tr>";
	}



	?>
	<div id="WorkStat"></div>

</body>
</html>
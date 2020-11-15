<?php
session_start();
require "DBConfig.php";

if (!(empty($_POST["DocId"])))
{
	echo "Id set";
	$DocId = $_POST["DocId"];
	$qry = "SELECT * from `pendingdoc` WHERE `DocId` LIKE \"$DocId\"";
	$res = $conn->query($qry);
	while ($row = $res->fetch_assoc())
	{
		$InsQry = "INSERT INTO `doclog`(`DocID`, `DocName`, `DocPass`, `DocAddr`, `Contact`) VALUES (?,?,?,?,?)";
		$prepStmt = $conn->prepare($InsQry);
		$prepStmt->bind_param("sssss",$row["DocID"],$row["DocName"],$row["DocPass"],$row["DocAddr"],$row["Contact"]);
		$prepStmt->execute();
		$qry = "DELETE FROM `pendingdoc` WHERE `DocId` LIKE \"$DocId\"";
		$valT = $conn->query($qry);
		echo"Insert Worked";
		
	}
}

?>
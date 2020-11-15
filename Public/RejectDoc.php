<?php
session_start();
require "DBConfig.php";

if (!(empty($_POST["DocId"])))
{
	$DocId = $_POST["DocId"];
	$qry = "DELETE FROM `pendingdoc` WHERE `DocId` LIKE \"$DocId\"";
	$valT = $conn->query($qry);
	if($valT == true)
	{
		echo "Delete worked";
	}
	else
	{
		echo "Delete Failed.";
	}
}
				
 
?>
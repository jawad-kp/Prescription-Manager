
<script>
		$(document).ready(function()
		{
			$('.DelBut').on('click', SendForDel);
		});
		</script>
		<?php
	require "DBConfig.php"; 
	echo '<table>';

	function RowPrinter($nm,$dos,$fre)
	{
		echo "<tr>";
		echo "<td>$nm</td>
				<td>$dos</td>
				<td>$fre</td>";
	echo "<td>
			<button type=\"button\" class=\"btn btn-lg btn-default DelBut\" aria-label=\"Delete\" value=\"$nm\">
				Delete
			</button>
		</td>";
	echo "</tr>";

	}
	$qry = "SELECT `MedName`, `Dosage`, `Frequency` FROM `presclog` WHERE `PrescID` LIKE \"".$_SESSION["PrescID"]."\"";

	$res = $conn->query($qry);
	while ($row = $res->fetch_assoc())
	{
		RowPrinter($row["MedName"],$row["Dosage"],$row["Frequency"]);
	}


	
	echo '</table>';

?>
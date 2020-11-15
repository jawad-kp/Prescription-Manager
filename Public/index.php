<?php
require __DIR__."/../EncrypterCustom.php";
require "DBConfig.php";
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>This is the index</title>
</head>
<body>
	<?php 
	echo ("Hey, if this loads in, everything is set-up and fine.<br>");
	$lol= "Hello Jawad";
	echo("Initial: $lol <br>");
	$crt = Encrptr($lol);
	echo("Encoded: $crt <br>");
	$dcd = Decrptr($crt);
	echo("Decoded: $dcd <br>");

	// $txt = "<paste your encrypted address here to verify>";
	// echo("My Addr is: <br>");
	// $ans = Decrptr($txt);
	// echo($ans)

	
	?>

</body>
</html>
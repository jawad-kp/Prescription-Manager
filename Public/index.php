<?php
require_once __DIR__.'\\..\\vendor\\autoload.php';
// require __DIR__.'\\Decrypt.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>This is the index</title>
</head>
<body>
	<?php 
	echo ("Hey, if this loads in, everything is set-up and fine.<br>");
	$keyCont = file_get_contents(__DIR__.'\\..\\MyEnv.key');
	$key = \Defuse\Crypto\Key::loadFromAsciiSafeString($keyCont);
	$val = \Defuse\Crypto\Crypto::decrypt($_ENV["TRIAL_VALUE"],$key);
	echo($val);
	
	?>

</body>
</html>
<?php
require_once __DIR__.'\\vendor\\autoload.php';
use \Defuse\Crypto\Key;
use \Defuse\Crypto\Crypto;
use \Dotenv\Dotenv;
echo("Loaded EncrypterCustom.php<br>");

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function Encrptr($plainTxt)
{
	$keyCont = file_get_contents($_ENV["KEYLOC"]);
	$key = Key::loadFromAsciiSafeString($keyCont);
	$CipherTxt = Crypto::encrypt($plainTxt,$key);
	return $CipherTxt;
}

function Decrptr($CipherTxt)
{
	$keyCont = file_get_contents($_ENV["KEYLOC"]);
	$key = Key::loadFromAsciiSafeString($keyCont);
	$plainTxt = Crypto::decrypt($CipherTxt,$key);
	return $plainTxt;
}

?>
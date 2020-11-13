<!-- This fils holds our encryption -->

<?php
require_once __DIR__.'/vendor/autoload.php';
use \Defuse\Crypto\Key;
use \Defuse\Crypto\Crypto;
use \Dotenv\Dotenv;

require_once 'EnvLdr.php'; //No need to waste time once the superglobals have already been set-up. That's why require_once

echo("<br>Loaded EncrypterCustom.php<br>"); //Just a config message to comment in production. This lets you know our include worked.

// This is our encrypter function. You pass information to it as Plain Text and using the stored key's location, defined in the environment variable, it'll encrypt it and send it back. " Key " and " Crypto " are both classes in the Defuse Package that do the conversion for us.

function Encrptr($plainTxt)
{
	$keyCont = file_get_contents($_ENV["KEYLOC"]);
	$key = Key::loadFromAsciiSafeString($keyCont);
	$CipherTxt = Crypto::encrypt($plainTxt,$key);
	return $CipherTxt;
}

// This is our Decrypter function. You pass information to it as Cipher Text and it'll decrypt it and send it back.
function Decrptr($CipherTxt)
{
	$keyCont = file_get_contents($_ENV["KEYLOC"]);
	$key = Key::loadFromAsciiSafeString($keyCont);
	$plainTxt = Crypto::decrypt($CipherTxt,$key);
	return $plainTxt;
}

?>
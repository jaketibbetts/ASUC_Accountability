<?php

/*
Lets admin create passwords
*/

require_once "/home/c/ca/cao/path_names.php";
require_once CRYPTO;

$password=15;
$hash=pass_encrypt($password);
echo $password."\r\n";
echo $hash."\r\n";
?>

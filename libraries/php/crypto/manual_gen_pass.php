<?php

/*
Lets admin create passwords
*/

require_once "/home/c/ca/cao/path_names.php";
require_once CRYPTO;

function generate_random_str($len){
	$str="1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	$ans="";
	while($len>0){
		$ans.=$str[rand(0,strlen($str)-1)];
		$len--;
	}
	return $ans;
}


$password=generate_random_str(15);
$hash=pass_encrypt($password);
echo $password."\r\n";
echo $hash."\r\n";
?>

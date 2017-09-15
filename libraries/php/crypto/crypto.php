<?php

/*
This script contains functions used for password encryption and verification
*/

/*
Verifies the authenticity of passwords
@param $query The user defined password to authenticate
@param $hash The hash code to test $query against
@return True if the password can be authenticated
	False in all other cases
*/

$salt="l0ve tHE Clockinile"; #changing this invalidates all previous passwords

function pass_verify($query,$hash){
	global $salt;
        $hash='$2y$10$'.$hash; #This is algorithm specific
        $ask=$query.$salt;
        if(password_verify($ask,$hash)){
                return TRUE;
        }
        else{
                return FALSE;
        }
}

/*
*/
function pass_encrypt($pass){
	global $salt;
        $newPass=$pass.$salt;
        $hashed=password_hash($newPass,PASSWORD_DEFAULT);
        $hashed=substr($hashed,7);
        return $hashed;
}
?>

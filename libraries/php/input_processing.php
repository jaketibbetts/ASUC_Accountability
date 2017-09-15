<?php
/*
This script is to be used for any page where the user is submitting data to server
*/

/*
@param $global_arr string $_SESSION, $_POST, etc that is being checked for a value
@param $name string of name for the value to be looked for in $global_arr
	in the case that the variable in question is 2-D, separate with '|'
@param $placeholder in the case that the value is not found
@return html style string that will fit into <input type='text' *>
*/
function autofill_text($global_arr,$name,$placeholder=""){
	if(isset($global_arr[$name]) && strlen($global_arr[$name])>0){
		return $global_arr[$name];
	}
	else{
		return $placeholder;
	}
}

/*
Returns a stylized version of $e for reporting errors to users
@param $e Error Message
@return Stylized Message
*/
function error_report($e){
        return "<pre style=\"color:red;\">$e</pre>";
}

/*
Unset empty keys in an array
@param $arr Array to check for empties
@return array with the empty keys removed
*/
function sanitize_fields($arr){
        foreach($arr as $key => $value){
                if(strlen($value)==0){
                        unset($arr[$key]);
                }
        }
        return $arr;
}


$FORM_ERROR="";
?>

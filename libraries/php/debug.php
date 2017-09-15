<?php
/*
Contains all the functions that can be used for debugging PHP scripts
*/

/*
Makes an easily viewable array
@param $varName is the name of the array
@param $var is the array
@return an easily viewable array
*/
function debug_r($var_name, $var){
		return '<pre>'.$var_name.'='.print_r($var,true).'</pre>';
}

/*
Used to see if website is in debug mode
@return TRUE if url reads "https://accountability.asuc.org/any/path/name?debug=t";
	FALSE otherwise
*/
function is_debug(){
	if(isset($_GET['debug']) && $_GET['debug']==="t"){
		return TRUE;	
	}
	else{
		return FALSE;
	}
}

$DEBUG_SUPERGLOBALS="";

/*
if(isset($_GET['debug'])){
	$_SESSION['debug']=$_GET['debug'];
}
*/

if(is_debug()){
	//$DEBUG_SUPERGLOBALS.=debug_r('$_SESSION',$_SESSION);
	//$DEBUG_SUPERGLOBALS.=debug_r('$_REQUEST',$_REQUEST);
	$DEBUG_SUPERGLOBALS.=debug_r('$_POST',$_POST);
	$DEBUG_SUPERGLOBALS.=debug_r('$_GET',$_GET);
}
?>

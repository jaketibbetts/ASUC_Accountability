<?php

/*
Breaks down bitwise numbers
@param $val a bitwise number
@return an array of the numbers that are multiples of 2s
*/
function bitwise_breakdown($val){
	$bin=decbin($val);
	$arr=array_map('intval',str_split($bin));
	$len=count($arr)-1;
	for($i=0;$i<$len;$i++){
		if($arr[$i]==1){
			$arr[$i]=pow(2,$len-$i);
		}
	}

	return array_reverse(array_filter($arr));
}

?>

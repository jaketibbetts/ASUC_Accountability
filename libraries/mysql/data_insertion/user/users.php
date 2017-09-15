<?php

require_once "/home/c/ca/cao/path_names.php";
require_once CRYPTO;
require_once DEBUG;
require_once EMAILER;
require_once PDO_CONFIG;
require_once VARIABLES;

/*
Generates a random alphanumeric string
@param string $len the length of the desired string
@return string the desired string
*/
function generate_random_str($len){
	$str="1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	$ans="";
	while($len>0){
		$ans.=$str[rand(0,strlen($str)-1)];
		$len--;
	}
	return $ans;
}

$NAME_OF_FILE="reporters_2016-17.csv";

$str=file_get_contents($NAME_OF_FILE);
$arr=explode("\n",$str);
$command="INSERT INTO User (role_id,term_id,title,title_abbreviation,first_name,last_name,email,password) VALUES ";

for($i=0;$i<count($arr)-1;$i++){
	$entry=explode("~",$arr[$i]);//"~" because "," is found in some of the name titles
	$pass=generate_random_str(15);

	$to=$entry[0];
	$subject="accountability.asuc.org password";

	$message=$entry[1]." ".$entry[2].",\r\n\r\n";
	$message.="We are in the process of building a new website, accountability.asuc.org. It is currently in beta. We're going to be using this platform to accept weekly/biweekly reports from now on!\r\n\r\n";
	$message.="When submitting your next report (Week of 1/25/17) and all reports from now on, please use:\r\n\r\n";
	$message.="Email: ".$entry[0]."\r\nPassword: $pass\r\n\r\n";
	$message.="If you have any questions about the new system, do not reply to this email. Please send them to accountability@asuc.org.\r\n\r\n";
	$message.="We are currently working on adding more funcationality and making the website prettier.\r\n\r\n";
	$message.="Sincerely,\r\n\r\nJake Tibbetts\r\nDirector of Operations\r\nOffice of the Chief Accountability Officer";

	$from_email="noreply@accountability.asuc.org";

	email_send($to,$subject,$message,$from_email);

	//echo debug_r('',$entry);

	$command.="(" . $entry[5] . ",".TERM_ID . ",'" . $entry[3] . "','" . $entry[4] . "','" . $entry[1] . "','" . $entry[2] . "','" . $entry[0] . "','" . pass_encrypt($pass) . "'),";

}

$command=rtrim($command,",").";";
//echo $command;
insert_sql($command);

?>

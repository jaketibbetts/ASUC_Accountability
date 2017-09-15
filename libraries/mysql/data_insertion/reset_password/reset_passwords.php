<?php

require_once "/home/c/ca/cao/path_names.php";
require_once CRYPTO;
require_once DEBUG;
require_once EMAILER;
require_once PDO_CONFIG;
require_once VARIABLES;

$get_users="SELECT id,first_name,last_name,email FROM User WHERE term_id=".TERM_ID.";";
$users=get_sql($get_users);

foreach($users as $user){
	$to=$user['email'];
	$subject="accountability.asuc.org additions";

	$link="https://accountability.asuc.org/reset/?id=".pass_encrypt($user['id'])."&email=".$user['email'];

	$message=$user['first_name']." ".$user['last_name'].",\r\n\r\n";

	$message.="As promised, we are adding more features to accountability.asuc.org. These ones are largely to address a few complaints that we have been getting since we released the website.\r\n\r\n";
	$message.="1. Instead of using a password that I have sent to you, create your own password by clicking on the link below.\r\n\r\n";
	$message.="2. You can turn in your reports starting on the Monday of the week that they are due.\r\n\r\n";

	$message.="$link\r\nNOTE: DO NOT share this link with anyone that you do not trust as they could potentially change your password on your behalf.\r\n\r\n";
	$message.="The CAO does not store your personal passwords, they are protected by modern encryption techniques such that they are indiscernable to anyone except computers.\r\n\r\n";
	$message.="Also, you will not be able to submit this week's report until you have submitted your previous reports and it is in our database. You can check to see if your report is listed in our database at https://accountability.asuc.org/reports\r\n\r\n";

	$message.="If you believe that you have submitted a report and you do not see it, please attempt to resubmit your report through the system. If you are unable to do so, please contact us.\r\n";

	$message.="As usual, I will respond to all email sent to accountability@asuc.org regarding the website.\r\n\r\n";

	$message.="Sincerely,\r\n\r\nJake Tibbetts\r\nDirector of Operations\r\nOffice of the Chief Accountability Officer";

	$from_email="noreply@accountability.asuc.org";

	email_send($to,$subject,$message,$from_email);

	//echo debug_r('',$entry);

}

?>

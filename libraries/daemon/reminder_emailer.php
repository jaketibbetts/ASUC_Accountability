<?php

require_once "/home/c/ca/cao/path_names.php";
require_once DEBUG;
require_once EMAILER;
require_once PDO_CONFIG;
require_once TOOLS;
require_once VARIABLES;

$reporting_period_sql = "SELECT turn_in_by,reporters FROM ReportingPeriod WHERE turn_in_by>NOW() LIMIT 1;";
$reporter_period = get_sql($reporting_period_sql)[0];
$reporters = $reporter_period['reporters'];
$turn_in_by = $reporter_period['turn_in_by'];

$users_sql = "SELECT first_name,last_name,email,role_id FROM User WHERE term_id = " . TERM_ID . ";";
$users = get_sql($users_sql);

$filter_user_by_term=function($user){
	global $reporters;
	return in_array($user['role_id'],bitwise_breakdown($reporters));
};

$users_to_email = array_values(array_filter($users,$filter_user_by_term));

foreach($users_to_email AS $user_to_email){

	$to=$user_to_email['email'];
	$subject="Report Reminder";
	$message=$user_to_email['first_name'] . " " . $user_to_email['last_name'] . ",\r\n\r\n";

	$message.="This is a reminder that you have your report due to accountability.asuc.org by ".$turn_in_by.".\r\n\r\n";
	$message.="If you recieved this email and you think it is a mistake, please contact us.\r\n\r\n";
	$message.="I am robot! Bleep! Bloop! Do not reply to this email. Send all inquiries to accountability@asuc.org.\r\n\r\nSincerely,\r\nTARS\r\n";

	$from="noreply@accountability.asuc.org";
	email_send($to,$subject,$message,$from);

}

?>

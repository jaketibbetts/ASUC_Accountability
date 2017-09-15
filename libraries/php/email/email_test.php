<?php
/*Manually send an email*/

require_once "/home/c/ca/cao/path_names.php";
require_once EMAILER;

$to="jakemtibbetts@berkeley.edu";
$subject="Test";
$message="This is a test message";
$from_email="noreply@accountability.asuc.org";

email_send($to,$subject,$message,$from_email);

echo "EOF";
?>

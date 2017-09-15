<?php

/*
PHP scripts that handle emailing and emailing related functions for users
*/

/*
Sends an email using a spoofed email address LEGALLY
@param $to address to send email to
@param $subject subject line of email
@param $message message of email
@param $from_email name of the spoof email
@param $options is an array of additional things that the email can contain
@return True if email send was successful
	False otherwise
*/
function email_send($to, $subject, $message, $from_email, $options=array()){
	require_once 'PHPMailer-master/class.phpmailer.php';

	$email=new PHPMailer();
	$email->From=$from_email;
	$email->FromName='ASUC Accountability';
	$email->Subject=$subject;
	$email->Body=$message;
	$email->AddAddress($to);

	if(array_key_exists('ATTACHMENT',$options) && array_key_exists('ATTACHMENT_NAME',$options)){
		$path_to_file=$options['ATTACHMENT'];
		$email->AddAttachment($path_to_file,$options['ATTACHMENT_NAME']);
	}
	return $email->Send();
}
?>

<?php
session_start();
function sendmail($mail_to,$mail_subject,$mail_message,$mail_header)
	{
		$to = $mail_to;
		$subject = $mail_subject;
		$message = $mail_message;
		$headers = "From: ".$mail_header."\r\n";
		if (mail($to, $subject, $message, $headers)) {
		   $_SESSION['mailstatus']="Mail Sent";
		   //echo "SUCCESS";
		} else {
			$_SESSION['mailstatus']="Mail Not Sent";
		   //echo "ERROR";
		}
		/* $to = 'logicparadise.shahid@gmail.com';
		$subject = 'Hello from XAMPP!';
		$message = 'This is a test';
		$headers = "From: shahid.sheikhpora@gmail.com\r\n";
		if (mail($to, $subject, $message, $headers)) {
		   echo "SUCCESS";
		} else {
		   echo "ERROR";
		} */
	}
?>
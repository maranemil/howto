<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 25.11.16
 * Time: 23:56
 */


function sendMailMessage($subject, $body, $to, $cc, $bcc)
{

	require_once('include/SugarPHPMailer.php');
	require_once("modules/Administration/Administration.php");

	$mail = new SugarPHPMailer();
	$admin = new Administration();
	$admin->retrieveSettings();

	//$admin->settings['mail_smtpauth_req'] = 1;

	if ($admin->settings['mail_sendtype'] == "SMTP") {
		$mail->Host = $admin->settings['mail_smtpserver'];
		$mail->Port = $admin->settings['mail_smtpport'];
		if ($admin->settings['mail_smtpauth_req']) {
			$mail->SMTPAuth = TRUE;
			$mail->Username = $admin->settings['mail_smtpuser'];
			$mail->Password = $admin->settings['mail_smtppass'];
		}
		$mail->Mailer = "smtp";
		$mail->SMTPKeepAlive = true;
		$mail->IsSMTP();
		//$mail->SMTPSecure = false;
		//$mail->SMTPSecure = "tls";
	} else {
		$mail->Mailer = 'sendmail';
		$mail->IsSendmail();
	}

	if ($admin->settings['mail_smtpssl'] == "1") {
		$mail->SMTPSecure = 'ssl';
	} else if ($admin->settings['mail_smtpssl'] == "2") {
		$mail->SMTPSecure = 'tls';
	}

	$mail->From = $admin->settings['notify_fromaddress'];
	$mail->FromName = $admin->settings['notify_fromname'];
	$mail->ContentType = "text/html"; //"text/plain"
	//$mail->ContentType = "text/plain"; //"text/plain"
	$mail->Subject = $subject;
	$mail->Body = $body;

	$mail->AddReplyTo($to, $to);
	$mail->AddAddress($to, $to);

	//$mail->AddAddress("emil@example.com", "Emil");
	//$mail->AddCC("emil@example.com", "Emil");

	//if ($cc != "") { foreach ($cc as &$addr_cc) { $mail->AddCC($addr_cc, $addr_cc); } }

	if (!$mail->send()) {
		//
	} else {
		//
	}
}


global $db;
global $sugar_config;

// Get User Email
$usrSess = new User();
$usrSess->disable_row_level_security = true;
$usrSess->retrieve($current_user->id);
$userSelEmail = $usrSess->email1;
$userFName = ucfirst($usrSess->first_name);

// add vars and send mail
$subject = 'Notification Email';
$body = 'Lorem ipsum dolor sit amet, consectetur, adipisci velit';
sendMailMessage($subject, $body, $userSelEmail, '', '');

// Create Notification
//$notification = new Notification();
//$notification->id = create_guid();
//$notification->new_with_id = true;

$notification = BeanFactory::newBean('Notifications');
$notification->name = "Notification test ".date("Y-m-d H:i:s");
$notification->assigned_user_id = 1;
$notification->severity = "information"; // information warning alert
$notification->save();





$notification_bean = BeanFactory::newBean("Notifications");
$notification_bean->name = $notifSubject;
$notification_bean->description = $notifBody;
$notification_bean->assigned_user_id = $dUser["id"];
$notification_bean->created_by = $dUser["id"];
$notification_bean->is_read = 0;
$notification_bean->severity = "information";
$notification_bean->save();
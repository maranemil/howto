<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 26.11.16
 * Time: 00:11
 */

$ou = new User();
$ou->disable_row_level_security = true;
$ou->retrieve($rowInCk["assigned_user_id"]);
$assignedUserEmail = $ou->email1;

$oer = new Oen();
$oer->disable_row_level_security = true;
$oer->retrieve($rowInCk['id']);

require_once('modules/EmailTemplates/EmailTemplate.php');
$emailTemplateId = "b6a6f75c-1718-251b-7c3c-58297d2690e8";
$emailTemp = new EmailTemplate();
$emailTemp->disable_row_level_security = true;
$emailTemp->retrieve($emailTemplateId);

//Parse Subject If we used variable in subject
//$emailTemp->subject = $emailTemp->parse_template_bean($emailTemp->subject,$offer->module_dir, $offer);
//Parse Body HTML
//$emailTemp->body_html = $emailTemp->parse_template_bean($emailTemp->body_html,$offer->module_dir, $offer);

$emailTemp->subject = htmlspecialchars_decode($emailTemp->subject);
$emailTemp->body_html = htmlspecialchars_decode($emailTemp->body_html);

$emailTemp->subject = str_replace(array("$","{","c_var","->","}"),"",$emailTemp->subject);
$emailTemp->subject = str_replace("oname", $rowInCk["name"], $emailTemp->subject);

$emailTemp->body_html = str_replace(array("$","{","c_var","->","}"),"",$emailTemp->body_html);

$emailTemp->body_html = str_replace(
	array("somevar2","somevar","somevar3"),
	array($rowInCk["somevar2"],$rowInCk["somevar"],$somevar3),
	$emailTemp->body_html);

sendMailMessage("emil@example.de", $emailTemp);



//$notify_mail_Body = from_html(trim(wordwrap($template_data['body_html'], 900)));
//$notify_mail_Subject = $template_data['subject'];

function sendMailMessage($to, $emailTemp)
{

	require_once('include/SugarPHPMailer.php');
	require_once("modules/Administration/Administration.php");

	//global $sugar_config;

	$mail = new SugarPHPMailer();
	$admin = new Administration();
	$admin->retrieveSettings();

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

	} else {
		$mail->mailer = 'sendmail';
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

	// from template
	$mail->Subject = from_html($emailTemp->subject);
	$mail->Body_html = from_html($emailTemp->body_html);
	$mail->Body = wordwrap($emailTemp->body_html, 900);

	$mail->AddAddress("emil@example.de", "emil@example.de");
	$mail->AddCC("emil@example.com", "Emil");

	if (!$mail->send()) {
		$GLOBALS['log']->fatal("Mailer error Reminder: " . $mail->ErrorInfo);
	} else {
		//$GLOBALS['log']->info("Mailer info: " . date("Y-m-d H:i:s"));
	}
}
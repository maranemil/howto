<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 23.11.16
 * Time: 17:55
 */

	/////////////////////////////////////////////////////////////////////////
	//
	// Email Template With Attachement – Sugar CRM Php Code
	// https://hirenprajapati.wordpress.com/2013/03/22/email-template-with-attachement-sugar-crm-php-code/
	//
	/////////////////////////////////////////////////////////////////////////

	// Get the Email Template detail using following code

	require_once('modules/EmailTemplates/EmailTemplate.php');
	$emailTemp = new EmailTemplate();
	$emailTemp->disable_row_level_security = true;
	$emailTemp->retrieve($emailTemplateId);
	print_r($emailTemp);

	// Get the Attachements of Email Template using following code

	require_once('modules/EmailTemplates/EmailTemplate.php');
	require_once('modules/Notes/Note.php');
	$note = new Note();
	$where = "notes.parent_id ='$emailTemplateId' ";
	$attach_list = $note->get_full_list("", $where, true);
	print_r($attach_list);

	// Sending Email Code
    $html ="Addtional text";
    require_once('include/SugarPHPMailer . php');
    $mail = new SugarPHPMailer();
    $mail->ClearAllRecipients();
    $mail->ClearReplyTos();

    $mail->From = $FromEmailAddress;
    $mail->FromName = $FromEmailAddress;
    $mail->Subject = from_html($emailTemp->subject);
    $mail->AddAddress("sendingmailid", "name");
    $mail->AddAddress("sendingmailid2", "name2");

    $mail->Body_html = from_html($emailTemp->body_html);
    $mail->Body = wordwrap($emailTemp->body_html, 900);
    $mail->Body .= $html;
    // Add attachemts to the Email Start
    $attachments = array();
    $attachments = array_merge($attachments, $attach_list);
    foreach ($attachments as $attached) {
	    $filename = $attached->filename;
	    $file_location = 'upload /' . $attached->id;
    $mime_type = $attached->file_mime_type;
    $mail->AddAttachment($file_location, $filename, 'base64', $mime_type); //Attach each file to message
    }
    // Add attachemts to the Email End
    $mail->IsHTML(true); //Omit or comment out this line if plain text
    $mail->prepForOutbound();
    $mail->setMailerForSystem();

    //Send the message, log if error occurs
    if (!$mail->Send()) {
	    $GLOBALS['log']->fatal('ERROR: Message Send Failed');
    }


	/////////////////////////////////////////////////////////////////////////
	//
	// SugarCRM Customization: Workflow Emails with Templates
	// http://cheleguanaco.blogspot.de/2011/06/sugarcrm-customization-workflow-emails.html
	//
	/////////////////////////////////////////////////////////////////////////


	function sendMessage(&$bean, $event, $arguments)
	{
		//Grab the Leads Status (only send if Status = New)

		$status = $bean->status;
		//Get the TO name and e-mail address for the message
		$rcpt_name = $bean->first_name . ' ' . $bean->last_name;
		$rcpt_email = $bean->email1;

		//Check the status on Lead record
		if ($status == 'New') {
			//Send welcome msg to Lead
			include('modules/EmailTemplates/EmailTemplate.php');
			$emailTemp = new EmailTemplate();
			$emailTemp->disable_row_level_security = true;
			$emailTemp->use_cache = false;
			//This is where we use the ID value of the email template record
			$emailTemp->retrieve('9940c799-359b-f2fb-2943-4c619dfc696f');
			require_once('include/SugarPHPMailer.php');
			$mail = new SugarPHPMailer();

			require_once('modules/Emails/Email.php');
			$emailObj = new Email();
			$defaults = $emailObj->getSystemDefaultEmail();
			$mail->From = $defaults['email'];
			$mail->FromName = $defaults['name'];
			$mail->ClearAllRecipients();
			$mail->ClearReplyTos();
			$mail->AddAddress($rcpt_email, $rcpt_name);
			$mail->Subject = from_html($emailTemp->subject);
			$mail->Body_html = from_html($emailTemp->body_html);
			$mail->Body = wordwrap($emailTemp->body_html, 900);
			$mail->IsHTML(true); //Omit or comment out this line if plain text
			$mail->prepForOutbound();
			$mail->setMailerForSystem();
			//Send the message, log if error occurs
			if (!$mail->Send()) ;
			{
				$GLOBALS['log']->fatal('ERROR: Message Send Failed');
			}
		}
	}

	/////////////////////////////////////////////////////////////////////////
	//
	// How to Parse Email template variable in SugarCRM by custom script
	// http://urdhva-tech.blogspot.de/2013/07/how-to-parse-email-template-variable-in.html
	// https://developer.sugarcrm.com/2013/07/24/how-to-parse-email-template-variable-in-sugarcrm-by-custom-script/
	//
	/////////////////////////////////////////////////////////////////////////

	$template_name = 'Greetings from Urdhva-tech';
	require_once('modules/EmailTemplates/EmailTemplate.php');
	$template = new EmailTemplate();
	$template->retrieve_by_string_fields(array('name' => $template_name, 'type' => 'email'));

	$oContact = new Contact();
	$oContact->retrieve("36CharacterContactID");  //Contact ID

	//Parse Subject If we used variable in subject
	$template->subject = $template->parse_template_bean($template->subject, $oContact->module_dir, $oContact);

	//Parse Body HTML
	$template->body_html = $template->parse_template_bean($template->body_html, $oContact->module_dir, $oContact);


	//Here you will have a result
	print "<pre>";
	print_r(from_html($template->body_html));

	// ----------------------------------------------------------
	debug('*** Entering MyFunction function ***');

	// database object
	global $db;

	//define sql query - do something
	$sql = "call AStoredProcedure";

	//run the query
	$rs = $db->query($sql);

	$sql = "select * from contacts_cstm";
	$rs = $db->query($sql);

	while (($row = $db->fetchByAssoc($rs))) {

		$GLOBALS['log']->debug(' * I got a row! * ');


		if ($row['acustomfield_c'] <= 0 && $row['acustomfield_c'] != 1) {
			$GLOBALS['log']->debug($row['anothercustomfield_c']);

			$template_name = 'My Template Based On Contact Module A';

			$send_email = 1;
		}

		if ($row['acustomfield_c'] > 0 && $row['acustomfield_c'] != 1) {
			$GLOBALS['log']->debug($row['anothercustomfield_c']);

			$template_name = 'My Template Based On Contact Module B';

			$send_email = 1;
		}

		if ($send_email == 1) {
			require_once('/home/homeuser/www/sugarfolder/modules/EmailTemplates/EmailTemplate.php');
			$template = new EmailTemplate();
			$template->retrieve_by_string_fields(array('name' => $template_name, 'type' => 'Workflow'));

			$GLOBALS['log']->debug('*** email template is ' . print_r($template, true));

			$oContact = new Contact();
			$oContact->retrieve($row['id_c']); //Contact ID

			$GLOBALS['log']->debug('*** Contact is ' . print_r($oContact, true));

	//Parse Body HTML
			$template->body_html = $template->parse_template_bean($template->body_html, $oContact->module_name, $oContact);

			require_once('/home/homeuser/www/sugarfolder/include/SugarPHPMailer.php');
			$mail = new SugarPHPMailer();

			require_once('/home/homeuser/www/sugarfolder/modules/Emails/Email.php');
			$emailObj = new Email();
			$defaults = $emailObj->getSystemDefaultEmail();

			$mail->From = $defaults['email'];
			$mail->FromName = $defaults['name'];

			$mail->ClearAllRecipients();
			$mail->ClearReplyTos();

			$mail->AddAddress('anandra@umagum.com.xx', 'Anandra Umagum');
			$mail->Subject = from_html($template->subject);

			$mail->Body_html = from_html($template->body_html);
			$mail->Body = wordwrap($template->body_html, 900);
			$mail->IsHTML(true); //Omit or comment out this line if plain text
			$mail->prepForOutbound();
			$mail->setMailerForSystem();

	//Send the message, log if error occurs
			if (!$mail->Send()) ;
			{
				$GLOBALS['log']->fatal('*** ERROR: Message Send Failed');
			}
		}
	}

	$GLOBALS['log']->debug('*** Exiting MyFunction function ***');



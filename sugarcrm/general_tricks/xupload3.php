<?php

/**
 * Created by PhpStorm.
 * User: emil
 * Date: 07.02.17
 * Time: 11:44
 */


/**
 * Attach File To Note Example - in SugarCRM #OK
 * https://developer.sugarcrm.com/2012/03/09/uploading-multiple-documents-via-sugarcrms-api/
 * https://developer.sugarcrm.com/2012/08/16/uploading-documents-to-sugar-via-web-services/
 *
 * X-SOAP-Server: NuSOAP/0.9.5
 * Server: Apache/2.4.4 (Unix) OpenSSL/1.0.1e PHP/5.4.16 mod_perl/2.0.8-dev Perl/v5.16.3
 * X-Powered-By: PHP/5.4.16
 * Content-Type: text/xml; charset=UTF-8
 *
 */


if (!defined('sugarEntry')) define('sugarEntry', true);
#define('ENTRY_POINT_TYPE', 'api');

header("Content-Type: text/plain; charset=utf-8");

require_once('include/entryPoint.php');

$user_name = 'admin';
$user_password = 'demo';

if (!empty($user_name)) {
	$offset = 0;
	if (isset($_REQUEST['offset'])) {
		$offset = $_REQUEST['offset'] + 20;
		echo $offset;
	}
	require_once('vendor/nusoap/nusoap.php'); //must also have the nusoap code on the ClientSide.
	$soapclient = new nusoapclient('http://localhost/PhpstormProjects/Instanzen/SugarEnt-Full-7.6.2.1c/soap.php'); //define the SOAP Client an

	echo 'LOGIN:';
	$result = $soapclient->call('login', array(
		'user_auth' => array(
			'user_name' => $user_name,
			'password' => md5($user_password),
			'version' => '.01'
		),
		'application_name' => 'SoapTest'));

	echo 'HERE IS ERRORS:';
	echo $soapclient->error_str;

	echo 'HERE IS RESPONSE:';
	echo $soapclient->response;

	echo 'HERE IS RESULT:';

	echo print_r($result);
	$session = $result['id'];
	$session_id = session_id();
	$user_guid = $soapclient->call('get_user_id', $session_id);
	echo($user_guid);


//$user_id = $soapclient->get_user_id($session);

	//var_dump($session);
	//die("auth ready");

	$dir = "cache/documents/";

// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (filetype($dir . $file) != "dir") {
					echo "filename: $file : filetype: " . filetype($dir . $file) . " ";

					$target_path = $dir . $file;

////////////////////// create the note
					$params = array(
						$session,
						'Notes',
						array(
							array(
								'name' => 'name',
								'value' => 'Bulk Document2'),
							array(
								'name' => 'description',
								'value' => 'An attachment2'),
						)
					);

					$note = $soapclient->call('set_entry', $params);
					echo print_r($note);
					echo("NoteID:" . $note["id"]);

					$contents = file_get_contents($target_path);

					$attachment = array(
						'id' => $note["id"],
						'filename' => $file,
						'file' => base64_encode($contents)
					);

					$attachmentpp = array(
						'session' => $session,
						'note' => $attachment
					);

					echo 'Set Attachment:';
					$result2 = $soapclient->call('set_note_attachment', $attachmentpp);
					echo 'HERE IS RESPONSE:';
					echo print_r($result2);

				}
			}
			closedir($dh);
		}
	}

	echo 'LOGOUT:';
	$result = $soapclient->call('logout', array('session' => $session));
	echo 'HERE IS ERRORS:';
	echo $soapclient->error_str;

	echo 'HERE IS RESPONSE:';
	echo $soapclient->response;
	echo 'HERE IS RESULT:';
	echo print_r($result);

}

?>
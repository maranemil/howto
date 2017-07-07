<?php

/**
 * Created by PhpStorm.
 * User: emil
 * Date: 07.02.17
 * Time: 11:44
 */


/**
 * Examples demonstrating how to attach a file to a note using the v10 REST API. #OK
 *http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/API/Web_Services/Examples/v10/module_record_file_field_GET/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/API/Web_Services/Examples/v10/module_record_file_field_POST/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/API/Web_Services/Examples/v10/module_record_file_field_POST/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/How_to_Manipulate_File_Attachments/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/How_to_Manipulate_File_Attachments/
 */


if (!defined('sugarEntry')) define('sugarEntry', true);
//define('ENTRY_POINT_TYPE', 'gui');
#define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');

//$fpcontent = file_get_contents("https://newrelic.com/assets/pages/apm/php/elephant.png");
//$fpcontentsave = file_put_contents( "cache/documents/demo.jpg", $fpcontent);

//////////////////////////////////////////////////////////////////////////////////7

global $sugar_config;

$instance_url = "" . $sugar_config["site_url"] . "/rest/v10";
$base_url = "" . $sugar_config["site_url"] . "/rest/v10";
$username = "admin";
$password = "demo";

/**
 * Generic function to make cURL request.
 * @param $url - The URL route to use.
 * @param string $oauthtoken - The oauth token.
 * @param string $type - GET, POST, PUT, DELETE. Defaults to GET.
 * @param array $arguments - Endpoint arguments.
 * @param array $encodeData - Whether or not to JSON encode the data.
 * @param array $returnHeaders - Whether or not to return the headers.
 * @return mixed
 */
function call(
	$url,
	$oauthtoken = '',
	$type = 'GET',
	$arguments = array(),
	$encodeData = true,
	$returnHeaders = false
)
{
	$type = strtoupper($type);

	if ($type == 'GET') {
		$url .= "?" . http_build_query($arguments);
	}

	$curl_request = curl_init($url);

	if ($type == 'POST') {
		curl_setopt($curl_request, CURLOPT_POST, 1);
	} elseif ($type == 'PUT') {
		curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "PUT");
	} elseif ($type == 'DELETE') {
		curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "DELETE");
	}

	curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
	curl_setopt($curl_request, CURLOPT_HEADER, $returnHeaders);
	curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

	if (!empty($oauthtoken)) {
		$token = array("oauth-token: {$oauthtoken}");
		curl_setopt($curl_request, CURLOPT_HTTPHEADER, $token);
	}

	if (!empty($arguments) && $type !== 'GET') {
		if ($encodeData) {
			//encode the arguments as JSON
			$arguments = json_encode($arguments);
		}
		curl_setopt($curl_request, CURLOPT_POSTFIELDS, $arguments);
	}

	$result = curl_exec($curl_request);

	if ($returnHeaders) {
		//set headers from response
		list($headers, $content) = explode("\r\n\r\n", $result, 2);
		foreach (explode("\r\n", $headers) as $header) {
			header($header);
		}

		//return the nonheader data
		return trim($content);
	}

	curl_close($curl_request);

	//decode the response from JSON
	$response = json_decode($result);

	return $response;
}

//Login - POST /oauth2/token

$url = $base_url . "/oauth2/token";

$oauth2_token_arguments = array(
	"grant_type" => "password",
	//client id/secret you created in Admin > OAuth Keys
	"client_id" => "345",
	"client_secret" => "678",
	"username" => $username,
	"password" => $password,
	"platform" => "base"
);

$oauth2_token_response = call($url, '', 'POST', $oauth2_token_arguments);

//Create note record - POST /<module>/:record

$url = $base_url . "/Notes";

$note_arguments = array(
	"name" => "My Note",
);

$note_response = call($url, $oauth2_token_response->access_token, 'POST', $note_arguments);
//Upload File - POST /<module>/:id/file/:field
$url = $base_url . "/Notes/{$note_response->id}/file/filename";
$file_arguments = array(
	"format" => "sugar-html-json",
	"delete_if_fails" => true,
	"oauth_token" => $oauth2_token_response->access_token,
	'filename' => "@cache/documents/demo.jpg;filename=demo.jpg",
);

$file_response = call($url, $oauth2_token_response->access_token, 'POST', $file_arguments, false);

echo "<pre>";
print_r($file_response);
echo "</pre>";

?>

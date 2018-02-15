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
 *
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.8/Integration/Web_Services/v10/Endpoints/Documentsrecordfilefield_PUT/
 * http://www.thesugarrefinery.com/2016/01/06/uploading-files-with-sugars-rest-api/
 * http://php.net/manual/de/function.curl-file-create.php
 *
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/How_to_Manipulate_File_Attachments/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/API/Web_Services/Examples/v10/module_record_file_field_POST/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/API/Web_Services/Examples/v10/module_record_file_field_POST/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/How_to_Export_a_List_of_Records/
 *
 * https://wiki.selfhtml.org/wiki/Referenz:MIME-Typen
 * https://www.sitepoint.com/web-foundations/mime-types-complete-list/
 * https://github.com/saeed237/sugarpro7.1/blob/master/clients/base/api/FileApi.php
 * https://www.php-einfach.de/php-tutorial/dateiupload/
 * https://community.sugarcrm.com/thread/23759
 * http://www.thesugarrefinery.com/2016/01/06/uploading-files-with-sugars-rest-api/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.8/Integration/Web_Services/v10/Endpoints/Documentsrecordfilefield_PUT/
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
	"platform" => "palajfdsl"
);

$oauth2_token_response = call($url, '', 'POST', $oauth2_token_arguments);

//Create note record - POST /<module>/:record


if (!function_exists('curl_file_create')) {
	function curl_file_create($filename, $mimetype = '', $postname = '')
	{
		return "@$filename;filename="
		. ($postname ?: basename($filename))
		. ($mimetype ? ";type=$mimetype" : '');
	}
}

/* Initialise */
$fileToUpload = "cache/documents/demo.png";
$mimetype = "image/png";
$filename = "demo.png";
/* Ensure a fully qualified path to the file */
$path = realpath($fileToUpload);
/* Create a curl file wrapper */
echo $fileData = curl_file_create($path, $mimetype, $filename);

/*
$url = $base_url . "/Contacts";
$note_arguments = array(
	"first_name" => "Emil" . rand(111, 999),
	"last_name" => "Maran" . rand(111, 999),
);


// $_FILES = array();
// $_FILES['picture']['name'] = "demo.png";
// $_FILES['picture']['tmp_name'] = "";
// $_FILES['picture']['size'] = "44330";
// $_FILES['picture']['type'] = "image/png";


$note_response = call($url, $oauth2_token_response->access_token, 'POST', $note_arguments);
*/

$field = 'picture';
$url = "$base_url/Contacts/d7ca028d-2236-e1a2-12ea-589b01abd11c/file/$field"; // ?format=sugar-html-json&platform=base

$post = array(
	//'file_contents' => $fileData
	"format" => "sugar-html-json",
	"delete_if_fails" => true,
	"oauth_token" => $oauth2_token_response->access_token,
	$field => $fileData, // "@cache/documents/demo.jpg;filename=demo.jpg;type=image/jpeg",
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data",	"Cache-Control: no-cache",	"OAuth-Token: " . $oauth2_token_response->access_token));
$result = curl_exec($ch);
curl_close($ch);

var_dump($result);
exit(0);

/*

//Upload File - POST /<module>/:id/file/:field
$url = $base_url . "/Contacts/d7ca028d-2236-e1a2-12ea-589b01abd11c}/file/picture"; // picture filename // {$note_response->id} temp
$file_arguments = array(
	"format" => "sugar-html-json",
	"delete_if_fails" => true,
	"oauth_token" => $oauth2_token_response->access_token,
	'picture' => $fileData, // "@cache/documents/demo.jpg;filename=demo.jpg;type=image/jpeg",
	//'filename' => "@/home/emil/PhpstormProjects/Instanzen/SugarEnt-Full-7.6.2.1c/cache/documents/demo.png",
	//"platform" => "base",
	//"module" => "Contacts",
	//"filename" => $fileData, // temp
	//"field" => "picture",
	//"record" => $note_response->id,
	//"temp" => true,
);
$file_response = call($url, $oauth2_token_response->access_token, 'POST', $file_arguments); // saveFilePut

echo "<pre>";
var_dump($file_response);
echo "</pre>";*/

/*
$params = array(
	"format" => "sugar-html-json",
	"delete_if_fails" => true,
	"oauth_token" => $oauth2_token_response->access_token,
	"filename" => "@cache/documents/demo.png;filename=demo.png;type=image/png",
);

$path = "Contacts/" . $note_response->id . "/file/picture";

$responseparams = array(
	"encodeData" => false,
	"encodeResponse" => true,
	"returnHeaders" => false,
);

$file_response = call($path, $oauth2_token_response->access_token, "POST", $params);
echo "<pre>";
var_dump($file_response);
echo "</pre>";

*/


/*
 *
 *

Di 07 Feb 2017 17:30:37 CET [11110][1][FATAL] {"__sugar_url":"v10\/Contacts\/c6ed175c-61d5-dbeb-a905-5899f69cff58\/file\/picture",
"module":"Contacts","record":"c6ed175c-61d5-dbeb-a905-5899f69cff58","field":"picture","temp":false}

Di 07 Feb 2017 17:31:42 CET [11401][1][FATAL] {"__sugar_url":"v10\/Contacts\/temp\/file\/picture",
"format":"sugar-html-json","delete_if_fails":"true","oauth_token":"d33b0ab5-ff16-e2fa-feb7-5899f6e3a791",
"platform":"base","module":"Contacts","temp":true,"field":"picture","record":null}

X_CONTENT_TRANSFER_ENCODING = base64

http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Endpoints/index.html


 *
 * */


/*
* Add a document with the v10 REST API
*  @param $account_id the Sugar account_id to add the document for
*  @param $form Symfony form object to get file ulpoad information     * @return $document_response API call response
*/

/*
public
function add_document($account_id, $form)
{
	$file = $form->get('file')->getData();
	$editor = $this->get_account($form->get('editor')->getData());

// Create the  document
// Adapt the parameters to your needs
	$document_parameters = array('account_c' => $account_id, 'account_id_c' => $account_id, 'status_id' => 'Active', 'revision' => 1,
		'active_date' => date('Y-m-d', time()), 'account_id1_c' => $form->get('editor')->getData(),
		'document_name' => str_replace(' ', '_', $editor['name']) . '_' . $form->get('category')->getData() . '_' . $file->getClientOriginalName(),
		'doc_type' => 'SQN', 'category_id' => $form->get('category')->getData(), 'description' => $form->get('comments')->getData(),);
	$url = $this->base_url . "/Documents";
	$document_response = $this->call($url, $this->get_auth_token()->access_token, 'POST', $document_parameters);
	if ($document_response->id) {
// Add a file to the document
		$file_parameters = array("format" => "sugar-html-json", "delete_if_fails" => true, "filename" => '@' . $file->getPathName() . ';filename=' . $file->getClientOriginalName(),
// use the given filename will be used instead of the temporary filename
			"file" => base64_encode(file_get_contents($file->getPathName())));
		$url = $this->base_url . "/Documents/" . $document_response->id . '/file/filename';
		$file_response = $this->call($url, $this->get_auth_token()->access_token, 'POST', $file_parameters, false);
	}
	return $document_response;
}*/


/*
 * function uploadFile($module, $rid, $field, $file)    {
        $params = array(
            "format" => "sugar-html-json",
            "delete_if_fails" => 0,
            "oauth_token" => $client->_oauthtoken['access_token'],
            $field => $file,
        );

        $path = $module."/".$rid."/file/".$field;

        $responseparams = array(
            "encodeData" => false,
            "encodeResponse" => true,
            "returnHeaders" => false,
        );

        $client->makeRequest($path, $params, $module, "POST", $responseparams);
    }

//loop over $_FILES
$files = $_FILES;
foreach($files as $key => $val) {
        if (!empty($files[$key ]['name'])) {
            $path = "@".$files[$key ]["tmp_name"].";filename=".$files[$key]['name'];
            uploadFile($module, $id, $key, $path);
        }
    }

https://community.sugarcrm.com/thread/23759
https://codegists.com/code/httpclient/
https://developer.sugarcrm.com/2016/10/17/using-the-sugar-rest-php-client/


 */


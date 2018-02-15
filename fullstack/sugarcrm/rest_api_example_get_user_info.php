<?php

//////////////////////////////////////////////////////////////////////////////////
//
// SugarCRM 7.X Rest API Example - get user info
//
//////////////////////////////////////////////////////////////////////////////////

if(!defined('sugarEntry'))define('sugarEntry', true);

define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');
require_once('include/utils/file_utils.php');
ob_start();

//////////////////////////////////////////////////////////////////////////////////
//
// Define API Settings & Passwords
//
//////////////////////////////////////////////////////////////////////////////////

$base_url = "http://localhost/yourprojectfolderhere/rest/v10";
$username = "admin";
$password = "demo";

// #bwc/index.php?module=OAuthKeys&action=DetailView&record.....
$authurl = $base_url . "/oauth2/token";
$oauth2_token_arguments = array(
    "grant_type" => "password", //

    // client id/secret you created in Admin > OAuth Keys:
    "client_id" => "123",       // CustomID - this must be set in Admin Oauth Settings
    "client_secret" => "456",   // CustomSecret - this must be set in Admin Oauth Settings

    "username" => $username,
    "password" => $password,
    "platform" => "base"
);

/////////////////////////////////////////////////////////////////////////////
//
// Perform Auth and get Token
//
/////////////////////////////////////////////////////////////////////////////

$curl_request = curl_init( $authurl  );
curl_setopt( $curl_request, CURLOPT_POST, true );
curl_setopt( $curl_request, CURLOPT_POSTFIELDS, $oauth2_token_arguments );
curl_setopt( $curl_request, CURLOPT_RETURNTRANSFER, 1);

// extra settings
curl_setopt( $curl_request, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $curl_request, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt( $curl_request, CURLOPT_HEADER, 0);
curl_setopt( $curl_request, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt( $curl_request, CURLOPT_USERAGENT, "sugar api");

curl_setopt( $curl_request, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt( $curl_request, CURLOPT_TIMEOUT, 60);
curl_setopt( $curl_request, CURLOPT_VERBOSE, 1);

/*
curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
    'client_id' => your_client_id,
    'redirect_uri' => your_redirect_url,
    'client_secret' => your_client_secret_key,
    'code' => $_GET['code'], // The code from the previous request
    'grant_type' => 'authorization_code'
) );*/

$auth = curl_exec( $curl_request );

//$info_curl = curl_getinfo($curl_request);   // debug - see curl request info
//echo "<pre>"; print_r($info_curl); echo "</pre>"; // *

$secret = json_decode($auth);
$token = $secret->access_token;

//curl_close($curl_request);
if ( isset($auth->error) ) {
    die($auth->error_message."\n");
}


/////////////////////////////////////////////////////////////////////////////
//
// Debug
//
/////////////////////////////////////////////////////////////////////////////

//
//if(curl_exec($curl_request) === false) { echo 'Curl-Error: ' . curl_error($curl_request); }
//else { echo 'Operation Fehler vollständig ausgeführt'; }

// prüfen, ob ein Fehler aufgetreten ist
//if(curl_errno($curl_request)) { echo 'cURL-Fehler: ' . curl_error($curl_request); }


/*$result = json_decode($auth);
if ( !is_object($result) ) {
    die("Error handling result.\n");
}
if ( !isset($result->id) ) {
    //die("Error: {$result->name} - {$result->description}\n.");
    print "<pre>"; print_r($result); print "</pre>";
}*/


/////////////////////////////////////////////////////////////////////


echo "<pre>"; print_r($auth); echo "</pre>";

/////////////////////////////////////////////////////////////////////////////
//
// Get info about current user
//
/////////////////////////////////////////////////////////////////////////////

// Open a curl session for making the call
// $cookie_file = tempnam('./temp', 'cookie');

$oauth2_params = array(
    "grant_type" => "password",
    "username" => $username,
    "password" => $password,
    "platform" => "base"
);

// $curl_request = curl_init($baseurl . "/me");
// $curl_request = curl_init();

curl_setopt( $curl_request, CURLOPT_URL, $base_url . "/me");
curl_setopt( $curl_request, CURLOPT_POST, 0);
//curl_setopt( $curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt( $curl_request, CURLOPT_HEADER, 0);

curl_setopt( $curl_request, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $curl_request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt( $curl_request, CURLOPT_FOLLOWLOCATION, 0);

// extra settings ----------------------------------------
curl_setopt( $curl_request, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $curl_request, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt( $curl_request, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt( $curl_request, CURLOPT_USERAGENT, "sugar api");

curl_setopt( $curl_request, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt( $curl_request, CURLOPT_TIMEOUT, 60);
curl_setopt( $curl_request, CURLOPT_VERBOSE, 1);
curl_setopt( $curl_request, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "OAuth-Token: $token" ));

// curl_setopt( $curl_request, CURLOPT_COOKIEJAR, $cookie_file);
// curl_setopt( $curl_request, CURLOPT_POSTFIELDS, $oauth2_token_params );

//$info_curl = curl_getinfo($curl_request);   // debug - see curl request info
//echo "<pre>"; print_r($info_curl); echo "</pre>"; // *


// Make the REST call, returning the result
$response = curl_exec( $curl_request );
if (!$response) {
    die("Connection Failure.\n");
}
// Convert the result from JSON format to a PHP array
$result = json_decode($response);
curl_close($curl_request);

if ( isset($result->error) ) {
    die("die...".$result->error_message."\n");
}

//var_dump($response);
var_dump($result);

########################
?>
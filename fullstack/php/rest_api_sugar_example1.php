<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 21.04.15
 * Time: 17:56
 */

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('log_errors', 1);
//ini_set("error_log", "/path/to/php-error.log");
ini_set('html_errors',FALSE);

if (!defined('sugarEntry')) {  define('sugarEntry', true); }

$site_url = "localhost/web/SugarPro-7.5.2.0";
$base_url = "http://{$site_url}/rest/v10";
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
    $oauthtoken='',
    $type='GET',
    $arguments=array(),
    $encodeData=true,
    $returnHeaders=false
)
{
    $type = strtoupper($type);

    if ($type == 'GET')
    {
        $url .= "?" . http_build_query($arguments);
    }

    $curl_request = curl_init($url);

    if ($type == 'POST')
    {
        curl_setopt($curl_request, CURLOPT_POST, 1);
    }
    elseif ($type == 'PUT')
    {
        curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "PUT");
    }
    elseif ($type == 'DELETE')
    {
        curl_setopt($curl_request, CURLOPT_CUSTOMREQUEST, "DELETE");
    }

    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, $returnHeaders);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

    if (!empty($oauthtoken))
    {
        $token = array("oauth-token: {$oauthtoken}");
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, $token);
    }

    if (!empty($arguments) && $type !== 'GET')
    {
        if ($encodeData)
        {
            //encode the arguments as JSON
            $arguments = json_encode($arguments);
            //var_dump($arguments);
        }
        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $arguments);
    }

    $result = curl_exec($curl_request);

    if ($returnHeaders)
    {
        //set headers from response
        list($headers, $content) = explode("\r\n\r\n", $result ,2);
        foreach (explode("\r\n",$headers) as $header)
        {
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

/////////////////////////////////
//
// Login - POST /oauth2/token
//
/////////////////////////////////

$url = $base_url . "/oauth2/token";
$oauth2_token_arguments = array(
    "grant_type" => "password",
    //client id/secret you created in Admin > OAuth Keys
    "client_id" => "123",
    "client_secret" => "456",
    "username" => $username,
    "password" => $password,
    "platform" => "base"
);

$oauth2_token_response = call($url, '', 'POST', $oauth2_token_arguments);
//echo "<pre>"; print_r($oauth2_token_response); echo "</pre>";


/////////////////////////////////
//
// CASE GET Filter with Prepared Array
//
/////////////////////////////////


//Filter - /<module>/filter GET
/*
$filter_arguments = array(
    "filter" => array(
        array(
            '$or' => array(
                array(
                    //name starts with 'a'
                    "name" => array(
                        '$starts'=>"b",
                    )
                )
                array(
                    //or name is equal to 'My Account'
                    "name" => 'My'
                )
            ),
        ),
    ),
    "max_num" => 2,
    "offset" => 0,
    "fields" => "name,description",
    "order_by" => "name:DESC",
    "favorites" => false,
    "my_items" => false,
);

$url = $base_url . "/Accounts/filter";
$filter_response = call($url, $oauth2_token_response->access_token, 'GET', $filter_arguments);
echo "<pre>"; print_r($filter_response); echo "</pre>";*/

/////////////////////////////////
//
// CASE GET Filter with GET/REQUEST
//
/////////////////////////////////

/*
* ####### contains|starts|ends|equals  /rest/v10/help
*/


//echo $filter_arguments = 'max_num=2'; // &filter[0][$or][0][name][$contains]=Bay   fields=id,name
$getStrFilter   = (string) 'filter[0][$or][0][name][$contains]=Bay&filter[0][$or][1][name][$starts]=Bay';


/*
var_dump(parse_url($url));
var_dump(parse_url($url, PHP_URL_SCHEME));
var_dump(parse_url($url, PHP_URL_USER));
var_dump(parse_url($url, PHP_URL_PASS));
var_dump(parse_url($url, PHP_URL_HOST));
var_dump(parse_url($url, PHP_URL_PORT));
var_dump(parse_url($url, PHP_URL_PATH));
var_dump(parse_url($url, PHP_URL_QUERY));
var_dump(parse_url($url, PHP_URL_FRAGMENT));
 */


$filter_arguments = array(
    "max_num" => 2,
    "offset" => 0,
    "fields" => "name,description",
    "order_by" => "name:DESC",
    "favorites" => false,
    "my_items" => false,
);
parse_str($getStrFilter, $getStrAr); // transform string into array
$filter_arguments["filter"] = $getStrAr["filter"]; // merge array
//echo "<pre>"; print_r($filter_arguments); echo "</pre>";

$url = $base_url ."/Accounts/filter"; // (string)
$filter_response = call($url, $oauth2_token_response->access_token, 'GET', $filter_arguments );
echo "<pre>"; print_r($filter_response); echo "</pre>";


?>
<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 09.01.17
 * Time: 15:09
 */

/*
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/UI_Model/Views/Filters/

$contains
$not_contains
$in
$not_in
$equals
$starts
$not_equals
$gt
$lt
$gte
$lte
$between
yesterday
today
tomorrow

http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/index.html
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/How_to_Filter_a_List_of_Records/index.html
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Security/Endpoints_and_Entry_Points/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Examples/PHP/How_to_Export_a_List_of_Records/index.html
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Integration/Web_Services/v10/Extending_Endpoints/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/API/Web_Services/Examples/v10/


https://developer.sugarcrm.com/2014/02/28/sugarcrm-cookbook3/
http://integroscrm.com/how-to-integrate-sugarcrm-with-redmine/
 *
 *  */



$instance_url = "http://localhost/PhpstormProjects/Instanzen/SugarEnt-Full-7.6.2.1/rest/v10";
$username = "admin";
$password = "demo";

//Login - POST /oauth2/token
$auth_url = $instance_url . "/oauth2/token";

$oauth2_token_arguments = array(
	"grant_type" => "password",
	//client id - default is sugar.
	//It is recommended to create your own in Admin > OAuth Keys
	"client_id" => "sugar",
	"client_secret" => "",
	"username" => $username,
	"password" => $password,
	//platform type - default is base.
	//It is recommend to change the platform to a custom name such as "custom_api" to avoid authentication conflicts.
	"platform" => "custom_api"
);

$auth_request = curl_init($auth_url);
curl_setopt($auth_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt($auth_request, CURLOPT_HEADER, false);
curl_setopt($auth_request, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($auth_request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($auth_request, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($auth_request, CURLOPT_HTTPHEADER, array(
	"Content-Type: application/json"
));

//convert arguments to json
$json_arguments = json_encode($oauth2_token_arguments);
curl_setopt($auth_request, CURLOPT_POSTFIELDS, $json_arguments);

//execute request
$oauth2_token_response = curl_exec($auth_request);

//decode oauth2 response to get token
$oauth2_token_response_obj = json_decode($oauth2_token_response);
$oauth_token = $oauth2_token_response_obj->access_token;

echo "<br>Token:" .$oauth_token;

/*
 * rest/v10/Tasks/filter?fields=name,contact_name,parent_name,date_due,status,date_modified,contact_id,parent_id,parent_type
&max_num=5&filter[0][date_entered][$dateRange]=last_7_days
*/

// -----------------------------------------------------------

//Identify records to export - POST /<module>/filter

$filter_url = $instance_url . "/Tasks/filter";
$filter_arguments = array(
	"filter" => array(
		array(
			'parent_type' => array(
				'$equals' => 'Opportunities',
			),
		),
	),
	"max_num" => 5,
	"offset" => 0,
	"fields" => "id,name,parent_type,parent_name",
	"order_by" => "date_entered",
	"favorites" => false,
	"my_items" => false,
);

$filter_request = curl_init($filter_url);
curl_setopt($filter_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt($filter_request, CURLOPT_HEADER, false);
curl_setopt($filter_request, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($filter_request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($filter_request, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($filter_request, CURLOPT_HTTPHEADER, array(
	"Content-Type: application/json",
	"oauth-token: {$oauth_token}"
));

//convert arguments to json
$json_arguments = json_encode($filter_arguments);
curl_setopt($filter_request, CURLOPT_POSTFIELDS, $json_arguments);

//execute request
$filter_response = curl_exec($filter_request);

//decode json
$filter_response_obj = json_decode($filter_response);

//store ids of records to export
$export_ids = array();
foreach ($filter_response_obj->records as $record)
{
	$export_ids[] = array(
		$record->id,
		$record->name,
		$record->parent_type,
		$record->parent_name
	);
}

print "<pre>";
print_r($export_ids);
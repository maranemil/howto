<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 22.11.16
 * Time: 13:54
 */

####################################
#
# FIX License Verify for Localhost Case
#
####################################

//modules/Administration/LicenseSettings.php
// check_now(); checkDownloadKey();

//include/SugarHeartbeat/SugarHeartbeatClient.php
/*
protected function setupNuSoap($endpoint)
{
	// validate server cert for SSL connections
	if (strpos($endpoint, 'https://') === 0) {
		$this->setUseCURL(true);
		$this->curl_options = array(
			CURLOPT_SSL_VERIFYPEER => false, // true must be changed to false
			CURLOPT_SSL_VERIFYHOST => 2,
		);
	}
}*/

//modules/Administration/updater_utils.php
// ERROR RESPONSE WHEN SSL CURLOPT_SSL_VERIFYPEER is set as true

/*
string(701) "HTTP Error: cURL ERROR: 60: SSL certificate problem: unable to get local issuer certificate
url: https://updates.sugarcrm.com:443/heartbeat/soap.php
content_type:
http_code: 0
header_size: 0
request_size: 0
filetime: -1
ssl_verify_result: 0
redirect_count: 0
total_time: 0.501363
namelookup_time: 3.7E-5
connect_time: 0.206902
pretransfer_time: 0
size_upload: 0
size_download: 0
speed_download: 0
speed_upload: 0
download_content_length: -1
upload_content_length: -1
starttransfer_time: 0
redirect_time: 0
certinfo:
primary_ip: 80.22.142.54
primary_port: 443
local_ip: 192.168.1.15
local_port: 40390
redirect_url: "
*/
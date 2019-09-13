<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 26.11.16
 * Time: 00:43
 */

$curlOptions = array(
    CURLOPT_CONNECTTIMEOUT => 15,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_URL => 'http://api.anymailfinder.com/v2.0/search.json',
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_POST => true,
    CURLOPT_SSL_VERIFYHOST => true,
    CURLOPT_POSTFIELDS => array("domain" => $domain, "name" => $fullname),
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 6,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => 0,
    CURLOPT_USERAGENT => $agent,
    CURLOPT_FRESH_CONNECT => false,
    //CURLOPT_NOBODY => 1,
    // http://www.useragentstring.com/pages/Internet%20Explorer/
    CURLOPT_HTTPHEADER => array('X-API-KEY: ' . $apikey . ''),
    // X-API-KEY APIkey  'Content-Type: application/json'
    CURLINFO_HEADER_OUT => true,
);

$curl = curl_init();
curl_setopt_array($curl, $curlOptions);

/* if($proxy = getProxy()) {
echo 'set proxy '.$proxy."\n";
curl_setopt($curl, CURLOPT_PROXY, $proxy);
curl_setopt($curl, CURLOPT_PROXYUSERPWD,'');
} */

$data = curl_exec($curl);
curl_close($curl);
$result = (array) json_decode($data);
$email = $result['email']; //
$status = $result['status']; // "status": "success"

<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 25.11.16
 * Time: 23:54
 */

$curl_request = curl_init();
$url = "https://example.com/some_page_name_here";
curl_setopt($curl_request,CURLOPT_URL, $url);
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
$result = curl_exec($curl_request);

$info_curl = curl_getinfo($curl_request);   // debug - see curl request info
echo "<pre>"; print_r($info_curl); echo "</pre>"; // *

// prüfen, ob ein Fehler aufgetreten ist
if(curl_errno($curl_request)) { echo 'cURL-Fehler: ' . curl_error($curl_request); }

/*
 *
$ch = curl_init();
$timeout = 30;
curl_setopt($ch, CURLOPT_ENCODING, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);         // follow redirects

curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101  Firefox/28.0");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);            // don't verify ssl
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        //
curl_setopt($ch, CURLOPT_VERBOSE,      1);                //
curl_setopt($ch, CURLOPT_MAXREDIRS , 3);
curl_setopt($ch, CURLOPT_TIMEOUT  , 25);
curl_setopt($ch, CURLOPT_HEADER , false);

$readSource = curl_exec($ch);
$errsSource = curl_errno($ch);
$infoSource = curl_getinfo($ch);
curl_close($ch);
*/
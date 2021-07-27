<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 18.02.16
 * Time: 16:16
 */

/*
http://256cats.com/fast-scraping-with-reactphp-curl-proxies/
http://256cats.com/scraping-asp-websites-php-dopostback-ajax-emulation/
http://256cats.com/gimmeproxy-com-free-rotating-proxy-api/
*/

######################################################
#
# GimmeProxy.com – free rotating proxy api
#
######################################################

function getProxy() {
	$data = json_decode(file_get_contents('http://gimmeproxy.com/api/get/8bb99df808d75d71ee1bdd9e5d/?timeout=0'), 1);
	if(isset($data['error'])) { // there are no proxies left for this user-id and timeout
		echo $data['error']."\n";
	}
	return isset($data['error']) ? false : $data['curl'];
}

function get($url) {
	$curlOptions = array(
		CURLOPT_CONNECTTIMEOUT => 25,
		CURLOPT_TIMEOUT => 25,
		CURLOPT_URL => $url,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_MAXREDIRS => 9,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_HEADER => 0,
		CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
		CURLINFO_HEADER_OUT  => true,
	);
	$curl = curl_init();
	curl_setopt_array($curl, $curlOptions);
	if($proxy = getProxy()) {
		echo 'set proxy '.$proxy."\n";
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
	}
	$data = curl_exec($curl);
	curl_close($curl);
	return $data;
}
for($i = 0; $i < 5; $i++) {
	echo trim(get('http://icanhazip.com/'))."\n";
}


#####################################################################
#
# Scraping ASP websites in PHP with __doPostBack ajax emulation
#
#####################################################################

include_once __DIR__.'/simple_html_dom.php';
define('COOKIE_FILE', __DIR__.'/cookie.txt');
@unlink(COOKIE_FILE); //clear cookies before we start

define('CURL_LOG_FILE', __DIR__.'/request.txt');
@unlink(CURL_LOG_FILE);  //clear curl log

/**Get simplehtmldom object from url
 * @param $url
 * @param $post
 * @return bool|simple_html_dom
 */

function getDom($url, $post = false) {

	$f = fopen(CURL_LOG_FILE, 'a+'); // curl session log file
	if($this->lastUrl) $header[] = "Referer: {$this->lastUrl}";
	$curlOptions = array(
		CURLOPT_ENCODING => 'gzip,deflate',
		CURLOPT_AUTOREFERER => 1,
		CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
		CURLOPT_TIMEOUT => 120, // timeout on response
		CURLOPT_URL => $url,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_MAXREDIRS => 9,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
		CURLOPT_COOKIEFILE => COOKIE_FILE,
		CURLOPT_COOKIEJAR => COOKIE_FILE,
		CURLOPT_STDERR => $f, // log session
		CURLOPT_VERBOSE => true,
	);

	if($post) { // add post options
		$curlOptions[CURLOPT_POSTFIELDS] = $post;
		$curlOptions[CURLOPT_POST] = true;
	}

	$curl = curl_init();
	curl_setopt_array($curl, $curlOptions);
	$data = curl_exec($curl);
	$this->lastUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL); // get url we've been redirected to
	curl_close($curl);

	if($this->dom) {
		$this->dom->clear();
		$this->dom = false;
	}
	$dom = $this->dom = str_get_html($data);

	fwrite($f, "{$post}\n\n");
	fwrite($f, "-----------------------------------------------------------\n\n");
	fclose($f);

	return $dom;
}
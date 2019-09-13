<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 19.01.15
 * Time: 17:33
 */

// http://php.net/manual/en/function.curl-setopt.php#82300

function get_web_page($url, $curl_data)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true, // return web page
        CURLOPT_HEADER => false, // don't return headers
        CURLOPT_FOLLOWLOCATION => true, // follow redirects
        CURLOPT_ENCODING => "", // handle all encodings
        CURLOPT_USERAGENT => "spider", // who am i
        CURLOPT_AUTOREFERER => true, // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
        CURLOPT_TIMEOUT => 120, // timeout on response
        CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        CURLOPT_POST => 1, // i am sending post data
        CURLOPT_POSTFIELDS => $curl_data, // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0, // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false, //
        CURLOPT_VERBOSE => 1, //

        //CURLOPT_URL             => false,
        //CURLOPT_FRESH_CONNECT   => false,
        //CURLOPT_NOBODY          => false,
        //CURLOPT_RETURNTRANSFER  => false,
        //CURLINFO_HTTP_CODE      => false,
        //CURLOPT_HTTPHEADER      => array( "Cache-Control: no-cache" ),

    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);

    //  $header['errno']   = $err;
    //  $header['errmsg']  = $errmsg;
    //  $header['content'] = $content;
    return $header;
}

$curl_data = "var1=60&var2=test";
$url = "https://www.example.com";
$response = get_web_page($url, $curl_data);

print '<pre>';
print_r($response);

/**
 *
curl -v http://www.example.org
curl --verbose http://www.example.org
curl -i http://example.org
curl -I http://example.org 2>/dev/null | head -n 1 | cut -d$' ' -f2


Curl Header Responses

100="Continue"
101="Switching Protocols"

[Successful 2xx]
200="OK"
201="Created"
202="Accepted"
203="Non-Authoritative Information"
204="No Content"
205="Reset Content"
206="Partial Content"

[Redirection 3xx]
300="Multiple Choices"
301="Moved Permanently"
302="Found"
303="See Other"
304="Not Modified"
305="Use Proxy"
306="(Unused)"
307="Temporary Redirect"

[Client Error 4xx]
400="Bad Request"
401="Unauthorized"
402="Payment Required"
403="Forbidden"
404="Not Found"
405="Method Not Allowed"
406="Not Acceptable"
407="Proxy Authentication Required"
408="Request Timeout"
409="Conflict"
410="Gone"
411="Length Required"
412="Precondition Failed"
413="Request Entity Too Large"
414="Request-URI Too Long"
415="Unsupported Media Type"
416="Requested Range Not Satisfiable"
417="Expectation Failed"

[Server Error 5xx]
500="Internal Server Error"
501="Not Implemented"
502="Bad Gateway"
503="Service Unavailable"
504="Gateway Timeout"
505="HTTP Version Not Supported"

 */

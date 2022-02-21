

### Swoole server
https://www.zend.com/blog/creating-basic-php-web-server-swoole

```
use Swoole\Http\Server as HttpServer;

$server = new HttpServer('127.0.0.1', 9000);
$server->on('start', function ($server) {
    echo "Server started at http://127.0.0.1:9000\n";
});
$server->on('request', function ($request, $response) {
    $response->header('Content-Type', 'text/plain');
    $response->end("Hello World\n");
});
$server->start();
```

### oauth
```
https://oauth.net/code/php/
https://github.com/jumbojett/OpenID-Connect-PHP
https://github.com/openid/php-openid
https://bshaffer.github.io/oauth2-server-php-docs/overview/openid-connect/
http://brentertainment.com/oauth2/
https://github.com/bshaffer/oauth2-demo-php
```


### API php
```

https://rapidapi.com/blog/how-to-use-an-api-with-php/
https://docs.rapidapi.com/docs/php-1
https://docs.rapidapi.com/docs/getting-started-with-rapidapi-sdks


// kvstore API url
$url = 'https://kvstore.p.rapidapi.com/collections';
// Collection object
$data = [
  'collection' => 'RapidAPI'
];

// Initializes a new cURL session
$curl = curl_init($url);

// 1. Set the CURLOPT_RETURNTRANSFER option to true
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// 2. Set the CURLOPT_POST option to true for POST request
curl_setopt($curl, CURLOPT_POST, true);

// 3. Set the request data as JSON using json_encode function
curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

// 4. Set custom headers for RapidAPI Auth and Content-Type header
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'X-RapidAPI-Host: kvstore.p.rapidapi.com',
  'X-RapidAPI-Key: [Input your RapidAPI Key Here]',
  'Content-Type: application/json'
]);

// Execute cURL request with all previous settings
$response = curl_exec($curl);
// Close cURL session
curl_close($curl);
echo $response . PHP_EOL;


https://carto.com/developers/auth-api/guides/how-to-send-API-Keys/
https://symfony.com/doc/4.0/security/api_key_authentication.html
https://swagger.io/docs/specification/authentication/api-keys/
https://blog.stoplight.io/api-keys-best-practices-to-authenticate-apis
https://stackoverflow.com/questions/8115683/php-curl-custom-headers
https://www.php.net/manual/en/function.curl-setopt.php
https://cloud.google.com/endpoints/docs/openapi/when-why-api-key
https://developer.leaseweb.com/get-started/
https://app.lokalise.com/api2docs/curl/
https://docs.scrapingant.com/request-response-format
https://developers.activecampaign.com/reference#guidance


curl -X POST
	`https://example.com/endpoint/’ \
	-H ‘content-type: application/json’ \
	-d ‘ {
		“api_key”: abcdef12345”
	}’
```

######
#### Uncaught ValueError: mb_http_input(): Argument #1 ($type) must be one of "G", "P", "C", "S", "I", or "L" 
######
```
https://www.tutorialspoint.com/php-detect-http-input-character-encoding-with-mb-http-input
https://hotexamples.com/examples/-/-/mb_http_input/php-mb_http_input-function-examples.html

   // It will return the input character encoding
   //UTF-8
   $string =mb_http_input("I");
   var_dump($string);
```

######
### PHP Illegal String Offset Warning IDE Warning
#### Illegal string offset 'event_type'
######
```
change method params to match the input

/**
* @param string $data <- this is false, must be array!!!
*/
function test($input){ echo $input['field']; }
```


######
### How to remove backslash on json_encode() function?
######
```

https://stackoverflow.com/questions/7282755/how-to-remove-backslash-on-json-encode-function
https://www.codegrepper.com/code-examples/php/php+remove+slashes+from+json
https://stackoverflow.com/questions/30253267/how-to-remove-back-slashes-from-json-output-in-php/30253333
https://stackoverflow.com/questions/30253267/how-to-remove-back-slashes-from-json-output-in-php

json_encode($response, JSON_UNESCAPED_SLASHES);
json_decode($response, true, JSON_UNESCAPED_SLASHES);
stripslashes(json_encode(response,JSON_UNESCAPED_SLASHES)));

$val = json_encode(array(
  "test"=>'test1',
  "test2" =>'test',
  "description" => 'description'
));

$data = json_decode($val, true, JSON_UNESCAPED_SLASHES);
return $data;


https://sandbox.onlinephpfunctions.com/
https://jsonlint.com/

# remove first and last char 
substr(substr($json,1),0,-1);
```


### substr
```
https://www.php.net/manual/en/function.substr.php

$rest = substr("abcdef", -1);    // returns "f"
$rest = substr("abcdef", -2);    // returns "ef"
$rest = substr("abcdef", -3, 1); // returns "d"
```

### gen random
```
https://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php
https://stackoverflow.com/questions/38716613/generate-a-single-use-token-in-php-random-bytes-or-openssl-random-pseudo-bytes

var_dump(bin2hex(random_bytes(12)));
var_dump(bin2hex(openssl_random_pseudo_bytes(12)));
```


### Simulate exception
```
https://www.w3schools.com/php/php_exception.asp

//create function with an exception
function checkNum($number) {
  if($number>1) {
    throw new Exception("Value must be 1 or below");
  }
  return true;
}

//trigger exception
checkNum(2);
```



### mysql_real_escape_string FIX
```
Warning
This extension was deprecated in PHP 5.5.0, and it was removed in PHP 7.0.0

To set this mode for the current connection, enter the following SQL statement:

SET sql_mode='NO_BACKSLASH_ESCAPES';
You can also set the mode globally for all clients:

SET GLOBAL sql_mode='NO_BACKSLASH_ESCAPES';
```



















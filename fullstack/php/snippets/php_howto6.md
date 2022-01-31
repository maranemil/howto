

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





























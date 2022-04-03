### GuzzleHttp

```
https://docs.guzzlephp.org/en/stable/
https://docs.guzzlephp.org/en/stable/overview.html
https://packagist.org/packages/guzzlehttp/guzzle
https://packagist.org/packages/guzzlehttp/guzzle-services

https://stackoverflow.com/questions/27825667/php-guzzlehttp-how-to-make-a-post-request-with-params
https://docs.guzzlephp.org/en/stable/quickstart.html#sending-requests
https://docs.guzzlephp.org/en/stable/
https://docs.guzzlephp.org/en/5.3/http-messages.html
https://docs.guzzlephp.org/en/stable/request-options.html
https://docs.guzzlephp.org/en/stable/quickstart.html
```
-----------------------------
### Install

```
composer require guzzlehttp/guzzle:^7.0
```

-----------------------------
### GuzzleHttp Get request

```
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

echo $response->getStatusCode(); // 200
echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();
});

$promise->wait();
```
-----------------------------
### GuzzleHttp Post request  x-www-form-urlencoded

```
https://stackoverflow.com/questions/51231370/how-to-run-curl-via-guzzle/51243492#51243492
https://stackoverflow.com/questions/51231370/how-to-run-curl-via-guzzle

$client = new \GuzzleHttp\Client();
$uri = 'https://api.url.com/token';
$headers = [
    'Content-Type' => 'application/x-www-form-urlencoded',
    'X-Access-Token' => $ACCESS_TOKEN
];
$body = 'grant_type=client_credentials&client_id='.$PUBLIC_KEY.'&client_secret='.$PRIVATE_KEY;
$result = $client->request('POST', $uri, [
    'headers' => $headers,
    'body' => $body
]);

json_decode($result->getBody()->getContents(), true);
```

-----------------------------
### GuzzleHttp Post request  application/json

```
https://stackoverflow.com/questions/22244738/how-can-i-use-guzzle-to-send-a-post-request-in-json

$client = new Client([
    'headers' => [ 'Content-Type' => 'application/json' ]
]);

$response = $client->post('http://api.com/CheckItOutNow',
    ['body' => json_encode(
        [
            'hello' => 'World'
        ]
    )]
);

echo '<pre>' . var_export($response->getStatusCode(), true) . '</pre>';
echo '<pre>' . var_export($response->getBody()->getContents(), true) . '</pre>';
```
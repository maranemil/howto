################################################################
#
#   GuzzleHttp Promises
#
################################################################

// http://docs.guzzlephp.org/en/latest/quickstart.html
// http://docs.guzzlephp.org/en/stable/faq.html
// https://www.youtube.com/watch?v=4J7p0CZ0aQ4

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

// ------------------------------------------------------------------------------------
//  Send an asynchronous request.
// ------------------------------------------------------------------------------------
$client = new \GuzzleHttp\Client();
// start request
$promise = $client->getAsync('http://loripsum.net/api')->then(
	function ($response) {
	   return $response->getStatusCode(). PHP_EOL;
	},
	function ($exception) {
	   return $exception->getMessage(). PHP_EOL;
	}
);
// do other things
echo '<b>This will not wait for the previous request to finish to be displayed!</b>'. PHP_EOL;
// wait for request to finish and display its response
$response = $promise->wait();
echo $response;

// ------------------------------------------------------------------------------------
// Send an synchronous request.
// ------------------------------------------------------------------------------------
$client = new GuzzleHttp\Client();
$res    = $client->request('GET', 'http://httpbin.org/get', [  /*'auth' => ['user', 'pass']*/]);
echo $res->getStatusCode() . PHP_EOL; // "200"
//echo $res->getHeader('content-type')[0].PHP_EOL; // 'application/json; charset=utf8'
//echo $res->getBody().PHP_EOL;
// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
$promise = $client->sendAsync($request)->then(
	function ($response) {
	   echo 'I completed! ' . $response->getStatusCode() . PHP_EOL;
	}, function ($response) {
   echo 'Not completed! ' . $response->getStatusCode() . PHP_EOL;
}
);
$promise->wait();

// ------------------------------------------------------------------------------------
// request an asynchronous request.
// ------------------------------------------------------------------------------------
$client  = new GuzzleHttp\Client();
$promise = $client->requestAsync('GET', 'http://httpbin.org/get');
$promise->then(
	function ($response) {
	   echo 'Got a response! ' . $response->getStatusCode() . PHP_EOL;
	},
	function ($response) {
	   echo 'Got no response! ' . $response->getStatusCode() . PHP_EOL;
	}
);
$promise->wait();


// ------------------------------------------------------------------------------------
// request an asynchronous request.
// ------------------------------------------------------------------------------------
$client = new Client();
$requests = function ($total) {
   $uri = 'http://httpbin.org/get';
   for ($i = 0; $i < $total; $i++) {
	  yield new Request('GET', $uri);
   }
};
$pool = new Pool($client, $requests(3), [
	'concurrency' => 5,
	'fulfilled' => function (Response $response, $index) {
	   // this is delivered each successful response
	   echo 'Got a fulfilled! ' . $response->getStatusCode() . PHP_EOL;
	},
	'rejected' => function (RequestException $reason, $index) {
	   // this is delivered each failed request
	   echo 'Got a rejected! ' . $reason->getMessage() . PHP_EOL;
	},
]);
// Initiate the transfers and create a promise
$promise = $pool->promise();
// Force the pool of requests to complete.
$promise->wait();



// ------------------------------------------------------------------------------------
// request an asynchronous request.
// ------------------------------------------------------------------------------------
use GuzzleHttp\Handler\CurlMultiHandler;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

$curl = new CurlMultiHandler;
$handler = HandlerStack::create($curl);
$client = new Client(['handler' => $handler]);

$p = $client
	->getAsync('http://google.com')
	->then(
		function (ResponseInterface $res) {
		   echo 'google response: ' . $res->getStatusCode() . PHP_EOL;
		},
		function (\Exception $e) {
		   echo $e->getMessage() . PHP_EOL;
		}
	);
while ($p->getState() === 'pending') {
   $curl->tick();
   //do some other stuff here or just
   sleep(1);
}
$p->wait();




/* GuzzleHttp installation
---------------------------------------------

 Did you mean one of these?
      guzzlehttp/psr7
      guzzlehttp/ring
      guzzle/guzzle
      guzzlehttp/guzzle
      guzzlehttp/streams

composer require guzzlehttp/psr7
composer require guzzlehttp/guzzle
composer require guzzlehttp/streams

---------------------------------------------
*/

require 'vendor/autoload.php';

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
// ------------------------------------------------------------------------------------
// request an asynchronous request.
// ------------------------------------------------------------------------------------
try{
    $client  = new GuzzleHttp\Client();
    $promise = $client->requestAsync('GET', 'http://httpbin.org/get');
    $promise->then(
        function ($response) {
           echo  $response->getStatusCode(). PHP_EOL;
        },
        function ($exception) {
           echo $exception->getMessage(). PHP_EOL;
        }
    );
    $promise->wait();
}
catch(Exception $e){
    echo $e->getMessage();
}


// ------------------------------------------------------------------------------------
// Fatal error: Uncaught Error: Class ‘WP_Recovery_Mode_Link_Service’ not found
// Fatal error: Uncaught Error: Class 'FacebookGraphAPIError' not found
// ------------------------------------------------------------------------------------
// FIX: https://www.php.net/manual/en/function.class-exists.php
// class_exists ( string $class_name [, bool $autoload = TRUE ] ) : bool

// Check that the class exists before trying to use it
if (class_exists('MyClass')) {
    $myclass = new MyClass();
}

// Check to see whether the include declared the class
if (!class_exists('MyClass', true)) {
	trigger_error("Unable to load class: 'MyClass' ", E_USER_WARNING);
}


/*
require __DIR__.'/vendor/autoload.php';
use scratchers\nstest\Container;
use scratchers\nstest\MyClass;

$obj = Container::get(MyClass::class);
echo $obj->prop;
*/

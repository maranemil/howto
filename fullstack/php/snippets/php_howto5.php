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



##############################################################
/*
static::class vs get_called_class()
self::class vs get_class() vs __CLASS__

Understanding difference between
 __CLASS__, get_class(), and get_called_class() with underlying self/static keyword
*/
##############################################################
/*
https://gist.github.com/surferxo3/0f6f181c2633996ff3815358d360f567
https://www.php.net/manual/en/function.get-called-class.php
https://riptutorial.com/php/example/4661/difference-between---class----get-class---and-get-called-class--
https://www.leaseweb.com/labs/2014/04/static-versus-self-php/
https://arueckauer.github.io/posts/2019/11/self-vs.-static/
https://stackoverflow.com/questions/47798831/difference-staticclass-vs-get-called-class-and-class-vs-get-class-vs-s/49917180
https://belineperspectives.com/2017/03/13/get_classthis-vs-staticclass/
*/
class Foo
{
    public function __invoke()
    {
        echo 'self: ' . self::class . PHP_EOL;
        echo 'static: ' . static::class . PHP_EOL;
        echo 'get_class(): ' . get_class() . PHP_EOL;
        echo 'get_class($this): ' . get_class($this) . PHP_EOL;
        echo 'get_called_class(): ' . get_called_class() . PHP_EOL;
    }
}

class Bar extends Foo{}
(new Bar())();

/*
Output:
self: Foo
static: Bar
get_class(): Foo
get_class($this): Bar
get_called_class(): Bar
*/




/*
https://www.w3schools.com/php/func_array_filter.asp
https://www.php.net/manual/de/function.array-filter.php
*/

array_filter ( $array2, 'trim' );
array_map ( $array2, 'trim' );



/* Extract EMAIL */
$email = "youremail@somedomain.com";
$domain_name = substr(strrchr($email, "@"), 1);
$domain_name1 = explode("@",$email)[1];
echo "<br>Domain name is :" . $domain_name;
echo "<br>Domain name is :" . $domain_name1;







/*
PHP Worker Performance Benchmarking and Test Results
https://pagely.com/blog/php-worker-performance-benchmarking/
https://github.com/pagely/php-worker-benchmarking
*/

// Benchmarking Encrypt and decrypt a string 50,000 times.
while ( $times_run < 50000 ) {
    $encrypted = openssl_encrypt( $string, $method, $key, null, $iv );
    $decrypted = openssl_decrypt( $encrypted, $method, $key, null, $iv );
    $times_run++;
}


// Benchmarking Environment
//
// #!/bin/bash
// mkdir -p reports
//
// # “num-cores cpuset”
// for row in “1 0” “2 0-1”
// do
//     set — $row
//     cores=$1
//     cpuset=$2
//     for worker in {1,2,8,50,100,200}
//     do
//         pworker=$(printf “%03d” $worker)
//         pcores=$(printf “%02d” $cores)
//         file=reports/${pcores}core-${pworker}worker.txt
//         json=reports/${pcores}core-${pworker}worker.json
//         if [[ ! -f $file ]]
//         then
//             ./run-php.sh $cpuset $worker $file
//             ./run-bench.sh 3 $worker $json >> $file
//         fi
//     done
// done

##############################################################
# singleton
##############################################################
/*
https://www.thewebhatesme.com/allgemein/php-entwurfsmuster-singleton/
https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
https://refactoring.guru/design-patterns/singleton/php/example#
https://www.thewebhatesme.com/allgemein/php-entwurfsmuster-singleton/
https://sourcemaking.com/design_patterns/singleton/php/1#
https://daylerees.com/php-patterns-singleton/
https://www.php-einfach.de/experte/codeschnipsel/8761-design-patterns-in-php5/
https://poe-php.de/oop/entwurfsmuster-sinn-und-unsinn-des-singleton
https://designpatternsphp.readthedocs.io/de/latest/Creational/Singleton/README.html#
https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
https://designpatternsphp.readthedocs.io/de/latest/Creational/Singleton/README.html#

https://www.geeksforgeeks.org/singleton-class-java/
https://javabeginners.de/Design_Patterns/Singleton_-Pattern.php
https://www.journaldev.com/1377/java-singleton-design-pattern-best-practices-examples
*/

##############################################################
# PDF Output Settings
##############################################################
/*

http://www.fpdf.org/en/doc/output.htm

Parameters

dest
	Destination where to send the document. It can be one of the following:
	I: send the file inline to the browser. The PDF viewer is used if available.
	D: send to the browser and force a file download with the name given by name.
	F: save to a local file with the name given by name (may include a path).
	S: return the document as a string.
	The default value is I.

name
	The name of the file. It is ignored in case of destination S.
	The default value is doc.pdf.

isUTF8
	Indicates if name is encoded in ISO-8859-1 (false) or UTF-8 (true).
	Only used for destinations I and D. The default value is false.

*/


##############################################################
# Laracast Decorator
##############################################################

# https://github.com/laracasts/Getting-Jiggy-With-Adapters
# https://github.com/laracasts/the-specification-pattern-in-php

interface CarServ{
	public function getCost();
}

class BasicInsp implements CarServ{
	public function getCost(){
		return 25;
	}
}

class OilChange implements CarServ{
	protected $carServ;
    function __construct(CarServ $carServ){
		$this->carServ = $carServ;
	}
	public function getCost(){
		return 25 + $this->carServ->getCost();
	}
}


$basic = new BasicInsp();
echo $basic->getCost();

$oil = new OilChange(new BasicInsp);
echo $oil->getCost();

##############################################################
# get check nummeric
##############################################################

$data = array_map(
	"trim",
	array(1, 1., NULL, 'foo',true,"8ddd",'1350055',"fff"));

/*
"boolean"
"integer"
"double"
"string"
"array"
"object"
"resource"
*/

foreach ($data as $value) {
	echo gettype($value).PHP_EOL.$value, "<br>";
}

echo "<hr>";
foreach ($data as $value) {
	if(is_numeric($value)){
    	echo $value, "<br>";
	}
}

echo "<hr>";
foreach ($data as $value) {
	if (preg_match('/^\d+$/', $value)) {
		echo $value, "<br>";
	}
}


# PHP: equivalent of MySQL's function SUBSTRING_INDEX
# https://stackoverflow.com/questions/6885793/php-equivalent-of-mysqls-function-substring-index

$str = "www.mysql.com";
echo implode('.', array_slice(explode('.', $str), 0, 2)); // prints "www.mysql"
echo implode('.', array_slice(explode('.', $str), -2));   // prints "mysql.com"

# Removes special chars.
return preg_replace('/[^A-Za-z0-9\-]/', '', $string); //



# PHP: object equivalent
# http://phptester.net/

$objphp56 = new stdClass();
$objphp56->name = "php5.6";

var_dump($objphp56);
echo "<br>";

$objphp74 = (object)['name' => "php7.4"];
var_dump($objphp74);



##############################################################
# openweathermap api
##############################################################

/*

https://christianflach.de/OpenWeatherMap-PHP-API/docs/usage/ ######
https://github.com/born05/OpenWeatherMap-PHP-Api *******
https://github.com/cakephp-fr/openweathermap
https://github.com/cmfcmf/OpenWeatherMap-PHP-API/
https://github.com/peterbulmer/OpenWeatherMap-PHP-Api
https://openweathermap.org/api
https://openweathermap.org/appid
https://openweathermap.org/current#zip
https://openweathermap.org/examples
https://openweathermap.org/examples#php
https://packagist.org/packages/cloudstash/openweathermap-php-api
https://packagist.org/packages/cmfcmf/openweathermap-php-api
https://php-download.com/package/cmfcmf/openweathermap-php-api
https://phpspreadsheet.readthedocs.io/en/latest/topics/settings/
https://plugins.cakephp.org/p/1938-openweathermap
https://www.wetter.com/deutschland/berlin/DE0001020.html

Temperature is available in Fahrenheit, Celsius and Kelvin units.
For temperature in Fahrenheit use units=imperial
For temperature in Celsius use units=metric
Temperature in Kelvin is used by default, no need to use units parameter in API call
List of all API parameters with units openweathermap.org/weather-data

http://docs.php-http.org/en/latest/clients/guzzle7-adapter.html#
https://christianflach.de/OpenWeatherMap-PHP-API/docs/usage
https://christianflach.de/OpenWeatherMap-PHP-API/docs/usage/
https://docs.guzzlephp.org/en/5.3/http-messages.html#requests
https://docs.guzzlephp.org/en/stable/psr7.html
https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Http/Index.html
https://guzzle3.readthedocs.io/http-client/client.html
https://phpspreadsheet.readthedocs.io/en/latest/topics/settings/

composer require "cmfcmf/openweathermap-php-api"

USAGE

*/


use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;

// Must point to composer's autoload file.
require 'vendor/autoload.php';

// Language of data (try your own language here!):
$lang = 'de';

// Units (can be 'metric' or 'imperial' [default]):
$units = 'metric';

// Create OpenWeatherMap object.
// Don't use caching (take a look into Examples/Cache.php to see how it works).
$owm = new OpenWeatherMap('YOUR-API-KEY');

try {
    $weather = $owm->getWeather('Berlin', $units, $lang);
} catch(OWMException $e) {
    echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
} catch(\Exception $e) {
    echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
}

echo $weather->temperature;



/*

##############################################################
PHP migration 7x-8x
##############################################################

https://www.php.net/manual/en/migration74.php
https://www.php.net/manual/en/migration73.php
https://www.php.net/manual/en/migration72.php
https://www.php.net/manual/en/migration71.php
https://www.php.net/manual/en/migration80.php
https://www.php.net/releases/8.0/de.php?lang=de

*/

##############################################################
#	PHP Only variable references should be returned by reference FIX
##############################################################

//Before
return $_config[0] =& $config;

// After
$_config[0] =& $config;
return $_config[0];


##############################################################
#   pass by ref is not effectively used inside body
##############################################################
/*
http://schlueters.de/blog/archives/125-Do-not-use-PHP-references.html
https://www.php.net/manual/en/language.references.pass.php
https://www.php.net/manual/en/language.references.return.php
https://jonskeet.uk/java/passing.html
https://www.journaldev.com/3884/java-is-pass-by-value-and-not-pass-by-reference

since PHP 5 objects are automatically passed by reference.
*/


##############################################################
#   PHP: missing parent constructor call
##############################################################

class Trout extends Fish {
    function __construct($name, $flavor, $record) {
    parent::__construct($name, $flavor, $record);
}

##############################################################
# ajax save sql - how to remove %20 and '\xE4' in the url in php
##############################################################

utf8_decode(urldecode($SQL));


##############################################################
# count chars
##############################################################

echo substr_count($text, 'es'); // 2

/*
https://www.php.net/manual/de/function.substr-count.php
https://www.php.net/manual/de/function.count-chars.php
*/

##############################################################
# array-diff-bug
##############################################################
/*
Returns an array containing all the entries from array1 that are not present in any of the other arrays

Workaround: use array_sum() to check diff: array_sum($arr1) == array_sum($arr2)

https://stackoverflow.com/questions/39222827/php-array-diff-bug
https://www.php.net/manual/en/function.array-diff.php
https://stackoverflow.com/questions/2479963/how-does-array-diff-work
*/

##############################################################
# rand gen
##############################################################
$a = str_split("1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM");
shuffle ($a);
$r = implode($a);
$f = substr($r,0,16);
print $f;



##############################################################
# array read column
##############################################################

/*
https://www.php.net/manual/en/function.array-search.php
https://www.php.net/manual/en/function.extract.php
https://www.php.net/manual/en/function.array-column.php
*/


##############################################################
# decode all chars except  + char - for ajax calls
##############################################################

$str = "my=apples&are=green+and+red";
print_r(rawurldecode($str));


##############################################################
#   https://www.php.net/manual/de/function.setlocale.php
##############################################################

# unix cmd check
locale -a

# set
setlocale(LC_ALL, 'en_US') or die('Locale not installed');
setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'deu_deu');
setlocale(LC_COLLATE,"de_DE.utf8");
setlocale (LC_ALL, 'de_DE.utf8');

# install new language pack
# sudo apt-get install language-pack-es

################################################
#  sort öäü
################################################
/*
https://sandbox.onlinephpfunctions.com/
https://www.php.net/manual/de/function.utf8-decode.php
https://www.php.net/manual/en/function.strtr.php
*/

$str = strtr(utf8_decode("änderung"), utf8_decode("äåö"), "aao");
echo $str;





################################################
# print iframes with urls
################################################

#header("X-Frame-Options: GOFORIT");

$str = "
https://demo.themegrill.com/demos/?theme=Spacious
https://demo.mageewp.com/peony-style1/
https://demos.famethemes.com/onepress/
https://themeisle.com/demo/?theme=Hestia
http://demos.cryoutcreations.eu/wordpress/septera/
https://demo.themefreesia.com/event/
http://www.acmethemes.com/demo/?theme=corporate-plus
";

$fp = explode("\n",$str);
$maxItm = count($fp);

echo "Here are ".$maxItm." items<br>";

if(count($fp) > 0) {
	for($i=0;$i<$maxItm;$i++){
		if(trim($fp[$i])!=""){
			echo '<iframe style="width:700px; height: 600px" src="'.$fp[$i].'"></iframe><br>';
			#echo '<embed style="width:700px; height: 600px" src="'.$fp[$i].'"></embed><br>';
			echo '<a href="'.$fp[$i].'" target="new">'.$fp[$i].'</a><br>';
		}
	}
}


################################################
# sort array column
################################################
# https://stackoverflow.com/questions/16138395/sum-values-of-multidimensional-array-by-key-without-loop
$sumColumn = array_sum(array_column($arr,'fieldname'));
######
###   GuzzleHttp Promises
######
```
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

```
```

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

```

#### static classes

```
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

```

### func_array_filter

```
/*
https://www.w3schools.com/php/func_array_filter.asp
https://www.php.net/manual/de/function.array-filter.php
*/

array_filter ( $array2, 'trim' );
array_map ( $array2, 'trim' );
```

### Extract EMAIL
```
/* Extract EMAIL */
$email = "youremail@somedomain.com";
$domain_name = substr(strrchr($email, "@"), 1);
$domain_name1 = explode("@",$email)[1];
echo "<br>Domain name is :" . $domain_name;
echo "<br>Domain name is :" . $domain_name1;
```





### php worker
```
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
```

######
### singleton
######
```
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
```

######
# PDF Output Settings
######
```

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

```


######
### Laracast Decorator
######
```
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
```


######
### get check numeric
######
```
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

```


### PHP: equivalent of MySQL's function SUBSTRING_INDEX
```
# https://stackoverflow.com/questions/6885793/php-equivalent-of-mysqls-function-substring-index

$str = "www.mysql.com";
echo implode('.', array_slice(explode('.', $str), 0, 2)); // prints "www.mysql"
echo implode('.', array_slice(explode('.', $str), -2));   // prints "mysql.com"

# Removes special chars.
return preg_replace('/[^A-Za-z0-9\-]/', '', $string); //
```


### PHP: object equivalent
```
# http://phptester.net/

$objphp56 = new stdClass();
$objphp56->name = "php5.6";

var_dump($objphp56);
echo "<br>";

$objphp74 = (object)['name' => "php7.4"];
var_dump($objphp74);
```


######
### openweathermap api
######

```

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

```
```

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

```





######
### PHP migration 7x-8x
######
```
https://www.php.net/manual/en/migration74.php
https://www.php.net/manual/en/migration73.php
https://www.php.net/manual/en/migration72.php
https://www.php.net/manual/en/migration71.php
https://www.php.net/manual/en/migration80.php
https://www.php.net/releases/8.0/de.php?lang=de
```


######
###	PHP Only variable references should be returned by reference FIX
######
```
//Before
return $_config[0] =& $config;

// After
$_config[0] =& $config;
return $_config[0];
```

######
###   pass by ref is not effectively used inside body
######
```
http://schlueters.de/blog/archives/125-Do-not-use-PHP-references.html
https://www.php.net/manual/en/language.references.pass.php
https://www.php.net/manual/en/language.references.return.php
https://jonskeet.uk/java/passing.html
https://www.journaldev.com/3884/java-is-pass-by-value-and-not-pass-by-reference

since PHP 5 objects are automatically passed by reference.
```


######
###   PHP: missing parent constructor call
######
```
class Trout extends Fish {
    function __construct($name, $flavor, $record) {
    parent::__construct($name, $flavor, $record);
}
```

######
### ajax save sql - how to remove %20 and '\xE4' in the url in php
######
```
utf8_decode(urldecode($SQL));
```

######
### count chars
######
```
echo substr_count($text, 'es'); // 2


https://www.php.net/manual/de/function.substr-count.php
https://www.php.net/manual/de/function.count-chars.php

```

######
### array-diff-bug
######
```
Returns an array containing all the entries from array1 that are not present in any of the other arrays

Workaround: use array_sum() to check diff: array_sum($arr1) == array_sum($arr2)

https://stackoverflow.com/questions/39222827/php-array-diff-bug
https://www.php.net/manual/en/function.array-diff.php
https://stackoverflow.com/questions/2479963/how-does-array-diff-work
```

######
### rand gen
######
```

$a = str_split("1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM");
shuffle ($a);
$r = implode($a);
$f = substr($r,0,16);
print $f;
```


######
### array read column
######

```
https://www.php.net/manual/en/function.array-search.php
https://www.php.net/manual/en/function.extract.php
https://www.php.net/manual/en/function.array-column.php
```


######
### decode all chars except  + char - for ajax calls
######
```
$str = "my=apples&are=green+and+red";
print_r(rawurldecode($str));
```



######
###   https://www.php.net/manual/de/function.setlocale.php
######
```
# unix cmd check
locale -a

# set
setlocale(LC_ALL, 'en_US') or die('Locale not installed');
setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'deu_deu');
setlocale(LC_COLLATE,"de_DE.utf8");
setlocale (LC_ALL, 'de_DE.utf8');

# install new language pack
# sudo apt-get install language-pack-es
```


######
###  sort öäü
######
```
https://sandbox.onlinephpfunctions.com/
https://www.php.net/manual/de/function.utf8-decode.php
https://www.php.net/manual/en/function.strtr.php


$str = strtr(utf8_decode("änderung"), utf8_decode("äåö"), "aao");
echo $str;
```




######
### print iframes with urls
######
```
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
```

######
### sort array column
######
```
# https://stackoverflow.com/questions/16138395/sum-values-of-multidimensional-array-by-key-without-loop
$sumColumn = array_sum(array_column($arr,'fieldname'));
```


######
### autoload + namespaces + guzzle
######
```
composer init
# autoload psr-4 app\\ ./app
# namespace app;
composer update
require_once vendor/autoloader.php
https://packagist.org/packages/guzzlehttp/guzzle
```

######
### pdo
######
```
https://www.php.net/manual/en/pdostatement.fetchall.php
https://www.php.net/manual/en/pdostatement.fetch.php


$pdo = new PDO('mysql:host=$host; dbname=$database;', $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDP::ERRMODE_EXCEPTION);

# select
$stmt = $pdo->prepare('SELECT * FROM sometable');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

# insert
$stmt = $pdo->exec('INSERT INTO sometable (somefield) VALUES (NOW)');
$stmt = $pdo->prepare('INSERT INTO sometable (somefield) VALUE (:somefield)');
$stmt = bindValue(':somefield', $somefieldValue)
$stmt->execute();
```
######
### SERVER POST GET
######
```
$SERVER["REQUEST_METHOD"] === 'POST'
```

######
###  composer require
######
```
https://getcomposer.org/doc/03-cli.md#require
php composer.phar require "symfony/symfony:5.2.*" --ignore-platform-reqs
```



######
###  get quarter
######
```
#https://thisinterestsme.com/php-get-quarter-date/
#https://stackoverflow.com/questions/21185924/get-startdate-and-enddate-for-current-quarter-php


//The "n" format character gives us
//the month number without any leading zeros
$month = date("n");
//Calculate the year quarter.
$yearQuarter = ceil($month / 3);
//Print it out
echo "We are currently in Q$yearQuarter of " . date("Y");
#Getting the quarter of a given date.


//Our date.
$dateStr = '2019-08-19';
//Get the month number of the date
//in question.
$month = date("n", strtotime($dateStr));
//Divide that month number by 3 and round up
//using ceil.
$yearQuarter = ceil($month / 3);
//Print it out
echo "The date $dateStr fell in Q$yearQuarter of " . date("Y", strtotime($dateStr));


# https://www.w3resource.com/mysql/date-and-time-functions/mysql-quarter-function.php
# SELECT QUARTER('2009-05-18');
```


######
### regex test
######
```
$str = "035-hot6_line554";
preg_match('~hot(\d{1,})_line([a-zA-Z0-9]{1,})~', $str, $matches);
print_r($matches);

echo "<br>";
preg_match('~hot(\d+)_line([a-zA-Z0-9]+)~', $str, $matches);
print_r($matches);
```

######
### short negation test phpstorm
######

```
https://paiza.io/en/projects/new
https://wtools.io/php-sandbox
https://www.w3schools.com/php/php_compiler.asp
https://3v4l.org/
http://phptester.net/
https://extendsclass.com/php.html
https://sandbox.onlinephpfunctions.com/
*/

$str = 1;
echo (empty($str)?false:true);
echo "<br>";
echo !empty($str);
```


######
### Deprecated: iconv_set_encoding(): Use of iconv.output_encoding is deprecated in
######
```
if (function_exists('iconv') && PHP_VERSION_ID < 50600)
{
    // These are settings that can be set inside code
    iconv_set_encoding("internal_encoding", "UTF-8");
    iconv_set_encoding("input_encoding", "UTF-8");
    iconv_set_encoding("output_encoding", "UTF-8");
}
elseif (PHP_VERSION_ID >= 50600)
{
    ini_set("default_charset", "UTF-8");
}
```



######
### Transform into nummeric
#### https://stackoverflow.com/questions/9593765/convert-array-values-from-string-to-int
######
```
$string = "1,2,3"
$integerIDs = array_map('intval', explode(',', $string));
```


######
### Read  $_SERVER['HTTP_REFERER'] params
######
```
https://stackoverflow.com/questions/4310008/php-how-do-i-get-a-parameter-value-from-serverhttp-referer
https://www.php.net/manual/en/function.parse-url.php
https://www.php.net/manual/en/function.parse-str.php
http://phptester.net/


parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
echo $queries['q'];
```

### Detecting request type in PHP (GET, POST, PUT or DELETE)
```
/*
https://stackoverflow.com/questions/359047/detecting-request-type-in-php-get-post-put-or-delete
https://www.php.net/manual/de/reserved.variables.request.php
*/

switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET': $the_request = &$_GET; break;
    case 'POST': $the_request = &$_POST; break;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
}
```


######
### Reset PHP Array Index and filter
######
```
https://stackoverflow.com/questions/7536961/reset-php-array-index/7536963
https://www.php.net/manual/en/function.array-filter.php

$arr = array(

	5 => array(
	'id' => '05e4d906a',
            'name' => 'foo',
            'container' => 'Foo',
		),
	2 => array(
			'id' => '05e47906a',
            'name' => 'bar',
            'container' => 'Bar',
		)

);

print "<pre>";
print_r($arr);

print_r(array_values(array_filter($arr, function($var)
{
	return $var["name"]== 'bar'?true:false;
})));
```

######
### format array as json for log
######
```
json_encode($item, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

if (!file_put_contents($logFile, $text,  FILE_APPEND | LOCK_EX)) {
    echo "cannot write file";
}
```


######
### custom curl settings
######

```
get speed info
https://stackoverflow.com/questions/30368503/increase-curl-speed-php
https://stackoverflow.com/questions/25645634/force-ipv4-in-curl-in-php-application
https://stefangabos.github.io/Zebra_cURL/Zebra_cURL/Zebra_cURL.html
https://stackoverflow.com/questions/16872082/how-can-i-send-cookies-using-php-curl-in-addition-to-curlopt-cookiefile
https://stackoverflow.com/questions/19467449/how-to-speed-up-curl-in-php/34451397
https://reqbin.com/req/php/c-70cqyayb/curl-timeout
https://www.geeksforgeeks.org/difference-between-file_get_contents-and-curl-in-php/

CURLINFO_TOTAL_TIME - Total transaction time in seconds for last transfer
CURLINFO_NAMELOOKUP_TIME - Time in seconds until name resolving was complete
CURLINFO_CONNECT_TIME - Time in seconds it took to establish the connection
CURLINFO_PRETRANSFER_TIME - Time in seconds from start until just before file transfer begins
CURLINFO_STARTTRANSFER_TIME - Time in seconds until the first byte is about to be transferred
CURLINFO_SPEED_DOWNLOAD - Average download speed
CURLINFO_SPEED_UPLOAD - Average upload speed
```
```
$info = curl_getinfo($curl);
echo $info['connect_time']; // Same as above, but lower letters without CURLINFO

curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_ENCODING,  '');
curl_setopt($ch, CURLOPT_TCP_FASTOPEN,  1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30 );

// ------------------------------------------------

curl_setopt($ch, CURLOPT_TCP_FASTOPEN,  1);
if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
curl_setopt($ch, CURLOPT_ENCODING,  'deflate');
curl_setopt($ch, CURLOPT_USERAGENT,'php');
curl_setopt($ch, CURLOPT_AUTOREFERER,1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,1);
```

### load classes

```
https://stackoverflow.com/questions/8532569/exclude-hidden-files-from-scandir
$files = preg_grep('/^([^.])/', scandir($imagepath));


$arrClasses = preg_grep('/^([^.])/',scandir(__DIR__.'/../src/classes'));
foreach ($arrClasses as $sClass) {
    include_once(__DIR__.'/../src/'.$sClass);
}

```
### ext-json-is-missing-in-composer-json
```
https://stackoverflow.com/questions/56388531/ext-json-is-missing-in-composer-json
https://luis-barros-nobrega.medium.com/ext-json-is-missing-in-composer-json-what-is-this-700a1fcad966

{
  "require": {    
    "ext-json": "*"
  }
}
```


### getHeaderLine Psr7
```
https://www.youtube.com/watch?v=FXo85zItAzg

https://packagist.org/packages/psr/http-message
https://github.com/php-fig/http-message
https://www.php.net/manual/en/function.get-headers.php
https://packagist.org/packages/guzzlehttp/psr7
https://www.php-fig.org/psr/psr-7/
https://www.php-fig.org/psr/psr-17/

GuzzleHttp\Psr7\Header::parse
$header = $message->getHeaderLine('foo');
```


 ### The PHP constant PHP_SAPI has the same value as php_sapi_name().
 https://www.php.net/manual/en/function.php-sapi-name.php
 ```
 $sapi_type = php_sapi_name();
if (substr($sapi_type, 0, 3) == 'cgi') {
    echo "You are using CGI PHP\n";
} else {
    echo "You are not using CGI PHP\n";
}
```



### admirer Uncaught SyntaxError: Invalid or unexpected token
 ```
https://flutterq.com/uncaught-syntaxerror-invalid-or-unexpected-token/
https://www.adminer.org/
https://github.com/swooletw/laravel-swoole/issues/99

php -v 
php --ri swoole

FIX: change browser - Chrome has problems 
 ```

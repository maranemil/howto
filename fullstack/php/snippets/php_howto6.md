

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

###  control structures break
```
break accepts an optional numeric argument which tells it how many nested enclosing structures
 are to be broken out of.

https://stackoverflow.com/questions/12552721/what-is-the-meaning-of-break-2
https://www.php.net/manual/en/control-structures.break.php

foreach (...) {
  foreach (..) {
    foreach (...) {
      if ($condition) {
        break 3;
      }
    }
  }
}
```

### PHP 7.4+ Error: Typed property must not be accessed before initialization 
#### IssueIn PHP 7.4.6, newly introduced property type hints

```

https://blog.cpming.top/p/typed-property-must-not-be-accessed-before-in
https://stackoverflow.com/questions/59265625/why-i-am-suddenly-getting-a-typed-property-must-not-be-accessed-before-initiali
https://stackoverflow.com/questions/59265625/why-i-am-suddenly-getting-a-typed-property-must-not-be-accessed-before-initiali
https://madewithlove.com/blog/software-engineering/typed-property-must-not-be-accessed-before-initialization/


bad 
public bool $showInvitationManagementModal;

good
public bool $showInvitationManagementModal = false;
```


### format number as price
```

print number_format(4.99, 2, ',','.'); # 4,99
print number_format(4999.99, 2, ',','.'); # 4.999,99
```

### How to Sort a Multi-dimensional Array by Value

```

https://stackoverflow.com/questions/2699086/how-to-sort-a-multi-dimensional-array-by-value
https://stackoverflow.com/questions/3281841/how-do-i-sort-a-multi-dimensional-array-by-value
https://stackoverflow.com/questions/1496682/how-to-sum-all-column-values-in-multi-dimensional-array
https://www.php.net/manual/en/function.uasort.php
https://www.php.net/manual/en/function.array-multisort.php
http://phptester.net/

$values_arr = array(
["size"=>300,"value"=>0],
["size"=>2000,"value"=>130],
["size"=>200,"value"=>40],
["size"=>300,"value"=>40],
["size"=>300,"value"=>0],
);

usort($values_arr, function ($a, $b) {
    return $a['value'] - $b['value'];
});

print_r(json_encode($values_arr,JSON_PRETTY_PRINT) );

```


### PHP Fatal error: Access level to class::$method must be protected or weaker
#### PHP Fatal error: Access level must be protected
```

https://stackoverflow.com/questions/45290131/why-do-i-get-an-access-level-must-be-protected-or-weaker-after-extending-a-pro
https://stackoverflow.com/questions/11183190/access-level-to-certain-class-must-be-public-error-in-php
https://github.com/rokka-io/rokka-wordpress-plugin/issues/29
http://phptester.net/


abstract class AbstractController
{
    protected $repository;
}

class GraphController extends AbstractController
{
    private $repository;
}


FATAL ERROR Access level to GraphController::$repository must be protected (as in class AbstractController) or weaker on line number 11


Controlling Access to Members of a Class
https://docs.oracle.com/javase/tutorial/java/javaOO/accesscontrol.html
https://stackoverflow.com/questions/215497/what-is-the-difference-between-public-protected-package-private-and-private-in

Class Package Subclass
(same pkg) Subclass
(diff pkg) World
public + + + + +
protected + + + +
no modifier + + +
private +

Access Levels
Modifier Class Package Subclass
public Y Y Y Y
protected Y Y Y N
no modifier Y Y N N
private Y N N N
```

### max value Multi-dimensional Array by Value

```

https://www.php.net/manual/en/function.max.php
https://stackoverflow.com/questions/5093171/hightest-value-of-an-associative-array

echo max(array_column($array, 'key1'));

```



### Uncaught Error: Call to undefined function mysqli_report()
```

https://stackoverflow.com/questions/17024036/what-causes-a-fatal-error-call-to-undefined-function-mysqli-report
https://hotexamples.com/examples/-/-/mysqli_report/php-mysqli_report-function-examples.html

sudo apt install php-mysql
```

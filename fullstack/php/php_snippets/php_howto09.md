~~~
############################################################
JSON_THROW_ON_ERROR - json_decode throw exceptions on errors
############################################################

https://laravel-news.com/php-7-3-json-error-handling
https://php.watch/versions/7.3/json-encode-decode-exception


# The Throw on Error Flag in PHP 7.2
$json = json_encode(compact('iv', 'value', 'mac'));
if (json_last_error() !== JSON_ERROR_NONE) {
    throw new EncryptException('Could not encrypt the data.');
} 
return base64_encode($json);



# The Throw on Error Flag in PHP 7.3
use JsonException;
 
try {
    $json = json_encode(compact('iv', 'value', 'mac'), JSON_THROW_ON_ERROR);
    return base64_encode($json);
} catch (JsonException $e) {
    throw new EncryptException('Could not encrypt the data.', 0, $e);
}

try {
    json_decode("{", false, 512, JSON_THROW_ON_ERROR); 
}
catch (\JsonException $exception) {
    echo $exception->getMessage(); // echoes "Syntax error" 
}
~~~


~~~
############################################################
String cleaner
############################################################

https://stackoverflow.com/questions/6226594/array-map-with-str-replace

## http://phptester.net/

$arr = [
	"München_-%&/§!",
	"+68 043 876 / - 998"
];


$arr = array_map(
	static function($value) { 
		return preg_replace("#[^a-zA-Z0-9-äöüß.:@/\-\s+]#iu", "", $value);
	}
	,$arr);

print_r($arr);
~~~


~~~
############################################################
tcpdf set text color
############################################################
https://stackoverflow.com/questions/10545405/tcpdf-how-to-set-two-text-color


$this->pdf->SetTextColor(245,0,0);
~~~



~~~
############################################################
roundabout 2 digits
############################################################
print "<pre>";
# http://phptester.net/
foreach (range(0, 100, 10) as $number) {
    $arr_random[] = $number+random_int(1, 9);
}
print_r($arr_random);

function roundabout($int){
	return substr($int,-2);
}

foreach($arr_random as $int_rand){
	$arr_roundabount[] = roundabout($int_rand);
}
print_r($arr_roundabount);

/*
https://www.php.net/manual/de/function.array-rand.php
https://www.php.net/manual/en/function.random-int
https://www.php.net/manual/de/function.range.php
*/
~~~



~~~
#####################################################################
str_contains for php7.4
#####################################################################

strpos(string $haystack, string $needle, int $offset = 0): int|false
str_contains(string $haystack, string $needle): bool

http://phptester.net/
https://www.php.net/manual/en/function.strpos.php
https://www.php.net/manual/en/function.str-contains.php
https://onlinephp.io/

$data_email = "nfo@example.com";
if(!strpos($data_email,"example.com")){
    print("error");
}
else{
    print("ok");
}
~~~

~~~
#####################################################################
getenv
#####################################################################

https://www.php.net/manual/de/reserved.variables.environment.php
https://www.php.net/manual/de/function.getenv.php

echo 'My username is ' .$_ENV["REMOTE_ADDR"] . '!';
echo getenv('REMOTE_ADDR');
echo $_SERVER['REMOTE_ADDR'];

#####################################################################
Set up a dev environment 
#####################################################################

https://docs.docker.com/compose/environment-variables/set-environment-variables/
https://docs.docker.com/desktop/dev-environments/set-up/
https://docs.docker.com/compose/environment-variables/env-file/
https://docs.docker.com/compose/environment-variables/envvars-precedence/

web:
  environment:
    - DEBUG=1
https://docs.docker.com/compose/environment-variables/set-environment-variables/
~~~

~~~
#####################################################################
async
#####################################################################
https://entwickler.de/php/async-php-mit-reactphp
https://stackoverflow.com/questions/14236296/asynchronous-function-call-in-php
~~~
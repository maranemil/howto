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



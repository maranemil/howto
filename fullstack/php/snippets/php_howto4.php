####################################################
#
# PHP CACHE Options
#
####################################################

/*
https://www.php.net/manual/en/memcache.set.php
http://www.php-cache.com/en/latest/
https://github.com/php-cache/predis-adapter
https://www.php.net/manual/de/book.opcache.php
https://www.php.net/manual/de/book.apc.php
https://www.php.net/manual/de/mysqlnd-qc.quickstart.caching.php
https://www.php.net/manual/en/book.apc.php
https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/caching.html
https://twig.symfony.com/doc/2.x/api.html
https://www.php.net/manual/en/function.apc-add.php
https://www.php.net/manual/en/function.apc-store.php
https://laravel.com/docs/5.7/cache
https://www.php.net/manual/de/mysqlnd-qc.constants.php
https://www.hgb-leipzig.de/~uklaus/PHP/mysqlnd-qc.quickstart.caching.html
https://www.hgb-leipzig.de/~uklaus/PHP/mysqlnd-qc.constants.html
https://www.php.net/manual/en/book.mysqlnd-qc.php


// -----------------------------------------------
http://www.php-cache.com/en/latest/
https://www.phpfastcache.com/
https://www.php-fig.org/psr/psr-6/
// -----------------------------------------------

[Regular drivers]
Apc
Cookie
Files
Leveldb
Memcache
Sqlite
Wincache
Xcache
Zend Disk Cache

[High performances drivers]
Cassandra
CouchBase
Couchdb
Mongodb
Predis
Redis
Riak
Ssdb
Zend Memory Cache

[Development drivers]
Devnull
Devfalse
Devtrue
Memstatic

*/


####################################################
#
#   Array Funktionen range
#   https://www.php.net/manual/de/function.range.php
#   http://phptester.net/
#
####################################################

$t0 = microtime(true);
for ($i = 0; $i < 100000; $i++) {}
echo 'for loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL;

$t0 = microtime(true);
foreach (range(0, 100000) as $i) {}
echo 'foreach + range loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL;

// ----------------------------------------------

foreach(range(0,10000) as $i) {} // 3.847 ms 0.0034
for($i = 0; $i < 10000; ++$i) {} // 0.663 ms 0.0014

for($i = 0; $i < 1000; ++$i) {} // faster
for($i = 0; $i < 1000; $i++) {}

####################################################
#
#	Get the first element of an array
#   https://stackoverflow.com/questions/1921421/get-the-first-element-of-an-array
#
####################################################

array_shift(array_values($array));
array_pop(array_reverse($array));
array_shift(array_slice($array, 0, 1));
array_values($array)[0];

$my_array = ['IT', 'rules', 'the', 'world'];
$first_key = array_key_first($my_array);
$first_value = $my_array[$first_key];
$last_key = array_key_last($my_array);
$last_value = $my_array[$last_key];

$array[key($array)] #  to get first element
key($array) # to get first key.


####################################################
#
#   Crop an image to the given rectangle
#   https://www.php.net/manual/de/function.imagecrop.php
#
####################################################

$im = imagecreatefrompng('example.png');
$size = min(imagesx($im), imagesy($im));
$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
if ($im2 !== FALSE) {
    imagepng($im2, 'example-cropped.png');
    imagedestroy($im2);
}
imagedestroy($im);


#######################################################################
#
#	Void return types are for PHP 7.1 From the RFC
#	Version: 0.2.1
#	Date: 2015-02-14 (v0.1, later withdrawn), 2015-10-14 (v0.2, revival)
#	Author: Andrea Faulds, ajf@ajf.me
#	Status: Implemented (PHP 7.1)
#
#######################################################################

/*
types: int, string, null, bool, class objects, void.

https://wiki.php.net/rfc/void_return_type
https://www.php.net/manual/de/migration70.new-features.php
https://www.php.net/manual/de/migration71.new-features.php
https://www.php.net/manual/de/functions.returning-values.php
https://www.php.net/manual/de/function.create-function.php
https://www.php.net/manual/de/functions.arguments.php
*/

public static function setResponseCode(int $code) : void
{
    http_response_code($code);

}

function should_return_nothing(): void {
    return 1; // Fatal error: A void function must not return a value
}

function lacks_return(): void {
    // valid
}

function returns_nothing(): void {
    return; // valid
}

function returns_one(): void {
    return 1; // Fatal error: A void function must not return a value
}

function returns_null(): void {
    return null; // Fatal error: A void function must not return a value
}

function foobar(void $foo) {
	// Fatal error: void cannot be used as a parameter type
}

class Foo
{
    public function bar(): void {
    }
}

class Foobar extends Foo
{
    public function bar(): array { // Fatal error: Declaration of Foobar::bar() must be compatible with Foo::bar(): void
    }
}

/*
How to alias a function in PHP
https://stackoverflow.com/questions/1688711/how-to-alias-a-function-in-php
https://www.php.net/manual/en/function.runkit-function-copy.php
https://gist.github.com/nathanbrauer/cdd286351f68a1b4e3a5
*/

# PHP 5.6+ only
use function sleep as wait;

# PHP 5.3
$wait = function($v) { return sleep($v); };
function wait() {  return call_user_func_array("sleep", func_get_args()); }

/*
----------------------------------------------------
PHP 7.2 each() function deprecated ·
https://github.com/NagVis/nagvis/issues/142
----------------------------------------------------
*/

while (list($key, $value) = each($params)) {}
// turns into
foreach($params as $k => $v) {}

$fruit = array('a' => 'apple', 'b' => 'banana', 'c' => 'cranberry');
reset($fruit);
// if(count($fruit) > 0) while (list($key, $val) = each($fruit)) echo "$key => $val<br>";
while (list($key, $val) = each($fruit)) {
    echo "$key => $val<br>";
}

foreach($fruit as $key => $val){
	 echo "$key => $val<br>";
}


/*
---------------------------------
[declare type and allow NULL as input]
---------------------------------
http://sandbox.onlinephpfunctions.com/
http://sandbox.onlinephpfunctions.com/#7.2.4
http://phptester.net/#7.0
http://www.writephponline.com/
https://www-coding.de/php-code-online-testen/
*/

declare(strict_types = 1);
function setInt(?int $int): void{
	echo $int."<br/ >";
}

setInt(1);
setInt(null);
setInt("1");

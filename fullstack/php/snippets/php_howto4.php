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
#ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
#ini_set('display_errors', true);
#ini_set('display_startup_errors', true);

// ? allow null value
function setInt(?int $int): void{
	echo $int."<br/ >";
}

setInt(1);
setInt(null);
setInt("1");

class DummyItem{
    private $intIte = null ;
    public function __construct(){}
    public function setIntItem(?int $intItem): void{
        $this->intItem = $intItem;
    }
    public function getIntItem(): ?int{
        return $this->intItem;
    }
}




/*
[]php read class without namespace]
https://coderwall.com/p/cpxxxw/php-get-class-name-without-namespace
https://www.php.net/manual/de/reflectionclass.getshortname.php
*/

namespace MyCustomNameSpace;
class MyCustomClass{

	public function __construct(){
		echo __CLASS__."<br>";
		echo substr(strrchr(__CLASS__, "\ "), 1)."<br>";
		echo (new \ReflectionClass($this))->getShortName()."<br>";
	}

}

new MyCustomClass();

/*
MyCustomNameSpace\MyCustomClass
MyCustomClass
MyCustomClass
*/




#############################################
#
# Read Disk space
#
#############################################

$bytes = disk_total_space(__DIR__);
$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
$base = 1024;
$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
echo "TOTAL SPACE<br />";
echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';

$bytes = disk_free_space(__DIR__);
$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
$base = 1024;
$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
echo "FREE SPACE<br />";
echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';

$path_parts = pathinfo(__DIR__);
echo $path_parts['dirname'], "<br />";
echo $path_parts['basename'], "<br />";
echo $path_parts['extension'], "<br />";
echo $path_parts['filename'], "<br />"; // seit PHP 5.2.0s

// https://www.phpliveregex.com/
// https://regex101.com/
$output = shell_exec('df -h -T');
echo "<pre>$output</pre>";
if(preg_match('/[8-9]0%/',$output)){
   echo "warning!<br />";
}

// Use awk to pull out the columns you actually want
#$output = shell_exec('df -h -T | awk \'{print $1 " " $3 " " $5}\'');
#echo "<pre>$output</pre>";
/*
df -h --output=source,target
df -hx tmpfs --output=source,target
df -hT
cat /proc/mounts
https://www.cyberciti.biz/faq/linux-check-disk-space-command/
*/
/*
ssh [servername] " df -hk [partition_name]"
ssh [servername] " df -hk [partition_name]"

shell_exec("ssh user@host.com mkdir /testing");
system('ssh -i /home/me/keys/key.pem user@ip-xx-xxx-xxx-xxx-end.ip "ls"');

https://www.php.net/manual/de/function.ssh2-exec.php
https://serverfault.com/questions/328541/ssh-command-from-php-script-nothing-yet-work-at-cmd-line
*/


include('Net/SSH2.php');

$ssh = new Net_SSH2('www.domain.tld');
if (!$ssh->login('username', 'password')) {
    exit('Login Failed');
}

echo $ssh->exec('pwd');
echo $ssh->exec('ls -la');


#############################################
#
# Proof of Concept remove items on each iteration
#
#############################################

class refetch{
	public $fetchlist = array();
	public function __construct($operator,$kitems){
		$this->setFetchList($kitems);
		$this->refetchItems();

	}
	public function refetchItems(){
		foreach($this->fetchlist as $key => $item){
			// fetch item
			if((rand(1,8) % 2) == 1){
				//  remove in list
				echo " Removed ".$item."<br>";
				if (($key = array_search($item, $this->fetchlist)) !== false) {
					unset($this->fetchlist[$key]); # remove by key
					//$this->fetchlist = array_diff($this->fetchlist,array($item)); # alternative by value
					//$this->fetchlist = array_diff(array_values($this->fetchlist),array($item)); # alternative by value
				}
			}
			else{
				// if fail - do nothing
			}
		}
    }
	public function setFetchList($kitems){
		$this->fetchlist = $kitems;
	}
	public function getFetchList(){
		return $this->fetchlist;
	}
}

$oplist = array_map(function ($n) {return $n;}, range(10000, 10002));
$kitems = array_map(function ($n) {return sprintf('sample_%03d', $n);}, range(1, 12));

echo "<pre>";
#echo (rand(1,8)%2)."<br>";
print_r($oplist);
#print_r($kitems);

foreach ($oplist as $operator){
	echo "Before:".implode(",", $kitems)."<br>";
	$obrefetch = new refetch($operator,$kitems);
	$kitems = $obrefetch->getFetchList();
	echo "After:". implode(",", $kitems)."<hr>";
}

/*
Array
(
    [0] => 10000
    [1] => 10001
    [2] => 10002
)
Before:sample_001,sample_002,sample_003,sample_004,sample_005,sample_006,sample_007,sample_008,sample_009,sample_010,sample_011,sample_012
 Removed sample_004
 Removed sample_008
 Removed sample_009
 Removed sample_012
After:sample_001,sample_002,sample_003,sample_005,sample_006,sample_007,sample_010,sample_011
Before:sample_001,sample_002,sample_003,sample_005,sample_006,sample_007,sample_010,sample_011
 Removed sample_001
 Removed sample_005
 Removed sample_007
 Removed sample_011
After:sample_002,sample_003,sample_006,sample_010
Before:sample_002,sample_003,sample_006,sample_010
 Removed sample_002
 Removed sample_003
After:sample_006,sample_010
*/




#######################################################################
#
#   ERR Declaration of B::foo() should be compatible with A::foo($bar = null)
#   https://stackoverflow.com/questions/36079651/silence-declaration-should-be-compatible-warnings-in-php-7
#
#   FIX:
#
#   - public function foo()
#   + public function foo($bar = null)
#
#######################################################################


# FIX Workaround code legacy disable warning

if (PHP_MAJOR_VERSION >= 7) {
    set_error_handler(function ($errno, $errstr) {
       return strpos($errstr, 'Declaration of') === 0;
    }, E_WARNING);
}

if (PHP_MAJOR_VERSION >= 7) {
    set_error_handler(function ($errno, $errstr, $file) {
        return strpos($file, 'path/to/legacy/library') !== false &&
            strpos($errstr, 'Declaration of') === 0;
    }, E_WARNING);
}


#######################################################################
#
#   Correctly determine if date string is a valid date in that format
#   https://stackoverflow.com/questions/19271381/correctly-determine-if-date-string-is-a-valid-date-in-that-format
#   https://www.php.net/manual/de/function.checkdate.php
#
#######################################################################

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

var_dump(validateDate('2013-13-01'));  // false
var_dump(validateDate('20132-13-01')); // false
var_dump(validateDate('2013-11-32'));  // false
var_dump(validateDate('2012-2-25'));   // false
var_dump(validateDate('2013-12-01'));  // true
var_dump(validateDate('1970-12-01'));  // true
var_dump(validateDate('2012-02-29'));  // true
var_dump(validateDate('2012', 'Y'));   // true
var_dump(validateDate('12012', 'Y'));  // false
var_dump(checkdate(12, 31, 2000));
var_dump(checkdate(2, 29, 2001));


/*
How to Validate Date String in PHP
https://www.codexworld.com/how-to/validate-date-input-string-in-php/
https://www.php.net/manual/en/function.date.php
http://wifo5-03.informatik.uni-mannheim.de/bizer/rdfapi/phpdoc/sparql/_sparql---FilterFunctions.php.html
https://www.geeksforgeeks.org/php-checkdate-function/
*/

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

var_dump(validateDate('2018-12-01'));
var_dump(validateDate('2018-2-5', 'Y-n-j'));

// ----

$month = 12;
$day = 31;
$year = 2017;
// returns a boolean value after validation of date
var_dump(checkdate($month, $day, $year));




##################################################
#
# Get date interval range php7 DateTime
#
##################################################

// https://www.php.net/manual/de/class.dateperiod.php
// https://www.php.net/manual/de/function.cal-days-in-month.php
// https://www.php.net/manual/en/datetime.formats.date.php
// https://www.geeksforgeeks.org/return-all-dates-between-two-dates-in-an-array-in-php/
// https://www.codementor.io/tips/1170438972/how-to-get-an-array-of-all-dates-between-two-dates-in-php

$begin = new DateTime( '2012-08-01' );
$end = new DateTime( '2012-08-31' );
$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    echo $date->format("Y-m-d") . "<br>";
}

//Nice example from PHP Spring Conference (thanks to Johannes Schlüter and David Zülke)
/*

$begin = new DateTime( '2007-12-31' );
$end = new DateTime( '2009-12-31 23:59:59' );

$interval = DateInterval::createFromDateString('last thursday of next month');
$period = new DatePeriod($begin, $interval, $end, DatePeriod::EXCLUDE_START_DATE);

foreach ( $period as $dt )
  echo $dt->format( "l Y-m-d H:i:s\n" ). "<br>";
  */


#####################################################################
#
#   Random Unique md5
#
#####################################################################

echo (microtime(1));
echo "<br>";
echo substr(md5(rand()), 0, 10);
echo "<hr>";


echo microtime(true);
usleep(100);
echo "<br>";
echo microtime(true);
usleep(100);

echo "<br>";
echo mt_rand(100, 10000);
echo "<br>";
echo mt_rand(100, 10000);



################################################
#
#	ZipArchive error
#
################################################
/*
https://www.php.net/manual/de/function.iconv.php
https://www.php.net/manual/de/class.ziparchive.php
https://www.php.net/manual/de/ziparchive.extractto.php
https://www.php.net/manual/de/ziparchive.renamename.php
https://www.php.net/manual/de/ziparchive.open.php
https://www.php.net/manual/de/class.ziparchive.php
https://github.com/yakamara/redaxo_yform/issues/616

ZIPARCHIVE::ER_EXISTS - 10
ZIPARCHIVE::ER_INCONS - 21
ZIPARCHIVE::ER_INVAL - 18
ZIPARCHIVE::ER_MEMORY - 14
ZIPARCHIVE::ER_NOENT - 9
ZIPARCHIVE::ER_NOZIP - 19
ZIPARCHIVE::ER_OPEN - 11
ZIPARCHIVE::ER_READ - 5
ZIPARCHIVE::ER_SEEK - 4
*/

$zip = new ZipArchive;
$res = $zip->open('test.zip');
if ($res === TRUE) {
    $zip->renameName('aktueller_name.txt','neuer_name.txt');
    $zip->close();
} else {
    echo 'Fehler, Code:' . $res;
}


################################################
#
#	Iconv php call bash
#
################################################
/*
https://www.php.net/manual/de/function.iconv.php
https://wiki.ubuntuusers.de/Skripte/Zeichensatzkonvertierung/
*/
exec("iconv -f ISO-8859-15 -t UTF-8 -o utf8datei.txt isodatei.txt");
exec("iconv -f ISO-8859-14 Agreement.txt -t UTF-8 -o agreement.txt");

################################################
#
#   Lists of Throwable and Exception tree as of 7.2.0
#   Unhandled Exception - IntelliJ Platform PhpStorm
#
################################################

/*
https://www.php.net/manual/en/function.set-exception-handler.php
https://www.php.net/manual/en/function.set-error-handler.php
https://www.php.net/manual/en/language.exceptions.php
https://www.php.net/manual/en/language.exceptions.extending.php
https://www.php.net/manual/de/class.errorexception.php
https://www.php.net/manual/de/class.error.php
https://www.php.net/manual/de/language.errors.php7.php
https://www.php.net/manual/en/language.errors.php7.php
https://www.php.net/manual/en/class.throwable.php
https://www.php.net/manual/en/language.errors.php7.php
https://www.php.net/manual/de/language.exceptions.php
http://phptester.net/
https://stackify.com/php-try-catch-php-exception-tutorial/
https://www.geeksforgeeks.org/exception-handling-in-php/
https://www.php.net/manual/de/class.exception.php
https://blog.jetbrains.com/phpstorm/2017/11/bring-exceptions-under-control/


Exception Analysis Unhandled exception JAVA
https://blog.jetbrains.com/phpstorm/2017/09/phpstorm-2017-3-eap-173-2290/
https://www.jetbrains.com/help/idea/php.html
http://www.avajava.com/tutorials/lessons/how-do-i-surround-code-with-a-try-catch-block.html
https://docs.oracle.com/javase/tutorial/essential/exceptions/runtime.html
https://www.php.net/manual/en/class.errorexception.php
https://www.php.net/manual/de/ref.errorfunc.php
https://www.programcreek.com/java-api-examples/?api=com.intellij.psi.controlFlow.AnalysisCanceledException
https://stackoverflow.com/questions/334319/does-wrapping-everything-in-try-catch-blocks-constitute-defensive-programming
https://www.baeldung.com/java-chained-exceptions
https://stackoverflow.com/questions/5020876/what-is-the-advantage-of-chained-exceptions
https://www.php.net/manual/de/exception.construct.php
https://rollbar.com/guides/php-exception-handling/#
https://www.codediesel.com/php/handling-multiple-exceptions-in-php-7-1/
https://www.codementor.io/@ahmedkhan847/how-php-7-handles-exceptions-class-errors-5k28fku72
https://docs.oracle.com/javase/tutorial/essential/exceptions/
http://www.fuwjax.com/how-slow-are-java-exceptions/



Lists of Throwable and Exception tree as of 7.2.0

    Error
      ArithmeticError
        DivisionByZeroError
      AssertionError
      ParseError
      TypeError
        ArgumentCountError
    Exception
      ClosedGeneratorException
      DOMException
      ErrorException
      IntlException
      LogicException
        BadFunctionCallException
          BadMethodCallException
        DomainException
        InvalidArgumentException
        LengthException
        OutOfRangeException
      PharException
      ReflectionException
      RuntimeException
        OutOfBoundsException
        OverflowException
        PDOException
        RangeException
        UnderflowException
        UnexpectedValueException
      SodiumException
*/


################################################
#
# Remove unwanted chars
#
################################################

$str = "Z przyjemnością przei i zostaną Państwu doręczone<br> najszybciej.";
echo preg_replace('/[^\00-\255]+/u', '', $str);

################################################
# FILTER_SANITIZE_STRING
################################################
/*
http://php.net/manual/en/filter.filters.sanitize.php
http://php.net/manual/de/filter.filters.sanitize.php
*/
// prevent XSS
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);




################################################
#   CURLOPT_DNS_CACHE_TIMEOUT
################################################
/*
https://linux.die.net/man/3/curl_easy_setopt
http://manpages.ubuntu.com/manpages/xenial/man3/CURLOPT_DNS_CACHE_TIMEOUT.3.html
https://curl.haxx.se/libcurl/c/CURLOPT_DNS_CACHE_TIMEOUT.html
https://open.frostly.com/rust-slack/curl_sys/constant.CURLOPT_DNS_CACHE_TIMEOUT.html
*/

# CURLOPT_DNS_CACHE_TIMEOUT
/*
CURL *curl = curl_easy_init();
if(curl) {
  curl_easy_setopt(curl, CURLOPT_URL, "http://example.com/foo.bin");
  // only reuse addresses for a very short time
  curl_easy_setopt(curl, CURLOPT_DNS_CACHE_TIMEOUT, 2L);
  ret = curl_easy_perform(curl);
  // in this second request, the cache will not be used if more than
   //  two seconds have passed since the previous name resolve
  ret = curl_easy_perform(curl);
  curl_easy_cleanup(curl);
}
*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_RESOLVE, $resolveparam);
curl_setopt($ch, CURLOPT_URL, "https://example.com/some/path");
curl_setopt($ch, CURLOPT_VERBOSE, 1);
$result = curl_exec($ch);
$info = curl_getinfo($ch);

##################################
#
#	Transfer-Encoding
#
##################################
/*
https://developer.mozilla.org/de/docs/Web/HTTP/Headers/Transfer-Encoding
http://docs.telerik.com/fiddler/Configure-Fiddler/Tasks/FirefoxHTTPS
*/

/*
Transfer-Encoding: chunked
Transfer-Encoding: compress
Transfer-Encoding: deflate
Transfer-Encoding: gzip
Transfer-Encoding: identity
*/

################################################################
#
#	nl2br + br2nl
#
################################################################
/*
https://www.ask-sheldon.com/br2nl/
https://www.informatikzentrale.de/htmlspecialchars-stripslashes.html
https://www.php.net/manual/en/function.nl2br.php
https://stackoverflow.com/questions/37909602/line-breaks-using-htmlspecialchars
http://phptester.net/
https://www.php.net/manual/de/function.htmlspecialchars.php
*/

function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

$a = "Wer reitet so spät durch Nacht und Wind?\nEs ist der Vater mit seinem Kind.\nEr hält den Knaben ...";
$a = htmlspecialchars(nl2br($a));
echo $a;


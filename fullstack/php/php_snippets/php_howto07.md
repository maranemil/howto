
```

#######################################################
#
#   Filters
#
#######################################################

// echo "<pre>";
// http://phptester.net/

// https://www.php.net/manual/en/function.filter-var.php
// https://www.php.net/manual/en/filter.filters.validate.php
// https://www.php.net/manual/en/filter.filters.sanitize.php
// https://www.w3schools.com/php/filter_sanitize_number_int.asp
// https://www.php.net/manual/en/function.strip-tags.php

/*

var_dump(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var($string, FILTER_VALIDATE_INT));
var_dump(filter_var($string, FILTER_SANITIZE_STRING));
var_dump(filter_var($string, FILTER_VALIDATE_BOOLEAN));
var_dump(filter_var($string, FILTER_VALIDATE_DOMAIN));
var_dump(filter_var($string, FILTER_VALIDATE_URL));
var_dump(filter_var($string, FILTER_VALIDATE_EMAIL));
var_dump(filter_var($string, FILTER_VALIDATE_IP));

var_dump(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var($string, FILTER_SANITIZE_STRING));
var_dump(filter_var($string, FILTER_SANITIZE_ADD_SLASHES));
var_dump(filter_var($string, FILTER_SANITIZE_STRING));
var_dump(filter_var($string, FILTER_SANITIZE_URL));
var_dump(filter_var($string, FILTER_SANITIZE_EMAIL));


*/

/*
Classic sort
https://christoph-rumpel.com/2020/8/refactoring-php
https://www.php.net/manual/en/function.array-filter.php
*/

$users = [
    [ 'id' => 801, 'name' => 'Peter', 'score' => 505, 'active' => true],
    [ 'id' => 844, 'name' => 'Mary', 'score' => 704, 'active' => true],
    [ 'id' => 542, 'name' => 'Norman', 'score' => 104, 'active' => false],
];

// Requested Result: only active users, sorted by score ["Mary(704)","Peter(505)"]
$users = array_filter($users, fn ($user) => $user['active']);
usort($users, fn($a, $b) => $a['score'] < $b['score']);
$userHighScoreTitles = array_map(fn($user) => $user['name'] . '(' . $user['score'] . ')', $users);
return $userHighScoreTitles;



/*
http://phptester.net/
https://www.php.net/manual/de/function.array-diff-assoc.php
https://www.php.net/manual/de/function.array-intersect.php
https://www.php.net/manual/de/function.array-merge-recursive.php
https://www.php.net/manual/de/function.array-merge.php
*/


$arr = array(3);
print "<pre>";
print_r(array_intersect(array(1=>1,5=>5),$arr));
print_r(array_diff_assoc(array(1=>1,5=>5),$arr));
print_r(array_merge(array(1=>1,5=>5),$arr));
print_r(array_merge_recursive(array(1=>1,5=>5),$arr));
print_r(array_unique(array_merge(array(1=>1,5=>5),$arr)));

/*
Array
(
)
Array
(
    [1] => 1
    [5] => 5
)
Array
(
    [0] => 1
    [1] => 5
    [2] => 3
)
Array
(
    [0] => 1
    [1] => 5
    [2] => 3
)
Array
(
    [0] => 1
    [1] => 5
    [2] => 3
)
*/
```

```

############################################
# Extract Numbers From a String in PHP
# https://www.delftstack.com/howto/php/how-to-extract-numbers-from-a-string-in-php/
############################################

$string = 'Sarah has 4 dolls and 6 bunnies.';
preg_match_all('!\d+!', $string, $matches);
print_r($matches);

$string = 'Sarah has 4 dolls and 6 bunnies.';
$int = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
echo("The extracted numbers are: $int \n");

$string = 'Sarah has 4 dolls and 6 bunnies.';
$outputString = preg_replace('/[^0-9]/', '', $string);
echo("The extracted numbers are: $outputString \n");
```

```

############################################
# Get the Last Character of a String in PHP
# https://www.delftstack.com/howto/php/how-to-get-the-last-char-of-a-string-in-php/
############################################

$string = 'This is a string';
$lastChar = substr($string, -1);
echo "The last char of the string is $lastChar.";

$string = "This is a string";
$lastChar = $string[strlen($string)-1];
echo "The last char of the string is $lastChar.";

$string = "This is a string";
$lastChar = $string[-1];
echo "The last char of the string is $lastChar.";
```

```

#######################################
# AND vs && as operator in PHP
#######################################

# https://stackoverflow.com/questions/2803321/and-vs-as-operator
# https://www.php.net/manual/en/language.operators.logical.php

// "||" has a greater precedence than "or"

// The result of the expression (false || true) is assigned to $e
// Acts like: ($e = (false || true))
$e = false || true;

// The constant false is assigned to $f and then true is ignored
// Acts like: (($f = false) or true)
$f = false or true;

if ($var = true && false) // Compare true with false and assign to $var
if ($var = true and false) // Assign true to $var and compare $var to false

```


```

#######################################
# remove spaces
#######################################

preg_replace('/\s/','',$str);
```

```

#######################################
#   PSR-12: Extended Coding Style - PHP-FIG
#######################################

/*
PHPStorm -> Editor -> Code Style -> PHP -> PSR-12
https://www.phptools.online/php-checker


https://www.php-fig.org/psr/psr-12/
https://www.php-fig.org/psr/psr-1/
https://www.php-fig.org/psr/psr-12/
https://www.php-fig.org/psr/psr-12/meta/
https://www.php-fig.org/psr/psr-12/
https://www.php-fig.org/psr/psr-2/
https://en.wikipedia.org/wiki/PHP_Standard_Recommendation
https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-12-extended-coding-style-guide-meta.md
https://blog.quickadminpanel.com/psr-2-and-psr-12-why-we-need-standards-and-how-to-apply-them/
https://thoeny.dev/php-differences-between-psr-12-and-psr-2
https://siderlabs.com/blog/5-php-coding-standards-you-will-love-and-how-to-use-them-adf6a4855696/
*/
```

```

#######################################
# autoloader
#######################################
/*
https://www.php.net/manual/de/function.spl-autoload-register.php
https://github.com/symfony/class-loader/blob/3.4/ClassLoader.php
https://stackoverflow.com/questions/17806301/best-way-to-autoload-classes-in-php
https://www.php.net/manual/en/language.oop5.autoload.php
https://www.php.net/manual/en/function.spl-autoload-register.php
https://www.php.net/manual/en/function.spl-autoload.php
https://www.php.net/manual/en/function.autoload.php
https://stackoverflow.com/questions/3642282/php-autoloading-in-namespaces
https://tutorials.supunkavinda.blog/php/oop-autoloading
https://code.tutsplus.com/tutorials/how-to-autoload-classes-with-composer-in-php--cms-35649
https://www.patrick-saar.de/artikel/autoloading-mit-php
https://www.phptutorial.net/php-oop/php-autoloading-class-files/
https://stackoverflow.com/questions/3656799/using-php-scandir-to-scan-files-and-then-require-once-them
https://www.webtipblog.com/using-spl_autoload_register-load-classes-php-project/
https://hotexamples.com/examples/-/Tools/scandir/php-tools-scandir-method-examples.html
*/

$member_files = scandir(MEMBERS.DS);
foreach($member_files as $member_file) {
    // Ignore non php files and thus ".." & "."
    if (!preg_match('/\.php$/', $member_file) {
      continue;
    }
    require_once(MEMBERS.DS.$member_file);
}

#...


spl_autoload_register(function($className) {
    include "/path/to/lib/and/$className.php";
});
$foo = new Foo;

#...

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');

// Or, using an anonymous function
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

#...

spl_autoload_register(function ($class) {
    @require_once('lib/type/' . $class . '.php');
    @require_once('lib/size/' . $class . '.php');
});

#...

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$obj  = new MyClass1();
$obj2 = new MyClass2();

#...

spl_autoload_register(__NAMESPACE__ . "\\className::functionName"));



spl_autoload_register(function($className) {
	$file = $className . '.php';
	if (file_exists($file)) {
		include $file;
	}
});

spl_autoload_register(function($className) {
	$file = __DIR__ . '\\' . $className . '.php';
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
	if (file_exists($file)) {
		include $file;
	}
});


#...

foreach (Tools::scandir($this->getLocalPath() . 'override', 'php', '', true) as $file) {
     $class = basename($file, '.php');
     if (Autoload::getInstance()->getClassPath($class . 'Core')) {
         $result &= $this->removeOverride($class);
     }
 }


#----------------
# Example Autoloading
# Structure

/*

src/
	Fruits/
		Apple.php
		Orange.php
		Banana.php
	App.php
includes/
	autoload.php
app.php

*/

# includes/autoload.php
#---------------

spl_autoload_register(function($className) {
	$file = dirname(__DIR__) . '\\src\\' . $className . '.php';
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
	echo $file;
	if (file_exists($file)) {
		include $file;
	}
});

# app.php
#---------------
// app.php
include_once 'includes/autoload.php';

// freely use the classes
$app = new App();
$apple = new Fruits\Apple();
$orange = new Fruits\Orange();
$banana = new Fruits\Banana();

/*
utf8_encode
*/
$utfEncodedArray = array_map("utf8_encode", $inputArray );


/*
error_log

https://stackoverflow.com/questions/15530039/how-to-write-to-error-log-file-in-php/33035277
https://stackify.com/display-php-errors/
*/
error_log(
	print_r($var, true)."\n",
	3,
	APP . '/errors.log'
);

```

```

#######################################
#   Refresh
#######################################
https://stackoverflow.com/questions/12383371/refresh-a-page-using-php

#header("Refresh:0");
#header("Refresh:0; url=page2.php");
header('Refresh: 1; url=index.php');
```

```

#######################################
#   enum php 8.1
#######################################

https://wiki.php.net/rfc/annotations_v2
https://wiki.php.net/rfc/enumerations
https://php-annotations.readthedocs.io/en/latest/UsingAnnotations.html
https://wiki.php.net/rfc/enumerations
https://stackoverflow.com/questions/254514/enumerations-on-php
https://stitcher.io/blog/php-enums
https://www.typescriptlang.org/docs/handbook/enums.html
http://tutorials.jenkov.com/java/enums.html
https://www.w3schools.com/java/java_enums.asp
https://kotlinlang.org/docs/enum-classes.html
https://www.baeldung.com/a-guide-to-java-enums
https://php.watch/articles/php-attributes#intro-naming
https://php.watch/articles/php-attributes
https://php.watch/versions/8.0/attributes
https://stitcher.io/blog/attributes-in-php-8
https://www.php.net/releases/8.0/en.php
```
```

#######################################
#   curl php
#######################################

https://www.php.net/manual/en/curl.examples-basic.php
https://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code
https://linuxize.com/post/curl-post-request/
https://stackoverflow.com/questions/8115683/php-curl-custom-headers


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://www.example.com/tester.phtml");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);


$ch = curl_init("http://www.example.com/");
$fp = fopen("example_homepage.txt", "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
if(curl_error($ch)) {
    fwrite($fp, curl_error($ch));
}
curl_close($ch);
fclose($fp);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Apple-Tz: 0',
    'X-Apple-Store-Front: 143444,12'
));
```

```

#######################################
# curl debug
#######################################

https://curl.se/libcurl/c/curl_easy_setopt.html
https://stackoverflow.com/questions/3757071/php-debugging-curl/14436877
https://stackoverflow.com/questions/49658719/curlopt-verbose-not-working

#$fp = fopen(__DIR__ .'/errorlog.txt', 'wb');
$ch = curl_init();
#curl_setopt($ch, CURLOPT_STDERR, $fp);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_VERBOSE, true);

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_STDERR, fopen('php://stderr', 'w'));
curl_setopt($ch, CURLOPT_STDERR, fopen('/curl.txt', 'w+'));

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token,
    'Cache-control: no-cache',
    'Accept: application/json'
));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
if (curl_errno($ch)) {
    print "Error: " . curl_error($ch);
    exit();
}

$info = curl_getinfo($ch);
print "<pre>";
var_dump($info);
print "</pre>";


curl_close($ch);
print_r($server_output);
exit;


curl -vv --fail --silent --show-error --header 'Authorization: bearer xxx' https://example.com/api/status/
curl -v -fsSL http://example.com/

```

```

#######################################
JSON_THROW_ON_ERROR (PHP 7 >= 7.3.0, PHP 8)
#######################################
https://www.php.net/manual/en/class.jsonexception.php

json_decode($test, true, 512, JSON_THROW_ON_ERROR);
```

```

#######################################
Composer datatables
#######################################

https://getcomposer.org/doc/04-schema.md
https://packagist.org/packages/components/jquery#3.5.1
https://packagist.org/packages/datatables/datatables
https://www.frobiovox.com/posts/2016/08/16/basic-hello-world-with-composer-and-php.html
https://datatables.net/manual/installation
https://datatables.net/examples/index
https://datatables.net/examples/advanced_init/length_menu.html
https://datatables.net/examples/styling/display.html
https://datatables.net/examples/styling/stripe.html
https://datatables.net/examples/styling/

composer require components/jquery
composer require datatables/datatables

{
    "require": {
        "components/jquery": "3.5.*"
        "datatables/datatables": "1.10.*"
    }
}


$(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
} );

#wp_enqueue_script("jquery");

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

```

```

#######################################
stdClass2array array2stdClass
#######################################

function convertArrayToObject($array): stdClass
{
    $object = new stdClass();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = convertArrayToObject($value);
        }
        $object->$key = $value;
    }
    return $object;
}


$array = json_decode(json_encode($object), true);
```

```

#######################################
Fastest way to check if a string is JSON in PHP
#######################################

json_decode JSON_ERROR_NONE

https://stackoverflow.com/questions/6041741/fastest-way-to-check-if-a-string-is-json-in-php

```

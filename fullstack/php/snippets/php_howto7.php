<?php

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




#######################################
# remove spaces
#######################################

preg_replace('/\s/','',$str);

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

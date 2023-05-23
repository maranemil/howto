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
#############################################################
str_contains for php7.4
#############################################################

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
#############################################################
getenv
#############################################################

https://www.php.net/manual/de/reserved.variables.environment.php
https://www.php.net/manual/de/function.getenv.php

echo 'My username is ' .$_ENV["REMOTE_ADDR"] . '!';
echo getenv('REMOTE_ADDR');
echo $_SERVER['REMOTE_ADDR'];

#############################################################
Set up a dev environment 
#############################################################

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
#############################################################
async
#############################################################
https://entwickler.de/php/async-php-mit-reactphp
https://stackoverflow.com/questions/14236296/asynchronous-function-call-in-php
~~~

~~~
#############################################################
debug
#############################################################
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
~~~

~~~
#############################################################
DateTime
#############################################################
https://stackoverflow.com/questions/2605446/php-get-future-date-time

$date = new DateTime();
$date->modify("+100 day");
$expire = $date->format("Y-m-d");
echo $expire;
~~~

~~~
#############################################################
read csv string
#############################################################
https://www.php.net/manual/en/function.fgetcsv.php
https://www.php.net/manual/en/function.session-destroy.php
https://www.php.net/manual/en/function.str-getcsv.php
http://phptester.net/

$string = 'PHP,Java,Python,Kotlin,Swift';
$data = str_getcsv($string);
var_dump($data);
~~~

~~~
#############################################################
Cannot create cache directory /.composer/cache/repo/https---repo.packagist.org/, 
or directory is not writable
#############################################################
network wlan not working - restart 
~~~


~~~
##########################################
DEBUG
##########################################

https://www.php.net/manual/de/errorfunc.configuration.php
https://www.php.net/manual/de/function.error-reporting.php
https://stackoverflow.com/questions/15949304/turn-off-display-errors-using-file-php-ini

// Toggle this to change the setting
define('DEBUG', true);

// You want all errors to be triggered
error_reporting(E_ALL);

if(DEBUG == true)
{
    // You're developing, so you want all errors to be shown
    display_errors(true);

    // Logging is usually overkill during development
    log_errors(false);
}
else
{
    // You don't want to display errors on a production environment
    display_errors(false);

    // You definitely want to log any occurring
    log_errors(true);
}

-----

define('DEBUG', true);
error_reporting(E_ALL);
ini_set('display_errors', DEBUG ? 'On' : 'Off');
ini_set('display_startup_errors', DEBUG ? 'On' : 'Off');


~~~




~~~
##########################################
umlaut Ersetzung
##########################################

https://askubuntu.com/questions/1064634/unable-to-install-php-mbstring
https://stackoverflow.com/questions/68545849/trying-to-install-php-mbstring-on-ubuntu-20-04
https://www.php.net/manual/en/function.mb-internal-encoding.php
https://stackoverflow.com/questions/1216274/unable-to-call-the-built-in-mb-internal-encoding-method
https://www.phpkb.com/kb/article/how-to-enable-mbstring-in-php-46.html
https://stackoverflow.com/questions/1973649/php-function-substr-error
https://www.php.net/manual/en/function.substr.php

truncate -s0 /var/log/apache2/error.log
tail/var/log/apache2/error.log

apt-get install php-mbstring

php -m

/* Set internal character encoding to UTF-8 */
mb_internal_encoding("UTF-8");

/* Display current internal character encoding */
echo mb_internal_encoding();

$articleText = mb_substr($articleText,0,500,'UTF-8');
$articleText = substr(utf8_decode($articleText),0,500);
$articleText = utf8_encode( substr(utf8_decode($articleText),0,500) );

$utf8string = "cakeæøå";
echo substr($utf8string,0,5);
// output cake#
echo mb_substr($utf8string,0,5,'UTF-8');
//output cakeæ


https://german.stackexchange.com/questions/26246/g%c3%b6del-but-noether
https://german.stackexchange.com/questions/24000/evolution-of-the-digraph-ae-in-the-german-language-during-the-centuries?lq=1
https://german.stackexchange.com/questions/28976/warum-ersetzt-man-in-manchen-f%C3%A4llen-%C3%A4-durch-ae

So, under special conditions (which are in most cases of technical nature), ö -> oe is allowed. But the other way (oe -> ö) is not. This is never ok. So it is an error to write the name of the poet J. W. Goethe with ö, and it is an error to write the name of Emmy Noether with ö.


ö - oe
ä - ae
ü - ue
ß - ss

##########################################
long german names
##########################################

https://www.iamexpat.de/lifestyle/lifestyle-news/funny-german-last-names-longest-weirdest-and-strangest-surnames
https://www.reddit.com/r/namenerds/comments/8bxtj0/ridiculously_long_names_of_german_nobility/
https://en.wikipedia.org/wiki/Hubert_Blaine_Wolfeschlegelsteinhausenbergerdorff_Sr.
https://www.quora.com/What-is-a-real-example-of-a-very-long-aristocratic-German-name
https://www.familyeducation.com/baby-names/surname/origin/german
https://www.thoughtco.com/german-last-names-1444607
https://www.thelocal.de/20101108/31027

Wolfeschlegelsteinhausenbergerdorff
Ottovordemgentschenfelde
Karl-Theodor zu Guttenberg

Ridiculously long names of German nobility

Karl Theodor Maria Georg Achaz Eberhardt Josef Freiherr von und zu Guttenberg
Ernst Christian Einar Ludvig Detlev, Graf zu Reventlow
Anselm Maria Fürst Fugger von Babenhausen
Prinzessin Friederike Schleswig-Holstein-Sonderburg-Glücksburg
Leopold Karl Walter Graf von Kalkreuth
Alexandra Sophie Cecilie Anna Maria Friederike Benigna Dorothea Prinzessin zu Ysenburg und Büdingen
Friederike Luise Thyra Victoria Margarita Sophia Olga Cecilia Isabella Christa zu Hanover
Friedrich Wilhelm Eugen von Sachsen-Hildburghausen
Alexander Ernst Alfred Hermann Freiherr von Falkenhausen
Hans Christoph Ernst Freiherr von Gagern
Grafin Maria Felicitas von Schönburg-Glauchau

##################################################################
German Last Names
##################################################################

https://www.familyeducation.com/baby-names/surname/origin/german
https://www.thoughtco.com/german-last-names-1444607
https://wordcounter.net/character-count
https://github.com/michal-josef-spacek/Mock-Person-DE
https://gist.github.com/ryx/ce24ca0629d4950a524b1e2588d5809d
https://github.com/PenTestical/german_names/blob/master/2000_german_firstnames.txt
https://github.com/van-himmelheimer/German-Name-Generator
https://github.com/oliverpitsch/craft-data-german/blob/master/craft-data-german-surnames.txt
https://github.com/van-himmelheimer/German-Name-Generator/blob/master/nachnamen_deutsch
https://gist.github.com/elifiner/cc90fdd387449158829515782936a9a4

#################################################
wordcounter
#################################################

https://wordcounter.net/character-count

~~~

~~~
##################################################################
replace non phone chars
##################################################################

https://www.phpliveregex.com/#tab-preg-replace
http://phptester.net/

$str = '+45 (0) 098 234 213 111';
print(preg_replace("[^0-9+-/\s()]", "",$str));

+45 (0) 098 234 213 111
+45-(0) 098-234-213-111

##################################################################
replace non chars
##################################################################

preg_replace("#[^a-zA-Z0-9-äöüßÜÄÖ().:@/\-\s+]#iu", "", $value);
~~~

~~~
################################################
count chars
################################################

<?php

https://www.php.net/manual/de/function.strlen.php

$str = '
<p>test1<br/>
<p>test12222<br/>
';

$lines = array_filter(preg_split('/\r\n|[\r\n]/',$str));
$lines = array_map('strip_tags', (array)$lines);
#print_r($lines);
foreach ($lines as $line){
    echo strlen($line) . ' ' .$line.PHP_EOL;
    $arlen[] = strlen($line);
    #break;
}

asort($arlen);
print_r($arlen);
~~~

~~~
################################################
explode textarea php
################################################

https://stackoverflow.com/questions/7058168/explode-textarea-php-at-new-lines
https://www.php.net/manual/en/function.preg-split.php

preg_split('/\r\n|[\r\n]/', $_POST['thetextarea'])
explode("\r\n", $_POST['thetextarea']);
~~~

~~~


#################################################
php-libplot.
#################################################

https://github.com/vivesweb/graph-php
https://github.com/vivesweb/php-libplot


##################################################################################################
Warning: Module "pdo_mysql" is already loaded in Unknown on line 0
##################################################################################################
https://stackoverflow.com/questions/32764981/php-warning-module-already-loaded-in-unknown-on-line-0

/usr/local/bin/php --info | grep configure
php -i | grep pdo_mysql
php --ini
ls /usr/local/etc/php/conf.d/docker-php-ext-mysqli.ini
nano /usr/local/etc/php/conf.d/docker-php-ext-mysqli.ini
nano /usr/local/etc/php/conf.d/docker-php-ext-pdo_mysql.ini
Comment line out ;extension=mysqli.so
php --ini







##################################################################################################
Display Array as a Table
##################################################################################################
https://stackoverflow.com/questions/14047296/display-array-as-a-table
https://inkplant.com/code/array-to-table



function  show_array_as_table($array,$key_color='blue',$value_color="black",$fontfamily="arial",$fontsize="12pt") {

    foreach($array as $key => $value) {
        if (is_array($value)) {
    echo "<tr>";
    echo "<td title=\"{$key}\" style='width:150pt; height:25pt; text-align:right; vertical-align:top; background-color:cccccc; color:{$key_color}'><b>{$key}</b></td>";
        show_array_as_table($value,$key_color,$value_color,$fontfamily,$fontsize);
    echo "</tr>";
        } else {
    echo "<td style='width:300pt; height:25pt; text-align:justify; vertical-align:top; color:{$value_color}'>";
        echo "<i>{$value}</i>";
    echo "</td>";
        }
    }
}

echo "<table class='table'>";
echo show_array_as_table($reader);
echo "</table>";

##################################################################################################
How to find average from array in php
##################################################################################################
https://stackoverflow.com/questions/33461430/how-to-find-average-from-array-in-php

echo array_sum($a) / count(array_filter($a));

$a = array_filter($a);
if(count($a)) {
    echo $average = array_sum($a)/count($a);
~~~
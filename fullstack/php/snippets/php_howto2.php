<?php

############################################################
#
#   strip properties of an object that are null?
#   https://stackoverflow.com/questions/4352203/any-php-function-that-will-strip-properties-of-an-object-that-are-null
#   https://www.tutorialrepublic.com/faq/how-to-remove-empty-values-from-an-array-in-php.php
#
############################################################

// --------------
// Strips any false-y values
$object = (object) array_filter((array) $object);
// Strips only null values
$object = (object) array_filter((array) $object, function ($val) {
    return !is_null($val);
});

// --------------
$someObject = (array) $someObject;
array_walk_recursive($someObject, function ($v, $k) use (&$someObject) {
    if ($someObject[$k] == null) {
        unset($someObject[$k]);
    }
});

$someObject = (object) $someObject;
var_dump($someObject);

// --------------
// Setup
$obj = (object) array('foo' => null, 'bar' => 'baz');
// equivalent to array_filter
array_walk($obj, function ($v, $k) use ($obj) {
    if (empty($v)) {
        unset($obj->$k);
    }

});
// output
print_r($obj);

// --------------
// filter
$array = array("apple", "", 2, null, -5, "orange", 10, false, "");
var_dump($array);
echo "<br>";

// Filtering the array
$result = array_filter($array);
var_dump($result);

############################################################
#
#    An API with repeating parameters
#    Multiple Query Parameters of Same Name
#    Serializing an Array as a Sequence of Elements
#
############################################################

/*
https://stackoverflow.com/questions/24872088/php-soapclient-multiple-arguments-with-the-same-name
https://stackoverflow.com/questions/37765861/send-data-to-soap-api-involving-repeated-elements-of-same-name
https://www.sitepoint.com/community/t/an-api-with-repeating-parameters/32601/4
https://community.servicenow.com/community?id=community_question&sys_id=0a2347e1dbd8dbc01dcaf3231f96196c
https://community.servicenow.com/community?id=community_question&sys_id=bae98729db5cdbc01dcaf3231f9619e5
https://futurestud.io/tutorials/retrofit-multiple-query-parameters-of-same-name
https://community.smartbear.com/t5/SoapUI-Pro/Res-duplicate-properties-in-REST-request/td-p/39318
https://docs.microsoft.com/en-us/dotnet/standard/serialization/controlling-xml-serialization-using-attributes
https://framework.zend.com/apidoc/2.0/classes/Zend.Soap.Wsdl.html
http://php.net/manual/en/soapclient.soapcall.php
http://php.net/manual/en/soapvar.soapvar.php
https://github.com/GoteoFoundation/goteo-legacy/blob/master/library/pear/SOAP/Client.php
http://php.net/manual/de/soapclient.soapclient.php
http://be2.php.net/manual/en/class.soapfault.php
https://github.com/zendframework/zend-soap/issues/37
https://framework.zend.com/manual/1.12/de/zend.soap.client.html
https://stackoverflow.com/questions/15559056/content-type-application-soapxml-charset-utf-8-was-not-supported-by-service/25302867
https://github.com/artisaninweb/laravel-soap/issues/108
http://php.net/manual/de/function.stream-context-create.php
https://stackoverflow.com/questions/9909232/php-soapclient-stream-context-option
http://www.king-foo.com/2011/09/using-complex-types-with-zendsoap/
https://framework.zend.com/manual/2.3/en/modules/zend.soap.wsdl.html
https://framework.zend.com/manual/2.1/en/modules/zend.validator.identical.html
https://stackoverflow.com/questions/29941570/zend-soap-change-the-default-array-element-name-item-to-class-name-of-complex
https://zendframework.github.io/zend-soap/wsdl/
https://stackoverflow.com/questions/3617398/soapclient-how-to-pass-multiple-elements-with-same-name
https://beberlei.de/2014/01/31/soap_and_php_in_2014.html
---------
 */

/*
public class Group{
[XmlArrayItem(Type = typeof(Employee)),
XmlArrayItem(Type = typeof(Manager))]
public Employee[] Employees;
}
public class Employee{
public string Name;
}
public class Manager:Employee{
public int Level;
}

public class Group{
[XmlElement]
public Employee[] Employees;
}*/

// ------------
/*
$this->soapWrapper->add('bsedemo', function ($service) {
$service
->wsdl('http://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc?singleWsdl')
->trace(true)
->header('Content-type','application/soap+xml; charset=utf-8');

});
 */
// ------------

$a = [
    'properties' => [
        [
            'name' => 'invtype',
            'value' => 'foo',
        ],
        [
            'name' => 'item_number',
            'value' => 'foo',
        ],
    ],
];

// ------------

$ITEMSITM = new stdClass();
foreach ($parsItem as $item) {
    $ITEMSITM->TITEMSITM[] = $item;
}

$wsdl = 'https://your.api/path?wsdl';
$client = new SoapClient($wsdl);
$multipleSearchValues = [1, 2, 3, 4];
$queryData = ['yourFieldName' => $multipleSearchValues];
$results = $client->YourApiMethod($queryData);
print_r($results);

// -----

class Book
{
    /** @var string */
    public $title;
    /** @var string */
    public $author;
    /** @var Tag[] */
    public $tags;
}
class Tag
{
    /** @var string */
    public $tag;
}

// ------
$array = ['lets', 'test', 'it'];
$response = new stdClass();
$response->results = $array;

$array = ['lets', 'test', 'it'];
$response = new stdClass();
$response->results = new ArrayObject();
foreach ($array as $item) {
    $response->results->append($item);
}

$array = ['lets', 'test', 'it'];
$response = new stdClass();
$response->results = new ArrayObject();
foreach ($array as $item) {
    $soapVar = new SoapVar($item, XSD_STRING, null, null, 'result');
    $response->results->append($soapVar);
}

// -----

$wsdl = 'https://your.api/path?wsdl';
$client = new SoapClient($wsdl);
$multipleSearchValues = [1, 2, 3, 4];
$queryData = ['yourFieldName' => $multipleSearchValues];
$results = $client->YourApiMethod($queryData);
print_r($results);

$obj = new StdClass();
foreach ($telnums as $telnum) {
    $obj->telnums[] = $telnum;
}

$options = array(
    'createDomainRequest' => array(
        'telnums' => array(
            '10',
            '20',
            '30',
        ),
    ),
);

$soapClient = new SoapClient($wsdl);
$soapClient->__call('createDomain', array(
    new SoapParam('10', 'telnums'),
    new SoapParam('20', 'telnums'),
    new SoapParam('30', 'telnums'),
));

// ---------------

$client = new SOAPClient($wsdl, array(
    'classmap' => array(
        'Person' => 'DHL\Intraship\Person',
        // all the other types
    ),
));

##########################################################
#
#   How to get(extract) a file extension in PHP?
#
#   https://stackoverflow.com/questions/173868/how-to-getextract-a-file-extension-in-php
#   https://stackoverflow.com/questions/173868/how-to-getextract-a-file-extension-in-php
#   https://paulund.co.uk/get-the-file-extension-in-php
#   http://php.net/manual/de/function.pathinfo.php
#   http://php.net/manual/de/function.basename.php
#
#########################################################

/*
$ext = pathinfo($filename, PATHINFO_EXTENSION);
#
$path_info = pathinfo('/foo/bar/baz.bill');
echo $path_info['extension']; // "bill"
#
pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION)
#
$info = new SplFileInfo('test.png');
var_dump($info->getExtension());
#
array_pop(explode('.',$fname))
substr($path, strrpos($path, '.') + 1);
#
$ext = substr($filename,strrpos($filename,'.',-1),strlen($filename));
#
$file = 'folder/directory/file.html';
$ext = pathinfo($file);

echo $ext['dirname'] . '<br/>';   // Returns folder/directory
echo $ext['basename'] . '<br/>';  // Returns file.html
echo $ext['extension'] . '<br/>'; // Returns .html
echo $ext['filename'] . '<br/>';  // Returns file
 */

#------------------------------------
# PHP Regex groups captures
#------------------------------------
$pattern = "/([\w|\d])+/";
$string = "[abc - 123 - def - 456 - ghi - 789 - jkl]";
preg_match_all($pattern, $string, $matches);
print_r($matches[0]);

#------------------------------------
# Regex Special Character Definitions
#------------------------------------
/*
http://php.net/manual/de/function.preg-replace.php
http://www.rexegg.com/regex-capture.html
http://www.rexegg.com/regex-php.html
https://lzone.de/examples/PHP%20preg_replace
https://regexone.com/references/php
 */

/*

The following should be escaped if you are trying to match that character

\ ^ . $ | ( ) [ ]
 * + ? { } ,

Special Character Definitions
\ Quote the next metacharacter
^ Match the beginning of the line
. Match any character (except newline)
$ Match the end of the line (or before newline at the end)
| Alternation
() Grouping
[] Character class
 * Match 0 or more times
+ Match 1 or more times
? Match 1 or 0 times
{n} Match exactly n times
{n,} Match at least n times
{n,m} Match at least n but not more than m times
More Special Character Stuff
\t tab (HT, TAB)
\n newline (LF, NL)
\r return (CR)
\f form feed (FF)
\a alarm (bell) (BEL)
\e escape (think troff) (ESC)
\033 octal char (think of a PDP-11)
\x1B hex char
\c[ control char
\l lowercase next char (think vi)
\u uppercase next char (think vi)
\L lowercase till \E (think vi)
\U uppercase till \E (think vi)
\E end case modification (think vi)
\Q quote (disable) pattern metacharacters till \E
Even More Special Characters
\w Match a "word" character (alphanumeric plus "_")
\W Match a non-word character
\s Match a whitespace character
\S Match a non-whitespace character
\d Match a digit character
\D Match a non-digit character
\b Match a word boundary
\B Match a non-(word boundary)
\A Match only at beginning of string
\Z Match only at end of string, or before newline at the end
\z Match only at end of string
\G Match only where previous m//g left off (works only with /g)

 */

##########################################################
#
#   Generate Range 0-100 A-Z
#
##########################################################
/*
http://php.net/manual/de/function.range.php
http://php.net/manual/de/function.array-reverse.php
http://php.net/manual/de/function.date.php
 */

print_r(array_reverse(range(1, 12)));
# output 12,11,10,9,8,7,6,5,4,3,2,1

print_r(range(12, 1));
# output 12,11,10,9,8,7,6,5,4,3,2,1

print_r(range(12, 1, -3));
# output 12 9 6 3 1

print_r(range(11, 20, -3));
# output 11 14 17 20

$a = array_map(function ($n) {return sprintf('sample_%03d', $n);}, range(1, 12));
print_r($a);

/*Array
(
[0] => sample_050
[1] => sample_051
[2] => sample_052
...
)*/

var_dump(range('1', '2')); // outputs  array(2) { [0]=> int(1) [1]=> int(2) }
var_dump(array_map('strval', range('1', '2'))); // outputs  array(2) { [0]=> string(1) "1" [1]=> string(1) "2" }

# fill an array to get a hash with 0-9 numerical values
range(0, 9);
array_fill(0, 10, '');

$SimpleArray = array_map(function ($n) {return null;}, range(1, 3));
$MultiArray = array_map(function ($n) {return array_map(function ($n) {return null;}, range(1, 2));}, range(1, 3));

var_dump($SimpleArray);
var_dump($MultiArray);

#########################################################################################
#
#   How to force file download with PHP
#
#   http://php.net/manual/de/function.ob-start.php
#   http://php.net/manual/de/function.readfile.php
#   https://stackoverflow.com/questions/7263923/how-to-force-file-download-with-php
#   https://www.media-division.com/the-right-way-to-handle-file-downloads-in-php/
#   https://www.ostraining.com/blog/coding/download-php/
#   https://drupal.stackexchange.com/questions/163628/extra-space-at-beginning-of-downloaded-image
#   https://github.com/projectsend/projectsend/issues/173
#   https://perishablepress.com/http-headers-file-downloads/
#   https://davidwalsh.name/php-force-download
#   http://php.net/manual/en/function.header.php
#
#########################################################################################

# Handling large file sizes

set_time_limit(0);
$file = @fopen($file_path, "rb");
while (!feof($file)) {
    print(@fread($file, 1024 * 8));
    ob_flush();
    flush();
}

//------------------------

// File to download.
$file = '/path/to/file';

// Maximum size of chunks (in bytes).
$maxRead = 1 * 1024 * 1024; // 1MB

// Give a nice name to your download.
$fileName = 'download_file.txt';

// Open a file in read mode.
$fh = fopen($file, 'r');

// These headers will force download on browser,
// and set the custom file name for the download, respectively.
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

// Run this until we have read the whole file.
// feof (eof means "end of file") returns `true` when the handler
// has reached the end of file.
while (!feof($fh)) {
    // Read and output the next chunk.
    echo fread($fh, $maxRead);

    // Flush the output buffer to free memory.
    ob_flush();
}

// Exit to make sure not to output anything else.
exit;

// ------------------------

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $filename);
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));
readfile($path);
exit;

// ------------------------

// ...extra code to populate $path and $filename

ob_clean();
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $filename);
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));
readfile($path);
exit;

// ------------------------

// We'll be outputting a PDF
header('Content-Type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');

// The PDF source is in original.pdf
readfile('original.pdf');

// ------------------------

header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($fn)) . ' GMT', true, 200);
header('Content-Length: ' . filesize($fn));
header('Content-Type: image/png');
print file_get_contents($fn);

#######################################################
#
#   Get Opt Params Terminal
#   http://php.net/manual/de/function.getopt.php
#
#######################################################

// Script example.php
$shortopts = "";
$shortopts .= "f:"; // Required value
$shortopts .= "v::"; // Optional value
$shortopts .= "abc"; // These options do not accept values

$longopts = array(
    "required:", // Required value
    "optional::", // Optional value
    "option", // No value
    "opt", // No value
);
$options = getopt($shortopts, $longopts);
var_dump($options);

// shell> php example.php -f "value for f" -v -a --required value --optional="optional value" --option

// Script example.php
$optind = null;
$opts = getopt('a:b:', [], $optind);
$pos_args = array_slice($argv, $optind);
var_dump($pos_args);
// shell> php example.php -a 1 -b 2 -- test

#
$shortopts = "";
$shortopts .= "c:"; // Required value
$shortopts .= "h::"; // Optional value
$shortopts .= "v::"; // Optional value
$shortopts .= "d::"; // Optional value

$longopts = array(
    "config:", // Required value
    "help::", // Optional value
    "verbose::", // Optional value
    "debug::", // Optional value
);
$argTerminal = getopt($shortopts, $longopts);

#######################################################
#
# Colors in php CLI
#
#######################################################

/*
http://blog.lenss.nl/2012/05/adding-colors-to-php-cli-script-output/
https://www.if-not-true-then-false.com/2010/php-class-for-coloring-php-command-line-cli-scripts-output-php-output-colorizing-using-bash-shell-colors/
http://tldp.org/LDP/abs/html/colorizing.html
 */

/*
echo -n "          "
echo -e '\E[37;44m'"\033[1mContact List\033[0m"                 # White on blue background
echo -e "\033[1mChoose one of the following persons:\033[0m"    # Bold
echo -en '\E[47;34m'"\033[1mE\033[0m"                           # Blue
echo "vans, Roland"                                             # "[E]vans, Roland"
echo -en '\E[47;35m'"\033[1mJ\033[0m"                           # Magenta
echo -en '\E[47;32m'"\033[1mS\033[0m"                           # Green
echo -en '\E[47;31m'"\033[1mZ\033[0m"                           # Red
 */

/*
Black 0;30
Blue 0;34
Green 0;32
Cyan 0;36
Red 0;31
Purple 0;35
Brown 0;33
Light Gray 0;37
Dark Gray 1;30
Light Blue 1;34
Light Green 1;32
Light Cyan 1;36
Light Red 1;31
Light Purple 1;35
Yellow 1;33
White 1;37
 */
/*
$this->fg_colors['black'] = '0;30';
$this->fg_colors['dark_gray'] = '1;30';
$this->fg_colors['blue'] = '0;34';
$this->fg_colors['light_blue'] = '1;34';
$this->fg_colors['green'] = '0;32';
$this->fg_colors['light_green'] = '1;32';
$this->fg_colors['cyan'] = '0;36';
$this->fg_colors['light_cyan'] = '1;36';
$this->fg_colors['red'] = '0;31';
$this->fg_colors['light_red'] = '1;31';
$this->fg_colors['purple'] = '0;35';
$this->fg_colors['light_purple'] = '1;35';
$this->fg_colors['brown'] = '0;33';
$this->fg_colors['yellow'] = '1;33';
$this->fg_colors['light_gray'] = '0;37';
$this->fg_colors['white'] = '1;37';

$this->bg_color['black'] = '40';
$this->bg_color['red'] = '41';
$this->bg_color['green'] = '42';
$this->bg_color['yellow'] = '43';
$this->bg_color['blue'] = '44';
$this->bg_color['magenta'] = '45';
$this->bg_color['cyan'] = '46';
$this->bg_color['light_gray'] = '47';
 */
// PHP

echo "\033[31m some colored text \033[0m some white text \n"; #
echo "\033[32m some colored text \033[0m some white text \n"; #
print "Using Conf:  \033[1m \033[32m OK \033[0m" . PHP_EOL; # bold + green

#--------------------------------------------------
# combine JPG's into one PDF with PHP
#--------------------------------------------------

$images = array("file1.jpg", "file2.jpg");
$pdf = new Imagick($images);
$pdf->setImageFormat('pdf');
$pdf->writeImages('combined.pdf', true);

#--------------------------------------------------
# test string length by char encoding
#--------------------------------------------------

$str = 'Hello I am a very very very very long search string';
echo $str . "\n\n<hr>";
echo base64_encode(gzcompress($str, 9)) . "\n\n<hr>";
echo bin2hex(gzcompress($str, 9)) . "\n\n<hr>";
echo urlencode(gzcompress($str, 9)) . "\n\n<hr>";

$input = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

// percent-encoding on plain text [string(454)]
var_dump(urlencode($input));
echo "<hr>";

// deflated input [string(352)]
$output = rtrim(strtr(base64_encode(gzdeflate($input, 9)), '+/', '-_'), '=');
var_dump($output);
echo "<hr>";

// decode
#$output2 = gzinflate(base64_decode(strtr($output, '-_', '+/')));
#var_dump($output2);
#echo "<hr>";

// urlencode base64_encode gzcompress [string(372)]
$out = urlencode(base64_encode(gzcompress($input)));
var_dump($out);
echo "<hr>";

########################################################################
#
#   Class 'Net_SSH2' not found in… when using phpseclib FIX
#   https://stackoverflow.com/questions/30300391/class-net-ssh2-not-found-in-when-using-phpseclib/30306921
#   https://github.com/phpseclib/docs
#   http://php.net/manual/de/function.get-include-path.php
#   https://github.com/phpseclib/phpseclib/blob/master/phpseclib/Net/SSH2.php
#
########################################################################

/*On github.com there are two branches (in addition to the master branch) - 1.0 and 2.0. 2.0 is namespaced so to call that you'd need to do \phpseclib\Net\SSH2.

If you downloaded the zip file from phpseclib.sourceforge.net then you're running the 1.0 branch. If that's what you're running you'll need to update the include path. eg.
 */

set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
require 'phpseclib/Net/SSH2.php';
$ssh = new \Net_SSH2('localhost');

/*If you're running the 2.0 branch (or master branch) you'll need to use an auto loader. Example:*/

// https://raw.githubusercontent.com/composer/composer/master/src/Composer/Autoload/ClassLoader.php

ini_set('error_reporting', E_ALL); // E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

#include('autoloader.php');
include 'vendor/autoload.php';

$loader = new \Composer\Autoload\ClassLoader();
$loader->addPsr4('phpseclib\\', __DIR__ . '/phpseclib');
$loader->register();

use \phpseclib\Crypt\RSA;
$rsa = new RSA();

$ssh = new \phpseclib\Net\SSH2('www.domain.tld');
if (!$ssh->login('username', 'password')) {
    exit('Login Failed');
}
echo $ssh->exec('pwd');
echo $ssh->exec('ls -la');

########################################################################
#
#   Text CLI TErminal Colors PHP
#
########################################################################

/*
 * 30m grey
 * 31m red
 * 32m green
 * 33m yellow
 * 34m blue
 * 35m magenta
 * 36m blue azure
 * 37m white
 */

########################################################################
#
#   Make a Zip
#
########################################################################

# http://php.net/manual/de/ziparchive.addfile.php

$zip = new ZipArchive;
if ($zip->open('test.zip') === true) {
    $zip->addFile('/pfad/zur/datei.txt', 'neuername.txt');
    $zip->close();
    echo 'ok';
} else {
    echo 'Fehler';
}

########################################################################
#
# Download Headers that actually work
# https://perishablepress.com/http-headers-file-downloads/
#
########################################################################

// http headers for zip downloads
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($filepath . $filename));
ob_end_flush();
@readfile($filepath . $filename);

########################################################################
#
#   Import CSV to Array
#   http://www.php.net/manual/de/function.str-getcsv.php
#
########################################################################

$csv = array_map('str_getcsv', file('data.csv'));

$csv = array_map('str_getcsv', file($file));
array_walk($csv, function (&$a) use ($csv) {
    $a = array_combine($csv[0], $a);
});
array_shift($csv); # remove column header

############################################################
#
#    Split String or Array in group of 3
#
############################################################
/*
http://php.net/manual/de/function.array-chunk.php
http://php.net/manual/de/function.str-split.php
 */
// array
$input_array = array('a', 'b', 'c', 'd', 'e');
print_r(array_chunk($input_array, 3));

// string
$origionalvar = "0123456789";
$variable = str_split($origionalvar, 3);

########################################################################
#
# Read Excel
# http://www.osakac.ac.jp/labs/koeda/tmp/phpexcel/Documentation/API/PHPExcel/PHPExcel_IOFactory.html
# https://github.com/PHPOffice/PHPExcel/issues/1331
# https://github.com/PHPOffice/PHPExcel/issues/1076
# https://hotexamples.com/examples/-/PHPExcel_IOFactory/-/php-phpexcel_iofactory-class-examples.html
#
########################################################################

/** PHPExcel_IOFactory */
/*
require_once '../Classes/PHPExcel/IOFactory.php';
$objPHPExcel = \PHPExcel_IOFactory::load("excel_files/temp_files.xlsx"));
$objWorksheet = $objPHPExcel->getActiveSheet();
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = \PHPExcel_Cell::columnIndexFromString($objWorksheet->getHighestColumn());

for ($row = 3; $row <= $highestRow; ++$row) {
for($col = 0; $col <= $highestColumn; ++$col) {
$cellValue = $objWorksheet->getCellByColumnAndRow($col, $row) ;
}
}*/

// $filetype = PHPExcel_IOFactory::identify($dirpath . '/' . $filename);
// PHPExcel_Settings::setZipClass(PHPExcel_Settings::ZIPARCHIVE);

########################################################################
#
#   Importing data to HIVE HDFS  Presto - SymfonyLive London 2017 - Michael Cullum - Hadoop Symfony & PHP
#   https://www.youtube.com/watch?v=V7WuJ4bQnC0
#
########################################################################

/*
while read filename; do
echo $filename
hadoop fs -put /path/$filename /tmp/
echo "LOAD DATA INPATH '/tmp/$filename'
INTO TABLE temp_csv;

INSERT INTO TABLE temp_orc
SELECT * FROM temp_csv;

TRUNCATE TABLE temp_csv;" | hive
done
 */

/*

/opt/presto/bin/presto-cli --server hadoop.localhost:8080 --catalog hive --chema curr_dns
SELECT max(rtt) from curr_dns where pool=0
 */

/*
$socket = new \SamKnows\Presto\Client\RemoteHost('http','cordinator.localhost','8080')
$conn = new \SamKnows\Presto\Client\HttpConnection($socket, new NullLogger()....)
 */

################################################
#
#   SSH PHP Libs
#
################################################

/*

http://php.net/manual/de/function.ssh2-exec.php
http://php.net/manual/de/function.ssh2-connect.php
http://php.net/manual/en/book.ssh2.php

http://prdownloads.sourceforge.net/phpshell/phpshell-2.4.zip?download
https://kvz.io/blog/2007/07/24/make-ssh-connections-with-php/
http://phpshell.sourceforge.net/
https://www.phpclasses.org/package/2477-PHP-SSH-client-implementation-in-pure-PHP.html

https://github.com/roke22/PHP-SSH2-Web-Client
https://github.com/nickola/web-console

https://github.com/rkitover/net-ssh2
https://metacpan.org/pod/Net::SSH2
http://phpseclib.sourceforge.net/
http://phpseclib.sourceforge.net/ssh/examples.html

 */

################################################
#
#   No 'Access-Control-Allow-Origin' header is present on the requested resource. ﻿ ​
#
################################################

/*
https://www.moxio.com/blog/12/how-to-make-a-cross-domain-request-in-javascript-using-cors
https://developer.mozilla.org/en-US/docs/Web/HTTP/Server-Side_Access_Control
https://developer.tizen.org/dev-guide/2.4/org.tizen.tutorials/html/web/w3c/security/cors_tutorial_w.htm

<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

 */

header('Access-Control-Allow-Origin: *');

/*

PHP

//Set Access-Control-Allow-Origin with PHP
header('Access-Control-Allow-Origin: http://site-a.com', false);

//Set Access-Control-Allow-Origin with PHP
header('Access-Control-Allow-Origin: http://site-a.com', false);

header('Access-Control-Allow-Origin: http://admin.example.com');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

// Raw header
Access-Control-Allow-Origin: *
// How to send the response header with PHP
header("Access-Control-Allow-Origin: *");
// How to send the response header with Apache (.htaccess)
Header set Access-Control-Allow-Origin "*"
// How to send the response header with Nginx
add_header 'Access-Control-Allow-Origin' '*';
// How to send the response header with Express.js
app.use(function(req, res, next) {
res.header("Access-Control-Allow-Origin", "*");
next();
});

# htaccess
<FilesMatch "\.(ttf|otf|eot|woff|woff2)$">
<IfModule mod_headers.c>
Header set Access-Control-Allow-Origin "http://example.com"
</IfModule>
</FilesMatch>

 */

################################################################
# Finding the Union, Intersection, or Difference of Two Arrays
################################################################

/*
http://phptester.net/
https://www.techrepublic.com/article/17-useful-functions-for-manipulating-arrays-in-php/
https://www.oreilly.com/library/view/php-cookbook/1565926811/ch04s24.html
http://php.net/manual/de/function.array-intersect.php
 */

$aRed = array(5, 14, 19, 72, 77, 86);

$arU = array(
    "1" => array(5, 14, 19, 72, 77, 86),
    "2" => array(19, 14, 5),
    "3" => array(21, 33, 44),
);

foreach ($arU as $key => $item) {
    //print_r(count(array_diff_assoc($item,$aRed)));
    print_r(array_diff_assoc($item, $aRed));
    echo "<br>";
}
echo "<hr>";
foreach ($arU as $key => $item) {
    //print_r(count(array_diff_assoc($item,$aRed)));
    print_r(array_diff($item, $aRed));
    echo "<br>";
}
echo "<hr>";
foreach ($arU as $key => $item) {
    //print_r(count(array_diff_assoc($item,$aRed)));
    print_r(array_intersect($item, $aRed));
    echo "<br>";

    if (count(array_intersect($item, $aRed)) != count($aRed)) {
        echo "not identical";
        echo "<br>";
    }

}
echo "<hr>";

/*
Array ( )
Array ( [0] => 19 [2] => 5 )
Array ( [0] => 21 [1] => 33 [2] => 44 )

Array ( )
Array ( )
Array ( [0] => 21 [1] => 33 [2] => 44 )

Array ( [0] => 5 [1] => 14 [2] => 19 [3] => 72 [4] => 77 [5] => 86 )
Array ( [0] => 19 [1] => 14 [2] => 5 )  not identical
Array ( )  not identical
 */

#############################################################
#
#   GET Week Number
#
#############################################################

$date = new DateTime("2012-10-18");
echo $date->format("W");
echo "<br>";
echo date('W', strtotime("2012-10-18"));

########################################################
#
# Exploding new lines in PHP
#
# http://php.net/manual/de/function.preg-split.php
# https://tudorbarbu.ninja/exploding-new-lines-in-php/
# http://devs.fantastech.co/explode-line-breaks-php/
# http://phptester.net/
#
########################################################

$content = "AAAAAAA
BBBBBBB
CCCCCCC";
$content = "AAAAAAA, BBBBBBB, CCCCCCC";
$content = "AAAAAAA; BBBBBBB; CCCCCCC";

#$lines = array_map("rtrim", explode("\n", $content));
$lines = preg_split("~[/\n/,;]~", $content);

#$lines = preg_split( '/\r\n|\r|\n/', $content );
#$lines = string = preg_split("/\R/", $content);
print_r($lines);

/*Array ( [0] => AAAAAAA [1] => BBBBBBB [2] => CCCCCCC )*/

#####################################################
#
#    PHP - Get key name of array value
#
#    key — Fetch a key from an array
#     http://php.net/manual/en/function.array-search.php
#     http://uk.php.net/manual/en/function.key.php
#
#####################################################

$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');
$key = array_search('green', $array); // $key = 2;
$key = array_search('red', $array); // $key = 1;

$arr = array('first' => 'a', 'second' => 'b');
$key = array_search('a', $arr);

# key($arr);
$array = array(
    'fruit1' => 'apple',
    'fruit2' => 'orange',
    'fruit3' => 'grape',
    'fruit4' => 'apple',
    'fruit5' => 'apple');

// this cycle echoes all associative array
// key where value equals "apple"
while ($fruit_name = current($array)) {
    if ($fruit_name == 'apple') {
        echo key($array) . '<br />';
    }
    next($array);
}

#####################################################
#
#    parse_ini_file — Parse a configuration file
#
#    http://php.net/manual/en/function.parse-ini-file.php
#    http://php.net/manual/en/function.file.php
#    http://php.net/manual/en/function.split.php
#
#####################################################

/*
http://php.net/manual/de/function.split.php (REMOVED in PHP 7.0.0.)
http://php.net/manual/de/function.parse-ini-file.php
http://php.net/manual/de/function.preg-split.php
http://php.net/manual/de/function.explode.php
http://php.net/manual/de/function.str-split.php
https://www.reddit.com/r/PHP/comments/18dgn3/why_are_hash_comments_deprecated/
http://php.net/manual/de/function.parse-ini-file.php (DOES NOT SUPPORT #)
 */

// Parse without sections
$ini_array = parse_ini_file("sample.ini");
print_r($ini_array);

// if file with hashes
$ini_array = explode("\n", file_get_contents('filename'));
foreach ($ini_array as $value) {
    if (preg_match('~host~', $value)) {
        $arTmp = explode("=", $value);
        print_r($arTmp);
    }
    if (preg_match('~user~', $value)) {
        $arTmp = explode("=", $value);
        print_r($arTmp);
    }
}

##########################################################
#
#    Klassen und Objekte
#    http://php.net/manual/de/language.oop5.php
#    http://php.net/manual/en/language.oop5.basic.php
#
##########################################################

/*
class Classy {

const       STAT = 'S' ; // no dollar sign for constants (they are always static)
static     $stat = 'Static' ;
public     $publ = 'Public' ;
private    $priv = 'Private' ;
protected  $prot = 'Protected' ;

function __construct( ){  }

public function showMe( ){
print '<br> self::STAT: '  .  self::STAT ; // refer to a (static) constant like this
print '<br> self::$stat: ' . self::$stat ; // static variable
print '<br>$this->stat: '  . $this->stat ; // legal, but not what you might think: empty result
print '<br>$this->publ: '  . $this->publ ; // refer to an object variable like this
print '<br>' ;
}
}
$me = new Classy( ) ;
$me->showMe( ) ;*/

##########################################################
#
#    Verwendung von instanceof mit ererbten Klassen
#    Checks if the object is of this class or has this class as one of its parents
#    http://php.net/manual/de/internals2.opcodes.instanceof.php
#    http://php.net/manual/de/language.operators.type.php
#    http://php.net/manual/de/function.is-a.php
#
##########################################################

/*
class WidgetFactory {   var $oink = 'moo'; }
$WF = new WidgetFactory();

if (is_a($WF, 'WidgetFactory')) {
echo "yes, \$WF is still a WidgetFactory\n";
}
if ($WF instanceof WidgetFactory) {
echo 'Yes, $WF is a WidgetFactory';
}*/

##########################################################
#
#  shell_exec
#
##########################################################
/*
http://php.net/manual/en/function.exec.php
http://php.net/manual/en/function.shell-exec.php
 */

$output = shell_exec('ls -lart');
echo "<pre>$output</pre>";

echo exec('whoami');

###############################################
#
#    Find pathnames matching a pattern
#     http://php.net/manual/en/function.glob.php
#
###############################################

// get files array
foreach (glob("*.txt") as $filename) {
    echo "$filename size " . filesize($filename) . "\n";
}

// get dir array
$dirs = glob('*', GLOB_ONLYDIR);
foreach ($dirs as $dir) {
    // do something
}

###############################################
#
#     Exception references
#
###############################################

/*
https://www.alainschlesser.com/structuring-php-exceptions/
http://php.net/manual/de/exception.getcode.php
https://stackify.com/php-try-catch-php-exception-tutorial/
http://php.net/manual/de/language.exceptions.php
https://www.codediesel.com/php/handling-multiple-exceptions-in-php-7-1/
 */

try {
    throw new Exception("Some error message", 30);
} catch (Exception $e) {
    echo "The exception code is: " . $e->getCode();
}

try {
    // run your code here
} catch (exception $e) {
    //code to handle the exception
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
} finally {
    //optional code that always runs
}

class DivideByZeroException extends Exception
{};
class DivideByNegativeException extends Exception
{};

function process_divide($denominator)
{
    try
    {
        if ($denominator == 0) {
            throw new DivideByZeroException();
        } else if ($denominator < 0) {
            throw new DivideByNegativeException();
        } else {
            echo 100 / $denominator;
        }
    } catch (DivideByZeroException $ex) {
        echo "Divide by zero exception!";
    } catch (DivideByNegativeException $ex) {
        echo "Divide by negative number exception!";
    } catch (Exception $x) {
        echo "UNKNOWN EXCEPTION!";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 16.03.16
 * Time: 11:36
 */

// GET PATH ---------------------------------------------
// basename(__FILE__); // Get File name
// dirname($_SERVER["SCRIPT_FILENAME"]); // Get Dir name
// print_r(pathinfo($_SERVER["SCRIPT_FILENAME"])); // dirname / basename


////////////////////////////////////////////////////////////////
///
/// Print Columns with same distance in terminal
///
////////////////////////////////////////////////////////////////

for($i=0;$i<5;$i++){
   echo "ABC | ";
   echo "".sprintf("%20s",rand(10,6080000080));
   //echo "".sprintf("%20f",rand(10,6080000080)); // for float  00.00
   echo " | BNM".PHP_EOL;
}

// result
// http://sandbox.onlinephpfunctions.com/
// http://phptester.net/
/*
ABC |           2276710444 | BNM
ABC |           4028640142 | BNM
ABC |           3719530466 | BNM
ABC |           5929822460 | BNM
ABC |            493854404 | BNM
*/




// add files to zip
http://php.net/manual/de/ziparchive.addfile.php

$z = new ZipArchive();
if(true === ($z->open('./foo.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE))){
    $z->setArchiveComment('Interesting!');
    $z->addFromString('domain.txt', 'wuxiancheng.cn');
    $folder = './test';
    !is_dir($folder) && mkdir($folder); // Create an folder for testing
    if(true === $z->addFile($folder)){
        echo 'success'; // !!!
    }
    rmdir($folder);
    $z->close();
    // foo.zip will NOT be saved on disk.
    // If foo.zip already exists before we run this script, the file will remain unchanged.
}



if (!class_exists('ZipArchive')) {
    //$myclass = new MyClass();
    die("Installation cannot continue! <br/> Please check if server has ZipArchive installed! ");
}

// # READ ZIP FILES AND DO A LIST
$za = new ZipArchive();
$za->open($unzip_dir);
for( $i = 0; $i < $za->numFiles; $i++ ){
    $stat = $za->statIndex( $i );
    //print "<pre>";
    //print_r( basename( $stat['name'] ) . PHP_EOL );
    if(!preg_match('/svn|post_execute|post_uninstall|pre_execute|pre_uninstall|manifest.php/',$stat['name'])){
        $arZipData[]  = $stat['name'];
    }
    //print "</pre>";
}





# ---------------------------------------------------
# php - Remove not alphanumeric characters from string
# ---------------------------------------------------

utf8_encode(preg_replace('/[^a-z äöüß]/i', '', utf8_decode($str)));
$str=str_replace(array('ä','ö','ü','ß','Ä','Ö','Ü'),array('ae','oe','ue','ss','Ae','Oe','Ue'),$str);

$letters=utf8_encode($_GET['letters']);
$letters=utf8_decode(preg_replace("/[^a-zA-Z-äöüÄÜÖß\/]/i","",$letters));




//-------------------------------------
// php lazy session
//-------------------------------------

# https://why-cant-we-have-nice-things.mwl.be/requests/introduce-session-start-options-read-only-unsafe-lock-lazy-write-and-lazy-destroy

var_export($_SESSION);
var_export($_COOKIE);
var_export($_REQUEST);
var_export($_SERVER);

#session_destroy();
if(!session_start()){
   // send info SERVER
}

//session_start(array('lazy_write'=>true, 'lazy_destroy'=>120, 'unsafe_lock'=>false));

ini_set('session.use_trans_sid',TRUE);
ini_set('session.use_cookies',FALSE);
ini_set('session.use_only_cookies',FALSE);
ini_set('session.use_strict_mode',FALSE);
ini_set('session.save_path', '/usr/tmp/');

session_id('TESTID'.mt_rand(1, 10));
session_start(['lazy_write'=>$_GET['lazy_write'], 'unsafe_lock'=>$_GET['unsafe_lock']]);

if (!isset($session['x'])) {
   $_SESSION['x'] = str_repeat('x', 1024*10);
}

echo session_id();
var_dump(session_module_feature());

usleep(20000);

/*
$ ab -c 50 -n 20000 'http://localhost:1080/session.php?lazy_write=1&unsafe_lock=1'
This is ApacheBench, Version 2.3 <$Revision: 1430300 $>
$ ab -c 50 -n 20000 'http://localhost:1080/session.php?lazy_write=0&unsafe_lock=0'
*/







// PHP --- check if dir exits ---------------------------

if (!is_dir($dir)) {
   mkdir($dir);
}

if (!file_exists($dir) && !is_dir($dir)) {
   mkdir($dir);
}




// PHP --- cli mode---------------------------
// check if php in cli mode - terminal

if (php_sapi_name() == "cli") {
   // In cli-mode
} else {
   // Not in cli-mode
}















// PHP --- crc mode---------------------------
// check crc32

$data = "0A312C288256B000";

function crc($data){

   $i = 0;
   $crc = 0;

   $crc_table = array
   (
      0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50a5, 0x60c6, 0x70e7,
      0x8108, 0x9129, 0xa14a, 0xb16b, 0xc18c, 0xd1ad, 0xe1ce, 0xf1ef
   );

   $data = hex2bin($data);
   $l = 0;
   while($l < strlen($data)){

      $byte = $data[$l];
      $i = (($crc >> 12) ^ (ord($byte) >> 4));
      $crc = ($crc_table[$i & 0x0F] ^ ($crc << 4));
      $i = (($crc >> 12) ^ ord($byte));
      $crc = ($crc_table[$i & 0x0F] ^ ($crc << 4));
      $l++;

   }

   return ($crc & 0xFFFF);
}


echo crc($data);

# https://stackoverflow.com/questions/1834541/crc-4-implementation-in-c-sharp
# https://stackoverflow.com/questions/38084462/translate-crc-alrgorythm-from-c-to-php

# http://php.net/manual/de/function.hash-file.php
# http://php.net/manual/de/function.crc32.php
# http://php.net/manual/en/function.hash-file.php

echo hash("crc32", __FILE__).PHP_EOL;
echo hash("crc32b", __FILE__).PHP_EOL;
hash_file('crc32', __FILE__).PHP_EOL;





#################################################
#
# PHP Sorting find duplicates
#
#################################################

http://php.net/manual/de/function.min.php
http://php.net/manual/de/function.asort.php
http://php.net/manual/de/function.array-multisort.php
http://php.net/manual/de/function.json-encode.php

print_r(array_count_values($array)); # find duplicates



https://www.codepunker.com/blog/3-solutions-for-multidimensional-array-sorting-by-child-keys-or-values-in-PHP
https://paulund.co.uk/sort-multi-dimensional-array-value
https://blog.jachim.be/2009/09/php-msort-multidimensional-array-sort/comment-page-1/
http://php.net/manual/en/function.sprintf.php

#################################################
#
# PHP Formating
#
#################################################


printf("[%s]\n",      $s); // standard string output
printf("[%10s]\n",    $s); // right-justification with spaces
printf("[%-10s]\n",   $s); // left-justification with spaces
printf("[%010s]\n",   $s); // zero-padding works on strings too
printf("[%'#10s]\n",  $s); // use the custom padding character '#'
printf("[%10.10s]\n", $t); // left-justification but with a cutoff of 10 characters

#################################################
#
# PHP Encode Decode to array
#
#################################################

$strJson = json_encode($arTmp); // encode json
file_put_contents('somefile.json',$strJson); // write array into json file
$strTmpJson = (array) json_decode(file_get_contents('somefile.json'), true); // json file into array
echo sprintf("%20s","somevar : ") .$somerow["key"]. "\n";
file_put_contents($file, $person, FILE_APPEND | LOCK_EX); // append str into file


/*
$filename = "update_np_prices";
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$filename}.csv");
header("Pragma: no-cache");
header("Expires: 0");
outputCSV($arTmp);


function outputCSV($data) {
   $outputBuffer = fopen("php://output", 'w');
   foreach($data as $val) {
      fputcsv($outputBuffer, $val);
   }
   fclose($outputBuffer);
}*/


#################################################
#
# PHP Sum
#
#################################################

Sum values in foreach loop php [closed]

$sum = 0;
foreach($group as $key=>$value)
{
   $sum+= $value;
}
echo $sum;

#################################################
#
# xml2array
#
#################################################

$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

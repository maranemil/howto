<?php

##################################################################
# importer_darknet.php
##################################################################

# phpinfo(); // Get Info

# SQL conn
$mysqli = new mysqli("localhost", "blabla", "blabla", "statistics");
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}

die();

$sql = "TRUNCATE reference_darknet";
$mysqli->query($sql);

$pipelineSRCID = 8000; //
$dirRootPath = $pipelineSRCID."/";
$files = array_diff(scandir($dirRootPath), array('..', '.'));
foreach($files as $file ){
    if(preg_match('~darknet.txt~',$file)){
        $arFileMatch[] = $file;
    }
}

foreach($arFileMatch as $fileMatch){
    $strFile = file_get_contents($dirRootPath."".$fileMatch);
    #$arrInfo = explode("\n",$strFile);
    #$arrInfo = preg_split("~[/\n/,;]~", $strFile);
    $arrInfo = preg_split("~[\n]~", $strFile);
    array_pop($arrInfo); // remove last element
    array_shift($arrInfo); // remove first element
    #print_r($arrInfo);
    foreach($arrInfo as $line){
        $prepareData = explode(":",$line);
        $strFilenameOrg = str_replace(".darknet.txt","",$fileMatch);
        $sql = "INSERT reference_darknet VALUES('".$strFilenameOrg."','".$prepareData[0]."','".intval($prepareData[1])."','".$pipelineSRCID."')";
        $mysqli->query($sql);
    }

}

##################################################################
# importer_exif.php
##################################################################

die();

$sql = "TRUNCATE reference_exif";
$mysqli->query($sql);

$pipelineSRCID = 8000; //
$dirRootPath = $pipelineSRCID."/";
$files = array_diff(scandir($dirRootPath), array('..', '.'));
foreach($files as $file ){
    if(preg_match('~exif.txt~',$file)){
        $arFileMatch[] = $file;
    }
}
foreach($arFileMatch as $fileMatch){
    $strFile = file_get_contents($dirRootPath."".$fileMatch);
    #$arrInfo = explode("\n",$strFile);
    #$arrInfo = preg_split("~[/\n/,;]~", $strFile);
    #print_r($strFile);
    $arrInfo = preg_split("~[\n]~", $strFile);
    array_pop($arrInfo); // remove last element
    array_shift($arrInfo); // remove first element

    $strFilenameOrg = str_replace("_exif.txt","",$fileMatch);
    foreach($arrInfo as $line){
        $prepareData = explode("=",$line);
        if(preg_match('/~Software|Model|Make|ImageDescription|GPSInfo|GPSLatitude|GPSLatitudeRef|GPSLongitude|GPSLongitudeRef~/',$prepareData[0])){
            $prepareData[0] = str_replace("exif:","", $prepareData[0]);
            $sql = "INSERT reference_exif VALUES('".$strFilenameOrg."','".$prepareData[0]."','".$prepareData[1]."','".$pipelineSRCID."')";
            echo $sql;
            $mysqli->query($sql);
        }
    }
}

##################################################################
# importer_tf.php
##################################################################

$sql = "TRUNCATE reference_tensorflow";
$mysqli->query($sql);

$pipelineSRCID = 8000; //
$dirRootPath = $pipelineSRCID."/";
$files = array_diff(scandir($dirRootPath), array('..', '.'));
foreach($files as $file ){
    if(preg_match('~.jpg.txt~',$file)){
        $arFileMatch[] = $file;
    }
}

foreach($arFileMatch as $fileMatch){
    $strFile = file_get_contents($dirRootPath.$fileMatch);
    #$arrInfo = explode("\n",$strFile);
    #$arrInfo = preg_split("~[/\n/,;]~", $strFile);
    $arrInfo = preg_split("~[\n]~", $strFile);
    array_pop($arrInfo); // remove last element
    array_shift($arrInfo); // remove first element
    $strFilenameOrg = str_replace(".txt","",$fileMatch);
    foreach($arrInfo as $line){
        $prepareData = explode("(score =",$line);
        $arkeys = explode(",",$prepareData[0]);
        $prepareData[1] = str_replace(")","",$prepareData[1]);
        foreach($arkeys as $arkey){
            $sql = "INSERT reference_tensorflow VALUES('".$strFilenameOrg."','".$arkey."','".$prepareData[1]."','".$pipelineSRCID."')";
            echo $sql;
            $mysqli->query($sql);
        }
    }
}
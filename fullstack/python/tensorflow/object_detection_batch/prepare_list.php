<?php

##############################################################
#
# prepare batch files PHP
#
##############################################################

$intPipeline = $argv[1];
if(empty($intPipeline)){
    die("No Pipeline defined!");
}
$dirRootPath = '2019-04-16/'.$intPipeline.'/';
$remoteBatchPath = '/media/emil/Data/Batch/';

// read level_1
$arrPipelineItems = array_diff(scandir($dirRootPath), array('..', '.'));
#print_r($arrPipelineItems);
foreach($arrPipelineItems as $dPipelineItems){
    $arrPipelineItemsTmp[] =  $dirRootPath.$dPipelineItems;
}
#print_r($arrPipelineItemsTmp);

// read level_2
foreach ($arrPipelineItemsTmp as $dPipelineItemsTmp) {
    // foreaech dir read subdir
    $arrPipelineItemsIBNTmp = array_diff(scandir($dPipelineItemsTmp), array('..', '.'));
    foreach ($arrPipelineItemsIBNTmp as $dPipelineItemsIBNTmp) {
   	 if(strlen($dPipelineItemsIBNTmp) == 8 && is_dir($dPipelineItemsTmp."/".$dPipelineItemsIBNTmp)  ){
   		 #echo $dPipelineItemsTmp."/".$dPipelineItemsIBNTmp.PHP_EOL;
   			 $arrPipelineItemsIBN[] = $dPipelineItemsTmp."/".$dPipelineItemsIBNTmp;
   	 }
    }
}
#print_r($arrPipelineItemsIBN);

// read img jpg
foreach ($arrPipelineItemsIBN as $dirIBNImgs) {
    $dirIBNImgsList = array_diff(scandir($dirIBNImgs), array('..', '.'));
    #print_r($dirIBNImgsList);
    foreach ($dirIBNImgsList as $strIBNImgsList) {
   	 if(preg_match('~.jpg~', $strIBNImgsList)){
   		 #echo $dirIBNImgs."/".$strIBNImgsList.PHP_EOL;
   		 $arrScanImg[] = $dirIBNImgs."/".$strIBNImgsList;
   	 }
    }
    #die();
}

print(count($arrScanImg)).PHP_EOL;
#print_r(min($arrScanImg)).PHP_EOL;
print_r(exec('ls -la '.$remoteBatchPath.''.min($arrScanImg))).PHP_EOL;
echo PHP_EOL;
file_put_contents("prepare_list.json",json_encode($arrScanImg));

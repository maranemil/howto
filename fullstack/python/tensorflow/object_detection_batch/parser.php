<?php

##############################################################
#
#   parser.php PHP
#
##############################################################

if(empty($argv[1])){
    die("no bacth file defined!");
}
else{
    $jsonFile = $argv[1];
}

if(empty($argv[2])){
    die("no pipeline defined!");
}
else{
    $intPipeline = $argv[2];
}

$dirRootPath = '2019-04-16/'.$intPipeline.'/';
$remoteBatchPath = '/media/emil/Data/Batch/';

$jsonRead = json_encode(file_get_contents($jsonFile));
$arrScanImgImp = (array) json_decode($jsonRead,true);

$convertTmp = explode(",",substr($arrScanImgImp[0],2,-2));
foreach ( $convertTmp as $convertLine) {
    $arrScanImg[]  = stripslashes(stripslashes($convertLine));
}

if(!is_dir('/home/emil/Git/models/tutorials/image/imagenet/'.$intPipeline.'/')){
    mkdir('/home/emil/Git/models/tutorials/image/imagenet/'.$intPipeline.'/');
}

$start = time();
foreach ($arrScanImg as $strcanImg) {
    $strcanImg = str_replace('"', '',$strcanImg);

    // tensoflow
    $cmd = 'cd /home/emil/Git/models/tutorials/image/imagenet/ && ';
    $cmd.= 'python3 classify_image.py --image_file='.$remoteBatchPath.$strcanImg.' --model_dir . --num_top_predictions 10 ';
    $cmd.= ' > /home/emil/Git/models/tutorials/image/imagenet/'.$intPipeline.'/'.basename($strcanImg).'.txt';
    #echo $cmd.PHP_EOL;
    exec($cmd);

    // mogrify -resize 100 *.jpg
    $cmd2 = 'convert '.$strcanImg.' -resize 150 ';
    $cmd2.= '/home/emil/Git/models/tutorials/image/imagenet/'.$intPipeline.'/'.basename($strcanImg);
    exec($cmd2);

    // darkinet yolo2
    if(file_exists('/home/emil/Git/models/tutorials/image/imagenet/'.$intPipeline.'/'.basename($strcanImg).'.darknet.txt')){
		echo "----------------------".PHP_EOL;
		echo "SKIPPED!".PHP_EOL;
		echo "----------------------".PHP_EOL;
	}
	else{
        $cmd3 = 'cd /home/emil/Git/darknet/ && ';
        $cmd3.= './darknet detect cfg/yolov2.cfg yolov2.weights '.$remoteBatchPath.$strcanImg.' ';
        $cmd3.= ' > /home/emil/Git/models/tutorials/image/imagenet/'.$intPipeline.'/'.basename($strcanImg).'.darknet.txt';
        #echo $cmd3.PHP_EOL;
        exec($cmd3);
    }
    #break;
}

$end = time();
echo PHP_EOL;
echo "start:".date("Y-m-d H:i:s",$start).PHP_EOL;
echo "end:".date("Y-m-d H:i:s",$end).PHP_EOL;
<?php


#print_r($argv);

/*
# check
find . -type f -print -quit -name "*jpg" | xargs identify | cut  -c  1-25,31-40 | xargs echo
# convert
find . -type f  -name "*jpg" | xargs identify | xargs -l  php ./myscript.php
*/


$sGeometry = explode("x",$argv[3]);
$sOrgImg = $argv[1];
$sOrgImgRs = $sOrgImg."2.jpg";
$picSize = $argv[3];

if($sGeometry[0] > $sGeometry[1]){
	$picType = "L"; // lanscape
}
elseif($sGeometry[0] == 200){
	//do nothing
	print "skip".PHP_EOL;
}
else{
	print "--------$argv[1]------$argv[3]-----------".PHP_EOL;
	$picType = "P"; // portrait
	$cmd = "convert {$sOrgImg} -resize 200x -quality 95  {$sOrgImgRs}";
	print $cmd.PHP_EOL;
 	exec($cmd);
 	$cmd = "mv {$sOrgImgRs} {$sOrgImg}";
 	exec($cmd);
}
usleep(rand(130000,180000));


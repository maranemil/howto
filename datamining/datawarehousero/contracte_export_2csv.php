<?php

// https://www.w3schools.com/php/func_mysqli_fetch_array.asp

$file  = "export_for_mongodb_".date("YmdHis").".csv";
$fp = fopen($file,"a");

$mysqli = new mysqli("localhost", "root", "root", "datagovro");
$result = $mysqli->query("SELECT * FROM contracte");
$counter = 0;
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	#print_r($row);
	 $strCSV = "";
	 $countMaxRow = count($row);
	 $countLoop = 0;
	foreach($row as $key => $value){
		$countLoop++;
		if($value=="") {
			$value = "0";
		}
		if( $countLoop < $countMaxRow ){
			$strCSV .= $value."|";
		}
		else {
			$strCSV .= $value;
		}
	}
	#$strCSV.="0";
	#file_put_contents($file, $strCSV, FILE_APPEND | LOCK_EX);
	fwrite($fp,$strCSV."\n");
	$counter++;

	/*if($counter==10){
		die();
	}*/

}


// check count
/*
$file = file("export_for_mongodb_20180831014748.csv");
echo count($file);
*/
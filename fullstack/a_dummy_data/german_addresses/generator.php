<?php

// read adresses
$file = file("csv/Apotheken_Entfernung_Address.csv");
$max = count($file)-1;
// echo "max:".$max.PHP_EOL;

// read names
$file_names = file("csv/names.csv");
$max_names = count($file)-1;

foreach(range(1,$max) as $index ){

    // get address
    $arr_line = explode(",",$file[$index]);
    $street = substr(preg_replace("/\d+/i", "", $arr_line[0]),0,-1);
    $house_number = preg_replace("/\D+/i", "", $arr_line[0]);
    $zip = $arr_line[1];
    $city = $arr_line[2];

    // get random name
    $arr_name = explode(",",$file_names[random_int(1,$max_names)]);

    /*$arr_addresses[] = [
        "street"=>$street,
        "house_number"=>$house_number,
        "zip"=>str_pad($zip, 5, "0", STR_PAD_LEFT),
        "city"=>$city,
    ];*/

    $arr_addresses[] = [
        "first_name" => trim($arr_name[0]),
        "last_name" => trim($arr_name[1]),
        "phone"=> "0711".random_int(1000000,9999999),
        "email"=> strtolower($arr_name[0]).'_'.bin2hex(random_bytes(5))."@example.de",
        "street"=>$street,
        "house_number"=>$house_number,
        "zip"=>str_pad($zip, 5, "0", STR_PAD_LEFT),
        "city"=>$city,
    ];


    // print_r($arr_addresses);
    // exit;

}
// generate json file
file_put_contents("address_person.json", json_encode($arr_addresses, JSON_PRETTY_PRINT) );



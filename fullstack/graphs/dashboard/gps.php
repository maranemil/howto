<?php
 function toDecimal($deg, $min, $sec, $ref) {
    $float = function($v) {
        return (count($v = explode('/', $v)) > 1) ? $v[0] / $v[1] : $v[0];
    };
    $d = $float($deg) + (($float($min) / 60) + ($float($sec) / 3600));
    return ($ref == 'S' || $ref == 'W') ? $d *= -1 : $d;
}
$mysqli = new mysqli("localhost", "blabla", "blabla", "dom_statistics");
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT filename FROM `reference_exif` WHERE source=1000 GROUP BY filename";
$statement = $mysqli->prepare($sql);
$statement->execute();
$result = $statement->get_result();
//Alternativ  fetch_assoc():
while($row = $result->fetch_assoc()) {
  $arFilesUnique[] = $row['filename'];
}

foreach($arFilesUnique as $uFile){
    $sql = "SELECT
    (SELECT prediction_value FROM `reference_exif` WHERE filename = '".$uFile."' AND prediction_key IN('GPSLatitude') ) as GPSLatitude,
    (SELECT prediction_value FROM `reference_exif` WHERE filename = '".$uFile."' AND prediction_key IN('GPSLatitudeRef') ) as GPSLatitudeRef,
    (SELECT prediction_value FROM `reference_exif` WHERE filename = '".$uFile."' AND prediction_key IN('GPSLongitude') ) as GPSLongitude,
    (SELECT prediction_value FROM `reference_exif` WHERE filename = '".$uFile."' AND prediction_key IN('GPSLongitudeRef') ) as GPSLongitudeRef";
    $statement = $mysqli->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    //Alternativ  fetch_assoc():
    while($row = $result->fetch_assoc()) {

        if(empty($row['GPSLatitude'])){
            continue;
        }

        $exif['GPSLatitude'] = explode(",", $row['GPSLatitude']);
      	$exif['GPSLongitude'] = explode(",", $row['GPSLongitude']);
       	$exif['GPSLatitudeRef']=$row['GPSLatitudeRef'];
       	$exif['GPSLongitudeRef']=$row['GPSLongitudeRef'];

        $latitude  =sprintf('%.6f', toDecimal($exif['GPSLatitude'][0], $exif['GPSLatitude'][1], $exif['GPSLatitude'][2], $exif['GPSLatitudeRef']));
        $longitude = sprintf('%.6f', toDecimal($exif['GPSLongitude'][0], $exif['GPSLongitude'][1], $exif['GPSLongitude'][2], $exif['GPSLongitudeRef']));

        if($latitude != -1){
            $arGPSUnique[$uFile] = array(
                'GPSLatitude' => $row['GPSLatitude'],
                'GPSLatitudeRef' => $row['GPSLatitudeRef'],
                'GPSLongitude' => $row['GPSLongitude'],
                'GPSLongitudeRef' => $row['GPSLongitudeRef'],
                'latitude' => $latitude,
                'longitude' => $longitude,
            );
        }
    }
}
foreach($arGPSUnique as $uGPSUnique){
    $sql = " INSERT INTO exif_gps VALUES(NULL, '".$uGPSUnique['latitude']."', '".$uGPSUnique['longitude']."' ) ";
    $mysqli->query($sql);
}

// https://www.php-einfach.de/mysql-tutorial/crashkurs-mysqli/
// https://www.peterkropff.de/site/php/mysqli_methoden_result.htm
?>
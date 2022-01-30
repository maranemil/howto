<?php /** @noinspection PhpRedundantOptionalArgumentInspection */
/** @noinspection JsonEncodingApiUsageInspection */
/** @noinspection PhpParamsInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */


// ----v1
// https://stackoverflow.com/questions/31885031/formatting-json-to-geojson-via-php


$data = array(); //setting up an empty PHP array for the data to go into
$db =mysqli_connect();
$query ="";
if ($result = mysqli_query($db, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
$features = array();
foreach ($original_data as $key => $value) {
    $features[] = array(
        'type' => 'Feature',
        'properties' => array('time' => $value['time']),
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $value['latitude'],
                $value['longitude'],
                1
            ),
        ),
    );
}
$new_data = array(
    'type' => 'FeatureCollection',
    'features' => $features,
);

$final_data = json_encode($new_data, JSON_PRETTY_PRINT);
print_r($final_data);


// ----v2
// https://gist.github.com/wboykinm/5730504
/**
 * PHP GeoJSON Constructor, adpated from https://github.com/bmcbride/PHP-Database-GeoJSON
 */
# Connect to MySQL database
$conn = new PDO('mysql:host=localhost;dbname=mydatabase', 'myusername', 'mypassword');
# However the User's Query will be passed to the DB:
$sql = 'SELECT * from GDA_database WHERE user_query = whatever';
# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}
# Build GeoJSON feature collection array
$geojson = array(
    'type' => 'FeatureCollection',
    'features' => array()
);
# Loop through rows to build feature arrays
$dbquery ="";
while ($row = mysqli_fetch_assoc($dbquery)) {
    $feature = array(
        'id' => $row['partnership_id'],
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            # Pass Longitude and Latitude Columns here
            'coordinates' => array($row['longitude'], $row['latitude'])
        ),
        # Pass other attribute columns here
        'properties' => array(
            'name' => $row['Name'],
            'description' => $row['Description'],
            'sector' => $row['Sector'],
            'country' => $row['Country'],
            'status' => $row['Status'],
            'start_date' => $row['Start Date'],
            'end_date' => $row['End Date'],
            'total_invest' => $row['Total Lifetime Investment'],
            'usg_invest' => $row['USG Investment'],
            'non_usg_invest' => $row['Non-USG Investment']
        )
    );
    # Add feature arrays to feature collection array
    $geojson['features'][] = $feature;
}
header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);
$conn = NULL;


// https://hotexamples.com/examples/-/GeoJSON/-/php-geojson-class-examples.html
// https://www.experts-exchange.com/questions/28304926/Create-geoJSON-from-MySQL-with-PHP.html
/** @var TYPE_NAME $feature */
$geojson = array(
    'type' => 'FeatureCollection',
    'features' => $feature
);
while ($row = mysqli_fetch_assoc($dbquery)) {
    $feature = array(
        'type' => 'Feature',
        'properties' => array(
            'score' => $row['score'],
            'fid' => $row['fid']
            //Other fields here, end without a comma
        ),
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array((float)$row['longitude'], (float)$row['latitude'])
        )
    );
    array_push($geojson, $feature);
};
$connection ="";
mysqli_close($connection);
// // Return routing result
header("Content-Type:application/json", true);
echo json_encode($geojson);

// http://www.postgresonline.com/journal/archives/267-Creating-GeoJSON-Feature-Collections-with-JSON-and-PostGIS-functions.html




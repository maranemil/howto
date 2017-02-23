<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 11.01.17
 * Time: 22:31
 */

$data = array();
$data[] = array("outlook" => "sunny", "Temperature" => "85", "Humidity" => "85", "Windy" => "false", "play" => "Don't Play");
$data[] = array("outlook" => "sunny", "Temperature" => "80", "Humidity" => "90", "Windy" => "true", "play" => "Don't Play");
$data[] = array("overcast" => "sunny", "Temperature" => "85", "Humidity" => "85", "Windy" => "false", "play" => "Don't Play");
$data[] = array("outlook" => "sunny", "Temperature" => "83", "Humidity" => "78", "Windy" => "false", "play" => "Play");
$data[] = array("outlook" => "rain", "Temperature" => "70", "Humidity" => "96", "Windy" => "false", "play" => "Play");
$data[] = array("outlook" => "rain", "Temperature" => "68", "Humidity" => "80", "Windy" => "false", "play" => "Play");
$data[] = array("outlook" => "rain", "Temperature" => "65", "Humidity" => "70", "Windy" => "true", "play" => "Don't Play");
$data[] = array("outlook" => "overcast", "Temperature" => "64", "Humidity" => "65", "Windy" => "true", "play" => "Play");
$data[] = array("outlook" => "sunny", "Temperature" => "72", "Humidity" => "95", "Windy" => "false", "play" => "Don't Play");
$data[] = array("outlook" => "sunny", "Temperature" => "69", "Humidity" => "70", "Windy" => "false", "play" => "Play");
$data[] = array("outlook" => "rain", "Temperature" => "75", "Humidity" => "80", "Windy" => "false", "play" => "Play");
$data[] = array("outlook" => "sunny", "Temperature" => "75", "Humidity" => "70", "Windy" => "true", "play" => "Play");
$data[] = array("outlook" => "overcast", "Temperature" => "72", "Humidity" => "90", "Windy" => "true", "play" => "Play");
$data[] = array("outlook" => "overcast", "Temperature" => "81", "Humidity" => "75", "Windy" => "false", "play" => "Play");
$data[] = array("outlook" => "rain", "Temperature" => "71", "Humidity" => "80", "Windy" => "true", "play" => "Don't Play");



/*

------- Play Tennis Example -------

Outlook Temperature Humidity Windy PlayTennis
Sunny Hot High False No
Sunny Hot High True No
Overcast Hot High False Yes
Rainy Mild High False Yes
Rainy Cool Normal False Yes
Rainy Cool Normal True No
Overcast Cool Normal True Yes
Sunny Mild High False No
Sunny Cool Normal False Yes
Rainy Mild Normal False Yes
Sunny Mild Normal True Yes
Overcast Mild High True Yes
Overcast Hot Normal False Yes
Rainy Mild High True No



------- Training Data Factors Affecting Golf -------


Outlook	Temperature	Humidity	Windy	Play (positive) / Don't Play (negative)
sunny	85	85	false	Don't Play
sunny	80	90	true	Don't Play
overcast	83	78	false	Play
rain	70	96	false	Play
rain	68	80	false	Play
rain	65	70	true	Don't Play
overcast	64	65	true	Play
sunny	72	95	false	Don't Play
sunny	69	70	false	Play
rain	75	80	false	Play
sunny	75	70	true	Play
overcast	72	90	true	Play
overcast	81	75	false	Play
rain	71	80	true	Don't Play



------- Factors Affecting Sunburn -------

Name	Hair	Height	Weight	Lotion	Result
Sarah	blonde	average	light	no	sunburned (positive)
Dana	blonde	tall	average	yes	none (negative)
Alex	brown	short	average	yes	none
Annie	blonde	short	average	no	sunburned
Emily	red	average	heavy	no	sunburned
Pete	brown	tall	heavy	no	none
John	brown	average	heavy	no	none
Katie	blonde	short	light	yes	none


*/
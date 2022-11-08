<?php
# http://phptester.net/
$lnks = '

https://www.youtube.com/watch?v=GNUSdekIaMw



';

$lines = preg_split("~\n~", $lnks);

foreach ($lines as $line){
	if(trim($line)){

		echo "<a href='$line' target='_blank'>".$line . "</a><br>";
	}
}
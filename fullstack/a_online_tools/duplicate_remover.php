<?php

# http://phptester.net/

$str = "
aaa
bbb
ccc
ccc
";

$arr = array_unique(array_filter(preg_split("/(\r\n|\n|\r)/", $str)));

foreach ($arr as $line){
	echo $line."<br>";
}

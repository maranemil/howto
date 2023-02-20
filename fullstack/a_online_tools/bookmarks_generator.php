<?php
# http://phptester.net/
$lnks = '
https://www.youtube.com/watch?v=GNUSdekIaMw
https://www.youtube.com/watch?v=GNUSdekIaMw
';

$lines = array_unique(preg_split("~\n~", $lnks));

echo '<!DOCTYPE NETSCAPE-Bookmark-file-1>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <TITLE>Bookmarks</TITLE>
    <H1>Bookmarks</H1>
    <DL><p>';

foreach ($lines as $line){
	if(trim($line)){

		echo "<DT><a href='$line' target='_blank'>".$line . "</a>";
	}
}


echo "</DL><p>";
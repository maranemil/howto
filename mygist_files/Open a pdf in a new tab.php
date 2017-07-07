<?php

//////////////////////////////////////////
//
// Open a pdf in a new tab
//
//////////////////////////////////////////

// http://stackoverflow.com/questions/12730581/use-this-php-code-to-open-a-pdf-in-a-new-tab

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

@readfile($file);
exit();
<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 23.11.15
 * Time: 16:40
 */

#############################################
##
## AlineaSol WF serialized object and compare
##
#############################################


// http://phptester.net/
// get arrays
$str1 = unserialize('a:4:{s:9:"processes";a:1:{i:0;a:1... ..sol_activf613ol_task_idb";s:36:"a8e094f3-08dd-b3be-46ac-5652d3e3d995";}}}}}');
$str2 = unserialize('a:4:{s:9:"processes";a:1:{i:0;a:1... ..sol_activf613ol_task_idb";s:36:"a8e094f3-08dd-b3be-46ac-5852d3e3d995";}}}}}');
print "<pre>"; print_r($str2);

// test diff
// https://www.diffchecker.com/diff
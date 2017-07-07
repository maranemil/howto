<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 16.03.16
 * Time: 11:36
 */

// GET PATH ---------------------------------------------
// basename(__FILE__); // Get File name
// dirname($_SERVER["SCRIPT_FILENAME"]); // Get Dir name
// print_r(pathinfo($_SERVER["SCRIPT_FILENAME"])); // dirname / basename


////////////////////////////////////////////////////////////////
///
/// Print Columns with same distance in terminal
///
////////////////////////////////////////////////////////////////

for($i=0;$i<5;$i++){
   echo "ABC | ";
   echo "".sprintf("%20s",rand(10,6080000080));
   //echo "".sprintf("%20f",rand(10,6080000080)); // for float  00.00
   echo " | BNM".PHP_EOL;
}

// result
// http://sandbox.onlinephpfunctions.com/
// http://phptester.net/
/*
ABC |           2276710444 | BNM
ABC |           4028640142 | BNM
ABC |           3719530466 | BNM
ABC |           5929822460 | BNM
ABC |            493854404 | BNM
*/
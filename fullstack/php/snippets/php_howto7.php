<?php

#######################################################
#
#   Filters
#
#######################################################

// echo "<pre>";
// http://phptester.net/

// https://www.php.net/manual/en/function.filter-var.php
// https://www.php.net/manual/en/filter.filters.validate.php
// https://www.php.net/manual/en/filter.filters.sanitize.php
// https://www.w3schools.com/php/filter_sanitize_number_int.asp
// https://www.php.net/manual/en/function.strip-tags.php

/*

var_dump(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var($string, FILTER_VALIDATE_INT));
var_dump(filter_var($string, FILTER_SANITIZE_STRING));
var_dump(filter_var($string, FILTER_VALIDATE_BOOLEAN));
var_dump(filter_var($string, FILTER_VALIDATE_DOMAIN));
var_dump(filter_var($string, FILTER_VALIDATE_URL));
var_dump(filter_var($string, FILTER_VALIDATE_EMAIL));
var_dump(filter_var($string, FILTER_VALIDATE_IP));

var_dump(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
var_dump(filter_var($string, FILTER_SANITIZE_STRING));
var_dump(filter_var($string, FILTER_SANITIZE_ADD_SLASHES));
var_dump(filter_var($string, FILTER_SANITIZE_STRING));
var_dump(filter_var($string, FILTER_SANITIZE_URL));
var_dump(filter_var($string, FILTER_SANITIZE_EMAIL));


*/

/*
Classic sort
https://christoph-rumpel.com/2020/8/refactoring-php
https://www.php.net/manual/en/function.array-filter.php
*/

$users = [
    [ 'id' => 801, 'name' => 'Peter', 'score' => 505, 'active' => true],
    [ 'id' => 844, 'name' => 'Mary', 'score' => 704, 'active' => true],
    [ 'id' => 542, 'name' => 'Norman', 'score' => 104, 'active' => false],
];

// Requested Result: only active users, sorted by score ["Mary(704)","Peter(505)"]
$users = array_filter($users, fn ($user) => $user['active']);
usort($users, fn($a, $b) => $a['score'] < $b['score']);
$userHighScoreTitles = array_map(fn($user) => $user['name'] . '(' . $user['score'] . ')', $users);
return $userHighScoreTitles;


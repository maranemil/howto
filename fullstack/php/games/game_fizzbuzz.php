<?php

function testNumber($number)
{
    if (is_numeric($number) && $number > 0) {
        if ($number % 3 === 0 && $number % 5 === 0) {
            echo "FizzBuzz GameOver" . PHP_EOL;
        } else if ($number % 3 === 0) {
            echo "Fizz" . PHP_EOL;
            requestNumber();
        } else if ($number % 5 === 0) {
            echo "Buzz" . PHP_EOL;
            requestNumber();
        } else {
            requestNumber();
        }
    } else {
        requestNumber();
    }
}

function requestNumber()
{
    $number = readline('Enter a number: ');
    testNumber($number);
}

requestNumber();


/*

Simulate fizzbuzz

foreach(range(1, 30) as $number) {
    if( $number%3 === 0 && $number%5 == 0){
		echo "Fizzbuzz".PHP_EOL;
	}
	else if($number%3 === 0 ){
		echo "Fizz".PHP_EOL;
	}
	else if($number%5 === 0 ){
		echo "Buzz".PHP_EOL;
	}
	else{
		echo $number.PHP_EOL;
	}
}*/


/*
https://www.geeksforgeeks.org/how-to-read-user-or-console-input-in-php/
https://alvinalexander.com/php/php-read-command-line-arguments-in-php/
https://electrictoolbox.com/command-line-arguments-php-cli/
https://www.php.net/manual/en/wrappers.php.php
https://www.php.net/manual/en/function.readline.php
https://www.php.net/manual/en/features.commandline.php
https://www.php.net/manual/en/reserved.variables.argv.php
https://www.php.net/manual/en/function.getopt.php
https://www.php.net/manual/en/function.getopt.php


https://stackoverflow.com/questions/8893574/php-php-input-vs-post
https://stackoverflow.com/questions/6543841/php-cli-getting-input-from-user-and-then-dumping-into-variable-possible



//get 3 commands from user
for ($i=0; $i < 3; $i++) {
        $line = readline("Command: ");
        readline_add_history($line);
}

//dump history
print_r(readline_list_history());

//dump variables
print_r(readline_info());

---

// get the raw POST data
    $rawData = file_get_contents("php://input");

    // this returns null if not valid json
    return json_decode($rawData);

    ---
$line = fgets(STDIN);

*/

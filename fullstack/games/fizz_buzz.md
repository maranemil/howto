```
##########################################################
Fizz? Buzz? FizzBuzzz! Javascript PHP
##########################################################
https://dev.to/niharikapujari/fizz-buzz-fizzbuzzz-2bp2

// -------------------------------------------------------
// JS v1
// https://jsfiddle.net/

for (let i = 0; i < 100; i++) {
  if (i % 3 === 0 && i % 5 == 0) {
    console.log("Fizzbuzz");
  } else if (i % 3 === 0) {
    console.log("Fizz");
  } else if (i % 5 === 0) {
    console.log("Buzz");
  } else {
    console.log(i);
  }
}
```
```
// -------------------------------------------------------
// JS v2
// https://jsfiddle.net/

for (let i = 0; i < 100; i++) {
  console.log((++i % 3 ? '' : 'Fizz') + (i % 5 ? '' : 'Buzz') || i)
}
```
```
// -------------------------------------------------------
// PHP v1
// https://sandbox.onlinephpfunctions.com/
// https://www.php.net/manual/de/function.range.php

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
}
```
```
// -------------------------------------------------------
// PHP v2
// https://davidwalsh.name/php-shorthand-if-else-ternary-operators
foreach(range(10, 15) as $number) {
    echo ($number%3==0 && ($number%5==0))?'FizzBuzz'.PHP_EOL:(($number%3==0) ? 'Fizz'.PHP_EOL : (($number%5==0) ? 'Buzz'.PHP_EOL: $number.PHP_EOL));
}
```
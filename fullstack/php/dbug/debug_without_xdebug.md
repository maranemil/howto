

### How to get name of calling function/method in PHP? [duplicate]

```
https://stackoverflow.com/questions/2110732/how-to-get-name-of-calling-function-method-in-php
https://www.phptutorial.net/php-oop/php-__call/
https://stackoverflow.com/questions/190421/get-name-of-caller-function-in-php

echo debug_backtrace()[1]['function'];


file_put_contents(
        __DIR__."__xdebug.log",
        "----".json_encode($str_arr,JSON_PRETTY_PRINT).PHP_EOL.
         __CLASS__.PHP_EOL.
         __METHOD__.PHP_EOL.
         __LINE__.PHP_EOL.
         "caller:".debug_backtrace()[1]['function'].PHP_EOL.
         '---------------'.PHP_EOL,
    FILE_APPEND | LOCK_EX
);
```

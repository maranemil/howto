####################################################
#
# PHP CACHE Options
#
####################################################

/*
https://www.php.net/manual/en/memcache.set.php
http://www.php-cache.com/en/latest/
https://github.com/php-cache/predis-adapter
https://www.php.net/manual/de/book.opcache.php
https://www.php.net/manual/de/book.apc.php
https://www.php.net/manual/de/mysqlnd-qc.quickstart.caching.php
https://www.php.net/manual/en/book.apc.php
https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/caching.html
https://twig.symfony.com/doc/2.x/api.html
https://www.php.net/manual/en/function.apc-add.php
https://www.php.net/manual/en/function.apc-store.php
https://laravel.com/docs/5.7/cache
https://www.php.net/manual/de/mysqlnd-qc.constants.php
https://www.hgb-leipzig.de/~uklaus/PHP/mysqlnd-qc.quickstart.caching.html
https://www.hgb-leipzig.de/~uklaus/PHP/mysqlnd-qc.constants.html
https://www.php.net/manual/en/book.mysqlnd-qc.php


// -----------------------------------------------
http://www.php-cache.com/en/latest/
https://www.phpfastcache.com/
https://www.php-fig.org/psr/psr-6/
// -----------------------------------------------

[Regular drivers]
Apc
Cookie
Files
Leveldb
Memcache
Sqlite
Wincache
Xcache
Zend Disk Cache

[High performances drivers]
Cassandra
CouchBase
Couchdb
Mongodb
Predis
Redis
Riak
Ssdb
Zend Memory Cache

[Development drivers]
Devnull
Devfalse
Devtrue
Memstatic

*/


####################################################
#
#   Array Funktionen range
#   https://www.php.net/manual/de/function.range.php
#   http://phptester.net/
#
####################################################

$t0 = microtime(true);
for ($i = 0; $i < 100000; $i++) {}
echo 'for loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL;

$t0 = microtime(true);
foreach (range(0, 100000) as $i) {}
echo 'foreach + range loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL;

// ----------------------------------------------

foreach(range(0,10000) as $i) {} // 3.847 ms 0.0034
for($i = 0; $i < 10000; ++$i) {} // 0.663 ms 0.0014

for($i = 0; $i < 1000; ++$i) {} // faster
for($i = 0; $i < 1000; $i++) {}

####################################################
#
#	Get the first element of an array
#   https://stackoverflow.com/questions/1921421/get-the-first-element-of-an-array
#
####################################################

array_shift(array_values($array));
array_pop(array_reverse($array));
array_shift(array_slice($array, 0, 1));
array_values($array)[0];

$my_array = ['IT', 'rules', 'the', 'world'];
$first_key = array_key_first($my_array);
$first_value = $my_array[$first_key];
$last_key = array_key_last($my_array);
$last_value = $my_array[$last_key];

$array[key($array)] #  to get first element
key($array) # to get first key.
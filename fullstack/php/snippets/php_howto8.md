```

#######################################################
#
#   Date last month
#
#######################################################

https://stackoverflow.com/questions/2094797/the-first-day-of-the-current-month-in-php-using-date-modify-as-datetime-object
http://phptester.net/

echo '<br>First day of the month:' . date('Y-m-01');
echo '<br>Last day of the month:'.  date('Y-m-t');
echo '<hr>' ;

$d = date_create();
print '<BR>First day of this month: ' .date_create($d->format('Y-m-01'))->format('Y-m-d') ;
echo '<BR>First day of last month: ' .
date('m/d/y h:i a',(strtotime('last month',strtotime(date('m/01/y')))));
echo '<BR>Last day of last month: ' .
date('m/d/y h:i a',(strtotime('last day of last month',strtotime(date('Y-m-t')))));

$week_start = strtotime('last Sunday', time());
$week_end = strtotime('next Sunday', time());

$month_start = strtotime('first day of this month', time());
$month_end = strtotime('last day of this month', time());

$year_start = strtotime('first day of January', time());
$year_end = strtotime('last day of December', time());

$last_month_start = strtotime('first day of last month', time());
$last_month_end = strtotime('last day of last month', time());

echo '<hr>' ;
echo date('D, M jS Y', $week_start).'<br/>';
echo date('D, M jS Y', $week_end).'<br/>';
echo date('D, M jS Y', $month_start).'<br/>';
echo date('D, M jS Y', $month_end).'<br/>';
echo date('D, M jS Y', $year_start).'<br/>';
echo date('D, M jS Y', $year_end).'<br/>';
echo date('D, M jS Y', $last_month_start).'<br/>';
echo date('D, M jS Y', $last_month_end).'<br/>';

echo '<hr>' ;
//
$d = new DateTime('first day of this month');
echo '<br>First day of this month:' .$d->format('jS, F Y');
//
$d = new DateTime('2010-01-19');
$d->modify('first day of this month');
echo '<br>First day of a specific month:' .$d->format('jS, F Y');
//
echo '<br>alternatively...:' .date_create('2010-01-19')
->modify('first day of this month')
->format('jS, F Y');

```


```
#######################################################
#   Moving from MySQL to ADOdb
#######################################################

https://adodb.org/dokuwiki/doku.php?id=v5:reference:recordset:fetchobj
https://hotexamples.com/examples/-/-/NewADOConnection/php-newadoconnection-function-examples.html
https://adodb.org/dokuwiki/doku.php?id=v5:database:mysql
https://adodb.org/dokuwiki/doku.php?id=v5:userguide:mysql_tutorial

/*
* Enable ADOdb
*/
$db = newAdoConnection('mysqli')
/*
* Set the SSL parameters
*/
$db->ssl_key    = "key.pem";
$db->ssl_cert   = "cert.pem";
$db->ssl_ca     = "cacert.pem";
$db->ssl_capath = null;
$db->ssl_cipher = null;
 
/*
* Open the connection
*/
$db->connect($host, $user, $password, $database);



$SQL = "SELECT * FROM Employees"
$result = $db->execute($SQL);
$r = $result->fetchObj()
print_r($r);
print $r->first_name;

....

include('adodb.inc.php');
include('tohtml.inc.php'); /* includes the rs2html function */
$conn = newADOConnection('mysqli');
$conn->pConnect('localhost','userid','password','database');
$rs = $conn->execute('select * from table');
rs2html($rs); /* recordset to html table */

...

include("adodb.inc.php");
$db = newADOConnection('mysql');
$db->connect("localhost", "root", "password", "mydb");

...

// Section 1
include("adodb.inc.php");
$db = newADOConnection('mysqli');
$db->connect("localhost", "root", "password", "mydb");
 
// Section 2
$result = $db->execute("SELECT * FROM employees");
if ($result === false) die("failed");
 
// Section 3
while (!$result->EOF) {
    for ($i=0, $max=$result->fieldCount(); $i < $max; $i++) {
        print $result->fields[$i].' ';
    }
    $result->moveNext();
    print "<br>\n";
}

...

http://cdc.gy/sahana/3rd/adodb/docs/docs-adodb.htm#ex2
https://www.uoyep.org.ar/utiles/phpgrid/lib/inc/adodb/docs/docs-adodb.htm#ex1
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getall
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getarray
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:setfetchmode
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getrow
https://adodb.org/dokuwiki/doku.php?id=v5:reference:recordset:fetchobj
https://adodb.org/dokuwiki/doku.php?id=v5:reference:recordset:fetchrow
https://adodb.org/dokuwiki/doku.php?id=v5:reference:reference_index

$recordSet = $conn->Execute('select CustomerID,OrderDate from Orders');
if (!$recordSet)
    print $conn->ErrorMsg();
else
    while (!$recordSet->EOF) {
        $fld = $recordSet->FetchField(1);
        $type = $recordSet->MetaType($fld->type);

        if ( $type == 'D' || $type == 'T')
            print $recordSet->fields[0].' '.
            $recordSet->UserDate($recordSet->fields[1],'m/d/Y').'<BR>';
        else
            print $recordSet->fields[0].' '.$recordSet->fields[1].'<BR>';

        $recordSet->MoveNext();
    }
$recordSet->Close(); # optional
$conn->Close(); # optional

.......

$db->SetFetchMode(ADODB_FETCH_NUM);
$rs1 = $db->Execute('select * from table');

$db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs2 = $db->Execute('select * from table');

print_r($rs1->fields); # shows array([0]=>'v0',[1] =>'v1')
print_r($rs2->fields); # shows array(['col1']=>'v0',['col2'] =>'v1')


```
```

#######################################################
#   Address REGEX formating
#######################################################

$string = "Via Villaggio Primavera 8 22010 Brienno Co, Italy";
$pattern = '/\s(\d+){5}/i';
$replacement = ', $0,';
echo preg_replace($pattern, $replacement, $string);
// Via Villaggio Primavera 8, 22010, Brienno Co, Italy


```

```
#######################################################
#   Random number generator in arbitrary probability distribution fashion
#   algorithm for a random, uneven distribution of a fixed amount of a resource
#######################################################

https://www.geeksforgeeks.org/random-number-generator-in-arbitrary-probability-distribution-fashion/
https://softwareengineering.stackexchange.com/questions/143061/whats-a-good-algorithm-for-a-random-uneven-distribution-of-a-fixed-amount-of-a
https://stackoverflow.com/questions/2325472/generate-random-numbers-following-a-normal-distribution-in-c-c
https://en.wikipedia.org/wiki/List_of_probability_distributions
https://machinelearningmastery.com/random-oversampling-and-undersampling-for-imbalanced-classification/
https://www.jstor.org/stable/1266466
https://dl.acm.org/doi/10.1145/3412841.3441884
https://math.stackexchange.com/questions/2580933/simplest-way-to-produce-an-even-distribution-of-random-values
https://numpy.org/doc/stable/reference/random/generated/numpy.random.uniform.html
https://stackoverflow.com/questions/63800423/picking-a-random-item-from-array-with-equal-distribution
https://linuxhint.com/generating-random-numbers-with-uniform-distribution-in-python/
https://stat.ethz.ch/R-manual/R-devel/library/stats/html/Uniform.html
https://www.geo.fu-berlin.de/en/v/soga/Basics-of-statistics/Continous-Random-Variables/Continuous-Uniform-Distribution/index.html
https://www.geo.fu-berlin.de/en/v/soga/Basics-of-statistics/Continous-Random-Variables/Continuous-Uniform-Distribution/Continuous-Uniform-Distribution-in-R/index.html
https://stackoverflow.com/questions/48769900/iterate-through-2d-array-of-booleans-and-leave-only-the-largest-contiguous-2d-b

(lowbound+upperbound)/2
Math.floor(Math.random() * array.length);

Python

import numpy as np
np.random.uniform()
np.random.uniform(low=0, high=10)
np.random.uniform(0, 10, size=4)
np.random.uniform(0, 10, size=(2, 2))


import seaborn as sns
import matplotlib.pyplot as plt
a = np.random.uniform(0, 10, 10000)
sns.histplot(a)
plt.show()

// 2d array.
$array = array(
array(1, 0, 0, 0, 1, 0, 0, 1),
array(0, 0, 1, 1, 1, 1, 0, 1),
array(0, 1, 1, 0, 1, 0, 0, 0),
array(0, 1, 1, 0, 0, 0, 1, 0),
array(1, 0, 0, 0, 1, 1, 1, 1),
array(0, 1, 1, 0, 1, 0, 1, 0),
array(0, 0, 0, 0, 0, 0, 0, 1)
);



PHP

// https://ideone.com/6QNV7c

$shape_nr=1;
$ln_max=count($array);
$cl_max=count($array[0]);
$done=[];

//LOOP ALL CELLS, GIVE 1's unique number
for($ln=0;$ln<$ln_max;++$ln){
for($cl=0;$cl<$cl_max;++$cl){
    if($array[$ln][$cl]===0)continue;
    $array[$ln][$cl] = ++$shape_nr;
}}

//DETECT SHAPES
for($ln=0;$ln<$ln_max;++$ln){
for($cl=0;$cl<$cl_max;++$cl){
    if($array[$ln][$cl]===0)continue;

    $shape_nr=$array[$ln][$cl];
    if(in_array($shape_nr,$done))continue;

    look_around($ln,$cl,$ln_max,$cl_max,$shape_nr,$array);
    //SET SHAPE_NR to DONE, no need to look at that number again
    $done[]=$shape_nr;
}}  

// LOOP THE ARRAY and COUNT SHAPENUMBERS
$res=array();
for($ln=0;$ln<$ln_max;++$ln){
for($cl=0;$cl<$cl_max;++$cl){
    if($array[$ln][$cl]===0)continue;
    if(!isset($res[$array[$ln][$cl]]))$res[$array[$ln][$cl]]=1;
    else $res[$array[$ln][$cl]]++;
}}

//get largest shape
$max = max($res);
$shape_value_max = array_search ($max, $res);

//get smallest shape
$min = min($res);
$shape_value_min = array_search ($min, $res);

// recursive function: detect connecting cells  
function look_around($ln,$cl,$ln_max,$cl_max,$nr,&$array){
    //create mini array
    $mini=mini($ln,$cl,$ln_max,$cl_max);
    if($mini===false)return false;

    //loop surrounding cells
    foreach($mini as $v){
        if($array[$v[0]][$v[1]]===0){continue;}
        if($array[$v[0]][$v[1]]!==$nr){
            // set shape_nr of connecting cell
            $array[$v[0]][$v[1]]=$nr;

            // follow the shape
            look_around($v[0],$v[1],$ln_max,$cl_max,$nr,$array);
            }
        }
    return $nr;
    }

// CREATE ARRAY WITH THE 9 SURROUNDING CELLS
function mini($ln,$cl,$ln_max,$cl_max){
    $look=[];  
    $mini=[[-1,-1],[-1,0],[-1,1],[0,-1],[0,1],[1,-1],[1,0],[1,1]];
    foreach($mini as $v){
        if( $ln + $v[0] >= 0 &&
            $ln + $v[0] < $ln_max &&
            $cl + $v[1] >= 0 &&
            $cl + $v[1] < $cl_max
            ){
            $look[]=[$ln + $v[0], $cl + $v[1]];
            }
        }

    if(count($look)===0){return false;}
    return $look;
}
  
```
 
```
#######################################################
#
#   PHP mysqli insert_id() Function
#
#######################################################

https://www.w3schools.com/php/php_mysql_insert_lastid.asp
https://www.w3schools.com/php/func_mysqli_insert_id.asp
https://www.php.net/manual/en/mysqli.insert-id.php
https://hotexamples.com/examples/-/-/mysqli_query/php-mysqli_query-function-examples.html
https://hotexamples.com/examples/-/-/MYSQLI_QUERY/php-mysqli_query-function-examples.html
https://hotexamples.com/examples/-/-/MySQLi_Query/php-mysqli_query-function-examples.html

* Object-oriented style

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
$mysqli->query("CREATE TABLE myCity LIKE City");
$query = "INSERT INTO myCity VALUES (NULL, 'Stuttgart', 'DEU', 'Stuttgart', 617000)";
$mysqli->query($query);
printf("New record has ID %d.\n", $mysqli->insert_id);
/* drop table */
$mysqli->query("DROP TABLE myCity");

* Procedural style

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "my_user", "my_password", "world");
mysqli_query($link, "CREATE TABLE myCity LIKE City");
$query = "INSERT INTO myCity VALUES (NULL, 'Stuttgart', 'DEU', 'Stuttgart', 617000)";
mysqli_query($link, $query);
printf("New record has ID %d.\n", mysqli_insert_id($link));
/* drop table */
mysqli_query($link, "DROP TABLE myCity");



https://www.php.net/manual/en/mysqli-result.fetch-assoc.php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect("localhost", "my_user", "my_password", "world");
$query = "SELECT Name, CountryCode FROM City ORDER BY ID DESC";
$result = mysqli_query($mysqli, $query);

/* fetch associative array */
while ($row = mysqli_fetch_assoc($result)) {
    printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
}
   
```

```

#######################################################
#
#   random-string-generator
#
#######################################################

// https://stackoverflow.com/questions/4356289/php-random-string-generator
// https://www.php.net/manual/en/function.str-shuffle.php
// https://www.php.net/manual/en/function.str-shuffle.php
// https://www.php.net/manual/en/function.rand.php
// https://www.php.net/manual/en/function.random-bytes.php
// https://www.geeksforgeeks.org/generating-random-string-using-php/
// https://code.tutsplus.com/tutorials/generate-random-alphanumeric-strings-in-php--cms-32132
// https://www.codegrepper.com/code-examples/php/PHP+random+string+generator


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$id = generateRandomString(32);
echo strtolower($id);
echo "<br>";
echo md5(time());
echo "<br>";

function generateRandomStrings($length = 32) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

echo  strtolower(generateRandomStrings());  // OR: generateRandomString(24)

...

https://www.php.net/manual/en/function.str-split.php
https://www.php.net/manual/en/function.chunk-split.php

$md5 =  md5(time());

echo $chunk_split = substr(chunk_split($md5, 4, '-'), 0, -1);
$arr_grips = explode("-",$chunk_split);
echo  "<br>";

// join
echo $id = $arr_grips[0].$arr_grips[1].
"-".$arr_grips[3].
"-".$arr_grips[4].
"-".$arr_grips[5].
"-".$arr_grips[6].$arr_grips[7].$arr_grips[6];
   
// md5 fdde11b1846ba9bf66c862f0da8162f0
// chunk fdde-11b1-a1a4-846b-a9bf-66c8-62f0-da81
// join fdde11b1-846b-a9bf-66c8-62f0da8162f0
   
```

```

#######################################################
random  bytes
#######################################################
https://www.php.net/manual/en/function.random-bytes.php

echo  bin2hex(random_bytes(5));

// string(10) "385e33f741"
```

```

#######################################################
php file creation date
https://stackoverflow.com/questions/4401320/php-how-can-i-get-file-creation-date
#######################################################

echo date ("F d Y H:i:s.", filemtime($filename));
```



### permissions 

```

find src/ -type d -exec chmod 0770 {} +
sudo find src/ -type f -exec chmod 0644 {} +

$folder_permission_chmod = substr(sprintf('%o', fileperms($path)), -4);
$folder_permission_chown = posix_getpwuid(fileowner($folder_permission_chmod));
echo '<br> Permission chmod: ' . $folder_permission_chmod ;
echo '<br> Permission chown: ' . $folder_permission_chown['name'] ;

@rmdir($path);
@mkdir($path, 0755, true);
@mkdir($path, 0755, true);
@chown($path, "www-data");
@chmod($path, 0755);

find src/ -type d -exec chmod 0770 {} +"); //for sub directory
find src/ -type f -exec chmod 0644 {} +"); //for files inside directory
chmod -R 0755 cache/
chmod -R g+rw cache/

if (touch($file)) {
       echo $file . ' modification time has been changed to present time';
} else {
      echo 'Sorry, could not change modification time of ' . $file;
}
```

### Accessing various I/O streams
```

php:// — Accessing various I/O streams

https://www.php.net/manual/de/wrappers.php.php
https://riptutorial.com/php/example/787/input-and-output-handling
https://www.php.net/manual/de/function.popen.php
https://www.php.net/manual/de/features.commandline.io-streams.php
https://stackoverflow.com/questions/8781906/how-to-use-stdout-in-php
https://www.php.net/manual/en/wrappers.php

STDIN = fopen("php://stdin", "r");
STDOUT = fopen("php://stdout", "w");
STDERR = fopen("php://stderr", "w");

fwrite(STDOUT, 'foo');

$stdin = fopen('php://stdin', 'r');
$stdout = fopen('php://stdout', 'w');
$stderr = fopen('php://stderr', 'w');

php -r 'fwrite(STDERR, "stderr\n");'


# PHP WAY 
$input = fgets(STDIN);
fwrite(STDOUT, $output);

#CMD WAY
cat "input.txt"  |  php script.php   >  "output.txt"
php script.php  < input.txt  > output.txt
echo "input..."  |  php script.php   |  sort  |  tee  output.txt
```


```
####################################################
assert php
####################################################
https://www.php.net/manual/de/function.assert.php

// Assertions aktivieren und stummschalten
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

// Eine Handlerfunktion erzeugen
function my_assert_handler($file, $line, $code, $desc = null)
{
    echo "Assertion fehlgeschlagen in $file:$line: $code";
    if ($desc) {
        echo ": $desc";
    }
    echo "\n";
}

// Den Callback definieren
assert_options(ASSERT_CALLBACK, 'my_assert_handler');

// Assertions, die fehlschlagen sollten
assert('2 < 1');
assert('2 < 1', 'Zwei ist kleiner als Eins');

class CustomError extends AssertionError {}
assert(true == false, new CustomError('True ist nicht false!'));
echo 'Hi!';
```

```

##########################################
PHP 7.4 deprecated get_magic_quotes_gpc function alternative
##########################################
https://stackoverflow.com/questions/61054418/php-7-4-deprecated-get-magic-quotes-gpc-function-alternative


Since PHP no longer adds slashes to request parameters (removed in PHP 5.4),
 get_magic_quotes_gpc() always returns false. With that in mind, you don't
  have to do anything to your strings, they should always be clean. 


get_magic_quotes_gpc() has been useless ever since PHP 5.4.0. It would
 tell you whether you have magic quotes switched on in the configuration
  or not. Magic quotes were a terrible idea and this feature was removed 
  for security reasons (PHP developers believed in magic & superstitions
   and wrote unsecure code).
```

```
##########################################
ob_get_contents + ob_end_clean vs ob_get_clean
##########################################
https://stackoverflow.com/questions/17792817/ob-get-contents-ob-end-clean-vs-ob-get-clean
https://www.php.net/manual/en/function.ob-get-contents.php
https://www.php.net/manual/en/function.ob-get-clean.php

ob_get_clean() essentially executes both ob_get_contents() and ob_end_clean().
```


```
##########################################
$_SERVER['QUERY_STRING'];parse_str
##########################################
https://www.php.net/manual/en/function.parse-str.php

parse_str($str, $output);
echo $output['first'];  // value
echo $output['arr'][0]; // foo bar
echo $output['arr'][1]; // ba
```

```
##########################################
EXTR_IF_EXISTS (integer)
##########################################
https://www.cs.auckland.ac.nz/references/php/2003/ref.array.html
https://php-legacy-docs.zend.com/manual/php4/en/function.extract
https://www.php.net/manual/de/function.extract.php
https://stackoverflow.com/questions/15558509/is-it-safe-to-use-extract-request-extr-if-exists

Only overwrite the variable if it already exists in the current symbol table, otherwise do nothing. 
This is useful for defining a list of valid variables and then extracting only 
those variables you have defined out of $_REQUEST, for example.
```

```
#####################################################
Sending Reading Axios parameters with a POST request in PHP
#####################################################

https://zerowp.com/sending-axios-parameters-with-a-post-request-in-php/
https://stackoverflow.com/questions/41457181/axios-posting-params-not-read-by-post

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);
$item = $data['item']; // Works!


$_POST = json_decode(file_get_contents("php://input"),true);
echo $_POST['data1'];
```

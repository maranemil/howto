<?php

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

class Article
{

    public $name;
    public $id;
    public $sort;
    public $category;
    protected static $_instances = array();

    public function __construct()
    {
        self::$_instances[] = $this;
        $this->id = rand(1, 8);
        $this->name = "" . str_shuffle("abcde");
        $this->sort = rand(1, 8);
    }

    public static function getInstances()
    {
        $return = array();
        foreach (self::$_instances as $instance) {
            if (is_a($instance, get_called_class($this))) {
                if (get_class($instance) === get_class($this)) {
                    $return[] = $instance;
                }
            }
        }
        return $return;
    }
}

class Category
{

    public $id;
    public $name;
    protected static $_instances = array();

    public function __construct()
    {
        self::$_instances[] = $this;
    }

    public static function getInstances()
    {
        $return = array();
        foreach (self::$_instances as $instance) {
            #if (is_a($instance, get_called_class($this))) {
            #if (get_class($instance) === get_class($this)) {
            $return[] = $instance;
            #}
            #}
        }
        return $return;
    }

    public static function getInstance($id)
    {
        $return = array();
        foreach (self::$_instances as $instance) {
            #if ($instance instanceof get_called_class($this)) {
            if ($instance->id == $id) {
                return $instance;
            }
            #}
        }
        return null;
    }
}

class Utiles
{
    public static function sortArrayByObjectProperty($arrayToSort, $meta): array
    {
        /*usort($arrayToSort, function ($a, $b) use ($meta) {
        return strcmp($a->{$meta}, $b->{$meta});
        });*/

        usort($arrayToSort, fn($a, $b) => strcmp($a->{$meta}, $b->{$meta}));
        return $arrayToSort;
    }
}

foreach (range(1, 3) as $i) {
    $objCategory = new Category();
    $objCategory->id = $i;
    $objCategory->name = "Category " . str_shuffle("ampw"). microtime();
}

$arrResult = array();
foreach (range(1, 3) as $i) {
    $obTest = new Article();
    $obTest->category = $i;
    $arrResult[$obTest->id] = $obTest;
}

print "--- Category Instances ------------------------------------------------------------".PHP_EOL;
print_r(Category::getInstances());

print "--- Article Instances------------------------------------------------------------".PHP_EOL;
print_r($arrResult);

/**
 * sort by object proprety
 */
#$arrResultRes = Utiles::sortArrayByObjectProperty($arrResult, "category");
print "--- Sort by usort  ------------------------------------------------------------".PHP_EOL;
print_r($arrResultRes);

/**
 * sort by key
 */
#ksort($arrResult,SORT_NATURAL);
#print_r($arrResult);

foreach ($arrResult as $key => $object) {
    $objTestCategory = Category::getInstance($object->category);
    $arrResultSort[$key] = array
        (
        "category" => $objTestCategory->name,
        "article" => $object,
    );
}

#print_r($arrResultSort);

/**
 * sort bei second key
 */
$keys = array_column($arrResultSort, 'category');
array_multisort($keys, SORT_ASC, $arrResultSort);

print "--- Sort by second key ------------------------------------------------------------".PHP_EOL;
print_r($arrResultSort);

foreach ($arrResultSort as $arrElem) {
    $arrFinal[$arrElem["article"]->id] = $arrElem["article"];
}

print "--- Final ARR ------------------------------------------------------------".PHP_EOL;
print_r($arrFinal);



usort($arrResultSort, function ($a, $b) {
    return $a['category'] <=> $b['category'];
});

print "--- usort sort 2 ------------------------------------------------------------".PHP_EOL;
print_r($arrResultSort);


/*

References

https://stackoverflow.com/questions/2699086/how-to-sort-multi-dimensional-array-by-value?rq=1
https://stackoverflow.com/questions/2699086/how-to-sort-multi-dimensional-array-by-value?rq=1
https://stackoverflow.com/questions/3232965/sort-multidimensional-array-by-multiple-columns/54647220#54647220
https://stackoverflow.com/questions/4282413/sort-array-of-objects-by-object-fields
https://stackoverflow.com/questions/475569/get-all-instances-of-a-class-in-php
https://stackoverflow.com/questions/475569/get-all-instances-of-a-class-in-php
https://stackoverflow.com/questions/475569/get-all-instances-of-a-class-in-php
https://www.codepunker.com/blog/3-solutions-for-multidimensional-array-sorting-by-child-keys-or-values-in-PHP
https://www.php.net/manual/de/arrayobject.asort.php
https://www.php.net/manual/de/arrayobject.ksort.php
https://www.php.net/manual/de/function.array-multisort.php
https://www.php.net/manual/de/function.array-multisort.php
https://www.php.net/manual/de/function.str-shuffle.php
https://www.php.net/manual/de/language.oop5.late-static-bindings.php
https://www.php.net/manual/en/function.get-called-class.php
https://www.php.net/manual/en/function.get-class.php
https://www.php.net/manual/en/function.microtime.php
https://www.php.net/manual/en/function.strnatcmp.php
https://www.php.net/manual/en/function.usort.php
https://www.php.net/manual/en/language.oop5.static.php
https://www.the-art-of-web.com/php/sortarray/
https://www.tutorialspoint.com/sort-multidimensional-array-by-multiple-keys-in-php

php -c /etc/php/7.4/cli/php.ini test.php



  Array
(
    [0] => stdClass Object
        (
            [ID] => 1
            [name] => Mary Jane
            [count] => 420
        )

    [1] => stdClass Object
        (
            [ID] => 2
            [name] => Johnny
            [count] => 234
        )

)

--------------------------------
#  without closures
--------------------------------
function cmp($a, $b) {
    return strcmp($a->name, $b->name);
}
usort($your_data, "cmp");

--------------------------------
#  using closures
--------------------------------
usort($your_data, function($a, $b)
{
    return strcmp($a->name, $b->name);
});
--------------------------------
Using arrow functions (from PHP 7.4)
--------------------------------

usort($your_data, fn($a, $b) => strcmp($a->name, $b->name));


sort integer values:

// Desc sort
usort($array,function($first,$second){
    return $first->number < $second->number;
});

// Asc sort
usort($array,function($first,$second){
    return $first->number > $second->number;
});

// Desc sort
usort($array,function($first,$second){
    return strtolower($first->text) < strtolower($second->text);
});

// Asc sort
usort($array,function($first,$second){
    return strtolower($first->text) > strtolower($second->text);
});

--------------------------------------------------------

public static function cmp($a, $b)
{
    return strcmp($a->name, $b->name);
}
usort($your_data, array('YOUR_CLASS_NAME','FUNCTION_NAME'));


function my_sort_function($a, $b)
{
    return $a->name < $b->name;
}
usort($array, 'my_sort_function');
var_dump($array);

--------------------------------------------------------

function sortArrayByKey(&$array,$key,$string = false,$asc = true){
    if($string){
        usort($array,function ($a, $b) use(&$key,&$asc)
        {
            if($asc)    return strcmp(strtolower($a{$key}), strtolower($b{$key}));
            else        return strcmp(strtolower($b{$key}), strtolower($a{$key}));
        });
    }else{
        usort($array,function ($a, $b) use(&$key,&$asc)
        {
            if($a[$key] == $b{$key}){return 0;}
            if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
            else     return ($a{$key} > $b{$key}) ? -1 : 1;

        });
    }
}

sortArrayByKey($yourArray,"name",true); //String sort (ascending order)
sortArrayByKey($yourArray,"name",true,false); //String sort (descending order)
sortArrayByKey($yourArray,"id"); //number sort (ascending order)
sortArrayByKey($yourArray,"count",false,false); //number sort (descending order)

--------------------------------------------------------

$names = array();
foreach ($my_array as $my_object) {
    $names[] = $my_object->name; //any object field
}

array_multisort($names, SORT_ASC, $my_array);
return $my_array;

--------------------------------------------------------
sort dates
--------------------------------------------------------

usort($threads,function($first,$second){
    return strtotime($first->dateandtime) < strtotime($second->dateandtime);
});

--------------------------------------------------------

Codeigniter, you can use the methods:

usort($jobs, array($this->job_model, "sortJobs"));  // function inside Model
usort($jobs, array($this, "sortJobs")); // Written inside Controller.

--------------------------------------------------------

class Util
{
    public static function sortArrayByName(&$arrayToSort, $meta) {
        usort($arrayToSort, function($a, $b) use ($meta) {
            return strcmp($a[$meta], $b[$meta]);
        });
    }
}
Call it:

Util::sortArrayByName($array, "array_property_name");

--------------------------------------------------------

sort by number:

function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

$a = array(3, 2, 5, 6, 1);

usort($a, "cmp");

--------------------------------------------------------

by char

 char:

function cmp($a, $b)
{
    return strcmp($a["fruit"], $b["fruit"]);
}

$fruits[0]["fruit"] = "lemons";
$fruits[1]["fruit"] = "apples";
$fruits[2]["fruit"] = "grapes";

usort($fruits, "cmp");

--------------------------------------------------------

$array[0] = array('key_a' => 'z', 'key_b' => 'c');
$array[1] = array('key_a' => 'x', 'key_b' => 'b');
$array[2] = array('key_a' => 'y', 'key_b' => 'a');

function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}

usort($array, build_sorter('key_b'));

--------------------------------------------------------

usort($in,function($a,$b){
  return $a['first']   <=> $b['first']  //first asc
      ?: $a['second']  <=> $b['second'] //second asc
      ?: $b['third']   <=> $a['third']  //third desc (a b swapped!)
      //etc
  ;
});





*/


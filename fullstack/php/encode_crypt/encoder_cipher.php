<?php

// https://cryptii.com/pipes/alphabetical-substitution
// https://cryptii.com/pipes/alphabetical-substitution
// https://www.php.net/manual/en/function.array-search.php

$input = "the quick brown fox jumps over thirteen lazy dogs";
$output = "gsv jfrxp yildm ulc qfnkh levi gsrigvvm ozab wlth";

echo $output.PHP_EOL;

class Chiper
{
    // desire output
    // gsv jfrxp yildm ulc qfnkh levi gsrigvvm ozab wlth

    private static $mapping = array(
        "refer" => "1abcdefghijklmnopqrstuvwxyz",
        "shift" => "1zyxwvutsrqponmlkjihgfedcba"

    );

    public static function encode($str)
    {
        $arrRefer = str_split(self::$mapping["refer"]);
        $arrShift = str_split(self::$mapping["shift"]);

        foreach (str_split($str) as $letter) {
            $key = array_search($letter, $arrRefer);
            if(!empty($key)){
                echo str_replace($letter, $arrShift[$key], $letter);
            }
            else{
                echo ' ';
            }
            
        }
    }

    public static function decode($str)
    {
        $arrRefer = str_split(self::$mapping["refer"]);
        $arrShift = str_split(self::$mapping["shift"]);

        foreach (str_split($str) as $letter) {
            $key = array_search($letter, $arrShift);
            if($key){
                echo str_replace($letter, $arrRefer[$key], $letter);
            }
            else{
                echo ' ';
            }
            
        }
    }
}


Chiper::encode($input);
echo PHP_EOL;
Chiper::decode($output);
echo PHP_EOL;
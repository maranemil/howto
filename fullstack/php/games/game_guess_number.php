<?php

class Guess
{

    private $gen_number;
    private $min = 1;
    private $max = 5;

    public function __construct()
    {
        $this->gen_number = rand($this->min, $this->max);
        echo "Guess number on range betwee ". $this->min." and ". $this->max.PHP_EOL;
    }

    private function checkNumber($number)
    {
        if ($number == $this->gen_number) {
            echo "You guessed it! it was " . $this->gen_number.PHP_EOL;
        } else {
            $this->guessNumber();
        }
    }

    public function guessNumber()
    {
        $number = readline("Enter number: ");
        // echo $this->gen_number.PHP_EOL;
        $this->checkNumber($number);
    }
}

$o = new Guess();
$o->guessNumber();

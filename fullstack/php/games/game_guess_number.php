<?php /** @noinspection AutoloadingIssuesInspection */

class Guess
{

    private int $gen_number;
    private int $min = 1;
    private int $max = 5;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->gen_number = random_int($this->min, $this->max);
        echo "Guess number on range between " . $this->min . " and " . $this->max . PHP_EOL;
    }

    private function checkNumber($number): void
    {
        if ($number === $this->gen_number) {
            echo "You guessed it! it was " . $this->gen_number . PHP_EOL;
        } else {
            $this->guessNumber();
        }
    }

    public function guessNumber(): void
    {
        $number = readline("Enter number: ");
        // echo $this->gen_number.PHP_EOL;
        $this->checkNumber($number);
    }
}

$o = new Guess();
$o->guessNumber();

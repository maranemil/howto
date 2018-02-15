<?php

/*

http://php.net/manual/de/class.thread.php
https://www.rabbitmq.com/tutorials/tutorial-two-php.html
https://devcenter.heroku.com/articles/php-workers
https://github.com/iron-io/iron_worker_php
http://zguide.zeromq.org/php:spworker
http://php.net/manual/en/zmqcontext.construct.php
http://kamisama.me/2012/10/09/background-jobs-with-php-and-resque-part-3-installation/
http://php.net/manual/de/class.worker.php
http://php.net/manual/de/class.pool.php
http://masnun.com/2013/12/15/multithreading-in-php-doing-it-right.html
https://blog.madewithlove.be/post/thread-carefully/
https://github.com/krakjoe/pthreads/blob/master/examples/Pooling.php
https://gist.github.com/krakjoe/9384409
http://masnun.com/2013/12/15/multithreading-in-php-doing-it-right.html
https://github.com/krakjoe/pthreads


pecl install pthreads
brew install php56-pthreads

*/



// php multiple.php

class SearchGoogle extends Thread
{
    public function __construct($query)
    {
        $this->query = $query;
    }

   public function run()
	{
	    echo microtime(true).PHP_EOL;
	    $this->html = file_get_contents('http://google.fr?q='.$this->query);
	}
}



$searches = ['cats', 'dogs', 'birds'];
foreach ($searches as &$search) {
    $search = new SearchGoogle($search);
    $search->start();
}

foreach ($searches as $search) {
    $search->join();
    echo substr($search->html, 0, 20);
}


// --------------------------------------

class Searcher extends Worker
{
    public function run()
    {
        echo 'Running '.$this->getStacked().' jobs'.PHP_EOL;
    }
}

// Stack our jobs on our worker
$worker   = new Searcher();
$searches = ['dogs', 'cats', 'birds'];
foreach ($searches as &$search) {
    $search = new SearchGoogle($search);
    $worker->stack($search);
}

// Start all jobs
$worker->start();

// Join all jobs and close worker
$worker->shutdown();

// --------------------------------------

/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */

class WorkerThreads extends Thread
{
    private $workerId;

    public function __construct($id)
    {
        $this->workerId = $id;
    }

    public function run()
    {
        sleep(rand(0, 3));
        echo "Worker {$this->workerId} ran" . PHP_EOL;
    }
}

// Worker pool
$workers = [];

// Initialize and start the threads
foreach (range(0, 5) as $i) {
    $workers[$i] = new WorkerThreads($i);
    $workers[$i]->start();
}

// Let the threads come back
foreach (range(0, 5) as $i) {
    $workers[$i]->join();
}

?>
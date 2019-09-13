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









sudo apt-get install php-pear
sudo pecl install pthreads
pecl channel-update pecl.php.net
pear config-set temp_dir
sudo service apache2 restart


http://ittips.pandle.net/2012/04/25/thread-safety-in-php/
https://blog.flowl.info/2015/compile-php-5-6-pthreads-mongo-ubuntu/
https://blog.programster.org/install-php-7-0-with-pthreads-on-ubuntu-16.04
https://blog.programster.org/ubuntu16-04-compile-php-7-2-with-pthreads
https://blog.flowl.info/2015/compile-php-5-6-pthreads-mongo-ubuntu/
https://de.slideshare.net/RichardBaker26/faster-php-apps-using-queues-and-workers

sudo apt-get install php7.x-dev
sudo apt-get install php7.0-dev php-pear -y
sudo apt-get remove php-cli -y
cd $HOME
sudo pecl install pthreads


php -i | grep -i 'thread'
Thread Safety => disabled

On debian/ubuntu
Thread Safety enable.
# aptitude install apache2-mpm-worker libapache2-mod-fcgid php5-cgi && a2enmod fcgid && /etc/init.d/apache2 restartThread Safety disable.
# aptitude install apache2-mpm-prefork libapache2-mod-php5 && a2dismod fcgid && /etc/init.d/apache2 restart

---

https://www.php.net/manual/de/class.thread.php
https://www.php.net/manual/de/class.worker.php
https://www.php.net/manual/de/class.thread.php

<?php
class AsyncOperation extends Thread {
  public function __construct($arg){
    $this->arg = $arg;
  }

  public function run(){
    if($this->arg){
      printf("Hello %s\n", $this->arg);
    }
  }
}
$thread = new AsyncOperation("World");
if($thread->start())
  $thread->join();



class workerThread extends Thread {
public function __construct($i){
  $this->i=$i;
}

public function run(){
  while(true){
   echo $this->i;
   sleep(1);
  }
}
}

for($i=0;$i<50;$i++){
$workers[$i]=new workerThread($i);
$workers[$i]->start();
}


?>

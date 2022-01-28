
```
https://knpuniversity.com/screencast/rest/testing-phpunit
https://ole.michelsen.dk/blog/testing-your-api-with-phpunit.html
http://codeception.com/12-15-2013/testing-emails-in-php.html
https://www.droptica.com/blog/codeception-how-start-automatic-tests-using-docker-console/ # ***



https://gist.github.com/subfuzion/08c5d85437d5d4f00e58
https://gist.github.com/joyrexus/524c7e811e4abf9afe56
https://gist.github.com/whymarrh/5864443

https://github.com/WordPress/phpunit-test-runner/blob/master/functions.php
https://github.com/Codeception/Codeception/issues/410
https://github.com/Codeception/symfony1module
https://github.com/Codeception/Codeception/issues/443
https://github.com/Codeception/Codeception/issues/885

http://php.net/manual/en/function.curl-setopt.php#107621
http://php.net/manual/en/function.curl-setopt-array.php
http://php.net/manual/en/function.http-build-query.php
```

```
{
    "require-dev": {
    	"phpunit/phpunit": "*",
    	"guzzle/guzzle": "~3.7",
    	"codeception/codeception": "~2.1",
    }
}
```

```
<?php
class EmailTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @var \Guzzle\Http\Client
     */
    private $mailcatcher;

    public function setUp()
    {
        $this->mailcatcher = new \Guzzle\Http\Client('http://127.0.0.1:1080');

        // clean emails between tests
        $this->cleanMessages();
    }

    // api calls
    public function cleanMessages()
    {
        $this->mailcatcher->delete('/messages')->send();
    }

    public function getLastMessage()
    {
        $messages = $this->getMessages();
        if (empty($messages)) {
            $this->fail("No messages received");
        }
        // messages are in descending order
        return reset($messages);
    }

    public function getMessages()
    {
        $jsonResponse = $this->mailcatcher->get('/messages')->send();
        return json_decode($jsonResponse->getBody());
    }
?>
```

-----------------------------------
```
https://github.com/Codeception/Codeception/issues/533
http://docs.guzzlephp.org/en/stable/testing.html

$I = new WebGuy($scenario);
$I->amOnPage('/test.php');
$I->see('foo');

$I = new ApiGuy($scenario);
$I->wantTo('Test put with codeception');
$I->sendPUT('/api_test', array("1" => "2"));
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
```

-----------------
```
<?php
use \ApiGuy;

class PostListingCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function testPostListingReturnsData(ApiGuy $I)
    {
        $I = new ApiGuy($scenario);
        $I->wantTo('Return all posts');
        $I->sendGet('posts');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains("success");
    }
}
```

-----------------
```
// Code to set variables here ...
$I->amHttpAuthenticated($username, $secretKey);
$I->haveHttpHeader('Accept','application/xml');
$I->haveHttpHeader('Content-Type','application/xml');
$I->haveHttpHeader('x-v-api-version', $version);
$I->haveHttpHeader('x-v-issuer',$issuerId);
$I->haveHttpHeader('x-v-signature', $signature);
$I->haveHttpHeader('x-v-timestamp',$timeStamp);
$I->sendPOST($uri, $string);
$I->seeHttpHeader('x-v-call-id');
$I->seeResponseCodeIs(202);
$location = $I->grabHttpHeader('location');
$I->seeHttpHeader('location', $location);
```

-----------------------------------------------------------------------
```
https://github.com/Codeception/Codeception/issues/2123



acceptancesuite.yml

class_name: AcceptanceTester
modules:
    enabled:
        - WebDriver
        - AcceptanceHelper
        - Laravel4
        - Db
        - REST:
              depends: PhpBrowser
              url: http://localhost/api/
        # - MailCatcher
        # - Asserts
    config:
        # PhpBrowser:
        #     url: 'http://eg.dev'
        REST:
            url: 'http://eg.dev/api/v1/'
        WebDriver:
            url: 'http://eg.dev/'
            browser: phantomjs
            window_size: 1440x768
            capabilities:
                javascriptEnabled: true
                webStorageEnable: true
        Laravel4:
            cleanup: true
            start: bootstrap/start.php
        # MailCatcher:
        #      url: 'http://eg.dev'
        #      port: 1080
    coverage:
        enabled: true
        remote: false
codeception.yml

actor: Tester
paths:
    tests: tests
    log: tests/_output
    data: tests/_data
    helpers: tests/_support
settings:
    bootstrap: _bootstrap.php
    colors: true
    memory_limit: 60G
coverage:
    enabled: true
    remote: false
    c3_url: 'http://eg.dev/c3.php'
    include:
        - app/*.php
    exclude:
        - app/libraries/*
        - app/config/*
        - app/assets/*
        - app/database/*
        - app/lang/*
        - app/output/*
        - app/storage/*
        - app/tests/*
modules:
    config:
        Db:
            # dsn: 'sqlite3:tests/_data/dump.sqlite'
            dsn: 'mysql:host=127.0.0.1;port=3306;dbname=eg_testing'
            user: 'root'
            password: ''
            dump: tests/_data/eg.sql
            populate: true
            cleanup: true


```
---------------------------------------------------------------------------
```
acceptance.yml

class_name: AcceptanceTester
modules:
    enabled:
        - WebDriver
        - AcceptanceHelper
        - Laravel4
        - Db
        - REST:
              depends: PhpBrowser
              url: http://localhost:8000/api/
        # - MailCatcher
        # - Asserts
    config:
        # PhpBrowser:
        #     url: 'http://eg.dev'
        #REST:
            #url: 'http://localhost:8000/api/v1/'
        WebDriver:
            url: 'http://localhost:8000/'
            browser: phantomjs
            window_size: 1440x768
            capabilities:
                javascriptEnabled: true
                webStorageEnable: true
        Laravel4:
            cleanup: true
            start: bootstrap/start.php
        # MailCatcher:
        #      url: 'http://eg.dev'
        #      port: 1080
    coverage:
        enabled: true
        remote: false

```
```
api.suite.yml

class_name: ApiTester
modules:
    enabled:
        - PhpBrowser
        - REST:
              depends: PhpBrowser
              url: http://localhost:8000/api/
        - ApiHelper
        - Laravel4
        - Db
        - Asserts
    config:
        Laravel4:
            cleanup: true
            start: bootstrap/start.php
        PhpBrowser:
            url: http://localhost:8000/
        REST:
            url: http://localhost:8000/api/v1/
    coverage:
        remote: true


```
```
functional.suite.yml

class_name: FunctionalTester
modules:
    enabled:
        # - PhpBrowser
        - Filesystem
        - FunctionalHelper
        - Db
        - Asserts
        - Laravel4Sentinel
    config:
        Laravel4:
            cleanup: true
            start: bootstrap/start.php
        # PhpBrowser:
        #     url: 'http://eg.dev'
    coverage:
        enabled: true
        remote: false
unit.suite.yml

# Codeception Test Suite Configuration

# suite for unit (internal) tests.
class_name: UnitTester
modules:
    enabled: [Asserts, UnitHelper, Laravel4, Db]
```

---------------------------------------------------------------------
```
https://github.com/Codeception/Codeception/issues/2749

actor: Tester
paths:
    tests: tests
    log: tests/_output
    data: tests/_data
    support: tests/_support
    envs: tests/_envs
settings:
    bootstrap: _bootstrap.php
    colors: true
    memory_limit: 1024M
extensions:
    enabled:
        - Codeception\Extension\RunFailed
modules:
    config:
        Db:
            dsn: 'mysql:host=localhost;dbname=loket_new'
            user: 'root'
            password: '123123'
            populate: false
            cleanup: false
            reconnect: true
But when i ran test, error raised.

$I = new AcceptanceTester($scenario);
$I->wantTo('Booking One Ticket');
$I->click('Beli Tiket');
$I->seeInDatabase('invoice', ['invoice_code' => 'ABCDEF']);
```
---------------------------------------------------------------------
```
https://github.com/Codeception/Codeception/issues/841

    protected function _before()
    {
        $this->getModule('REST')->client->followRedirects(false);
        $this->getModule('PhpBrowser')->client->followRedirects(false);
    }

    // tests
    public function testHtml_303RedirectsToWwww()
    {
        $I = $this->apiGuy;
        $I->haveHttpHeader("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8");
        $I->sendHEAD($this->testLocation);
        $I->seeResponseCodeIs(303);
        $I->seeHttpHeader("location", $this->wwwServer . $this->testLocation);
        $I->seeHttpHeader("content-type", "text/html");
    }


***** suite definition:

class_name: ApiGuy
modules:
    enabled: [PhpBrowser, REST, ApiHelper]
    config:
      PhpBrowser:
          url: http://rdaregistry.dev/
      REST:
          url: http://rdaregistry.dev/
```
---------------------------------------------------------------------
```
http://codeception.com/docs-2.0/07-AdvancedUsage
http://codeception.com/docs/06-ReusingTestCode
http://codeception.com/docs/05-UnitTests
http://codeception.com/docs-2.0/03-ModulesAndHelpers
http://codeception.com/docs-2.0/08-Customization
http://codeception.com/docs-2.0/03-ModulesAndHelpers

$this->getModule('PhpBrowser')->_reconfigure(array('browser' => 'chrome'));

<?php
class TestCommons
{
    public static $username = 'john';
    public static $password = 'coltrane';

    public static function logMeIn($I)
    {
        $I->amOnPage('/login');
        $I->fillField('username', self::$username);
        $I->fillField('password', self::$password);
        $I->click('Enter');
    }
}
?>


<?php
// bootstrap
require_once '/path/to/test/commons/TestCommons.php';
?>

<?php
$I = new AcceptanceTester($scenario);
TestCommons::logMeIn($I);
?>


http://codeception.com/docs-2.0/03-ModulesAndHelpers
```
-----------------------------------------------------
```
$curl = curl_init();
$curlOptions = array(
  CURLOPT_HEADER => array("Content-type: multipart/form-data"),
  CURLOPT_HTTPHEADER => array( "Cache-Control: no-cache" ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CONNECTTIMEOUT => 5,
  CURLOPT_TIMEOUT => 5,
  CURLOPT_URL => "some//",
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => urldecode(http_build_query($array)),
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_MAXREDIRS => 6,
  CURLOPT_USERAGENT => 'PHPUNIT',
  CURLOPT_VERBOSE => true
);

curl_setopt_array($curl, $curlOptions);
$data = curl_exec($curl);

$errno     = curl_errno($curl);
$errmsg  = curl_error($curl) ;
$header  = curl_getinfo($curl);
curl_close($curl);
#$result = (array)json_decode($data);

\Codeception\Util\Debug::debug($errno);
\Codeception\Util\Debug::debug($errmsg);
\Codeception\Util\Debug::debug($header);

https://stackoverflow.com/questions/3772096/posting-multidimensional-array-with-php-and-curl
http://xmodulo.com/wget-curl-alternative-linux.html
```
-------------------------------------
```
https://stackoverflow.com/questions/9691367/how-do-i-request-a-file-but-not-save-it-with-wget
http://www.editcorp.com/personal/lars_appel/wget/v1/wget_7.html
https://stackoverflow.com/questions/17699666/post-request-with-wget

exec("wget -qO- $url. " &> /dev/null --post-data='".http_build_query($arPostFields)."' ");

wget -O- http://yourdomain.com > /dev/null
wget -qO- $url &> /dev/null

./app &>  file # redirect error and standard output to file
./app >   file # redirect standard output to fileas
./app 2>  file # redirect error output to file

```
-------------------------------------
```
$Guzzle = new \Codeception\Lib\Connector\Guzzle6;

https://fossies.org/diffs/yii-advanced-app/2.0.10_vs_2.0.11/vendor/codeception/base/src/Codeception/Module/PhpBrowser.php-diff.html
https://fossies.org/diffs/yii-advanced-app/2.0.10_vs_2.0.11/vendor/codeception/base/src/Codeception/Module/PhpBrowser.php-diff.html
http://docs.guzzlephp.org/en/stable/testing.html
```

--------------------------------------------


```
use Codeception\Util\Debug;
Debug::debug("This is working");


\Codeception\Util\Debug::debug('Hello');
\Codeception\Util\Debug::pause();
phpunit --group renamePages --stop-on-failure



grabColumnFromDatabase
\Codeception\Subscriber\GracefulTermination::terminate();
\Codeception\Subscriber\ErrorHandler::shutdownHandler();

http://codeception.com/docs/12-ParallelExecution
http://codeception.com/docs/07-BDD
http://codeception.com/docs-2.0/12-ParallelExecution

https://phpunit.de/manual/current/en/textui.html

CLI: phpunit --stop-on-failure
Info from manual and some others that are maybe useful for you:
stopOnError - "Stop execution upon first error."
stopOnFailure - "Stop execution upon first error or failure."
stopOnIncomplete - "Stop execution upon first incomplete test."

http://phptest.club/t/run-the-same-test-more-than-once/378/11
https://hotexamples.com/examples/codeception.event/SuiteEvent/-/php-suiteevent-class-examples.html
https://hotexamples.com/examples/-/-/verify/php-verify-function-examples.html
https://hotexamples.com/examples/codeception.util/Debug/setOutput/php-debug-setoutput-method-examples.html
https://hotexamples.com/examples/codeception.util/Debug/-/php-debug-class-examples.html
```



```
public function _failed(AcceptanceTester $I)
{
     $I->pauseExecution();
}

public function _failed(AcceptanceTester $I)
{
    $I->makeScreenshot('test_failed_screenshot' . time());
}

if ($codecept->getResult()->failureCount() or $codecept->getResult()->errorCount()) exit(1);
http://codecept.io/basics/#how-it-works
```

```
<?php
/**
 * Codeception PHP script runner
 */

require_once dirname(__FILE__).'/../vendor/codeception/codeception/autoload.php';
use Symfony\Component\Console\Application;
$app = new Application('Codeception', Codeception\Codecept::VERSION);
$app->add(new Codeception\Command\Run('run'));

$app->run();

?>
```


```
https://www.toptal.com/qa/how-to-write-testable-code-and-why-it-matters
https://confluence.jetbrains.com/display/PhpStorm/Debugging+and+Profiling+PHPUnit+and+Behat+Tests+with+PhpStorm
http://codeception.com/docs/05-UnitTests
http://codeception.com/docs/03-AcceptanceTests


http://codeception.com/docs/06-ModulesAndHelpers
http://codeception.com/docs/modules/Asserts
http://codeception.com/docs-1.8/03-ModulesAndHelpers
http://codeception.com/docs/modules/Db
http://codeception.com/docs/09-Data
http://codeception.com/docs/modules/Asserts

http://behat.org/en/latest/
http://behat.org/en/latest/guides.html

https://dannorth.net/whats-in-a-story/
https://dannorth.net/introducing-bdd/
http://phptest.club
```
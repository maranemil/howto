
```
Testing APIs with CodeceptionMatthew Turland
http://matthewturland.com/slides/codeception/#resources
```

```
http://codeception.com/docs/07-AdvancedUsage
http://codeception.com/docs/modules/Filesystem
http://allframeworks.ru/codeception/08-CestFormat.html
```




```
Requirements:
PHP 5.4+ (EOL - upgrade!)
json extension
mbstring extension
Composer
composer require --dev "codeception/codeception:^2"
./vendor/bin/codecept
PHAR
wget http://codeception.com/codecept.phar
curl http://codeception.com/codecept.phar -o codecept.phar
alias codecept="php /path/to/codecept.phar"
```

```
Getting Help
codecept help - general help
codecept list - list commands
codecept help [command] - help for a specific command, e.g. list
```

```
Bootstrap Command
codecept bootstrap -e
-e, --empty - don't create standard suites
Output
codeception.yml - global settings for paths, runners, modules, etc.
tests/
_bootstrap.php - bootstraps test suite, e.g. autoloading
_data/dump.sql - SQL dump loaded between tests
_envs/ - global environment-specific settings
_output/ - test suite output, e.g. log files, coverage reports
_support/ - test suite-specific helper class files
```


```
Composer Autoloader
{
    "autoload": {
        "psr-4": {
            "Vendor\\Subnamespace\\": "src/"
        }
    }
    "autoload-dev": {
        "psr-4": {
            "Vendor\\Tests\\Subnamespace\\": "tests/"
        }
    }
}
```

```
Bootstrap File
// tests/_bootstrap.php

// Add the line below this one
require __DIR__ . '/../vendor/autoload.php';
```


```
Supported Test Formats
Cept - one stand-alone test per file
Cest - one class per file, multiple tests per class
PHPUnit - limited to unit tests
```


```
Cept Example
$I = new ApiTester($scenario);
$I->wantTo('retrieve a single question');
$I->amAuthenticated();
$I->sendGET('2/questions/2');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([
    'id' => 2,
    'text'=>'Are you feeling well?'
]);
```


```
Cest Example
class QuestionCest {
    public function _before(ApiTester $I) {
        // ...
    }
    public function _after(ApiTester $I) {
        // ...
    }
    public function getSingleQuestion(ApiTester $I) {
        // Cept contents without $I assignment go here
    }
    // More test methods go here
}
```


```
Creating a Test Suite
codecept generate:suite api
Output
tests/api.suite.yml
tests/api/_bootstrap.php
tests/_support/Helper/Api.php
```



```
Test Suite Configuration
# tests/api.suite.yml
class_name: ApiTester
modules:
  enabled:
    - \Helper\Api
    # Add the lines below
    - REST:
        # Your base API URL
        url: http://host/api/
        # Can also be a framework module name
        depends: PhpBrowser
        # Limits PhpBrowser to JSON or XML
        part: Json

```



```
Helper Class
// tests/_support/Helper/Api.php
namespace Helper;
// here you can define custom actions
// all public methods declared in helper class will be
// available in $I

class Api extends \Codeception\Module
{

}
```





```
Adding Helper Methods
// tests/_support/Helper/Api.php
namespace Helper;
class Api extends \Codeception\Module {
    public function amAuthenticated(
        $username = 'default_user'
    ) {
        // $token = ...
        $this
            ->getModule('REST')
            ->amBearerAuthenticated($token);
    }
}
```





```
Building Tester Files
codecept build
Output
tests/_support/ApiTester.php
tests/_support/_generated/ApiTesterActions.php
```




```
reating a Cest Class
codecept generate:cest api Thing
// tests/api/ThingCest.php
use ApiTester;
class ThingCest {
    public function _before(ApiTester $I) {
    }
    public function _after(ApiTester $I) {
    }
    // tests
    public function tryToTest(ApiTester $I) {
    }
}
```



```
Using Tester Methods
// tests/api/ThingCest.php
use ApiTester;
class ThingCest {
    public function createThing(ApiTester $I) {
        $I->amAuthenticated('johndoe');
        // ...
    }
}
```



```
REST Module: Requests
// Authentication
$I->amHttpAuthenticated('username', 'password');
$I->amDigestAuthenticated('username', 'password');
$I->amBearerAuthenticated('token');

// Headers
$I->haveHttpHeader('name', 'value');
```





```
REST Module: Requests
// Method / Parameters
$I->sendGET('path/relative/to/url' /* , array $params */);
$I->sendHEAD(...);
$I->sendOPTIONS(...);
$I->sendPOST(
    'url' /* ,
    array|JsonSerializable|string $params,
    array $files
*/);
$I->sendPUT(...);
$I->sendPATCH(...);
$I->sendDELETE(...);
$I->sendLINK(
    'url',
    [ 'linkEntry1', 'linkEntry2', /* ... */ ]
);
$I->sendUNLINK(...);
```



```
REST Module: Responses
$I->dontSeeResponseCodeIs(200);
$I->seeResponseCodeIs(200);

$I->dontSeeHttpHeader('name'/* , 'value' */);
$I->seeHttpHeader('name'/* , 'value' */);
$I->seeHttpHeaderOnce('name');
$value = $I->grabHttpHeader('name', true);
$values = $I->grabHttpHeader('name');

$I->seeResponseEquals('text');
$I->dontSeeResponseContains('text');
$I->seeResponseContains('text');
$response = $I->grabResponse();
```





```
REST Module: JSON
$I->seeResponseIsJson();

$I->seeResponseJsonMatchesXpath('//property');

$I->dontSeeResponseContainsJson(['property' => 'value']);
$I->seeResponseContainsJson(['property' => 'value']);

$I->dontSeeResponseJsonMatchesJsonPath('$.property'); // [1]
$I->seeResponseJsonMatchesJsonPath('$.property');
$data = $I->grabDataFromResponseByJsonPath('$.property');

$I->dontSeeResponseMatchesJsonType(['property' => 'type']); // [2]
$I->seeResponseMatchesJsonType(['property' => 'type']);
```



```
REST Module: XML
$->seeResponseIsXml();

$I->dontSeeXmlResponseEquals('xml string');
$I->seeXmlResponseEquals('xml string');

$I->dontSeeXmlResponseIncludes('xml substring');
$I->seeXmlResponseIncludes('xml substring');

$I->dontSeeXmlResponseMatchesXpath('//element');
$I->seeXmlResponseMatchesXpath('//element');

$attribute = $I->grabAttributeFrom('//element', 'attribute');
$value = $I->grabTextContentFromXmlElement('//element');
```




```
Asserts Module
Adds a lot of assert*() methods from PHPUnit to $I
Useful in conjunction with grab*() methods
Don't forget to run codecept build!
# tests/api.suite.yml
class_name: ApiTester
modules:
  enabled:
    # ...
    - Asserts

// tests/api/ThingCest.php
$response = $I->grabResponse();
$I->assertRegExp('/^foo/', $response);
```



```
Putting It All Together
// tests/api/ThingCest.php
use ApiTester;
class ThingCest {
    public function createThing(ApiTester $I) {
        $I->wantTo('retrieve a single thing');
        $I->amAuthenticated();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('thing', ['name' => 'Foo']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'id' => 1,
            'name' => 'Foo'
        ]);
    }
}
```



```
Data Integration
AMPQ - uses videlalvaro/php-amqplib 1
Db - uses PDO 2
Doctrine2 - uses Doctrine 1 and PDO 2
Memcache - uses memcache 3 or memcached 3
MongoDb - uses mongodb 3
Queue
Iron.io - uses iron-io/iron_mq 1
Beanstalkd - uses pda/pheanstalk 1
Amazon SQS - uses aws/aws-sdk-php 1 and cURL 2
Redis 1
1 Userland library
2 Core extension
3 PECL extension
```




```
Db Module
Executes _data/dump.sql before each test
Drops all database tables after each test
Supports a single database connection and dump file per test suite
Suboptimal for migrations, e.g. Doctrine, Phinx, Liquibase, etc.
# codeception.yml
# ...
modules:
  config:
    Db:
      dsn: ''
      user: ''
      password: ''
      dump: tests/_data/dump.sql
```



```
Creating a Helper
codecept generate:helper Db
// tests/_support/Helper/Db.php
namespace Helper;
// here you can define custom actions
// all public methods declared in helper class will be
// available in $I

class Db extends \Codeception\Module
{

}
```



```
Custom Db Helper
class Db extends \Codeception\Module\Db {
    protected function cleanup() {
        // ...
        $dbh->exec('SET FOREIGN_KEY_CHECKS=0');
        $res = $dbh->query(
            "SHOW FULL TABLES WHERE TABLE_TYPE LIKE '%TABLE'"
        );
        foreach ($res->fetchAll() as $row) {
            $dbh->exec('TRUNCATE TABLE `' . $row[0] . '`');
        }
        $dbh->exec('SET FOREIGN_KEY_CHECKS=1;');
        // ...
    }
}
```

```
Custom Helper Configuration
# tests/api.suite.yml
class_name: ApiTester
modules:
  enabled:
    - \Helper\Db
    # ...
```

```
Database Seeding Strategies
Automatic seeding with Db module or custom subclass
Manual seeding with Db module haveInDatabase() method
API interactions
Libraries like Factory Muffin and Faker
use League\FactoryMuffin\Facade as FactoryMuffin;
$faker = Faker\Factory::create();
FactoryMuffin::define('Model_Login', [
    'first_name' => $faker->firstName,
    'last_name'  => $faker->lastName,
    'email'      => 'unique:safeEmail',
    'password'   => function() {
        return Model_Login::hash_password('password');
    },
]);
```



```
PHP Web Server
composer require --dev "codeception/phpbuiltinserver:^1"
# codeception.yml
extensions:
  enabled:
    - Codeception\Extension\PhpBuiltinServer
  config:
    Codeception\Extension\PhpBuiltinServer:
      # Required
      hostname: localhost
      port: 8000
      documentRoot: ../web
      # Optional
      router: ../web/app.php
      directoryIndex: app.php
      startDelay: 1
      phpIni: /path/to/php.ini
```





```
Running Tests
# All suites
codecept run

# Only the api suite
codecept run api
codecept run tests/api/

# Only the ThingCest class in the api suite
codecept run api ThingTest.php
codecept run tests/api/ThingCest.php

# Only the createThing test in the ThingCest class
# in the api suite
codecept run tests/api/ThingCest.php:createThing
```






```
Environments
codecept generate:env travis

# tests/_envs/travis.yml
# Overrides for settings in codeception.yml go here

codecept run --env travis

# Merge environments
codecept run --env db,travis
```





```
Debugging
Normal methods of output are suppressed by the test runner
Pass any variable or message to the codecept_debug() function
Produces console output similar to var_export()
Specify the --debug flag when invoking the test runner
// tests/api/ThingCest.php
codecept_debug('foo');
codecept_debug(['foo' => 'bar']);
$object = new \stdClass;
$object->foo = 'bar';
codecept_debug($object);

codecept run --debug api ThingCest.php
```







```
Code Coverage Integration
{
    "require-dev": {
        "codeception/c3": "^2"
    },
    "scripts": {
        "post-install-cmd": [
            "Codeception\\c3\\Installer::copyC3ToRoot"
        ],
        "post-update-cmd": [
            "Codeception\\c3\\Installer::copyC3ToRoot"
        ]
    }
}

// web/index.php
include __DIR__ . '/../c3.php';
// ...
```






```
Code Coverage Configuration
# codeception.xml
coverage:
  enabled: true
  c3_url: 'http://host/index.php/'
  # Optional
  whitelist:
    include:
      - app/*
    exclude:
      - app/cache/*
  blacklist:
    include:
      - app/controllers/*
    exclude:
      - app/cache/CacheProvider.php

whitelist - list of files to include even if they are not run
blacklist - list of files to exclude even if they are run
```








```
Code Coverage Invocation
# HTML reports for humans
codecept run --coverage --coverage-html

# XML (Clover) reports for IDEs (e.g. PHPStorm)
# and CI servers (e.g. Jenkins)
codecept run --coverage --coverage-xml

Reports are written to tests/_output/coverage
Raw data is written to tests/_output/c3tmp
```



```
Remote Code Coverage Configuration
Requires xdebug.remote_enable to be set to true

# codeception.yml
coverage:
  # If API is hosted on different machine than tests
  remote: true
  # Optional
  remote_context_options:
    http:
      timeout: 60
    ssl:
      verify_peer: false
```




```
Groups
// tests/api/ThingCest.php
class ThingCest {
    /**
     * @group thing
     */
    public function createThing() {
        // ...
    }
    // ...
}

codecept run -g thing
```






```
Resources
codeception.com
github.com/codeception
phptest.club/category/codeception
#codeception on Freenode
@codeception on Twitter
@davert on Twitter
Acceptance & Functional Testing with Codeception by Joe Ferguson
"Codeception: Testing for Human Beings" by Michael "Davert" Bodnarchuk in php[architect] May 2015 issue
```


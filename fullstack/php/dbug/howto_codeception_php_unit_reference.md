
######
###   UnitTests  codeception
####   https://codeception.com/docs/reference/Commands
####  https://codeception.com/docs/05-UnitTests
######
```
use \Codeception\Util\Debug as UnitDebug;
class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected function _before()    {   }
    protected function _after()    {    }
    // tests
    public function testMe()    {    }
}

class UserTest extends \Codeception\Test\Unit
{
    public function testValidation()
    {
        $user = new User();
        $user->setName(null);
        $this->assertFalse($user->validate(['username']));
        $user->setName('toolooooongnaaaaaaameeee');
        $this->assertFalse($user->validate(['username']));
        $user->setName('davert');
        $this->assertTrue($user->validate(['username']));
    }
}
```

```
/*
ASSERTIONS
$this->assertEquals()
$this->assertContains()
$this->assertFalse()
$this->assertTrue()
$this->assertNull()
$this->assertEmpty()
*/
```

```
// PHPUnit
// https://phpunit.de/manual/6.5/en/appendixes.assertions.html
// https://www.jetbrains.com/help/phpstorm/creating-run-debug-configuration-for-tests.html

use PHPUnit\Framework\TestCase;

class ArrayHasKeyTest extends TestCase
{
    public function testFailure()
    {
        $this->assertArrayHasKey('foo', ['bar' => 'baz']);
    }
}

class ClassHasAttributeTest extends TestCase
{
    public function testFailure()
    {
        $this->assertClassHasAttribute('foo', stdClass::class);
    }
}
```

```
https://codeception.com/docs/reference/Configuration
https://codeception.com/docs/06-ModulesAndHelpers
https://www.droptica.com/blog/codeception-how-start-automatic-tests/
https://apigen.juzna.cz/doc/sebastianbergmann/phpunit/function-assertNotEquals.html
https://phpunit.readthedocs.io/en/8.4/assertions.html
https://phpunit.readthedocs.io/en/7.4/assertions.html
https://codeception.com/docs/modules/Asserts
https://hotexamples.com/de/examples/-/PHPUnit_Framework_Assert/assertNotEquals/php-phpunit_framework_assert-assertnotequals-method-examples.html
```



------------------------------------
### Run Example Test

```
https://codeception.com/docs/05-UnitTests#Classical-Unit-Testing
https://codeception.com/docs/07-AdvancedUsage
https://codeception.com/docs/08-Customization
https://codeception.com/for/laravel
https://codeception.com/docs/02-GettingStarted
https://codeception.com/install

# add
tests/example/0001_ExampleTest.php

#code
class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected function _before() { }
    protected function _after() { }
    // tests
    public function testMe() { }
}

php codecept.phar run example 0001_ExampleTest --debug
```

------------------------------------
### Install Phar Globally
```
sudo curl -LsS https://codeception.com/codecept.phar -o /usr/local/bin/codecept
sudo chmod a+x /usr/local/bin/codecept
```

```
------------------------------------
Really basic class to store data in global array and use it in Cests/Tests.
https://codeception.com/docs/reference/Fixtures
------------------------------------
Fixtures::add('user1', ['name' => 'davert']);
Fixtures::get('user1');
Fixtures::exists('user1');
```

```
------------------------------------
https://codeception.com/docs/07-AdvancedUsage
https://codeception.com/docs/06-ReusingTestCode
https://codeception.com/docs/07-BDD
------------------------------------
namespace Page\Acceptance;

class Login
{
    public static $URL = '/login';

    /**
     * @var AcceptanceTester
     */
    protected $tester;

    // we inject AcceptanceTester into our class
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function login($name, $password)
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
    }
}
```




######
###	Setting global variable for the entire unit test case
######
```
https://stackoverflow.com/questions/38585709/setting-global-variable-for-the-entire-unit-test-case
https://stackoverflow.com/questions/7493102/how-to-output-in-cli-during-execution-of-php-unit-tests

https://hotexamples.com/de/examples/-/Codeception%255CUtil%255CAutoload/-/php-codeception%255cutil%255cautoload-class-examples.html
https://hotexamples.com/de/examples/codeception.event/SuiteEvent/-/php-suiteevent-class-examples.html
https://hotexamples.com/de/examples/-/PHPUnit_Framework_Assert/assertContains/php-phpunit_framework_assert-assertcontains-method-examples.html
https://phpunit.readthedocs.io/en/7.4/assertions.html
https://phpunit.readthedocs.io/en/8.4/assertions.html

https://code-examples.net/de/docs/codeception/reference/configuration
https://github.com/humhub/humhub/blob/master/protected/humhub/modules/user/tests/codeception/_bootstrap.php

https://codeception.com/06-28-2014/unit-testing-with-database.html
https://codeception.com/11-15-2013/codeception-18-phalcon-environments-dataproviders.html
https://codeception.com/docs/02-GettingStarted
https://codeception.com/docs/05-UnitTests
https://codeception.com/docs/06-ModulesAndHelpers
https://codeception.com/docs/06-ReusingTestCode
https://codeception.com/docs/07-AdvancedUsage
https://codeception.com/docs/08-Customization
https://codeception.com/docs/11-Codecoverage
https://codeception.com/docs/modules/Db
https://codeception.com/docs/modules/PhpBrowser
https://codeception.com/docs/reference/Configuration
https://codeception.com/docs/reference/Fixtures
https://codeception.com/docs/reference/Functions
https://codeception.com/extensions
https://codeception.com/install
```

```
https://phpunit.readthedocs.io/en/9.5/
https://codeception.com/quickstart
https://laravel.com/docs/8.x/testing
https://phpunit.readthedocs.io/en/9.5/writing-tests-for-phpunit.html
```
```
__bootstrap.php

class ClassFailedLoginTestData {
    public static $user_id;
}


0001_ClassFailedLoginTest.php

class ClassFailedLoginTest extends \Codeception\Test\Unit
{
    protected $tester;

    public function testA(){
       ClassFailedLoginTestData::$user_id = '100';
    }

    public function testB(){
       //The assertion fails as $this->user_id returns empty.
       assertTrue(ClassFailedLoginTestData::$user_id == 100,"Expected: 100, Actual: {this>user_id}");
    }
}
```
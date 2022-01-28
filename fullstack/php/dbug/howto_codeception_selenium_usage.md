```
####################################################################
#
#	codeception
#	http://codeception.com/docs/modules/PhpBrowser#fillField
#	http://codeception.com/docs/modules/WebDriver#waitForElement
#	http://codeception.com/docs-2.0/04-AcceptanceTests#AJAX-Emulation
#	http://codeception.com/docs/03-AcceptanceTests
#	http://codeception.com/docs/03-AcceptanceTests
#
####################################################################
```
```
php codecept.phar run -v acceptance --xml --steps --debug 
php codecept.phar run acceptance finalCept.php --debug --html

http://codeception.com/docs/reference/Commands
http://codeception.com/docs/02-GettingStarted
https://github.com/Codeception/Codeception
http://codeception.com/docs/modules/PhpBrowser
http://codeception.com/docs/modules/Asserts#expectException
http://codeception.com/docs/modules/WebDriver#grabMultiple
```
```
Usage:

codecept run acceptance: run all acceptance tests
codecept run tests/acceptance/MyCept.php: run only MyCept
codecept run acceptance MyCest:myTestInIt: run one test from a Cest
```
```
Verbosity modes:

codecept run -v:
codecept run --steps: print step-by-step execution
codecept run -vv:
codecept run --debug: print steps and debug information
codecept run -vvv: print internal debug information
```
```
-
Codeception PHP 			http://codeception.com
Behat PHP					http://behat.org/en/latest/

XLT - Xceptance LoadTest	https://www.xceptance.com/en/xlt/
Abmash						https://github.com/alp82/abmash
Endtest						https://endtest.io/

https://www.quora.com/Whats-your-experience-with-moving-from-Behat-to-Codeception
http://stakeholderwhisperer.com/posts/2014/10/introducing-modelling-by-example#_=_
https://www.toptal.com/php/php-testing-with-codeception
https://www.sitepoint.com/ruling-the-swarm-of-tests-with-codeception/
https://www.theaveragedev.com/running-single-tests-in-codeception/
https://robotninja.com/blog/alternative-e2e-testing-services-woocommerce/

https://github.com/Codeception/Codeception

$I->executeJS('return $(".icon-rowExpand:visible").get(0).click()');

$selector = $I->executeJS('return $(".icon-rowExpand:visible:first").getSelector()');
$I->click($selector);

public function clickJQuerySelectedElement($element) {
    $this->executeJS('return $("' . $element . '").get(0).click()');
}
```

```
https://gist.github.com/pastuhov/43674b195dc293ffd847 # tests\codeception\common\_support\AcceptanceHelper  # AcceptanceHelper.php


http://phptest.club/t/fillfield-outside-form/85
http://phptest.club/t/how-to-select-the-option-from-dynamic-dropdown-in-codeception/206
http://phptest.club/t/see-vs-waitfortext/125/7
https://github.com/Codeception/Codeception/issues/758
https://github.com/Codeception/Codeception/issues/3102
http://phptest.club/t/getting-values-from-executejs/1173/3
http://phptest.club/t/how-to-run-java-script-with-codeception/411
```
------------------------------------------------------------------------------------
```
https://www.drupal-blog-berlin.de/blog/automatisierte-tests-mit-codeception
https://www.theaveragedev.com/two-codeception-acceptance-tests-gotchas/


# Waiting for Ajax to complete WebDriver 
$I->amOnPage('/index.php');
$I->click('button.foo');

// some js will fire here and the `foo` query var should be appended to the URL
$I->waitForJs('return jQuery.active == 0', 10);

$I->seeInCurrentUrl('/index.php'); // passing
$I->seeInCurrentUrl('foo=bar'); // failing


$I->amOnPage('/index.php');
$I->click('button.foo');

// some js will fire here and the `foo` query var should be appended to the URL
$I->waitForJs('return jQuery.active == 0', 10);

$fullUrl = $I->executeJS('return location.href');
$I->assertContains('/index.php'); // passing
$I->assertContains('foo=bar'); // passing
```
------------------------------------------------------------------------------------
```
https://www.proudsourcing.de/talks/files/akzeptanztests-fuer-shops-codeception-shopware-scd17_proudsourcing.pdf


// install
 composer require "codeception/codeception" —dev
 // setup
 $ codecept bootstrap
 // create test
 $ codecept generate:cest acceptance First

 <?php
 class FirstCest
 {
	 public function frontpageWorks(AcceptanceTester $I)
	 {
	 	$I->amOnPage('/');
	 	$I->see('Home');
	 }
 }
 ?>
 // run
 codecept run --steps 


$I = new AcceptanceTester($scenario);
$I->wantTo('search for wasser and check if products');
$I->amOnPage('/');
I->fillField('#searchparam','wasser');
$I->click('.searchSubmit');
$I->see('WASSER', 'a#searchList_1');?>


$I = new AcceptanceTester($scenario);
$I->wantTo('login as user');
$I->amOnPage('/Kundenkonto');
$I->fillField('#loginUser','test@proudsourcing.de');
$I->fillField(‚#loginPwd','bliblablubb');
$I->click('#loginButton');
$I->see(‘alle Bestellungen');?> 


...
$I->see('Zahlungsart');
$iframe = $I->executeJS('return $
( "#ppplus" ).find( "iframe" ).attr( "id" )');
$I->switchToIFrame($iframe);
$I->waitForText('Vorauskasse', 30);
$I->click('(//div[@id="Vorauskasse"])[1]');
$I->switchToIFrame();
$I->click('.nextStep');
$I->see('AGB und Widerrufsrecht');
...


<?php
// @env desktop
$I = new AcceptanceTester($scenario);
$I->wantTo('[myProject] search for piano, take the first product, go to the
detail page, add this product to basket');
$I->amOnPage('/');
$I->fillField('.topSearch','piano');
$I->click('.submit');
$I->see('tracks', 'h2');
$I->click('.track_list_title');
$I->click('.open_license_popup');
sleep(2);
$I->see('Standard');
$I->executeJS('return $(".cartbutton").get(0).click()');
$I->amOnPage('/en/checkout/show_cart');
$I->see('Remove'); 
```


```
dektop:
 modules:
 enabled:
 - WebDriver:
 url: https://myshop.com
 window_size: maximize


 mobile:
 modules:
 enabled:
 - PhpBrowser:
 url: https://myshop.com
 headers:
 'User-Agent': Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5
 Build/LMY48B; wv) AppleWebKit/537.36 (KHTML, like Gecko)
 Version/4.0 Chrome/43.0.2357.65 Mobile Safari/537.36


 mobile:
 modules:
 enabled:
 - WebDriver:
 url: https://myshop.com
 host: '<username>:<access key>@hub.browserstack.com'
 port: 80
 browser: chrome
 capabilities:
 os: Windows
 os_version: 10
```

------------------------------------------------------------------------------------
```
http://testing340.blogspot.de/2015/11/
http://testing340.blogspot.de/2015/11/how-selenium-webdriver-locate-element.html
http://testing340.blogspot.de/2015/11/undefined-index-localhost-phpunit.html

    WebDriver m_driver = new FirefoxDriver();
    String redirected_url = "http://ift.tt/1PpC7xE";

    m_driver.get(redirected_url);
    Thread.sleep(15*1000);
    WebElement we = m_driver.findElement(By.xpath(".//*[@id='email']"));
    we.sendKeys("login_email");
    we = m_driver.findElement(By.xpath(".//*[@id='password']"));
    we.sendKeys("login_password");
    we = m_driver.findElement(By.xpath(".//*[@id='btnLogin']"));
    we.click();
```
------------------------------------------------------------------------------------
```
http://codeception.com/11-20-2013/webdriver-tests-with-codeception.html
sudo apt install default-jre
java -jar selenium-server-standalone-2.37.0.jar
https://repo.jenkins-ci.org/releases/org/seleniumhq/selenium/selenium-server-standalone/2.37.0/


http://codeception.com/07-11-2017/drive-your-browser-with-codeception.html

# acceptance.suite.yml
extensions:
    enabled:
        - Codeception\Extension\RunProcess:
            - php -S 127.0.0.1:8000
            - java -jar selenium-server.jar

# or inside environment config
# in this case, run tests as
#
# codecept run --env selenium
env:
  selenium:
    extensions:
        enabled:
            - Codeception\Extension\RunProcess:
                - php -S 127.0.0.1:8000
                - java -jar selenium-server.jar       
```
------------------------------------------------------------------------------------
```
https://searchcode.com/?q=throw+lang%3APHP+lookForwardTo
https://searchcode.com/file/72194785/features/Context/WebUser.php # use Behat\Mink\Exception\ExpectationException;
https://searchcode.com/file/16092032/src/Codeception/AbstractGuy.php  # 
https://searchcode.com/file/72102230/src/Codeception/AbstractGuy.php  #
https://searchcode.com/file/59119167/tests/codecept/src/Codeception/AbstractGuy.php # 
------------------------------------------------------------------------------------
```
```
https://phpunit.de
https://phpunit.de/getting-started-with-phpunit.html

http://www.seleniumhq.org/projects/webdriver/
http://www.seleniumhq.org

https://www.sitepoint.com/testing-php-code-with-atoum-an-alternative-to-phpunit/
https://www.hongkiat.com/blog/automated-php-test/

1. PHPUnit
2. Codeception
3. Behat
4. PHPSpec
5. SimpleTest
6. Storyplayer
7. Peridot
8. Atoum
9. Kahlan
10. Selenium

https://github.com/mockery/mockery
http://phantomjs.org

https://phpunit.de/manual/current/en/phpunit-book.pdf # ***
https://www.cs.colorado.edu/~kena/classes/5828/s12/presentation-materials/hakeemmazinalanezikhaled.pdf
https://scholarlyrepository.miami.edu/cgi/viewcontent.cgi?article=1487&context=oa_theses # Software Engineering in Small Projects: The Most Essential Processes
https://www.cs.indiana.edu/classes/a348/fall2013/finalExam/phpant4pdf.pdf # THE PHP ANTHOLOGY ***


Xvfb :10 -ac
java -jar selenium-server-standalone-2.39.0.jar
php codecept.phar run acceptance --steps


actor: AcceptanceTester
modules:
    enabled:
        #- PhpBrowser:
        #   url: http://127.0.0.1/g
        - WebDriver:
            url: http://127.0.0.1/g
            browser: chrome # 'chrome' or 'firefox'
        #- \Helper\Acceptance

 [ConnectionException] Can't connect to Webdriver at http://127.0.0.1:4444/wd/hub. Please make sure that Selenium Server or PhantomJS is running.
```

------------------------------------------------------------------------------------
```
http://codeception.com/extensions#RunProcess

class_name: AcceptanceTester
modules:
    enabled:
        - WebDriver:
            url: http://127.0.0.1:8080/
            browser: chrome
        - Yii2:
            part: orm
            entryScript: index-test.php
            cleanup: false
extensions:
    enabled:
        - Codeception\Extension\RunProcess:
            0: java -jar /home/tajgeer/.executables/bin/selenium-server.jar
            1: php /home/tajgeer/Repozytoria/Yii2/yii serve
            sleep: 5
```
------------------------------------------------------------------------------------
```
http://codeception.com/11-14-2014/dockerizing-acceptance-testing.html
docker run -i -t -p 4444:4444 davert/selenium-env
docker run -i -t -p 4444:4444 -e APP_HOST=myhost davert/selenium-env

php -S 0.0.0.0:8000
# in new terminal window
docker run -i -t -p 4444:4444 -e APP_PORT=8000 davert/selenium-env 
# in new terminal window
codecept run acceptance

docker run -i -t -p 4444:4444 davert/phantomjs-env

https://github.com/Codeception/SeleniumEnv
https://github.com/Codeception/PhantomJsEnv
https://github.com/travis-ci/travis-cookbooks
https://github.com/Codegyre/RoboCI
```
------------------------------------------------------------------------------------
```
https://code.tutsplus.com/tutorials/headless-functional-testing-with-selenium-and-phantomjs--net-30545

Setup Here's the final stack that we'll be using:

Mocha – test runner
Chai – assertion library
webdriverjs – browser control bindings
Selenium – browser abstraction and running factory
PhantomJS – fast headless browser


sudo npm install -g mocha chai webdriverjs
npm install mocha chai webdriverjs
java -jar selenium-server-standalone-2.28.0.jar
sudo npm install -g phantomjs

RUN
node_modules/mocha/bin/mocha test.js -t 10000
```

------------------------------------------------------------------------------------


```
Codeception: Unreachable field "description"
$I->fillField("//input[@id='description']", 'Another type');
$I->fillField('Description', 'Another type');
$I->fillField("#User0FirstName","Roberto")

https://laracasts.com/discuss/channels/general-discussion/codeception-unreachable-field-description?page=1

Example 

 <?php
$I = new FunctionalTester($scenario);

$I->am('user');
$I->wantTo('perform CRUD actions on AgreementTypes model');

$user = User::find(2); // User 2 is Joe Bloggs
$tenantId = $user->tenant_id;

$I->amLoggedAs($user);

$I->amOnPage('http://demo.interimnew.app/agreementtypes');
$I->see('Agreement type');

# Add a person
$I->click('Add agreement type');
$I->seeInCurrentUrl('create');
$I->fillField('name', 'AT');
$I->fillField('description', 'Another type');
$I->click('Create');
$I->dontSeeInCurrentUrl('create');
$I->seeInDatabase('agreement_types', ['name' => 'AT', 'tenant_id' => $tenantId]);
// $I->see('Another type');

# View a person
$I->click('AT');
$I->see('AT');
$I->see('Another type');

# Edit a person
$I->click('Edit');
$I->seeInCurrentUrl('edit');
$I->fillField('name', 'AAT');
$I->click('Update');
$I->seeInDatabase('agreement_types', ['name' => 'AAT', 'tenant_id' => $tenantId]);

# Archive a person
$I->click('AAT');
$I->click('Edit');
$I->seeInCurrentUrl('edit');
$I->click('Archive');
$I->dontSeeInDatabase('agreement_types', ['name' => 'AAT', 'tenant_id' => $tenantId, 'deleted_at' => null]);

# Unarchive a person
$I->click('View archived');
// $I->click('Bar LLC');
// $I->see('Bar LLC');

$I->logout();
```
```
// Resources


https://github.com/Codeception/Codeception

http://codeception.com/docs/modules/PhpBrowser#sendAjaxGetRequest
http://codeception.com/docs/modules/WebDriver
http://codeception.com/docs/01-Introduction#Sample-integration-test
http://codeception.com/docs/01-Introduction#Pros
http://codeception.com/docs/01-Introduction#Sample-functional-test
http://codeception.com/docs/02-GettingStarted
http://codeception.com/docs/07-AdvancedUsage
http://codeception.com/
http://codeception.com/docs/01-Introduction#Functional-Tests

actor: AcceptanceTester
modules:
    enabled:
       - WebDriver:
           url: 'http://''
           browser: 'phantomjs' // chrome firefox
           #window_size: 1024x768
#    enabled:
#       - PhpBrowser:
#            url: http://''
#       - \Helper\Acceptance

```

```
php codecept run acceptance --env phantom --env chrome --env firefox
php codecept run acceptance --env dev,phantom --env dev,chrome --env dev,firefox
https://github.com/Codeception/Codeception/blob/2.0/tests/README.md

$I->pressKey('#dropdown', WebDriverKeys::ARROW_DOWN, WebDriverKeys::ENTER);

https://phpunit.de/manual/current/en/extending-phpunit.html#extending-phpunit.PHPUnit_Framework_TestListener
https://phpunit.de/manual/current/en/appendixes.annotations.html
https://phpunit.de/manual/current/en/index.html
https://phpunit.de/manual/current/en/writing-tests-for-phpunit.html

http://codeception.com/docs/05-UnitTests
http://codeception.com/docs-1.8/06-UnitTests
http://codeception.com/docs-2.0/06-UnitTests
http://codeception.com/docs/05-UnitTests#Interacting-with-the-Framework
```
######
```
https://stackoverflow.com/questions/21873723/printing-debug-output-to-console-in-codeception
https://dzone.com/articles/practical-php-testing/practical-php-testing-patterns-26
https://phpunit.de/manual/current/en/test-doubles.html
http://blog.jmoz.co.uk/phpunit-mocking-and-method-chaining/
https://gist.github.com/jmoz/5928773


# Print output in debug mode
\Codeception\Util\Debug::debug($this->em);


https://github.com/sebastianbergmann/phpunit

sudo apt-get install phpunit
phpunit --version

composer require phpunit/phpunit
# cat vendor/composer/autoload_classmap.php | grep PHPUnit_Text


https://leanpub.com/practicalsymfony3/read
--

A current workaround is to add the -enablePassthrough false argument when launching Selenium.  -enablePassThrough false
For example:
java -Dwebdriver.gecko.driver=./geckodriver -jar selenium-server-standalone-3.8.1.jar -enablePassThrough false

# symfony/tests/acceptance/AppBundleCest.php

class AppBundleCest
{
 public function _before(AcceptanceTester $I)
 {
 }

public function _after(AcceptanceTester $I)
 {
 }

...
}

https://leanpub.com/practicalsymfony3/read
```
-------------
```
FIX for [Error] Class 'xajaxPluginManager' not found

# include in phpunit method following
require_once __DIR__.'/../../../vendor/xajax/xajax/xajax_core/xajaxResponse.inc.php';
require_once __DIR__.'/../../../vendor/xajax/xajax/xajax_core/xajaxResponseManager.inc.php';
require_once __DIR__.'/../../../vendor/xajax/xajax/xajax_core/xajaxPluginManager.inc.php';


[PHPUnit\Framework\Exception] Undefined index: codeception_phpunit


php code...phar --steps --debug
```
----------------------------------
```
class_name: FunctionalTester
modules:
    enabled:
        - MongoDb:
            dsn: mongodb://mongo:27017/******
            populate: false
            dump_type: mongodump
            dump: tests/_data/dump
        - Phalcon:
            bootstrap: 'app/config/bootstrap.php'
            cleanup: true
            savepoints: true
        - REST:
            depends: Phalcon
            url: 'http://localhost'
        - Asserts
        - \Helper\Functional
```
----------------------------------
```
https://phpunit.de/manual/current/en/fixtures.html
http://www.ryanwright.me/cookbook/phpunit/global
http://blog.jmoz.co.uk/phpunit-mocking-and-method-chaining/
```




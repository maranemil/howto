<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 20.05.16
 * Time: 15:50
 */

/**
 * ###########################################################
 * #
 * # Install PHPUnit in SugarCRM
 * # https://github.com/sebastianbergmann/phpunit/issues/1503
 * #
 * ###########################################################
 *
 * # go to project root
 *
 * # get composer
 * curl -sS https://getcomposer.org/installer | php
 *
 * # config
 * $ cat composer.json
 * {
 * "require-dev": {
 * "phpunit/phpunit": "4.3.*"
 * }
 * }
 *
 * # get/install phpunit
 * $ php composer.phar install
 * Loading composer repositories with package information
 * Installing dependencies (including require-dev)
 * - Installing sebastian/version (1.0.3)
 * Loading from cache
 *
 * - Installing sebastian/exporter (1.0.2)
 * Loading from cache
 *
 * - Installing sebastian/environment (1.2.0)
 * Loading from cache
 *
 * - Installing sebastian/diff (1.2.0)
 * Loading from cache
 *
 * - Installing sebastian/comparator (1.0.1)
 * Loading from cache
 *
 * - Installing symfony/yaml (v2.5.6)
 * Loading from cache
 *
 * - Installing doctrine/instantiator (1.0.4)
 * Loading from cache
 *
 * - Installing phpunit/php-text-template (1.2.0)
 * Loading from cache
 *
 * - Installing phpunit/phpunit-mock-objects (2.3.0)
 * Loading from cache
 *
 * - Installing phpunit/php-timer (1.0.5)
 * Loading from cache
 *
 * - Installing phpunit/php-file-iterator (1.3.4)
 * Loading from cache
 *
 * - Installing phpunit/php-token-stream (1.3.0)
 * Loading from cache
 *
 * - Installing phpunit/php-code-coverage (2.0.11)
 * Loading from cache
 *
 * - Installing phpunit/phpunit (4.3.5)
 * Downloading: 100%
 *
 * phpunit/phpunit suggests installing phpunit/php-invoker (~1.1)
 * Writing lock file
 * Generating autoload files
 *
 * # check if installed
 * $ vendor/bin/phpunit
 * $ ./vendor/bin/phpunit --version
 * PHPUnit 4.3.5 by Sebastian Bergmann.
 *
 * # update composer
 * php composer.phar self-update
 * php composer.phar update --dev
 *
 * # run phpunit from terminal
 * # vendor/bin/phpunit -c app/
 * vendor/bin/phpunit tests/Dbest.php
 */


/*
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.7/Application_Framework/Web_Services/Examples/SOAP/PHP/Creating_or_Updating_a_Record/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.7/Application_Framework/Web_Services/Examples/SOAP/PHP/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.5/Application_Framework/Web_Services/What_is_NuSOAP/
 *
 * https://www.sugaroutfitters.com/blog/unit-testing-with-sugarcrm-and-phpunit
 *
 * https://phpunit.de/getting-started.html
 * https://phpunit.de/manual/current/en/appendixes.annotations.html#appendixes.annotations.test
 * https://phpunit.de/manual/current/en/writing-tests-for-phpunit.html
 *
 * https://github.com/amusarra/sugarcrm_dev_PostgreSQL/blob/master/tests/SugarTestHelper.php
 *
 * https://developer.sugarcrm.com/2015/09/08/creating-javascript-unit-tests-for-sugar-7/
 * https://developer.sugarcrm.com/2015/09/28/creating-a-php-unit-test-for-sugar-7/
 */


/*
 *
# Sugar Composer Update

curl -sS https://getcomposer.org/installer | php
php composer.phar update --dev

php -f test.php
php -c app test.php

*/

// create file in tests/Dbest.php

/**
 * Created by PhpStorm.
 * User: emil
 * Date: 20.05.16
 * Time: 14:22
 */

if (!defined('sugarEntry')) define('sugarEntry', true);

/*
set_include_path(
	dirname(__FILE__) . PATH_SEPARATOR .
	dirname(__FILE__) . '/..' . PATH_SEPARATOR .
	get_include_path()
);*/

// constant to indicate that we are running tests
if (!defined('SUGAR_PHPUNIT_RUNNER'))
	define('SUGAR_PHPUNIT_RUNNER', true);

// initialize the various globals we use
global $sugar_config, $db, $fileName, $current_user, $locale, $current_language;

//require_once('include/entryPoint.php');
//require_once('include/utils/layout_utils.php');
//$GLOBALS['db'] = DBManagerFactory::getInstance();

$current_language = $sugar_config['default_language'];
// disable the SugarLogger
$sugar_config['logger']['level'] = 'fatal';


// define our testcase subclass
class Sugar_PHPUnit_Framework_TestCase extends PHPUnit_Framework_TestCase
{
	protected $backupGlobals = FALSE;
	protected $useOutputBuffering = true;

	protected function assertPreConditions()
	{

	}

	protected function assertPostConditions()
	{

	}

	/** @test */
	public function it_tests_something()
	{
		echo "123";
	}
}

// $ phpunit && jasmine && casperjs
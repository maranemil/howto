```
------------------------
sudo apt install python-pip
pip install -U selenium
--------------------------
sudo apt install composer
wget http://codeception.com/codecept.phar

sudo apt install php7.1-mbstring
sudo apt install php7.1-xml
sudo apt install php7.1-zip

composer require codeception/codeception --dev
```


----------------------------------------

```
{
    "require-dev": {
        "codeception/codeception": "^2.3",
        "facebook/webdriver": "1.5.0"
    }
}

composer update
```

----------------------------------------
```
php codecept.phar bootstrap

File codeception.yml created       <- global configuration
> Unit helper has been created in tests/_support/Helper
> UnitTester actor has been created in tests/_support
> Actions have been loaded
tests/unit created                 <- unit tests
tests/unit.suite.yml written       <- unit tests suite configuration
> Functional helper has been created in tests/_support/Helper
> FunctionalTester actor has been created in tests/_support
> Actions have been loaded
tests/functional created           <- functional tests
tests/functional.suite.yml written <- functional tests suite configuration
> Acceptance helper has been created in tests/_support/Helper
> AcceptanceTester actor has been created in tests/_support
> Actions have been loaded
tests/acceptance created           <- acceptance tests
tests/acceptance.suite.yml written <- acceptance tests suite configuration
```
----------------------------------------
```
php codecept.phar build
Building Actor classes for suites: acceptance, functional, test, unit
 -> AcceptanceTesterActions.php generated successfully. 0 methods added
\AcceptanceTester includes modules: PhpBrowser, \Helper\Acceptance
 -> FunctionalTesterActions.php generated successfully. 0 methods added
\FunctionalTester includes modules: \Helper\Functional
 -> UnitTesterActions.php generated successfully. 0 methods added
\UnitTester includes modules: Asserts, \Helper\Unit
```
----------------------------------------
```
sudo apt install curl php7.1-curl 

php codecept.phar run acceptance 0000_loginCept.php
php codecept run
php codecept run acceptance
php codecept run acceptance SigninCept.php
php codecept run tests/acceptance/SigninCept.php
php codecept run tests/acceptance/SignInCest.php:^anonymousLogin$
php codecept run tests/acceptance/backend
php codecept run tests/acceptance/backend:^login


# Report
php codecept.phar run acceptance --xml --steps --debug
php codecept run --steps --xml --html

# Help
# http://codeception.com/docs/02-GettingStarted#Configuration
php codecept help run


# Real Test
php codecept.phar run -v -d acceptance 0000_IntroCept.php 



# Codeception Test Suite Configuration
#
# Suite for acceptance tests.
# Perform tests in browser using the WebDriver or PhpBrowser.
# If you need both WebDriver and PHPBrowser tests - create a separate suite.

actor: AcceptanceTester
modules:
    enabled:
        - PhpBrowser:
            url: http://site
        - \Helper\Acceptance



```
```
================== 0000_IntroCept.php =======================
<?php
// do something
$I = new AcceptanceTester($scenario);
$I->am('user');
$I->wantTo('see website');
$I->lookForwardTo('see if local server works');
//$I->comment("");
$I->amOnPage('/');
$I->see('Apache2 Ubuntu Default Page');
================== 0000_IntroCept.php =======================
```




```
// https://pypi.python.org/pypi/selenium
// http://docs.seleniumhq.org/download/
// http://codeception.com/install
```
--------------------------------------------
```
http://www.seleniumhq.org/download/
https://goo.gl/hvDPsK # selenium-server-standalone-3.8.1.jar
# Usage:
java -jar "/home/emil/selenium-server-standalone-3.8.1.jar"
wget http://selenium-release.storage.googleapis.com/3.4/selenium-server-standalone-3.4.0.jar
wget http://selenium-release.storage.googleapis.com/3.4/selenium-server-standalone-3.8.1.jar


# http://codeception.com/docs/modules/WebDriver#_getUrl
```

```
================== acceptanceweb.suite.yml =========================
# Codeception Test Suite Configuration
#
# Suite for acceptance tests.
# Perform tests in browser using the WebDriver or PhpBrowser.
# If you need both WebDriver and PHPBrowser tests - create a separate suite.

actor: AcceptanceTester
modules:
    enabled:
        - WebDriver:
            url: http://somewebsite
            browser: firefox
            window_size: 1024x768
        - \Helper\Acceptance
        browser: chrome # 'chrome' or 'firefox'
================== acceptanceweb.suite.yml =========================
```

######
### install chrome
######
```
sudo apt-get install libxss1 libappindicator1 libindicator7
wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
sudo dpkg -i google-chrome*.deb
sudo apt-get install -f


wget -N https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb -P ~/
sudo dpkg -i --force-depends ~/google-chrome-stable_current_amd64.deb
sudo apt-get -f install -y
sudo dpkg -i --force-depends ~/google-chrome-stable_current_amd64.deb
```
```
############################################
# java -jar selenium-server-standalone-3.3.1.jar -role hub
# java -jar selenium-server-standalone-3.3.1.jar -role node -hub http://localhost:4444/grid/register
# https://seleniumhq.github.io/docs/grid.html
# java -Dwebdriver.chrome.driver="C:\driver\chromedriver.exe" -jar selenium-server-standalone-3.6.0.jar -role node -hub http://192.168.0.8:4444/grid/register
# java -Dwebdriver.chrome.driver=chromedriver.exe -jar selenium-server-standalone.jar -role node -nodeConfig node1Config.json
############################################
 ```
 ```
##########################################################################
# 
# Install Chrome, ChromeDriver and Selenium on Ubuntu 16.04 
# https://gist.github.com/ziadoz/3e8ab7e944d02fe872c3454d17af31a5
#
###############################################################################

------------------------------------- install.sh  -------------------------------------------

#!/usr/bin/env bash
# https://developers.supportbee.com/blog/setting-up-cucumber-to-run-with-Chrome-on-Linux/
# https://gist.github.com/curtismcmullan/7be1a8c1c841a9d8db2c
# http://stackoverflow.com/questions/10792403/how-do-i-get-chrome-working-with-selenium-using-php-webdriver
# http://stackoverflow.com/questions/26133486/how-to-specify-binary-path-for-remote-chromedriver-in-codeception
# http://stackoverflow.com/questions/40262682/how-to-run-selenium-3-x-with-chrome-driver-through-terminal
# http://askubuntu.com/questions/760085/how-do-you-install-google-chrome-on-ubuntu-16-04

# Versions
CHROME_DRIVER_VERSION=`curl -sS chromedriver.storage.googleapis.com/LATEST_RELEASE`
SELENIUM_STANDALONE_VERSION=3.4.0
SELENIUM_SUBDIR=$(echo "$SELENIUM_STANDALONE_VERSION" | cut -d"." -f-2)

# Remove existing downloads and binaries so we can start from scratch.
sudo apt-get remove google-chrome-stable
rm ~/selenium-server-standalone-*.jar
rm ~/chromedriver_linux64.zip
sudo rm /usr/local/bin/chromedriver
sudo rm /usr/local/bin/selenium-server-standalone.jar

# Install dependencies.
sudo apt-get update
sudo apt-get install -y unzip openjdk-8-jre-headless xvfb libxi6 libgconf-2-4

# Install Chrome.
sudo curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add
sudo echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list
sudo apt-get -y update
sudo apt-get -y install google-chrome-stable

# Install ChromeDriver.
wget -N http://chromedriver.storage.googleapis.com/$CHROME_DRIVER_VERSION/chromedriver_linux64.zip -P ~/
unzip ~/chromedriver_linux64.zip -d ~/
rm ~/chromedriver_linux64.zip
sudo mv -f ~/chromedriver /usr/local/bin/chromedriver
sudo chown root:root /usr/local/bin/chromedriver
sudo chmod 0755 /usr/local/bin/chromedriver

# Install Selenium.
wget -N http://selenium-release.storage.googleapis.com/$SELENIUM_SUBDIR/selenium-server-standalone-$SELENIUM_STANDALONE_VERSION.jar -P ~/
sudo mv -f ~/selenium-server-standalone-$SELENIUM_STANDALONE_VERSION.jar /usr/local/bin/selenium-server-standalone.jar
sudo chown root:root /usr/local/bin/selenium-server-standalone.jar
sudo chmod 0755 /usr/local/bin/selenium-server-standalone.jar
```


```
--------------------------------  start-chrome.sh ------------------------------
#!/usr/bin/env bash

# Run Chrome via Selenium Server
start-chrome() {
    xvfb-run java -Dwebdriver.chrome.driver=/usr/local/bin/chromedriver -jar /usr/local/bin/selenium-server-standalone.jar
}

start-chrome-debug() {
    xvfb-run java -Dwebdriver.chrome.driver=/usr/local/bin/chromedriver -jar /usr/local/bin/selenium-server-standalone.jar -debug
}

# Run Chrome Headless
start-chrome-headless() {
    chromedriver --url-base=/wd/hub
}

# Start
# start-chrome
# start-chrome-debug
# start-chrome-headless
```
--------------
```
Working
java -Dwebdriver.chrome.driver=/usr/local/bin/chromedriver -jar /usr/local/bin/selenium-server-standalone.jar -debug
```


```
================== 0000_IntroCept.php =======================
<?php

#use frontend\tests\AcceptanceTester;
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/');
$I->fillField('email_address','@some');
$I->fillField('password','123456789');
$I->click('submitLogin');
$I->wait(3);
$I->see('Welcome to ...');
================== 0000_IntroCept.php =======================
```

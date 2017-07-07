<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 09.12.16
 * Time: 12:21
 */


ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('html_errors', FALSE);
ini_set('ignore_repeated_errors', true);
ini_set('ignore_repeated_source', true);
if (!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
global $db;

include "install/install_utils.php";
// install/demoData.en_UK.php
// install/performSetup.php

installerHook('pre_installDemoData');
global $current_user;
$current_user = new User();
$current_user->retrieve(1);
include("install/populateSeedData.php");
installerHook('post_installDemoData');
installLog("done populating the db with seed data");

/*
 *
#################################################################
#
#   Tidbit Install
#   https://github.com/sugarcrm/Tidbit
#
#################################################################

cd apps/sugarcrm/htdocs
wget https://github.com/sugarcrm/Tidbit/archive/master.zip
unzip master.zip; mv Tidbit-master Tidbit; cd Tidbit

php -f install_cli.php -- -o -u 4090
# Tidbit should be run with "./bin/tidbit" or "./vendor/bin/tidbit" instead

curl -sS https://getcomposer.org/installer | php
php composer.phar install
./bin/tidbit -o -u 400

PHP Fatal error:  Cannot use 'Elastica\Filter\Bool' as class name as it is reserved in /SugarEnt-Full-7.7.2.0/data/visibility/ACLVisibility.php on line 96

 */


/*
 *

#################################################################
#
#  Tidbit uses a command line interface.  To run it from the Tidbit directory
#
# https://github.com/sugarcrm/Tidbit/pull/24/commits/320a77e4f7a18e036edb57aed69343ec8f3c31fe
# https://github.com/ruflin/Elastica/issues/903
# https://github.com/ruflin/Elastica/issues/918
#
####################################################################

-    $ php -f install_cli.php
+    $ ./bin/tidbit (or ./vendor/bin/tidbit for package dependency installation)

 Various options are available to control the number of entries generated.
 To view them:

-    $ php -f install_cli.php -- -h
+    $ ./bin/tidbit -h

 Example usages:

     * Clean out existing seed data when generating new data set:
-      $ php -f install_cli.php -- -c
+      $ ./bin/tidbit -c

     * Insert 500 users:
-      $ php -f install_cli.php -- -u 500
+      $ ./bin/tidbit -u 500

     * Generate data into csv (mysql is default):
-      $ php -f install_cli.php -- --storage csv
+      $ ./bin/tidbit --storage csv

     * Generate records for all out-of-box and custom modules, plus find all relationships
-      $ php -f install_cli.php -- --allmodules --allrelationships
+      $ ./bin/tidbit --allmodules --allrelationships

     * Obliterate all data when generating new records with 400 users:
-      $php -f install_cli.php -- -o -u 400
-
+      $ ./bin/tidbit -o -u 400
+
+    * Use profile (pre-existing one: simple, simple_rev2, average, high) file to generate data
+      $ ./bin/tidbit -o --profile simple --sugar_path /some/sugar/path
+
+    * Use custom profile (located in /path/to/profile/file)
+      $ ./bin/tidbit -o --profile /path/to/profile --sugar_path /some/sugar/path
+
     * Generate TeamBasedACL action restrictions for chosen level (check level options in config files)
-      $php -f install_cli.php -- -o --tba -tba_level full
+      $ ./bin/tidbit -o --tba -tba_level full

     * Controlling INSERT_BATCH_SIZE (MySQL Support only for now)
-      $php -f install_cli.php -- -o --insert_batch_size 1000
+      $ ./bin/tidbit -o --insert_batch_size 1000

     * Setting path to SugarCRM installation
-      $php -f install_cli.php -- -o --sugar_path /some/sugar/path
+      $ ./bin/tidbit -o --sugar_path /some/sugar/path

     * Using DB2 storage example (mysql/oracle/db2 can be used, depending on Sugar installation and DB usage)
-      $php -f install_cli.php -- -o --sugar_path /some/sugar/path --storage db2
+      $ ./bin/tidbit -o --sugar_path /some/sugar/path --storage db2
 */
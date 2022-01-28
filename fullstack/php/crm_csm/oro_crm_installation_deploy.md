### Problem 1

```
    - oro/platform 1.4.4 requires doctrine/doctrine-fixtures-bundle 2.2.0 -> no matching package found.
    - oro/platform 1.4.4 requires doctrine/doctrine-fixtures-bundle 2.2.0 -> no matching package found.
    - oro/platform 1.4.4 requires doctrine/doctrine-fixtures-bundle 2.2.0 -> no matching package found.
    - Installation request for oro/platform == 1.4.4.0 -> satisfiable by oro/platform[1.4.4].
```

### Potential causes:

```
 - A typo in the package name
 - The package is not available in a stable-enough version according to your minimum-stability setting
   see <https://groups.google.com/d/topic/composer-dev/_g3ASeIFlrc/discussion> for more details.
```

######
### Oro Installation & Deploy Symfony Composer

```
git clone -b 1.4.1 https://github.com/orocrm/crm-application.git 	# clone specific version from github
git clone -b 1.3.2 https://github.com/orocrm/crm-application.git 	# clone specific version from github
git clone -b 1.3.1 https://github.com/orocrm/crm-application.git 	# clone specific version from github
git clone -b 1.3.0 https://github.com/orocrm/crm-application.git 	# clone specific version from github ####
git clone -b 1.2.0 https://github.com/orocrm/crm-application.git 	# clone specific version from github ####
```
```
# mysqlnd  in xampp  - API Extensions 	mysqli,mysql,pdo_mysql  - PDO drivers 	mysql, pgsql, sqlite

# What kind of drivers Doctrine suports:
# pdo_mysql, pdo_sqlite, pdo_pgsql, pdo_oci, oci8, ibm_db2, pdo_ibm, pdo_sqlsrv, mysqli, drizzle_pdo_mysql, sqlsrv

 private static $_driverMap = array(
	'pdo_mysql' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
	'pdo_sqlite' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
	'pdo_pgsql' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
	'pdo_oci' => 'Doctrine\DBAL\Driver\PDOOracle\Driver',
	'oci8' => 'Doctrine\DBAL\Driver\OCI8\Driver',
	'ibm_db2' => 'Doctrine\DBAL\Driver\IBMDB2\DB2Driver',
	'pdo_ibm' => 'Doctrine\DBAL\Driver\PDOIbm\Driver',
	'pdo_sqlsrv' => 'Doctrine\DBAL\Driver\PDOSqlsrv\Driver',
	'mysqli' => 'Doctrine\DBAL\Driver\Mysqli\Driver',
	'drizzle_pdo_mysql' => 'Doctrine\DBAL\Driver\DrizzlePDOMySql\Driver',
	'sqlsrv' => 'Doctrine\DBAL\Driver\SQLSrv\Driver',
);


curl -sS https://getcomposer.org/installer | php
php composer.phar self-update
#php composer.phar install
php composer.phar install --prefer-dist --no-dev
php app/console oro:install
#php app/console oro:install --env prod --drop-database

php app/console cache:clear
#php app/console oro:entity-extend:cache:clear
#php app/console doctrine:cache:clear-metadata

php app/console oro:install --force --drop-database	# reinstall

php composer.phar remove
php composer.phar show --platform
```

-----------------------------------------------------
######
# Oro Installation Hooks Symfony Composer
#

-----------------------------------------------------
```
sudo apt-get update

php -i | grep -i soap 							# check soap status
php -i | grep -i curl 							# check curl status
php -i | grep -i intl 							# check intl status

php -i |grep php\.ini 							# check php cli
php-cli -v
php -i | grep ICU
------------------------------------------------

sudo apt-get install curl 						# install curl
sudo apt-get install php5-intl 						# install php-intl
sudo apt-get install php5-curl 						# install php-curl
sudo apt-get install php-soap 						# install soap if not found

sudo apt-get autoremove 						# remove unused packages

-----------------------------------------------------

git clone https://github.com/orocrm/crm.git 				# clone packages to be installed
git clone https://github.com/orocrm/platform.git 			# optional
git clone -b 1.2.0 https://github.com/orocrm/crm-application.git 	# clone specific version from github
git clone -b 1.4.1 https://github.com/orocrm/crm-application.git 	# clone specific version from github
git clone -b 1.6.0 https://github.com/orocrm/crm-application.git 	# clone specific version from github
git clone http://github.com/orocrm/crm-application.git 			# clone packages to be installer

curl -sS https://getcomposer.org/installer | php

php composer.phar install 						# because this way brings errors on dependency i use "required"
php composer install --no-dev --optimize-autoloader			#
php composer.phar install --prefer-dist --no-dev 			# recomandaton from oro git
php composer.phar update 						# update packages composer
php composer.phar self-update						# update composer
php composer.phar require besimple/soap-client "~0.2" --prefer-dist 	# intall dependencies
# Set on composer installation driver "mysqli".


#!/bin/sh
php composer.phar diagnose

php composer.phar require "doctrine/doctrine-fixtures-bundle 2.2.*"
php composer.phar require doctrine/doctrine-fixtures-bundle:2.1.*@dev
php composer.phar require doctrine/doctrine-orm-module 0.9.*@dev
php composer.phar require doctrine/mongodb-odm-bundle
php composer.phar require doctrine/doctrine-orm-module
php composer.phar require doctrine/doctrine-fixtures-bundle

php composer.phar update doctrine/doctrine-fixtures-bundle
php composer.phar update

php app/console oro:entity-extend:cache:clear
php app/console oro:entity-extend:backup
php app/console oro:entity-extend:clear
php app/console oro:entity-config:init
php app/console oro:entity-extend:init
php app/console oro:entity-extend:update-config

php app/console oro:entity-extend:clear
php app/console oro:entity-config:init
php app/console oro:entity-extend:init
php app/console oro:entity-extend:update-config

//also with prod environment
php app/console oro:entity-extend:clear -e prod
php app/console oro:entity-config:init -e prod
php app/console oro:entity-extend:init -e prod
php app/console oro:entity-extend:update-config -e prod

php app/console doctrine:fixtures:load
php app/console doctrine:mongodb:fixtures:load
php app/console doctrine:fixtures:load --fixtures=/path/to/fixture1 --fixtures=/path/to/fixture2 --append --em=foo_manager

php app/console doctrine:migrations:generate
php app/console doctrine:migrations:status --show-versions
php app/console doctrine:migrations:migrate 20100621140655
php app/console doctrine:migrations:diff
php app/console doctrine:migrations:migrate

php app/console doctrine:mapping:info


php app/console doctrine:database:drop --force
php app/console doctrine:database:create

php app/console doctrine:cache:clear-metadata

php app/console doctrine:schema:create --dump-sql
php app/console doctrine:schema:update --force
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force --no-debug --no-interaction
php app/console doctrine:schema:update --force
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force --dump-sql
php app/console doctrine:schema:update --dump-sql --force
php app/console doctrine:schema:drop --force
php app/console doctrine:schema:drop --force --full-database

php app/console doctrine:schema:validate
[Mapping]  OK - The mapping files are correct.
[Database] OK - The database schema is in sync with the mapping files.
```

-----------------------------------------------------
```
php app/console doctrine:database:create --dump-sql --env=test --connection=seconddb
php app/console doctrine:schema:drop --force --dump-sql --no-interaction --env=test --em=seconddb
php app/console doctrine:schema:update --force --no-interaction --env=test --em=seconddb

php app/console doctrine:generate:entity
php app/console doctrine:generate:entities AppBundle/Entity/Product
php app/console doctrine:generate:entities AppBundle # generates all entities in the AppBundle
php app/console doctrine:generate:entities Acme # generates all entities of bundles in the Acme namespace
```
-----------------------------------------------------
```
php composer.phar search stof
php composer.phar show stof/doctrine-extensions-bundle
php app/console cache:clear
```
-----------------------------------------------------
```
php app/console oro:install
php app/console oro:entity-config:init
php app/console oro:entity-config:update
php app/console oro:entity-config:debug 	# not defined
php app/console oro:entity-extend:init
php app/console oro:entity-extend:update-config
php app/console oro:entity-extend:migration:update-config
php app/console oro:entity-extend:update-config
php app/console oro:entity-extend:cache:warmup
php app/console oro:entity-extend:update-schema
php app/console oro:entity-extend:cache:clear
```
-----------------------------------------------------
```
php app/console doctrine:database:drop --force --env=test --connection=default
php app/console doctrine:database:create --env=test --connection=default
php app/console doctrine:schema:drop --force --no-interaction --env=test --em=default
php app/console doctrine:schema:update --force --no-interaction --env=test --em=default

php app/console doctrine:database:drop --force --env=test --connection=seconddb
php app/console doctrine:database:create --env=test --connection=seconddb
php app/console doctrine:schema:drop --force --dump-sql --no-interaction --env=test --em=seconddb
php app/console doctrine:schema:update --force --no-interaction --env=test --em=seconddb

php app/console doctrine:migrations:migrate --em="default"
php app/console doctrine:migrations:migrate --em="orm"
```
-----------------------------------------------------
```
The Schema-Tool would execute "29" queries to update the database.
Please run the operation by passing one - or both - of the following options:
php app/console doctrine:schema:update --force to execute the command
php app/console doctrine:schema:update --dump-sql to dump the SQL statements to the screen
```
-----------------------------------------------------
```
php composer.phar update
rm -rf app/cache/*
rm -rf web/js/*
rm -rf web/css/*
#database_driver: mysqli
php app/console oro:platform:update --env=prod --force
```
-----------------------------------------------------
```
php app/console cache:clear --env=prod
rm -rf app/cache/*
chmod 777 -R app/cache/
chmod -R 777 app/cache/
chmod -R 777 app/logs/


php app/console cache:clear --env=prod
rm -rf app/cache/*
```
-----------------------------------------------------
```
php app/console oro:search:create-index
php app/console doctrine:fixture:load --no-debug --no-interaction
php app/console oro:acl:load
php app/console oro:navigation:init

php app/console assets:install web
php app/console assetic:dump

php composer.phar update --prefer-dist
php app/console assetic:dump

chmod -R 777 app/cache/
chmod -R 777 app/logs/

php composer.phar update --prefer-dist --no-dev
php composer.phar dump-autoload

php app/console doctrine:database:create
```
-----------------------------------------------------
```
sudo setfacl -R -m u:www-data:rwX -m u:whoami:rwX app/cache app/logs
sudo setfacl -dR -m u:www-data:rwx -m u:whoami:rwx app/cache app/log

chmod -R ug=rwx,o=rx app/cache
chmod -R ug=rwx,o=rx app/logs

php app/console fos:js-routing:dump --target=web/js/routes.js
php app/console assetic:dump

php composer.phar update --prefer-dist
php app/console assetic:dump

php composer.phar install --prefer-dist
php composer.phar update --prefer-dist
php app/console cache:clear --env prod
```
-----------------------------------------------------
```
php app/check.php
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
php app/console cache:clear --env=prod --no-debug
php app/console cache:clear --env=prod
php app/console cache:clear -e prod
php app/console list --no-debug

php  app/console oro:platform:check-requirements
```
-----------------------------------------------------
```
#File: install.sh
#!/bin/sh
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console oro:search:create-index
php app/console doctrine:fixture:load --no-debug --no-interaction
php app/console oro:acl:load
php app/console oro:navigation:init
php app/console assets:install web
php app/console assetic:dump

chmod -R 777 app/cache/
chmod -R 777 app/logs/

//umask(0000);

rm app/cache/dev
rm app/cache/prod
etc...
```
-----------------------------------------------------
```
php > umask(0);
// Should get created as 666
php > touch('file1.txt');

// "2" perms revoked from group, others, gets created as 644
php > umask(022);
php > touch('file2.txt');

// All revoked (2,4) from group, others, gets created as 600
php > umask(066);
php > touch('file3.txt');

-rw-rw-rw-   1 me  group     0 Aug 24 15:34 file1.txt
-rw-r--r--   1 me  group     0 Aug 24 15:35 file2.txt
-rw-------   1 me  group     0 Aug 24 15:37 file3.txt
```
-----------------------------------------------------
```


Add php into your path environment variable and then cd to the project
C:/wamp/www/yourproject

php -m | grep intl

and then run the command
php app/console generate:bundle --nampespace=IDP/IDP_Bundle --format=yml
```
-----------------------------------------------------
```
//umask(0000);
```
-----------------------------------------------------
```
su www-data -c "php app/console cache:clear --env=prod"
```
-----------------------------------------------------
```
exec("php /my/project/app/console cache:clear --env=prod");
touch app/console && chmod +x app/console
```
-----------------------------------------------------
```
ini_set('error_reporting', E_ALL);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
```
-----------------------------------------------------
```
xampp settings
find /home/~/ -type f -iname '*.txt' -exec grep -i '/opt/lampp/' {} +
php /opt/lampp/bin/php -f app/console cache:clear --env=prod --no-debug
```


-----------------------------------------------------
```
oro install steps
https://github.com/orocrm/crm-application/blob/master/web/install.php

<span><?php echo $translator->trans('process.step.check.header'); ?></span>
<span><?php echo $translator->trans('process.step.configure'); ?></span>
<span><?php echo $translator->trans('process.step.schema'); ?></span>
<span><?php echo $translator->trans('process.step.setup'); ?></span>
<span><?php echo $translator->trans('process.step.final'); ?></span>
```
---------------------------------------------------------------------------
```
Composer Help:

Options:
 --help (-h)           Display this help message.
 --quiet (-q)          Do not output any message.
 --verbose (-v|vv|vvv) Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug.
 --version (-V)        Display this application version.
 --ansi                Force ANSI output.
 --no-ansi             Disable ANSI output.
 --no-interaction (-n) Do not ask any interactive question.
 --profile             Display timing and memory usage information
 --working-dir (-d)    If specified, use the given directory as working directory.

Available commands:
 about            Short information about Composer
 archive          Create an archive of this composer package
 browse           Opens the package's repository URL or homepage in your browser.
 clear-cache      Clears composer's internal package cache.
 clearcache       Clears composer's internal package cache.
 config           Set config options
 create-project   Create new project from a package into given directory.
 depends          Shows which packages depend on the given package
 diagnose         Diagnoses the system to identify common errors.
 dump-autoload    Dumps the autoloader
 dumpautoload     Dumps the autoloader
 global           Allows running commands in the global composer dir ($COMPOSER_HOME).
 help             Displays help for a command
 home             Opens the package's repository URL or homepage in your browser.
 info             Show information about packages
 init             Creates a basic composer.json file in current directory.
 install          Installs the project dependencies from the composer.lock file if present, or falls back on the composer.json.
 licenses         Show information about licenses of dependencies
 list             Lists commands
 remove           Removes a package from the require or require-dev
 require          Adds required packages to your composer.json and installs them
 run-script       Run the scripts defined in composer.json.
 search           Search for packages
 self-update      Updates composer.phar to the latest version.
 selfupdate       Updates composer.phar to the latest version.
 show             Show information about packages
 status           Show a list of locally modified packages
 update           Updates your dependencies to the latest version according to composer.json, and updates the composer.lock file.
 validate         Validates a composer.json
```
----------------------------------------
```
Symfony version 2.3.6 - app/dev

Usage:
  [options] command [arguments]

Options:
  --help           -h Display this help message.
  --quiet          -q Do not output any message.
  --verbose        -v|vv|vvv Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  --version        -V Display this application version.
  --ansi              Force ANSI output.
  --no-ansi           Disable ANSI output.
  --no-interaction -n Do not ask any interactive question.
  --shell          -s Launch the shell.
  --process-isolation    Launch commands from shell as a separate process.
  --env            -e The Environment name.
  --no-debug          Switches off debug mode.
  --jms-job-id        The ID of the Job.

Available commands:
  help                                        Displays help for a command
  list                                        Lists commands
akeneo
  akeneo:batch:job                            Launch a registered job instance
api
  api:doc:dump
assetic
  assetic:dump                                Dumps all assets to the filesystem
assets
  assets:install                              Installs bundles web assets under a public web directory
cache
  cache:clear                                 Clears the cache
  cache:warmup                                Warms up an empty cache
clank
  clank:server                                Starts the Clank Servers
config
  config:dump-reference                       Dumps default configuration for an extension
container
  container:debug                             Displays current services for an application
doctrine
  doctrine:cache:clear-metadata               Clears all metadata cache for an entity manager
  doctrine:cache:clear-query                  Clears all query cache for an entity manager
  doctrine:cache:clear-result                 Clears result cache for an entity manager
  doctrine:database:create                    Creates the configured databases
  doctrine:database:drop                      Drops the configured databases
  doctrine:ensure-production-settings         Verify that Doctrine is properly configured for a production environment.
  doctrine:fixtures:load                      Load data fixtures to your database.
  doctrine:generate:crud                      Generates a CRUD based on a Doctrine entity
  doctrine:generate:entities                  Generates entity classes and method stubs from your mapping information
  doctrine:generate:entity                    Generates a new Doctrine entity inside a bundle
  doctrine:generate:form                      Generates a form type class based on a Doctrine entity
  doctrine:mapping:convert                    Convert mapping information between supported formats.
  doctrine:mapping:import                     Imports mapping information from an existing database
  doctrine:mapping:info                       Shows basic information about all mapped entities
  doctrine:query:dql                          Executes arbitrary DQL directly from the command line.
  doctrine:query:sql                          Executes arbitrary SQL directly from the command line.
  doctrine:schema:create                      Executes (or dumps) the SQL needed to generate the database schema
  doctrine:schema:drop                        Executes (or dumps) the SQL needed to drop the current database schema
  doctrine:schema:update                      Executes (or dumps) the SQL needed to update the database schema to match the current mapping metadata
  doctrine:schema:validate                    Validates the doctrine mapping files
escape
  escape:wsseauthentication:nonces:delete     Delete nonces
fos
  fos:js-routing:debug                        Displays currently exposed routes for an application
  fos:js-routing:dump                         Dumps exposed routes to the filesystem
generate
  generate:bundle                             Generates a bundle
  generate:controller                         Generates a controller
  generate:doctrine:crud                      Generates a CRUD based on a Doctrine entity
  generate:doctrine:entities                  Generates entity classes and method stubs from your mapping information
  generate:doctrine:entity                    Generates a new Doctrine entity inside a bundle
  generate:doctrine:form                      Generates a form type class based on a Doctrine entity
init
  init:acl                                    Mounts ACL tables in the database
jms-job-queue
  jms-job-queue:clean-up                      Cleans up jobs which exceed the maximum retention time.
  jms-job-queue:mark-incomplete               Internal command (do not use). It marks jobs as incomplete.
  jms-job-queue:run                           Runs jobs from the queue.
lexik
  lexik:maintenance:lock                      Lock access to the site while maintenance...
  lexik:maintenance:unlock                    Unlock access to the site while maintenance...
orm
  orm:convert:mapping                         Convert mapping information between supported formats.
oro
  oro:assetic:groups                          Information about oro assetics
  oro:assets:install                          Installs bundles web assets under a public web directory
  oro:cron                                    Cron commands launcher
  oro:cron:channels:sync                      Runs synchronization for channel
  oro:cron:cleanup                            Clear cron-related log-alike tables: queue, etc
  oro:cron:imap-sync                          Synchronization emails via IMAP
  oro:cron:magento:cart:expiration            Runs synchronization for magento channels to process expiration of merged carts
  oro:cron:send-reminders                     Send reminders
  oro:entity-config:cache:clear               Clears the entity config cache.
  oro:entity-config:init                      Initialize configuration data for entities.
  oro:entity-config:update                    Updates configuration data for entities.
  oro:entity-extend:backup                    Backup database table(s)
  oro:entity-extend:cache:clear               Clears the extended entity cache.
  oro:entity-extend:cache:warmup              Warms up the extended entity cache.
  oro:entity-extend:migration:update-config   Updates extended entities configuration during a database structure migration process. This is an internal command. Please do not run it manually.
  oro:entity-extend:update-config             Prepare entity config
  oro:entity-extend:update-schema             Synchronize extended and custom entities metadata with a database schema
  oro:install                                 Oro Application Installer.
  oro:integration:reverse:sync
  oro:localization:dump                       Dumps oro js-localization
  oro:migration:data:load                     Load data fixtures.
  oro:migration:dump                          Dump existing database structure.
  oro:migration:load                          Execute migration scripts.
  oro:navigation:init                         Load "Title Templates" from annotations and config files to db
  oro:package:available                       List of available packages
  oro:package:demo:load                       Load demo data from specified package(s) to your database.
  oro:package:install                         Installs package from repository
  oro:package:installed                       List of installed packages
  oro:package:update                          Updates package if new version is available
  oro:package:updates                         Lists available updates for installed packages
  oro:platform:check-requirements             Empty command to check requirements
  oro:platform:run-script                     Run PHP script files in scope application container.
  oro:platform:update                         Execute platform application update commands and init platform assets.
  oro:report:update                           Update report transactional tables
  oro:requirejs:build                         Build single optimized js resource
  oro:search:create-index                     Creates fulltext index for search_index_text table
  oro:search:index                            Internal command (do not use). Process search index queue.
  oro:search:reindex                          Rebuild search index
  oro:theme:list                              List of all available themes
  oro:translation:dump                        Dumps oro js-translations
  oro:translation:pack                        Dump translation messages and optionally upload them to third-party service
  oro:user:create                             Create user.
  oro:user:update                             Update user.
  oro:workflow:definitions:load               Load workflow definitions from configuration files to the database
  oro:wsse:generate-header                    Generate X-WSSE HTTP header for a given user
router
  router:debug                                Displays current routes for an application
  router:dump-apache                          Dumps all routes as Apache rewrite rules
  router:match                                Helps debug routes by simulating a path info match
server
  server:run                                  Runs PHP built-in web server
swiftmailer
  swiftmailer:debug                           Displays current mailers for an application
  swiftmailer:email:send                      Send simple email message
  swiftmailer:spool:send                      Sends emails from the spool
translation
  translation:update                          Updates the translation file
twig
  twig:lint                                   Lints a template and outputs encountered errors
```
----------------------------

### Doctrine
```
doctrine:query:sql
doctrine:query:dql

doctrine:schema:drop
doctrine:schema:validate
doctrine:schema:create
doctrine:schema:update         --dump-sql

doctrine:mapping:import
doctrine:mapping:info
doctrine:mapping:convert

doctrine:database:drop
doctrine:database:create

doctrine:fixtures:load

doctrine:generate:crud
doctrine:generate:entity
doctrine:generate:form
doctrine:generate:entities

doctrine:cache:clear-query
doctrine:cache:clear-result
doctrine:cache:clear-metadata

doctrine:ensure-production-settings
```
-----------------
```
vendor/bin/doctrine-module orm:validate-schema
vendor/bin/doctrine-module orm:schema-tool:update --force

[Mapping]  OK - The mapping files are correct.
[Database] FAIL - The database schema is not in sync with the current mapping file.

[Mapping] OK - The mapping files are correct.
[Database] FAIL - The database schema is not in sync with the current mapping file.

php app/console doctrine:schema:validate
php app/console doctrine:mapping:info --em=customer2
php app/console doctrine:schema:update --dump-sql --em=customer2

php app/console doctrine:schema:update --force
php app/console doctrine:schema:update --dump-sql


php --version
mysql --version

help orm:generate-entities

https://travis-ci.org/Ecodev/gims/jobs/40285179
```

---------------

```
./app/console doctrine:database:drop --connection=default --force
./app/console doctrine:database:create --connection=default
./app/console doctrine:schema:create --em=prod
./app/console init:acl
./app/console doctrine:schema:update --dump-sql --env=prod


app/console oro:platform:update --force --env=prod
app/console oro:platform:update --force
```
-----------------------------------------------------
```
oro:platform:check-requirements
oro:platform:update
oro:platform:run-script


oro:platform:update
doctrine:generate:form
oro:platform:run-script
oro:platform:check-requirements

php_flag xdebug.default_enable Off
php_flag xdebug.overload_var_dump Off
php_flag xdebug.show_exception_trace Off
php_value xdebug.trace_format 1


if (function_exists('xdebug_disable')) {
   xdebug_disable();
 }

 xdebug.remote_autostart=0
 xdebug.remote_enable=0

http://www.develodesign.co.uk/blog/item/149-how-to-install-orocrm
http://ka.lpe.sh/2013/06/20/how-to-install-orocrm/
```
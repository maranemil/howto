
```
########################################################

Fabien Potencier / Symfony 4 in action
https://www.youtube.com/watch?v=yfTLx-fcJio

########################################################
```

```
# traditional install
symfony new --full my_project

# api install
symfony new my_project

#demo install
symfony new demo --version=dev-master --debug

#tree _i vendor
#find . type -f | wc -l
# composer show | wc -l
```


```
symfony server:start -d
symfony server:log

composer req maker
composer req debug
composer req annot
composer req twig
composer req orm admin api
composer req symfony/mailer
composer req twig/inky-extension
composer req symfony/mailgun-mailer
composer req messenger
composer req symfony/console

./bin/console list make
./bin/console make:controller
./bin/console make:controller DefaultController
./bin/console make:twig-extension
./bin/console make:entit< Product --api-resource

./bin/console doctrine:database:create
./bin/console doctrine:schema:update --force

./bin/console messenger:consume
```





### symfony5 create project

```

composer create-project symfony/skeleton helloworld
cd helloworld
composer req twig
composer req make
composer req doctrine
composer req doctrine/annotations
composer req annotations
#composer req symfony/orm-pack

php bin/console make::controller
Helloworld

/**
* @Route("/")
* @Method({"GET"}) 
*/

php bin/console doctrine:database:create 
php bin/console make:entity Article 
```

- - - - - - - - -- - - - - - - - -- - - - - - - - -
### install symfony skeleton
- - - - - - - - -- - - - - - - - -- - - - - - - - -

```

# composer create-project symfony/skeleton:"5.4.*" app_symfony
# composer create-project symfony/symfony app_symfony

composer create-project symfony/skeleton app_symfony

cd app_symfony
touch .env

 doctrine/doctrine-bundle  instructions:
  * Modify your DATABASE_URL config in .env
  * Configure the driver (postgresql) and
    server_version (13) in config/packages/doctrine.yaml


composer require symfony/orm-pack
composer require vlucas/phpdotenv
composer require symfony/webapp-meta
composer require symfony/webapp-pack
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
composer require logger
composer require symfony/messenger
composer require monolog/monolog
composer require symfony/contracts
composer require symfony/dependency-injection
composer require symfony/filesystem
composer require mailgun-mailer

composer require symfony/cache-contracts
composer require symfony/event-dispatcher-contracts
composer require symfony/deprecation-contracts
composer require symfony/http-client-contracts
composer require symfony/service-contracts
composer require symfony/translation-contracts

php bin/console about
symfony server:start

https://symfony.com/doc/4.0/setup/built_in_web_server.html
https://symfony.com/doc/current/components/contracts.html
https://symfony.com/doc/current/components/filesystem.html
https://symfony.com/doc/current/configuration/override_dir_structure.html
https://symfony.com/doc/current/components/dependency_injection.html
https://packagist.org/packages/symfony/contracts
https://docs.gitlab.com/ee/user/packages/composer_repository/
https://alanstorm.com/composer-path-repositories/
https://symfony.com/doc/current/doctrine.html
https://packagist.org/packages/vlucas/phpdotenv
https://symfony.com/doc/4.1/components/dotenv.html
https://symfony.com/doc/3.3/components/dotenv.html
https://github.com/symfony/symfony
https://symfony.com/doc/current/setup.html
https://symfony.com/doc/current/messenger.html

- - - - - - - - -- - - - - - - - -- - - - - - - - -
install skeleton
- - - - - - - - -- - - - - - - - -- - - - - - - - -

composer create-project symfony/website-skeleton 
composer require symfony/messenger
composer require symfony/mailer
composer require symfony/serializer
composer require symfony/google-mailer
symfony serve

# config/packages/mailer.yaml
# config/packages/dev/mailer.yaml

docker run -d -p 5672:5672 -p 15672:15672 rabbitmq:3-management

https://woutercarabain.com/webdevelopment/how-to-create-a-simple-application-using-symfony-and-react-native-part-3/
https://symfony.com/doc/current/messenger.html
https://symfony.com/doc/current/mailer.html
https://symfony.com/doc/current/setup.html

- - - - - - - - -- - - - - - - - -- - - - - - - - -
Unable to read the "../.dev.env" environment file in Dotenv.php:symfony
- - - - - - - - -- - - - - - - - -- - - - - - - - -
The "--ignore" option does not exist.  
                                         

create-project [-s|--stability STABILITY] [--prefer-source] 
[--prefer-dist] [--repository REPOSITORY] [--repository-url REPOSITORY-URL] [--add-repository] [--dev] [--no-dev] 
[--no-custom-installers] [--no-scripts] [--no-progress] [--no-secure-http] [--keep-vcs] [--remove-vcs] [--no-install] 
[--ignore-platform-reqs] [--] [<package> [<directory> [<version>]]]

composer require --dev symfony/dotenv
```



```
https://symfony.com/doc/current/mailer.html
https://symfonycasts.com/screencast/mailer/embedded-image

<img src="cid:myimage">
```



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

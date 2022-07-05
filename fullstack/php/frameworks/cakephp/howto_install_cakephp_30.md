```
#############################################
#
#	CakePHP 3
#
# 	CakePHP 3 Tutorial - part 1: Introduction & Installation by J.B.J. Programming
#	https://www.youtube.com/watch?v=LCcRsteVBns
#
#	CakePHP 3 Tutorial - part 3: Routing & Views
#	https://www.youtube.com/watch?v=tbgsmNWosb0
#
#	CakePHP 3 Tutorial - part 4: Authentication
#	https://www.youtube.com/watch?v=eASSNS1f3V4
#
#	http://book.cakephp.org/2.0/es/getting-started.html
#	http://book.cakephp.org/3.0/en/controllers/components/authentication.html
#	http://book.cakephp.org/3.0/en/development/routing.html#resource-routes		#Creating RESTful Routes
#
#	CakePHP login and registration DEMO
#	https://github.com/bradtraversy/mylogin
#
#############################################
```

```
mkdir cakeproject
cd cakeproject
#php -r "readfile('https://getcomposer.org/installer');" | php
curl -sS https://getcomposer.org/installer | php
mv composer.phar /user/local/bin/composer
composer --version

php composer.phar create-project --prefer-dist cakephp/app bookmarker
cd app/bookmarker
bin/cake server

bin/cake bake all users
bin/cake bake all bookmarks
bin/cake bake all tags

bin/cake migrations create Initial
bin/cake migrations migrate
```

*
* 
```
# http://api.cakephp.org/3.2/class-Cake.Auth.DefaultPasswordHasher.html
# http://book.cakephp.org/3.0/en/controllers/components/authentication.html

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{

	protected function _setPassword($password){
		if (strlen($password) > 0) {
		  return (new DefaultPasswordHasher)->hash($password);
		}
	}
}
```


*
* 
```
# http://book.cakephp.org/2.0/en/views/json-and-xml-views.html
 Router::parseExtensions("json","xml");
```
*
* 
```
# http://book.cakephp.org/2.0/en/core-utility-libraries/httpsocket.html

App::uses('HttpSocket', 'Network/Http');
$HttpSocket = new HttpSocket();
// string query
$results = $HttpSocket->get('http://www.google.com/search', 'q=cakephp');
// array query
$results = $HttpSocket->get('http://www.google.com/search', array('q' => 'cakephp'));
```
*
* 
```
# http://book.cakephp.org/3.0/en/core-libraries/httpclient.html

use Cake\Network\Http\Client;
$http = new Client();
```
*
* 
```
CakePHP 3 Videos
-------------------------------------------------
https://www.youtube.com/watch?v=747K6W40ur0	CakePHP 3.1 Login & Registration From Scratch - Part 1
https://www.youtube.com/watch?v=Yi3eqAjK_po	CakePHP 3.1 Login & Registration From Scratch - Part 2
https://www.youtube.com/watch?v=CJA2K6bioFw	Faster application development with CakePHP 3.0 - José Lorenzo
https://www.youtube.com/watch?v=rBRy5BiCeew	Advanced querying with the new CakePHP 3.0 ORM - José Rodríguez
```



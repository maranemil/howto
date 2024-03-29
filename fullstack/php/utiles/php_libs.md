```
################################################
#
#   Xajax
#
################################################
```
```
-- Xajax
https://github.com/Xajax/Xajax
https://www.a-coding-project.de/ratgeber/ajax/xajax
https://sourceforge.net/projects/xajax/
-- Xajax alternativs
https://sourceforge.net/projects/phplivex/
https://phery-php-ajax.net/
https://github.com/spantaleev/sijax

https://github.com/Codeception/Codeception
https://packagist.org/search/?query=xajax
https://github.com/Xajax/Xajax
https://exakat.readthedocs.io/en/latest/Introduction.html
https://github.com/JProof/Xajax-PHP-7
https://gist.github.com/CatoTH/bafaea6426424151d8cc
```
```
################################################
#
#  wsdl2php
#
################################################
```
```
https://github.com/rquadling/wsdl2php
https://github.com/jbarciauskas/wsdl2php
https://github.com/rquadling/wsdl2php/blob/master/wsdl2php.php
https://packagist.org/packages/besimple/wsdl2php
https://packagist.org/packages/hostnet/wsdl2php
https://www.dimuthu.org/blog/2008/09/21/wsdl2php-2-minutes-introduction/7
```
```

################################################
#
#   OP-Cache
#
################################################
```
```
https://catswhocode.com/phpcache/
https://dzone.com/articles/how-to-create-a-simple-and-efficient-php-cache
http://www.php-cache.com/en/latest/
https://www.php.net/manual/de/mysqlnd-qc.quickstart.caching.php
https://www.php.net/manual/en/function.apc-load-constants.php
https://catswhocode.com/phpcache/
https://symfony.com/doc/4.1/components/cache.html
https://www.w3schools.com/php/func_filesystem_clearstatcache.asp
```
```
################################################
#
#   php promise
#
################################################
```
```
https://github.com/reactphp/promise
http://docs.php-http.org/en/latest/components/promise.html
https://github.com/guzzle/promises
```

```
################################################
#
#	Xajax
#
################################################
```
```
https://github.com/Xajax/Xajax
https://acapf.dharmiweb.net/docs/class-xajaxCometResponse.html
https://phpro.org/tutorials/Asynchronous-Form-Submission-With-Xajax.html
https://www.theregister.co.uk/Print/2007/11/20/creating_jsf_portlets/
https://github.com/Xajax/Xajax
https://hotexamples.com/de/examples/-/xajaxResponse/append/php-xajaxresponse-append-method-examples.html
http://hackergarage.github.io/ThaFrame/xajax/xajaxResponse.html#methodxajaxResponse
https://github.com/Xajax/Xajax
https://phpro.org/tutorials/Introduction-To-Xajax.html
http://www.wissensarchiv.org/doku.php?id=xajax:05:synchronous
https://hotexamples.com/de/examples/-/xajaxResponse/addIncludeScript/php-xajaxresponse-addincludescript-method-examples.html
https://github.com/XoopsDocs/kaotik-module-tutorial/tree/master/source/tutorial_part_3_complete/tutorial/class/xajax
https://github.com/enicmaio/orfeo/tree/master/include/xajax
https://hotexamples.com/examples/-/xajaxResponse/script/php-xajaxresponse-script-method-examples.html
https://github.com/Xajax/Xajax/tree/master/examples
https://forum.codeigniter.com/index.php
https://exakat.readthedocs.io/en/latest/Introduction.html#what-is-exakat
https://www.theregister.com/Print/2007/11/20/creating_jsf_portlets/
https://sourceforge.net/projects/tikiwiki/


public function ajax_refreshCart()
 {
     $objResponse = new xajaxResponse();
     $objResponse->clear("cart-contents", "innerHTML");
     $objResponse->append("cart-contents", "innerHTML", $this->getCartTemplate());
     return $objResponse;
 }

function removeHandler($sId, $sHandler)
{
    $objResponse = new xajaxResponse();
    $objResponse->removeHandler($sId, "click", $sHandler);
    $objResponse->append('log', 'innerHTML', "{$sHandler} disabled.<br />");
    return $objResponse;
}

function confirm($seconds)
{
 sleep($seconds);
 $objResponse = new xajaxResponse();
 $objResponse->append('outputDIV', 'innerHTML', '<br />confirmation from theFrame.php call');
 return $objResponse;
}


include 'xajax/xajax_core/xajax.inc.php';
$objResponse = new xajaxResponse();
$objResponse->addAssign("validationMessage","innerHTML","Catalog Id is Valid");
$objResponse->addAssign("journal","value",$journal);
$objResponse->addAssign("submitForm","disabled",true);
return $objResponse->getXML();


Command 	Description
Assign		Sets the specified attribute of an element in input page with method addAssign().
Append		Appends data to the specified attribute of an element in the input page with method addAppend().
Prepend		Prepends data to the specified attribute of an element in the input page with method addPrepend().
Replace		Replaces data in the specified attribute of an element in the input page with method addReplace().
Script		Runs the specified JavaScript code with method addScript().
Alert		Displays an alert box with the specified message with method addAlert().


https://github.com/Xajax/Xajax/blob/master/xajax_core/xajaxResponse.inc.php
https://www.smarty.net/forums/viewtopic.php?p=46488
https://hotexamples.com/de/examples/-/-/addhttp/php-addhttp-function-examples.html
https://hotexamples.com/de/examples/-/xajaxResponse/-/php-xajaxresponse-class-examples.html
https://github.com/pkkann/enrollment_sys
https://hotexamples.com/de/examples/-/xajaxResponse/Script/php-xajaxresponse-script-method-examples.html


function someName($someVar) {
   	// new xajaxResponse Object
	$objResponse = new xajaxResponse();
	$html = $smarty->fetch("layout.tpl");
   	// assign the html code
   	$objResponse->assign("layout","innerHTML",$html);
   	return $objResponse;
}


function someName($someJson) {
   	// new xajaxResponse Object
	$objResponse = new xajaxResponse();
	$myVarJson = json_decode(urldecode(someJson));
	$someId = utf8_encode(urldecode($myVarJson->id));
	 $strHTML = ComponentManager::getInstance()->getComponent(
		__CLASS__,
		"xAjax" . __CLASS__,
		array('template' => 'some_template',
		 'my_var' => $someId
		)
	)->getOutput();
	$objResponse->call('callbackSomeFunction', $strHTML);
   	return $objResponse;
}
```




```
################################################
#
#   sajax
#
################################################
```
```
http://absinth.modernmethod.com/sajax/
https://www.a-coding-project.de/ratgeber/ajax/sajax
https://github.com/Fusion/s2ajax/tree/master
https://github.com/AJenbo/Sajax
```
```
################################################
#
#   oauth
#
################################################
```
```
https://oauth.net/code/php/
https://github.com/thephpleague/oauth2-server
https://github.com/bshaffer/oauth2-demo-php
https://oauth.net/specs/
https://reqbin.com/req/nfilsyk5/get-request-example
https://gist.github.com/wildiney/b0be69ff9960642b4f7d3ec2ff3ffb0b
https://docs.php-http.org/en/latest/message/authentication.html
https://www.autorouter.aero/wiki/api/php-api-sample-with-curl/
https://developer.okta.com/blog/2019/05/07/php-token-authentication-jwt-oauth2-openid-connect
https://www.techiediaries.com/php-jwt-authentication-tutorial/
https://www.php.net/manual/en/features.http-auth.php
https://www.php.net/manual/en/oauth.getaccesstoken.php
https://laravel.com/docs/5.8/api-authentication
https://symfony.com/doc/4.0/security/api_key_authentication.html
https://auth0.com/docs/libraries/auth0-php/using-the-authentication-api-with-auth0-php
https://developers.docusign.com/docs/esign-rest-api/sdk-tools/php/auth/
```

######
#
###   php sdk
######

- https://packagist.org/packages/juststeveking/php-sdk#v2.0.0
- https://github.com/JustSteveKing/php-sdk
 
### guzzle psr7
- https://github.com/guzzle/psr7
- https://docs.guzzlephp.org/en/stable/psr7.html

### adodb
- https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getassoc
- https://hotexamples.com/examples/-/DB/getAssoc/php-db-getassoc-method-examples.html
- https://hotexamples.com/examples/-/DB/get_row/php-db-get_row-method-examples.html
- https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getall
- https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getrow
- https://hotexamples.com/examples/-/DB/adodb/php-db-adodb-method-examples.html
- https://adodb.org/dokuwiki/doku.php?id=v5:userguide:active_record&s[]=get&s[]=all
- https://adodb.org/dokuwiki/doku.php?id=v5:userguide:error_handling
- https://github.com/ADOdb/ADOdb
- https://adodb.org/dokuwiki/doku.php
- https://github.com/ADOdb/ADOdb/releases/tag/v5.22.0

### monolog

```
https://github.com/Seldaek/monolog
https://stackify.com/php-monolog-tutorial/
http://seldaek.github.io/monolog/doc/01-usage.html
https://symfony.com/doc/current/logging.html
https://zetcode.com/php/monolog/
https://hotexamples.com/examples/-/Monolog%255CLogger/pushHandler/php-monolog%255clogger-pushhandler-method-examples.html
https://hotexamples.com/examples/-/Monolog%255CLogger/-/php-monolog%255clogger-class-examples.html
https://betterstack.com/community/guides/logging/php/how-to-start-logging-with-monolog
https://www.loggly.com/ultimate-guide/php-logging-libraries/
https://documentation.solarwinds.com/en/success_center/loggly/content/admin/php-monolog.htm


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');


$logger = new MonologLogger('channel-name');
$app->container->logger = $logger;

require_once(DIR.'/vendor/autoload.php');
use MonologLogger;
use MonologHandlerStreamHandler;

$logger = new Logger('channel-name');
$logger->pushHandler(new StreamHandler(DIR.'/app.log', Logger::DEBUG));
$logger->info('This is a log! ^_^ ');
$logger->warning('This is a log warning! ^_^ ');
$logger->error('This is a log error! ^_^ ');
```


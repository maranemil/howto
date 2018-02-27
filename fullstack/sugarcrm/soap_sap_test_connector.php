<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 05.05.15
 * Time: 12:36
 */

/////////////////////////////////////////////////////
//
// Entry Point
//
/////////////////////////////////////////////////////

if (!defined('sugarEntry')) define('sugarEntry', true);
define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');

/**
 * soap info: http://devzone.zend.com/25/php-soap-extension/
 */

header("Content-Type: text/html; charset=utf-8");
//header('Content-Type: text/xml; ');

/////////////////////////////////////////////////////
//
// Init PHP Settings
//
/////////////////////////////////////////////////////

ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

ini_set("soap.wsdl_cache", "0");
ini_set("soap.wsdl_cache_dir", "/tmp");
//ini_set("soap.wsdl_cache_enabled", "1");
//ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
ini_set("soap.wsdl_cache_ttl", "86400");
ini_set("soap.wsdl_cache_enabled", "0");
//ini_set('soap.wsdl_cache_ttl', '0');

ini_set('default_socket_timeout', 1); // set timeout

/*
https://www.hgb-leipzig.de/~uklaus/PHP/soap.configuration.html
http://php.net/manual/de/soap.configuration.php#ini.soap.wsdl-cache-ttl

ini_set ( 'soap.wsdl_cache_enabled', true );
ini_set ( 'soap.wsdl_cache_ttl', 86400	 );
ini_set ( 'soap.wsdl_cache_limit', 5	 );
ini_set ( 'soap.wsdl_cache', true );
*/




/////////////////////////////////////////////////////
//
// Load Soap Classes
//
/////////////////////////////////////////////////////

require('service/core/SugarSoapService.php');
require('vendor/nusoap//nusoap.php');
//require('service/core/PHP5Soap.php');

/////////////////////////////////////////////////////
//
// Set Constants / zugangsdaten
//
/////////////////////////////////////////////////////

define("SAP_DOMAIN", "sap.server:8000");
define("SAP_WSDL_URI", 'http://' . SAP_DOMAIN . '/url?wsdl');
define("SAP_USER", 'sapuser');
define("SAP_PWD", 'sappass');

/**
 * Die folgenden Optionen werden erkannt:
 *
 * 'soap_version' ('soapVersion') - Die zu verwendende SOAP Version (SOAP_1_1 oder SOAP_1_2).
 * 'classmap' ('classMap') welche verwendet werden kann um einige WSDL Typen auf PHP Klassen zu mappen.
 * Die Option muß ein Array mit WSDL Typen als Schlüssel und Namen von PHP Klassen als Werte sein.
 * 'encoding' - Interne Zeichen Kodierung (UTF-8 wird immer als externe Kodierung verwendet).
 * 'wsdl' welcher dem Aufruf von setWsdl($wsdlValue) entspricht.
 * Das Ändern dieser Option kann das Zend_Soap_Client Objekt von oder zum WSDL Modus wechseln.
 * 'uri' - Der Ziel-Namespace für den SOAP Service (benötigt im nicht-WSDL Modus, funktioniert nicht im WSDL Modus).
 *
 * 'location' - Die URL der Anfrage (benötigt im nicht-WSDL Modus, funktioniert nicht im WSDL Modus).
 * 'style' - Anfrage Stil (funktioniert nicht im WSDL Modus): SOAP_RPC oder SOAP_DOCUMENT.
 * 'use' - Methode zum Verschlüsseln von Nachrichten (funktioniert nicht im WSDL Modus): SOAP_ENCODED oder SOAP_LITERAL.
 * 'login' und 'password' - Login und Passwort für eine HTTP Authentifizierung.
 * 'proxy_host', 'proxy_port', 'proxy_login', und 'proxy_password' - Eine HTTP Verbindung über einen Proxy Server.
 * 'local_cert' und 'passphrase' - HTTPS Client Authentifizierungs Optionen für Zertifikate.
 *
 * 'compression' - Komprimierungs Optionen; das ist eine Kombination von SOAP_COMPRESSION_ACCEPT, SOAP_COMPRESSION_GZIP
 * und SOAP_COMPRESSION_DEFLATE Optionen welche wie folgt verwendet werden können:
 */

// Create Params for Soap Connection
$initSoapOptions = array(
	"location" => SAP_WSDL_URI,
	'uri' => 'http://sap.server:8000',
	//'uri'           => "http://localhost/Sugar/",
	//"soapaction"  => "urn:sap-com:document:sap:rfc:functions",
	"style" => 'SOAP_RPC',
	//'style'       => 'SOAP_DOCUMENT',
	'use' => 'SOAP_LITERAL',
	//"use"         => 'SOAP_ENCODED',
	//'soap_version'=> 'SOAP_1_2',
	'soap_version' => 'SOAP_1_2|SOAP_1_1',
	"trace" => true,
	"exceptions" => true,
	'login' => SAP_USER,
	'password' => SAP_PWD,
	'compression' => 'SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP',
	//'compression' => 'SOAP_COMPRESSION_DEFLATE',
	'features' => 'SOAP_SINGLE_ELEMENT_ARRAYS',
	'encoding' => 'UTF-8', //
	//'encoding'      => 'ISO-8859-1',
	'cache_wsdl' => 0,
	//'cache_wsdl'    => 'WSDL_CACHE_NONE',
	'connection_timeout' => 5, // timeout 5 second

	// Extra Params
	//'proxy_host'  => 'example.com', // Do not add the schema here (http or https). It won't work.
	//'proxy_port'  => 44300,
	// Auth credentials for the proxy.
	//'proxy_login'  => NULL,
	//'proxy_password' => NULL,
	//'local_cert'  => 'cert_key.pem'
	//'passphrase'  => $passphrase
);

//Create Params for SOAP QUERY
$paramsSAP = array(
	"IS_MAX_CNT" => "9",
	"IS_DATA" => array(
		// new call Exception: SOAP-ERROR: Encoding: object has no 'FIELDNAME' property
		"FIELDNAME" => "value*",
	)
);

/* $params2 = array( new SoapParam("IS_MAX_CNT", "9")); */

try {
	$client = new SoapClient("http://localhost//Sugar/YourWSDL.xml", $initSoapOptions);

	/** The solution (as described in https://bugs.php.net/bug.php?id=46130&edit=1)
	 * was to edit the WDSL(xml) file manually to change the following line:
	 *
	 * <wsp:UsingPolicy wsdl:required="true"/>
	 * to this one
	 * <wsp:UsingPolicy wsdl:required="false"/>
	 *
	 */

	/*if (!$client){
		//throw new Exception('Soap Verbindung fehlgeschlagen.');
		die('Soap Verbindung fehlgeschlagen');
	}*/

	// Create Header ...
	//
	// https://scn.sap.com/thread/3700576
	// http://php.net/manual/de/soapheader.soapheader.php
	// http://algorytmy.pl/doc/php/function.soap-soapheader-construct.php
	// http://www.php-resource.de/forum/php-developer-forum/96486-php-new-soapheader-print.html

	/*
	$auth = new stdClass(); //define a basic class object
	$auth->userName = SAP_USER;
	$auth->password = SAP_PWD;
	$authvalues = new SoapVar($auth, SOAP_ENC_OBJECT);
	$headers[] = new SoapHeader('OpGetIncident', 'AuthenticationInfo', $authvalues, false);
	$client->__setSoapHeaders($header);
	*/

	/*
	class SOAPStruct
	{
		public function Authentication($user, $pass)
		{
			$this ->Username = $user;
			$this ->Password = $pass;
		}
	}

	$auth = new SOAPStruct();
	$token = $auth->Authentication(SAP_USER, SAP_PWD);
	$header = new SoapHeader(null, "Authentication", $token, false); // "http://0003427388-one-off.sap.com/YGYHI4A8Y_"
	SoapHeader ($namespace, $name, $data = null, $mustunderstand = false, $actor = null)
	//Set SOAPHeader
	$client -> __setSoapHeaders($header);
	*/

	try {

		$result = (array)$client->Z_GET_INFO_SAP($paramsSAP);
		//$result = $client->__call(?);
		//$result = $client->__soapCall(?);

		//Returns list of available SOAP functions described in the WSDL for the Web service.
		$resultfuncts = $client->__getFunctions(); # OK
		//print "Request: \n".htmlspecialchars($client->__getLastRequest()) ."\n";
		//print "Response: \n".htmlspecialchars($client->__getLastResponse())."\n";

		//$result = $client->__getLastRequest();
		//$result = $client->Login($params);
	} catch (Exception $e) {
		/*} catch (SoapFault $e) {}*/

		echo $e->getMessage();

		/*class MyException extends Exception { }
		throw new MyException('Division durch Null.');
		$ret_str = "<br>-----------------------------------<br>";
		$ret_str .= "new call Exception: ";
		$ret_str .= $e->faultstring . "\n\n";
		$ret_str .= "<br>----------------------------------<br>";*/
	}

} catch (Exception $e) {
	echo $e->getMessage();
	//throw new Exception('Soap Verbindung fehlgeschlagen.');
	//$ret_str = "new SoapClient Exception: ";
	//$ret_str .= $e->faultstring . "\n\n";
}

print "<pre>";
print_r($client);
print "</pre>";
print "<hr />";
echo trim($result[ET_ADDRESSDATA]->item[0]->CITY); // utf8_decode
print "<hr />";

print "<pre>";
print_r($result);
print_r((array)$resultfuncts);
print "</pre>";

die();
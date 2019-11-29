<?php

##############################################################
#
# Test Auth Asendia
#
##############################################################

/*
Adélia Wiki  Base de connaissances Adélia Studio  Articles de conseil
Comment construire un WSDL à partir de plusieurs WSDL
https://pid.hardis.fr/confluence/pages/viewpage.action?pageId=225056909


Un fichier WSDL peut être "éclaté" en plusieurs fichiers grâce aux directives d'import :

wsdl:import : importation d'un autre fichier WSDL
xsd:import : importation d'un schéma XML.
Certains outils (dont Adélia Studio) n'accepte pas d'inscrire un service web à partir d'un fichier WSDL "éclaté".
Reconstruire un fichier WSDL unique (Flat WSDL) à partir de ces différentes origines/composantes est fastidieux.

Dans le SDK windows (à partir de windows 7), WCF (Windows Communication Fondation) offre un outil, nommé  svcutil.exe, qui permet de traiter cette opération.
La commande est la suivante :

svcutil /t:metadata urlService?singleWSDL
Le fichier est produit dans le répertoire courant.

Exemple :
C:\Program Files (x86)\Microsoft SDKs\Windows\v7.0A\Bin>svcutil /t:metadata
https://uat.centiro.com/Universe.Services/TMSBasic/Wcf/c1/i1/TMSBasic/TMSBasic.svc?singleWSDL

Note : Dans certains cas, le fichier WSDL produit, bien qu'unique, est refusé lors de l'inscription du service dans Adélia Studio car non conforme pour son parseur WSDL.
Cela arrive notamment  dans le cas d'un <wsdl:import> avec un targetNamespace différent dans chacun des fichiers WSDL sources.
Le targetNamespace du fichier WDL importé est conservé au détriment du targetNamespace du fichier maître.
Il faut alors, dans l'élément <wsdl:definitions> rétablir le bon targetNamespace et si besoin réaffecter les éléments dont le préfixe ne pointe pas sur le bon namespace.

Dans l'exemple donné, il faut rétablir le targetNamespace à "http://tempuri.org/" et déclarer un préfixe sur ce namespace (xmlns:uio="http://tempuri.org/") :

<wsdl:definitions xmlns:wsap="http://schemas.xmlsoap.org/ws/2004/08/addressing/policy"
xmlns:wsa10="http://www.w3.org/2005/08/addressing" xmlns:tns="http://centiro.com/facade/tmsBasic/1/0/servicecontract"
xmlns:msc="http://schemas.microsoft.com/ws/2005/12/wsdl/contract" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"
xmlns:wsx="http://schemas.xmlsoap.org/ws/2004/09/mex" xmlns:wsp="http://www.w3.org/ns/ws-policy"
xmlns:wsam="http://www.w3.org/2007/05/addressing/metadata" xmlns:wsa="http://schemas.xmlsoap.org/ws/2004/08/addressing"
xmlns:soap12="http://schemas.xmlsoap.org/wsdl/soap12/"
xmlns:wsaw="http://www.w3.org/2006/05/addressing/wsdl"
xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
name="TMSBasic" targetNamespace="http://tempuri.org/"
xmlns:uio="http://tempuri.org/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/">


Puis réaffecter les éléments qui ne sont pas qualifiés par le bon namespace  :
<wsdl:binding name="BasicHttpBinding_ITMSBasic" type="tns:ITMSBasic">
<wsdl:binding name="BasicHttpBinding_ITMSBasic" type="uio:ITMSBasic">
<wsdl:port name="BasicHttpBinding_ITMSBasic" binding="tns:BasicHttpBinding_ITMSBasic">
<wsdl:port name="BasicHttpBinding_ITMSBasic" binding="uio:BasicHttpBinding_ITMSBasic">

Pour requalifier correctement ces 2 éléments, le préfixe tns: ("http://example.com/facade/tmsBasic/1/0/servicecontract") est substitué par le nouveau préfixe uio:("http://tempuri.org/").
*/

/*
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
*/

class AsendiaSoapConfig {

   public static $asendia_wsdl_auth = "https://uat.example.com/Universe.Services/TMSBasic/Wcf/c1/i1/TMSBasic/Authenticate.svc?wsdl";
   public static $asendia_wsdl_func = "https://uat.example.com/Universe.Services/TMSBasic/Wcf/c1/i1/TMSBasic/TMSBasic.svc?wsdl";
   public static $asendia_wsdL_user  = "userX";
   public static $asendia_wsdL_pass =  "passX";
   public static $CRMID = 'SomeID';
   public static $MODEOFTRANSPORT = 'SOMEVALUE';
}

/**
 * Class AsendiaAuthRequest
 */
class AsendiaAuthRequest
{
   public $Password = ASENDIA_API_PASSWORD;
   public $UserName = ASENDIA_API_USER;
}


// Create Params for Soap Connection
$initSoapOptions = array(
   'soap_version'=> SOAP_1_1,
    "trace" => true,
    "exceptions" => false,
);

try {

   $client = new SoapClient(AsendiaSoapConfig::$asendia_wsdl_auth, $initSoapOptions);
   $argAuth = new AsendiaAuthRequest();
   $argAuth->UserName = AsendiaSoapConfig::$asendia_wsdL_user;
   $argAuth->Password = AsendiaSoapConfig::$asendia_wsdL_pass;

   $resp = $client->Authenticate($argAuth);
   //print "<pre>"; print_r($client); // exit;
   $AuthenticationTicket = $resp->AuthenticationTicket;
   echo $AuthenticationTicket.PHP_EOL;

   try {

      $client2 = new SoapClient(AsendiaShoapConfig::$asendia_wsdl_func, array($initSoapOptions));
      $headers = array();
      $headers[] = new SoapHeader(
        "http://example.com/facade/shared/1/0/datacontract",
        "AuthenticationTicket",
        $AuthenticationTicket,
        null,
        false
     );

     /*
        // Alternative Way
      $client2 = new \Zend\Soap\Client(self::$strWSDL, $arrOptionsSOAP);
      $client2->addSoapInputHeader(
          new SoapHeader(
            "http://example.com/facade/shared/1/0/datacontract",
            "AuthenticationTicket",
            $AuthenticationTicket
            )
      );
     */

      $client2->__setSoapHeaders($headers);

      print PHP_EOL;
      print "-----------------------------__doRequest---------------------------------";
      print PHP_EOL;

      $xmlShippment = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"...</soapenv:Envelope>';

      var_dump($result = $client2->__doRequest(
          $xmlShippment,
          "http://uat.example.com/Universe.Services/TMSBasic/Wcf/c1/i1/TMSBasic/TMSBasic.svc/xml",
          "http://example.com/facade/tmsBasic/1/0/servicecontract/ITMSBasic/AddAndPrintShipment",
          SOAP_1_1
      ));

      //$result = $client2->__soapCall("AddAndPrintShipment", $params);
      //echo "REQUEST:\n" . htmlentities($client2->__getLastRequest()) . "\n";
      /*print "Request: \n".$client2->__getLastRequest() ."\n";
      //print "Response: \n".$client2->__getLastResponse()."\n";
      //print "Request: \n".$client2->__getLastRequestHeaders() ."\n";
      //print "Response: \n".$client2->__getLastResponseHeaders()."\n";*/

      // Deprecated
      //$client2->__call("AddAndPrintShipment",$params);

      // Format xml prettify
      $domxml = new DOMDocument('1.0');
      $domxml->preserveWhiteSpace = true;
      $domxml->formatOutput = true;
      @$domxml->loadHTML($result);
      $soapXMLResult = $domxml->saveXML(); // formated xml
      // echo $soapXMLResult;

      // Transform to array
      $xml = simplexml_load_string($soapXMLResult, "SimpleXMLElement", LIBXML_NOCDATA);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);

      // get information
      $strIdentifier = $array["body"]["envelope"]["body"]["addandprintshipmentresponse"]["parceldocuments"]["parceldocument"]["identifier"];


   } catch (Exception $e) {
      echo $e->getMessage();
   }

} catch (Exception $e) {
   echo $e->getMessage().PHP_EOL;
   echo $e->faultstring .PHP_EOL;
}











##########################################################################

Debug SOAP Conn Response

##########################################################################


$client = new SoapClient(self::$strWsdlDev,array( 'trace' => 1 , 'exceptions' => 0) );
$client->__setSoapHeaders(new SoapHeader("http://example.com/facade/shared/1/0/",
    "AuthenticationTicket",
    $this->strAuthTicket
));
$client->__call("AddData", array($objRequestData));

echo "--------------------------------------------------------------".PHP_EOL;
echo "====== REQUEST HEADERS =====" . PHP_EOL;
var_dump($client->__getLastRequestHeaders());
echo "========= REQUEST ==========" . PHP_EOL;
var_dump($client->__getLastRequest());

echo "--------------------------------------------------------------".PHP_EOL;
echo "========= RESPONSE =========" . PHP_EOL;
var_dump($client->__getLastResponse());
echo "REQUEST:\n" . html_entity_decode(htmlentities($client->__getLastResponse())) . "\n";
echo "========= RESPONSE HEADERS=========" . PHP_EOL;
var_dump($client->__getLastResponseHeaders());


$lastRequest = html_entity_decode(htmlentities($client->__getLastRequest()));
// Format xml prettify
$domxml = new DOMDocument('1.0');
$domxml->preserveWhiteSpace = true;
$domxml->formatOutput = true;
@$domxml->loadHTML($lastRequest);
$soapXMLResult = $domxml->saveXML(); // formated xml
echo $soapXMLResult;


exit;


















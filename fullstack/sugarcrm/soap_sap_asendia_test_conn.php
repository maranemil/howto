<?php

##############################################################
#
# Test Auth Asendia
#
##############################################################

/*
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
*/

class AsendiaSoapConfig {
   public static $asendia_wsdl_auth = "https://x.....com/Universe.Services/TMSBasic/Wcf/c1/i1/TMSBasic/Authenticate.svc?wsdl";
   public static $asendia_wsdl_func = "https://x.....com/Universe.Services/TMSBasic/Wcf/c1/i1/TMSBasic/TMSBasic.svc?wsdl";
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
   //echo $AuthenticationTicket.PHP_EOL;

   try {

      $client2 = new SoapClient(AsendiaShoapConfig::$asendia_wsdl_func, array($initSoapOptions));
      $headers = array();
      $headers[] = new SoapHeader("AuthenticationTicket", $AuthenticationTicket, null, false);
      $client2->__setSoapHeaders($headers);

      print PHP_EOL;
      print "-----------------------------__doRequest---------------------------------";
      print PHP_EOL;

      $xmlShippment = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"...</soapenv:Envelope>';

      var_dump($result = $client2->__doRequest(
          $xmlShippment,
          "http://...",
          "AddAndPrintShipment",
          SOAP_1_1
      ));

      //$result = $client2->__soapCall("AddAndPrintShipment", $params);
      echo "REQUEST:\n" . htmlentities($client2->__getLastRequest()) . "\n";
      /*print "Request: \n".$client2->__getLastRequest() ."\n";
      print "Response: \n".$client2->__getLastResponse()."\n";
      print "Request: \n".$client2->__getLastRequestHeaders() ."\n";
      print "Response: \n".$client2->__getLastResponseHeaders()."\n";*/

      // deprecated
      //$client2->__call("AddAndPrintShipment",$params);
      print "<pre>"; print_r($client2);


   } catch (Exception $e) {
      echo $e->getMessage();
   }

} catch (Exception $e) {
   echo $e->getMessage().PHP_EOL;
   echo $e->faultstring .PHP_EOL;
}
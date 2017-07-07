<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 25.08.15
 * Time: 10:09
 */


define('XSERVER_USER','root');
define('XSERVER_PWD','123');
define('XSERVER_URL','some-server.com');
define('XSERVER_WSDL_URI','http://some-server.com:1234/pathfromwdsl/500/somefunction');

// Soap Connection Options for XSERVER
$initSoapOptions = array(
    "location"      => XSERVER_WSDL_URI,
    'login'         => XSERVER_USER,
    'password'      => XSERVER_PWD,
    'uri'           => 'http://XSERVER_URL:1234',
    "style"         => SOAP_RPC, 	    // SOAP_DOCUMENT
    'use'           => SOAP_LITERAL, 	// SOAP_ENCODED
    'soap_version'  => SOAP_1_1, 	    // SOAP_1_2
    "trace"         => true,
    "exceptions"    => true,
    'compression'   => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP, // SOAP_COMPRESSION_DEFLATE
    'features'      => SOAP_SINGLE_ELEMENT_ARRAYS,
    'encoding'    => 'UTF-8', 		    // ISO-8859-1
    'cache_wsdl'  => 0, 		        // WSDL_CACHE_NONE
);

// Connect XSERVER
$client = new SoapClient("http://localhost//Sugar/YourWSDL.xml", $initSoapOptions);

// Define Params for XSERVER Query
$paramsX = array("IS_X_CNT" => "99");

// Call XSERVER Function defined in WDSL
$result = (array) $client->X_SERVER_FUNCTION($paramsX);
print_r($result );

// Read list with all WDSL functions from XSERVER
$resultfuncts = $client->__getFunctions();
print_r($resultfuncts );

//--------------------------------------------------
/*
Change in WDSL XML file this line:
<wsp:UsingPolicy wsdl:required="true"/>

with:
<wsp:UsingPolicy wsdl:required="false"/>
*/
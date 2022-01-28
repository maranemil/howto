


###  Test Soap Services with PHPUnit

```
<?php

class TranslationServiceTestCase extends UnitTestCase
{
    public function testTranslation()
    {
        // ...code omitted for brevity...

        // This fails badly
        /* $mocksoapclient->setReturnValue('translateToFrench'
                                , $dummyresponse
                                , array($englishtext)); */

        // This works nicely
        $mocksoapclient->setReturnValue('__call'
                            , $dummyresponse
                            , array('translateToFrench', array($englishtext)));

        $translationservice = new TranslationService($mocksoapclient);

        $frenchtext = $translationservice->translate($englishtext);

        // ...code omitted for brevity...
    }
}
```

#### http://pointbeing.net/weblog/2009/04/unit-testing-code-which-consumes-soap-services.html

```
class MyTest extends PHPUnit_Framework_TestCase
    protected static $_soapMock = null;

    public function testDoWork_WillSucceed( )
    {
        $this->_worker->setClient( self::getSoapClient( $this ) );
        $result = $this->_worker->doWork( );
        $this->assertEquals( true, $result['success'] );
    }

    protected static function getSoapClient( $obj )
    {
        if( !self::$_soapMock ) {
            self::$_soapMock = $obj->getMockFromWsdl(
                'Test/wsdl.xml', 'SoapClient_MyWorker'
            );
        }

        return self::$_soapMock;
    }
}
```
---

```
<?php
/**
* Pass an object from test to test
*/
class WebSericeTest extends PHPUnit_Framework_TestCase
{

    protected function setUp() {
        parent::setUp();
        // I don't know enough about your test cases, and do not know
        // the implications of moving code out of your setup.
    }

    /**
    * First Test which creates the SoapClient mock object.
    */
    public function test1()
    {
        $this->client = new Client();

        $soapClient = $this->getMockFromWsdl(
            'service.wsdl'
        );

        $this->client->setClient($this->SoapClient);
        $this->markTestIncomplete();
        // To complete this test you could assert that the
        // soap client is set in the client object. Or
        // perform some other test of your choosing.

        return $soapClient;
    }

    /**
    * Second Test depends on web service mock object from the first test.
    * @depends test1
    */
    public function test1( $soapClient )
    {
        // you should now have the soap client returned from the first test.
        return $soapClient;
    }

    /**
    * Third Test depends on web service mock object from the first test.
    * @depends test1
    */
    public function test3( $soapClient )
    {
        // you should now have the soap client returned from the first test.
        return $soapClient;
    }
}
?>
```


```
<?php

require_once 'PHPUnit/Autoload.php';
require_once '../app/Mage.php';

class customerCustomerTest extends PHPUnit_Framework_TestCase {

private $local_url_v1 = "http://192.168.1.91/api/soap/?wsdl=1";
private $local_url_v2 = "http://192.168.1.91/api/v2_soap/?wsdl=1";
private $api_url_v1;
private $api_url_v2;

public function setUp() {
    Mage::app('default');
    $this->setApiUrlV2($this->local_url_v2);
}

public function getApiUrlV2() {
    return $this->api_url_v2;
}

public function setApiUrlV2($api_url_v2) {
    $this->api_url_v2 = $api_url_v2;
}

public function testLogin() {

   $cli = new SoapClient($this->api_url_v2);

   $username = 'mobile';
   $password = 'mobile123';

   $result = $cli->login($username, $password);
   $session_id = isset($result) ? $result : null;

   $this->assertNotNull($session_id);
   return $session_id;
}

public function testCoreCustomerList_V2() {

   $session_id = $this->testLogin();
   $cli = new SoapClient($this->api_url_v2);
   $result = $cli->customerCustomerList($session_id);

   $this->assertTrue(is_array($result));
   foreach ($result as $res) {
      $this->assertObjectHasAttribute('customer_id', $res);
   }
 }

}

// http://www.thejoemorgan.com/blog/2015/05/13/php-unit-mocks/
// https://michaelstivala.com/writing-soap-web-service-consumers-php/
// https://dzone.com/articles/how-stub-soap-php
// https://github.com/wsdl2phpgenerator/wsdl2phpgenerator
// https://docs.moodle.org/dev/Web_Services_Unit_Test
// http://inchoo.net/magento/magento-api-v2-soap-unit-testing/
// http://codeception.com/for/yii
// http://codeception.com/docs/modules/SOAP
// https://symfony.com/doc/current/controller/soap_web_service.html

<?php

class SomeProviderTest extends PHPUnit_Framework_TestCase {
    public function testGetData() {
        $provider = new SomeThirdParty();
        //getData calls fetchData internally
        $widgets = $provider->getData();
        $widget = reset($widget);
        $this->assertEquals(4, $widget->price);
    }
}

class SomeThirdPary extends ApiBase {
    //Something something connect to api.
    private function fetchData() {
        $client = new SoapClient("https://coolapp.com", array('soap_version' => SOAP_1_2,));
        $data = $client->getWidgets(array(
            'user'      => $this->config['user'],
            'apiKey'    => $this->config['key']
        ))
        return new SimpleXMLElement($data);
    }

    function getData() {
        $widgets =  array();
        $allWidgets = $this->fetchData();
        foreach($allWidgets as $widget) {
            $w = new Widget($widget)
            //Probablly do some more stuff
            $widgets[] = $w;
        }
        return $widgets;
    }
}


class SomeProviderTest extends PHPUnit_Framework_TestCase {
    public function testGetData() {
        $provider = $this->getMockBuilder('SomeThirdParty')
                     ->setMethods(array('fetchData'))
                     ->getMock();

        $widgetXML = <<<EOT
            <Widget>
                <Widget>
                    <Id>54</Id>
                    <Price>34.00</Price>
                    <Length>5.00</Length>
                    <Width>5.00</Width>
                </Widget>
                <Widget>
                    <Id>87</Id>
                    <Price>42.00</Price>
                    <Length>10.00</Length>
                    <Width>5.00</Width>
                </Widget>
            </Widgets>
EOT;
        $provider->expects($this->once())
             ->method('fetchData')
              ->will($this->returnValue(new \SimpleXMLElement($widgetXML));

        //getData calls fetchData internally. We never need to call it.
        $widgets = $provider->getData();
        $widget = reset($widget);
        //For now, we'll just check price. Probably need ot check other things.
        $this->assertEquals(34.00, $widget->price);
    }
}
```
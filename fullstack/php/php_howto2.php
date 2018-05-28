

############################################################

strip properties of an object that are null?
https://stackoverflow.com/questions/4352203/any-php-function-that-will-strip-properties-of-an-object-that-are-null
https://www.tutorialrepublic.com/faq/how-to-remove-empty-values-from-an-array-in-php.php

############################################################

// --------------
// Strips any false-y values
$object = (object) array_filter((array) $object);
// Strips only null values
$object = (object) array_filter((array) $object, function ($val) {
    return !is_null($val);
});


// --------------
$someObject = (array)$someObject;
array_walk_recursive($someObject, function($v,$k) use (&$someObject) {
    if($someObject[$k] == null) {
        unset($someObject[$k]);
    }
});

$someObject = (object)$someObject;
var_dump($someObject);



// --------------
// Setup
$obj = (object) array('foo' => NULL, 'bar' => 'baz');
// equivalent to array_filter
array_walk($obj, function($v,$k) use ($obj) {
    if(empty($v)) unset($obj->$k);
});
// output
print_r($obj);


// --------------
// filter
$array = array("apple", "", 2, null, -5, "orange", 10, false, "");
var_dump($array);
echo "<br>";

// Filtering the array
$result = array_filter($array);
var_dump($result);














############################################################
#
#	An API with repeating parameters
#	Multiple Query Parameters of Same Name
#	Serializing an Array as a Sequence of Elements
#
############################################################

/*
https://stackoverflow.com/questions/24872088/php-soapclient-multiple-arguments-with-the-same-name
https://stackoverflow.com/questions/37765861/send-data-to-soap-api-involving-repeated-elements-of-same-name
https://www.sitepoint.com/community/t/an-api-with-repeating-parameters/32601/4
https://community.servicenow.com/community?id=community_question&sys_id=0a2347e1dbd8dbc01dcaf3231f96196c
https://community.servicenow.com/community?id=community_question&sys_id=bae98729db5cdbc01dcaf3231f9619e5
https://futurestud.io/tutorials/retrofit-multiple-query-parameters-of-same-name
https://community.smartbear.com/t5/SoapUI-Pro/Res-duplicate-properties-in-REST-request/td-p/39318
https://docs.microsoft.com/en-us/dotnet/standard/serialization/controlling-xml-serialization-using-attributes
https://framework.zend.com/apidoc/2.0/classes/Zend.Soap.Wsdl.html
http://php.net/manual/en/soapclient.soapcall.php
http://php.net/manual/en/soapvar.soapvar.php
https://github.com/GoteoFoundation/goteo-legacy/blob/master/library/pear/SOAP/Client.php
http://php.net/manual/de/soapclient.soapclient.php
http://be2.php.net/manual/en/class.soapfault.php
https://github.com/zendframework/zend-soap/issues/37
https://framework.zend.com/manual/1.12/de/zend.soap.client.html
https://stackoverflow.com/questions/15559056/content-type-application-soapxml-charset-utf-8-was-not-supported-by-service/25302867
https://github.com/artisaninweb/laravel-soap/issues/108
http://php.net/manual/de/function.stream-context-create.php
https://stackoverflow.com/questions/9909232/php-soapclient-stream-context-option
http://www.king-foo.com/2011/09/using-complex-types-with-zendsoap/
https://framework.zend.com/manual/2.3/en/modules/zend.soap.wsdl.html
https://framework.zend.com/manual/2.1/en/modules/zend.validator.identical.html
https://stackoverflow.com/questions/29941570/zend-soap-change-the-default-array-element-name-item-to-class-name-of-complex
https://zendframework.github.io/zend-soap/wsdl/
https://stackoverflow.com/questions/3617398/soapclient-how-to-pass-multiple-elements-with-same-name
https://beberlei.de/2014/01/31/soap_and_php_in_2014.html
---------
*/

public class Group{
    [XmlArrayItem(Type = typeof(Employee)),
    XmlArrayItem(Type = typeof(Manager))]
    public Employee[] Employees;
}
public class Employee{
    public string Name;
}
public class Manager:Employee{
    public int Level;
}

public class Group{
    [XmlElement]
    public Employee[] Employees;
}

// ------------

$this->soapWrapper->add('bsedemo', function ($service) {
  $service
    ->wsdl('http://bsestarmfdemo.bseindia.com/MFOrderEntry/MFOrder.svc?singleWsdl')
    ->trace(true)
    ->header('Content-type','application/soap+xml; charset=utf-8');

});

------------

$a = [
    'properties' => [
        [
          'name' => 'invtype',
          'value' => 'foo'
        ],
        [
          'name' => 'item_number',
          'value' => 'foo'
        ],
    ],
];

------------

$ITEMSITM = new stdClass();
foreach ($parsItem as $item) {
    $ITEMSITM->TITEMSITM[] = $item;
}

$wsdl = 'https://your.api/path?wsdl';
$client = new SoapClient($wsdl);
$multipleSearchValues = [1, 2, 3, 4];
$queryData = ['yourFieldName' => $multipleSearchValues];
$results = $client->YourApiMethod($queryData);
print_r($results);

-----

class Book {
    /** @var string */
    public $title;
    /** @var string */
    public $author;
    /** @var Tag[] */
    public $tags;
}
class Tag {
    /** @var string */
    public $tag;
}

------
$array = ['lets', 'test', 'it'];
$response = new stdClass();
$response->results = $array;


$array = ['lets', 'test', 'it'];
$response = new stdClass();
$response->results = new ArrayObject();
foreach($array as $item) {
  $response->results->append($item);
}


$array = ['lets', 'test', 'it'];
$response = new stdClass();
$response->results = new ArrayObject();
foreach($array as $item) {
    $soapVar = new SoapVar($item,XSD_STRING,NULL,NULL,'result');
    $response->results->append($soapVar);
}

-----


$wsdl = 'https://your.api/path?wsdl';
$client = new SoapClient($wsdl);
$multipleSearchValues = [1, 2, 3, 4];
$queryData = ['yourFieldName' => $multipleSearchValues];
$results = $client->YourApiMethod($queryData);
print_r($results);


$obj = new StdClass();
foreach ($telnums as $telnum) {
    $obj->telnums[] = $telnum;
}

$options = array(
  'createDomainRequest' => array(
    'telnums' => array(
      '10',
      '20',
      '30'
    )
  )
);


$soapClient = new SoapClient($wsdl);
$soapClient->__call('createDomain', array(
    new SoapParam('10', 'telnums'),
    new SoapParam('20', 'telnums'),
    new SoapParam('30', 'telnums'),
));


---------------

$client = new SOAPClient($wsdl, array(
    'classmap' => array(
        'Person' => 'DHL\Intraship\Person',
        // all the other types
    )
));








##########################################################
#
#   How to get(extract) a file extension in PHP?
#
#   https://stackoverflow.com/questions/173868/how-to-getextract-a-file-extension-in-php
#   https://stackoverflow.com/questions/173868/how-to-getextract-a-file-extension-in-php
#   https://paulund.co.uk/get-the-file-extension-in-php
#   http://php.net/manual/de/function.pathinfo.php
#   http://php.net/manual/de/function.basename.php
#
#########################################################


$ext = pathinfo($filename, PATHINFO_EXTENSION);
#
$path_info = pathinfo('/foo/bar/baz.bill');
echo $path_info['extension']; // "bill"
#
pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION)
#
$info = new SplFileInfo('test.png');
var_dump($info->getExtension());
#
array_pop(explode('.',$fname))
substr($path, strrpos($path, '.') + 1);
#
$ext = substr($filename,strrpos($filename,'.',-1),strlen($filename));
#
$file = 'folder/directory/file.html';
$ext = pathinfo($file);

echo $ext['dirname'] . '<br/>';   // Returns folder/directory
echo $ext['basename'] . '<br/>';  // Returns file.html
echo $ext['extension'] . '<br/>'; // Returns .html
echo $ext['filename'] . '<br/>';  // Returns file











#------------------------------------
# PHP Regex groups captures
#------------------------------------
$pattern = "/([\w|\d])+/";
$string = "[abc - 123 - def - 456 - ghi - 789 - jkl]";
preg_match_all($pattern, $string, $matches);
print_r($matches[0]);


#------------------------------------
# Regex Special Character Definitions
#------------------------------------
http://php.net/manual/de/function.preg-replace.php
http://www.rexegg.com/regex-capture.html
http://www.rexegg.com/regex-php.html
https://lzone.de/examples/PHP%20preg_replace
https://regexone.com/references/php

The following should be escaped if you are trying to match that character

\ ^ . $ | ( ) [ ]
* + ? { } ,

Special Character Definitions
\ Quote the next metacharacter
^ Match the beginning of the line
. Match any character (except newline)
$ Match the end of the line (or before newline at the end)
| Alternation
() Grouping
[] Character class
* Match 0 or more times
+ Match 1 or more times
? Match 1 or 0 times
{n} Match exactly n times
{n,} Match at least n times
{n,m} Match at least n but not more than m times
More Special Character Stuff
\t tab (HT, TAB)
\n newline (LF, NL)
\r return (CR)
\f form feed (FF)
\a alarm (bell) (BEL)
\e escape (think troff) (ESC)
\033 octal char (think of a PDP-11)
\x1B hex char
\c[ control char
\l lowercase next char (think vi)
\u uppercase next char (think vi)
\L lowercase till \E (think vi)
\U uppercase till \E (think vi)
\E end case modification (think vi)
\Q quote (disable) pattern metacharacters till \E
Even More Special Characters
\w Match a "word" character (alphanumeric plus "_")
\W Match a non-word character
\s Match a whitespace character
\S Match a non-whitespace character
\d Match a digit character
\D Match a non-digit character
\b Match a word boundary
\B Match a non-(word boundary)
\A Match only at beginning of string
\Z Match only at end of string, or before newline at the end
\z Match only at end of string
\G Match only where previous m//g left off (works only with /g)







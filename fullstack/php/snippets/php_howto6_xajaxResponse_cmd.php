<?php

/**
Commands Overview
https://github.com/JProof/Xajax-PHP-7/wiki/Commands-Overview
https://github.com/Xajax/Xajax

Ajax Response Html Commands

*/

$objResponse->html($element,'Text or Html-Tags');	            Inserts Text/Html into the given html element	      Ajax insert Html
$objResponse->html($element);	                                 Clear/Empty with Ajax Html Element	                  Ajax clear/empty Html
$objResponse->remove($element);	                              Removes the Element if it exists	                     Ajax remove Element
$objResponse->removeAll($elements);	                           Remove all Elements with given querySelector	         Ajax remove all Elements
$objResponse->prependHtml($parentElement, 'Text or Html-Tag');	Inserts Text/Html at first position in parentElement	Ajax prepend Element
$objResponse->appendHtml($parentElement, 'Text or Html-Tag');	Inserts Text/Html at last position in parentElement	Ajax append Element

// Ajax html css class name handling

$objResponse->classSet($element, $classNameString);
$objResponse->classClear($element);
$objResponse->classAdd($element, $classNameString);
$objResponse->classRemove($element, $classNameString);

// Ajax html attributes

$objResponse->attribSet($element, 'disabled', 'disabled');
$objResponse->attribPrepend($element, 'value', ' +Value');
$objResponse->attribAppend($element, 'value', ' +Value');
$objResponse->attribRemove($element, 'disabled');
$objResponse->attribClear($element, 'disabled');

// Ajax javascript events during response

$objResponse->setEvent($element, 'click', 'myJsMethodToCall');
$objResponse->addEvent($element, 'click', 'myJsMethodToCall');
$objResponse->fireEvent($element, 'click');
$objResponse->removeEvent($element, 'click', 'myJsMethodToCall');
$objResponse->removeEvents($element, 'click');
$objResponse->removeEvents($element, 'click');
$objResponse->safeExecuteFunction('myJsMethodToCall');

// Ajax functional helper

Jybrid::getConfig()->setCleanBuffer(true); # optional
Factory::responseRequest(true); # required

// Ajax http-request header
/*
ajax request all/global	Jybrid::getHeaders()->addHeaderCommon('jybrid-Ajax-Request-Common-Header', 'Post/GetHeaderValue');
ajax request all/global	Jybrid::getHeaders()->addHeaderPost('jybrid-Ajax-Request-Post-Header', 'Request-POST-Header');
ajax request all/global	Jybrid::getHeaders()->addHeaderGet('jybrid-Ajax-Request-Get-Header', 'Post/GetHeaderValue');
ajax request single/individual	Jybrid::prepareRequest()->addHeaderCommon('jybrid-Ajax-Request-Common-Header', 'Post/GetHeaderValue');
ajax request single/individual	Jybrid::prepareRequest()->addHeaderPost('jybrid-Ajax-Request-Post-Header', 'Request-POST-Header');
ajax request single/individual	Jybrid::prepareRequest()->addHeaderGet('jybrid-Ajax-Request-Get-Header', 'Post/GetHeaderValue');
*/

// Ajax http-response header

Jybrid\Response\Manager::getInstance()->getHeader()->addResponseHeader('response-header-GET-and-POST', 'Post/GetHeaderValue');
Jybrid\Response\Manager::getInstance()->getHeader()->addHeaderPost('during-POST-Request-Response-Header', 'PostHeaderValue');
Jybrid\Response\Manager::getInstance()->getHeader()->addHeaderGet('during-GET-Request-Response-Header', 'GetHeaderValue');

// Ajax Css-Files

$objResponse->includeCSS('assets/test-css/test1.css')
$objResponse->removeCSS('assets/test-css/test1.css');

// Ajax Javascript

$objResponse->confirmCommands($cntNextCommands,'Do you want to apply next $cntNextCommands?');
$objResponse->redirect($url,$waitSecondsBeforeRedirect);
$objResponse->openNewWindow($url,$target,$focus);

// ------------------------------------------------------------------------
/*
https://phpro.org/examples/Set-Checkbox-With-Xajax.html
*/
/*
$objResponse->assign( 'checkbox_id', 'checked', true );
$objResponse->assign( 'checkbox_id', 'checked', false );
*/

/*** some error reporting ***/
error_reporting( E_ALL );
/*** include the xajax bootstrap ***/
include 'xajax/xajax_core/xajax.inc.php';
/*** a new xajax object ***/
$xajax = new xajax();
/*** register a PHP function with xajax ***/
$xajax->register(XAJAX_FUNCTION, 'clickme');
/*** process the request ***/
$xajax->processRequest();
/*** the path is relative to the web root mmmk ***/
$xajax_js = $xajax->getJavascript('/xajax');

function clickMe($form_values)
{
       $objResponse = new xajaxResponse;
       $value = strtolower( $form_values['animal_text'] );
       $objResponse->assign( $value, 'checked', true );
       return $objResponse;
}
/*
<html>
<head>
<title>PHPRO XajaX Checkbox</title>
<?php
        echo $xajax_js;
?>
</head>
<body>
<form id="my_form" name="my_form" action="" method="post" onsubmit="xajax_clickme(xajax.getFormValues('my_form')); return false;">
<input type="checkbox" name="dingo" id="dingo" />Dingo<br />
<input type="checkbox" name="platypus" id="platypus" />Platypus<br />
<input type="checkbox" name="wombat" id="wombat" />Wombat<br />
<input type="checkbox" name="wallaby" id="wallaby" />Wallaby<br />
<input type="checkbox" name="kangaroo" id="kangaroo" />Kangaroo<br />
<input type="text" name="animal_text" /> Name<br />
<input type="submit" value="Click Me" />
</form>
</body>
</html>
*/

//------------------------------------------------------------------------
/*
https://phpro.org/tutorials/Asynchronous-Form-Submission-With-Xajax.html
*/

/*** include the xajax library ***/
include 'xajax/xajax_core/xajax.inc.php';
/*** a new xajax object ***/
$xajax = new xajax();
/*** Register the function ***/
$xajax->registerFunction("myFunction");

function myFunction($string)
{
    if($string == 'wombat')
    {
        $content = 'Animal is a wombat';
        $color = 'green';
    }
    else
    {
        $content = 'Animal is not a wombat';
        $color = 'red';
    }
/***  A new xajaxResponse object ***/
$objResponse = new xajaxResponse();
/*** assign the innerHTML attribute of to whatever the new $content ***/
$objResponse->assign("element_id","innerHTML", $content);
/*** assign a color to the  element ***/
$objResponse->assign("element_id","style.color",$color);
/*** return the  xajaxResponse object ***/
return $objResponse;
}
/*** process the request ***/
$xajax->processRequest();
/*** assign the generated javascript to a variable ***/
$xajax_js = $xajax->getJavascript('/xajax');

/*
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
<title>PHPRO.ORG</title>
<?php
    echo $xajax_js;
?>
</head>
<body>
<form name="my_form" id="my_form" method="post">
<input type="text" name="animal_id" id="animal_id" />
<input type="button" onclick="xajax_myFunction(xajax.$('animal_id').value);" value="Check Animal" />
</form>
<div id="element_id">Please enter an animal</div>

</body>
</html>
*/
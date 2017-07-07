<?php

////////////////////////////////////////
//
// Debug in SugarCRM
//
////////////////////////////////////////

// most entry points have this, except soap.php
// require_once ('log4php/LoggerManager.php'); # deprecated
require_once('include/SugarLogger/LoggerManager.php');
$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');

// depending on what your log level is set at in log4php.properties
$GLOBALS['log']->fatal(msg);
$GLOBALS['log']->debug(msg);
$GLOBALS['log']->info(msg);
$GLOBALS['log']->test('This is my test log message');
$GLOBALS['log']->fatal("print some array: " . print_r($array, true));
$GLOBALS['db']->query($sql);

/*
Debug : Logs events that help in debugging the application.
Info : Logs informational messages and database queries.
Warn : Logs potentially harmful events.
Error : Logs error events in the application.
Fatal : Logs severe error events that leads the application to abort. This is the default level.
Security : Logs events that may compromise the security of the application.
*/
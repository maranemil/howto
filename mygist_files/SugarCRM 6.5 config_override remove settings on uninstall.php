<?php

/////////////////////////////////////////////////////////////////////////////////
//
// SugarCRM 6.5 config_override remove settings on uninstall
//
/////////////////////////////////////////////////////////////////////////////////

if(!defined('sugarEntry')) define('sugarEntry', true);
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/entryPoint.php');

//global $db;
//global $moduleList;

/////////////////////////////////////////////////////////////////////////////////
//
// Remove config settings
//
/////////////////////////////////////////////////////////////////////////////////

require_once('modules/Configurator/Configurator.php');
$configurator = new Configurator();
$configurator->loadConfig();
$configurator->clearCache();
$configurator->readOverride(); // This will retrieve all the config override aray
$configurator->config['http_referer'] = '';
$configurator->handleOverride();
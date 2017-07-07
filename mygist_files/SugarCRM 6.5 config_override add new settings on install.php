<?php

/////////////////////////////////////////////////////////////////////////////////
//
// SugarCRM 6.5 config_override add new settings on install
//
/////////////////////////////////////////////////////////////////////////////////

if(!defined('sugarEntry')) define('sugarEntry', true);
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/entryPoint.php');

global $db;
global $moduleList;

/////////////////////////////////////////////////////////////////////////////////
//
// Add new config override settings
//
/////////////////////////////////////////////////////////////////////////////////

require_once('modules/Configurator/Configurator.php');
$configurator = new Configurator();
$configurator->loadConfig();
$configurator->clearCache();
//$configurator->readOverride(); // This will retrieve all the config override aray
$configurator->config['http_referer']['list'][] = $_SERVER["HTTP_HOST"]; //'localhost';
$configurator->config['http_referer']['actions'] =array(
    'ListViewGroup',
    'ListViewHome'
);
$configurator->handleOverride();

/////////////////////////////////////////////////////////////////////////////////
//
// Run repair after install
//
/////////////////////////////////////////////////////////////////////////////////

require_once('modules/Administration/QuickRepairAndRebuild.php');
$repair = new RepairAndClear();
$repair->repairAndClearAll(array('clearAll'),$moduleList, true,false);

if(class_exists('DBManagerFactory')) {
    $db = DBManagerFactory::getInstance();
    $db->disconnect();
}
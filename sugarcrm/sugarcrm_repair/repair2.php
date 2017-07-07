#!/usr/bin/php
<?php

/*
 * Copyright 2013
 * Jeff Bickart
 * @bickart
 * jeff @ neposystems.com
 */

//ob_clean();
//ob_start();

if (!defined('sugarEntry')) define('sugarEntry', true);

require_once('include/entryPoint.php');
require_once('modules/Administration/QuickRepairAndRebuild.php');

//Bug 27991 . Redirect to index.php if the request is not come from CLI.
$sapi_type = php_sapi_name();
global $sugar_config;
/*

if (substr($sapi_type, 0, 3) != 'cgi') {

    if(!empty($sugar_config['site_url'])){
        header("Location: ".$sugar_config['site_url'] . "/index.php");
    }else{
        sugar_die("Didn't find site url in your sugarcrm config file");
    }
}*/

//End of #27991

if (empty($current_language)) {
    $current_language = $sugar_config['default_language'];
}

$app_list_strings = return_app_list_strings_language($current_language);
$app_strings = return_application_language($current_language);

global $current_user;
$current_user = new User();
$current_user->getSystemUser();

$GLOBALS['log']->debug('--------------------------------------------> at repair.php <--------------------------------------------');
$repair = new RepairAndClear();
$repair->repairAndClearAll(array('clearAll'), array(translate('LBL_ALL_MODULES')), true, false);

$repair->module_list = array(translate('LBL_ALL_MODULES'));
$repair->show_output = false;
$repair->execute = true;
$repair->clearLanguageCache();
MetaDataManager::enableCacheRefreshQueue();
$repair->clearTpls();
$repair->clearJsFiles();
$repair->clearJsLangFiles();
$repair->clearLanguageCache();
$repair->clearDashlets();
$repair->clearSmarty();
$repair->clearThemeCache();
$repair->clearXMLfiles();
$repair->clearExternalAPICache();
$repair->clearAdditionalCaches();
$repair->clearPDFFontCache();
$repair->repairMetadataAPICache();

/*
*  case 'clearAll':
                $this->clearTpls();
                $this->clearJsFiles();
                $this->clearVardefs();
                $this->clearJsLangFiles();
                $this->clearLanguageCache();
                $this->clearDashlets();
                $this->clearSmarty();
                $this->clearThemeCache();
                $this->clearXMLfiles();
                $this->clearSearchCache();
                $this->clearExternalAPICache();
                $this->clearAdditionalCaches();
                $this->clearPDFFontCache();
                $this->rebuildExtensions();
                $this->rebuildFileMap();
                $this->rebuildAuditTables();
                $this->repairDatabase();
                $this->repairMetadataAPICache($metadata_sections);
                break;
 *
 */

$exit_on_cleanup = true;
sugar_cleanup(false);
// some jobs have annoying habit of calling sugar_cleanup(), and it can be called only once
// but job results can be written to DB after job is finished, so we have to disconnect here again
// just in case we couldn't call cleanup
if (class_exists('DBManagerFactory')) {
    $db = DBManagerFactory::getInstance();
    $db->disconnect();
}
if ($exit_on_cleanup) exit;

//$exit_on_cleanup = true;
//sugar_cleanup(false);

// some jobs have annoying habit of calling sugar_cleanup(), and it can be called only once
// but job results can be written to DB after job is finished, so we have to disconnect here again
// just in case we couldn't call cleanup
/*if(class_exists('DBManagerFactory')) {
    $db = DBManagerFactory::getInstance();
    $db->disconnect();
}*/

//echo "done";
//ob_end_flush();

//if($exit_on_cleanup) exit;


/*
 *
 *

# REPAIR Schedulers
require_once('install/install_utils.php');
	$focus = BeanFactory::getBean('Schedulers');
	$focus->rebuildDefaultSchedulers();


# REPAIR Types
switch($current_action)
        {
            case 'repairDatabase':
                if(in_array($mod_strings['LBL_ALL_MODULES'], $this->module_list)) {
                    $this->repairDatabase();
                    // Mark this as called so it doesn't get ran again
                    $this->called[$current_action] = true;
                } else {
                    $this->repairDatabaseSelectModules();
                }
                break;
            case 'rebuildExtensions':
                if(in_array($mod_strings['LBL_ALL_MODULES'], $this->module_list)) {
                    $this->rebuildExtensions();
                    // Mark this as called so it doesn't get ran again
                    $this->called[$current_action] = true;
                } else {
                    $this->rebuildExtensions($this->module_list);
                }
                break;
            case 'clearTpls':
                $this->clearTpls();
                break;
            case 'clearJsFiles':
                $this->clearJsFiles();
                break;
            case 'clearDashlets':
                $this->clearDashlets();
                break;
            case 'clearThemeCache':
                $this->clearThemeCache();
                break;
            case 'clearJsLangFiles':
                $this->clearJsLangFiles();
                break;
            case 'rebuildAuditTables':
                $this->rebuildAuditTables();
                break;
            case 'clearSearchCache':
                $this->clearSearchCache();
                break;
            case 'clearAdditionalCaches':
                $this->clearAdditionalCaches();
                break;
            case 'repairMetadataAPICache':
                $this->repairMetadataAPICache();
                break;
            case 'clearPDFFontCache':
                $this->clearPDFFontCache();
                break;
            case 'resetForecasting':
                $this->resetForecasting();
                break;
            case 'repairConfigs':
                $this->repairBaseConfig();
            case 'clearAll':
                $this->clearTpls();
                $this->clearJsFiles();
                $this->clearJsLangFiles();
                $this->clearDashlets();
                $this->clearSmarty();
                $this->clearThemeCache();
                $this->clearXMLfiles();
                $this->clearSearchCache();
                $this->clearExternalAPICache();
                $this->clearAdditionalCaches();
                $this->clearPDFFontCache();
                $this->rebuildExtensions();
                $this->rebuildFileMap();
                $this->rebuildAuditTables();
                $this->repairDatabase();
                $this->repairBaseConfig();
                $this->repairMetadataAPICache($metadata_sections);
                break;
        }*/
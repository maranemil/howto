<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 04.03.16
 * Time: 13:59
 */

/**

#################################################################
#
# [PDF]Alinea's Applications - ECM2
# Guide AlineaSol SolCRM WorkFlowManager.v5.9.3.doc
# AlineaSol WorkFlow Manager Guide for release 5.x (release 5.9.3)
#
#################################################################

https://ecm2.nl/sites/default/files/download/User_Guide_WorkFlowManager-latest.pdf

################################################################
#	recommendations
################################################################
-----------------------------------------
WF Logic Hooks with Email
- Not Required - bean_ungreedy_count	0
//Not Required - use_curl 0
- Async Required
- Stop Task Optional
-----------------------------------------
WF Logic Hooks with no Email
- Async Not Required
- Required - bean_ungreedy_count	0
- Stop Task Req? (maybe)
-----------------------------------------
WF Scheduler
- Async Not Required (No sync!)
- Sequencial Required
- Stop Task Required (maybe)
- no bean_ungreedy_count Required!
-----------------------------------------
Special settings Scheduled Task Cron Alineasol - when every 15 minutes runs:

1. All Scheduled Tasks for Workflows to set at (00,15,30,45)(Min), a must, otherwise will not work at all.
2. Every time to check if Worflow list has this Module inside as aktive.
3. Every customised Workflow muss have one unique name for Email Funtion and less code without classes / functions
4. Task End is a must
5. bean_ungreedy_count is not required for Scheduled
6. Option Async to not be used.
-----------------------------------------

bean_ungreedy_count 	0
use_curl 		1

entryPoint 		wfm_engine
php_errormsg		Non-static method UploadStream::register() should not be called statically
$alternative_database	-1

bean_ungreedy_count (if a wfm-process triggers the execution of the same/another wfm-process => bean_ungreedy_count++).
This wfm-variable is used to limit the impact of “loops”.


 */


//---------------------------------------------------------------------------

// disable all workflows
$sugar_config['WFM_disable_wfm_completely'] = true;
// enable debug mode
$sugar_config['WFM_changeLogLevelFromFlowDebugTo'] = 'warn';
$sugar_config['WFM_changeLogLevelFromAsolDebugTo'] = 'warn';
$sugar_config['asolLogLevelEnabled'] = true;
$sugar_config['WFM_changeLogLevelFromAsolTo'] = 'warn';

//---------------------------------------------------------------------------

// Disable WFM
$sugar_config['WFM_disable_wfm_completely'] = false;
$sugar_config['WFM_disable_wfmHook'] = false;
$sugar_config['WFM_disable_wfmScheduledTask'] = false;
$sugar_config['WFM_disable_workFlowManagerEngine'] = false;

// Hide WFM dashlets. Admin-users do not depend on this config, they always can see WFM dashlets.
$sugar_config['WFM_hideDashlets'] = true;


$sugar_config['WFM_development_mode'] = false; // You need to set this sugar_config to true in order to use sugar_configs below.
// If you use the WFM to send an email to an address that is not within this array => The WFM will replace @ by @x, so the email will not be received by this address.
$sugar_config['WFM_development_mode_allowed_emails'] = Array('email@email_server.com', 'name@server.es');
$sugar_config['WFM_development_mode_notAllowedEmails_textAddedToEmailAddress'] = 'XWFMnotAllowedEmailX';

//---------------------------------------------------------------------------

$sugar_config['WFM_changeLogLevelFromFlowDebugTo'] = 'warn'; // warn(recommended), debug, ...
$sugar_config['WFM_changeLogLevelFromAsolTo'] = 'warn'; // warn(recommended), debug, ...
$sugar_config['asolLogLevelEnabled'] = true;
$sugar_config['WFM_changeLogLevelFromAsolDebugTo'] = 'debug';  // asol(development), debug(production, recommended)

$sugar_config['WFM_MAX_working_nodes_executed_in_one_php_instance'] = '10';
$sugar_config['WFM_MAX_loops'] = '10';
$sugar_config['WFM_TranslateLabels'] = true;

$sugar_config['WFM_site_url'] = 'http://[your_server_url]/[your_sugarcrm_instance_name]';  // Do not forget to remove the brackets.  // If the default configuration does not work, try using this sugar_config. Also if you want the WFM to execute as soon as posible -> use your internal server_IP (for example: 127.0.0.1, your NAT IP, etc).
$sugar_config['WFM_site_login_username_password'] = '[site_login_username]:[site_login_password]';

//---------------------------------------------------------------------------

// - External non CRM databases (the databases access must be configured in an array like the following):
$sugar_config['WFM_AlternativeDbConnections'] = array(
	0 => array(
		"asolReportsDbAddress" => '192.168.0.X', //Ip address
		"asolReportsDbUser" => "root", //Database access username
		"asolReportsDbPassword" => "", //Database access password
		"asolReportsDbName" => "ExternalDb_A", //Database name
		"asolReportsDbPort" => "3306", //Port
		"asolDefaultDbDomainIdField" => array ( //this array is not mandatory, may not be defined. It's used for Domains filtering
			"fieldName" => "IdDomain",
			"isNumeric" => true //true [Numeric] false [String]
		),
		"asolSpecificTableDomainIdField" => array ( //this array is not mandatory, may not be defined. It's used for Domains filtering
			"tableA_1" => array("fieldName" => "idDomain1", "isNumeric" => true),
			"tableA_2" => array("fieldName" => "idDomain2", "isNumeric" => true),
		),
		"asolAllowedTables" => array(
			"instance" => array("tableA", "tableC"),
			"domain" => array(),
		),
		"asolForbiddenTables" => array(
			"instance" => array(),
			"domain" => array(
				"idDomain1" => array("tableB"),
			),
		),
	),
	1 => array(
		"asolReportsDbAddress" => '192.168.0.Y',
		"asolReportsDbUser" => "root",
		"asolReportsDbPassword" => "",
		"asolReportsDbName" => "ExternalDb_B",
		"asolReportsDbPort" => "3307",
		"asolDefaultDbDomainIdField" => array (
			"fieldName" => "IdDomain",
			"isNumeric" => true
		),
		"asolSpecificTableDomainIdField" => array(
			"tableB_1" => array("fieldName" => "idDomain3", "isNumeric" => true),
			"tableB_2" => array("fieldName" => "idDomain4", "isNumeric" => true),
		),
		"asolAllowedTables" => array(
			"instance" => array(),
			"domain" => array(),
		),
	),
);

//---------------------------------------------------------------------------
// Max queries allowed
$sugar_config['resource_management']['default_limit'] = 1000;
//------------------------------------------------------------


/*
 * AlineaSol WorkFlowManager Manual
 * https://ecm2.nl/sites/default/files/download/User_Guide_WorkFlowManager-latest.pdf
 * https://ecm2.nl/sites/default/files/download/User_Guide_WorkFlowManager-latest.pdf
 * */

/* SUGAR SETTINGS - TEST
$sugar_config['list_max_entries_per_page'] = '25';
$sugar_config['list_max_entries_per_subpanel'] = '3';
$sugar_config['max_record_fetch_size'] = 100;
$sugar_config['max_record_link_fetch_size'] = 100;
$sugar_config['resource_management']['default_limit'] = 100;
$sugar_config['api']['timeout'] = 30;
$sugar_config['history_max_viewed'] = 20;
*/

// Andere Einstellungen
// /include/utils.php
// /include/MetaDataManager/MetaDataManager.php

#$sugar_config['WFM_changeLogLevelFromFlowDebugTo'] = 'warn';
#$sugar_config['WFM_changeLogLevelFromAsolTo'] = 'warn';
#$sugar_config['asolLogLevelEnabled'] = false;
#$sugar_config['WFM_changeLogLevelFromAsolDebugTo'] = 'warn';

#$sugar_config['WFM_MAX_working_nodes_executed_in_one_php_instance'] = '15';
#$sugar_config['WFM_MAX_loops'] = '2';

//$sugar_config['WFM_development_mode'] = false;
//$sugar_config['WFM_TranslateLabels'] = true;
//$sugar_config['WFM_site_url'] = 'http://localhost/PhpstormProjects/SugarPro';

// bean_ungreedy_count - to set 0 in WF

#$sugar_config['full_text_engine']['Elastic']['host'] = 'localhost';
#$sugar_config['full_text_engine']['Elastic']['port'] = '9200';

/*
 *
 * PhantomJS Installation for Charts in PDF

(1) Download phantomjs from (http://phantomjs.org/download.html)
https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-2.1.1-linux-x86_64.tar.bz2

(2) Extract package and copy phantomjs to the sugar root directory and set chmod/chown.

(3) Add $sugar_config['asolReportsPhantomJsFilePath'] = './phantomjs';  in the config_override.php file

*/



/*
 * Test - Avoid Loops in WF
 *
    $keyXY =  'cxp'.date('YmdHi');
	$GLOBALS[$keyXY] = 31;
	echo $GLOBALS[$keyXY];

	if($GLOBALS[$keyXY]==31){
		$GLOBALS[$keyXY] = 32;
		// do something here
	}

	// show keys
	foreach($GLOBALS as $GPkey=>$GPx){
		if(stristr($GPkey,"cxp") ){
			echo "<br>". $GPkey . " - ". $GPx;
		}
	}
 * */


/**
 * Update Width Reports
 * modules/asol_Reports/include_basic/generateReportsFunctions.php
 * Line 138
 *
 case "nvd3":

	foreach ($nvd3Chart as $key=>$nvd3) {
		if (isset($nvd3)) {
			if ($getExportData) {
				$chartsHtml .= '<chart key="'.$fixedReportId.'_'.$key.'"/>';
			} else {

                $nvd3['dimensions']['width'] = "100%"; // EM161019

				$chartsHtml .= '<div class="asolChartContainer" engine="nvd3" style="height: ..
                ...
         }
	break;
 */


<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 09.03.16
 * Time: 16:48
 */

#########################################################################
#
# Download a file in a logic hook
# https://www.eggsurplus.com/content/download-a-file-in-a-logic-hook/
#
#########################################################################

/*
logic_hooks.php
-------------------------------------
*/
//custom/modules/Contacts/logic_hooks.php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
$hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(2, 'require_download', 'custom/modules/Contacts/DownloadFile.php','DownloadFile', 'require_download');
$hook_array['after_ui_frame'] = Array();
$hook_array['after_ui_frame'][] = Array(2, 'download_file', 'custom/modules/Contacts/DownloadFile.php','DownloadFile', 'download_file');

/*
DownloadFile.php
---------------------------------------
*/

// Jason Eggers - SugarOutfitters.com
//custom/modules/Contacts/DownloadFile.php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class DownloadFile
{
	//before_save
	function require_download(&$bean, $event, $arguments)
	{
		//if title has been set/changed to CEO
		if($bean->title == 'CEO' && $bean->fetched_row['title'] != 'CEO') {
			$_SESSION['ceo_download'] = $bean->id;
		}
	}

	//after_ui_frame
	function download_file($event, $arguments)
	{
		//don't execute on ajax requests
		if(!empty($_REQUEST['to_pdf']) || !empty($_REQUEST['sugar_body_only'])) return;

		global $action;
		//only for detail view
		if(empty($action) || $action != 'DetailView') return;
		//if session variable exists output js to redirect the browser to download the file
		if(!empty($_SESSION['ceo_download'])) {
			echo "
<script>
  window.location = 'index.php?module=Contacts&action=CEO_Download&to_pdf=1';
</script>";

			unset($_SESSION['ceo_download']);
		}
	}
}

/*
 CEO_Download.php
 ------------------------------------------------
*/

// Jason Eggers - SugarOutfitters.com
//custom/modules/Contacts/CEO_Download.php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
ob_clean();
ob_start();
$file = 'Hello World';
header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="myfile.txt"');
header('Content-Length: '.strlen($file));
echo $file;


/**
 * How to prevent logic hooks fire on Import record
 *
 */

if($_REQUEST['module'] != 'Import'){
	//your logic hook code
}

if ( $do_not_run_logic_hook_c != 1 ){
	//do your regular logic hook operations here
}
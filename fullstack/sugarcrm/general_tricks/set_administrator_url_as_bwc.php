<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 11.01.17
 * Time: 18:54
 */

$admin_option_defs = array();
$admin_option_defs['Administration']['license_configuration_link'] = array(
	'',
	'LBL_SOMEMODUL_LICENSE_CONFIGURATION',
	'LBL_SOMEMODUL_LICENSE_CONFIGURATION_DESC',
	//'#bwc/index.php?module=someModul&action=someAction&bwcFrame=1'
	'javascript:parent.SUGAR.App.router.navigate("#bwc/./index.php?module=someModul&action=someAction", {trigger: true});'
);

$admin_group_header[] = array(
	'LBL_LBL_SOMEMODUL_CONF_TITLE',
	'',
	false,
	$admin_option_defs,
	'LBL_LBL_SOMEMODUL_CONFIGURATION_TITLE'
);

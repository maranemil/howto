<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 09.01.17
 * Time: 15:07
 */


// /custom/Extension/modules/Tasks/Ext/Language/en_us.filterTaskByParentType.php


$mod_strings['LBL_FILTER_TASK_BY_PARENT_TYPE'] = 'Parent is Opportunity';

// /custom/Extension/modules/Tasks/Ext/clients/base/filters/basic/filterTaskByParentType.php


// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/UI_Model/Views/Filters/
// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/UI_Model/Views/Filters/
// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Architecture/Filters/index.html#Adding_Initial_Filters_to_Drawers_from_a_Controller
// https://developer.sugarcrm.com/2014/03/10/creating-custom-filters-in-sugarcrm-7/
// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Architecture/Filters/index.html#Adding_Initial_Filters_to_Lookup_Searches
// https://developer.sugarcrm.com/2015/07/07/creating-a-dashlet-for-sugar-7-list-views/

// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/User_Interface/
// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.6/UI_Model/Views/Examples/Adding_Field_Validation_to_the_Record_View/
// https://developer.sugarcrm.com/2015/03/09/a-common-sugar-7-x-dashlet-gotcha/
// https://developer.sugarcrm.com/2010/11/22/howto-adding-your-own-listview-action-items/

/*
 * $contains
$not_contains
$in
$not_in
$equals
$starts
$not_equals
$gt
$lt
$gte
$lte
$between
yesterday
today
tomorrow
*/

$viewdefs['Tasks']['base']['filter']['basic']['filters'][] = array(
	'id' => 'filterTaskByParentType',
	'name' => 'LBL_FILTER_TASK_BY_PARENT_TYPE',
	'filter_definition' => array(
		array(
			'parent_type' => array(
				'$equals' => 'Opportunities',
			),
		),
	),
	'editable' => false,
	'is_template' => false,
	'default' => false,
);

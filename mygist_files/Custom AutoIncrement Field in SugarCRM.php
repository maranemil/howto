<?php

/////////////////////////////////////////////
//
// Custom AutoIncrement Field in SugarCRM
//
/////////////////////////////////////////////

/**
April 22, 2014 in Desarrollo, Sugar

1.) Custom AutoIncrement Field(having unique value):
For declaring “autoincrement” field in sugacrm do as follows:

Suppose we have to declare “Au Pair number” field as an autoincrement field in suagcrm. For this we have to declare vardef in custom/Extension/modules/oss_auPairs/Ext/Vardefs/vardefs.ext.php as follows:
*/

$dictionary["oss_auPairs"]["fields"]["aupair_number"] =array (
'required' => true,
'name' => 'aupair_number',
'vname' => 'LBL_AUPAIRS_AUPAIR_NUMBER',
'type' => 'int',
'massupdate' => 0,
'comments' => '',
'help' => '',
'importable' => 'true',
'duplicate_merge' => 'disabled',
'duplicate_merge_dom_value' => '0',
'audited' => false,
'reportable' => true,
'calculated' => false,
'auto_increment'=>true,
);

$dictionary["oss_auPairs"]["indices"]["aupair_number"] = array(
'name' => 'aupair_number',
'type' => 'unique',
'fields' => array(
    'aupair_number'
),
);

//Now Repair and Rebuild.

/**
2.) Create custom checkbox field:
Here, for example we are taking “Account” module and “need_aupair_to_care_disable_child” as the checkbox field. In custom/Extension/modules/Accounts/Ext/Vardefs/vardefs.ext.php write the following code:
*/

$dictionary["Account"]["fields"]["need_aupair_to_care_disable_child"] = array (
'required' => false,
'name' => 'need_aupair_to_care_disable_child',
'vname' => 'LBL_HOST_FAMILY_NEED_AUPAIR_TO_CARE_DISABLE_CHILD',
'type' => 'bool',
'massupdate' => 0,
'comments' => '',
'help' => '',
'importable' => 'true',
'duplicate_merge' => 'disabled',
'duplicate_merge_dom_value' => 0,
'audited' => false,
'reportable' => true,
'calculated' => false,
'len' => 255,
'size' => 20,
);

/**
Now in /var/www/sugarpro/custom/modules/Accounts/metadata/editviewdefs.php write the field as follows:

array (
'name' => 'need_aupair_to_care_disable_child',
'label' => 'LBL_HOST_FAMILY_NEED_AUPAIR_TO_CARE_DISABLE_CHILD',
),

3.) Create custom TextArea field:
Here, for example we are taking “Account” module and “disabilities” as the textarea field. In custom/Extension/modules/Accounts/Ext/Vardefs/vardefs.ext.php write the following code:
*/

$dictionary["Account"]["fields"]["disabilities"]=array (
'required' => false,
'name' => 'disabilities',
'vname' => 'LBL_HOST_FAMILY_DISABILITIES',
'type' => 'text',
'massupdate' => 0,
'default' => NULL,
'comments' => '',
'help' => '',
'importable' => 'true',
'duplicate_merge' => 'disabled',
'duplicate_merge_dom_value' => 0,
'audited' => false,
'reportable' => true,
'calculated' => false,
'rows' => 3,
'cols' => 10,
);

/**
Now in /var/www/sugarpro/custom/modules/Accounts/metadata/editviewdefs.php write the field as follows:

array (

'name' => 'disabilities',
'label' => 'LBL_HOST_FAMILY_DISABILITIES',
'displayParams' =>
array (
'cols' => 50,
'rows' => 3,
),
),
4.) Custom Radiobutton has default value selected:
Here, for example we are taking “oss_auPairs” module and “extension_application” as the multiselect field. Here we have to display radiobutton selected by default for this we have define a “default” attribute in custom/Extension/modules/oss_auPairs/Ext/Vardefs/vardefs.ext.php of the custom field as follows:

*/

$dictionary["oss_auPairs"]["fields"]["extension_application"] = array (
'required' => false,
'name' => 'extension_application',
'vname' => 'LBL_AUPAIRS_EXTENSION_APPLICATION',
'type' => 'radioenum',
'default' =>'Denied',
'massupdate' => 0,
'comments' => '',
'help' => '',
'importable' => 'true',
'duplicate_merge' => 'disabled',
'duplicate_merge_dom_value' => 0,
'audited' => true,
'reportable' => true,
'calculated' => false,
'len' => 100,
'size' => 20,
'options' => 'extension_application_list',
'studio' => 'visible',
'dbType' => 'enum',
);

/**

Here we are choosing “Denied” as default selection for the radio button.
5.) Create Custom MultiSelect Field:
Here, for example we are taking “oss_auPairs” module and “languages_spoken” as the multiselect field. In custom/Extension/modules/oss_auPairs/Ext/Vardefs/vardefs.ext.php write the following code:

*/

$dictionary["oss_auPairs"]["fields"]["languages_spoken"] = array (
'id' => 'oss_auPairslanguages_spoken',
'name' => 'languages_spoken',

'vname' => 'LBL_AUPAIRS_LANGUAGES_SPOKEN',
'type' => 'multienum',
'required' => false,
'comments' => NULL,
'help' => NULL,
'default' => NULL,
'module' => 'oss_auPairs',
'duplicate_merge' => 'disabled',
'duplicate_merge_dom_value' => 0,
'audited' => false,
'reportable' => true,
'calculated' => false,
'size' => 20,
'options' => 'language_list',
'studio' => 'visible',
'isMultiSelect' => true,
);

/**
Now in /var/www/sugarpro/custom/modules/oss_auPairs/metadata/editviewdefs.php write the field as follows:

array (

'name' => 'languages_spoken',
'type' => 'multienum',
'label' => 'LBL_AUPAIRS_LANGUAGES_SPOKEN',
),

===========================================================================================================
Author is “Pankaj Kumar Gunwant”. Feel free to comment or question on the above post !!
===========================================================================================================
Fuente: http://pankajgunwant.blogspot.com/2012/12/define-fields-manually-in-sugarcrm.html
http://www.sugarcrmcolombia.com/produccion/wiki/?p=29

*/
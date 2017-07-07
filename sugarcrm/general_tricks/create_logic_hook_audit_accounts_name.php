<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 12.01.17
 * Time: 10:56
 */

/*
Audit relate fields example Contacts / Accounts

https://developer.sugarcrm.com/2013/03/04/audit-relate-fields/
http://www.geekgumbo.com/2015/01/06/sugarcrm-the-audit-table/
http://alanstorm.com/sugar_crm_model_auditing/
*/



//custom/modules/Contacts/logic_hooks.php
$hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(90,'Audit account name','custom/modules/Contacts/auditAcc.php','auditAccC','auditAccF',);


// custom/modules/Contacts/auditAcc.php
class auditAccC
{
	function auditAccF($bean)
	{

		global $db;

		// https://developer.sugarcrm.com/2013/03/04/audit-relate-fields/
		// $bean->load_relationship('accounts');
		if ($bean->fetched_rel_row['account_id'] != $bean->account_id) {

			$aChange = array();
			$aChange['field_name'] = 'account_id';
			$aChange['data_type'] = 'relate';
			$aChange['before'] = $bean->fetched_rel_row['account_id'];
			$aChange['after'] = $bean->account_id;
			// save audit entry
			$bean->db->save_audit_records($bean, $aChange);

		}
	}
}

/// cals
class auditCallsAccount
{
	function auditCallsAccount($bean)
	{
		// check for the change
		$bean->load_relationship('accounts');
		if($bean->fetched_rel_row['account_name'] != $bean->account_name){
		// create an array to audit changes in the calls module’s audit table
		$auditEntry = array();
		$auditEntry['field_name'] = 'account_name';
            $auditEntry['data_type'] = 'relate';
            $auditEntry['before'] = $bean->fetched_rel_row['account_name'];
            $auditEntry['after'] = $bean->account_name;
            // save audit entry
            $bean->db->save_audit_records($bean, $auditEntry);
        }
    }
}

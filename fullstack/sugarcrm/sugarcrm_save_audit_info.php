<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 24.10.16
 * Time: 18:02
 */

// https://developer.sugarcrm.com/2013/03/04/audit-relate-fields/

?>


<?php
// custom/modules/Contacts/logic_hooks.php
$hook_array[‘before_save’][] = Array(
	90,
	'Audit account name',
	'custom/modules/Contacts/auditAcc.php',
	'auditAccC',
	'auditAccF');
?>

<?php
// custom/modules/Contacts/auditAcc.php
class auditAccC{
	function auditAccF($bean){
		// check for the change
		if($bean->fetched_rel_row['account_id'] != $bean->account_id){
			// prepare an array to audit the changes in parent module’s audit table
			$aChange = array();
			$aChange['field_name'] = 'account_id';
            $aChange['data_type'] = 'relate';
            $aChange['‘before'] = $bean->fetched_rel_row['account_id'];
            $aChange['after'] = $bean->account_id;
            // save audit entry
            $bean->db->save_audit_records($bean, $aChange);
        }
    }
}

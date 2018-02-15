<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 12.07.16
 * Time: 18:31
 */

/*
Grab a filtered list of related record to the current record using beans
*/

$account = new Account();
$account->retrieve($id);

$contacts = $account->contacts->getBeans();

if (!empty($contacts)) {
	foreach ($contacts as $contact) {
		echo $contact->name . "<br/>";
	}
}


//------------------------------------------------------

$account = new Account();
$account->retrieve($id);
$params = array(
	'where' => array(
		'lhs_field' => 'billing_address_state',
		'operator' => '=',
		'rhs_value' => 'OH',
	),
);
$contacts = $account->contacts->getBeans($params);

if (!empty($contacts)) {
	foreach ($contacts as $contact) {
		echo $contact->name . "<br/>";
	}
}

//------------------------------------------------------

$account = new Account();
$account->retrieve($id);
$params = array(
	'where' => array(
		'lhs_field' => 'billing_address_state',
		'operator' => '=',
		'rhs_value' => 'OH',
	),
	'limit' => '2',
);
$contacts = $account->contacts->getBeans($params);

if (!empty($contacts)) {
	foreach ($contacts as $contact) {
		echo $contact->name . "<br/>";
	}

}


//------------------------------------------------------

$account = new Account();
$account->retrieve($id);
$params = array(
	'deleted' => '1',
);
$contacts = $account->contacts->getBeans($params);

if (!empty($contacts)) {
	foreach ($contacts as $contact) {
		echo $contact->name . "<br/>";
	}
}

//------------------------------------------------------

$account = new Account();
$account->retrieve($_REQUEST['record']);
$contacts = $account->get_linked_beans('contacts', 'Contact');
foreach ($contacts as $contact) {
	echo "{$contact->name}\n" ;
}


//------------------------------------------------------


function get_linked_beans($field_name, $bean_name = '', $order_by = '', $begin_index = 0, $end_index = -1, $deleted = 0, $optional_where = ""){}
$account = BeanFactory::getBean('Accounts', '12345');

$contacts = $account->get_linked_beans('contacts');
$contacts = $account->get_linked_beans('contacts', '', 'last_name DESC');

foreach ($contacts as $contact) {
	echo $contact->name;
}

/*
https://developer.sugarcrm.com/2011/02/23/howto-using-get_linked_beans-method-to-grab-related-records/
https://developer.sugarcrm.com/2012/04/26/howto-grab-a-filtered-list-of-related-record-to-the-current-record-using-beans/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.5/Logic_Hooks/Module_Hooks/after_relationship_add/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Architecture/Logic_Hooks/Module_Hooks/after_relationship_add/
https://suitecrm.com/suitecrm/blog/entry/get-linked-beans-in-suitecrm-7-4-1-onwards*/
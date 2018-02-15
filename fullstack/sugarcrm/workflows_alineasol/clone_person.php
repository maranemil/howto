<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 26.11.16
 * Time: 00:27
 */

global $db;

$refID = create_guid();

$clonePerson = new CloneLog();
$clonePerson->new_with_id = true;
$clonePerson->id = $bean_id;

$clonePerson->date_entered = $bean->date_entered;
$clonePerson->date_modified = $bean->date_modified;
$clonePerson->modified_user_id = $bean->modified_user_id;
$clonePerson->created_by = $bean->created_by;
$clonePerson->description = $bean->description;
//$clonePerson->deleted = $bean->deleted;
$clonePerson->salutation = $bean->salutation;
$clonePerson->first_name = $bean->first_name;
$clonePerson->last_name = $bean->last_name;
$clonePerson->title = $bean->title;
$clonePerson->facebook = $bean->facebook;
$clonePerson->twitter = $bean->twitter;
$clonePerson->googleplus = $bean->googleplus;
$clonePerson->department = $bean->department;
$clonePerson->do_not_call = $bean->do_not_call;
$clonePerson->phone_home = $bean->phone_home;
$clonePerson->phone_mobile = $bean->phone_mobile;
$clonePerson->phone_work = $bean->phone_work;
$clonePerson->phone_other = $bean->phone_other;
$clonePerson->phone_fax = $bean->phone_fax;

//$clonePerson->email1 = $bean->email1;

/*$clonePerson->primary_address_street = $bean->primary_address_street;
$clonePerson->primary_address_city = $bean->primary_address_city;
$clonePerson->primary_address_state = $bean->primary_address_state;
$clonePerson->primary_address_postalcode = $bean->primary_address_postalcode;
$clonePerson->primary_address_country = $bean->primary_address_country;

$clonePerson->alt_address_street = $bean->alt_address_street;
$clonePerson->alt_address_city = $bean->alt_address_city;
$clonePerson->alt_address_state = $bean->alt_address_state;
$clonePerson->alt_address_postalcode = $bean->alt_address_postalcode;
$clonePerson->alt_address_country = $bean->alt_address_country;*/

//$clonePerson->assistant = $bean->assistant;
//$clonePerson->assistant_phone = $bean->assistant_phone;
//$clonePerson->picture = $bean->picture;
//$clonePerson->contact_id_c = $bean->contact_id_c;
//$clonePerson->team_id = $bean->team_id;
//$clonePerson->team_set_id = $bean->team_set_id;

$clonePerson->assigned_user_id = $bean->assigned_user_id;
$clonePerson->parent_type = $bean->parent_type;
$clonePerson->parent_id = $bean->parent_id;
$clonePerson->duplicate_status = $bean->duplicate_status;
$clonePerson->duplicate_count = $bean->duplicate_count;
$clonePerson->rollbackdata = $bean->rollbackdata;
$clonePerson->save();

// SET EMAIL
$sea = new SugarEmailAddress;
$primaryemailaddress = $sea->getPrimaryAddress($bean);
// Grab the primary address for the given record represented by the $bean object

//$GLOBALS["log"]->security($primaryemailaddress);
//$GLOBALS["log"]->security(gettype($primaryemailaddress));
//$GLOBALS["log"]->security("____________________________");

$seaclone = new SugarEmailAddress;
$seaclone->addAddress($primaryemailaddress, true); // Add a primary email address
// $sea->addAddress($primaryemailaddress, false, null, true); // Add an invalid email address
// $sea->addAddress($primaryemailaddress, false, null, false, true); // Add an email address that should be marked opt-out
// Associate the email address with the given module and record
//$seaclone->save($refID, "CloneLog",array($primaryemailaddress), true);
$seaclone->save($refID, "CloneLog");
	
	


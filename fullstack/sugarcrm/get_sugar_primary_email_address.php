<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 10.03.16
 * Time: 18:09
 */


$u = new User();
$u->retrieve_by_email_address($email_addr);

$user=BeanFactory::getBean('Users',$user_id);
$primary_email=$user->emailAddress->getPrimaryAddress($user);

//http://developer.sugarcrm.com/2012/12/26/get-the-primary-email-address-for-a-record-using-the-bean/
//--------------------------------------------------------------
$sugar_config['allow_sendmail_outbound'] = true;
//http://support.sugarcrm.com/Knowledge_Base/Getting_Started/Introduction_to_Email_Functionality_in_Sugar/
//------------------------------------------------------------

$sea = new SugarEmailAddress;
// Add a primary email address
$sea->addAddress($primaryemailaddress, true);
// Add an invalid email address
$sea->addAddress($primaryemailaddress, false, null, true);
// Add an email address that should be marked opt-out
$sea->addAddress($primaryemailaddress, false, null, false, true);
// Associate the email address with the given module and record
$sea->save($record_id, "module_name");



$sea = new SugarEmailAddress;
// Grab the primary address for the given record represented by the $bean object
$primary = $sea->getPrimaryAddress($bean);




$sea = new SugarEmailAddress;
// Grab the array of addresses
$addresses = $sea->getAddressesByGUID($id, $module);
foreach ( $addresses as $address ) {
	echo $address->email_address . "\n";
}

//http://developer.sugarcrm.com/2011/03/08/howto-add-and-retrieve-email-addresses-in-a-module-thru-code/

/*
 * using js


// Get email
--------------------------------------------------------
	var moduleName = "Users";
	var filters = [{id: app.user.get("id")}];
	var Users = App.data.createBeanCollection(moduleName)
	var req = Users.fetch({"filter": filters});
	req.xhr.success(function (data) {
		if (data.records.length > 0) {
			// console.debug(data)
			userEmail = data.records[0].email[0].email_address
			//console.debug("[email]" + data.records[0].email[0]['email_address'])  # ok
			//console.debug(".email" + data.records[0].email[0].email_address)      # ok
		}
	});



// Set email
--------------------------------------------------------
this.model.set('email', [{email_address: "email@example.com", primary_address: true}]);
this.$el.find('div[data-name="email"] input').first().val(email);
#this.render();
#this.model.save();
#this.editClicked();



// email array
--------------------------------------------------------
email
	0
		email_address		"email@example.com"
		invalid_email		false
		opt_out			    false
		primary_address		true
		reply_to_address	false

 * */
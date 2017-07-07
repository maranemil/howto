<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 30.11.15
 * Time: 09:21
 */

$db = & DBManagerFactory::getInstance();

/*
---------------------------------------------------
Create Custom Random ID
---------------------------------------------------
*/

if(empty($bean->id))
{
	$bean->id = create_guid();
	$bean->new_with_id = true;
}
/*
---------------------------------------------------
Identifying New from Existing Records
---------------------------------------------------
*/
if (!isset($bean->fetched_row['id'])){
	//new record
}
else{
	//existing record
}
# or
if (!empty($this->bean->fetched_row['id'])) {
	// record is new
}
//Or yet another to check for the elusive record
else if (!is_array($this->bean->fetched_row)) {
	// record is new
}


/*
---------------------------------------------------
Saving a Bean with a Specific Id
---------------------------------------------------
*/
//Create bean
$bean = BeanFactory::newBean($module);
//Set the record id
$bean->id = '38c90c70-7788-13a2-668d-513e2b8df5e1';
$bean->new_with_id = true;
//Populate bean fields
$bean->name = 'Example Record';
//Save
$bean->save();

/*
---------------------------------------------------
Obtaining the Id of a Recently Saved Bean
---------------------------------------------------
*/
//Create bean
$bean = BeanFactory::newBean($module);
//Populate bean fields
$bean->name = 'Example Record';
//Save
$bean->save();
//Retrieve the bean id
$record_id = $bean->id;

/*
---------------------------------------------------
Delete Record
---------------------------------------------------
*/
$focus->retrieve('the record id');
$focus->mark_deleted();
$focus->save();

/*
---------------------------------------------------
Update
---------------------------------------------------
*/
$focus->retrieve('the record id');
$focus->name = 'Tom';
$focus->city = 'Baltimore';
$focus->save();

/*
---------------------------------------------------
Get RelationShep
---------------------------------------------------
*/
$focus = new Account();
$focus->retrieve('my record id');
$focus->load_relationship('contacts');

$list = array();
foreach ($focus->contacts->getBeans() as $contact) {
	$list[$contact->id] = $contact;
}

/*
---------------------------------------------------
Add and Delete RelationShep
---------------------------------------------------
*/

$focus = new Account();
$focus->retrieve('my account id');
$focus->load_relationship('contacts');
$focus->contacts->add('my contact id');
$focus->save();

$focus = new Account();
$focus->retrieve('my account id');
$focus->load_relationship('contacts');
$focus->contacts->delete($focus->id, 'my contact id');
$focus->save();

/*
---------------------------------------------------
Insert Record with Custom ID
---------------------------------------------------
*/
$current_id = $bean->fetched_row['id'];
$focus = BeanFactory::getBean('Account', $current_id);
$focus->id = create_guid();
$focus->new_with_id = true;
$focus->save();


/*
---------------------------------------------------
Include Bean Class
---------------------------------------------------
*/
global $beanList;
global $beanFiles;
include_once ($beanFiles [ $bean_name ]) ;

$focus = new $bean_name();
$focus->retrieve($bean_id);
$focus->some_field = 'new value';
$focus->save();


/*
---------------------------------------------------
BeanFactory
---------------------------------------------------
*/
$bean = BeanFactory::newBean($module);
$bean = BeanFactory::newBeanByName($name);

$bean = BeanFactory::getBean($module, $record_id);
$bean = BeanFactory::getBean($module, $record_id, array('disable_row_level_security' => true, 'use_cache' => false));

$bean = BeanFactory::retrieveBean($module, $record_id);
$bean = BeanFactory::retrieveBean($module, $record_id, array('disable_row_level_security' => true, 'use_cache' => false));

$moduleKey = BeanFactory::getObjectName($moduleName);
$moduleClass = BeanFactory::getBeanName($module);


/**
 * https://developer.sugarcrm.com/2012/03/23/howto-using-the-bean-instead-of-sql-all-the-time/
 * http://developer.sugarcrm.com/2012/03/23/howto-using-the-bean-instead-of-sql-all-the-time/
 * http://www.geekgumbo.com/2014/10/07/sugarcrm-the-sugarbean/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.5/Application_Framework/Teams/Manipulating_Teams_Programatically/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.7/Application_Framework/SugarBean/Fetching_Relationships/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.5/Application_Framework/SugarBean/CRUD_Handling/
 * http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.5/API/Classes/BeanFactory/
 */





// ---------------------------------------------------------
// ADD SYSTEM NOTIFICATIONS
// ---------------------------------------------------------

// hatimalam/customOppLogicHooks.php
// https://gist.github.com/hatimalam/71b540cebf110aac3239#file-customopplogichooks-php
// PHP
$notification_bean = BeanFactory::getBean("Notifications");
$notification_bean->name = 'Opportunity - {$bean->name} is in danger';
$notification_bean->description = 'Discount percentage is more than 25%.';
$notification_bean->parent_id = $bean->id;
$notification_bean->parent_type = 'Opportunities';
$notification_bean->assigned_user_id = $manager_id;
$notification_bean->severity = "warning"; // warning information alert
$notification_bean->is_read = 0;
$notification_bean->save();

// ---------------------------------------------------------

// https://gist.github.com/hatimalam/bdfc7929a240db6d78f0#file-testcontactapi-php
// PHP
$notification_bean = BeanFactory::getBean("Notifications");
$notification_bean->name = "Contact updated successfully.";
$notification_bean->message = "Details of the update can go here.";
$notification_bean->parent_type = "Contacts";
$notification_bean->parent_id = "{$contact_id}"; //where $contact_id will come as an argument to api
$notification_bean->assigned_user_id = "{$contact_assigned_user_id}"; //where $contact_assigned_user_id is assigned user id of contact
$notification_bean->is_read = 0;
//set the level of severity
$notification_bean->severity = "information";
$notification_bean->save();

// ---------------------------------------------------------

// PHP https://developer.sugarcrm.com/2016/03/14/sugar-notifications-in-action/
$parent_bean = BeanFactory::getBean($bean->parent_type, $bean->parent_id);
//initialize notification bean
$notification_bean = BeanFactory::getBean("Notifications");
//check if comment or a post
$notification_bean->name = ($bean->activity_type=="post" && $bean->comment_count==0) ? "New post on {$bean->parent_type}" : "New comment on {$bean->parent_type}";
$notification_bean->description = "New update has been posted on <a href='#{$bean->parent_type}/{$parent_bean->id}'>{$parent_bean->name}</a>";
//assigned user should be record assigned user
$notification_bean->assigned_user_id = $parent_bean->assigned_user_id;
$notification_bean->parent_id = $bean->parent_id;
$notification_bean->parent_type =  $bean->parent_type;
$notification_bean->created_by = $bean->created_by;
//set is_read to no
$notification_bean->is_read = 0;
//set the level of severity
$notification_bean->severity = "information";
$notification_bean->save();
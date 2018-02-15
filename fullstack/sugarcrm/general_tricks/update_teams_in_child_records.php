<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 19.12.16
 * Time: 14:28
 */


/*
###############################################
Manipulating_Teams_Programatically
###############################################

http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.5/Application_Framework/Teams/Manipulating_Teams_Programatically/
https://developer.sugarcrm.com/2012/11/05/how-to-get-all-related-teams-using-beans/
http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_7.7/Architecture/Teams/
http://greg.ambrose.id.au/2013/09/28/adding-and-removing-teams-within-sugar/
*/

class ContactsTeamUpdate
{

	function ContactsTeamUpdateAfterSave($bean, $action, $event)
	{


		if ( preg_match( "/v10\/Accounts(.*)link\/contacts/",$_REQUEST["__sugar_url"]) &&
			count($event["dataChanges"])==0 && isset($bean->account_id) )
		{

			$_REQUEST["record"] = $bean->id;

			require_once("modules/Accounts/Account.php");
			$ac = new Account();
			$ac->disable_row_level_security = true;
			$ac->use_cache = false;
			$ac->retrieve($bean->account_id);

			//Create a TeamSet bean - no BeanFactory
			/*
			require_once('modules/Teams/TeamSet.php');
			$teamSetBean = new TeamSet();
			$module = "Contacts";
			$record_id = $bean->id;
			$bean = BeanFactory::getBean($module, $record_id);
			$teams = $teamSetBean->getTeams($bean->team_set_id);
			*/

			/*$teamBean  = new Team();
			$teamname1 = $teamBean->getTeamName($bean->team_id);
			$teamname2 = $teamBean->getTeamName($ac->team_id);
			$GLOBALS["log"]->fatal("contact team ".$teamname1);
			$GLOBALS["log"]->fatal("account team ".$teamname2);*/

			if($bean->team_id == $ac->team_id){
				// do nothing
			}else{

				//$GLOBALS["log"]->fatal($bean->team_id ."cnt.....acc". $ac->team_id);
				$bean->load_relationship('teams');
				$bean->teams->add(array($ac->team_id,$bean->team_id));
				//$bean->teams->remove(array($bean->team_id)); // [ERROR] Error attempting to remove primary team id [1] for [Contact] module with id
				//Set the primary team
				$bean->team_id = $ac->team_id;
				$bean->team_set_id = $ac->team_id;
				$bean->save();
			}
		}
	}
}

//--------------------------------------------
// EntryPoint Test
//--------------------------------------------

/*
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

#if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
if (!defined('sugarEntry') || !sugarEntry) define('sugarEntry', TRUE);
header("Content-Type: text/html; charset=utf-8");
#header("Content-Type: text/html; charset=8859-1");

include_once('include/entryPoint.php');

require_once("modules/Contacts/Contact.php");
$bean=new Contact();
$bean->disable_row_level_security=true;
$bean->retrieve("50c770e7-76eb-fd21-a145-5857bc1c7d1e");


require_once("modules/Accounts/Account.php");
$ac=new Account();
$ac->disable_row_level_security=true;
$ac->retrieve($bean->account_id); // 867f2e3f-f65a-d76d-6ead-57b1e4b2669d

echo "<br>"; echo $bean->name . " //// " . $ac->name; //die();

$teamBean  = new Team();
$teamname1 = $teamBean->getTeamName($bean->team_id);
$teamname2 = $teamBean->getTeamName($ac->team_id);

echo "<br>";
echo "contact team id --- ".$teamname1 . " / ". $bean->team_id;
echo "<br>";
echo "account team id --- ".$teamname2. " / ". $ac->team_id;

$bean->load_relationship('teams'); // returns true
$bean->teams->add(array($ac->team_id));
$bean->teams->remove(array($bean->team_id));
//Set the primary team
$bean->team_id = $ac->team_id;
$bean->save();

*/

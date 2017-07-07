<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 19.12.16
 * Time: 14:40
 */



// https://developer.sugarcrm.com/2012/11/05/how-to-get-all-related-teams-using-beans/
// https://gist.github.com/jmertic/3975048#file-gistfile1-php

require_once('modules/Teams/Team.php');
require_once('modules/Teams/TeamSet.php');

$accountBean = BeanFactory::getBean("Accounts");
$teamBean  = new Team();

// Lets grab all the records
$accountsBeanList = $accountBean->get_list();

// Lets create a team set bean -- no bean factory
$teamSetBean = new TeamSet();

// Let process all the beans
foreach ($accountsBeanList["list"] as $focus){

	// Lets grab a related teams for the current bean
	$teams = $teamSetBean->getTeams($focus->team_set_id);

	foreach ($teams as $team) {
		/*
		 *  THIS IS WHERE WE CAN PROCESS EACH TEAM FOR THE ACCOUNT
		 */
		switch ($team->name) {
			case "Northern Region":
				echo "Do something for Northern Regional Team";
				break;
			case "Southern Region":
				echo "Do something for Southern Regional Team";
				break;
			case "Western Region":
				echo "Do something for Western Regional Team";
				break;
			case "Eastern Region":
				echo "Do something for Eastern Regional Team";
				break;
		}
	}
}

// Manipulating Teams Programatically
// http://support.sugarcrm.com/Documentation/Sugar_Developer/Sugar_Developer_Guide_6.5/Application_Framework/Teams/Manipulating_Teams_Programatically/

// ------------------------------
// Fetching Teams
// ------------------------------

//Create a TeamSet bean - no BeanFactory
require_once('modules/Teams/TeamSet.php');
$teamSetBean = new TeamSet();

//Retrieve the bean
$bean = BeanFactory::getBean($module, $record_id);

//Retrieve the teams from the team_set_id
$teams = $teamSetBean->getTeams($bean->team_set_id);


// ------------------------------
// Adding Teams
// ------------------------------

//Retrieve the bean
$bean = BeanFactory::getBean($module, $record_id);

//Load the team relationship
$bean->load_relationship('teams');

//Add the teams
$bean->teams->add(
	array(
		$team_id_1,
		$team_id_2
	)
);

// ------------------------------
// Removing Teams
// ------------------------------

//Retrieve the bean
$bean = BeanFactory::getBean($module, $record_id);

//Load the team relationship
$bean->load_relationship('teams');

//Remove the teams
$bean->teams->remove(
	array(
		$team_id_1,
		$team_id_2
	)
);

// ------------------------------
// Replacing Team Sets
// ------------------------------

//Retrieve the bean
$bean = BeanFactory::getBean($module, $record_id);

//Load the team relationship
$bean->load_relationship('teams');

//Set the primary team
$bean->team_id = $team_id_1;

//Replace the teams
$bean->teams->replace(
	array(
		$team_id_1,
		$team_id_2
	)
);

//Save to update primary team
$bean->save();


// ------------------------------
// Creating and Retrieving Team Set IDs
// ------------------------------

//Create a TeamSet bean - no BeanFactory
require_once('modules/Teams/TeamSet.php');
$teamSetBean = new TeamSet();

//Retrieve/create the team_set_id
$team_set_id = $teamSetBean->addTeams(
	array(
		$team_id_1,
		$team_id_2
	)
);
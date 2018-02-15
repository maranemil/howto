<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 01.12.16
 * Time: 14:35
 */



$viewdefs['Contacts']['base']['view']['subpanel-for-cases'] = array(
	'type' => 'subpanel-list',
	'panels' =>
		array(
			array(
				'name' => 'panel_header',
				'label' => 'LBL_PANEL_1',
				'fields' =>
					array(
						array(
							'name' => 'full_name',
							'type' => 'fullname',
							'fields' => array(
								'salutation',
								'first_name',
								'last_name',
							),
							'link' => true,
							'label' => 'LBL_LIST_NAME',
							'enabled' => true,
							'default' => true,
						),
						array(
							'name' => 'account_name',
							'target_record_key' => 'account_id',
							'target_module' => 'Accounts',
							'label' => 'LBL_LIST_ACCOUNT_NAME',
							'enabled' => true,
							'default' => true,
						),
						array(
							'name' => 'email',
							'label' => 'LBL_LIST_EMAIL',
							'enabled' => true,
							'default' => true,
						),
						array(
							'name' => 'phone_work',
							'label' => 'LBL_LIST_PHONE',
							'enabled' => true,
							'default' => true,
						),
					),
			),
		),


	// To remove this action block set actions array as empty!
	'rowactions' => array(
		'actions' => array(
			array(
				'type' => 'rowaction',
				'css_class' => 'btn',
				'tooltip' => 'LBL_PREVIEW',
				'event' => 'list:preview:fire',
				'icon' => 'fa-eye',
				'acl_action' => 'view',
				'allow_bwc' => false,
			),
			array(
				'type' => 'rowaction',
				'name' => 'edit_button',
				'label' => 'LBL_EDIT_BUTTON',
				'event' => 'list:editrow:fire',
				'acl_action' => 'edit',
				'css_class' => 'disabled', // <-- Add Here this code
			),
		),
	),

);

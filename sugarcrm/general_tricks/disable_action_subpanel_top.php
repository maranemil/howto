<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 01.12.16
 * Time: 14:36
 */


// Disable subpanel top actions


$viewdefs['Contacts']['base']['view']['panel-top-for-prospectlists'] = array(
	'type' => 'panel-top',
	'buttons' => array(
		array(
			'type' => 'actiondropdown',
			'name' => 'panel_dropdown',
			'css_class' => 'pull-right',
			'buttons' => array(
				array(
					'type' => 'sticky-rowaction',
					'icon' => 'fa-plus',
					'name' => 'create_button',
					'label' => ' ',
					'acl_action' => 'create',
					'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
					//'enabled' => false,
					'css_class' => 'disabled', // <-- Add Here this code
				),
				array(
					'type' => 'link-action',
					'name' => 'select_button',
					'label' => 'LBL_ASSOC_RELATED_RECORD',
					//'enabled' => false,
					'css_class' => 'disabled', // <-- Add Here this code
				),
				array(
					'type' => 'linkfromreportbutton',
					'name' => 'select_button',
					'label' => 'LBL_SELECT_REPORTS_BUTTON_LABEL',
					'initial_filter' => 'by_module',
					'initial_filter_label' => 'LBL_FILTER_CONTACTS_REPORTS',
					'filter_populate' => array(
						'module' => array('Contacts'),
					),
				),
			),
		),
	),
);

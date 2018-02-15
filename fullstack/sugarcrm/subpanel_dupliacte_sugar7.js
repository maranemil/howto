/**
 * Created by emil on 24.10.16.
 */


// subpanel-list.js

({

	extendsFrom: 'SubpanelListView',

	initialize: function (options) {
		_.bindAll(this);

		app.view.invokeParent(this, {type: 'view', name: 'recordlist', method: 'initialize', args:[options]});
		//app.view.invokeParent(this, {type: 'view', name: 'record', method: 'initialize', args:[options]});

		//add listener for custom button
		this.context.on('list:duplicate_button:fire', this.duplicateClicked, this);
	},

	duplicateClicked: function(model){
		var self = this;
		// model = this._modelToCopy;
		app.api.call(
			'read',
			app.api.buildURL(model.get('_module'),'read',{id:model.get('id')}),
			null,
			{
				success: function(data) {
					bean = app.data.createBean(data._module,data);
					bean.unset('id');
					// console.log(bean);
					app.drawer.open({
							layout : 'create-actions',
							context : {
								create : true,
								model : bean,
								module : bean.get('_module'),

							}
						}, function(context, newModel) {
							if (newModel && newModel.id) {

								// app.router.navigate(self.model.module + '/' + newModel.id, {trigger: true});
								location.reload();

								// app.router.navigate('Accounts/' + model.get('id'), {trigger: true});
							}
						}


					);
				},
				error: function() {
					return;
				}
			}
		);
	},


})

// subpanel-list.php
// https://gist.github.com/cAstraea/8126d7be83983c4e5d5e

/*
* $viewdefs['Opportunities']['base']['view']['subpanel-list'] = array(
 'template' => 'recordlist',
 'favorite' => true,
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
 'icon' => 'fa-pencil',
 'label' => 'LBL_EDIT_BUTTON',
 'event' => 'list:editrow:fire',
 'acl_action' => 'edit',
 'allow_bwc' => true,
 ),
 array(
 'type' => 'unlink-action',
 'icon' => 'fa-chain-broken',
 'label' => 'LBL_UNLINK_BUTTON',
 ),
// Here is the button
array(
	'type' => 'rowaction',
	'event' => 'list:duplicate_button:fire',
	'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
	'name' => 'duplicate_button',
	'acl_module' => 'Accounts',
	'acl_action' => 'create',
	'allow_bwc' => false,
),
// end custom addition
),
),
'last_state' => array(
	'id' => 'subpanel-list',
),
);*/


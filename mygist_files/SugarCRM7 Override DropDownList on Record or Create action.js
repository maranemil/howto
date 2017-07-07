///////////////////////////////////////////////////////////////
//
// SugarCRM7 Override DropDownList on Record.js or Create.js
//
///////////////////////////////////////////////////////////////

//custom/modules/Accounts/clients/base/views/create-actions/create-actions.js

({
	// CustomCreate-actions View (base)
	extendsFrom: 'CreateActionsView',
	events: {
		'change input[name=industry]': 'OverrideAccountType'
	},
	initialize: function (options) {
		this._super('initialize', [options]);
	},
	bindDataChange: function () {
		this.on('render', function () {
			this.render()
		}, this);
		this._super("bindDataChange");
	},
	render: function () {
		this._super('render');
	},
	_renderHtml: function (ctx, options) {
		this._super('_renderHtml', [ctx, options]);
		/*this.$el.find('.record .record-cell').css('border','1px solid red');
		var myAddition = app.template.get("my-record.mine");
		this.$el.prepend(myAddition());*/
	},
	OverrideAccountType: function () {

		// set value in input dropdown
		this.model.set('account_type','Analyst')
		//this.model.set('account_type', 'Analyst', {silent: true});

		// set values on select
		var values = [
			{id: 'Analyst', text: 'Analyst'},
		];

		/*
		 //Merge 2 Lists
		 //console.debug(this.model.fields['account_type'].options)
		 var dataAcc = app.lang.getAppListStrings('account_type_dom');
		 Object.keys(dataAcc).forEach(function(key) {
		 var check = dataAcc[key].match(/Analyst/);
		 if(!dataAcc[key].match(/Analyst/)){
		 //delete dataAcc[key];
		 if(dataAcc[key]!=""){
		 console.debug(dataAcc[key])
		 values.push({id:dataAcc[key], text: dataAcc[key]})
		 }
		 }
		 });
		 this.model.fields['account_type'].options = values;

		 */

		/*_.each(data, function(item, index){
		 values.push({id:item.id, text: item.text});
		 });*/

		// ovverride select list
		this.$el.find('input[name=account_type]').select2({
			width: "100%",
			containerCssClass: 'select2-choices-pills-close',
			data: values
		});

	},
	_dispose: function () {
		this._super('_dispose');
	},
})

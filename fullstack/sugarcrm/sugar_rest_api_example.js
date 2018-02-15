//////////////////////////////////////////
//
// Sugar Rest API References Options Calls
//
// http://backbonejs.org/#Sync
// http://handlebarsjs.com/block_helpers.html
//
//////////////////////////////////////////

// Check if extended APi function is registered in Rest accesing:  http://yoursugar/rest/v10/help

// Create URL
var url = app.api.buildURL('Module', 'read', options.attributes, options.params); // Exx: accounts
url = url + '/filter?max_num=4&'

// Filter Options: contains|starts|ends|equals
var filter = 'filter[0][$or][0][first_name][$starts]=' + queryStr + '&filter[0][$or][1][last_name][$starts]=' + queryStr + '';
filter += '&fields=id,account_id,full_name,first_name,last_name'


//app.api.call(method, url, null, callbacks, options.params);
var AjaxCall = app.api.call(
    "read",         // methods:  read|update|create|patch|delete      # http://backbonejs.org/#Sync
    url + filter,   // url
    null,           // data {} - params args
    {
        // callbacks here
        success: function (response) {

            console.log(response)

            // Example extra callbacks
            app.controller.context.trigger(
                'subpanel:reload',
                {
                    links: ['Module'], // Ex: notes
                    actionCommand: {

                        "1": app.api.call(
                            "update",
                            "rest/v10/Contacts/f110f2eb-dbeb-f2d5-8b05-548ea6d285c9?viewed=1",
                            {
                                "department": "test - " + new Date().getTime()
                            },
                            {
                                success: function (data) {

                                }
                            },
                            {
                                "data": "&viewed=1",
                                "dataType": "json",
                                "type": "PUT"
                            }
                        ),
                        "2": app.router.navigate (
                            App.router.buildRoute('Contacts', 'f110f2eb-dbeb-f2d5-8b05-548ea6d285c9', null),
                            {trigger: true}
                        )

                    }
                });

        },
        error: function (response) {
            console.log(response)
        }
    },
    {
        "data": "&filter=" + filter,
        "dataType": "json",
        "type": "GET"
    }
);


/**
 *
 * Save Email in Record Sugar 7.6
 *
 * */

this.model.set('email', [{email_address: "some@example.com", primary_address: true}]);
this.model.save();
//this.render();
//this.editClicked();

/**
 *
 * Refresh parent record after update
 *
 */

self.model.fetch();
SUGAR.App.controller.context.reloadData({})

/**
 *
 * Refresh parent record - specify field
 *
 */

model.fetch({
	view: undefined,
	fields: ['industry']
});

model.fetch({fields: ['industry']});

var parentmodel = this.context.parent.get('model');
parentmodel.fetch({
	view: undefined,
	fields: ['custom_field_c']
});

// ---------------------------------------------

({
	extendsFrom:'SubpanelListView',
	initialize: function(options){
		this._super('initialize', [options]);
		this.context.on('list:deleterow:fire',this.SomeFunctionHere, this);
	},
	SomeFunctionHere: function(){
		var parentModel=this.context.parent.get('model');
		this.warnDelete;
		parentModel.fetch();
	},

})

/**
 *
 * Search inside Dashlet and modify css
 *
 */

self.layout.$el.find('.block-footer').css({"display": "none"});

/**
 *
 * Select specific item from list
 *
 */

({
	extendsFrom: 'TabbedDashletView',
	initialize: function (options) {
		this._super('initialize', [options]);
		this.events = _.extend({}, this.events, {
			'click .list-class-items': 'someFunction',
		});
		this.tbodyTag = 'ul[data-action="pagination-body"]';
		this.on('render', this._renderInitForm, this);
	},
	someFunction: function (e) {
		//e.preventDefault();
		var self = this
		var someVar = $(e.currentTarget).attr('data-id');
	}
})


/**
 *
 * Select checkbox values from list view
 *
 */

var self = this;
var selMod = this.module
var selLst = {};
var cntLst = 0;
$("tr[name^='"+selMod+"']").each(function () { //loop over each row
	var selID = ''
	if( $(this).find('input[name="check"]').attr("checked")=="checked" ){
		selID = $(this).attr("name") //.replace(""+selMod+"_","")
		selLst[cntLst] = selID;
		cntLst++;
	}
});

/** Alternative way to Select List */
({
	extendsFrom: 'RecordlistView',
	initialize: function (options) {
		this._super('initialize', [options]);
		this.context.on('list:testlistbutton:fire', this.testlistbuttonFunc, this);
	},
	testlistbuttonFunc: function () {
		console.log("Test button in list view gets called");
		var massCollection = this.context.get("mass_collection");
		var id_array = [];
		massCollection.each(function (data) {
			id_array.push(data.id); //pushing ids of selected
		});
	}
})






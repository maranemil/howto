/**
* Created by emil on 18.08.15.
*/



// Get info user
// -----------------------------------------------------
var u_id 		= app.user.id; // if (u_id == 'seed_jim_id') {}
var u_fullname 	= app.user.get("full_name");


// Get info admin + manager
// -----------------------------------------------------
var isManager       = app.user.get('is_manager');
var isAdmin         = app.user.type; // admin?
if(isAdmin=="admin"){} // admin|user


// Get info user by id
// -----------------------------------------------------
var user         = app.data.createBean('Users', {id: app.user.id});
//var acls         = app.user.getAcls().Contacts,hasAccess=(!_.has(acls,'access')||acls.access=='yes')....


// Modify acl info
// -----------------------------------------------------
var usrAcl          = App.user.getAcls();
usrAcl.Accounts.create = 'no';
App.user.set("acls", usrAcl);


// Get preferences in SugarCRM
// -----------------------------------------------------
var usrPref = app.user.getPreference('email_client_preference');
this.model.set('assigned_user_id', app.user.id);
//app.user.set(data.initData.userData);


// Get info and roles from user by id
/*  Author: Angel Magaña - cheleguanaco@cheleguanaco.com
 *
 *   This Gist can be used within a Sugar 7 Controller to retrieve a user's
 *   security Roles
 *   http://cheleguanaco.blogspot.de/2014/04/sugarcrm-cookbook-retrieving-user-roles.html
 *
 */
// -----------------------------------------------------
var user = app.data.createBean('Users', {id: app.user.id});
user.fetch();
var user_roles = user.getRelatedCollection('aclroles');
user_roles.fetch({relate:true});







// Get User Date preferences in SugarCRM
// -----------------------------------------------------
var moduleName = "MyCustomModuleRelationships";
var filters = [{deleted: 0, parent_id: self.model.get("id")}]; // id: app.user.get("id")
var Users = App.data.createBeanCollection(moduleName)
var req = Users.fetch({"filter": filters});
req.xhr.success(function (data) {
	if (data.records.length > 0) {
		
		var refLastDate = data.records[0].last_contact
		var refNextDate = data.records[0].next_contact
		
		var rbDate = new Date();
		var ONE_DAY = 60 * 60 * 1000 * 24;
		/* ms */
		var INTERVAL = ONE_DAY * refNextDate;

		// var lastContactDate = new Date(rbDate.getTime());
		// var lastContactDate = app.date(rbDate).formatServer()
		// var lastContactDate = app.date(rbDate).format("YYYYMMDD")
		//var lastContactDate = app.date.format(rbDate, app.user.getPreference('datepref') + ' ' + app.user.getPreference('timepref'));
		var lastContactDate = app.date.format(rbDate, app.user.getPreference('datepref'));
		
		/*value = {
		 'date': value.format(app.date.convertFormat(this.getUserDateFormat())),
		 'time': value.format(app.date.convertFormat(this.getUserTimeFormat()))
		 };*/

		//var nextContactDate = new Date(rbDate.getTime() + INTERVAL );
		//var nextContactDate = app.date.format(new Date(rbDate.getTime() + INTERVAL ), app.user.getPreference('datepref') + ' ' + app.user.getPreference('timepref'));
		var nextContactDate = app.date.format(new Date(rbDate.getTime() + INTERVAL), app.user.getPreference('datepref'));

	}

});


























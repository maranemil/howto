/**
 * Created by emil on 18.03.16.
 */

/*
####################################################
#
# CRUD SUGARCRM JS
#
####################################################
*/

// --------------------------------------------------
// CREATE NEW LEAD
// var user = app.data.createBean('Users', {id: app.user.id});
var prospects = app.data.createBean('Leads');
prospects.set({
	id: app.utils.generateUUID(), // Create unique UUID
	first_name: strFirstName,
	last_name: strLastName,
	title: strTitle,
	account_name: strCompany
});
// Force to save with POST
prospects.id = null;
prospects.save();


// --------------------------------------------------
// RETRIEVE ALL RECORDS BY FILTER
var moduleName = "Leads";
var filters = [{deleted: 0, id: self.model.get('id'), approved: 'yes'}];
var Leads = App.data.createBeanCollection(moduleName)
var req = Leads.fetch({"filter": filters});
req.xhr.success(function (data) {
	if (data.records.length > 0) {
		console.debug(data.records.length)
	}
});

// --------------------------------------------------
// RETRIEVE RECORD BY ID
var request = app.api.call('read', 'rest/v10/Leads/' + selID, {}, {}, {"dataType": "json", "type": "GET"});
request.xhr.done(function (data) {
	// do something
});


//-----------------------------------------------------
// GET ALL EMAIL FROM USER
var userEmail = ''
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
		//... "value", app.user.set('email', [{email_address: data, primary_address: true}]
	}
});


// --------------------------------------------------
// UPDATE RECORD V1
var request = app.api.call('update', 'rest/v10/Leads/' + selID, {"id": selID, approved: 'no'}, {},
	{"dataType": "json", "type": "PUT"});
request.xhr.done(function (data) {});

// UPDATE RECORD V2
var queueObj = app.data.createBean('Leads', {id: selID});
queueObj.set("somevar", '1');
queueObj.save();


// --------------------------------------------------
// DELETE RECORD
var request = app.api.call('delete', 'rest/v10/Leads/' + selQueueID,
	{"id": selQueueID}, {}, {"dataType": "json", "type": "DELETE"});
request.xhr.done(function (data) {});


// --------------------------------------------------
// UPDATE RECORD LINK MEETING CONTACTS
var MeetingRecordOBJ = {
	id: "77f825843ce01f08e92242f847976702"
}
var MeetingRecordID = self.model.get('id') || MeetingRecordOBJ.id;
var ContactID = "dcf825843ce01f08e92242f847976702";
var url2 = app.api.buildURL('Meetings', MeetingRecordID);
//url2 = url2 + '/';
app.api.call("update", url2, MeetingRecordOBJ,
	{
		success: function (response_update) {
			/////////////// -------------------------- ///////////////////
			var objMeetingContact = {}
			objMeetingContact.contact_id = ContactID;
			objMeetingContact.meeting_id = MeetingRecordID

			var url2b = app.api.buildURL('Meetings', MeetingRecordID);
			url2b = url2b + '/link/contacts/' + ContactID + "?fields[]=my_favorite&fields[]=type";

			app.api.call("create", url2b, objMeetingContact,
				{
					success: function (data) {
						app.controller.context.trigger('subpanel:reload', {links: ['meetings']});
					}
				});
			app.controller.context.trigger('subpanel:reload', {links: ['meetings']});
		}
	});


// --------------------------------------------------
// CREATE LINK CALLS FOR CONTACT

var self = this;
var contactID = "77f825843ce01f08e92242f847976702";
var module_create = "Contacts";
var id_create = this.model.get("id");
var subject = contact.full_name;
var url = app.api.buildURL(module_create, id_create);

callObject = this.getCallObjectCalls(subject); // get data
if (module_create == "Contacts") {
	var url = app.api.buildURL(module_create, contactID);
}
// Create Call
url = url + '/link/calls';
app.api.call("create", url, callObject, {
	success: function (data_call) {
		var url2 = app.api.buildURL('Calls', data_call.related_record.id);
		var contactId = contactID; // Create call link to contact
		url2 = url2 + '/link';
		app.api.call("create", url2, {link_name: "contacts", ids: [contactId]},
		{
			success: function (data_call_contact) {
				var url = app.api.buildURL('Contacts', data_call_contact.related_records[0].id);
				// +++++++++ Read Account from Contact +++++++++
				app.api.call("read", url, null, {
					success: function (data_contact_rel) {

						if (data_contact_rel.account_id) {
							var url3 = app.api.buildURL('Calls', data_call_contact.record.id);
							url3 = url3 + '/link/accounts/' + data_contact_rel.account_id;
							app.api.call("create", url3, {
								parent_type: "Accounts",
								parent_id: data_contact_rel.account_id,
								contact_id: data_contact_rel.id
							});
						}
					}
				});
				app.controller.context.trigger('subpanel:reload', {links: ['calls']});
			}
		});
	}
});



// Matt Marum - Jun 15, 2015 11:26 PM
// --------------------------------------------------
// CREATE NOTIFICATION

var notification = App.data.createBean("Notifications");
notification.set("name", "matt's test notification");
notification.set("severity", "alert");
notification.set("assigned_user_id", App.user.get("id"));
//notification.set("is_read", true);
notification.save();









// --------------------------------------------------
// CREATE LINK ACCOUNT FOR CONTACT
// SEARCH WITH FILTER %web-domain%

var requestX = app.api.call('read', 'rest/v10/SomeModule/' + selAUID,
	{}, {}, {"dataType": "json", "type": "GET"});
requestX.xhr.done(function (data) {
	console.debug(data)
	var emailAddr = data.email1;
	if (!_.isEmpty(emailAddr)) {
		var emailTmp = emailAddr.split("@");
		var emailDomain = emailTmp[1];

		// RETRIEVE ALL RECORDS BY FILTER
		var moduleName = "Accounts";
		var Accounts = App.data.createBeanCollection(moduleName)
		var req = Accounts.fetch({
			"filter": [{ "website": { "$contains": emailDomain }}]
			//"fields":"id,name"
		});
		//console.debug(filters)
		req.xhr.success(function (data) {
			if (data.records.length > 0) {
				console.debug(data.records[0])
				var idAccount = data.records[0].id;
				var urlRel3 = app.api.buildURL('Contacts', contactNewID);
				urlRel3 = urlRel3 + '/link/accounts/' + idAccount;
				app.api.call("create", urlRel3, {
					parent_type: "Accounts",
					parent_id: idAccount,
					contact_id: contactNewID
				});

			}
		});
	}
});


// --------------------------------------------------
// CREATE LINK ACCOUNT FOR CONTACT
// SEARCH WITH FILTER "Company Name"

if(!_.isEmpty(searchName)){
	// RETRIEVE ALL RECORDS BY FILTER
	var moduleName = "Accounts";
	var filters = [{'name': searchName}];
	var AccountsObj = App.data.createBeanCollection(moduleName)
	var req = AccountsObj.fetch({"filter": filters});
	req.xhr.success(function (data) {
		if (data.records.length > 0) {
			//console.debug(data.records.length)
			//console.debug(data.records[0])
			var idAccount = data.records[0].id;
			var urlRel3 = app.api.buildURL('Contacts', contactNewID);
			urlRel3 = urlRel3 + '/link/accounts/' + idAccount;
			app.api.call("create", urlRel3, {
				parent_type: "Accounts",
				parent_id: idAccount,
				contact_id: contactNewID
			});

		}
	});

}








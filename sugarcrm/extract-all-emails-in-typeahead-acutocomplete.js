/**
 * Created by emil on 11.05.16.
 */

({
	extendsFrom: 'StickyRowactionField',
	initialize: function (options) {
		this._super('initialize', [options]);
		this.events = _.extend({}, this.events, {
			'click [name="somefield"]': 'someAction'
		});
	},
	// ....
	createAutocomplete: function () {

		var self = this
		setTimeout(function () {
			$.getScript("include/javascript/jquery/bootstrap/bootstrap-typeahead.js", function () {
				//console.debug("Script loaded but not necessarily executed.");
			});
		}, 700)

		setTimeout(function () {

			var userEmailOpStr = {}
			var moduleName = "Users";
			var filters = [{deleted: 0}]; // id: app.user.get("id")
			var Users = App.data.createBeanCollection(moduleName)
			var req = Users.fetch({"filter": filters});
			req.xhr.success(function (data) {
				if (data.records.length > 0) {
					_.each(data.records, function (item) {
						if (typeof(item) == "object") {
							var respObj = self.extractEmailsFromUser(item.email)
							if (typeof(respObj) == "string") {
								userEmailOpStr[respObj] = respObj
							} else if (typeof(respObj) == "object") {
								var arTmp = jQuery.parseJSON(JSON.stringify(respObj)) // jQuery.parseJSON
								//console.debug(typeof(arTmp))
								_.each(arTmp, function (emailaddress, key) {
									userEmailOpStr[emailaddress] = emailaddress
								});
							}
						}
					});
					var arEmailsList = []
					var countEmail = 0;
					_.each(userEmailOpStr, function (emailaddress) {
						arEmailsList[countEmail] = emailaddress
						countEmail++;
					});
					$('#myspecialfield').typeahead({
						source: arEmailsList,
						highlight: true
					}).bind('typeahead:selected', function (obj, selected, name) {
						//console.debug(obj, selected, name);
					});
					$('.typeahead').on('click.typeaheadonce', function () {
						$('#myspecialfield').attr("value", $('#myspecialfield').val())
					});
				}
			});
		}, 1500)
	},
	extractEmailsFromUser: function (emailObj) {
		if (emailObj.length > 1) {
			var strOp = [];
			_.each(emailObj, function (item, key) {
				strOp[key] = item.email_address
			});
			return strOp;
		}
		else {
			if (!_.isUndefined(emailObj[0])) {
				var strOps = emailObj[0].email_address
				return strOps;
			}
		}
	}
	// ....

})
/**
 * Created by emil on 16.03.16.
 */

var callObject = {}
var url = app.api.buildURL('Contacts',null,null);
app.api.call('create', url, callObject, {
	success: function (data) {
		app.controller.context.trigger(
			'subpanel:reload',
			{
				links: ['notes'],
				actionCommand: {

					/*

					 EXAMPLE ACTIONS 1 TO 11

					 "1": app.api.call(
					 "update",
					 //app.api.buildURL('Contacts','f110f2eb-dbeb-f2d5-8b05-548ea6d285c9',null,{"viewed":"1"}),
					 "rest/v10/Contacts/f110f2eb-dbeb-f2d5-8b05-548ea6d285c9?viewed=1",
					 {
					 "data":"&viewed=1",
					 "dataType":"json"
					 "type":"GET"
					 "somevar": "somedata-" + new Date().getTime()
					 },
					 {
					 success: function (data) {}
					 }
					 ),

					 "2":  SUGAR.jssource.views.base.record.controller._render(),
					 "3":  SUGAR.jssource.modules.Contacts.views.base.record.controller.initialize(),
					 "4":  App.controller.context.model.reloadData(),
					 "5":  app.router.refresh(), //  reload the page  /?refresh=true
					 "6":  app.router.redirect('#Contacts/f110f2eb-dbeb-f2d5-8b05-548ea6d285c9'),,
					 "7":  app.router.navigate(App.router.buildRoute('Contacts','f110f2eb-dbeb-f2d5-8b05-548ea6d285c9',null),{trigger: true}),
					 "8":  app.drawer.open({ layout:'main-pane', context:{ } }),
					 "9":  app.controller.context.trigger('record_layout:reload'),
					 "10": app.controller.context.trigger('change'),
					 "11":app.router.navigate(
					 'Contacts/f110f2eb-dbeb-f2d5-8b05-548ea6d285c9/?viewed=1&refresh=true&tmp='+new Date().getTime(),{trigger: false, replace: true}
					 )

					 */

				}
			}
		);
	},
	complete: function () {
		// do something on complete
	}
});

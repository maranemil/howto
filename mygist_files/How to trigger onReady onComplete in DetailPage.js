
/////////////////////////////////////////////////
//
// How to trigger onReady onComplete in DetailPage in SugarCRM 7.X
//
/////////////////////////////////////////////////

/**
File Location
/custom/modules/<YourModule>/clients/base/layouts/subpanels/subpanels.js
*/

({

	extendsFrom: 'SubpanelsLayout', 
        events: {
		'click img[class="some_class"]': 'someFunction' // add some event

    	},
    	initialize: function (options) {
        	app.view.invokeParent(this, {type: 'layout', name: 'subpanels', method: 'initialize', args: [options]});

	},
	showSubpanel: function (linkName) {

		var MaxRelated = this._components.length;
		var CntRelated = 0;
		
		_.each(this._components, function (component) {

			var currentModel = app.controller.context.get('model');
			var link = component.context.get('link');
			var linkedData = currentModel.getRelatedCollection(link);
			var linkLength = -1;

			//Check how many related records were loaded for each link
			linkedData.once('data:sync:complete', function (collection) {
				linkLength = collection.length;
				CntRelated++;

				//Hide subpanels without any data
				if (linkLength === 0) {
				    component.context.set("hidden", true);
				    component.hide();
				}
				else if (MaxRelated == CntRelated) {
					// Here is the last subpanel loaded in sugar, this is kind of "onComplete" for subpanels
					// so we can call the the function  
					someFunction();
				}
			});

		});

	}

})
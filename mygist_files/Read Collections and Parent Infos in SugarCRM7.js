///////////////////////////////////////////////////
//
// Read Collections and Parent Infos in SugarCRM7
// Read parent info in subpanel-list.js:
//
///////////////////////////////////////////////////

var ctx = this.context.parent, parentModelId = ctx.get("modelId"), parentModule = ctx.get("module");
if(parentModule == 'Accounts'){ 

	// do some action here
 	var  parentBean = app.data.createBean(parentModule, {id:parentModelId}), request = parentBean.fetch();
        request.xhr.done(function(){

            //get the field you need to verify
            var parentStatus = parentBean.get("account_status_c");
            if(parentStatus == 'I'){
                var parentID = parentBean.get("id");
		parentBean.set("name","new name here 123");
	        parentBean.save();

               // disable this specific subpanel's create button
               $('.subpanel-header').has('.label-Cases').find('[name="create_button"]').addClass('disabled');

            }

         });
}




//Read Collections info in record.js:

var AccountsBean = this.model; // Accounts
// alternative
// var AccountsBean = app.data.createBean('Accounts', {id: this.model.id});
// AccountsBean.fetch();
var collectionData = AccountsBean.getRelatedCollection('contacts');
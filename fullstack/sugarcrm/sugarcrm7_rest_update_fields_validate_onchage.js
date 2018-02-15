/**
 * Created by emil on 23.09.15.
 */
({
    // ------------------------------------------------------------------------------------
    extendsFrom: 'RecordView', // RecordView or CreateActionsView
    /*
    // events is nice to have but is blocking "Cancel Button"
    events: {
     'change:quote_contacts_name':'UpdateRelationContacts'
    },
    */
    initialize: function (options) {
        this._super('initialize',[options]);

        this.plugins = _.union(this.plugins || [], ['HistoricalSummary']);
        this.meta = _.extend({}, app.metadata.getView(this.module, 'record'), this.meta);

        /*
         this.events = _.extend({}, this.events, {
            'change:quote_contacts_name': "UpdateRelationContacts",
         });
        */

        this.model.addValidationTask('check_quote_contacts_name', _.bind(this._doValidateContact, this));
    },
    _doValidateContact: function(fields, errors, callback) {
        //validate type requirements
        if (_.isEmpty(this.model.get('quote_contacts_name')))
        {
            errors['quote_contacts_name'] = errors['quote_contacts_name'] || {};
            errors['quote_contacts_name'].required = true;
        }
        callback(null, fields, errors);
    },
    _renderHtml: function() {
        app.view.View.prototype._renderHtml.call(this);
        this.model.on('change:quote_contacts_name', this.UpdateRelationContacts, this);
    },
    UpdateRelationContacts: function(){
        var self = this;
        if(self.model.get("quote_contactscontacts_ida")){
            var assigneContact = self.model.get('quote_contactscontacts_ida');
            var request = app.api.call('read', 'rest/v10/Contacts/' + assigneContact);
            request.xhr.done(function(data){
                // get and check data from contact
                if(data.account_name && data.account_name!=self.model.get("quote_accounts_name")){
                    self.model.set("quote_accounts_name", data.account_name)
                    self.model.set("quote_accountsaccounts_ida", data.account_id)
                }
            });

        }
    }
})

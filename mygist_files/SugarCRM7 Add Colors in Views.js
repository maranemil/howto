///////////////////////////////////////////////////
//
// SugarCRM7 Add Colors in Views
//
///////////////////////////////////////////////////


// http://laurenthinoul.com/how-to-add-a-record-color-to-a-listview-in-sugarcrm/
// https://gist.github.com/lauhin/e7884975a8619a58b4ad

({
    extendsFrom: 'RecordlistView',
    initialize: function (options) {
        app.view.invokeParent(this, {type: 'view', name: 'recordlist', method: 'initialize', args: [options]});
        this.collection.on('data:sync:complete', function () {
            this.renderColors();
        }, this);
    },
    renderColors: function () {
        _.each(this.fields, function (field) {
            if(field.$el.find('div[data-original-title="Inactive"]').length > 0){
                field.$el.parents('tr').css("background-color", "#FFBABA");
                field.$el.parents('tr').children('td').css("background-color", "transparent");
            }
        });
    }
});
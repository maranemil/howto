////////////////////////////////////////////////
//
// SugarCRM7 Add DropDown List - Populate list with ajax
// by EvilPeri
// custom/modules/<your module>/clients/base/fields/enum/enum.js
//
////////////////////////////////////////////////

({
    extendsFrom: 'EnumField',
    _render: function(){
        if(this.name == 'your field name here'){
            if(_.isEmpty(this.items)){
                 this.setItems();
                 return;
            }
        }
        this._super('_render');
    },
    setItems: function(){
        if(!_.isEmpty(this.items)){
            this._render();
        }
        //add ajax to retrieve dropdown from another source
        // this is just an example
        $.ajax({
            //url: <your url here>
            //type: POST | GET | PUT | DELETE,
            timeout: 5,
            success: _.bind(function(data){
                this.items = data;
                // or do whatever data manipulation you want here.
                // just as long as the this.items is an array
                this.render();
            },this)
        });
    }
})
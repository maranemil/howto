//////////////////////////////////////////////////
//
// How To Manipulate Names on Action Drowpdown Sugar7 with Javascript
//
//////////////////////////////////////////////////

({
    extendsFrom: 'RecordView',
    events: {
        'click [track="click:actiondropdown"]': "UpdateMyButton"
    },
    /*
    events:{
     'click [name=save_button]:not(".disabled")':'save',
     'click [name=cancel_button]':'cancel',
     'click a[name=create_button]:not(".disabled")':'create',
     'click [name=edit_button]':'editClicked',
     'click [name=delete_button]':'deleteClicked'
     }
    */
    initialize: function (options) {
        this._super('initialize', [options]);

        /*this.events = _.extend({}, this.events, {
            'click [name=save_button]:not(".disabled")':'save',
            'click [name=cancel_button]':'cancel',
            'click a[name=create_button]:not(".disabled")':'create',
            'click [name=edit_button]':'editClicked',
            'click [name=delete_button]':'deleteClicked'
        });*/


    },
    UpdateMyButton:  function () {
       
	var NewButton = "New Action Name";
        var obMenuLst = $('.actions .dropdown-menu li span a'); // actions btn-group detail
         $.each(obMenuLst,function(index,item){
    
            if(item.innerHTML.match(/DefaultNameBttn/)){
                $('.actions .dropdown-menu li span a').eq(index).text(NewButton)
            }
        });

    },
    _dispose: function () {
        this._super('_dispose');
    }
})
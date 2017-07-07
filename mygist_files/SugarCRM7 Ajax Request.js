
////////////////////////////////////////////////
//
// SugarCRM7 Ajax Request
//
////////////////////////////////////////////////

$.ajax({
    beforeSend: function (request) {
        request.setRequestHeader("OAuth-Token", SUGAR.App.api.getOAuthToken());
    }, 
    url: "rest/v10/cplus_ContactsPlus/create_cplus",
    data: { type: "cplus", societyname: this.model.get('name') },     
    dataType: "json",
    type: "GET",
    timeout: 5,
    success: function (data) {
        var obj = jQuery.parseJSON(data);
        //console.debug(obj)
       
    }
});
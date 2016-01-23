
var handleDataTableDefault = function() {
	"use strict";
    
    $('#data-table').DataTable({
        "ajaxSource": '_registrations.json',
        "sAjaxDataProp": "",
        "columns": [
            { "data": "first-name" },
            { "data": "last-name" },
            { "data": "email" },
            { "data": "address" },
            { "data": "city" },
            { "data": "state" },
            { "data": "zip" },
            { "data": "ward" },
            { "data": "school" }
          ]
     });


};

var TableManageDefault = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableDefault();
        }
    };
}();
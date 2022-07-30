
var UserDashboardService = {
        init: function(){
          UserDashboardService.last();
          UserDashboardService.get_id();


        },

        last: function(){
              $.ajax({
              url: '../rest/last_active/'+ parse_jwt(localStorage.getItem('token')).id,
              type: "GET",
              beforeSend: function(xhr){
                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
              },
              success: function(data) {
                //$("#membership-table").html("");


                $("#valid").html( `<div class="text-sucess text-center mt-2" id="valid"><h1>`+data.end_date+`</h1></div>`)
                $("#membership_name").html( `<div class="text-sucess text-center mt-2" id="valid"><h1>`+data.description+`</h1></div>`)


              //$("#end").html(`<div class="text-info text-center mt-2" id="end"><h1>5</h1></div>`);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              toastr.error(XMLHttpRequest.responseJSON.message);

            }
            });
          },
          get_id:function(){
            $("#end").html(`<div class="text-info text-center mt-2" id="end"><h1>`+parse_jwt(localStorage.getItem('token')).id+`</h1></div>`);
          },


}

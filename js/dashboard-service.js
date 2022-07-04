var DashboardService = {
        init: function(){
          DashboardService.count();
          DashboardService.active();
          DashboardService.earned();
        },

        count: function(){
        /*  $.get("rest/users", function(data) {
            $("#user-list").html("");
            var html = "";
            */
            $.ajax({
            url: "rest/userscount",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
              //$("#membership-table").html("");
              var html = "";
            for(let i = 0; i < data.length; i++){
              html += `<div class="text-info text-center mt-2" id="count"><h1>`+data[i].count+`</h1></div>


                                    `;
            }
            let oldHtml = $("#count").html();
            $("#count").html(oldHtml+html);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);

          }
          });
        },
        active: function(){
        /*  $.get("rest/users", function(data) {
            $("#user-list").html("");
            var html = "";
            */
            $.ajax({
            url: "rest/usersactive",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
              //$("#membership-table").html("");
              var html = "";
            for(let i = 0; i < data.length; i++){
              html += `<div class="text-success text-center mt-2 " id="active"> <h1>`+data[i].id+`</h1></div>



                                    `;
            }
            let oldHtml = $("#active").html();
            $("#active").html(oldHtml+html);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);

          }
          });
        },
        earned: function(){
        /*  $.get("rest/users", function(data) {
            $("#user-list").html("");
            var html = "";
            */
            $.ajax({
            url: "rest/earned",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
              //$("#membership-table").html("");
              var html = "";
            for(let i = 0; i < data.length; i++){
              html += `<div class="text-dark text-center mt-2" id="earned"> <h1>`+data[i].suma+` KM</h1></div>



                                    `;
            }
            let oldHtml = $("#earned").html();
            $("#earned").html(oldHtml+html);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);

          }
          });
        },
        }

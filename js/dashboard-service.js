var DashboardService = {
        init: function(){
          DashboardService.count();
          DashboardService.active();
          DashboardService.earned();
          DashboardService.employes_active();
          DashboardService.list();
          DashboardService.get_name();
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
        employes_active: function(){
        /*  $.get("rest/users", function(data) {
            $("#user-list").html("");
            var html = "";
            */
            $.ajax({
            url: "rest/employes_active",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
              //$("#membership-table").html("");
              var html = "";
            for(let i = 0; i < data.length; i++){
              html += `<div class="text-warning text-center mt-2" id="employes"> <h1>`+data[i].employes+` </h1></div>



                                    `;
            }
            let oldHtml = $("#employes").html();
            $("#employes").html(oldHtml+html);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);

          }
          });
        },
        list: function(){
        /*  $.get("rest/users", function(data) {
            $("#user-list").html("");
            var html = "";
            */
            $.ajax({
            url: "rest/usermembership",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
              //$("#membership-table").html("");
              var html = "";
            for(let i = 0; i < 5; i++){
              html += `<tr>
                                      <th>`+data[i].id+` </th>
                                      <th>`+data[i].name+` </th>
                                      <th>`+data[i].description+` </th>
                                      <th>`+data[i].start_date+`</th>
                                      <th>`+data[i].end_date+`</th>
                                    </tr>`;
            }
            let oldHtml = $("#membership-table").html();
            $("#membership-table").html(oldHtml+html);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);

          }
          });
        },
        get_name:function(){
          $("#name").html(`<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" id="name" >`+parse_jwt(localStorage.getItem('token')).name+`</a>`);
            //$("#end").html(`<div class="text-info text-center mt-2" id="end"><h1>`+parse_jwt(localStorage.getItem('token')).id+`</h1></div>`);
        },
        }

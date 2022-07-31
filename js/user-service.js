var UserService = {
    init: function(){
      $('#addUserForm').validate({
        submitHandler: function(form) {
          var entity = Object.fromEntries((new FormData(form)).entries());

           // add method
           UserService.add(entity);
         }


     });

     $('#updateUserForm').validate({
       submitHandler: function(form) {
         var entity = Object.fromEntries((new FormData(form)).entries());
         var id = entity.id;
          delete entity.id;
         console.log("Before update");
          // update method
          UserService.update(id,entity);
        }


    });
     UserService.list();



    },

    list: function(){
    /*  $.get("rest/users", function(data) {
        $("#user-list").html("");
        var html = "";
        */
        $.ajax({
        url: "rest/users",
        type: "GET",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(data) {
          $("#user-list").html("");
          var html = "";
        for(let i = 0; i < data.length; i++){
          html += `
          <div class="col-lg-3">
            <div class="card" style="background-color:`+data[i].color+`">
              <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17ff3c8cf14%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17ff3c8cf14%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.19140625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">`+ data[i].name +`</h5>
                <p class="card-text">`+ data[i].description +`</p>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary user-button" onclick="UserService.get(`+data[i].id+`)">Edit</button>
                  <button type="button" class="btn btn-danger user-button" onclick="UserService.delete(`+data[i].id+`)">Delete</button>
                </div>
              </div>
            </div>
          </div>
          `;
        }
        $("#user-list").html(html);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        UserService.logout();
      }
      });
    },

    get: function(id){
      $('.user-button').attr('disabled', true);
      $.ajax({
             url: 'rest/users/'+id,
             type: "GET",
             beforeSend: function(xhr){
               xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
             },
             success: function(data) {
               $('#updateUserForm input[name="id"]').val(data.id);
               $('#updateUserForm input[name="name"]').val(data.name);
               $('#updateUserForm input[name="description"]').val(data.description);
               $('#updateUserForm input[name="email"]').val(data.email);
               $('#updateUserForm input[name="password"]').val(data.password);

               $('.user-button').attr('disabled', false);
               $('#updateUserModal').modal("show");
             },
             error: function(XMLHttpRequest, textStatus, errorThrown) {
               toastr.error(XMLHttpRequest.responseJSON.message);
               $('.user-button').attr('disabled', false);
             }});
        },


    add: function(user){
      $.ajax({
        url: 'rest/register',
        type: 'POST',
        data: JSON.stringify(user),
        contentType: "application/json",
        dataType: "json",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(result) {
            $("#user-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            UserService.list(); // perf optimization
            $("#addUserModal").modal("hide");
            $('.modal-backdrop').remove();
            toastr.success("User added!");
        }
      });
    },

    update: function(id,entity){
    $.ajax({
    url: 'rest/users/'+id,
    type: 'PUT',
    beforeSend: function(xhr){
      xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
    },
    data: JSON.stringify(entity),
    contentType: "application/json",
    dataType: "json",
    success: function(result) {
        $("#user-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
        UserService.list(); // perf optimization
        $("#updateUserModal").modal("hide");
        toastr.success("User updated!");
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      toastr.error(XMLHttpRequest.responseJSON.message);
      $('.user-button').attr('disabled', false);
    }});

},


    delete: function(id){
      $('.user-button').attr('disabled', true);
      $.ajax({
        url: 'rest/users/'+id,
        type: 'DELETE',
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(result) {
            $("#user-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            UserService.list();
            toastr.success("User deleted!");
        }
      });
    },





}

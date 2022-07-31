var EmployeService = {
        init: function(){
          $('#addEmployeForm').validate({
            submitHandler: function(form) {
              var entity = Object.fromEntries((new FormData(form)).entries());

               // add method
               EmployeService.add(entity);
             }


         });

         $('#updateEmployeForm').validate({
           submitHandler: function(form) {
             var entity = Object.fromEntries((new FormData(form)).entries());
             var id = entity.id;
             console.log(id);
              delete entity.id;
             console.log("Before update");
              // update method
              EmployeService.update(id,entity);
            }


        });
         EmployeService.list();



       },




        list: function(){
        /*  $.get("rest/users", function(data) {
            $("#user-list").html("");
            var html = "";
            */
            $.ajax({
            url: "rest/employe",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
              $("#employe-table-full-list").html("");
              var html = "";
            for(let i = 0; i < data.length; i++){
              html += `<tr>
              <th class="bg-dark text-light">ID</th>
              <th class="bg-dark text-light">Name</th>
              <th class="bg-dark text-light">Surname</th>
              <th class="bg-dark text-light">Email</th>
              <th class="bg-dark text-light">Status</th>
              <th class="bg-dark text-light">Position</th>
              <th class="bg-dark text-light">Action</th>
                </tr>
              <tr>
                                      <th>`+data[i].id+` </th>
                                      <th>`+data[i].name+` </th>
                                      <th>`+data[i].surname+` </th>
                                      <th>`+data[i].email+` </th>
                                      <th>`+data[i].status+`</th>
                                      <th>`+data[i].position+`</th>
                                      <td>

                                        <button type="button" class="btn btn-success employe-button " onclick="EmployeService.get(`+data[i].id+`) "><i class="fa fa-edit"></i></button>
                                      <button type="button" class="btn btn-danger employe-button " onclick="EmployeService.delete(`+data[i].id+`)"><i class="fa fa-trash"></i></button>
                                      </td>
                                    </tr>`;
            }
          //  let oldHtml = $("#membership-table-full-list").html();
          //  $("#membership-table-full-list").html(oldHtml+html);
           $("#employe-table-full-list").html(html);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);

          }
          });
        },
          add: function(user){
            $.ajax({
              url: 'rest/employereg',
              type: 'POST',
              data: JSON.stringify(user),
              contentType: "application/json",
              dataType: "json",
              beforeSend: function(xhr){
                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
              },
              success: function(result) {
                  $("#employe-table-full-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
                  EmployeService.list(); // perf optimization
                  $("#addEmployeModal").modal("hide");
                    $('.modal-backdrop').remove();
                  toastr.success("Employe added!");
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.responseJSON.message);

              }
            });
          },
        delete: function(id){
          //$('.user-button').attr('disabled', true);
          $.ajax({
            url: 'rest/employe/'+id,
            type: 'DELETE',
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(result) {
                $("#employe-table-full-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
                EmployeService.list();
                toastr.success("Employe deleted!");
            }
          });
        },

        get: function(id){
          $('.employe-button').attr('disabled', true);
          $.ajax({
                 url: 'rest/employe/'+id,
                 type: "GET",
                 beforeSend: function(xhr){
                   xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                 },
                 success: function(data) {
                   $('#updateEmployeForm input[name="id"]').val(id);
                   $('#updateEmployeForm  input[name="name"]').val(data.name);
                   $('#updateEmployeForm  input[name="surname"]').val(data.surname);
                   $('#updateEmployeForm  input[name="email"]').val(data.email);
                   $('#updateEmployeForm  input[name="status"]').val(data.status);
                   $('#updateEmployeForm  input[name="position"]').val(data.position);

                   $('.employe-button').attr('disabled', false);
                   $('#updateEmployeModal').modal("show");
                 },
                 error: function(XMLHttpRequest, textStatus, errorThrown) {
                   toastr.error(XMLHttpRequest.responseJSON.message);
                   $('.employe-button').attr('disabled', false);
                 }});
            },
    update: function(id, entity){
      $.ajax({
        url: 'rest/employe/'+id,
        type: 'PUT',
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function(result) {
            $("#employe-table-full-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            EmployeService.list(); // perf optimization
            $("#updateEmployeModal").modal("hide");
            toastr.success("Employe updated!");
        }
      });
    },

        }

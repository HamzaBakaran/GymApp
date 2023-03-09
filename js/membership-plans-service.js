var MembershipPlanService = {
    init: function(){
      $('#addPlanForm').validate({
        submitHandler: function(form) {
          var entity = Object.fromEntries((new FormData(form)).entries());

           // add method
           MembershipPlanService.add(entity);
         }


     });

     $('#updatePlanForm').validate({
       submitHandler: function(form) {
         var entity = Object.fromEntries((new FormData(form)).entries());
         var id = entity.id;
          delete entity.id;
         console.log("Before update");
          // update method
          MembershipPlanService.update(id,entity);
        }


    });
     MembershipPlanService.list();



    },

    list: function(){
    /*  $.get("rest/users", function(data) {
        $("#user-list").html("");
        var html = "";
        */
        $.ajax({
        url: "rest/membership",
        type: "GET",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(data) {
          $("#plan-list").html("");
          var html = "";
        for(let i = 0; i < data.length; i++){
          html += `
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h1 class="card-title">`+ data[i].description +`</h1>
              <p class="card-text">`+ data[i].price +`BAM</p>
              <button type="button" name="button"class="btn btn-primary plan-button" onclick="MembershipPlanService.get(`+data[i].id+`)">Edit</button>
              <button type="button" name="button"class="btn btn-danger plan-button" onclick="MembershipPlanService.delete(`+data[i].id+`)">Delete</button>
            </div>
          </div>
          `;
        }
        $("#plan-list").html(html);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        MembershipPlanService.logout();
      }
      });
    },

    get: function(id){
      $('.plan-button').attr('disabled', true);
      $.ajax({
             url: 'rest/membership/'+id,
             type: "GET",
             beforeSend: function(xhr){
               xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
             },
             success: function(data) {
               $('#updatePlanForm input[name="id"]').val(data.id);
               $('#updatePlanForm input[name="description"]').val(data.description);
               $('#updatePlanForm input[name="price"]').val(data.price);

               $('.plan-button').attr('disabled', false);
               $('#updatePlanModal').modal("show");
             },
             error: function(XMLHttpRequest, textStatus, errorThrown) {
               toastr.error(XMLHttpRequest.responseJSON.message);
               $('.plan-button').attr('disabled', false);
             }});
        },


    add: function(user){
      $.ajax({
        url: 'rest/membership',
        type: 'POST',
        data: JSON.stringify(user),
        contentType: "application/json",
        dataType: "json",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(result) {
            $("#plan-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            MembershipPlanService.list(); // perf optimization
            $("#addPlanModal").modal("hide");
            $('.modal-backdrop').remove();
            toastr.success("Plan added!");
        }
      });
    },

    update: function(id,entity){
    $.ajax({
    url: 'rest/membership/'+id,
    type: 'PUT',
    beforeSend: function(xhr){
      xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
    },
    data: JSON.stringify(entity),
    contentType: "application/json",
    dataType: "json",
    success: function(result) {
        $("#plan-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
        MembershipPlanService.list(); // perf optimization
        $("#updatePlanModal").modal("hide");
        toastr.success("Plan updated!");
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      toastr.error(XMLHttpRequest.responseJSON.message);
      $('.plan-button').attr('disabled', false);
    }});

},


    delete: function(id){
      $('.user-button').attr('disabled', true);
      $.ajax({
        url: 'rest/membership/'+id,
        type: 'DELETE',
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(result) {
            $("#plan-list").html('<div class="spinner-border" role="status"> <span class="sr-only"></span>  </div>');
            MembershipPlanService.list();
            toastr.success("Plan deleted!");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest.responseJSON.message);
          $('.plan-button').attr('disabled', false);
        }});
      
    },





}

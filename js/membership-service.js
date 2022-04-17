var MembershipService = {

  add: function(membership){
    $.ajax({
      url: 'rest/membership',
      type: 'POST',
      data: JSON.stringify(membership),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        // append to the list
        $("#user-todos").append(`<div class="list-group-item note-todo-`+result.id+`">
          <button class="btn btn-danger btn-sm float-end" onclick="UserService.delete(`+result.id+`)">delete</button>
          <p class="list-group-item-text">`+result.description+`</p>
        </div>`);
        toastr.success("Added !");
      }
    });
  },

  list_by_user_id: function(user_id){
    $("#membership-users").html('loading ...');
    $.get("rest/user/"+user_id+"/membership", function(data) {
      var html = "";
      for(let i = 0; i < data.length; i++){
        html += `<div class="list-group-item membership-user-`+data[i].id+`">
          <button class="btn btn-danger btn-sm float-end" onclick="MembershipService.delete(`+data[i].id+`)">delete</button>
          <p class="list-group-item-text">`+data[i].description+`</p>
        </div>`;
      }
      $("#membership-user").html(html);
    });

    // note id populate and form validation
    $('#add-membership-form input[name="user_id"]').val(user_id);
    $('#add-membership-form input[name="created"]').val(MembershipService.current_date());

    $('#add-membership-form').validate({
      submitHandler: function(form) {
        var entity = Object.fromEntries((new FormData(form)).entries());
        MembershipService.add(entity);
        $('#add-membership-form input[name="description"]').val("");
        toastr.info("Adding ...");
      }
    });
    $("#membershipModal").modal('show');
  },

  delete: function(id){
    var old_html = $("#membership-user").html();
    $('.membership-user-'+id).remove();
    toastr.info("Deleting in background ...");
    $.ajax({
      url: 'rest/membership/'+id,
      type: 'DELETE',
      success: function(result) {
        toastr.success("Deleted !");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        $("#membership-user").html(old_html);
        //alert("Status: " + textStatus); alert("Error: " + errorThrown);
      }
    });
  },

  current_date: function(){
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    return yyyy+"-"+mm+"-"+dd;
  }

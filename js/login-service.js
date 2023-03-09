var UserLoginService = {
  init: function(){
    var token = localStorage.getItem("token");
    if (token){
      window.location.replace("index.html");
    }
    $('#login-form').validate({
      submitHandler: function(form) {
        var entity = Object.fromEntries((new FormData(form)).entries());
        UserLoginService.login(entity);
      }
    });
  },
  login: function(entity){
    $('.login-button').attr('disabled', true);
    $.ajax({
      url: 'rest/login',
      type: 'POST',
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        console.log(result);
        localStorage.setItem("token", result.token);
        window.location.replace("index.html");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        $('.login-button').attr('disabled', false);
      }
    });
  },

  logout: function(){
    localStorage.clear();
    window.location.replace("login.html");
  },
}

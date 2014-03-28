
$(function() {
  $('.btn-delete-user').bind("click", function(e) {
    var id = $(this).parent().parent().attr("data-id");
    var name = $(this).parent().parent().attr("data-name");
    bootbox.confirm({
      message: "Are you sure you want to delete " + name + "?",
      buttons: {
        confirm: {label: "Delete User"},
        cancel: {label: "Don't do it!"}
      },
      callback:function(result) {
        if(result === true){
          Ajax.User.delete(id);
        }
      }
    }).find("div.modal-content").addClass("confirmWidth");
  });
  
  $('.btn-reset-password').bind("click", function(e) {
    var name = $(this).parent().parent().attr("data-name");
    var email = $(this).parent().parent().attr("data-email");
    
    bootbox.confirm({
      message: "Are you sure you want to reset the password for " + name + "?",
      buttons: {
        confirm: {label: "Reset Password"},
        cancel: {label: "Cancel"}
      },
      callback:function(result) {
        if(result === true){
          $.ajax({
            url     : 'users/resetpassword',
            type    : "POST",
            dataType: 'html',
            data: {'data[User][email]' : email},
            async: true,
            complete : function(data){
              bootbox.alert("Password reset email has been sent.");
            },
            error : function(){
              bootbox.alert("Failed to send password reset email.");
            }
          }); 
        }
      }
    }).find("div.modal-content").addClass("confirmWidth");
  });
});
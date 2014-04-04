
$(function() {
  setTimeout(function() {$(".bg-success").fadeOut(3000, function() {$(this).remove();})}, 10000);
  setTimeout(function() {$(".bg-danger").fadeOut(3000, function() {$(this).remove();})}, 10000);
  /*
   description: attach on click funtion to $('.btn-delete-user') to delete specified user when pressed
   input: e
   preconditions:
          $('.btn-delete-user') exists
          $('.btn-delete-user') has been clicked
   postconditions:
          render confirmation message 
          call Ajax.User.delete(id)
   return value: none
  */
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
  

  /*
   description: attach on click funtion to $('.btn-reset-password') to reset password for specified user when pressed
   input: e
   preconditions:
          $('.btn-reset-password') exists
          $('.btn-reset-password') has been clicked
   postconditions:
          render confirmation message 
          ajax call to 'users/resetpassword' with data: {'data[User][email]' : email}
   return value: none
  */
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
              bootbox.alert("Password reset email has been sent.").find("div.modal-content").addClass("confirmWidth");
            },
            error : function(){
              bootbox.alert("Failed to send password reset email.").find("div.modal-content").addClass("confirmWidth");
            }
          }); 
        }
      }
    }).find("div.modal-content").addClass("confirmWidth");
  });
});
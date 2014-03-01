
$(function() {
    $('.btn-delete-user').bind("click", function(e) {
    	var id = $(this).parent().parent().attr("data-id");
    	debugger; 
   		bootbox.confirm({
           message: "Are you sure you want to delete this user?", 
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
});

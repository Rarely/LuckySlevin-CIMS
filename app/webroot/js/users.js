$(function() {
    $('.btn-delete-user').bind("click", function(e) {
    	var id = $(this).parent().parent().attr("data-id");
    bootbox.confirm("Are you sure you want to delete this user?", function(result) {	
			if(result === true){
				Ajax.User.delete(id); 		
			}
		}).find("div.modal-content").addClass("confirmWidth"); 
     });
});
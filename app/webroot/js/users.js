$(function() {
   bootbox.confirm("Are you sure you want to delete this user?", function(result) {
	alert("Confirm result: "+result).find("div.modal-content").addClass("confirmWidth");
}); 
});
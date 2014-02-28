$(function() {
   bootbox.confirm("Are you sure?", function(result) {
	alert("Confirm result: "+result);
}); 
});
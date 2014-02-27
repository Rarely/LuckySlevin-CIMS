jQuery.fn.bindIdeaModal = function() {
    var el = $(this[0]);
    var id = $("#ajax-modal").attr("data-id");
    
    //Hook up Sharing
    $('#ajax-modal .sharing-autocomplete').userSelect();
    $('#ajax-modal .btn-share').bind("click", function(e) {
      $.each($('#ajax-modal .sharing-autocomplete').select2("val"), function( index, value ) {
        Ajax.Notifications.notify("Please look at this idea", id, value);
      });
      $('#ajax-modal .sharing-autocomplete').select2('data', null);
      alert("Shared");
    });
};
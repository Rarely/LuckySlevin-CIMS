$(function() {

  jQuery('.sharing-autocomplete').each(function() {
    var currentElement = $(this);
    var id = currentElement.closest('.modal').attr('data-id');
    
    $('.modal[data-id='+id+'] .sharing-autocomplete').select2({
        placeholder: "Share with Others",
        multiple: true,
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
          url: "/users/memberslist",
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        },
        dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
        escapeMarkup: function (m) { return m; }
    });
    $('.modal[data-id='+id+'] .btn-share').bind("click", function(e) {
      $.each($('.modal[data-id='+id+'] .sharing-autocomplete').select2("val"), function( index, value ) {
        alert("Sending notification: " + "'Please look at this idea ("+id+")'" + " to " + value);
        Ajax.Notifications.notify("Please look at this idea", id, value);
        //alert( index + ": " + value );
      });
    });
  });
});
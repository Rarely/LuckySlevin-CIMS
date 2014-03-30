$(function() {
    $('#edit-idea-form .cat').each(function() {
        $(this).categorySelect($(this).attr('init-value'));
    });
    $("#edit-idea-form .owner-select").userSelect(false, $('#edit-idea-form .owner-select').attr('data-initvalue'), false, "Owner");

    $("#edit-idea-form .idea-references").ideaSelect();

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    /*
      description: enables editing the start date of an idea via bootstrap-datapicker.js
      input: start_date
      preconditions: the idea start_date is valid
      postconditions: the selected start_date is valid
      return value: the idea start_date
    */
    var edit_start_date = $('#edit-idea-dp1').datepicker({
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > edit_end_date.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            edit_end_date.setValue(newDate);
        }
        var date_string = edit_start_date.date.toString('yyyy-MM-dd');
        $("#edit-idea-start-date-text").text(date_string);
        $("#edit-idea-start-date").val(date_string);
        edit_start_date.hide();
        $('#edit-idea-dp2').focus().click();
    }).data('datepicker');

    /*
      description: enables editing the end date of an idea via bootstrap-datapicker.js
      input: end_date
      preconditions: the idea end_date is valid
      postconditions: the selected end_date is valid
      return value: the idea end_date
    */
    var edit_end_date = $('#edit-idea-dp2').datepicker({
      onRender: function(date) {
        return date.valueOf() <= edit_start_date.date.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function(ev) {
      var date_string = edit_end_date.date.toString('yyyy-MM-dd');
      $("#edit-idea-end-date-text").text(date_string);
      $("#edit-idea-end-date").val(date_string);
      edit_end_date.hide();
    }).data('datepicker');

    /*
      description: if button is clicked, start_date is cleared
      input: start_date
      preconditions: there is a valid start_date or NULL
      postconditions: there is no start_date
      return value: NULL
    */
    $("#clear-start-date").click( function() {
      var date_string = "";
      $("#edit-idea-start-date-text").text(date_string);
      $("#edit-idea-start-date").val(date_string);
    });

    /*
      description: if button is clicked, end_date is cleared
      input: end_date
      preconditions: there is a valid end_date or NULL
      postconditions: there is no end_date
      return value: NULL
    */
    $("#clear-end-date").click( function() {
      var date_string = "";
      $("#edit-idea-end-date-text").text(date_string);
      $("#edit-idea-end-date").val(date_string);
    });
});

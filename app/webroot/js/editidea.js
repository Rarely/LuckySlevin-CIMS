$(function() {
    $('#edit-idea-form .cat').each(function() {
        $(this).categorySelect($(this).attr('init-value'));
    });
    $("#edit-idea-form .owner-select").userSelect(false, $('#edit-idea-form .owner-select').attr('data-initvalue'), false, "Owner");

    $("#edit-idea-form .idea-references").ideaSelect();

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
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

    $("#clear-start-date").click( function() {
      var date_string = "";
      $("#edit-idea-start-date-text").text(date_string);
      $("#edit-idea-start-date").val(date_string);
    });

    $("#clear-end-date").click( function() {
      var date_string = "";
      $("#edit-idea-end-date-text").text(date_string);
      $("#edit-idea-end-date").val(date_string);
    });
});

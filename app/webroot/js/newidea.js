$(function() {
    $('#btn-add-idea').click(function() {
        $('#new-idea-form .cat').each(function() {
            $(this).categorySelect();
        });
    });

    $("#new-idea-form .owner-select").userSelect(false, $('#new-idea-form .owner-select').attr('data-initvalue'), false);

    $("#new-idea-form .idea-references").ideaSelect();

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    /*
      description: enables selecting the start date of an idea via bootstrap-datapicker.js
      input: none
      preconditions: the idea start_date is valid
      postconditions: the selected start_date is valid
      return value: the idea start_date
    */
    var add_start_date = $('#add-idea-dp1').datepicker({
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > add_end_date.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            add_end_date.setValue(newDate);
        }
        var date_string = add_start_date.date.toString('yyyy-MM-dd');
        $("#add-idea-start-date-text").text(date_string);
        $("#add-idea-start-date").val(date_string);
        add_start_date.hide();
        $('#add-idea-dp2').focus().click();
    }).data('datepicker');

    /*
      description: enables selecting the end date of an idea via bootstrap-datapicker.js
      input: none
      preconditions: the idea end_date is valid
      postconditions: the selected end_date is valid
      return value: the idea end_date
    */
    var add_end_date = $('#add-idea-dp2').datepicker({
      onRender: function(date) {
        return date.valueOf() <= add_start_date.date.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function(ev) {
      var date_string = add_end_date.date.toString('yyyy-MM-dd');
      $("#add-idea-end-date-text").text(date_string);
      $("#add-idea-end-date").val(date_string);
      add_end_date.hide();
    }).data('datepicker');

    /*
      description: if button is clicked, start_date is cleared
      input: start_date
      preconditions: there is a valid start_date or NULL
      postconditions: there is no start_date
      return value: NULL
    */
    $("#clear-new-start-date").click( function() {
      var date_string = "";
      $("#add-idea-start-date-text").text(date_string);
      $("#add-idea-start-date").val(date_string);
    });

    /*
      description: if button is clicked, end_date is cleared
      input: end_date
      preconditions: there is a valid end_date or NULL
      postconditions: there is no end_date
      return value: NULL
    */
    $("#clear-new-end-date").click( function() {
      var date_string = "";
      $("#add-idea-end-date-text").text(date_string);
      $("#add-idea-end-date").val(date_string);
    });

});

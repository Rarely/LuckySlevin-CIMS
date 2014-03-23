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

    $('#add-idea-dp1').datepicker();
    var add_idea_start_date_picker = $('#add-idea-dp1').datepicker({
        format:'yyyy-mm-dd',
        autoclose: true,
        onRender: function(date) {
            return ''; //date.valueOf() < now.valueOf() ? 'disabled' : '' ;
        }
    }).on('changeDate', function(e){
            var start_date = new Date(e.date);
            var date_string = start_date.toString('yyyy-MM-dd');
            $("#add-idea-start-date-text").text(date_string);
            $("#add-idea-start-date").val(date_string);
            add_idea_start_date_picker.hide();
            //$('#add-idea-dp2')[0].focus();
    }).data('datepicker');

    var add_idea_end_date_picker = $('#add-idea-dp2').datepicker({
        format:'yyyy-mm-dd',
        autoclose: true,
        onRender: function(date) {
            return ''; //date.valueOf() <= add_idea_start_date_picker.date.valueOf() ? 'disabled' : '' ;
        }
    }).on('changeDate', function(e){
        var end_date = new Date(e.date);
        var date_string = end_date.toString('yyyy-MM-dd');
        $("#add-idea-end-date-text").text(date_string);
        $("#add-idea-end-date").val(date_string);
        add_idea_end_date_picker.hide();
    }).data('datepicker');
});

$(function() {
    $('#edit-idea-form .cat').each(function() {
        $(this).categorySelect($(this).attr('init-value'));
    });
    $("#edit-idea-form .owner-select").userSelect(false, $('#edit-idea-form .owner-select').attr('data-initvalue'), false, "Owner");

    $("#edit-idea-form .idea-references").ideaSelect();

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var start_date_picker = $('#dp1').datepicker({
        format:'yyyy-mm-dd',
        autoclose: true,
        onRender: function(date) {
            return '';//date.valueOf() < now.valueOf() ? 'disabled' : '' ;
        }
    }).on('changeDate', function(e){
            var start_date = new Date(e.date);
            var date_string = start_date.toString('yyyy-MM-dd');
            $("#start_date_text").text(date_string);
            $("#start_date").val(date_string);
            start_date_picker.hide();
            $('#dp2')[0].focus();
    }).data('datepicker');

    var end_date_picker = $('#dp2').datepicker({
        format:'yyyy-mm-dd',
        autoclose: true,
        onRender: function(date) {
            return '';// date.valueOf() <= start_date_picker.date.valueOf() ? 'disabled' : '' ;
        }
    }).on('changeDate', function(e){
        var end_date = new Date(e.date);
        var date_string = end_date.toString('yyyy-MM-dd');
        $("#end_date_text").text(date_string);
        $("#end_date").val(date_string);
        end_date_picker.hide();
    }).data('datepicker');

});

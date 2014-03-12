$(function() {
    $('#btn-add-idea').click(function() {
        $('#new-idea-form .cat').each(function() {
            $(this).categorySelect();
        });
    });

    $("#new-idea-form .owner-select").userSelect(false, $('#new-idea-form .owner-select').attr('initvalue'), false);
});
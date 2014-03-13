$(function() {
    $('#edit-idea-form .cat').each(function() {
        $(this).categorySelect($(this).attr('init-value'));
    });
    $("#edit-idea-form .owner-select").userSelect(false, $('#edit-idea-form .owner-select').attr('initvalue'), false);

    $("#edit-idea-form .idea-references").ideaSelect();
});
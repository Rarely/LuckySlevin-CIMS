$(function() {
    $('#btn-add-idea').click(function() {
        jQuery('.cat').each(function() {
            $(this).categorySelect();
        });
    });
});
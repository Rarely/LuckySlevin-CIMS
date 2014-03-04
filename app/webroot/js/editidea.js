$(function() {
    jQuery('.cat').each(function() {
        $(this).categorySelect($(this).attr('init-value'));
    });
});
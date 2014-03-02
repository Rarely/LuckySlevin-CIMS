$(function() {
    jQuery('.cat').each(function() {
        var defaultvars = $(this).attr('value');
        $(this).categorySelect(defaultvars);
    });
});
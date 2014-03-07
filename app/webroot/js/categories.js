$(function() {
    $("#btn-add-value").click(function() {
        bootbox.prompt("Please enter a value:", function(result) {
            if (result !== null) {
                Ajax.Categories.create($('.table-category').attr('data-id'), result);
            }
        });
    });
    $(".btn-edit-value").click(function() {
        var id = $(this).parent().parent().attr('data-id');
        bootbox.prompt("Please enter a new value:", function(result) {
            if (result !== null) {
                Ajax.Categories.edit(id, result);
            }
        });
    });
    $(".btn-delete-value").click(function() {
        var id = $(this).parent().parent().attr('data-id');
        bootbox.confirm("Are you sure?", function(result) {
          if (result === true) {
            Ajax.Categories.delete(id);
          }
        });
    });
});


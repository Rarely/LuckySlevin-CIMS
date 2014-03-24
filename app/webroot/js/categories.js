$(function() {
    $("#btn-add-value").click(function() {
        bootbox.prompt("Please enter a value:", function(result) {
            if (result !== null && result != "") {
                Ajax.Categories.create($('.table-category').attr('data-id'), result);
            }
        }).find("div.modal-content").addClass("confirmWidth");
    });
    $(".btn-edit-value").click(function() {
        var id = $(this).parent().parent().attr('data-id');
        var name = $(this).parent().parent().attr('data-name');
        bootbox.prompt("Please enter a new value for " + name + ":", function(result) {
            if (result !== null && result != "") {
                Ajax.Categories.edit(id, result);
            }
        }).find("div.modal-content").addClass("confirmWidth");
    });
    $(".btn-delete-value").click(function() {
        var id = $(this).parent().parent().attr('data-id');
        var name = $(this).parent().parent().attr('data-name');
        bootbox.confirm("Are you sure you want to remove the value " + name + "?", function(result) {
          if (result === true) {
            Ajax.Categories.delete(id);
          }
        }).find("div.modal-content").addClass("confirmWidth");
    });
});


$(function() {
    
    /*
       description: attach on click funtion to $("#btn-add-value") to add a category value when pressed
       input: none
       preconditions:
              $("#btn-add-value") exists
              $("#btn-add-value") has been clicked
       postconditions:
              render bootbox to enter new value
              call Ajax.Categories.create($('.table-category').attr('data-id'), result)
       return value: none
    */
    $("#btn-add-value").click(function() {
        bootbox.prompt("Please enter a value:", function(result) {
            if (result !== null && result != "") {
                Ajax.Categories.create($('.table-category').attr('data-id'), result);
            }
        }).find("div.modal-content").addClass("confirmWidth");
    });
    
    /*
       description: attach on click funtion to $(".btn-edit-value") to edit a category value when pressed
       input: none
       preconditions:
              $(".btn-edit-value") exists
              $(".btn-edit-value") has been clicked
       postconditions:
              render bootbox to enter new value
              Ajax.Categories.edit(id, result);
       return value: none
    */
    $(".btn-edit-value").click(function() {
        var id = $(this).parent().parent().attr('data-id');
        var name = $(this).parent().parent().attr('data-name');
        bootbox.prompt("Please enter a new value for " + name + ":", function(result) {
            if (result !== null && result != "") {
                Ajax.Categories.edit(id, result);
            }
        }).find("div.modal-content").addClass("confirmWidth");
    });
    
    /*
       description: attach on click funtion to $(".btn-delete-value") to delete a category value when pressed
       input: none
       preconditions:
              $(".btn-delete-value") exists
              $(".btn-delete-value") has been clicked
       postconditions:
              render confirmation bootbox
              call Ajax.Categories.delete(id)
       return value: none
    */
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


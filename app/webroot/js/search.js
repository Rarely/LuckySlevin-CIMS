$(function() {
    $("#btn-export").click(function(e) {
        $("#btn-export").attr("disabled", "disabled");
        canceldelete();
        jQuery('.ideablock').each(function() {
            $(this).attr("onclick", "");
            $(this).selectable();
        });
        $("#btn-cancel-csv").css('display', 'inline-block');
        $("#export-help").show();
        $("#btn-save-csv").show();
        $("#btn-save-csv").unbind().bind("click", function() {
            var info = [];
            jQuery('.ideablock.selected').each(function() {
                info.push($(this).attr("data-id"));
            });
            window.location = "/search/export?ids=" + info;
            cancelcsv();
        });
    });
    $("#btn-cancel-csv").click(cancelcsv);

    $("#btn-delete").click(function(e) {
        $("#btn-delete").attr("disabled", "disabled");
        cancelcsv();
        jQuery('.ideablock').each(function() {
            $(this).attr("onclick", "");
            $(this).selectable();
        });
        $("#btn-cancel-delete").css('display', 'inline-block');
        $("#btn-delete-confirm").show();
        $("#btn-delete-confirm").unbind().bind("click", function() {
            var info = [];
            jQuery('.ideablock.selected').each(function() {
                info.push($(this).attr("data-id"));
            });
            bootbox.confirm({
                message: "Are you sure you want to delete this idea?",
                buttons: {
                    confirm: {label: "Delete"},
                    cancel: {label: "Don't do it!"}
                },
                callback:function(result) {
                    if(result === true){
                        Ajax.Idea.deleteIdea(info);
                    }
                }
            }).find("div.modal-content").addClass("confirmWidth");
        });
    });
    $("#btn-cancel-delete").click(canceldelete);

    function cancelcsv(e) {
        jQuery('.ideablock').each(function() {
            $(this).unbind("click");
            $(this).attr("onclick", "Ajax.Idea.showIdea($(this).attr(\"data-id\"));");
            $(this).selectable(false);
        });
        $("#btn-cancel-csv").hide();
        $("#export-help").hide();
        $("#btn-save-csv").hide();
        $("#btn-export").removeAttr("disabled");
    }

    function canceldelete(e) {
        jQuery('.ideablock').each(function() {
            $(this).unbind("click");
            $(this).attr("onclick", "Ajax.Idea.showIdea($(this).attr(\"data-id\"));");
            $(this).selectable(false);
        });
        $("#btn-cancel-delete").hide();
        $("#btn-delete-confirm").hide();
        $("#btn-delete").removeAttr("disabled");
    }
});
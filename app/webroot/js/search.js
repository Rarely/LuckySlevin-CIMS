$(function() {
    $("#btn-export").click(function(e) {
        $("#btn-export").attr("disabled", "disabled");
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


            jQuery('.ideablock').each(function() {
                $(this).unbind("click");
                $(this).attr("onclick", "Ajax.Idea.showIdea($(this).attr(\"data-id\"));");
                $(this).selectable();
            });
            $("#btn-cancel-csv").hide();
            $("#export-help").hide();
            $("#btn-save-csv").hide();
            $("#btn-export").removeAttr("disabled");
        });
    });
    $("#btn-cancel-csv").click(function(e) {
            jQuery('.ideablock').each(function() {
                $(this).unbind("click");
                $(this).attr("onclick", "Ajax.Idea.showIdea($(this).attr(\"data-id\"));");
                $(this).selectable();
            });
            $("#btn-cancel-csv").hide();
            $("#export-help").hide();
            $("#btn-save-csv").hide();
            $("#btn-export").removeAttr("disabled");
    });
});
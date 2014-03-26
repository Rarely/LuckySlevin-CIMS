$(document).ready(function() {
    $(".user_filter").userSelect(false);
    $("#sort_order").select2();
    $("#sort_by").select2();
    var dimensions = {};
    var sortArray = new Array;
    sortArray.push('default');

    initializeMixItUp();
    $('#Grid').mixitup('sort',sortArray);
    initializeIdeaStyle();

    $('#search-form').submit( function() {
        $.ajax({
            url     : 'search/result/',
            type    : "GET",
            dataType: 'html',
            data    : $('#search-form').serialize(),
            async: true,
            beforeSend: function() {
                $('#search-results').html("<div class='inline-block'><h3>Searching...</h3></div><div class='loading-img inline-block'></div>");
            },
            complete : function(data){
                $('#search-results').html(data.responseText);
                initializeMixItUp();
                initializeIdeaStyle();
                applyFilters();
                $('#Grid').mixitup('sort',sortArray);
            },
            error : function(){
                bootbox.alert("Failed to retrieve search results.");
            }
        });
        return false;
    });


    $('.cat').each(function() {
            $(this).categorySelect();
    });

    $.ajax({
      type: "GET",
      url: 'categories/getCategoryIds',
      dataType: 'json',
      async: true,
      success: function(data) {
               
        
        dimensions["user"] = "all";
        $.each(data.data, function(key, value) {
            newCat = 'category-' + value.Category.id;
            dimensions[newCat] = "all";
        }); 

        $(".user_filter").on('change',function(){
            applyFilters($(this));
        });

        $(".cat").on('change',function(){
            applyFilters($(this));
        });


        $(".sort").on('change',function(){
            var sortBy = $('#sort_by').select2('val');
            var sortOrder = $('#sort_order').select2('val');
            sortArray = new Array;
            sortArray.push(sortBy);
            if(sortBy != 'default' && sortBy != 'random'){
                sortArray.push(sortOrder);
            }
            $('#Grid').mixitup('sort',sortArray);
        });
    }});


    function initializeMixItUp(){
        $("#Grid").mixitup({
            effects: ['fade','scale'],
        });
    }

    function applyFilters(t){
        if(t != null){
            var filters = t.select2('val'),
            filterString = '';

            if(filters.length < 1){
                filterString = 'all';
            }else{
                for (var i = 0; i < filters.length; i++) {
                    if(t.attr('data-id') == 'user'){
                        filterString += 'user-' + filters[i];
                    }else{
                        filterString += 'category-' + t.attr('data-id') + '-' + filters[i];
                    }
                    if(i < filters.length-1){
                        filterString += ' ';
                    }
                }
            }
            if(t.attr('data-id') == 'user'){
                dimensions['user'] = filterString;
            }else{
                dimensions['category-' + t.attr('data-id')] = filterString;
            }
        }

        var dataArray = new Array;
        for(var o in dimensions) {
            dataArray.push(dimensions[o]);
        }
        $('#Grid').mixitup('filter',dataArray);
    }


});



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
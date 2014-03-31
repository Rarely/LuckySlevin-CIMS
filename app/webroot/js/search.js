$(document).ready(function() {
    $("#filter-controls .user_filter").userSelect(false);
    $("#sort_order").select2();
    $("#sort_by").select2();
    var dimensions = {};
    var sortArray = new Array;
    sortArray.push('default');

    initializeMixItUp();
    $('#Grid').mixitup('sort',sortArray);
    initializeIdeaStyle();

    /*
      description: calls search with reset = false
      input: none
      preconditions:
            $('#search-form') exists
            $('#search-form') is submitted
      postconditions:
            calls ideaSearch with reset = false
            form submission does not refresh the page
      return value: false
    */
    $('#search-form').submit( function() {
        ideaSearch(false);
        return false;
    });

    /*
      description: calls search with reset = false
      input: none
      preconditions:
            $('#btn-reset-search') exists
            $('#btn-reset-search') is clicked
      postconditions: calls ideaSearch with reset = false
      return value: none
    */
    $('#btn-reset-search').click( function() {
        $('#search-query').val('').focus();
        ideaSearch(true);
    });


    /*
      description: searches the database for ideas containing specified key words
      input: reset
      preconditions: if reset = true, $('#search-form') exists
      postconditions: rerenders HTML of $('#search-results') to display a small idea view for each search result
      return value: none
    */
    function ideaSearch(reset) {
        $.ajax({
            url     : '/search/result/',
            type    : "GET",
            dataType: 'html',
            data    : reset ? {q : ""} : $('#search-form').serialize(),
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
    }

    /*
      description: initializes category select filters
      input: none
      preconditions: $('#filter-controls .cat') exist
      postconditions: all $('#filter-controls .cat') are initialized by categorySelect();
      return value: none
    */
    $('#filter-controls .cat').each(function() {
            $(this).categorySelect();
    });

    $.ajax({
      type: "GET",
      url: '/categories/getCategoryIds',
      dataType: 'json',
      async: true,
      success: function(data) {
           
        dimensions["user"] = "all";    
        /*
         description: initializes dimensions
         input: key, value
         preconditions: ajax call to /categories/getCategoryIds has returned successfully
         postconditions: initializes all category filter strings to 'all'
         return value: none
        */
        $.each(data.data, function(key, value) {
            newCat = 'category-' + value.Category.id;
            dimensions[newCat] = "all";
        }); 

        /*
         description: attach on change funtion to $("#filter-controls .user_filter") to refresh filters when changed
         input: none
         preconditions:
                ajax call to /categories/getCategoryIds has returned successfully
                $("#filter-controls .user_filter") exists
                $("#filter-controls .user_filter") has changed
                $("#filter-controls .user_filter") is an appropriate input for setUpFilters()
         postconditions:
                call setupfilters for the current element
                call apply filters
         return value: none
        */
        $("#filter-controls .user_filter").on('change',function(){
            setUpFilters($(this));
            applyFilters();
        });

        /*
         description: attach on change funtion to $("#filter-controls .cat") to refresh filters when changed
         input: none
         preconditions:
                ajax call to /categories/getCategoryIds has returned successfully
                $("#filter-controls .cat") exists
                $("#filter-controls .cat") has changed
                $("#filter-controls .cat") is an appropriate input for setUpFilters()
         postconditions:
                call setupfilters for the current element
                call apply filters
         return value: none
        */
        $("#filter-controls .cat").on('change',function(){
            setUpFilters($(this));
            applyFilters();
        });

        /*
         description: attach on change funtion to $(".sort") to apply sort when changed
         input: none
         preconditions:
                ajax call to /categories/getCategoryIds has returned successfully
                $(".sort") exists
                $(".sort") has changed
                $('#Grid') exists and is initialized with mixitup
         postconditions:
                sort $('#Grid') by value specified by $('#sort_by') in order specified by $('#sort_order')
         return value: none
        */
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


    /*
      description: initializes mixitup on $("#Grid") so that filtering and sorting can occur
      input: none
      preconditions: $("#Grid")
      postconditions: mixitup is initialized on $("#Grid")
      return value: none
    */
    function initializeMixItUp(){
        $("#Grid").mixitup({
            effects: ['fade','scale'],
        });
    }

    /*
      description: updates the filter string for a specified dimension
      input: t
      preconditions: t is a select2 input element
      postconditions: sets the appropriate filter string to be the list of the values in the specified select 2 input element
      return value: none
    */
    function setUpFilters(t){
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

    /*
      description: Applies filtering to $('#Grid')
      input: none
      preconditions:
            $('#Grid') exists and is initialized with mixitup
            dimensions is an object containing all the filter strings
      postconditions: filters the idea view elements in $('#Grid') to match the filter strings in dimensions
      return value: none
    */
    function applyFilters(){
        var dataArray = new Array;
        for(var o in dimensions) {
            dataArray.push(dimensions[o]);
        }
        $('#Grid').mixitup('filter',dataArray);
    }

    $('#btn-reset-filters').click( function() {
        $("#filter-controls .cat").select2('val', '');
        $("#filter-controls .user_filter").select2('val', '');
        $('#filter-controls .user_filter').each(function() {
            setUpFilters($(this));
        });
        $('#filter-controls .cat').each(function() {
            setUpFilters($(this));
        });
        applyFilters();
    });

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
        $("#btn-save-csv").css('display', 'inline-block');
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
        $("#btn-delete-confirm").css('display', 'inline-block');
        $("#delete-help").show();
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
        $("#delete-help").hide();
        $("#btn-delete").removeAttr("disabled");
    }
});
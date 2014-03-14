$(document).ready(function() {
	$(".user_filter").userSelect(false);
    $("#sort_order").select2();
    $("#sort_by").select2();

	$("#Grid").mixItUp({
		showOnLoad: 'all',
		effects: ['fade','scale'],
		//multiFilter: true
	});


    jQuery('.cat').each(function() {
            $(this).categorySelect();
    });

    $.ajax({
      type: "GET",
      url: '/categories/getCategoryIds',
      dataType: 'json',
      async: true,
      success: function(data) {
               
        var dimensions = {};
        dimensions["user"] = "all";
        $.each(data.data, function(key, value) {
            newCat = 'category-' + value.Category.id;
            dimensions[newCat] = "all";
        }); 

        $(".user_filter").on('change',function(){
            var $t = $(this),
            filters = $t.select2('val')
            filterString = '';

            if(filters.length < 1){
                filterString = 'all';
            }else{
                for (var i = 0; i < filters.length; i++) {
                    filterString += 'user-' + filters[i];
                    if(i < filters.length-1){
                        filterString += ' ';
                    }
                }
            }

            dimensions["user"] = filterString;

            var dataArray = new Array;
            for(var o in dimensions) {
                dataArray.push(dimensions[o]);
            }

            $('#Grid').mixItUp('filter',dataArray)
        });


        $(".cat").on('change',function(){
            var $t = $(this),
            filters = $t.select2('val')
            filterString = '';

            if($t.attr('multiple') == 'multiple'){
                if(filters.length < 1){
                    filterString = 'all';
                }else{
                    for (var i = 0; i < filters.length; i++) {
                        filterString += '.category-' + $t.attr('data-id') + '-' + filters[i];
                        if(i < filters.length-1){
                            filterString += ', ';
                        }
                    }
                }
                dimensions['category-' + $t.attr('data-id')] = filterString;
            }else{
                dimensions['category-' + $t.attr('data-id')] = '.category-' + $t.attr('data-id') + '-' + filters;
            }

            var dataArray = "";//new Array;
            for(var o in dimensions) {
                if(dimensions[o] != 'all'){
                    dataArray += dimensions[o];
                }
            }
            if(dataArray == ''){
                dataArray = 'all';
            }

            $('#Grid').mixItUp('filter',dataArray)
        });


/*
        $(".sort").on('change',function(){

            var sortBy = $('#sort_by').select2('val');
            var sortOrder = $('#sort_order').select2('val');

            var sortString = sortBy + ':' + sortOrder;
            var dataArray = new Array;
            for(var o in dimensions) {
                dataArray.push(dimensions[o]);
            }
            $('#Grid').mixItUp('filter',dataArray)
            $('#Grid').mixItUp('sort',sortString)
        });




        var dataArray = new Array;
        for(var o in dimensions) {
            dataArray.push(dimensions[o]);
        }

        $('#Grid').mixItUp('filter',dataArray)
*/
      
    }});

    //TODO: this is duplicated code from ui.js that doesnt load here for some reason
    $(".title-text-wrapper").dotdotdot({
        ellipsis    : '... ',
        /*  How to cut off the text/html: 'word'/'letter'/'children' */
        wrap        : 'word',
        /*  Wrap-option fallback to 'letter' for long words */
        fallbackToLetter: true,
        /*  jQuery-selector for the element to keep and put after the ellipsis. */
        after       : null,
        /*  Whether to update the ellipsis: true/'window' */
        watch       : false,
        /*  Optionally set a max-height, if null, the height will be measured. */
        height      : 40,
        /*  Deviation for the height-option. */
        tolerance   : 0,
        /*  Callback function that is fired after the ellipsis is added,
        receives two parameters: isTruncated(boolean), orgContent(string). */
        callback    : function( isTruncated, orgContent ) {},
        lastCharacter   : {
            /*  Remove these characters from the end of the truncated text. */
            remove      : [ ' ', ',', ';', '.', '!', '?' ],
            /*  Don't add an ellipsis if this array contains 
            the last character of the truncated text. */
            noEllipsis  : []
        }
    });

    $(".description-text-wrapper").dotdotdot({
        ellipsis    : '... ',
        /*  How to cut off the text/html: 'word'/'letter'/'children' */
        wrap        : 'word',
        /*  Wrap-option fallback to 'letter' for long words */
        fallbackToLetter: true,
        /*  jQuery-selector for the element to keep and put after the ellipsis. */
        after       : null,
        /*  Whether to update the ellipsis: true/'window' */
        watch       : false,
        /*  Optionally set a max-height, if null, the height will be measured. */
        height      : 50,
        /*  Deviation for the height-option. */
        tolerance   : 0,
        /*  Callback function that is fired after the ellipsis is added,
        receives two parameters: isTruncated(boolean), orgContent(string). */
        callback    : function( isTruncated, orgContent ) {},
        lastCharacter   : {
            /*  Remove these characters from the end of the truncated text. */
            remove      : [ ' ', ',', ';', '.', '!', '?' ],
            /*  Don't add an ellipsis if this array contains 
            the last character of the truncated text. */
            noEllipsis  : []
        }
    }); 

    



});









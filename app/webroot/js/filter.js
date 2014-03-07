$(document).ready(function() {
	$("#filters .user_filter").userSelect();
	$("#Grid").mixitup({
		showOnLoad: 'all',
		effects: ['fade','scale'],
		//multiFilter: true
	});

    jQuery('.cat').each(function() {
            $(this).categorySelect();
    });

	$(".description-text-wrapper").dotdotdot({
		ellipsis	: '... ',
		/*	How to cut off the text/html: 'word'/'letter'/'children' */
		wrap		: 'word',
		/*	Wrap-option fallback to 'letter' for long words */
		fallbackToLetter: true,
		/*	jQuery-selector for the element to keep and put after the ellipsis. */
		after		: null,
		/*	Whether to update the ellipsis: true/'window' */
		watch		: false,
		/*	Optionally set a max-height, if null, the height will be measured. */
		height		: 50,
		/*	Deviation for the height-option. */
		tolerance	: 0,
		/*	Callback function that is fired after the ellipsis is added,
		receives two parameters: isTruncated(boolean), orgContent(string). */
		callback	: function( isTruncated, orgContent ) {},
		lastCharacter	: {
			/*	Remove these characters from the end of the truncated text. */
			remove		: [ ' ', ',', ';', '.', '!', '?' ],
			/*	Don't add an ellipsis if this array contains 
			the last character of the truncated text. */
			noEllipsis	: []
		}
	});  


    $.ajax({
      type: "GET",
      url: '/categories/getCategoryIds',
      dataType: 'json',
      async: true,
      success: function(data) {
            
            var dimensions = {
                user: 'all', // Create string for first dimension
                notUser: 'all' // Create string for second dimension
            }

            //data.data[0].Category.id
            $.each(data.data, function(key, value) {
                newCat = 'category-' + value.Category.id;
                $.extend(dimensions, {newCat : 'all'});
            }); 




        $(".user_filter").on('change',function(){
            var $t = $(this),
            filters = $t.select2('val')
            mixitupFilters = '';

            if(filters.length < 1){
                mixitupFilters = 'all';
            }else{
                for (var i = 0; i < filters.length; i++) {
                    mixitupFilters += 'user-' + filters[i];
                    if(i < filters.length-1){
                        mixitupFilters += ' ';
                    }
                }
            }

            dimensions.user = mixitupFilters;

            $('#Grid').mixitup('filter',[dimensions.user, dimensions.notUser])
        });

      }
    });



});









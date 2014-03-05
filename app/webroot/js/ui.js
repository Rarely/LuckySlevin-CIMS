$(document).ready(function() {
    $(".title-text-wrapper").dotdotdot({
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
		height		: 40,
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



	jQuery('.ideablock').each(function() {
		var updated = new Date($(this).attr("data-updated"));
		var rgb = getRGB(updated);
        // $(this).css({"background-color" : "#" + rgb});
    });

	function getRGB(lastUpdated) {
		// days since epoch
		var factor = 86400000;
		var now = new Date().getTime()/factor;
		// time last updated, days since epoch
		var updated = lastUpdated.getTime()/factor;
		// debugger;
		//difference in days since last updated from current time
		var diff = now-updated;
		//scaled value 
		var scaled = 255*diff/30;
	/*
		If the difference between the current time and the time last updated is
		greater than or equal to 30 days, then the colour returned will be solid blue until 
		the idea is next updated. Otherwise the colour returned will fluctuate between
		blue and green depending on when the idea was last updated.
	*/
		if (diff>=30) {
			var g = 0;
			var b = 255;
			var r = "00";		
		} else {
			var g = Math.round(255 - scaled);
			var b = Math.round(255 - g);
			var r = "00";
		}
		
		//return the 6 digit color value
		var returnval = r + decimalToHex(g) + decimalToHex(b);
		return returnval;
	}

	function decimalToHex(d, padding) { var hex = Number(d).toString(16); padding = typeof (padding) === "undefined" || padding === null ? padding = 2 : padding; while (hex.length < padding) { hex = "0" + hex; } return hex; }
});


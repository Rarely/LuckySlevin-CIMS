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
		var date_string = $(this).attr("data-updated");
		var updated = Date.parse(date_string);
		var rgb = getRGB(updated);
		applyGradientToIdea($(this), rgb);
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
		// debugger;
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
	
	/* element is jquery dom object
	endColor is hex value without "#" */
	function applyGradientToIdea(element, endColor) {
		// debugger;
		var rgbcolor = hexToRgb(endColor);
        var backgroundRGB= hexToRgb("98B2C3");

		element.css({
			"background-size": "190px",
			"background": "url(\"/img/idea.png\") no-repeat right top / 190px auto, -moz-linear-gradient(top,  rgba(" + backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",1) 0%, rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",0.85) 85%, rgba(" + rgbcolor.r + "," + rgbcolor.g + "," + rgbcolor.b + ",0.65) 100%)", /* FF3.6+ */
			"background": "url(\"/img/idea.png\") no-repeat left top / 190px auto, -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(" + backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b +  ",1)), color-stop(85%,rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",0.85)), color-stop(100%,rgba(" + rgbcolor.r + "," + rgbcolor.g + "," + rgbcolor.b + ",0.65)))", /* Chrome,Safari4+ */
			"background": "url(\"/img/idea.png\") no-repeat left top / 190px auto, -webkit-linear-gradient(top,  rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",1) 0%,rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",0.85) 85%,rgba(" + rgbcolor.r + "," + rgbcolor.g + "," + rgbcolor.b + ",0.65) 100%)", /* Chrome10+,Safari5.1+ */
			"background": "url(\"/img/idea.png\") no-repeat left top / 190px auto, -o-linear-gradient(top,  rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",1) 0%,rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",0.85) 85%,rgba(" + rgbcolor.r + "," + rgbcolor.g + "," + rgbcolor.b + ",0.65) 100%)", /* Opera 11.10+ */
			"background": "url(\"/img/idea.png\") no-repeat left top / 190px auto, -ms-linear-gradient(top,  rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",1) 0%,rgba("+ backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",0.85) 85%,rgba(" + rgbcolor.r + "," + rgbcolor.g + "," + rgbcolor.b + ",0.65) 100%)", /* IE10+ */
			"background": "url(\"/img/idea.png\") no-repeat right top / 190px auto, linear-gradient(to bottom,  rgba(" + backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",1) 0%,rgba(" + backgroundRGB.r + "," + backgroundRGB.g + "," + backgroundRGB.b + ",1) 85%,rgba(" + rgbcolor.r + "," + rgbcolor.g + "," + rgbcolor.b + ",0.65) 100%)", /* W3C */
			"filter": "progid:DXImageTransform.Microsoft.gradient( startColorstr='#" + endColor + "', endColorstr='#98B2C3   ',GradientType=0 )", /* IE6-9 */
		});
}

function hexToRgb(hex) {
	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	return result ? {
		r: parseInt(result[1], 16),
		g: parseInt(result[2], 16),
		b: parseInt(result[3], 16)
	} : null;
}

function decimalToHex(d, padding) { var hex = Number(d).toString(16); padding = typeof (padding) === "undefined" || padding === null ? padding = 2 : padding; while (hex.length < padding) { hex = "0" + hex; } return hex; }
});


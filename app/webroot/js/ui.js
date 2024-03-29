$(document).ready(function() {

	initializeIdeaStyle();

});

    /*
      description: initializes the text style for different fields
      input: none
      preconditions: there is a text field
      postconditions: the style of the text field identifies properly with each wrapper
      return value: the default input with correctly initialized style.
    */

	function initializeIdeaStyle(){

		$(".title-text-wrapper").dotdotdot({
			ellipsis	: '... ',
			/*	How to cut off the text/html: 'word'/'letter'/'children' */
			wrap		: 'letter',
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
			wrap		: 'word',
			fallbackToLetter: true,
			after		: null,
			watch		: false,
			height		: 50,
			tolerance	: 0,
			callback	: function( isTruncated, orgContent ) {},
			lastCharacter	: {
				remove		: [ ' ', ',', ';', '.', '!', '?' ],
				noEllipsis	: []
			}
		});

		$(".status-text-wrapper").dotdotdot({
			ellipsis	: '',
			wrap		: 'letter',
			fallbackToLetter: true,
			after		: null,
			watch		: false,
			height		: 30,
			tolerance	: 0,
			callback	: function( isTruncated, orgContent ) {},
			lastCharacter	: {
				remove		: [ ' ', ',', ';', '.', '!', '?' ],
				noEllipsis	: []
			}
		});

		$(".owner-text-wrapper").dotdotdot({
			ellipsis	: '...',
			wrap		: 'letter',
			fallbackToLetter: true,
			after		: null,
			watch		: false,
			height		: 30,
			tolerance	: 0,
			callback	: function( isTruncated, orgContent ) {},
			lastCharacter	: {
				remove		: [ ' ', ',', ';', '.', '!', '?' ],
				noEllipsis	: []
			}
		});  

    /*
      description: applys a gradient to an small idea view based on the date in which it was last updated.
      input: the date the idea was last updated
      preconditions: the idea updated field is valid
      postconditions: the RGB colour is valid
      return value: the gradient applied to the small idea view color
    */

		jQuery('.ideablock').each(function() {
			var date_string = $(this).attr("data-updated");
			var updated = Date.parse(date_string);
			var rgb = getRGB(updated);
			applyGradientToIdea($(this), rgb);
		});
	}


    /*
      description: creates an RGB color value based on the date an idea was last updated
      input: the date the idea was last updated.
      preconditions: the idea updated field is valid
      postconditions: the rgb value generated is a 6 digit hexidecimal
      return value: the rgb value returned
    */

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
	
    /*
      description: chooses a gradient to apply to the small idea view
      input: the idea image and hexidecimal rgb value
      preconditions: the rgb value is valid
      postconditions: the gradient applied varies depending on browser
      return value: the idea start_date
    */

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

    /*
      description: creates an rgb value from a hexidecimal value
      input: a hexidecimal value
      preconditions: the hexidecimal value is valid
      postconditions: the rgb value is valid
      return value: the rgb value
    */
function hexToRgb(hex) {
	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	return result ? {
		r: parseInt(result[1], 16),
		g: parseInt(result[2], 16),
		b: parseInt(result[3], 16)
	} : null;
}

    /*
      description: creates an hexidecimal value from a decimal value
      input: a decimal value
      preconditions: the decimal value is valid
      postconditions: the hexadecimal value is valid
      return value: the hexadecimal value
    */
function decimalToHex(d, padding) {
	var hex = Number(d).toString(16);
	padding = typeof (padding) === "undefined" || padding === null ? padding = 2 : padding;
	while (hex.length < padding) { hex = "0" + hex; } return hex;
}
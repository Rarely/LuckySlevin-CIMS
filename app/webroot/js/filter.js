$(document).ready(function() {
	$("#filters .user_filter").userSelect();
	$("#Grid").mixitup({
		showOnLoad: 'all',
		effects: ['fade','scale'],
		//multiFilter: true
	});
});
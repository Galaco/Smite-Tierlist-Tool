function flashMessage(level, message) {
	var element = document.createElement('div');
	$element = $(element);
	$element.addClass('flash-message');
	$element.addClass('flash-' + level);
	$element.append(message);
	
	$('#flashMessages').append($element);
	$element.hide().delay(20).fadeIn().delay(5000).fadeOut();
}
var dragElement = undefined;
var dropElement = undefined;

//element1=mouse //element2=droptarget
function dnd_checkCollision(element1, element2) {
	var x1 = element1.offset().left;
	var y1 = element1.offset().top;
	var h1 = element1.outerHeight(true);
	var w1 = element1.outerWidth(true);
	var b1 = y1;// + h1;
	var r1 = x1;// + w1;
			
	var x2 = element2.offset().left;
	var y2 = element2.offset().top;
	var h2 = element2.outerHeight(true);
	var w2 = element2.outerWidth(true);
	var b2 = y2 + h2;
	var r2 = x2 + w2;
				
	if (b1 < y2 || y1 > b2 || r1 < x2 || x1 > r2) {
		return false;
	}
	
	return true;
}

function enableDragandDrop() {
	$('.draggable').on('mousedown', function(){
		dragElement = $(this);
	});

	$('body').on('mousemove', function(e){
		if(typeof dragElement != "undefined") {
			dragElement.css({
				 top : e.pageY,
				 left : e.pageX,
				 width : dragElement.width(),
				 height : dragElement.height(),
				 position: 'fixed'
			});	
			
			var anyCollision = false;
			$('.droppable').each(function() {
				var collision = dnd_checkCollision(dragElement, $(this));
				if (collision) {
					$(this).addClass('highlight');
					anyCollision = true;
					dropElement = $(this);
					return;
				} else {
					$(this).removeClass('highlight');
					if (!anyCollision) {
						dropElement = undefined;
					}
				}	
			});
		}
	});

	$('body').on('mouseup', function(){
		if (dragElement) {
			dragElement.css({
				 top : "",
				 left : "",
				 width : "",
				 height : "",
				 position: ""
			});
			
			if (dropElement) {
				dropElement.append(dragElement);		
				dragElement.trigger('dropped', [dropElement]);
			}
		}

		$('.droppable').each(function() {
			$(this).removeClass('highlight');
		});
		
		dragElement = undefined;
		dropElement = undefined;
	});
}

function hookPageNavbar(callBack) {
	//determine if page has a navbar
	if (!$('#sidebar-tab-nav')) return;
	
	if (typeof(callBack)==='undefined') { 
		callBack = function(index) {
			tabIndex = 0;
			while ($('#tab_nav_main_'+ tabIndex).length) {
				$('#tab_nav_main_'+ tabIndex).addClass('hidden');
				tabIndex++;
			}
			$('#tab_nav_main_'+ index).removeClass('hidden');
		}; 
	}
		
	tabIndex = 0;
	while ($('#sidebar-tab-nav-'+ tabIndex).length) {
		$('#sidebar-tab-nav-'+ tabIndex).click({param1: tabIndex}, function(event) {
			//adds highlight to correct button
			buttonIndex = 0;
			while ($('#sidebar-tab-nav-' + buttonIndex).length) {
				$('#sidebar-tab-nav-' + buttonIndex + ' a').removeClass('active');
				buttonIndex++;
			}
			$('#sidebar-tab-nav-' + event.data.param1 + ' a').addClass('active');
	
			//callback function to handle how the pages tabs are shown
			callBack(event.data.param1);
		});
		tabIndex++;
	}	
}
function hookCustomNavbar(callBack, selector) {
	tabIndex = 0;
	while ($(selector + tabIndex).length) {
		$(selector + tabIndex).click({param1: tabIndex}, function(event) {
			//adds highlight to correct button
			buttonIndex = 0;
			while ($(selector + buttonIndex).length) {
				$(selector + buttonIndex).removeClass('selected');
				buttonIndex++;
			}
			$(selector + event.data.param1).addClass('selected');
	
			//callback function to handle how the pages tabs are shown
			callBack(event.data.param1);
		});
		tabIndex++;
	}	
}

function controlVideoPlayback()
{
	var vid = document.getElementById("bgvid");
	if (vid) {
		function vidFade() {
			vid.classList.add("stopfade");
		}
		vid.addEventListener('ended', function() {
			vid.pause();
			vidFade();
		});
	}
}

function domReady(func) {
	$(document).ready(func);
}
function flashMessage(level, message) {
	var element = document.createElement('div');
	$element = $(element);
	$element.addClass('flash-message');
	$element.addClass('flash-' + level);
	$element.append(message);
	
	$('#flashMessages').append($element);
	$element.hide().delay(20).fadeIn().delay(5000).fadeOut();
}
function performXhr(url, params, onSuccess, onError, onStateChange) {
	if (!onSuccess) onSuccess = function(){};
	if (!onError) onError = function(){};
	if (!onStateChange) onStateChange = function(){};
	
	var last_response_len = false;
	
	$.ajax(
		url,
		{
			data: params,
			type: 'POST',
            xhrFields: {
                onprogress: function(e)
                {
                    var this_response, response = e.currentTarget.response;
                    if(last_response_len === false)
                    {
                        this_response = response;
                        last_response_len = response.length;
                    }
                    else
                    {
                        this_response = response.substring(last_response_len);
                        last_response_len = response.length;
                    }
					onStateChange(this_response);
                }
            }
		}
	)
	.success(
		function(response) {
			onSuccess(response);
		}
	)
	.fail(
		function(response) {
			onError(response);
		}
	);
}

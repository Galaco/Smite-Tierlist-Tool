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

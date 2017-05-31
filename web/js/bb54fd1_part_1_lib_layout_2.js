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
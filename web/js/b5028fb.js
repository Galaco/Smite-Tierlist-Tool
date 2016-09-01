defaultItems = {};

function addDefaultItem(itemCategory, itemIcon, itemName) {
	if (!defaultItems[itemCategory]) {
		defaultItems[itemCategory] = {};
	}
	defaultItems[itemCategory][itemName] = itemIcon;
}

function setDefaultItems() {
	root = $('#god_default_items');
	for (var category in defaultItems){
		root.append('<h2 class="category">' + category + '</h2>');
		element = '<div class="row">';
		$element = $(element);		
			
		count = 1;
		for (var itemName in defaultItems[category]){
			if (count < 5) {
				element += ('<div class="row col-sm-3"><img src="http://cdn.smite.link/smite/items/' + defaultItems[category][itemName] + '.jpg"/><p>' + itemName + '</p></div>');
			} else {
				$element.removeAttr('sum-4');
				$element.attr('sum-5');
			}
			count ++;
		}

		element += '</div>';
		root.append(element);
	}
}

function addListenerForItem(elementId, itemId) {
	$('#'+elementId).hover(function(){
		data = {};
		data['id'] = itemId;
		
		params = JSON.stringify(data);
		performXhr('/items/json', 
			params,
			function(data) {
				console.log(data);
				$('#hoveredItem').html('');
			},
			false,
			false
		);
	});
}


$(document).ready(function(){	
	hookPageNavbar();
	setDefaultItems();
});
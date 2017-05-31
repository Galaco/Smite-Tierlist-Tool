function God() {
	this.id = 0
	this.name = 0
	this.god_icon_url = 0
	this.tier_level = 0
	this.htmlElement = -1;
}

function addGodToSavedTierList(god_id, god_name, god_icon_url, tier_level) {
	if (!savedGods[tier_level]) {
		savedGods[tier_level] = [];
	}
	
	god = new God();
	god.id = god_id;
	god.name = god_name;
	god.god_icon_url = god_icon_url;
	god.tier_level = tier_level;
	
	savedGods[tier_level].push(god);
}

function addGodToNewTierList(god_id, god_name, god_icon_url) {	
	god = new God();
	god.id = god_id;
	god.name = god_name;
	god.god_icon_url = god_icon_url;
	
	newGods.push(god);
}

function addGodToAggregateTierList(god_id, god_name, god_icon_url, tier_level) {
	if (!aggregateGods[tier_level]) {
		aggregateGods[tier_level] = [];
	}
	
	god = new God();
	god.id = god_id;
	god.name = god_name;
	god.god_icon_url = god_icon_url;
	god.tier_level = tier_level;
	
	aggregateGods[tier_level].push(god);
}

savedGods = [];
aggregateGods = [];
newGods = [];

$(document).ready(function(){
	//Add saved gods to tier list
	savedGods.forEach(function(tier) {
		if (tier) {		
			tier.forEach(function(god) {
				$element = '<img class="god col-sm-1" src="' + god.god_icon_url + '" alt="' + god.name + '"/>';
				if (god.tier_level == 0) {
					$('#gods_saved_tier_list div.row:last-child div.gods').append($element);
				} else {		
					$('#gods_saved_tier_list div.row:nth-child(' + god.tier_level + ') div.gods').append($element);
				}
			});
		}
	});
	
	aggregateGods.forEach(function(tier) {
		if (tier) {		
			tier.forEach(function(god) {
				$element = '<img class="god col-sm-1" src="' + god.god_icon_url + '" alt="' + god.name + '"/>';
				if (god.tier_level == 0) {
					$('#gods_aggregate_tier_list div.row:last-child div.gods').append($element);
				} else {		
					$('#gods_aggregate_tier_list div.row:nth-child(' + god.tier_level + ') div.gods').append($element);
				}
			});
		}
	});
	
	//Add new gods to god pool
	newGods.forEach(function(god) {		
		var element = document.createElement('img');
		$element = $(element);
		$element.addClass('god draggable col-sm-1');
		$element.attr('src', god.god_icon_url)
		$element.attr('alt', god.name)
		$element.attr('name', god.name)
		$element.data('god', god);
		$element.on('dropped', function(event, dropElement) {
			dragElement = $(this);
			count = 1;
			
			$('.droppable').each(function(key, value) {
				if (dropElement.is($(value))) {
					$('#tierlist_god_' + dragElement.data('god').id).val(count);
					dragElement.data('god').tier_level = count;
				}
				count++;
			});
		});	
		$("#god_tierlist_pool").append(element);
	});	
	
	enableDragandDrop();
});